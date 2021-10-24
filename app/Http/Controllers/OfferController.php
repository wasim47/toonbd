<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Offer;
use Validator;
use Image;


class OfferController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$alloffer = Offer::orderBy('id','desc')->get();
    	return view('admin.offer.index',compact('alloffer'));
     }


    public function create()
    {
        return view('admin.offer.create');
    }

    public function store(Request $request)
    {
		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'offer_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/offer/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 500, 500);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


        $m = new Offer;
		$m->name = $request->name;
		$m->image = $savedFileName;
		$m->url = $request->url;
		$m->sequence = $request->sequence;
		$m->status = $request->status;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/offer');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $offer = Offer::find($id);
        return view('admin.offer.edit',compact('offer'));

    }

    public function update(Request $request, $id)
    {

		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'offer_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/offer/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 500, 500);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


        $offer = Offer::find($id);
        $menuUpdate = array(
			'name'=>  $request->name,
			'url'=>  $request->url,
			'image'=>  $savedFileName,
			'sequence'=>  $request->sequence,
			'status'=>  $request->status,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $offer->update($menuUpdate);
        return redirect('administration/offer');
    }

    public function destroy($id)
    {
        $menuItem = Offer::find($id);
        $menuItem->delete();
        return redirect('administration/offer');
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
