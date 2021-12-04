<?php

	include('../../db.php');

	$sl = $_POST['id'];

	
	$conn-> query("DELETE FROM `vendor` WHERE `vendor`.`vendor_id` = $sl");

	echo 1;
	

?>