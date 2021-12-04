<?php

	include('../../db.php');

	$sl = $_POST['category_id'];

	
	$conn-> query("DELETE FROM `category` WHERE `category`.`id` = $sl");

	echo 1;
	

?>