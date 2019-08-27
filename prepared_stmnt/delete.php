<?php 
include('inc/config.php');
$stmt = $conn->prepare("DELETE FROM persons WHERE id = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$stmt->close();
header("location: index.php");

 ?>