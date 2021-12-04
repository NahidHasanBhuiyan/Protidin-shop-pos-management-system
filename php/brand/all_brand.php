<?php


	include('../../db.php');

	$stmt = $conn->query("SELECT * FROM brand ORDER BY id DESC");
	

	

		//while($statt = $stmt -> fetch_assoc()){
			while($statt = $stmt->fetch_assoc()){

			 $id = $statt['id'];
			 $brandname = $statt['brandname'];
			 $status = $statt['status'];
			$output[] = array("id"=> $id, "brandname"=> $brandname, "status"=> $status);
		}

		echo json_encode($output);
	
	//$stmt->close();

?>