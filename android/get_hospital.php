<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/config.php';
$response = array();
	
		$division = $_POST['division'];
		$district = $_POST['district'];
		$area = $_POST['area'];
		$bedtype = $_POST['bedtype'];
		$availability = $_POST['availability'];
		$status = 1;
		
		/////////////////////// If All vlaue are set ///////////////////////////////////////////
		if($availability!="Availability" && $division!="" && $district!="" && $area!="" && $bedtype!=""){
			
			$sqlIcu="SELECT hospital_id FROM icu_reports WHERE division_name = ? AND availability = ? AND icutype_val = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtIcu=$db->prepare($sqlIcu);
			$stmtIcu->bind_param('sss',$division,$availability,$bedtype);
			$stmtIcu->execute(); 
			$stmtIcu->bind_result($hospitalidIcu); 
			$resultIcu = $stmtIcu->store_result();			
			if($stmtIcu->num_rows > 0) { 
				while($rowIcu = $stmtIcu->fetch()) {       
					$getHosIdsICU[] = $hospitalidIcu;
				}
			}
			else{
				$getHosIdsICU[] = 0;
			}
			
			
			$sqlBed="SELECT hospital_id FROM bed_reports WHERE division_name = ? AND availability = ? AND bedtype_val = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtBed=$db->prepare($sqlBed);
			$stmtBed->bind_param('sss',$division,$availability,$bedtype);
			$stmtBed->execute(); 
			$stmtBed->bind_result($hospitalidBed); 
			$resultBed = $stmtBed->store_result();			
			if($stmtBed->num_rows > 0) { 
				while($rowBed = $stmtBed->fetch()) {       
					$getHosIdsBed[] = $hospitalidBed;
				}
			}
			else{
				$getHosIdsBed[] = 0;
			}

			$getCombineids = array_unique(array_merge($getHosIdsICU, $getHosIdsBed));
						
			$joinval = join(',',$getCombineids);
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,photo,updated_at FROM hospitals 
			WHERE status = ? AND area = ? AND zipcode = ? AND id IN($joinval) ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('iss',$status,$district,$area);
		}
		/////////////////////// If Bedtype vlaue is unset ///////////////////////////////////////////
		elseif($availability!="Availability" && $division!="" && $district!="" && $area!="" && $bedtype==""){
			$sqlIcu="SELECT hospital_id FROM icu_reports WHERE division_name = ? AND availability = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtIcu=$db->prepare($sqlIcu);
			$stmtIcu->bind_param('ss',$division,$availability);
			$stmtIcu->execute(); 
			$stmtIcu->bind_result($hospitalidIcu); 
			$resultIcu = $stmtIcu->store_result();			
			if($stmtIcu->num_rows > 0) { 
				while($rowIcu = $stmtIcu->fetch()) {       
					$getHosIdsICU[] = $hospitalidIcu;
				}
			}
			else{
				$getHosIdsICU[] = 0;
			}
			
			
			$sqlBed="SELECT hospital_id FROM bed_reports WHERE division_name = ? AND availability = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtBed=$db->prepare($sqlBed);
			$stmtBed->bind_param('ss',$division,$availability);
			$stmtBed->execute(); 
			$stmtBed->bind_result($hospitalidBed); 
			$resultBed = $stmtBed->store_result();			
			if($stmtBed->num_rows > 0) { 
				while($rowBed = $stmtBed->fetch()) {       
					$getHosIdsBed[] = $hospitalidBed;
				}
			}
			else{
				$getHosIdsBed[] = 0;
			}

			$getCombineids = array_unique(array_merge($getHosIdsICU, $getHosIdsBed));
						
			$joinval = join(',',$getCombineids);
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? AND area = ? AND zipcode = ? AND id IN($joinval) ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('iss',$status,$district,$area);
		}
		/////////////////////// If Bedtype,area vlaue are unset  ///////////////////////////////////////////
		elseif($availability!="Availability" && $division!="" && $district!="" && $area=="" && $bedtype==""){
			$sqlIcu="SELECT hospital_id FROM icu_reports WHERE division_name = ? AND availability = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtIcu=$db->prepare($sqlIcu);
			$stmtIcu->bind_param('ss',$division,$availability);
			$stmtIcu->execute(); 
			$stmtIcu->bind_result($hospitalidIcu); 
			$resultIcu = $stmtIcu->store_result();			
			if($stmtIcu->num_rows > 0) { 
				while($rowIcu = $stmtIcu->fetch()) {       
					$getHosIdsICU[] = $hospitalidIcu;
				}
			}
			else{
				$getHosIdsICU[] = 0;
			}
			
			
			$sqlBed="SELECT hospital_id FROM bed_reports WHERE division_name = ? AND availability = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtBed=$db->prepare($sqlBed);
			$stmtBed->bind_param('ss',$division,$availability);
			$stmtBed->execute(); 
			$stmtBed->bind_result($hospitalidBed); 
			$resultBed = $stmtBed->store_result();			
			if($stmtBed->num_rows > 0) { 
				while($rowBed = $stmtBed->fetch()) {       
					$getHosIdsBed[] = $hospitalidBed;
				}
			}
			else{
				$getHosIdsBed[] = 0;
			}

			$getCombineids = array_unique(array_merge($getHosIdsICU, $getHosIdsBed));
						
			$joinval = join(',',$getCombineids);
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? AND area = ? AND id IN($joinval) ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('is',$status,$district);
		}
		/////////////////////// If Bedtype,area, district vlaue are unset ///////////////////////////////////////////
		elseif($availability!="Availability" && $division!="" && $district=="" && $area=="" && $bedtype==""){
			$sqlIcu="SELECT hospital_id FROM icu_reports WHERE division_name = ? AND availability = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtIcu=$db->prepare($sqlIcu);
			$stmtIcu->bind_param('ss',$division,$availability);
			$stmtIcu->execute(); 
			$stmtIcu->bind_result($hospitalidIcu); 
			$resultIcu = $stmtIcu->store_result();			
			if($stmtIcu->num_rows > 0) { 
				while($rowIcu = $stmtIcu->fetch()) {       
					$getHosIdsICU[] = $hospitalidIcu;
				}
			}
			else{
				$getHosIdsICU[] = 0;
			}
			
			
			$sqlBed="SELECT hospital_id FROM bed_reports WHERE division_name = ? AND availability = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtBed=$db->prepare($sqlBed);
			$stmtBed->bind_param('ss',$division,$availability);
			$stmtBed->execute(); 
			$stmtBed->bind_result($hospitalidBed); 
			$resultBed = $stmtBed->store_result();			
			if($stmtBed->num_rows > 0) { 
				while($rowBed = $stmtBed->fetch()) {       
					$getHosIdsBed[] = $hospitalidBed;
				}
			}
			else{
				$getHosIdsBed[] = 0;
			}

			$getCombineids = array_unique(array_merge($getHosIdsICU, $getHosIdsBed));
						
			$joinval = join(',',$getCombineids);
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? AND id IN($joinval) ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('i',$status);
		}
		/////////////////////// If Availability is set ///////////////////////////////////////////
		/*elseif($availability!="Availability" && $division=="" && $district=="" && $area=="" && $bedtype==""){
			
			$sqlIcu="SELECT hospital_id FROM icu_reports WHERE availability = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtIcu=$db->prepare($sqlIcu);
			$stmtIcu->bind_param('s',$availability);
			$stmtIcu->execute(); 
			$stmtIcu->bind_result($hospitalidIcu); 
			$resultIcu = $stmtIcu->store_result();			
			if($stmtIcu->num_rows > 0) { 
				while($rowIcu = $stmtIcu->fetch()) {       
					$getHosIdsICU[] = $hospitalidIcu;
				}
			}
			else{
				$getHosIdsICU[] = 0;
			}
			
			
			$sqlBed="SELECT hospital_id FROM bed_reports WHERE availability = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtBed=$db->prepare($sqlBed);
			$stmtBed->bind_param('s',$availability);
			$stmtBed->execute(); 
			$stmtBed->bind_result($hospitalidBed); 
			$resultBed = $stmtBed->store_result();			
			if($stmtBed->num_rows > 0) { 
				while($rowBed = $stmtBed->fetch()) {       
					$getHosIdsBed[] = $hospitalidBed;
				}
			}
			else{
				$getHosIdsBed[] = 0;
			}

			$getCombineids = array_unique(array_merge($getHosIdsICU, $getHosIdsBed));
			print_r($getCombineids);
			$joinval = join(',',$getCombineids);
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? AND id IN($joinval) ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('i',$status);
		}	*/
		/////////////////////// If Availability and bedtype vlaue are set ///////////////////////////////////////////
		elseif($availability!="Availability" && $division=="" && $district=="" && $area=="" && $bedtype!=""){
			$sqlIcu="SELECT hospital_id FROM icu_reports WHERE availability = ? AND icutype_val = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtIcu=$db->prepare($sqlIcu);
			$stmtIcu->bind_param('ss',$availability,$bedtype);
			$stmtIcu->execute(); 
			$stmtIcu->bind_result($hospitalidIcu); 
			$resultIcu = $stmtIcu->store_result();			
			if($stmtIcu->num_rows > 0) { 
				while($rowIcu = $stmtIcu->fetch()) {       
					$getHosIdsICU[] = $hospitalidIcu;
				}
			}
			else{
				$getHosIdsICU[] = 0;
			}
			
			
			$sqlBed="SELECT hospital_id FROM bed_reports WHERE availability = ? AND bedtype_val = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtBed=$db->prepare($sqlBed);
			$stmtBed->bind_param('ss',$availability,$bedtype);
			$stmtBed->execute(); 
			$stmtBed->bind_result($hospitalidBed); 
			$resultBed = $stmtBed->store_result();			
			if($stmtBed->num_rows > 0) { 
				while($rowBed = $stmtBed->fetch()) {       
					$getHosIdsBed[] = $hospitalidBed;
				}
			}
			else{
				$getHosIdsBed[] = 0;
			}

			$getCombineids = array_unique(array_merge($getHosIdsICU, $getHosIdsBed));
						
			$joinval = join(',',$getCombineids);
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? AND id IN($joinval) ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('i',$status);
		}
		/////////////////////// If Availability, area and bedtype vlaue are set ///////////////////////////////////////////
		elseif($availability!="Availability" && $division=="" && $district=="" && $area!="" && $bedtype!=""){
			$sqlIcu="SELECT hospital_id FROM icu_reports WHERE availability = ? AND icutype_val = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtIcu=$db->prepare($sqlIcu);
			$stmtIcu->bind_param('ss',$availability,$bedtype);
			$stmtIcu->execute(); 
			$stmtIcu->bind_result($hospitalidIcu); 
			$resultIcu = $stmtIcu->store_result();			
			if($stmtIcu->num_rows > 0) { 
				while($rowIcu = $stmtIcu->fetch()) {       
					$getHosIdsICU[] = $hospitalidIcu;
				}
			}
			else{
				$getHosIdsICU[] = 0;
			}
			
			
			$sqlBed="SELECT hospital_id FROM bed_reports WHERE availability = ? AND bedtype_val = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtBed=$db->prepare($sqlBed);
			$stmtBed->bind_param('ss',$availability,$bedtype);
			$stmtBed->execute(); 
			$stmtBed->bind_result($hospitalidBed); 
			$resultBed = $stmtBed->store_result();			
			if($stmtBed->num_rows > 0) { 
				while($rowBed = $stmtBed->fetch()) {       
					$getHosIdsBed[] = $hospitalidBed;
				}
			}
			else{
				$getHosIdsBed[] = 0;
			}

			$getCombineids = array_unique(array_merge($getHosIdsICU, $getHosIdsBed));
						
			$joinval = join(',',$getCombineids);
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? AND zipcode = ? AND id IN($joinval) ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('is',$status,$area);
		}
		/////////////////////// If Availability, area, district and bedtype vlaue are set ///////////////////////////////////////////
		elseif($availability!="Availability" && $division=="" && $district!="" && $area!="" && $bedtype!=""){
			$sqlIcu="SELECT hospital_id FROM icu_reports WHERE availability = ? AND icutype_val = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtIcu=$db->prepare($sqlIcu);
			$stmtIcu->bind_param('ss',$availability,$bedtype);
			$stmtIcu->execute(); 
			$stmtIcu->bind_result($hospitalidIcu); 
			$resultIcu = $stmtIcu->store_result();			
			if($stmtIcu->num_rows > 0) { 
				while($rowIcu = $stmtIcu->fetch()) {       
					$getHosIdsICU[] = $hospitalidIcu;
				}
			}
			else{
				$getHosIdsICU[] = 0;
			}
			
			
			$sqlBed="SELECT hospital_id FROM bed_reports WHERE availability = ? AND bedtype_val = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtBed=$db->prepare($sqlBed);
			$stmtBed->bind_param('ss',$availability,$bedtype);
			$stmtBed->execute(); 
			$stmtBed->bind_result($hospitalidBed); 
			$resultBed = $stmtBed->store_result();			
			if($stmtBed->num_rows > 0) { 
				while($rowBed = $stmtBed->fetch()) {       
					$getHosIdsBed[] = $hospitalidBed;
				}
			}
			else{
				$getHosIdsBed[] = 0;
			}

			$getCombineids = array_unique(array_merge($getHosIdsICU, $getHosIdsBed));
						
			$joinval = join(',',$getCombineids);
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? AND area = ? AND zipcode = ? AND id IN($joinval) ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('iss',$status,$district,$area);
		}
		/////////////////////// If Availability, division vlaue are set ///////////////////////////////////////////
		elseif($availability!="Availability" && $division!="" && $district=="" && $area=="" && $bedtype==""){
			$sqlIcu="SELECT hospital_id FROM icu_reports WHERE division_name = ? AND availability = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtIcu=$db->prepare($sqlIcu);
			$stmtIcu->bind_param('ss',$division,$availability);
			$stmtIcu->execute(); 
			$stmtIcu->bind_result($hospitalidIcu); 
			$resultIcu = $stmtIcu->store_result();			
			if($stmtIcu->num_rows > 0) { 
				while($rowIcu = $stmtIcu->fetch()) {       
					$getHosIdsICU[] = $hospitalidIcu;
				}
			}
			else{
				$getHosIdsICU[] = 0;
			}
			
			
			$sqlBed="SELECT hospital_id FROM bed_reports WHERE division_name = ? AND availability = ? GROUP BY hospital_id ORDER BY id DESC";
			$stmtBed=$db->prepare($sqlBed);
			$stmtBed->bind_param('ss',$division,$availability);
			$stmtBed->execute(); 
			$stmtBed->bind_result($hospitalidBed); 
			$resultBed = $stmtBed->store_result();			
			if($stmtBed->num_rows > 0) { 
				while($rowBed = $stmtBed->fetch()) {       
					$getHosIdsBed[] = $hospitalidBed;
				}
			}
			else{
				$getHosIdsBed[] = 0;
			}

			$getCombineids = array_unique(array_merge($getHosIdsICU, $getHosIdsBed));
						
			$joinval = join(',',$getCombineids);
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? AND id IN($joinval) ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('i',$status);
		}	
		/////////////////////// If division vlaue are set ///////////////////////////////////////////
		elseif($availability=="Availability" && $division!="" && $district=="" && $area=="" && $bedtype==""){
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? AND division_name = ? ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('is',$status, $division);
		}
		/////////////////////// If division adn district vlaue are set ///////////////////////////////////////////
		elseif($availability=="Availability" && $division!="" && $district!="" && $area=="" && $bedtype==""){
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? AND division_name = ? AND area = ? ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('iss',$status, $division, $district);
		}
		/////////////////////// If division adn district , area vlaue are set ///////////////////////////////////////////
		elseif($availability=="Availability" && $division!="" && $district!="" && $area!="" && $bedtype==""){
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? AND division_name = ? AND area = ?  AND zipcode = ? ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('isss',$status, $division, $district, $area);
		}
		elseif($availability=="Availability" && $division=="" && $district=="" && $area=="" && $bedtype==""){
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('i',$status);
		}
		else{		
			$sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,division_name,area,zipcode,hospital_type,photo,updated_at FROM hospitals 
			WHERE status = ? ORDER BY id DESC";
			$stmt=$db->prepare($sql);
			$stmt->bind_param('i',$status); 
		}
			
		  
       
        $stmt->execute(); 
        $stmt->bind_result($id,$name,$cperson,$contact,$cpnumber,$email,$address,$country,$city,$division_name,$area,$zipcode,$hospitaltype,$photo,$updated_at); 
        $result = $stmt->store_result();
        
        if($stmt->num_rows > 0) { 
			while($row = $stmt->fetch()) {       
				$data['id'] = $id;
				$data['name'] = $name;
				$data['cperson'] = $cperson;
				$data['contact'] = $contact;
				$data['cpnumber'] = $cpnumber;
				$data['email'] = $email;
				$data['address'] = $address;
				$data['country'] = $country;
				$data['city'] = $city;
				$data['division_name'] = $division_name;
				$data['area'] = $area;
				$data['photo'] = $photo;
				$data['zipcode'] = $zipcode;
				$data['hospitaltype'] = $hospitaltype;
				$data['updated_at'] = $updated_at;
				array_push($response, $data);
			}
			 echo json_encode($response);	            
        }
    	else{
    		$data['msg'] = "No Data Found";
    		//array_push($response, $data);
			echo '0';
    	}

 //echo json_encode($response);
?>