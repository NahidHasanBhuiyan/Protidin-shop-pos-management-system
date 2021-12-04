<?php

	include('../../db.php');

	if(isset($_POST['vendorname'])){

		$vendorname = $_POST['vendorname'];
		$contactno = $_POST['contactno'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$status = $_POST['status'];



	$stmt = $conn->query("INSERT INTO vendor(vname,contactno,email,address,status) VALUES('$vendorname','$contactno','$email','$address','$status')");


	

	

	//if($stmt->execute()){
		echo 1;
	//}else{
	//	echo 0;
	//}

	//$stmt->close();

	}

	

?>