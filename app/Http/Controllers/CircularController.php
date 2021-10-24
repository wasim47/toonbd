<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Circular;
use Validator;
use Image;


class CircularController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allcircular = Circular::orderBy('id','desc')->get();
    	return view('admin.circular.index',compact('allcircular'));
     }


    public function create()
    {
        return view('admin.circular.create');
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255'],
             'image' => ['required|image']
		]);


		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'circular_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/circular/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 1024, null);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


        $m = new Circular;
		$m->name = $request->name;
		$m->image = $savedFileName;
		$m->sequence = $request->sequence;
		$m->status = $request->status;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/circular');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $circular = Circular::find($id);
        return view('admin.circular.edit',compact('circular'));

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
                    $savedFileName = 'circular_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/circular/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 1024, null);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


        $circular = Circular::find($id);
        $menuUpdate = array(
			'name'=>  $request->name,
			'image'=>  $savedFileName,
			'sequence'=>  $request->sequence,
			'status'=>  $request->status,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $circular->update($menuUpdate);
        return redirect('administration/circular');
    }

    public function destroy($id)
    {
        $menuItem = Circular::find($id);
        $menuItem->delete();
        return redirect('administration/circular');
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
