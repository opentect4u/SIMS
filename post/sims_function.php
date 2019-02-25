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

//echo "testing test";

	function f_getcatgcd($prod_catg,$db){
		$sql = "select sl_no from m_prod_catg where prod_catg = '$prod_catg'";
		$result = mysqli_query($db,$sql);
		$row    = mysqli_fetch_assoc($result);
		$catg_cd = $row['sl_no'];
		return $catg_cd;
	}

	function f_getprodcd($prod_desc,$db){
                $sql = "select sl_no from m_products where prod_desc = '$prod_desc'";
                $result = mysqli_query($db,$sql);
                $row    = mysqli_fetch_assoc($result);
                $prod_cd = $row['sl_no'];
                return $prod_cd;
	}

	function f_getallotbal($allotno,$catg_cd,$prod_cd,$db){
		$sql = "select ifnull(balance_qty,0)balance_qty
			from   td_allot_dtls
                        where  allot_no = '$allotno'
			and    catg_cd  = $catg_cd
			and    prod_cd  = $prod_cd";
		$result  =mysqli_query($db,$sql);
		$row    = mysqli_fetch_assoc($result);
		$bal_qty = $row['balance_qty'];
		return $bal_qty;
	}
	
	function f_getquintal($qnt,$kg,$gm,$db){
		$gm = ($gm/1000);
		$kg = ($kg + $gm);
		$kg = ($kg/100);
		$qnt = ($qnt + $kg);
		return $qnt;
	}

	function f_check_balance($allot_balance,$total_balance){
		if($total_balance > $allot_balance){
		    throw new Exception("Supplied Values Exceeds Allotment Balance");
		}
		return true;
	}
	function f_check_allot_no($allot_no,$db){
		$sql = "select * from td_allot_dtls where allot_no = '$allot_no'";
		$result = mysqli_query($db,$sql);
		$count = mysqli_num_rows($result);
		return $count;
	}                    

	

?>
