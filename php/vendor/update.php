<?php

	include('../../db.php');

	$sl = $_POST['id'];
	$vendorname = $_POST['vendorname'];
	
		$contactno = $_POST['contactno'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$status = $_POST['status'];

	$conn->query("UPDATE vendor set vname='$vendorname', contactno='$contactno',email='$email', address='$address',status='$status' WHERE vendor_id='$sl'");

	

	echo 1;
	
?>