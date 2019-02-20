<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");

	if ($_SERVER["REQUEST_METHOD"]=="POST"){

			$effectdt	=	$_POST["effective_dt"];
			$proddesc	=	$_POST["prod_desc"];
			$prodcatg	=	$_POST['prod_catg'];
			$perunit	=	$_POST['unit_type'];	
			$unitval	=	$_POST['unit_val'];
			$user_id    = 	$_SESSION["user_id"];

			$time = date("Y-m-d h:i:s");

			if($unitval < 0){
			   echo "<script>alert('Value(Kg) can\'t be less then or equals to zero');</script>";

                $effectdt = null;
            }

			elseif(!is_null($effectdt)) {

				$sql="insert into m_allot_scale(effective_dt,
								     prod_desc,
								     prod_catg,
								     per_unit,
								     unit_val,
								     created_by,
								     created_dt)
							      values('$effectdt',
								     '$proddesc',
								     '$prodcatg',
								     '$perunit',
								     '$unitval',
								     '$user_id',
								     '$time'
							     	      )";

                          $result=mysqli_query($db_connect,$sql);

			}

			if($result){
				$_SESSION['ins_flag']=true;
				Header("Location:allot_scale_view.php");
			}

	}
	$select_catg="Select prod_catg, per_unit from m_prod_catg WHERE prod_catg != 'SPHH' ORDER BY prod_catg";
	$prdcatg=mysqli_query($db_connect,$select_catg);

    /*$select_prd="Select prod_desc from m_products";*/
    // For PDS ->
	$select_prd="select sl_no,prod_desc from m_products where prod_type ='PDS'";
	$prddesc=mysqli_query($db_connect,$select_prd);

    // For NON PDS ->
    $select_prd_np="select sl_no,prod_desc from m_products where prod_type ='NON PDS'";
	$prddesc_np=mysqli_query($db_connect,$select_prd);


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

            var    effective_dt     =    $('.validate-input input[name = "effective_dt"]');
            var    prod_catg        =    $('.validate-input select[name = "prod_catg"]');
            var    unit_type        =    $('.validate-input input[name = "unit_type"]');
            var    prod_desc        =    $('.validate-input select[name = "prod_desc"]');
            var    unit_val         =    $('.validate-input input[name = "unit_val"]');


            $('#form').submit(function(e) {

                var check = true;

                $('.validate-form .input1').each(function(){

                    hideAlertdate(this);

                });

                if($(effective_dt).val().trim() == '') {

                    showValidate(effective_dt);

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

            showData(effective_dt);
            showData(prod_catg);
            showData(unit_type);
            showData(prod_desc);
            showData(unit_val);

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

            $('#effective_dt').on("change", function() {

                var today = new Date();

                var to_date = $('#effective_dt').val().split("-");

                var mydate = new Date(to_date[0], to_date[1] - 1, to_date[2]);
                                if (mydate > today) {
                    alert("Arrival date can't be greater than system date!");
                    $('#effective_dt').val('');
                    return false;
                }
            });

            $('#prod_catg').change(function () {

                $('#unit_type').val($(this).find(':selected').attr('data-val'));

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

                               Allotment Scale Setup

                            </span>

                            <div class="wrap-input1 validate-input" data-validate="Date is required" data-alert="Effective Date">

                                <input type="date" class="input1" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-validate="Product category is required" data-alert="Product Category">

                                <select class="input1" name="prod_catg" id="prod_catg">

                                    <option value="0">Select Category</option>

                                        <?php

                                            while($row=mysqli_fetch_assoc($prdcatg)){

                                                echo ("<option value='".$row["prod_catg"]."' data-val='".$row['per_unit']."'>".$row["prod_catg"]."</option>") ;

                                            }

                                        ?>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Category Type">

                                <input type="text" class="input1" name="unit_type" id="unit_type" readonly />

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product name is required" data-alert="Product Name">

                                <select class="input1" name="prod_desc" id="prod_desc">

                                    <option value="0">Select Product</option>

                                    <?php

                                        while($row=mysqli_fetch_assoc($prddesc)){

                                            echo ("<option value='".$row["prod_desc"]."'>".$row["prod_desc"]."</option>") ;

                                        }
                                    ?>
                                </select>

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-validate="Unit is required" data-alert="Scale Unit">

                                <input type="text" class="input1" name="unit_val" id="unit_val" value="0.00" placeholder="Scale" />

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
