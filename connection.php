<?php

    $host= "localhost";
	$user="root";
	$password="";
	$db="bakery";

	$conn= mysqli_connect($host,$user,$password,$db) or die('unable to connect');

	session_set_cookie_params(259200);
	session_start();
?>
