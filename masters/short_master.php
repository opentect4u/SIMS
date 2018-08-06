<?php
	ini_set("display_errors","1");
	error_reporting("E_ALL");

	require("../db/db_connect.php");
	require("../session.php");

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$eftdt		=	$_POST['effective_dt'];
		$prodesc	=	$_POST['prod_desc'];
		$prodtype	=	$_POST['prod_type'];
		$prodcatg	=	$_POST['prod_catg'];
		$srtflg		=	$_POST['short_flag'];
		$srtftr		=	$_POST['short_factor'];
		$userid		=	$_SESSION['user_id'];
		$time		=	date("Y-m-d h:i:s");

		if (!is_null($eftdt)){
	             $insert="insert into m_shortage(effective_dt,
					       prod_desc,
				       	       prod_type,
				       	       prod_catg,
				       	       short_flag,
				       	       short_factor,
				       	       created_by,
				       	       created_dt)
					values('$eftdt',
					       '$prodesc',
					       '$prodtype',
	       				       '$prodcatg',
				               '$srtflg',
				               '$srtftr',
				       	       '$userid',
					       '$time')";
		     $data=mysqli_query($db_connect,$insert);
		}
		if($data){
		   $_SESSION['ins_flag']="true";
	   	   Header("Location:short_master_view.php");	   
		}
	}


	$select="Select prod_desc,prod_type from m_products 
		 where prod_type = 'PDS'";
	$prodesc=mysqli_query($db_connect,$select);

	$select_catg = "Select prod_catg from m_prod_catg";
	$prodcatg    = mysqli_query($db_connect,$select_catg);

?>

<html>

    <head>

        <title>Synergic Inventory Management System-Add Shortage Item</title>

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

            var effective_dt = $('.validate-input input[name = "effective_dt"]');
            var prod_desc = $('.validate-input select[name = "prod_desc"]'),
                prod_catg = $('.validate-input select[name = "prod_catg"]'),
                short_flag = $('.validate-input select[name = "short_flag"]');

            $('#form').submit(function(e) {

                var check = true;

                if($(effective_dt).val().trim() == '') {

                    showValidate(effective_dt);

                    check=false;
                }

                if($(prod_desc).val().trim() == '0') {

                    showValidate(prod_desc);

                    check=false;
                }

                if($(prod_catg).val().trim() == '0') {

                    showValidate(prod_catg);

                    check=false;
                }

                if($(short_flag).val().trim() == '0') {

                    showValidate(short_flag);

                    check=false;
                }

                return check;
            });

            $('.validate-form .input1').each(function() {

                $(this).focus(function() {
                    hideValidate(this);
                });

            });

            function showValidate(input) {

                var thisAlert = $(input).parent();

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

            $('#short_flag').change( function () {

                if ($(this).val() == "N"){

                    $('#short_factor').prop("readonly", true);

                    $('#short_factor').val('0.00');

                }

                else {

                    $('#short_factor').prop("readonly", false);

                }
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
                                  Sortage Factor
                                </span>

                            <div class="wrap-input1 validate-input" data-validate="Date required">

                                <input type="date" id="effective_dt" name="effective_dt" class="input1" effective_dt" value="<?php echo date("Y-m-d");?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product name is required">

                                <select name="prod_desc" id="prod_desc" class="input1">

                                    <option value="0">Select Product</option>
                                    <?php

                                        while($data=mysqli_fetch_assoc($prodesc)){
                                            echo "<option value='".$data['prod_desc']."' data-val='".$data['prod_type']."'>".$data['prod_desc']."</option>";
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

                                <select id="prod_catg" name="prod_catg" class="input1">

                                    <option value="0">Select Category</option>

                                    <?php

                                        while($data=mysqli_fetch_assoc($prodcatg)){

                                            echo "<option value=".$data['prod_catg'].">".$data['prod_catg']."</option>";

                                        }

                                    ?>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Flag is required">

                                <select id="short_flag" name="short_flag" class="input1">

                                    <option Value="0">Select Shortage Flag</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product type required">

                                <input type="text" class="input1" id="short_factor" name="short_factor" placeholder="0.0000" />

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
