<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Banner;
use Validator;
use Image;


class PhotoGalleryController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allbanner = Banner::orderBy('id','desc')->get();
    	return view('admin.banner.index',compact('allbanner'));
     }


    public function create()
    {
        return view('admin.banner.create');
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
                    $savedFileName = 'banner_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/banner/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 1500, 300);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


        $m = new Banner;
		$m->name = $request->name;
		$m->url = $request->url;
		$m->image = $savedFileName;
		$m->sequence = $request->sequence;
		$m->status = $request->status;
		$m->meta_details = $request->meta_details;
		$m->keywords = $request->keywords;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/banner');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.edit',compact('banner'));

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
                    $savedFileName = 'banner_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/banner/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 1500, 300);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


        $banner = Banner::find($id);
        $menuUpdate = array(
			'name'=>  $request->name,
			'url'=>  $request->url,
			'image'=>  $savedFileName,
			'sequence'=>  $request->sequence,
			'status'=>  $request->status,
			'meta_details'=>  $request->meta_details,
			'keywords'=>  $request->keywords,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $banner->update($menuUpdate);
        return redirect('administration/banner');
    }

    public function destroy($id)
    {
        $menuItem = Banner::find($id);
        $menuItem->delete();
        return redirect('administration/banner');
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
