<?php 
//connect to database
$conn = mysqli_connect('localhost','root','root','crudcore');

//check 
if (!$conn) {
	die('could not connect your database');
}
 ?>