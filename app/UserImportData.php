<?php
namespace App;
  
use App\Hospital;
use App\HospitalUser;
use App\Icutype;
use DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImportData implements ToModel
{
	public function model(array $row)
    {
        $hospitaldata = array(
            'fullname' => $row[0],
            'email'    => $row[1], 
			'contact_person'   => $row[2], 
			'contact'    => $row[3], 
			'contact_person_number'   => $row[4], 
			'address'    => $row[5], 
			'country'    => $row[6], 
			'city'    => $row[7], 
			'area'    => $row[8], 
			'zipcode'    => $row[9], 
			'status'    => 1, 
			'hospital_type'    => 'Private', 
			'usertype'    => 'Management', 
			'password_hints'   => '123456', 
            'password' => Hash::make('123456'),			
			'created_at'    => date('Y-m-d H:i:s'), 
			'updated_at'    => date('Y-m-d H:i:s')			
        );
		//dd($hospitaldata);
		Hospital::insert($hospitaldata);
		$hospitalid = DB::getPdo()->lastInsertId();
		
		$hospitaluserdata = array(
            'hospital_id' => $hospitalid,
			'fullname' => $row[0],
            'email'    => $row[1], 
			'contact'    => $row[3], 
			'address'    => $row[5], 
			'division_id'    => $row[7], 
			'status'    => 1, 
			'usertype'    => 'Management', 
			'password_hints'   => '123456', 
            'password' => Hash::make('123456'),			
			'created_at'    => date('Y-m-d H:i:s'), 
			'updated_at'    => date('Y-m-d H:i:s')			
        );		
		
		HospitalUser::insert($hospitaluserdata);
		
		
		$icutype = Icutype::where('type','ICU')->orderBy('name','ASC')->get();
		
		foreach($icutype as $val){
			$arrayicu = array(
				'hospital_id' =>  $hospitalid,
				'division_id' => $row[7],
				'type' =>  'ICU',
				'bedtype' =>  $val->id,
				'totaldata' =>  0,
				'available_data' =>  0,
				'inpatient_data' =>  0,
				'diseases' =>  'COVID-19',
				'availability' =>  'Not Available',
				'date' =>  date('Y-m-d'),
			);
			IcuInformation::insert($arrayicu);
		}
		
		$bedype = Icutype::where('type','Bed')->orderBy('name','ASC')->get();
		foreach($bedype as $val){
			$arrayicu = array(
				'hospital_id' =>  $hospitalid,
				'division_id' => $row[7],
				'type' =>  'Bed',
				'bedtype' =>  $val->id,
				'totaldata' =>  0,
				'available_data' =>  0,
				'inpatient_data' =>  0,
				'diseases' =>  'COVID-19',
				'availability' =>  'Not Available',
				'date' =>  date('Y-m-d'),
			);
			IcuInformation::insert($arrayicu);
		}
    }
}
