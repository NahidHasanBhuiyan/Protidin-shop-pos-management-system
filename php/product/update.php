<?php

	include('../../db.php');

	$sl = $_POST['id'];
	$productName = $_POST['productName'];
	$productDescription = $_POST['productDescription'];
	$barcode = $_POST['barcode'];
	$category = $_POST['category'];
	$brand = $_POST['brand'];
	$warrenty = $_POST['warrenty'];
	$retailPrice = $_POST['retailPrice'];
	$costPrice = $_POST['costPrice'];
	$reorderLevel = $_POST['reorderLevel'];
	$productDate = $_POST['productDate'];
	$status = $_POST['status'];

	$conn->query("UPDATE product set product_name='$productName', description='$productDescription',barcode='$barcode', category_id='$category',brand_id='$brand', warrenty='$warrenty',price_retail='$retailPrice',price_cost='$costPrice', reorderlevel='$reorderLevel',date='$productDate',status='$status' WHERE product_id='$sl'");

	

	echo 1;
	
?>