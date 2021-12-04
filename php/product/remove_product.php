<?php

	include('../../db.php');

	$sl = $_POST['id'];

	
	$conn-> query("DELETE FROM `product` WHERE `product`.`product_id` = $sl");

	echo 1;
	

?>