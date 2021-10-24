<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Auth;
use DB;
use App\Administration;
use Redirect;

class CommonController extends Controller
{
   public function deletedata(Request $req)
    {
	    $id = $req->id;
		$deletetype = $req->deletetype;
		$deleteimage = $req->deleteimage;
		$tablename = $req->tablename;

		if($deletetype=='single'){
			//$menuItem = Administration::find($id)->delete();
			DB::table($tablename)->where('id', $id)->delete();
		}
		elseif($deletetype=='multiple'){
			//$menuItem = Administration::whereIn('id', $id)->delete();
			DB::table($tablename)->whereIn('id', $id)->delete();
		}
		 return $id;
    }


	public function permissionsHospital(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		
		$status = $req->status;

		 $arrayuval =  array(
			'status'=>$status
		);
		$updval = DB::table('hospitals')->whereIn('id', $valuearray)->update($arrayuval);
		$updval1 = DB::table('hospital_users')->whereIn('hospital_id', $valuearray)->update($arrayuval);

         return Redirect::back();
    }
	
	
	public function permissions(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		//dd($valuearray);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'status'=>$status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

         return Redirect::back();
    }
	public function adminPermissions(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		//dd($valuearray);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'active'=>$status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

         return Redirect::back();
    }



	public function changestatus(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'member_type'=>$status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

         return Redirect::back();
    }


	public function codeGeneration()
    {
		$token = $this->getToken(5);
        $codes = 'ToonBD'.$token;
		return $codes;
    }
	
	private function getToken($length){    
        $token = "";
        $codeAlphabet = "abcdefghijklmnopqrstuvwxyx";
        $codeAlphabet.= "0123456789";

	   mt_srand(time());
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;
    }
	
	
	
	public function updateSlug(Request $req)
    {
		//////////////// Update Slug /////////////////
		
		/*$allDatas = DB::table('hospitals')->whereNull('email')->get();
		$i=0;
		foreach($allDatas as $datas){
			$i++;
			$makeemail = 'bd-icu'.$i.'@bd-icu.com';
			//echo $makeemail;
			//$arrayvals = array('email'=>$makeemail);
			$arrayvals = array('email'=>$makeemail);
			DB::table('hospitals')->where('id', $datas->id)->update($arrayvals);
			DB::table('hospital_users')->where('hospital_id', $datas->id)->update($arrayvals);
		}*/		
		
		/*$allDatas = DB::table('icutypes')->get();
		$i=0;
		foreach($allDatas as $datas){
			$i++;
			$icuvals = array('icutype_val'=>$datas->name);
			$bedyvals = array('bedtype_val'=>$datas->name);
			
			DB::table('icu_reports')->where('icutype', $datas->id)->update($icuvals);
			DB::table('bed_reports')->where('bedtype', $datas->id)->update($bedyvals);
		}*/
		
		$getDatas = DB::table('news_events')->get();		
		foreach($getDatas as $gData){
			$expval=explode(' ',$gData->name);
			$impval=implode('-',$expval);
			$slug   = str_replace([',', "'",'"', '/','|','.','`'],'' , $impval);
			
			 $menuUpdate = array(
				'url'=> strtolower($slug),
				'updated_at'=> date('Y-m-d H:i:s')
			 );
	
			DB::table('news_events')->where('id',$gData->id)->update($menuUpdate);		
		}
		
		/*$allDatas = DB::table('divisions')->get();
		$i=0;
		foreach($allDatas as $datas){
			$i++;
			$icuvals = array('division_id'=>$datas->name);
			
			DB::table('icu_reports')->where('division_id', $datas->id)->update($icuvals);
			DB::table('bed_reports')->where('division_id', $datas->id)->update($icuvals);
		}*/
	}
	
	/*public function updateSlug()
	{
		$getDatas = DB::table('gift_card_groups')->get();		
		foreach($getDatas as $gData){
			$expval=explode(' ',$gData->name);
			$impval=implode('-',$expval);
			$slug   = str_replace([',', "'",'"', '/','|','.','`'],'' , $impval);
			
			 $menuUpdate = array(
				'slug'=> $slug
				'updated_at'=> date('Y-m-d H:i:s')
			 );
	
			DB::table('gift_card_groups')->where('id',$gData->id)->update($menuUpdate);		
		}
	}*/

}
