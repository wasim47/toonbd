<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Partner;
use Validator;
use Image;


class PartnerController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allpartner = Partner::orderBy('id','desc')->get();
    	return view('admin.partner.index',compact('allpartner'));
     }


    public function create()
    {
        return view('admin.partner.create');
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
                    $savedFileName = 'partner_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/partner/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 400, 300);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


        $m = new Partner;
		$m->name = $request->name;
		$m->details = $request->details;
		$m->image = $savedFileName;
		$m->url = $request->url;
		$m->sequence = $request->sequence;
		$m->status = $request->status;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/partner');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $partner = Partner::find($id);
        return view('admin.partner.edit',compact('partner'));

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
                    $savedFileName = 'partner_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/partner/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 400, 300);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


        $partner = Partner::find($id);
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

        $partner->update($menuUpdate);
        return redirect('administration/partner');
    }

    public function destroy($id)
    {
        $menuItem = Partner::find($id);
        $menuItem->delete();
        return redirect('administration/partner');
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
