<?php

	include('../../db.php');
	$sl = $_POST['category_id'];
	$stmt = $conn->query("SELECT * FROM category WHERE id='$sl'");

	while($stmm = $stmt->fetch_assoc()){
		$id = $stmm['id'];
		$catname = $stmm['catname'];
		$status = $stmm['status'];

		$output = array("id"=>$id, "catname"=>$catname, "status"=>$status);
	}
	echo json_encode($output);

?>