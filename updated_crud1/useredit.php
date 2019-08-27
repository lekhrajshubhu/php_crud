<?php 
include('config.php');
$id  = $_GET['id'];
if (!empty($id)) {
    $qry = "SELECT * FROM users WHERE id=$id";
    $run = mysqli_query($conn,$qry);
    $data = mysqli_fetch_array($run);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <title>Update Data</title>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-6 offset-md-3 offset-lg-3">
				<h4 align="center">Update User</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-6 offset-md-3 offset-lg-3">
				<div class="card">
					<div class="card-body bg-light">
						<form action="useraction.php" method="post">
							<div class="form-group">
								<label for="full_name">Full Name</label>
								<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
								<input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $data['name'] ?>">
								
							</div>
							<div class="form-group">
								<label for="address">Address</label>
								<input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address'] ?>">
								
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email'] ?>">
								
							</div>
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="number" class="form-control" id="phone" name="phone" value="<?php echo $data['phone'] ?>">
								
							</div>

							<div class="form-group">
								<button class="btn-sm bg-success border-0 text-white" type="submit" name="update">Submit</button>
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