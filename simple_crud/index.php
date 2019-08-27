<?php 
	include('common/config.php');

		global $conn;


		if ($_SERVER["REQUEST_METHOD"]=="POST") {

			$name =  $_POST['name'];
			$address = $_POST['address'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];

$query = "insert into `users`(`name`,`address`,`email`,`phone`) values('$name','$address','$email','$phone')";

			$run = mysqli_query($conn,$query);
			if ($run) {
				echo "Data inserted Successfully";
			}else{
				echo "failed to insert into database";
			}
		}
		//TODO : Never use $_SERVER["PHP_SELF"], it's have the main vulnerability of xss injection
		//Modify the all where you use it
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD</title>
</head>
<body>

		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
		<!-- <form action="insert.php" method="post"> -->
		<table>
			<tr>
				<td>Name  </td>
				<td>
					<input type="text" name="name" required="required">
				</td>
			</tr>
			<tr>
				<td>Address</td>
				<td>
					<input type="text" name="address" required="required">
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<input type="email" name="email" required="required">
				</td>
			</tr>
			<tr>
				<td>Phne</td>
				<td>
					<input type="number" name="phone" required="required">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="submit">Submit</button>
				</td>
			</tr>
		</table>
	</form>

	<h3>All Data</h3>

	<table>
		<tr>
			<th>SN</th>
			<th>Name</th>
			<th>Address</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Action</th>
		</tr>
		<?php 
			$qry  = "SELECT * FROM `users`";
			$run = mysqli_query($conn, $qry);
			if ($run) {
				while ($data = mysqli_fetch_assoc($run)) {
					//TODO : instead of this kind of while you can use while(condition): endwhile; is such cases, so does for the if condition
					?>

					<tr>
						<td><?php echo $data['id']?></td>
						<td><?php echo $data['name']?></td>
						<td><?php echo $data['address']?></td>
						<td><?php echo $data['email']?></td>
						<td><?php echo $data['phone']?></td>
						<td>
							<a href="update.php?id=<?php echo $data['id'] ?>">Edit</a>
							<a href="delete.php?id=<?php echo $data['id'] ?>">Delete</a>
						</td>
					</tr>
					<?php
				}
			}
		 ?>
	</table>
</body>
</html>