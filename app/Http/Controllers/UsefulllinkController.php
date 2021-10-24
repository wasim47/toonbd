<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usefulllink;
use DB;
use Image;
use Hash;

class UsefulllinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administration');
    }
    public function index()
    {
        $usefulllink = Usefulllink::orderBy('id','DESC')->paginate(50);
        return view('admin.usefulllink.index', compact('usefulllink'));
    }



    public function create()
    {
        return view('admin.usefulllink.create');
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
			'links'=>'required|max:255',
        ]);
		
		$usefulllink['name'] = $request->name;
		$usefulllink['links'] = $request->links;
        $insertdata = Usefulllink::create($usefulllink);		
        return redirect('administration/usefulllink');
    }

   
   
    public function show($id)
    {
        $usefulllinkinfo = Usefulllink::find($id);
		return view('admin.usefulllink.details',compact('usefulllinkinfo'));
    }

   
    public function edit($id)
    {
        $usefulllinkinfo = Usefulllink::find($id);
		return view('admin.usefulllink.edit',compact('usefulllinkinfo'));
    }

   
    public function update(Request $request, $id)
    {
		 $this->validate($request, [
			'links'=>'required|max:255',
        ]);

		$menu = Usefulllink::find($id);
		$usefulllink['name'] = $request->name;
		$usefulllink['links'] = $request->links;
		
        $menu->update($usefulllink);
        return redirect('administration/usefulllink');
    }

    public function destroy($id)
    {
        $menuItem = Usefulllink::find($id);
        $menuItem->delete();
        return redirect('administration/usefulllink');
    }
}
