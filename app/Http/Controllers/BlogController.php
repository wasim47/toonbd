<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Blog;
use Validator;
use Image;


class BlogController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allblog = Blog::orderBy('id','desc')->get();
    	return view('admin.blog.index',compact('allblog'));
     }


    public function create()
    {
        return view('admin.blog.create');
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
                    $savedFileName = 'blog_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/blog/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 700, 330);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


        $m = new Blog;
		$expval=explode(' ',$request->name);
		$impval=implode('-',$expval);
		$slug = str_replace([',', "'",'"', '/','|','.','`','%','#','"','?'],'' , strtolower($impval));
		
		$m->name = $request->name;
		$m->slug = $slug;
		$m->details = $request->details;
		$m->image = $savedFileName;
		$m->sequence = $request->sequence;
		$m->status = $request->status;
		$m->meta_details = $request->meta_details;
		$m->keywords = $request->keywords;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/blog');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.edit',compact('blog'));

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
                    $savedFileName = 'blog_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/blog/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 700, 330);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


        $blog = Blog::find($id);
		
		$expval=explode(' ',$request->name);
		$impval=implode('-',$expval);
		$slug = str_replace([',', "'",'"', '/','|','.','`','%','#','"','?'],'' , strtolower($impval));
		
        $menuUpdate = array(
			'name'=>  $request->name,
			'slug'=>  $slug,
			'details'=>  $request->details,
			'image'=>  $savedFileName,
			'sequence'=>  $request->sequence,
			'status'=>  $request->status,
			'meta_details'=>  $request->meta_details,
			'keywords'=>  $request->keywords,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $blog->update($menuUpdate);
        return redirect('administration/blog');
    }

    public function destroy($id)
    {
        $menuItem = Blog::find($id);
        $menuItem->delete();
        return redirect('administration/blog');
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
