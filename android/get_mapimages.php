<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/config.php';
$response['details'] = array();
	    
$sql="SELECT title,image FROM maps ORDER BY id DESC LIMIT 1";
if($stmt = $db->prepare($sql)){ 
	$stmt->execute(); 
	$stmt->bind_result($title,$image); 
	$result = $stmt->store_result();
	
	if($stmt->num_rows > 0) {
		$row = $stmt->fetch();         
		$data['image'] = $image;
		$data['title'] = $title;
		array_push($response['details'], $data);	
	}
	else{
		$data['msg'] = "No Data Found";
		array_push($response['details'], $data);
	}
}
else{
	var_dump($db->error);
}

echo json_encode($response);
?>