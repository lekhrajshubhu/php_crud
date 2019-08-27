<?php 
if ($_SERVER["REQUEST_METHOD"]=="POST") {
include('common/config.php');

			$name =  $_POST['name'];
			$address = $_POST['address'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$id = $_POST['id'];

			//TODO : things need to be consider don't trust the user so always sanitize the form data before posting it into DB this code has vlunerability of SQL injection and XSS
			$sql = "UPDATE users SET name='$name', address='$address', email='$email', phone='$phone' WHERE id='$id'";
			$rslt = mysqli_query($conn, $sql);
			if ($rslt) {
				echo "successfully updated";
					mysqli_close($conn);
					
				header("location: index.php");
			}else{
				echo "failed";
			}
		}

 ?>