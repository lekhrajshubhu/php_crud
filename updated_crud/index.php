<?php 
session_start();
$_SESSION['error_insert'] = array();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Basic CRUD</title>
	<link rel="stylesheet" href="assets/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-6 col-md-6 col-lg-6 offset-md-3 offset-lg-3">
				
					<a class="btn btn-sm bg-success text-white m-4 float-right" href="useradd.php">Add New</a>
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Address</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						require_once('config.php');
						$qry = "SELECT * FROM users";
						$run = mysqli_query($conn,$qry);
						if ($run) {
							while($data = mysqli_fetch_assoc($run)) :
								?>
									<tr>
										<td><?php echo $data['name'] ?></td>
										<td><?php echo $data['address'] ?></td>
										<td><?php echo $data['email'] ?></td>
										<td><?php echo $data['phone'] ?></td>
										<td>
											<a href="useredit.php?id=<?php echo $data['id'] ?>">Edit</a>
											<a href="useraction.php?id=<?php echo $data['id']; ?>&action=delete">Delete</a>
										</td>
									</tr>
								<?php
							endwhile;
							mysqli_close($conn);
						}
					?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
	<script src="assets/jquery.js"></script>
	<script src="assets/bootstrap.min.js"></script>
</body>
</html>