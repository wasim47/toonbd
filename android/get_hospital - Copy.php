<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/config.php';
$response = array();
	
	    $id = 1;	    
        $sql="SELECT id,fullname,contact_person,contact,contact_person_number,email,address,country,city,area,zipcode,hospital_type,updated_at FROM hospitals WHERE status = ? ORDER BY id DESC";
        $stmt=$db->prepare($sql);
        $stmt->bind_param('i',$id); 
        $stmt->execute(); 
        $stmt->bind_result($id,$name,$cperson,$contact,$cpnumber,$email,$address,$country,$city,$area,$zipcode,$hospitaltype,$updated_at); 
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
				$data['area'] = $area;
				$data['zipcode'] = $zipcode;
				$data['hospitaltype'] = $hospitaltype;
				$data['updated_at'] = $updated_at;
				array_push($response, $data);
			}	            
        }
    	else{
    		$data['msg'] = "No Data Found";
    		array_push($response, $data);
    	}

 echo json_encode($response);
?>