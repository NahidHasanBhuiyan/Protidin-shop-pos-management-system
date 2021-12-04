<?php

	include('../../db.php');

	$sl = $_POST['category_id'];
	$cattname = $_POST['catname'];
	$sttname = $_POST['status'];

	$conn->query("UPDATE category set catname='$cattname', status='$sttname' WHERE id='$sl'");

	echo 1;
	
?>