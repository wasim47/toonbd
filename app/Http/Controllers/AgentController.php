<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Agent;
use Validator;
use Image;


class AgentController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allagent = Agent::orderBy('id','desc')->get();
    	return view('admin.agent.index',compact('allagent'));
     }


    public function create()
    {
        return view('admin.agent.create');
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255'],
			 'contact' => ['required', 'string', 'max:255']
		]);


		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'agent_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/agent/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 450, 450);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }
		 
		 if ($request->hasFile('license_file')) {
            if($request->file('license_file')->isValid()) {
                try {
                    $file = $request->file('license_file');
                    $savedLicenseFileName = 'license_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/agent/license/'.$savedLicenseFileName;
          			$this->imageResize($file,$pathLarge,$savedLicenseFileName, 800, null);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedLicenseFileName = '';
         }


        $m = new Agent;
		$m->name = $request->name;
		$m->image = $savedFileName;
		$m->license_file = $savedLicenseFileName;
		$m->address = $request->address;
		$m->nid = $request->nid;
		$m->birth_certificate = $request->birth_certificate;
		$m->mobile = $request->contact;
		$m->email = $request->email;
		$m->passport = $request->passport;
		$m->afacode = $request->afacode;
		$m->license_no = $request->license_no;
		$m->license_issue_date = $request->license_issue_date;
		$m->license_deadline = $request->license_deadline;
		$m->work_area = $request->work_area;
		$m->status = $request->status;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/agent');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $agent = Agent::find($id);
        return view('admin.agent.edit',compact('agent'));

    }

    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255'],
			 'contact' => ['required', 'string', 'max:255']
		]);


		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'agent_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/agent/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 450, 450);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }
		 
		  if ($request->hasFile('license_file')) {
            if($request->file('license_file')->isValid()) {
                try {
                    $file = $request->file('license_file');
                    $savedLicenseFileName = 'license_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/agent/license/'.$savedLicenseFileName;
          			$this->imageResize($file,$pathLarge,$savedLicenseFileName, 800, null);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedLicenseFileName = $request->stilllicense;
         }
		 

        $agent = Agent::find($id);
        $menuUpdate = array(
			'name'=>  $request->name,
			'mobile'=>  $request->contact,
			'email'=>  $request->email,
			'image'=>  $savedFileName,
			'license_file'=> $savedLicenseFileName,
			'address'=> $request->address,
			'nid'=> $request->nid,
			'birth_certificate'=> $request->birth_certificate,
			'mobile'=> $request->contact,
			'email'=> $request->email,
			'passport'=> $request->passport,
			'afacode'=> $request->afacode,
			'license_no'=> $request->license_no,
			'license_issue_date'=> $request->license_issue_date,
			'license_deadline'=> $request->license_deadline,
			'work_area'=> $request->work_area,
			'status'=>  $request->status,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $agent->update($menuUpdate);
        return redirect('administration/agent');
    }

    public function destroy($id)
    {
        $menuItem = Agent::find($id);
        $menuItem->delete();
        return redirect('administration/agent');
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
