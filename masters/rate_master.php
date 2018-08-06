<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
			$effectdt	=	$_POST["effective_dt"];
			$proddesc	=	$_POST["prod_desc"];
			$prodtype	=	$_POST["prod_type"];
			$prodcatg	=	$_POST['prod_catg'];
			$perunit	=	$_POST['per_unit'];	
			$prodrate	=	$_POST['prod_rate'];
			$user_id    	= 	$_SESSION["user_id"];

			$time = date("Y-m-d h:i:s");

			if(!is_null($effectdt)) {

				echo $prodtype;
				echo $perunit;

				$sql="insert into m_rate_master(effective_dt,
								     prod_desc,
								     prod_type,
								     prod_catg,
								     per_unit,
								     prod_rate,
								     created_by,
								     created_dt)
							      values('$effectdt',
								     '$proddesc',
								     '$prodtype',
								     '$prodcatg',
								     '$perunit',
								     '$prodrate',
								     '$user_id',
								     '$time'
							     	      )";

                          $result=mysqli_query($db_connect,$sql);
			}

			if($result){
				$_SESSION['ins_flag']=true;
				Header("Location:rate_master_view.php");
			}

	}
	$select_catg="Select prod_catg from m_prod_catg ORDER BY prod_catg";
	$prdcatg=mysqli_query($db_connect,$select_catg);

	$select_prd="Select prod_desc,prod_type from m_products";
	$prdesc=mysqli_query($db_connect,$select_prd);


	$select_unit="Select sl_no,prod_qty from m_prod_qty";
	$produnit=mysqli_query($db_connect,$select_unit);


?>
<html>
	<head>

		<title>Synergic Inventory Management System-Add Product Rate</title>

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
            var    per_unit         =    $('.validate-input select[name = "per_unit"]');
            var    prod_rate        =    $('.validate-input input[name = "prod_rate"]');

            $('#form').submit(function(e) {

                var check = true;

                if($(prod_desc).val().trim() == '0') {

                    showValidate(prod_desc);

                    check = false;

                }

                if($(prod_catg).val() == '0') {

                    showValidate(prod_catg);

                    check = false;

                }

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

    <script>

        $(document).ready(function() {

                $('#prod_desc').change(function () {

                $('#prod_type').val($(this).find(':selected').attr('data-val'));

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

                                   PDS Product Rate

                                </span>

                            <div class="wrap-input1 validate-input">

                                <input type="date" class="input1" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product is required">

                                <select name="prod_desc" class="input1" id="prod_desc" >

                                    <option value="0">Select Product</option>

                                    <?php

                                        while($row=mysqli_fetch_assoc($prdesc)) {

                                            echo ("<option value=".$row['prod_desc']." data-val=".$row['prod_type'].">".$row['prod_desc']."</option>");

                                        }

                                    ?>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input">

                                <input type="text" class="input1" name="prod_type" id="prod_type" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Category is required">

                                <select name="prod_catg" class="input1" id="prod_catg">

                                    <option value="0">Select Category</option>

                                    <?php

                                        while($row=mysqli_fetch_assoc($prdcatg)) {

                                            echo("<option value=".$row['prod_catg'].">".$row['prod_catg']."</option>");

                                        }

                                    ?>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Unit type is required">

                                <select name="per_unit" class="input1" id="per_unit" >

                                    <option value="0">Select Unit Type</option>

                                    <?php

                                        while($row=mysqli_fetch_assoc($produnit)) {

                                            echo ("<option value=".$row['prod_qty'].">".$row['prod_qty']."</option>");

                                        }
                                    ?>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Rate is required">

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
