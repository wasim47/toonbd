<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Protfolio;
use Validator;
use Image;


class ProtfolioController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allprotfolio = Protfolio::orderBy('id','desc')->get();
    	return view('admin.protfolio.index',compact('allprotfolio'));
     }


    public function create()
    {
        return view('admin.protfolio.create');
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
                    $savedFileName = 'protfolio_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/protfolio/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 800, null);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


        $m = new Protfolio;
		$m->name = $request->name;
		$m->details = $request->details;
		$m->image = $savedFileName;
		$m->url = $request->url;
		$m->sequence = $request->sequence;
		$m->status = $request->status;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/protfolio');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $protfolio = Protfolio::find($id);
        return view('admin.protfolio.edit',compact('protfolio'));

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
                    $savedFileName = 'protfolio_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/protfolio/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 800, null);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


        $protfolio = Protfolio::find($id);
        $menuUpdate = array(
			'name'=>  $request->name,
			'url'=>  $request->url,
			'details'=>  $request->details,
			'image'=>  $savedFileName,
			'sequence'=>  $request->sequence,
			'status'=>  $request->status,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $protfolio->update($menuUpdate);
        return redirect('administration/protfolio');
    }

    public function destroy($id)
    {
        $menuItem = Protfolio::find($id);
        $menuItem->delete();
        return redirect('administration/protfolio');
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
