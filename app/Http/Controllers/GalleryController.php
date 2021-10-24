<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Gallery;
use Validator;
use Image;


class GalleryController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allgallery = Gallery::orderBy('id','desc')->get();
    	return view('admin.gallery.index',compact('allgallery'));
     }


    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'gallery_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/photogallery/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 1920, null);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


        $m = new Gallery;
		$m->name = $request->name;
		$m->image = $savedFileName;
		$m->sequence = $request->sequence;
		$m->status = $request->status;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/gallery');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $gallery = Gallery::find($id);
        return view('admin.gallery.edit',compact('gallery'));

    }

    public function update(Request $request, $id)
    {

		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'gallery_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/photogallery/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 1920, null);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


        $gallery = Gallery::find($id);
        $menuUpdate = array(
			'name'=>  $request->name,
			'image'=>  $savedFileName,
			'sequence'=>  $request->sequence,
			'status'=>  $request->status,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $gallery->update($menuUpdate);
        return redirect('administration/gallery');
    }

    public function destroy($id)
    {
        $menuItem = Gallery::find($id);
        $menuItem->delete();
        return redirect('administration/gallery');
    }

	public function imageResize($file, $path, $filename, $width, $height)
	{
		//$img = Image::make($file)->resize($width, $height)->save($path, $filename, 100);

		$img = Image::make($file);
		$img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->resizeCanvas($width, $height, 'center', false, array(0, 0, 0, 0));
		$img->save($path);
	}

}
