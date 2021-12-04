<?php


	include('../../db.php');

	$stmt = $conn->query("SELECT * FROM vendor where status='1' ORDER BY vendor_id DESC");
	

	

		//while($statt = $stmt -> fetch_assoc()){
			while($statt = $stmt->fetch_assoc()){

			 $id = $statt['vendor_id'];
			 $vname = $statt['vname'];
			
			$output[] = array("vendor_id"=> $id, "vname"=> $vname);
		}

		echo json_encode($output);
	
	//$stmt->close();

?>