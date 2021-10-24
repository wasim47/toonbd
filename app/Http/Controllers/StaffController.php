<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Staff;
use Validator;
use Image;


class StaffController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$alldirector = Staff::orderBy('id','desc')->get();
    	return view('admin.director.index',compact('alldirector'));
     }


    public function create()
    {
        return view('admin.director.create');
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255'],
			 'designation' => ['required', 'string', 'max:255']
		]);


		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'director_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/director/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 450, 450);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


        $m = new Staff;
		$m->name = $request->name;
		$m->details = $request->details;
		$m->image = $savedFileName;
		$m->designation = $request->designation;
		$m->sequence = $request->sequence;
		$m->status = $request->status;
		$m->meta_details = $request->meta_details;
		$m->keywords = $request->keywords;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/director');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $director = Staff::find($id);
        return view('admin.director.edit',compact('director'));

    }

    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255'],
       'image' => ['required|image']
		]);


		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'director_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/director/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 450, 450);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


        $director = Staff::find($id);
        $menuUpdate = array(
			'name'=>  $request->name,
			'designation'=>  $request->designation,
			'details'=>  $request->details,
			'image'=>  $savedFileName,
			'sequence'=>  $request->sequence,
			'status'=>  $request->status,
			'meta_details'=>  $request->meta_details,
			'keywords'=>  $request->keywords,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $director->update($menuUpdate);
        return redirect('administration/director');
    }

    public function destroy($id)
    {
        $menuItem = Staff::find($id);
        $menuItem->delete();
        return redirect('administration/director');
    }

	public function imageResize($file, $path, $filename, $width, $height)
	{
		//$img = Image::make($file)->resize($width, $height)->save($path, $filename, 100);

		$img = Image::make($file);
		$img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
		$img->save($path);
	}

}
