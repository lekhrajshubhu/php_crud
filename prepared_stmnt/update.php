<?php 
include('config.php');
$stmt = $conn->prepare("SELECT * FROM persons where id=?");
$stmt->bind_param('i',$_GET['id']);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Files</title>
</head>
<body>
	<h4>Update Form</h4>
	<form action="edit.php" method="POST">
		<table>
			<tr>
				<td><label for="">Full Name</label></td>
				<td><input type="text" name="fullname" value="<?php echo $data['fullname'] ?>">
					<input type="hidden" name="id" value="<?php echo $data['id']?>">
				</td>
			</tr>
			<tr>
				<td><label for="">Address</label></td>
				<td><input type="text" name="address" value="<?php echo $data['address'] ?>"></td>
			</tr>
			<tr>
				<td><label for="">Email</label></td>
				<td><input type="email" name="email" value="<?php echo $data['email'] ?>"></td>
			</tr>
			<tr>
				<td><label for="">Phone</label></td>
				<td><input type="number" name="phone" value="<?php echo $data['phone'] ?>"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><button type="submit">Update</button></td>
			</tr>
		</table>
	</form>
</body>
</html>