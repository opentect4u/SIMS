<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");
//	require("nav.php");
//	echo"<br><br>";
//	echo "<h1 class='elegantshadow'>Laxmi Narayan Stores</h1>";
//      echo "<hr class='hr'>";

//	require("menu.php");

    	$prodtypeErr = "";

	if($_SESSION['ins_flag'] == true){
		echo"<script>alert('Product Type Successfully Added')</script>";
		$_SESSION['ins_flag']=false;
	}	

	$rtv="select sl_no,prod_type from m_prod_type";
	$result=mysqli_query($db_connect,$rtv);
	if($result){
		if(mysqli_num_rows($result) > 0){
			while($rtv_data=mysqli_fetch_assoc($result)){
				$slno=$rtv_data['sl_no'];
				$prodtype=$rtv_data['prod_type'];
				echo $slno ."<br>";
				echo $prodtype."<br>";
			}
		}
	}

?>
