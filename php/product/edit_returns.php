<?php

	include('../../db.php');
	$sl = $_POST['id'];
	$stmt = $conn->query("SELECT * FROM product WHERE product_id='$sl'");

	while($stmm = $stmt->fetch_assoc()){
		 $product_id = $stmm['product_id'];
			 $product_name = $stmm['product_name'];
			 $description = $stmm['description'];
			 $barcode = $stmm['barcode'];
			 $category_id = $stmm['category_id'];
			 $brand_id = $stmm['brand_id'];
			 $warrenty = $stmm['warrenty'];
			 $price_retail = $stmm['price_retail'];
			 $price_cost = $stmm['price_cost'];
			 $reorderlevel = $stmm['reorderlevel'];
			 $date = $stmm['date'];
			 $status = $stmm['status'];
			$output = array("product_id"=> $product_id, "product_name"=> $product_name, "description"=> $description,"barcode"=> $barcode, "category_id"=> $category_id, "brand_id"=> $brand_id,"warrenty"=> $warrenty, "price_retail"=> $price_retail, "price_cost"=> $price_cost,"reorderlevel"=> $reorderlevel, "date"=> $date, "status"=> $status);
	}
	echo json_encode($output);

?>