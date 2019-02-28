<?php

	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
    require("../session.php");
    
        $errMsg = '';

    $prod_sql       =   "SELECT sl_no,prod_type,prod_desc FROM m_products WHERE prod_type = 'NON PDS' ORDER BY sl_no";
    $prod_result    =   mysqli_query($db_connect, $prod_sql);

    if ($_SERVER["REQUEST_METHOD"]=="POST"){

        $originalDate = $_POST["trans_dt"];

        $myDateTime = DateTime::createFromFormat('d-m-Y', $originalDate);
        $trans_dt = $myDateTime->format('y-m-d');

        //$trans_dt       =   $_POST["trans_dt"];

        $dono		    =	$_POST["do_no"];
        $prod_type      =   $_POST["prod_type"];
        $prod_sl_no     =   $_POST["sl_no"];
        $trans_type	    =	"I";
        $prod_desc      =   $_POST["prod_desc"];
        $qty_bag_tin    =   $_POST["qty_bag_tin"];
        $qty_cs         =   $_POST["qty_cs"];
        $qty_kg         =   $_POST["qty_kg"];
        $qty_pieces     =   $_POST["qty_pieces"];
        $remarks	    =	$_POST['remarks'];
        $trans_cd	    =	1;
        $user_id        =   $_SESSION["user_id"];
        $time           =   date("Y-m-d h:i:s");
     
        if(array_sum(array($qty_bag_tin, $qty_cs, $qty_kg, $qty_pieces)) > 0 && !is_null($dono)) {

            $sql = "SELECT MAX(trans_cd) trans_cd FROM td_stock_trans_np
                                                WHERE trans_dt = '$trans_dt'";

            $result = mysqli_query($db_connect, $sql);

            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
                $trans_cd += $data['trans_cd'];
            }

            $sql= "insert into td_stock_trans_np ( trans_dt,
                                                     trans_cd,
                                                     do_no,
                                                     prod_sl_no,
                                                     prod_desc,
                                                     prod_type,
                                                     trans_type,
                                                     qty_bags_tin,
                                                     qty_cs,
                                                     qty_kg,
                                                     qty_pieces,
                                                     remarks,
                                                     approval_status,			
                                                     created_by,
                                                     created_dt)

                                                values('$trans_dt',
                                                     '$trans_cd',
                                                     '$dono',
                                                      $prod_sl_no,
                                                     '$prod_desc',
                                                     '$prod_type',
                                                     '$trans_type',
                                                      $qty_bag_tin,
                                                      $qty_cs,
                                                      $qty_kg,
                                                      $qty_pieces,
                                                     '$remarks',
                                                     'U',									     
                                                     '$user_id',
                                                     '$time')";
                 
                $result=mysqli_query($db_connect,$sql);

                //echo $sql; die();

			    if($result){
				$_SESSION['ins_flag']=true;    
			    	Header("Location:view_stock_in_np.php");
			    }	
        }

        else {

            echo "<script>alert('Please Insert Valid Unit, Transaction Failed');</script>";

        }
    }

    unset($sql);

    $prod_sql       =   "SELECT sl_no,prod_type,prod_desc FROM m_products WHERE prod_type = 'NON PDS' ORDER BY sl_no";

    $prod_result    =   mysqli_query($db_connect, $prod_sql);
?>

