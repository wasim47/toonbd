<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoGallery;
use App\Menu;
use DB;
use Image;

class VideoController extends Controller
{	
	public function __construct()
    {
    	$this->middleware('auth:administration');
    }
	
	 	
   public function index()
    {
        $video = VideoGallery::orderBy('id','DESC')->paginate(50);
        return view('admin.video.index',compact('video'));
    }


     public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'video_title'=>'Required'
        ]);		
			 
		 if ($request->hasFile('cover')) {
			if($request->file('cover')->isValid()) {
				try {
					$file = $request->file('cover');
					$savedFileName = 'video_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/video/'.$savedFileName;
					$this->imageResize($file,$pathLarge,$savedFileName, 700, 350);

				} catch (Illuminate\Filesystem\FileNotFoundException $e) {
			  }
			}
		}
		else{
			$savedFileName = '';
		 }
		 
			 
        $content = new VideoGallery;        
        $content->video_title = $request->video_title;		
		$content->video_ref = $request->videos;
		$content->cover = $savedFileName;
        $content->created_at = date('Y-m-d H:i:s');
        $content->updated_at = date('Y-m-d H:i:s');
        $content->save();

        return redirect('administration/video');
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
        $contentData = VideoGallery::find($id);
        return view('admin.video.edit',compact('contentData'));
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
            'video_title'=>'Required',
        ]);

				 if ($request->hasFile('cover')) {
			if($request->file('cover')->isValid()) {
				try {
					$file = $request->file('cover');
					$savedFileName = 'video_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/video/'.$savedFileName;
					$this->imageResize($file,$pathLarge,$savedFileName, 700, 350);

				} catch (Illuminate\Filesystem\FileNotFoundException $e) {
			  }
			}
		}
		else{
			$savedFileName = $request->stillcover;
		 }

        $content = VideoGallery::find($id);

        $contentUpdate = array(
            'video_title'=>$request->video_title,
			'cover'=>$savedFileName,
			'video_ref'=>$request->videos,
            'updated_at'=>date('Y-m-d H:i:s')
        );
        $content->update($contentUpdate);

        return redirect('administration/video');
    }
	
	
    public function destroy($id)
    {
        $content = VideoGallery::find($id);
        $content->delete();
        return redirect('/administration/video');
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
