<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
			$transdt	=	$_POST["trans_dt"];
			$dono		=	$_POST["do_no"];
			$prodslno	=	$_POST["prod_sl_no"];
			$proddesc	=	$_POST["prod_desc"];
			$transtype	=	"O";
			$qtybag		=	$_POST['qty_bag'];
			$qtyqnt		=	$_POST['qty_qnt'];	
			$qtykg		=	$_POST['qty_kg'];
			$qtygm		=	$_POST['qty_gm'];	
			$shtkg		=	$_POST['sht_kg'];
			$shtgm		=	$_POST['sht_gm'];
			$remarks	=	$_POST['remarks'];
			$transcd	=	1;
			$user_id    =   $_SESSION["user_id"];

			$time=date("Y-m-d h:i:s");

                        if(!is_null($dono)) {
				$sql="insert into td_stock_trans_pds(trans_dt,
								     trans_cd,
								     do_no,
								     prod_sl_no,
								     prod_desc,
								     trans_type,
								     qty_bag,
								     qty_qnt,
								     qty_kg,
								     qty_gm,
								     sht_kg,
								     sht_gm,
								     remarks,
								     approval_status,			
								     created_by,
								     created_dt)
							      values('$transdt',
								     '$transcd',
								     '$dono',
								     '$prodslno',
								     '$proddesc',
								     '$transtype',
							     	     '$qtybag',
								     '$qtyqnt',
								     '$qtykg',
								     '$qtygm',
								     '$shtkg',
								     '$shtgm',
								     '$remarks',
								     'U',									     
								     '$user_id',
								     '$time')";

                          $result=mysqli_query($db_connect,$sql);
                        }

        }

?>

<html>

	<head>

		<title>Synergic Inventory Management System</title>

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

    <script>

        $(document).ready(function() {

            var    do_no            =    $('.validate-input input[name = "do_no"]');
            var    prod_sl_no       =    $('.validate-input input[name = "prod_sl_no"]');
            var    prod_desc        =    $('.validate-input input[name = "prod_desc"]');


            $('#form').submit(function(e) {

                var check = true;

                if($(do_no).val().trim() == '') {

                    showValidate(do_no);

                    check = false;

                }

                if($(prod_sl_no).val() == '') {

                    showValidate(prod_sl_no);

                    check = false;

                }

                if($(prod_desc).val() == '') {

                    showValidate(prod_desc);

                    check=false;
                }

                return check;

            });



            $('.validate-form .input1').each(function(){

                $(this).focus(function(){

                    hideValidate(this);

                });

            });



            function showValidate(input) {

                var thisAlert = $(input).parent();

                //console.log($(input).parent());

                $(thisAlert).addClass('alert-validate');

            }

            function hideValidate(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).removeClass('alert-validate');
            }

        });

    </script>

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

                                   Stock Out Setup

                                </span>

                            <div class="wrap-input1 validate-input" >

                                <input type="date" class="input1" name="trans_dt" readonly value="<?php echo date("Y-m-d") ?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="DO No is required" >

                                <input type="text" class="input1" id="do_no" name="do_no"  placeholder="DO No."/>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product serial no is required">

                                <input type="text" class="input1" id="prod_sl_no" name="prod_sl_no" placeholder="Product Code" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product Name is required" >

                                <input type="text" class="input1" id="prod_desc" name="prod_desc" placeholder="Product Name" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" >

                                <input type="text" class="input1" name="qty_bag" placeholder="Bag/ Tin" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" >

                                <input type="text" class="input1" name="qty_qnt" placeholder="Quintal" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" >

                                <input type="text" class="input1" name="qty_kg" placeholder="Kg" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" >

                                <input type="text" class="input1" name="qty_gm" placeholder="Grm" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" >

                                <input type="text" class="input1" name="sht_kg" placeholder="Short Kg" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" >

                                <input type="text" class="input1" name="sht_gm" placeholder="Short grm" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" >

                                <textarea class="input1" name="remarks" >Enter Remarks If Any..

                                </textarea>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="container-contact1-form-btn">

                                <button class="contact1-form-btn">

                                            <span>

                                                Save

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
