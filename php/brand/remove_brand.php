<?php

	include('../../db.php');

	$sl = $_POST['brand_id'];

	
	$conn-> query("DELETE FROM `brand` WHERE `brand`.`id` = $sl");

	echo 1;
	

?>