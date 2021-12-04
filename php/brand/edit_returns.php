<?php

	include('../../db.php');
	$sl = $_POST['brand_id'];
	$stmt = $conn->query("SELECT * FROM brand WHERE id='$sl'");

	while($stmm = $stmt->fetch_assoc()){
		$id = $stmm['id'];
		$brandname = $stmm['brandname'];
		$status = $stmm['status'];

		$output = array("id"=>$id, "brandname"=>$brandname, "status"=>$status);
	}
	echo json_encode($output);

?>