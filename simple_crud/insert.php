<?php 
include('common/config.php');

$name =  $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$query = "insert into `users`(`name`,`address`,`email`,`phone`) values('$name','$address','$email','$phone')";

$run = mysqli_query($conn,$query);
if ($run) {
	echo "success <a href='index.php'>Back to home</a>";
	mysqli_close($conn);
}else {
	echo $conn->error;
}
?>
