<?php
	ini_set("display_errors","1");
	error_reporting("E_ALL");
	
	require("../db/db_connect.php");
	require("../session.php");

	$sql = "select sl_no,prod_desc from m_products";
	$proddesc = mysqli_query($db_connect,$sql);

	$select_catg = "Select prod_catg from m_prod_catg";
	$prodcatg    = mysqli_query($db_connect,$select_catg);

	/*if($_SERVER['REQUEST_METHOD']=="GET"){
		$sl_no 		= $_GET['sl_no'];
		$prod_catg	= $_GET['prod_catg'];	
		$start_dt	= $_GET['start_dt'];
		$end_dt		= $_GET['end_dt'];
		
	//Header("Location:stock_register.php");

		
	}*/




?>

<html>

    <head>

        <title>Synergic Inventory Management System - Stock Register</title>

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

            var    prod_desc        =    $('.validate-input select[name = "prod_desc"]');
            var    prod_catg        =    $('.validate-input select[name = "prod_catg"]');

            var    start_dt         =    $('.validate-input input[name = "start_dt"]');
            var    end_dt           =    $('.validate-input input[name = "end_dt"]');

            $('#form').submit(function(e) {

                var check = true;

                if($(prod_desc).val() == '0') {

                    showValidate(prod_desc);

                    check=false;

                }

                if($(prod_catg).val() == '0') {

                    showValidate(prod_catg);

                    check=false;
                }

                if($(start_dt).val().trim() == '') {

                    showValidate(start_dt);

                    check=false;
                }

                if($(end_dt).val().trim() == '') {

                    showValidate(end_dt);

                    check=false;
                }

                return check;

            });

            showDate(start_dt);

            showDate(end_dt);


            $('.validate-form .input1').each(function() {

                $(this).focus(function(){

                    hideValidate(this);

                });

            });



            function showValidate(input) {

                var thisAlert = $(input).parent();

                //console.log($(input).parent());

                $(thisAlert).addClass('alert-validate');

            }

            function showDate(input) {

                var thisAlert = $(input).parent();

                //console.log($(input).parent());

                $(thisAlert).addClass('alert-date');

            }

            function hideValidate(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).removeClass('alert-validate');

                $(thisAlert).removeClass('alert-date');
            }

        });

    </script>

    <script>

            $(document).ready(function() {

                    $('#prod_desc').change(function () {

                    $('#sl_no').val($(this).find(':selected').attr('data-val'));

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

                                   Stock Register Form

                                </span>

                            <div class="wrap-input1 validate-input" data-validate="Product Name is required">

                                <select class="input1" name="prod_desc" id="prod_desc" >

                                    <option value="0">Select Product</option>

                                    <?php

                                        while($data=mysqli_fetch_assoc($proddesc)){

                                            echo "<option value='".$data['prod_desc']."' data-val='".$data['sl_no']."'>".$data['prod_desc']."</option>";

                                        }

                                    ?>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Date is required">

                                <input type="text" class="input1" name="sl_no" id="sl_no" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Date is required">

                                <select class="input1" name="prod_catg" id="prod_catg">

                                    <option value="0">Select Category</option>

                                    <?php

                                        while($data=mysqli_fetch_assoc($prodcatg)){

                                            echo "<option value=".$data['prod_catg'].">".$data['prod_catg']."</option>";

                                        }

                                    ?>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Start Date is required" date-validate="Start Date">

                                <input type="date" class="input1" name="start_dt" id="start_dt" value="<?php echo date("Y-m-d");?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="End Date is required" date-validate="End Date">

                                <input type=date class="input1" name="end_dt" id="end_dt" value="<?php echo date("Y-m-d");?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="container-contact1-form-btn">

                                <button class="contact1-form-btn">

                                        <span>

                                            Submit

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