<html>
    <head>

        <title>Synergic Inventory Management System-Add Stock</title>

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

            var    trans_dt         =    $('.validate-input input[name = "trans_dt"]');
            var    do_no            =    $('.validate-input input[name = "do_no"]');
            var    prod_type        =    $('.validate-input input[name = "prod_type"]');
            var    sl_no            =    $('.validate-input input[name = "sl_no"]');
            var    prod_desc        =    $('.validate-input select[name = "prod_desc"]');
            //var    prod_catg        =    $('.validate-input select[name = "prod_catg"]');
            var    qty_bag_tin          =    $('.validate-input input[name = "qty_bag_tin"]');
            var    qty_cs          =    $('.validate-input input[name = "qty_cs"]');
            var    qty_kg           =    $('.validate-input input[name = "qty_kg"]');
            var    qty_pieces           =    $('.validate-input input[name = "qty_pieces"]');

            $('#form').submit(function(e) {

                 var check = true;

                $('.validate-form .input1').each(function(){

                    hideAlertdate(this);

                });

                if($(do_no).val().trim() == '') {

                    showValidate(do_no);

                    check=false;

                }

                if($(prod_desc).val() == '0') {

                    showValidate(prod_desc);

                    check=false;

                }

                /*if($(prod_catg).val() == '0') {

                    showValidate(prod_catg);

                    check=false;
                }*/

                return check;

            });

            $('.validate-form .input1').each( function() {

                $(this).focus(function(){

                    hideValidate(this);

                });

            });

            showData(trans_dt);
            showData(do_no);
            showData(prod_desc);
            //showData(prod_catg);
            showData(prod_type);
            showData(sl_no);

            showData(qty_bag_tin);
            showData(qty_cs);
            showData(qty_kg);
            showData(qty_pieces);

            function showValidate(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).addClass('alert-validate');

            }

            function showData(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).addClass('alert-data');

            }

            function hideValidate(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).removeClass('alert-validate');

            }

            function hideAlertdate(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).removeClass('alert-data');

            }

        });

    </script>

    <script>

        $(document).ready(function() {

            $('#prod_desc').change(function () {

            //$('#prod_type').val($(this).find(':selected').attr('data-val'));

            $('#sl_no').val($(this).find(':selected').attr('prod-cd'));

            });
        });

    </script>

    <body class="body">

        <?php require '../post/nav.php'; ?>
        <h1 class='elegantshadow'>Laxmi Narayan Stores</h1>
        <hr class='hr'>
        <div class="container" style="margin-left: 10px">
            <div class= "row">
                <div class="col-lg-4 col-md-6">

                    <?php require("../post/menu.php"); ?>

                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="container-contact1">
                    
                        <form class="contact1-form validate-form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                                <span class="contact1-form-title">

                                    Stock In NON PDS

                                </span>
                                <div class="wrap-input1 validate-input" data-alert="Transaction Date">

                                    <input type="text" class="input1" name="trans_dt" value="<?php echo date("d-m-y", strtotime(f_getparamval(7, $db_connect))) ?>" readonly />

                                    <span class="shadow-input1"></span>

                                </div>
                                <div class="wrap-input1 validate-input" data-validate="DO No. is required" data-alert="Do No.">

                                    <input type="text" class="input1" name="do_no" id="do_no" placeholder="DO Number" />

                                    <span class="shadow-input1"></span>

                                </div>
                                <div class="wrap-input1 validate-input" data-alert="Product Type">

                                    <input type="text" class="input1" name="prod_type" value= "NON PDS" id="prod_type" readonly />

                                    <span class="shadow-input1"></span>

                                </div>
                                <div class="wrap-input1 validate-input" data-validate="Product name is required" data-alert="Product Name">

                                    <select class="input1" name="prod_desc" id="prod_desc">

                                        <option value="0">Select Product</option>

                                        <?php

                                            while($row=mysqli_fetch_assoc($prod_result)){

                                                echo("<option value='".$row['prod_desc']."' data-val='".$row['prod_type']."' prod-cd='".$row['sl_no']."'>".$row['prod_desc']."</option>");

                                            }

                                        ?>

                                    </select>

                                    <span class="shadow-input1"></span>

                                </div>

                                <div class="wrap-input1 validate-input" data-alert="Product's Serial No.">

                                    <input type="text" class="input1" name="sl_no" id="sl_no" readonly />

                                    <span class="shadow-input1"></span>

                                </div>

                                <div class="wrap-input1 validate-input" data-alert="Bag/Tin" >

                                    <input type="text" class="input1" name="qty_bag_tin" value="0.00" placeholder="Bag" />

                                    <span class="shadow-input1"></span>

                                </div>
                                <div class="wrap-input1 validate-input" data-alert="C/S" >

                                    <input type="text" class="input1" id="c/s" name="qty_cs" value="0.00" placeholder="C/S" />

                                    <span class="shadow-input1"></span>

                                </div>
                                <div class="wrap-input1 validate-input" data-alert="Kgs" >

                                    <input type="text" class="input1" id="kgs" name="qty_kg" value="0.00" placeholder="kgs" />

                                    <span class="shadow-input1"></span>

                                </div>
                                <div class="wrap-input1 validate-input" data-alert="Pieces" >

                                    <input type="text" class="input1" id="pieces" name="qty_pieces" value="0.00" placeholder="Pieces" />

                                    <span class="shadow-input1"></span>

                                </div>
                                <div class="wrap-input1 validate-input" data-validate="Date is required">

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