<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Counter;
use Validator;
use Image;


class CounterController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allcounter = Counter::orderBy('id','desc')->get();
    	return view('admin.counter.index',compact('allcounter'));
     }


    public function create()
    {
        return view('admin.counter.create');
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255'],
             'totals' => ['required']
		]);


        $m = new Counter;
		$m->name = $request->name;
		$m->totals = $request->totals;
		$m->sequence = $request->sequence;
		$m->status = $request->status;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/counter');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $counter = Counter::find($id);
        return view('admin.counter.edit',compact('counter'));

    }

    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255'],
       		 'totals' => ['required']
		]);

        $counter = Counter::find($id);
        $menuUpdate = array(
			'name'=>  $request->name,
			'totals'=>  $request->totals,
			'sequence'=>  $request->sequence,
			'status'=>  $request->status,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $counter->update($menuUpdate);
        return redirect('administration/counter');
    }

    public function destroy($id)
    {
        $menuItem = Counter::find($id);
        $menuItem->delete();
        return redirect('administration/counter');
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
