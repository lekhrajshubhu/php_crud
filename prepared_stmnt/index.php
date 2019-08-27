<?php 
include('config.php');

$stmt = $conn->prepare("SELECT * FROM persons");
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Files</title>
</head>
<body>
	<h4>Insert Form</h4>
	<form action="insert.php" method="POST">
		<table>
			<tr>
				<td><label for="">Full Name</label></td>
				<td><input type="text" name="fullname" placeholder="fullname"></td>
			</tr>
			<tr>
				<td><label for="">Address</label></td>
				<td><input type="text" name="address" placeholder="address"></td>
			</tr>
			<tr>
				<td><label for="">Email</label></td>
				<td><input type="email" name="email" placeholder="email"></td>
			</tr>
			<tr>
				<td><label for="">Phone</label></td>
				<td><input type="number" name="phone" placeholder="phone"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><button type="submit">Submit</button></td>
			</tr>
		</table>
	</form>

	<div>
		<table>
			<thead>
				<tr>
					<th>SN</th>
					<th>Full Name</th>
					<th>Address</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($result->num_rows >0) {
				 while ($row = $result->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $row['id'] ?></td>
							<td><?php echo $row['fullname'] ?></td>
							<td><?php echo $row['address'] ?></td>
							<td><?php echo $row['email'] ?></td>
							<td><?php echo $row['phone'] ?></td>
							<td>
								<a href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
								<a href="delete.php?id=<?php echo $row['id']?>">Delete</a>
							</td>
						</tr>
				<?php } }  ?>
			</tbody>
		</table>
	</div>
</body>
</html>

