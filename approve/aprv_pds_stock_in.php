<?php
ini_set("display_errors","1");
error_reporting("E_ALL");

require("../db/db_connect.php");
require("../session.php");

$prodtypeErr="";

if($_SERVER['REQUEST_METHOD']=="GET"){
    $transdt	=	$_GET['trans_dt'];
    $transcd	=	$_GET['trans_cd'];

    $sql="Select do_no,
		     allot_no,		
                     prod_desc,
                     prod_type,
                     prod_catg,
                     prod_sl_no,
                     qty_bag,
                     qty_qnt,
                     qty_kg,
                     qty_gm,
		     remarks,
		     approval_status
                     from td_stock_trans_pds
               where trans_dt = '$transdt'
	       and   trans_cd = $transcd";

    $result	=  mysqli_query($db_connect,$sql);

    if($result){
        if(mysqli_num_rows($result) > 0 ){
            $row = mysqli_fetch_assoc($result);
            $dono   =       $row['do_no'];
            $allotno=	     $row['allot_no'];
            $pdesc  =       $row['prod_desc'];
            $ptype  =       $row['prod_type'];
            $pcatg  =       $row['prod_catg'];
            $pslno  =       $row['prod_sl_no'];
            $pbag   =       $row['qty_bag'];
            $pqnt   =       $row['qty_qnt'];
            $pkg    =       $row['qty_kg'];
            $pgm    =       $row['qty_gm'];
            $rkms   =       $row['remarks'];
            $aprv   =	     $row['approval_status'];

            if($aprv=='U'){
                $status="Unapproved";
            }else{
                $status="Approved";
            }
        }
    }

}

if($_SERVER['REQUEST_METHOD']=="POST"){

    $prod_bag	=	$_POST['qty_bag'];
    $prod_qnt	=	$_POST['qty_qnt'];
    $prod_kg	=	$_POST['qty_kg'];
    $prod_gm	=	$_POST['qty_gm'];
    $status		=	$_POST['approval_status'];
    $user		=	$_SESSION['user_id'];
    $time		=	date("Y-m-d h:m:i");
    $transdt	=	$_POST['trans_dt'];
    $transcd	=	$_POST['trans_cd'];
    $slno		=	$_POST['sl_no'];
    $prodcatg	=	$_POST['prod_catg'];

    if(!is_null($prod_bag) && !is_null($prod_qnt) && !is_null($prod_kg) && !is_null($prod_gm) && isset($user)){
        if($status=="Unapproved"){

            require("update_balance.php");

            /*	$update = "Update td_stock_trans_pds
                      Set    approval_status = 'A',
                         approved_by     = '$user',
                         approved_dt	 = '$time'
                      where  trans_dt        = '$transdt'
                      and    trans_cd	 =  $transcd";

                echo $update;

                $apprv = mysqli_query($db_connect,$update); */
        }
    }
    if($apprv){
        $_SESSION['approve']="true";
        Header("Location:../transactions/view_stock_in_pds.php");
    }

}

?>

<html>

<head>

    <title>Synergic Inventory Management System-Approve Stock Transactions</title>

    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <link rel="stylesheet" type="text/css" href="../css/form_design.css">
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="body">

<?php require '../post/nav.php'; ?>


<h1 class='elegantshadow'>Laxmi Narayan Stores</h1>

<hr class='hr'>

<div class="container" style="margin-left: 10px">

    <div class="row">

        <div class="col-lg-4 col-md-6">

            <?php require("../post/menu.php"); ?>

        </div>

        <div class="col-lg-8 col-md-6">

            <div class="container-contact1">

                <form class="contact1-form validate-form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                                <span class="contact1-form-title">

                                   Allotment Scale Setup

                                </span>

                    <div class="wrap-input1 validate-input">

                        <input type="date" class="input1" name="trans_dt" readonly value="<?php echo date($transdt); ?>" />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="trans_cd" readonly value="<?php echo date($transcd); ?>" />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="do_no" id="do_no" value="<?php echo $dono; ?>" placeholder="DO No." readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="allot_no" id="allot_no" value="<?php echo $allotno; ?>" placeholder="MEMO No." readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="prod_desc" id="prod_desc" value="<?php echo $pdesc; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="prod_catg" id="prod_catg" value="<?php echo $pcatg; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="prod_type" id="prod_type" value="<?php echo $ptype;?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="sl_no" value="<?php echo $pslno; ?>" id="sl_no" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="qty_bag" value="<?php echo $pbag; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="qty_qnt" value="<?php echo $pqnt; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="qty_kg" value="<?php echo $pkg; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="qty_gm" value="<?php echo $pgm; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="approval_status" value="<?php echo $status; ?>" readonly style="color:green;" />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <textarea class="input1" rows="5" cols="50" name="remarks" readonly><?php echo $rkms; ?></textarea>

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="container-contact1-form-btn">

                        <button class="contact1-form-btn">

                                    <span>

                                        Approve

                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script src="../js/collapsible.js"></script>

</body>

</html>
