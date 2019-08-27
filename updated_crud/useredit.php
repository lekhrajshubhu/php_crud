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
    <title>Update Data</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="col-6 col-md-6 col-lg-6 offset-md-3 offset-lg-3">
			<div class="card">
				<div class="card-header">
					<h4>Update Form</h4>
				</div>
				<div class="card-body">
					<form action="useraction.php" method="POST">
						<div class="form-group">
							<label for="">Full Name</label>
							<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
							<input class="form-control" type="text" name="fullname" value="<?php echo $data['name'] ?>">
						</div>
						<div class="form-group">
							<label for="">Address</label>
							<input class="form-control" type="text" name="address" value="<?php echo $data['address'] ?>">
						</div>
						<div class="form-group">
							<label for="">Email</label>
							<input class="form-control" type="email" name="email" value="<?php echo $data['email'] ?>">
						</div>
						<div class="form-group">
							<label for="">Phone</label>
							<input class="form-control" type="number" name="phone" value="<?php echo $data['phone'] ?>">
						</div>

						<div class="form-group">
							<input type="submit" name="update" value="Update" class="btn btn-sm bg-success">
						</div>
							
					</form> 
					
				</div>
			</div>
		</div>	
	</div>
	<script src="assets/bootstrap.min.js"></script>
</body>
</html>