<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/config.php';
$response['details'] = array();
	
        $sql="SELECT company_name,address,contact,email,fcontact,bkash,facebook,twitter FROM company_info ORDER BY id DESC";
        $stmt=$db->prepare($sql);
        $stmt->execute(); 
        $stmt->bind_result($name,$address,$contact,$email,$fcontact,$bkash,$facebook,$twitter); 
        $result = $stmt->store_result();
        
        if($stmt->num_rows > 0) {
                $row = $stmt->fetch();         
    			$data['name'] = $name;
				$data['address'] = $address;
				$data['contact'] = $contact;
				$data['email'] = $email;
				$data['fcontact'] = $fcontact;
				$data['bkash'] = $bkash;
				$data['facebook'] = $facebook;
				$data['twitter'] = $twitter;
    			array_push($response['details'], $data);	
            
        }
    	else{
    		$data['msg'] = "No Data Found";
    		array_push($response['details'], $data);
    	}
 echo json_encode($response);
?>