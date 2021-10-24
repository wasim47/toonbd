<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/config.php';
$response = array();

    $sql="SELECT id,title FROM menus ORDER BY id ASC";
    $stmt=$db->prepare($sql);
    $stmt->execute(); 
    $stmt->bind_result($id,$name);
    $result = $stmt->store_result();
    if($stmt->num_rows > 0) {
        while($row = $stmt->fetch()) {
			$data['id']=$id;
            $data['name']=$name;
			array_push($response, $data);	
        }
    }
	else{
		$data['msg'] = "No Data Found";
		array_push($response, $data);
	}


 echo json_encode($response);
?>