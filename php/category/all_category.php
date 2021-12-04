<?php


	include('../../db.php');

	$stmt = $conn->query("SELECT * FROM category ORDER BY id DESC");
	

	

		//while($statt = $stmt -> fetch_assoc()){
			while($statt = $stmt->fetch_assoc()){

			 $id = $statt['id'];
			 $catname = $statt['catname'];
			 $status = $statt['status'];
			$output[] = array("id"=> $id, "catname"=> $catname, "status"=> $status);
		}

		echo json_encode($output);
	
	//$stmt->close();

?>