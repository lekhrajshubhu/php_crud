
<?php 
session_start();
$temp=array();
foreach ($_SESSION['error_insert'] as  $value) {
	foreach ($value as $key => $val) {
		$temp[$key] = $val;
	}
}
 ?>
 	
 </pre>
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
			<div class="col-6 col-md-6 col-lg-6 offset-md-3 offset-lg-3 mt-3">
				<div class="card">
					<div class="card-header">
						<h3>Add New User</h3>
					</div>
					<div class="card-body bg-light">
						<form action="useraction.php" method="post">
							<div class="form-group">
								<label for="">Full Name</label>
								<input class="form-control" type="text" name="full_name" placeholder="Full name">
								<label class="text-danger"><?php if(!empty($temp['fullname_err'])) echo $temp['fullname_err']; ?></label>
							</div>
							<div class="form-group">
								<label for="">Address</label>
								<input class="form-control" type="text" name="address" placeholder="Address">
								<label class="text-danger"><?php if(!empty($temp['address_err'])) echo $temp['address_err']; ?></label>
							</div>
							<div class="form-group">
								<label for="">Email</label></td>
								<input class="form-control" type="text" name="email" placeholder="Email">
								<label class="text-danger"><?php if(!empty($temp['email_err'])) echo $temp['email_err']; ?></label>
							</div>

							<div class="form-group">
								<label for="">Phone</label></td>
								<input class="form-control" type="number" name="phone" placeholder="Phone">
								<label class="text-danger"><?php if(!empty($temp['phone_err'])) echo $temp['phone_err']; ?></label>
								
							</div>
							<div class="form-group">
								<input type="submit" name="submit" value="Submit" class="btn btn-sm btn-success">
							</div>

						</form>
						
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<script src="assets/bootstrap.min.js"></script>
</body>
</html>