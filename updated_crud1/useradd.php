<?php 
//TODO : i asked you to use seprate file for the php operation not in the same file change this like in useredit in this way we can utilize the sanitize Input method
$fullname = $address = $email = $phone = "";
	$fullname_err = $address_err = $email_err = $phone_err = "";
	echo $fullname_err;

	//clean before validation
	function sanitizeInput($data) {
		$data = strip_tags($data);
		$data = stripslashes($data);
		$data = trim($data);
		return $data;

	}
	//insert form
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if (isset($_POST['submit'])) {
			$input_fullname =sanitizeInput($_POST['full_name']);
			$input_address = sanitizeInput($_POST['address']);
			$input_email = sanitizeInput($_POST['email']);
			$input_phone = sanitizeInput($_POST['phone']);
			//valid name
			if(empty($input_fullname)){
				$fullname_err = "Full name is empty";
			}
			else if (!preg_match("/^[a-zA-Z\s\d]+$/", $input_fullname)) {
				$fullname_err = "Please enter valid name";
			}else {
				//TODO : do we need extra valiable ?
				$fullname =  $input_fullname;
			}
	
			//validate address
			if (empty($input_address)) {
				$address_err = "Address field empty! ";
			}else if (!preg_match("/^[a-zA-Z\s\d]+$/", $input_address)) {
				$address_err = "Enter Valid Address! " ;
			}else {
				 $address = $input_address;
			}
			//validate email
			if (empty($input_email)) {
				$email_err = "Email field is empty! ";
			}else if(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
			   $email_err = "Please input valid email address";
			}else {
			   $email = $input_email;
			}
			
			//valid phone
			if (empty($input_phone)) {
				$phone_err = "Phone field empty! ";
			}else if(!preg_match("/^\d{10}$/",$input_phone)){
				$phone_err = "Invalid phone";
			}else {
				$phone =  $input_phone;
			}
	
			//check if error is empty
			
			if (empty($fullname_err) && empty($address_err) && empty($email_err) && empty($phone_err)) {
				//TODO : file should always added in the first line
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
			
		}

	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add New User</title>
	<link rel="stylesheet" href="assets/bootstrap.min.css">
</head>
<body>
	
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-6 offset-md-3 offset-lg-3">
				<h4 align="center">Add New User</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-6 offset-md-3 offset-lg-3">
				<div class="card">
					<div class="card-body bg-light">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="form-group">
								<label for="full_name">Full Name</label>
								<input type="text" class="form-control" id="full_name" name="full_name">
								<span class="help-block text-danger"><?php echo $fullname_err;?></span>
							</div>
							<div class="form-group">
								<label for="address">Address</label>
								<input type="text" class="form-control" id="address" name="address">
								<span class="help-block text-danger"><?php echo $address_err;?></span>
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" name="email">
								<span class="help-block text-danger"><?php echo $email_err;?></span>
							</div>
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="number" class="form-control" id="phone" name="phone">
								<span class="help-block text-danger"><?php echo $phone_err;?></span>
							</div>

							<div class="form-group">
								<button class="btn-sm bg-success border-0 text-white" type="submit" name="submit">Submit</button>
								<button class="btn-sm bg-warning border-0 text-white" type="reset" name="resest">Reset</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/jquery.js"></script>
	<script src="assets/bootstrap.min.js"></script>
</body>
</html>