<?php 
session_start();

	$fullname = $address = $email = $phone = "";
	$fullname_err = $address_err = $email_err = $phone_err = "";

	//clean before validation
	function input_clean($data) {
		$data = strip_tags($data);
		$data = stripslashes($data);
		$data = trim($data);
		return $data;

	}
	//function to valid name
	function valid_name($input_fullname) {
		if(empty($input_fullname)){
			$fullname_err = "Name is empty";
			array_push($_SESSION['error_insert'],['fullname_err'=>$fullname_err]);
			header("location:useradd.php");
	
		}
		else if (!preg_match("/^[a-zA-Z\s\d]+$/", $input_fullname)) {
			echo $fullname_err = "Please enter valid name";
			array_push($_SESSION['error_insert'],['fullname_err'=>$fullname_err]);
			
		}else {
			array_push($_SESSION['error_insert'],['fullname_err'=>null]);
			return $fullname =  $input_fullname;

		}
	}
	// function to valid address
	function valid_address($input_address) {
		if (empty($input_address)) {
			$address_err = "Address field empty! ";
			array_push($_SESSION['error_insert'],['address_err'=>$address_err]);
			header("location:useradd.php");
		}else if (!preg_match("/^[a-zA-Z\s\d]+$/", $input_address)) {
			$address_err = "Enter Valid Address! " ;
			array_push($_SESSION['error_insert'],['address_err'=>$address_err]);
			header("location:useradd.php");
		}else {
			array_push($_SESSION['error_insert'],['address_err'=>null]);
			return $input_address;
		}
	}
	//function to valid email
	function valid_email($input_email) {
		if (empty($input_email)) {
			$email_err = "Email field is empty! ";
			array_push($_SESSION['error_insert'],['email_err'=>$email_err]);
			header("location:useradd.php");
		}else if(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
			$email_err = "Please input valid email address";
			array_push($_SESSION['error_insert'],['email_err'=>$email_err]);
			header("location:useradd.php");
		}else {
			array_push($_SESSION['error_insert'],['email_err'=>null]);
			return $input_email;
		}
	}
	//function to valid phone
	function valid_phone($input_phone) {
		if (empty($input_phone)) {
			$phone_err = "Phone field empty! ";
			array_push($_SESSION['error_insert'],['phone_err'=>$phone_err]);
			header("location:useradd.php");
		}else if(!preg_match("/^\d{10}$/",$input_phone)){
			$phone_err = "Invalid phone";
			array_push($_SESSION['error_insert'],['phone_err'=>$phone_err]);
			header("location:useradd.php");
		}else {
			array_push($_SESSION['error_insert'],['phone_err'=>null]);
			return $input_phone;
		}
	}
	//insert form
	if (isset($_POST['submit'])) {
		$fullname = valid_name(input_clean($_POST['full_name']));
		$address = valid_address(input_clean($_POST['address']));
		$email = valid_email(input_clean($_POST['email']));
		$phone = valid_phone(input_clean($_POST['phone']));

	echo sizeof($_SESSION['error_insert']);
	
		require_once('config.php');
		$qry = "INSERT INTO users(name,address,email,phone) VALUES(?,?,?,?)";
		if ($stmt = mysqli_prepare($conn,$qry)) {
			mysqli_stmt_bind_param($stmt,'sssi',$val_fullname,$val_address,$val_email,$val_phone);
			$val_fullname = $fullname;
			$val_address  = $address;
			$val_email = $email;
			$val_phone = $phone;

			if (mysqli_stmt_execute($stmt)) {
				header("location: index.php");
				exit();
			}else {
				echo "Something went wrong";
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}

	//UPDATE
	if (isset($_POST['update'])) {

		$id = input_clean($_POST['id']);
		$fullname = input_clean($_POST['fullname']);
		$address = input_clean($_POST['address']);
		$email = input_clean($_POST['email']);
		$phone = input_clean($_POST['phone']);
		if (!empty($id) && !empty($fullname) && !empty($address) && !empty($email) && !empty($phone)) {
			include('config.php');
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
		}else {
			echo "error";
		}

	}

	//DELETE 
	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		if ($_GET['action'] =="delete") {
			$id = $_GET['id'];

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
	}
?>