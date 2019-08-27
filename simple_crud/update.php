<?php 
$myid =  $_GET['id'];
	include('common/config.php');

		if (!empty($myid)) {
			global $conn;
			$sql = "SELECT * FROM users WHERE id= $myid";
			$rslt = mysqli_query($conn, $sql);
			$data = mysqli_fetch_array($rslt);
		}

		
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD</title>
</head>
<body>
		<form action="edit.php" method="POST">
		<!-- <form action="insert.php" method="post"> -->
		<table>
			<tr>
				<td>Name  </td>
				<td>
					<input type="hidden" name="id" value="<?php echo $myid ?>">
					<input type="text" name="name" required="required" value="<?php echo $data['name'] ?>">
				</td>
			</tr>
			<tr>
				<td>Address</td>
				<td>
					<input type="text" name="address" required="required" value="<?php echo $data['address'] ?>">
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<input type="email" name="email" required="required" value="<?php echo $data['email'] ?>">
				</td>
			</tr>
			<tr>
				<td>Phone</td>
				<td>
					<input type="number" name="phone" required="required" value="<?php echo $data['phone'] ?>">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="submit">Update</button>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
