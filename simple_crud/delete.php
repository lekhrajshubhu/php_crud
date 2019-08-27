<?php 

$id = $_GET['id'];
include('common/config.php');
$sql = "DELETE FROM users WHERE id='$id'";
if (mysqli_query($conn,$sql)) {
	echo "successfully deleted";
		mysqli_close($conn);
	mysqli_close($conn);
	 header("location: index.php");
	
}else {
	echo "failed to delete";
 
}
