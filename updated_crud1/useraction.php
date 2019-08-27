<?php 
	//update form
	if (isset($_POST['update'])) {
		//TODO : why we are adding file inside the if condition here and in the below
		include('config.php');

		$id = $_POST['id'];
		
		echo $fullname =trim($_POST['full_name']);
		
		echo $address =trim($_POST['address']);
		echo $email =trim($_POST['email']);
		echo $phone =trim($_POST['phone']);
		$qry = "UPDATE users SET name=?, address=?, email=?, phone=? WHERE id=?";

		if ($stmt = mysqli_prepare($conn,$qry)) {
			mysqli_stmt_bind_param($stmt,'sssii',$fullname,$address,$email,$phone,$id);
			if (mysqli_stmt_execute($stmt)) {
				header("location:index.php");
				exit();
			}else {
				echo "Something is wrong";
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}

	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		echo $id = $_GET['id'];
		require_once('config.php');
		$qry = "DELETE from USERS WHERE id = $id";

		if($stmt = mysqli_prepare($conn,$qry)){
			if (mysqli_stmt_execute($stmt)) {
				header("location:index.php");
			}else {
				echo "Something is wrong";
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}
?>