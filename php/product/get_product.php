<?php


	include('../../db.php');
	$procode = $_POST['pro_code'];

	$stmt = $conn->query("SELECT * FROM product WHERE barcode='$procode' ORDER BY product_id DESC");

	
	

	

		//while($statt = $stmt -> fetch_assoc()){
			while($statt = $stmt->fetch_assoc()){

			 $product_id = $statt['product_id'];
			 $product_name = $statt['product_name'];
			 $description = $statt['description'];
			 $barcode = $statt['barcode'];
			 $category_id = $statt['category_id'];
			 $brand_id = $statt['brand_id'];
			 $warrenty = $statt['warrenty'];
			 $price_retail = $statt['price_retail'];
			 $price_cost = $statt['price_cost'];
			 $reorderlevel = $statt['reorderlevel'];
			 $date = $statt['date'];
			 $status = $statt['status'];
			$output[] = array("product_id"=> $product_id, "product_name"=> $product_name, "description"=> $description,"barcode"=> $barcode, "category_id"=> $category_id, "brand_id"=> $brand_id,"warrenty"=> $warrenty, "price_retail"=> $price_retail, "price_cost"=> $price_cost,"reorderlevel"=> $reorderlevel, "date"=> $date, "status"=> $status);
		}

		echo json_encode($output);
	
	//$stmt->close();

?>