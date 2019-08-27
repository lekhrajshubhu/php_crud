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
			<div class="col-sm-6 col-md-6 offset-md-3">
				<a class="btn-sm btn-success" href="useradd.php">Add</a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6 offset-md-3">
				
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
											<a href="edit.php?id=<?php echo $data['id'] ?>">Delete</a>
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