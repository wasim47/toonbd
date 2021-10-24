<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/config.php';
$response['details'] = array();

    $sql="SELECT id,name,details FROM icutypes ORDER BY name ASC";
    $stmt=$db->prepare($sql);
    $stmt->execute(); 
    $stmt->bind_result($id,$name,$details);
    $result = $stmt->store_result();
    if($stmt->num_rows > 0) {
        $data['totalitems']=$stmt->num_rows;
        while($row = $stmt->fetch()) {
			$data['id']=$id;
            $data['name']=$name;
			$data['details']=$details;
			array_push($response['details'], $data);	
        }
    }
	else{
		$data['msg'] = "No Data Found";
		array_push($response['details'], $data);
	}


 echo json_encode($response);
?>