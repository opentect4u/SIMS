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
		     prod_desc,
                     prod_type,
                     prod_catg,
                     prod_sl_no,
                     qty_bag,
                     qty_qnt,
                     qty_kg,
                     qty_gm,
                     remarks 
                     from td_stock_trans_pds
	       where trans_dt = '$transdt'
	       and   trans_cd = $transcd"; 

	$result=mysqli_query($db_connect,$sql);

	if($result){
		if(mysqli_num_rows($result) > 0){

		while($row=mysqli_fetch_assoc($result)){
	  	$dono	=	$row['do_no'];
		$pdesc	=	$row['prod_desc'];
		$ptype 	=	$row['prod_type'];
		$pcatg	=	$row['prod_catg'];
		$pslno	=	$row['prod_sl_no'];
		$pbag	=	$row['qty_bag'];
		$pqnt	=	$row['qty_qnt'];
		$pkg	=	$row['qty_kg'];
		$pgm	=	$row['qty_gm'];
		$rkms	=	$row['remarks'];	
	  	}	
	  }
	}	

      }
           

      if($_SERVER['REQUEST_METHOD']=="POST"){

        $prod_bag	=	0;
        $prod_qnt	=	0;
        $prod_kg	=	0;
        $prod_gm	=	0;


        $transdt	=	test_input($_POST['trans_dt']);
        $prod_bag	=	test_input($_POST['qty_bag']);
        $prod_qnt	=	test_input($_POST['qty_qnt']);
        $prod_kg 	=	test_input($_POST['qty_kg']);
        $prod_gm 	=	test_input($_POST['qty_gm']);
        $transcd	=	test_input($_POST['trans_cd']);
        $remarks	=	test_input($_POST['remarks']);

        $user	=	$_SESSION['user_id'];
        $time	=	date("Y-m-d h:i:s");

        if(!is_null($prod_bag) && !is_null($prod_qnt) && !is_null($prod_kg) && !is_null($prod_gm) && isset($user)){
            $update="Update td_stock_trans_pds
                 set qty_bag = '$prod_bag',
                     qty_qnt = '$prod_qnt',
                     qty_kg  = '$prod_kg',
                     qty_gm  = '$prod_gm',
                     remarks = '$remarks',
                     modified_by = '$user',
                     modified_dt = '$time'
                  where trans_dt = '$transdt'
                  and   trans_cd = '$transcd'";

            $result	= mysqli_query($db_connect,$update);
            }
            if($result){
                $_SESSION['edit_in']="true";
                Header("Location:../transactions/view_stock_in_pds.php");
            }
      }

	function test_input($data) {

        $data = trim($data);

        return $data;

    }

	
?>

<html>

	<head>

		<title>Synergic Inventory Management System-Add Stock</title>

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

        $(document).ready( function() {
            var    qty_bag          =    $('.validate-input input[name = "qty_bag"]');
            var    qty_qnt          =    $('.validate-input input[name = "qty_qnt"]');
            var    qty_kg           =    $('.validate-input input[name = "qty_kg"]');
            var    qty_gm           =    $('.validate-input input[name = "qty_gm"]');

            $('.validate-form .input1').each( function() {

                $(this).focus(function(){

                    hideValidate(this);

                });

            });


            showData(qty_bag);
            showData(qty_qnt);
            showData(qty_kg);
            showData(qty_gm);

            function showData(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).addClass('alert-data');

            }

            function hideValidate(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).removeClass('alert-data');
            }

        });

    </script>


    <body class="body">

        <?php require '../post/nav.php'; ?>

        <h1 class='elegantshadow'>Laxmi Narayan Stores</h1>

        <hr class='hr'>

        <div class="container" style="margin-left: 10px">

            <div class="row">

                <div class="col-lg-4 col-md-2">

                    <?php require("../post/menu.php"); ?>

                </div>

                <div class="col-lg-8 col-md-10">

                    <div class="container-contact1">

                        <form class="contact1-form validate-form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                                <span class="contact1-form-title">
                                  Dealer Details
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

                                <input type="text" name="do_no" class="input1" id="do_no" value="<?php echo $dono; ?>" readonly />

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


                            <div class="wrap-input1 validate-input" data-alert="Bag/Tin" >

                                <input type="text" class="input1" id="qty_bag" name="qty_bag" value="<?php echo $pbag; ?>" />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-alert="Quint" >

                                <input type="text" class="input1" name="qty_qnt" value="<?php echo $pqnt; ?>" />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-alert="Kgs." >

                                <input type="text" class="input1" name="qty_kg" size="150" value="<?php echo $pkg; ?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Grs." >

                                <input type="text" class="input1" name="qty_gm" value="<?php echo $pgm; ?>" />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input">

                                <textarea class="input1" name="remarks" ><?php echo $rkms; ?></textarea>

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
