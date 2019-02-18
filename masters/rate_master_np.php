<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");

	if ($_SERVER["REQUEST_METHOD"]=="POST"){

			$effective_dt	    =	    $_POST["effective_dt"];
			$prod_cd	        =	    $_POST["prod_cd"];
			$prod_desc	        =	    $_POST["prod_desc"];
			$prod_type	        =	    $_POST["prod_type"];
			//$prodcatg_data	=	    json_decode($_POST['prod_catg']);
            //$prod_type        =       $_POST["prod_type"];
            //$prodcatg         =       $_POST['prod_catg'];
			$unit	            =	    $_POST['unit'];
			$prod_rate	        =	    $_POST['prod_rate'];
			$user_id            = 	    $_SESSION["user_id"];

			$time = date("Y-m-d h:i:s");

			if(!is_null($effective_dt)) {

				$sql="insert into m_rate_master_np(effective_dt,
                                                 prod_cd,
                                                 prod_desc,
                                                 prod_type,                                                 
                                                 per_unit,
                                                 prod_rate,
                                                 created_by,
                                                 created_dt)
                                        values('$effective_dt',
                                                  $prod_cd,
                                                 '$prod_desc',
                                                 '$prod_type', 
                                                 '$unit',
                                                 $prod_rate,
                                                 '$user_id',
                                                 '$time')";

                $result=mysqli_query($db_connect,$sql);
                
               // echo $sql;
			}

			if($result){

				$_SESSION['ins_flag']=true;

				header("Location: rate_master_np_view.php");

            }

	}

    unset($sql);

    $prod_sql       =   "SELECT sl_no,prod_type,prod_desc FROM m_products WHERE prod_type = 'NON PDS' ORDER BY sl_no";

    $prod_result    =   mysqli_query($db_connect, $prod_sql);
	
?>


<html>
    <head>

            <title>Synergic Inventory Management System-Add Product Rate</title>

            <meta name="viewport" content="width=device-width,initial-scale=1.0">

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


            <link rel="stylesheet" type="text/css" href="../css/form_design.css">
            <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
            <link rel="stylesheet" type="text/css" href="../css/autocomplete_style.css">

             <!--jQuery library-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <!-- JQuery Autocomplete -->
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </head>

    <script>

        $(document).ready(function() {

            var    prod_desc        =    $('.validate-input input[name = "prod_desc"]');
            var    prod_cd          =    $('.validate-input select[name = "prod_cd"]');
            var    unit             =    $('.validate-input input[name = "unit"]');
            var    prod_rate        =    $('.validate-input input[name = "prod_rate"]');
            var    effective_dt     =    $('.validate-input input[name = "effective_dt"]');
            var    prod_type        =    $('.validate-input input[name = "prod_type"]');

            $('#form').submit(function(e) {

                var check = true;

                $('.validate-form .input1').each(function(){

                    hideAlertdate(this);

                });

                if($(prod_desc).val().trim() == '0') {

                    showValidate(prod_desc);

                    check = false;

                }

                /*if($(prod_catg).val() == '0') {

                    showValidate(prod_catg);

                    check = false;

                }*/

                if($(per_unit).val() == '0') {

                    showValidate(per_unit);

                    check = false;
                }

                if($(prod_rate).val() < '0') {

                    showValidate(prod_rate);

                    check = false;

                }

                return check;

            });

            showData(prod_desc);
            showData(prod_cd);
            showData(unit);
            showData(prod_rate);
            showData(effective_dt);
            showData(prod_type);

            $('.validate-form .input1').each(function(){

                $(this).focus(function(){

                    hideValidate(this);

                });

            });

            function showData(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).addClass('alert-data');

            }

            function showValidate(input) {

                var thisAlert = $(input).parent();

                //console.log($(input).parent());

                $(thisAlert).addClass('alert-validate');

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

            $('#prod_cd').val($(this).find(':selected').attr('prod-cd'));

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

                                NP Product's Rate

                            </span>

                            <div class="wrap-input1 validate-input" data-alert="Effective Date" >

                                <input type="date" class="input1" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" />

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

                            <div class="wrap-input1 validate-input" data-alert="Serial No.">

                                    <input type= "text" class="input1" name="prod_cd" id="prod_cd" readonly />

                                    <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Product Type" >

                                <input  class="input1" name="prod_type" id="prod_type" value= "NON PDS" readonly />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-validate="Unit type is required" data-alert="unit" >

                                <select class="input1" name="unit" id="unit">

                                    <option>Select Unit</option>
                                    <option> Bags/Tin </option>
                                    <option> Kg </option>
                                    <option> Cs </option>
                                    <option> Pieces </option>
                                
                                </select>

                            </div>
        
                            <div class="wrap-input1 validate-input" data-validate="Rate is required" data-alert="Product Rate" >

                                <input type="text" class="input1" name="prod_rate" id="prod_rate" value="0.00">

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