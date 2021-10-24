<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BrancheDivision;
use DB;
use Image;
use Hash;

class BranchdivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administration');
    }
    public function index()
    {
        $branch_division = BrancheDivision::orderBy('id','DESC')->get();
        return view('admin.branch_division.index', compact('branch_division'));
    }



    public function create()
    {
        return view('admin.branch_division.create');
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
			'name'=>'required|max:255',
        ]);
		
		$branch_division['name'] = $request->name;
        $insertdata = BrancheDivision::create($branch_division);		
        return redirect('administration/branch_division');
    }

   
   
    public function show($id)
    {
        $branch_divisioninfo = BrancheDivision::find($id);
		return view('admin.branch_division.details',compact('branch_divisioninfo'));
    }

   
    public function edit($id)
    {
        $branch_divisioninfo = BrancheDivision::find($id);
		return view('admin.branch_division.edit',compact('branch_divisioninfo'));
    }

   
    public function update(Request $request, $id)
    {
		 $this->validate($request, [
			'name'=>'required|max:255',
        ]);

		$menu = BrancheDivision::find($id);
		$branch_division['name'] = $request->name;
		
        $menu->update($branch_division);
        return redirect('administration/branch_division');
    }

    public function destroy($id)
    {
        $menuItem = BrancheDivision::find($id);
        $menuItem->delete();
        return redirect('administration/branch_division');
    }
}
