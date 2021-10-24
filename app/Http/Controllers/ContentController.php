<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Content;
use Auth;
use DB;
use Image;

class ContentController extends Controller
{
   public function index()
    {
        $contents = Content::paginate(50);
        return view('admin.contents.index',compact('contents'));
    }


     public function create()
    {
        $menus = Menu::all();
        return view('admin.contents.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'Required',
            'menu_id'=>'Required',
        ]);
		
		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'banner_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/article/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 700, 350);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }
		 

        $content = new Content;
        
        $content->title = $request->title;
        $content->content = $request->content;
		$content->title_bangla = $request->title_bangla;
        $content->content_bangla = $request->content_bangla;
        $content->menu_id = $request->menu_id;
		$content->image = $savedFileName;
        $content->created_at = date('Y-m-d H:i:s');
        $content->updated_at = date('Y-m-d H:i:s');
        $content->save();

        return redirect('administration/contents');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contentData = Content::find($id);
         $menus = Menu::all();
        $mid = $contentData->menu_id;
        $menuData = Menu::find($mid);
        return view('admin.contents.edit',compact('contentData', 'menus','menuData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'Required',
            'menu_id'=>'Required',
        ]);
		
		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'banner_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/article/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 700, 350);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }
		 

        $content = Content::find($id);
		
        $contentUpdate = array(
            'title'=>$request->title,
			'image'=>  $savedFileName,
            'content'=>$request->content,
			'title_bangla'=>$request->title_bangla,
			'content_bangla'=>$request->content_bangla,
            'menu_id'=>$request->menu_id,
            'updated_at'=>date('Y-m-d H:i:s')
        );
        $content->update($contentUpdate);

        return redirect('administration/contents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::find($id);
        $content->delete();
        return redirect('administration/contents');
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
