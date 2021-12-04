<?php

	include('../../db.php');
	$sl = $_POST['id'];
	$stmt = $conn->query("SELECT * FROM vendor WHERE vendor_id='$sl'");

	while($stmm = $stmt->fetch_assoc()){
		$vendor_id = $stmm['vendor_id'];
		$vname = $stmm['vname'];
		$contactno = $stmm['contactno'];
		$email = $stmm['email'];
		$address = $stmm['address'];
		$status = $stmm['status'];

		$output = array("vendor_id"=>$vendor_id, "vname"=>$vname, "contactno"=>$contactno, "email"=>$email, "address"=>$address, "status"=>$status);
	}
	echo json_encode($output);

?>