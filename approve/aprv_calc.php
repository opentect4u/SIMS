<?php
	ini_set("display_errors","1");
	error_reporting("E_ALL");
	
	require("../post/sims_function.php");
	require("../db/db_connect.php");

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$memono	= $_GET['memo_no'];
		$gendt	= $_GET['gen_date'];
		$distno	= f_getparamval(2,$db_connect);
		$user   = $_SESSION["user_id"];
		$time   =date("Y-m-d h:i:s");	
/*AAY Rice Update*/

		$aay_rice	= f_getrate(1,1,$db_connect);
		$ar_sql = "update td_allotment_sheet
		           set    ar_unit  = $aay_rice,
				  ar_tot   = aay_rice * $aay_rice
			   where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
			   and    approval_status  = 'U'";

		$ar_result = mysqli_query($db_connect,$ar_sql);

/*AAY Wheat Update*/

		$aay_wheat	= f_getrate(1,2,$db_connect);
		$aw_sql = "update td_allotment_sheet
                           set    aw_unit  = $aay_wheat,
				  aw_tot   = aay_wheat * $aay_wheat
			   where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

                $aw_result = mysqli_query($db_connect,$aw_sql);

/*AAY Atta Update*/

		$aay_atta	= f_getrate(1,3,$db_connect);
		$aa_sql = "update td_allotment_sheet
                           set    aa_unit  = $aay_atta,
				  aa_tot   = aay_atta * $aay_atta
			   where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

		$aa_result = mysqli_query($db_connect,$aa_sql);

/*AAY Sugar Update*/

		$aay_sugar	= f_getrate(1,4,$db_connect);
		$as_sql = "update td_allotment_sheet
                           set    as_unit  = $aay_sugar,
				  as_tot   = aay_sugar * $aay_sugar
			    where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

		$as_result = mysqli_query($db_connect,$as_sql);

/*PHH Rice Update*/

		$phh_rice 	= f_getrate(2,1,$db_connect);
		$pr_sql = "update td_allotment_sheet
                           set    pr_unit  = $phh_rice,
				  pr_tot   = phh_rice * $phh_rice
			   where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

                $pr_result = mysqli_query($db_connect,$pr_sql);

/*PHH Wheat Update*/

		$phh_wheat	= f_getrate(2,2,$db_connect);
		$pw_sql = "update td_allotment_sheet
                           set    pw_unit  = $phh_wheat,
				  pw_tot   = phh_wheat * $phh_wheat
			    where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

		$pw_result = mysqli_query($db_connect,$pw_sql);

/*PHH Atta Update*/

		$phh_atta	= f_getrate(2,3,$db_connect);
		$pa_sql = "update td_allotment_sheet
                           set    pa_unit  = $phh_atta,
				  pa_tot   = phh_atta * $phh_atta
			    where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

                $pa_result = mysqli_query($db_connect,$pa_sql);

/*SPHH Rice Update*/

		$sphh_rice      = f_getrate(3,1,$db_connect);
                $sr_sql = "update td_allotment_sheet
                           set    sr_unit  = $sphh_rice,
				  sr_tot   = sphh_rice * $sphh_rice
			    where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

                $sr_result = mysqli_query($db_connect,$sr_sql);

/*SPHH Wheat Update*/

		$sphh_wheat     = f_getrate(3,2,$db_connect);
		$sw_sql = "update td_allotment_sheet
                           set    sw_unit  = $sphh_wheat,
				  sw_tot   = sphh_wheat * $sphh_wheat
			    where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

                $sw_result = mysqli_query($db_connect,$sw_sql);

/*SPHH Atta Update*/

		$sphh_atta      = f_getrate(3,3,$db_connect);
		$sa_sql = "update td_allotment_sheet
                           set    sa_unit  = $sphh_atta,
				  sa_tot   = sphh_atta * $sphh_atta
			    where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

		$sa_result = mysqli_query($db_connect,$sa_sql);

