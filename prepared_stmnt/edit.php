<?php 
include('inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = $_POST['id'];
	$fullname = $_POST['fullname'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

		$stmt = $conn->prepare("UPDATE persons SET fullname=?, address=?, email=?, phone=? WHERE id=?");
		$stmt->bind_param('sssdi',$fullname,$address,$email,$phone,$id);
		$stmt->execute();
		$stmt->close();
	
		echo "successfully added";
		header("location: index.php");
}else{
	echo "sth is wrong";
}
