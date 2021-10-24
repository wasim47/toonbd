<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Administration;


class AdminController extends Controller
{
     public function __construct()
     {
	 	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $this->middleware('auth:administration');
     }


     public function dashboard(Request $request)
     {     
		
		
		
    	return view('admin.dashboard');
     }
	 
	 public function index(Request $request)
     {     
	 	$alladmins = Administration::all();
    	return view('admin.administration.index',compact('alladmins'));
     }
	 
	 
	  public function livechat(Request $request)
     {     
    	return view('admin.administration.livechat');
     }
	 
	 
	 
    public function create()
    {
        return view('admin.administration.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:administrations'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:administrations'],
            //'password' => ['required', 'string', 'min:6', 'confirmed'],
			'password' => ['required', 'string', 'min:6'],
        ]);
		
		
		if ($request->hasFile('userphoto')) {
            if($request->file('userphoto')->isValid()) {
                try {
                    $file = $request->file('userphoto');
                    $savedFileName = 'admin_'.time() . '.' . $file->getClientOriginalExtension();        
                    $request->file('userphoto')->move("uploads/admin/", $savedFileName);					
                } 
				catch (Illuminate\Filesystem\FileNotFoundException $e) {        
                }
            }
        }
        else{
            $savedFileName = '';
         }	
		 
		 
		if($request->userAccess!=""){
				$userAccess = $request->userAccess;
				$impaccess=implode(',',$userAccess);
		}
		else{
			$impaccess = '';
		}	
		

        $m = new Administration;
        
		$m->photo = $savedFileName;
		$m->fullname = $request->fullname;
		$m->username = $request->username;
		$m->email = $request->email;
		$m->contact = $request->contact;
		$m->designation = $request->designation;
		$m->password = Hash::make($request->password);
		$m->password_hints = $request->password;
		$m->status = 1;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/admins');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $admin = Administration::find($id);
        return view('admin.administration.edit',compact('admin'));
		
    }

    public function update(Request $request, $id)
    {
		//dd($id);
		 $this->validate($request, [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:administrations,username,'.$id.',id'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:administrations,email,'.$id.',id'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $admins = Administration::find($id);
        $menuUpdate = array(
			'fullname'=> $request->fullname,
			'username'=> $request->username,
			'email'=> $request->email,
			'contact'=> $request->contact,
			'designation'=> $request->designation,
			'password'=> Hash::make($request->password),
			'password_hints'=> $request->password,
			'status'=> 1,
			'created_at'=> date('Y-m-d H:i:s'),
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $admins->update($menuUpdate);
        return redirect('administration/admins');
    }

    public function destroy($id)
    {
        $menuItem = Administration::find($id);
        $menuItem->delete();
        return redirect('administration/admins');
    }
	
	
	
}
