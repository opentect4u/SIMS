<?php
	/*require("../db/db_connect.php");
	require("../session.php");*/

	function f_getparamval($value,$db){
		$sql = "select param_value
			from   m_params
			where  paran_no = $value";

		$result = mysqli_query($db,$sql);
		$data   = mysqli_fetch_assoc($result);
		$param_val = $data['param_value'];
		return $param_val;
		
	}

	function f_getrate($catg_cd,$prod_cd,$db){
		$sql = "select ifnull(prod_rate,0)prod_rate
			from   m_rate_master
			where  prod_cd = $prod_cd
			and    catg_cd = $catg_cd";

		$result = mysqli_query($db,$sql);
		$row    = mysqli_fetch_assoc($result);
		$prod_rate = $row['prod_rate'];
		return $prod_rate;
	}

?>