/*SPHH Sugar Update*/		

		$sphh_sugar     = f_getrate(3,4,$db_connect);
		$ss_sql = "update td_allotment_sheet
                           set    ss_unit  = $sphh_sugar,
				  ss_tot   = sphh_sugar * $sphh_sugar
			    where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

                $ss_result = mysqli_query($db_connect,$ss_sql);

/*RKSY1 Rice Update*/

		$rksy1_rice     = f_getrate(4,1,$db_connect);
		$rr1_sql = "update td_allotment_sheet
                            set    rr1_unit  = $rksy1_rice,
				   rr1_tot   = rksy1_rice * $rksy1_rice
			     where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

		$rr1_result = mysqli_query($db_connect,$rr1_sql);

/*RKSY1 Wheat Update*/		

		$rksy1_wheat    = f_getrate(4,2,$db_connect);
		$rw1_sql = "update td_allotment_sheet
                            set    rw1_unit  = $rksy1_wheat,
				   rw1_tot   = rksy1_wheat * $rksy1_wheat
			   where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

		$rw1_result = mysqli_query($db_connect,$rw1_sql);

/*RKSY1 Atta Update*/

		$rksy1_atta     = f_getrate(4,3,$db_connect);
		$ra1_sql = "update td_allotment_sheet
                            set    ra1_unit  = $rksy1_atta,
				   ra1_tot   = rksy1_atta * $rksy1_atta
			    where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

                $ra1_result = mysqli_query($db_connect,$ra1_sql);

/*RKSY2 Rice Update*/

		$rksy2_rice     = f_getrate(5,1,$db_connect);
		$rr2_sql = "update td_allotment_sheet
                            set    rr2_unit  = $rksy2_rice,
				   rr2_tot   = rksy2_rice * $rksy2_rice
			    where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

                $rr2_result = mysqli_query($db_connect,$rr2_sql);

/*RKSY2 Wheat Update*/

		$rksy2_wheat    = f_getrate(5,2,$db_connect);
		$rw2_sql = "update td_allotment_sheet
                            set    rw2_unit  = $rksy2_wheat,
				   rw2_tot   = rksy2_wheat * $rksy2_wheat
			     where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

		$rw2_result = mysqli_query($db_connect,$rw2_sql);

/*RKSY2 Atta Update*/		

                $rksy2_atta     = f_getrate(5,3,$db_connect);
		$ra2_sql = "update td_allotment_sheet
                            set    ra2_unit  = $rksy2_atta,
				   ra2_tot   = rksy2_atta * $rksy2_atta
			     where  gen_date         = '$gendt'
                           and    memo_no          = '$memono'
                           and    approval_status  = 'U'";

                $ra2_result = mysqli_query($db_connect,$ra2_sql);
