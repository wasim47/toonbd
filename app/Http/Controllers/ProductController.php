<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Product;
use Validator;
use Image;


class ProductController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allproduct = Product::orderBy('id','desc')->get();
    	return view('admin.product.index',compact('allproduct'));
     }


    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255']
		]);


		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'product_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/product/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 450, 450);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


        $m = new Product;
		$m->name = $request->name;
		$m->details = $request->details;
		$m->image = $savedFileName;
		$m->status = $request->status;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/product');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit',compact('product'));

    }

    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255']
		]);


		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'product_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/product/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 450, 450);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


        $product = Product::find($id);
        $menuUpdate = array(
			'name'=>  $request->name,
			'details'=>  $request->details,
			'image'=>  $savedFileName,
			'status'=>  $request->status,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $product->update($menuUpdate);
        return redirect('administration/product');
    }

    public function destroy($id)
    {
        $menuItem = Product::find($id);
        $menuItem->delete();
        return redirect('administration/product');
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
