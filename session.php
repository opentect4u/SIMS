<?php
	require("db/db_connect.php");
	session_start();

	if(!isset($_SESSION['user_id'])){
        	header("location:index.php");
	   }
?>

