<?php 
$conn = new Mysqli('localhost','root','root','crudcore');
if ($conn->connect_error) {
	exit("Error in connecting to database");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);//

$conn->set_charset("utf8mb4");


 ?>