<?php

	include('../../db.php');

	if(isset($_POST['brandname'])){

		$brandname = $_POST['brandname'];
	$status = $_POST['status'];



	$stmt = $conn->query("INSERT INTO brand(brandname,status) VALUES('$brandname','$status')");


	

	

	//if($stmt->execute()){
		echo 1;
	//}else{
	//	echo 0;
	//}

	//$stmt->close();

	}

	

?>