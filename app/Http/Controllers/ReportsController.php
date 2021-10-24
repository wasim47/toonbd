<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Hash;
use App\Report;
use App\Menu;
use Validator;
use Image;


class ReportsController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allreport = Report::orderBy('id','desc')->get();
    	return view('admin.report.index',compact('allreport'));
     }


    public function create()
    {
		$allmenu = Menu::where('page_structure','report')->orderBy('id','desc')->get();
        return view('admin.report.create',compact('allmenu'));
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255'],
             'pdffile' => ['required|image']
		]);

		if ($request->hasFile('pdffile')) {
            if($request->file('pdffile')->isValid()) {
                try {
                   $file = $request->file('pdffile');
                    $savedFileName = 'pdffile'.time() . '.' . $file->getClientOriginalExtension();
                    $request->file('pdffile')->move("uploads/report/", $savedFileName);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


        $m = new Report;
		$m->name = $request->name;
		$m->menu_id = $request->menu_id;
		$m->files = $savedFileName;
		$m->years = $request->years;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/report');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $report = Report::find($id);
		$allmenu = Menu::where('page_structure','report')->orderBy('id','desc')->get();
        return view('admin.report.edit',compact('report','allmenu'));

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
                    $savedFileName = 'report_'.time() . '.' . $file->getClientOriginalExtension();    

					$pathLarge = 'uploads/report/'.$savedFileName;
          			$this->imageResize($file,$pathLarge,$savedFileName, 1500, 300);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


        $report = Report::find($id);
        $menuUpdate = array(
			'name'=>  $request->name,
			'url'=>  $request->url,
			'image'=>  $savedFileName,
			'sequence'=>  $request->sequence,
			'status'=>  $request->status,
			'meta_details'=>  $request->meta_details,
			'keywords'=>  $request->keywords,
			'updated_at'=> date('Y-m-d H:i:s')
		 );

        $report->update($menuUpdate);
        return redirect('administration/report');
    }

    public function destroy($id)
    {
        $menuItem = Report::find($id);
        $menuItem->delete();
        return redirect('administration/report');
    }

}
