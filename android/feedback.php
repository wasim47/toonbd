<?php
include('config.php');
if(isset($_POST['status'])) {
    
    $status =$_POST['status'];
    $comments=$_POST['comment'];
    $username=$_POST['username'];
    $usermobile=$_POST['usermobile'];
	$userid=$_POST['userid'];
    $date=date('Y-m-d');
    
   
         $stmt = $db->prepare("INSERT INTO customer_query (user_id,username,contact,status ,message,date) VALUES(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $userid, $username, $usermobile, $status, $comments, $date);
            $result = $stmt->execute();
            
            if($result){
                 $data['action']="success";
                 echo json_encode($data);
            }

            $stmti->close();
    }
    else {
        $data['action']="failed";
        echo json_encode($data);
    }
?>