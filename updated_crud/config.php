<?php 
$conn  = mysqli_connect('localhost','root','root','crudcore');
if (!$conn) {
	die("Could not connect");
}