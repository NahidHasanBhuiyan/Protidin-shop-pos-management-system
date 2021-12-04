<?php
	include('../../db.php');

	$stmt = $conn->query("SELECT * FROM product ORDER BY product_id DESC");

	$bar = $conn->query("SELECT MAX(barcode) AS max FROM product");
	$code = $bar->fetch_assoc();
	$barCode = $code['max']+1;

	$productName = $_POST['productName'];
	$productDescription = $_POST['productDescription'];
	
	$category = $_POST['category'];
	$brand = $_POST['brand'];
	$warrenty = $_POST['warrenty'];
	$retailPrice = $_POST['retailPrice'];
	$costPrice = $_POST['costPrice'];
	$reorderLevel = $_POST['reorderLevel'];
	$productDate = $_POST['productDate'];
	$status = $_POST['status'];

	$conn->query("INSERT INTO product(product_name,description,barcode,category_id,brand_id,warrenty,price_retail,price_cost,reorderlevel,date,status) VALUES('$productName','$productDescription','$barCode','$category','$brand','$warrenty','$retailPrice','$costPrice','$reorderLevel','$productDate','$status')");

	echo 1;
		

?>