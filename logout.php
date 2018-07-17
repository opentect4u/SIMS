<?php
	require("db/db_connect.php");
	session_start();

	$sl_no = $_SESSION['sl_no'];
	$time  = date("Y-m-d h:i:s");

	$sql = "update t_audit_trail set logout='$time'
	        where sl_no = '$sl_no'";
	$result = mysqli_query($db_connect,$sql);
	mysqli_close($db_connect);	


	if(session_destroy()){
		header("Location:../SIMS/index.php");
	  }
?>

