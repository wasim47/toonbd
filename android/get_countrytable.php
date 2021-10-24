<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/config.php';
$response = array();

    $sql="SELECT id,name FROM divisions ORDER BY id ASC";
    $stmt=$db->prepare($sql);
    $stmt->execute(); 
    $stmt->bind_result($id,$name);
    $result = $stmt->store_result();
    if($stmt->num_rows > 0) {
        while($row = $stmt->fetch()) {
			
			$sqlIcu="SELECT COUNT(*) AS totalICUData, SUM(totalicu) AS totalICU, SUM(today_icu_patient) AS totalICUPatient, SUM(icu_patient_inpercentage) AS totalICUPatPer 
			FROM icu_reports WHERE division_id = ? ORDER BY id ASC";
			$stmtIcu=$db->prepare($sqlIcu);
			$stmtIcu->bind_param('i', $id); 
			$stmtIcu->execute(); 
			$stmtIcu->bind_result($totalICUData, $totalICU, $totalICUPatient, $totalICUPatPer);
			$resultIcu = $stmtIcu->store_result();
			$rowIcu = $stmtIcu->fetch();
			
			
			$sqlBed="SELECT COUNT(*) AS totalBedData, SUM(totalbed) AS totalBed, SUM(today_bed_patient) AS totalBedPatient, SUM(bed_patient_inpercentage) AS totalBedPatPer 
			FROM bed_reports WHERE division_id = ? ORDER BY id ASC";
			$stmtBed=$db->prepare($sqlBed);
			$stmtBed->bind_param('i', $id); 
			$stmtBed->execute(); 
			$stmtBed->bind_result($totalBedData, $totalBed, $totalBedPatient, $totalBedPatPer);
			$resultBed = $stmtBed->store_result();
			$rowBed = $stmtBed->fetch();
			
			$data['id']=$id;
            $data['division']=$name;
			$data['totalICUData']=$totalICUData;
			$data['totalICU']=$totalICU;
			$data['totalICUPatient']=$totalICUPatient;
			$data['totalICUPatPer']=$totalICUPatPer;
			
			$data['totalBedData']=$totalBedData;
			$data['totalBed']=$totalBed;
			$data['totalBedPatient']=$totalBedPatient;
			$data['totalBedPatPer']=$totalBedPatPer;
			array_push($response, $data);				
        }
		$stmtIcu->close();
		$stmtBed->close();
		$stmt->close();
    }
	else{
		$data['msg'] = "No Data Found";
		array_push($response, $data);
	}


 echo json_encode($response);
?>