/*Set The Sum*/
	    $sql = "select ifnull(sum(aay_rice),0)aay_rice,
		       ifnull(sum(aay_wheat),0)aay_wheat,
       		       ifnull(sum(aay_atta),0)aay_atta,
		       ifnull(sum(aay_sugar),0)aay_sugar,	
		       ifnull(sum(phh_rice),0)phh_rice,
		       ifnull(sum(phh_wheat),0)phh_wheat,
		       ifnull(sum(phh_atta),0)phh_atta,
		       ifnull(sum(sphh_rice),0)sphh_rice,
		       ifnull(sum(sphh_wheat),0)sphh_wheat,	
		       ifnull(sum(sphh_atta),0)sphh_atta,	
		       ifnull(sum(sphh_sugar),0)sphh_sugar,
		       ifnull(sum(rksy1_rice),0)rksy1_rice,
		       ifnull(sum(rksy1_wheat),0)rksy1_wheat,
		       ifnull(sum(rksy1_atta),0)rksy1_atta,
		       ifnull(sum(rksy2_rice),0)rksy2_rice,
                       ifnull(sum(rksy2_wheat),0)rksy2_wheat,
		       ifnull(sum(rksy2_atta),0)rksy2_atta
		  from td_allotment_sheet
		  where memo_no = '$memono'";

	     $result = mysqli_query($db_connect,$sql);
	     $row    = mysqli_fetch_assoc($result);

	     $aay_rice_tot 	= $row['aay_rice'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',1,1,$aay_rice_tot,'O')";
	     $in_result = mysqli_query($db_connect,$insert);

	     $aay_wheat_tot	= $row['aay_wheat'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',1,2,$aay_wheat_tot,'O')";
	     $in_result = mysqli_query($db_connect,$insert);

	     $aay_atta_tot      = $row['aay_atta'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',1,3,$aay_atta_tot,'O')";
	     $in_result = mysqli_query($db_connect,$insert);

	     $aay_sugar_tot     = $row['aay_sugar'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',1,4,$aay_sugar_tot,'O')";
             $in_result = mysqli_query($db_connect,$insert);

	     $phh_rice_tot      = $row['phh_rice'];	
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',2,1,$phh_rice_tot,'O')";
             $in_result = mysqli_query($db_connect,$insert);	

	     $phh_wheat_tot     = $row['phh_wheat'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',2,2,$phh_wheat_tot,'O')";
             $in_result = mysqli_query($db_connect,$insert);
	

	     $phh_atta_tot	= $row['phh_atta'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',2,3,$phh_atta_tot,'O')";
             $in_result = mysqli_query($db_connect,$insert);


	     $sphh_rice_tot     = $row['sphh_rice'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',3,1,$sphh_rice_tot,'O')";
             $in_result = mysqli_query($db_connect,$insert);

	     $sphh_wheat_tot    = $row['sphh_wheat']; 
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',3,2,$sphh_wheat_tot,'O')";
             $in_result = mysqli_query($db_connect,$insert);
	
	     $sphh_atta_tot     = $row['sphh_atta'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',3,3,$sphh_atta_tot,'O')";
             $in_result = mysqli_query($db_connect,$insert);

	     $sphh_sugar_tot    = $row['sphh_sugar'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',3,4,$sphh_sugar_tot,'O')";
             $in_result = mysqli_query($db_connect,$insert);

   	
	     $rksy1_rice_tot    = $row['rksy1_rice'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',4,1,$rksy1_rice_tot,'O')";
             $in_result = mysqli_query($db_connect,$insert);
	
	     $rksy1_wheat_tot   = $row['rksy1_wheat'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',4,2,$rksy1_wheat_tot,'O')";
	     $in_result = mysqli_query($db_connect,$insert);

	     $rksy1_atta_tot    = $row['rksy1_atta'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',4,3,$rksy1_atta_tot,'O')";
             $in_result = mysqli_query($db_connect,$insert); 

	     $rksy2_rice_tot    = $row['rksy2_rice'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',5,1,$rksy2_rice_tot,'O')";
	     $in_result = mysqli_query($db_connect,$insert);

	     $rksy2_wheat_tot   = $row['rksy2_wheat'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',5,2,$rksy2_wheat_tot,'O')";
	     $in_result = mysqli_query($db_connect,$insert);

	     $rksy2_atta_tot    = $row['rksy2_atta'];
	     $insert = "insert into td_allot_dtls(trans_dt,allot_no,catg_cd,prod_cd,prod_qty,allot_status)
                        values('$gendt','$memono',5,3,$rksy2_atta_tot,'O')";
             $in_result = mysqli_query($db_connect,$insert);

/*Update Approval status*/
                $approve = "update td_allotment_sheet
			    set    approval_status  = 'A',
				   approved_by      = '$user',
				   approved_dt      = '$time'
			    where  gen_date	    = '$gendt'
			    and    memo_no	    = '$memono'";

                $aprv_result = mysqli_query($db_connect,$approve);

		if($aprv_result){
			$_SESSION['approve']="true";
			Header("Location:aprv_allot_sheet.php");
		
		}
   }
?>


