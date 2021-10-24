<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/config.php';
$response['details'] = array();
	if(isset($_POST['hospital_id']) && isset($_POST['icutype_id'])){
	     $hospitalid = $_POST['hospital_id'];
		 $icutypeid = $_POST['icutype_id'];	    
		 
        $sql="SELECT availability FROM icu_reports WHERE hospital_id = ? AND icutype = ? ORDER BY id DESC";
        if($stmt = $db->prepare($sql)){
			//$stmt = $db->prepare($sql);
			$stmt->bind_param('ss', $hospitalid, $icutypeid); 
			$stmt->execute(); 
			$stmt->bind_result($availability); 
			$result = $stmt->store_result();
			
			if($stmt->num_rows > 0) { 
				$row = $stmt->fetch();
				//while($row = $stmt->fetch()) {  
					$data['availability'] = $availability;
					array_push($response['details'], $data);
					$stmt->close();
				//}	            
			}
			else{
				$data['msg'] = "No Data Found";
				array_push($response['details'], $data);
			}
		}
		else{
		    var_dump($db->error);
		}
	}
	else{
		$data['msg'] = "No Data Found";
		array_push($response['details'], $data);
	}
 echo json_encode($response);
?>