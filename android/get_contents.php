<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/config.php';
$response['details'] = array();
	
	if(isset($_POST['menu']) && $_POST['menu']!=""){
	    $id = $_POST['menu'];
	    
        $sql="SELECT title,content FROM contents WHERE menu_id = ? ORDER BY id DESC";
        $stmt=$db->prepare($sql);
        $stmt->bind_param('i',$id); 
        $stmt->execute(); 
        $stmt->bind_result($title,$content); 
        $result = $stmt->store_result();
        
        if($stmt->num_rows > 0) {
                $row = $stmt->fetch();         
    			$data['content'] = $content;
    			$data['title'] = $title;
    			array_push($response['details'], $data);	
            
        }
    	else{
    		$data['msg'] = "No Data Found";
    		array_push($response['details'], $data);
    	}
	}
	else{
    		$data['msg'] = "No Data Found";
    		array_push($response['details'], $data);
    	}
 echo json_encode($response);
?>