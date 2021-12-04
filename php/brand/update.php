<?php

	include('../../db.php');

	$sl = $_POST['brand_id'];
	$cattname = $_POST['brandname'];
	$sttname = $_POST['status'];

	$conn->query("UPDATE brand set brandname='$cattname', status='$sttname' WHERE id='$sl'");

	echo 1;
	
?>