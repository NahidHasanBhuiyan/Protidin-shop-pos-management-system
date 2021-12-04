<?php
	include('../../db.php');

	

	$vendor = $_POST['vendor'];
	$total = $_POST['total'];
	
	$pay = $_POST['pay'];
	$due = $_POST['due'];
	$pstatus = $_POST['pstatus'];
	date_default_timezone_set("Asia/Dhaka");
	$date = date('Y-m-d');
	

	$conn->query("INSERT INTO purchase(vendor_id,date,total,pay,due,payment_type) VALUES('$vendor','$date','$total','$pay','$due','$pstatus')");

	$last_id = $conn->insert_id;

	$relation_list = $_POST['data']; 

	for($i=0;$i<count($relation_list);$i++){
		$purchase_id = $last_id;
		$product_id = $relation_list[$i]['procode'];
		$buy_price = $relation_list[$i]['price'];
		$qty = $relation_list[$i]['qty'];
		$total = $relation_list[$i]['total_cost'];

		$conn->query("INSERT INTO purchase_item(purchase_id,product_id,buy_price,qty,total) VALUES('$purchase_id','$product_id','$buy_price','$qty','$total')");
	}

	echo 1;
		

?>