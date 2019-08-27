<?php 
include('inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$fullname = $_POST['fullname'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	

$stmt = $conn->prepare("INSERT INTO persons (fullname,address,email,phone) values (?,?,?,?)");
$stmt->bind_param('sssi',$fullname,$address,$email,$phone);
$stmt->execute();
$stmt->close();
	echo "successfully added";
	header("location: index.php");
}else{
	echo "sth is wrong";
}
