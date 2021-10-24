<?php
include('config.php');
if(isset($_POST['name']) && isset($_POST['comments'])) {
    
    $name =$_POST['name'];
    $mobile=$_POST['mobile'];
    $country=$_POST['country'];
    $email=$_POST['email'];
    $comments=$_POST['message'];
    $date=date('Y-m-d');
    
   
         $stmt = $db->prepare("INSERT INTO customer_query (username ,email,contact, country,message,date) VALUES(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $name, $email, $mobile, $country, $comments, $date);
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