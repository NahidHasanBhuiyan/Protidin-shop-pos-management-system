<?php


	include('../../db.php');

	$stmt = $conn->query("SELECT * FROM vendor ORDER BY vendor_id DESC");
	

	

		//while($statt = $stmt -> fetch_assoc()){
			while($statt = $stmt->fetch_assoc()){



			 $id = $statt['vendor_id'];
			 $vendorname = $statt['vname'];
			$contactno = $statt['contactno'];
			$email = $statt['email'];
			$address = $statt['address'];
			$status = $statt['status'];

			$output[] = array("vendor_id"=> $id, "vname"=> $vendorname, "contactno"=> $contactno,"email"=> $email, "address"=> $address,"status"=> $status);
		}

		echo json_encode($output);
	
	//$stmt->close();

?>