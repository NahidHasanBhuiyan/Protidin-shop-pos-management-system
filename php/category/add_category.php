<?php

	include('../../db.php');

	if(isset($_POST['catname'])){

		$catname = $_POST['catname'];
	$status = $_POST['status'];



	$stmt = $conn->query("INSERT INTO category(catname,status) VALUES('$catname','$status')");


	

	

	//if($stmt->execute()){
		echo 1;
	//}else{
	//	echo 0;
	//}

	//$stmt->close();

	}

	

?>