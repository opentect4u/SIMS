<?php
	ini_set("display_errors","1");
	error_reporting("E_ALL");

      	require("../db/db_connect.php");
	
	$prodtypeErr="";

	/*echo $transdt."<br>";
	echo $transcd."<br>";*/

	$select = "Select trans_type from td_stock_trans_pds
		   where  trans_dt        = '$transdt'
		   and    trans_cd        = '$transcd'";
	
	$result = mysqli_query($db_connect,$select);
	if($result){
		$row	=	mysqli_fetch_assoc($result);
		$trans_type	=	$row['trans_type'];
	}

	//echo $trans_type."<br>";

	unset($select);
	unset($result);

	$select = "Select ifnull(max(trans_dt),'1900-01-01')max_dt,ifnull(max(trans_cd),0)max_cd from td_stock_trans_pds
		   where  prod_sl_no = '$slno'	
		   and    prod_catg  = '$prodcatg'
		   and    approval_status ='A'";

	$result	=  mysqli_query($db_connect,$select);
	if($result){
		$row	=	mysqli_fetch_assoc($result);
		$max_dt =       $row['max_dt'];
		$max_cd	=	$row['max_cd'];
	}

	/*echo $max_dt."<br>";
	  echo $max_cd."<br>";*/

	if($max_dt!='1900-01-01' && $max_cd!=0){

	  unset($select);
          unset($result);

	  $select = "Select ifnull(bag_bal,0)bag_bal,
		            ifnull(qnt_bal,0)qnt_bal,
			    ifnull(kg_bal,0)kg_bal,
			    ifnull(gm_bal,0)gm_bal
		      from   td_stock_trans_pds
		      where  trans_dt = '$max_dt'
		      and    trans_cd = '$max_cd'";

	  $result =  mysqli_query($db_connect,$select);
          if($result){
		  $data	=	mysqli_fetch_assoc($result);
		  $bag_bal 	=	$data['bag_bal'];
		  $qnt_bal	=	$data['qnt_bal'];
		  $kg_bal	=	$data['kg_bal'];
		  $gm_bal	=	$data['gm_bal'];
	  }	  
	}else{
		$bag_bal = 0;
		$qnt_bal = 0;
		$kg_bal	 = 0;
		$gm_bal  = 0;
	}
	/*echo $bag_bal." ".$prod_bag."<br>";
	echo $qnt_bal." ".$prod_qnt."<br>";
	echo $kg_bal." ".$prod_kg."<br>";
	echo $gm_bal." ".$prod_gm."<br>";*/
	
	if($trans_type=="I"){
		$bag_bal = $bag_bal + $prod_bag;
		$qnt_bal = $qnt_bal + $prod_qnt;
		$kg_bal  = $kg_bal  + $prod_kg;
	        $gm_bal  = $gm_bal  + $prod_gm;	
	}else{
		$bag_bal = $bag_bal - $prod_bag;
                $qnt_bal = $qnt_bal - $pord_qnt;
                $kg_bal  = $kg_bal  - $prod_kg;
                $gm_bal  = $gm_bal  - $prod_gm;

	}


	/*echo $bag_bal."<br>";
	echo $qnt_bal."<br>";
	echo $kg_bal."<br>";
	echo $gm_bal."<br>";*/

		$update = "Update td_stock_trans_pds
			   Set    approval_status = 'A',
				  bag_bal = $bag_bal,
				  qnt_bal= $qnt_bal,
				  kg_bal= $kg_bal,
				  gm_bal = $gm_bal,	
                                  approved_by     = '$user',
                                  approved_dt     = '$time'
                           where  trans_dt        = '$transdt'
                          and    trans_cd        =  $transcd";

             //   echo $update;	                
		
                 $apprv = mysqli_query($db_connect,$update);
	
?>
