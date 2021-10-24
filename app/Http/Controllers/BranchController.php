<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\BrancheDivision;
use App\Branch;
use Validator;
use Image;


class BranchController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allbranch = Branch::orderBy('id','desc')->get();
    	return view('admin.branch.index',compact('allbranch'));
     }


    public function create()
    {
		$branchdivision = BrancheDivision::orderBy('id','asc')->get();
        return view('admin.branch.create',compact('branchdivision'));
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255'],
			 'division_id' => ['required'],
             'incharge' => ['required', 'string', 'max:255'],
			 'contact' => ['required', 'string', 'max:255'],
			 'address' => ['required', 'string', 'max:255']
		]);

		//dd($request->all());
        $m = new Branch;
		$m->division_id = $request->division_id;
		$m->name = $request->name;
		$m->incharge = $request->incharge;
		$m->address = $request->address;
		$m->contact = $request->contact;
		$m->status = $request->status;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/branch');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $branch = Branch::find($id);
		$selecteddivisoin = BrancheDivision::where('id',$branch->division_id)->first();
		
		$branchdivision = BrancheDivision::orderBy('id','asc')->get();
        return view('admin.branch.edit',compact('branch','branchdivision','selecteddivisoin'));

    }

    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255'],
			 'division_id' => ['required'],
             'incharge' => ['required', 'string', 'max:255'],
			 'contact' => ['required', 'string', 'max:255'],
			 'address' => ['required', 'string', 'max:255']
		]);

        $branch = Branch::find($id);
        $menuUpdate = array(
			'division_id'=>  $request->division_id,
			'name'=>  $request->name,
			'incharge'=>  $request->incharge,
			'address'=>  $request->address,
			'contact'=>  $request->contact,
			'status'=>  $request->status,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $branch->update($menuUpdate);
        return redirect('administration/branch');
    }

    public function destroy($id)
    {
        $menuItem = Branch::find($id);
        $menuItem->delete();
        return redirect('administration/branch');
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
