<?php

ini_set("display_errors","1");
error_reporting(E_ALL);

require("../db/db_connect.php");
require("../session.php");

    $errMsg = '';

    if ($_SERVER["REQUEST_METHOD"]=="POST"){

        //$qtybag = $qtyqnt = $qtykg = $qtygm = 0.00;

        //$transdt	=	DateTime::createFromFormat('d-m-Y', $_POST["trans_dt"]);
        $trans_dt    =  '2019-02-01';
        //$trans_dt   =   $_POST['trans_dt'];
        $prodslno	=	$_POST["sl_no"];
        $proddesc	=	$_POST["prod_desc"];
        
        $qtybag		=	$_POST['qty_bag'];
        $qtyqnt		=	$_POST['qty_qnt'];	
        $qtykg		=	$_POST['qty_kg'];
        $qtygm		=	$_POST['qty_gm'];	
        
        $prodcatg	=	$_POST['prod_catg'];	
        
        $user_id    =   $_SESSION["user_id"];
        $time       =   date("Y-m-d h:i:s");

        //var_dump($transdt);


        if(array_sum(array($qtybag, $qtyqnt, $qtykg, $qtygm)) > 0) {
            $sql = "SELECT MAX(trans_cd) trans_cd FROM td_stock_trans_pds
                                                  WHERE trans_dt = '$trans_dt'";
            //echo $sql; die;

            $result = mysqli_query($db_connect, $sql);

            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
                $trans_cd = $data['trans_cd']+1;
                //echo $trans_cd; die;
            }

            $sql="insert into td_stock_trans_pds (trans_dt,
                                        trans_cd,
                                        do_no,
                                        prod_sl_no,
                                        prod_desc,
                                        prod_type,
                                        prod_catg,
                                        trans_type,

                                        qty_bag,
                                        qty_qnt,
                                        qty_kg,
                                        qty_gm,

                                        bag_bal,
                                        qnt_bal,
                                        kg_bal,
                                        gm_bal,

                                        remarks,
                                        approval_status,          
                                        created_by,
                                        created_dt,
                                        sht_kg,
                                        sht_gm)

                                        values('$trans_dt',
                                            '$trans_cd',
                                            'opening/1',
                                            '$prodslno',
                                            '$proddesc',
                                            'PDS',
                                            '$prodcatg',
                                            'I',
                                            $qtybag,
                                            $qtyqnt,
                                            $qtykg,
                                            $qtygm,

                                            $qtybag,
                                            $qtyqnt,
                                            $qtykg,
                                            $qtygm,

                                            'Opening Balance',
                                            'A',						     
                                            '$user_id',
                                            '$time',
                                            0,
                                            0)";
                                                
                                            //echo $sql; die;      

            $result=mysqli_query($db_connect,$sql);

            /*if($result){
            $_SESSION['ins_flag']=true;    
                Header("Location:opn_bal_pds.php");
            }	*/

            //redirect("open_bal_pds.php");
            
            Header("Location:opn_bal_pds.php");

        }

        else {

            echo "<script>alert('Transaction Failed');</script>";

        }
       
        
    }

    unset($sql);

    $prod_sql       =   "SELECT sl_no,prod_type,prod_desc FROM m_products WHERE prod_type = 'PDS' ORDER BY sl_no";

    $prod_result    =   mysqli_query($db_connect, $prod_sql);

    $catg_sql	    =   "Select prod_catg from m_prod_catg";

    $result_catg	=   mysqli_query($db_connect,$catg_sql);


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
            var    prod_catg        =    $('.validate-input select[name = "prod_catg"]');

            var    qty_bag          =    $('.validate-input input[name = "qty_bag"]');
            var    qty_qnt          =    $('.validate-input input[name = "qty_qnt"]');
            var    qty_kg           =    $('.validate-input input[name = "qty_kg"]');
            var    qty_gm           =    $('.validate-input input[name = "qty_gm"]');

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

                if($(prod_catg).val() == '0') {

                    showValidate(prod_catg);

                    check=false;
                }

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
            showData(prod_catg);
            showData(prod_type);
            showData(sl_no);

            showData(qty_bag);
            showData(qty_qnt);
            showData(qty_kg);
            showData(qty_gm);


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

            $('#prod_type').val($(this).find(':selected').attr('data-val'));

            $('#sl_no').val($(this).find(':selected').attr('prod-cd'));

            });
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

                                   Opening PDS Stock

                                </span>

                         <!--   <div class="wrap-input1 validate-input" data-validate="Date is required" data-alert="Date">

                                <input type= date class="input1" name="trans_dt" id="trans_dt" value="<?php //echo date("Y-m-d");?>" />

                                <span class="shadow-input1"></span>

                            </div>  -->

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

                            <div class="wrap-input1 validate-input" data-validate="Category is required" data-alert="Category">

                                <select class="input1" name="prod_catg" id="prod_catg" >

                                    <option value="0">Select Category</option>

                                    <?php

                                        while($data=mysqli_fetch_assoc($result_catg)) {

                                            echo ("<option value='".$data['prod_catg']."'>".$data['prod_catg']."</option>");

                                        }

                                    ?>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Product Type">

                                <input type="text" class="input1" name="prod_type" id="prod_type" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Product's Serial No.">

                                <input type="text" class="input1" name="sl_no" id="sl_no" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Bag/Tin" >

                                <input type="text" class="input1" name="qty_bag" value="0.00" placeholder="Bag" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Quint" >

                                <input type="text" class="input1" id="qty_qnt" name="qty_qnt" value="0.00" placeholder="Quintal" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Kgs.">

                                <input type="text" class="input1" id="qty_kg" name="qty_kg" value="0.00" placeholder="Kg" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Grm.">

                                <input type="text" class="input1" id="qty_gm" name="qty_gm" value="0.00" placeholder="Gram" />

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
