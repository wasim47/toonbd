<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Auth;
use DB;

class MenusController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('id','DESC')->get();
        return view('admin.menus.index',compact('menus'));
    }

    public function create()
    {
		$menus = Menu::where('parent_id',NULL)->get();
        return view('admin.menus.create',compact('menus'));
    }

  
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'Required'
        ]);

		$expval=explode(' ',$request->title);
		$impval=implode('-',$expval);
		$slug = str_replace([',', "'",'"', '/','|','.','`','%','#','"','?'],'' , strtolower($impval));
		
        $m = new Menu;
        
        $m->uri = $slug;
		$m->title = $request->title;
		$m->parent_id = $request->parent_id;
		$m->sparent_id = $request->sparent_id;
		$m->page_structure = $request->page_structure;
		//$m->title_bangla = $request->title_bangla;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/menus');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $menu = Menu::find($id);
		$menus = Menu::where('parent_id',NULL)->get();
        return view('admin.menus.edit',compact('menu','menus'));
    }

  
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'Required'
        ]);

		
        $menu = Menu::find($id);
        $expval=explode(' ',$request->title);
		$impval=implode('-',$expval);
		$slug = str_replace([',', "'",'"', '/','|','.','`','%','#','"','?'],'' , strtolower($impval));
		
        $menuUpdate = array(
			'parent_id'=>$request->parent_id,
			'page_structure'=>$request->page_structure,
			'title'=>$request->title,
			//'title_bangla'=>$request->title_bangla,
            'uri'=>$slug
        );
		
		//dd($menuUpdate);
        $menu->update($menuUpdate);
         return redirect('administration/menus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menuItem = Menu::find($id);
        $menuItem->delete();
        return redirect('administration/menus');
    }
	
	public function searchmenu(Request $req)
    {
		if($req->colid!="")
		{
			$id=$req->colid;
			
			$searchresults = Menu::where('parent_id', $id)->where('sparent_id', NULL)->orderBy('title','asc')->get();		
				$displayvar = '<select name="sparent_id" class="form-control">';
				$displayvar .= '<option value="">Select Sub Parent</option>';
    							   foreach($searchresults as $rows):
    									$displayvar .='<option value="'.$rows->uri.'">'.$rows->title.'</option>';
    								endforeach;
    			$displayvar .= '</select>';
    			echo $displayvar;
		}
		else{
			echo "Null";
		}
    }
}
