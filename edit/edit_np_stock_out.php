<?php
      ini_set("display_errors","1");
      error_reporting("E_ALL");
	
      require("../db/db_connect.php");
      require("../session.php");

      $prodtypeErr="";

    if($_SERVER['REQUEST_METHOD']=="GET"){

      	$trans_dt	=	$_GET['trans_dt'];
	    $trans_cd	=	$_GET['trans_cd'];
	
            $sql="Select allot_no,
                        prod_desc,
                        prod_type,                  
                        prod_sl_no,
                        qty_bags_tin,
                        qty_cs,
                        qty_kg,
                        qty_pieces,
                        remarks 
                        from td_stock_trans_np
            where trans_dt = '$trans_dt'
            and   trans_cd = $trans_cd"; 

            //echo $sql; die();

        $result=mysqli_query($db_connect,$sql);

        if($result){
            if(mysqli_num_rows($result) > 0){

                while($row=mysqli_fetch_assoc($result)){

                    $allot_no	    =	$row['allot_no'];
                    $prod_desc	    =	$row['prod_desc'];
                    $prod_type 	    =	$row['prod_type'];
                    $prod_sl_no	    =	$row['prod_sl_no'];
                    $qty_bags_tin	=	$row['qty_bags_tin'];
                    $qty_cs	        =	$row['qty_cs'];
                    $qty_kg	        =	$row['qty_kg'];
                    $qty_pieces	    =	$row['qty_pieces'];
                    $remarks	    =	$row['remarks'];	
                }	
            }
        }	

    }
           //echo $prod_type; die();

    if($_SERVER['REQUEST_METHOD']=="POST"){

        $qty_bags_tin	=	0;
        $qty_cs	        =	0;
        $qty_kg	        =	0;
        $qty_pieces	    =	0;

        $trans_dt	    =	test_input($_POST['trans_dt']);
        $qty_bags_tin	=	test_input($_POST['qty_bags_tin']);
        $qty_cs	        =	test_input($_POST['qty_cs']);
        $qty_kg 	    =	test_input($_POST['qty_kg']);
        $qty_pieces 	=	test_input($_POST['qty_pieces']);
        $trans_cd	    =	test_input($_POST['trans_cd']);
        $remarks	    =	test_input($_POST['remarks']);

        $user	=	$_SESSION['user_id'];
        $time	=	date("Y-m-d h:i:s");

        if(!is_null($qty_bags_tin) && !is_null($qty_cs) && !is_null($qty_kg) && !is_null($qty_pieces) && isset($user)){
            
            $update="Update td_stock_trans_np
                set qty_bags_tin        = '$qty_bags_tin',
                    qty_cs              = '$qty_cs',
                    qty_kg              = '$qty_kg',
                    qty_pieces          = '$qty_pieces',
                    remarks             = '$remarks',
                    modified_by         = '$user',
                    modified_dt         = '$time'
                where trans_dt          = '$trans_dt'
                and   trans_cd          = '$trans_cd'";

                //echo $update; die();
                    
            $result	= mysqli_query($db_connect,$update);
        }

            if($result){
                $_SESSION['edit_in']="true";
                Header("Location:../transactions/view_stock_out_np.php");
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

        $(document).ready(function() {

            var    trans_dt         =    $('.validate-input input[name = "trans_dt"]');
            var    trans_cd         =    $('.validate-input input[name = "trans_cd"]');
            var    do_no            =    $('.validate-input input[name = "do_no"]');
            var    allot_no         =    $('.validate-input input[name = "allot_no"]');
            var    prod_type        =    $('.validate-input input[name = "prod_type"]');
            var    prod_sl_no       =    $('.validate-input input[name = "prod_sl_no"]');
            var    prod_desc        =    $('.validate-input input[name = "prod_desc"]');
            //var    prod_catg        =    $('.validate-input input[name = "prod_catg"]');
            var    qty_bags_tin     =    $('.validate-input input[name = "qty_bags_tin"]');
            var    qty_cs           =    $('.validate-input input[name = "qty_cs"]');
            var    qty_kg           =    $('.validate-input input[name = "qty_kg"]');
            var    qty_pieces       =    $('.validate-input input[name = "qty_pieces"]');

            showData(trans_dt);
            showData(trans_cd);
            showData(do_no);
            showData(allot_no);
            showData(prod_desc);
            showData(prod_type);
            showData(prod_sl_no);
            showData(qty_bags_tin);
            showData(qty_cs);
            showData(qty_kg);
            showData(qty_pieces);

            function showData(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).addClass('alert-data');

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

                                  Edit NON PDS Stock In

                                </span>

                            <div class="wrap-input1 validate-input" data-alert="Transaction Date">

                                <input type="date" class="input1" name="trans_dt" readonly value="<?php echo date($trans_dt); ?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Transaction Code">

                                <input type="text" class="input1" name="trans_cd" readonly value="<?php echo date($trans_cd); ?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Allotment No">

                                <input type="text" name="allot_no" class="input1" id="allot_no" value="<?php echo $allot_no; ?>" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Product Name">

                                <input type="text" class="input1" name="prod_desc" id="prod_desc" value="<?php echo $prod_desc; ?>" readonly />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-alert="Product Type">

                                <input type="text" class="input1" name="prod_type" id="prod_type" value="<?php echo $prod_type;?>" readonly />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-alert="Product Serial No.">

                                <input type="text" class="input1" name="prod_sl_no" value="<?php echo $prod_sl_no; ?>" id="prod_sl_no" readonly />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-alert="Bag/Tin" >

                                <input type="text" class="input1" id="qty_bags_tin" name="qty_bags_tin" value="<?php echo $qty_bags_tin; ?>" />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-alert="Quint" >

                                <input type="text" class="input1" name="qty_cs" value="<?php echo $qty_cs; ?>" />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-alert="Kgs." >

                                <input type="text" class="input1" name="qty_kg" size="150" value="<?php echo $qty_kg; ?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Grs." >

                                <input type="text" class="input1" name="qty_pieces" value="<?php echo $qty_pieces; ?>" />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input">

                                <textarea class="input1" name="remarks" ><?php echo $remarks; ?></textarea>

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
