<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$slno=$_GET['sl_no'];
		$rtv="select sl_no,prod_type,prod_desc from m_products where sl_no=".$slno;
		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$slno=$rtv_data['sl_no'];
				$prodtype=$rtv_data['prod_type'];
			  	$proddesc=$rtv_data['prod_desc'];

			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $proddesc = null;
	
	  if (empty($_POST["prod_desc"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $proddesc = test_input($_POST["prod_desc"]);
		   $slno=test_input($_POST["sl_no"]);
		   $prodtype=test_input($_POST['prod_type']);

	     	  } 

	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

		
 	     if(!is_null($proddesc) && isset($user_id)) {


		$sql="update m_products set prod_desc="."'".$proddesc."'".
				           ",modified_by="."'".$user_id."'".
					   ",modified_dt="."'".$time."'".	
		     "where sl_no = ".$slno;


		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION['prod_edit'] = true;
		Header("Location:../masters/prod_master_view.php");
	     }

	}

    function test_input($data) {
        $data = trim($data);
        return $data;

    }

?>

<html>

    <head>

        <title>Synergic Inventory Management System-Edit Product</title>

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

            var prod_desc = $('.validate-input input[name = "prod_desc"]'),
                sl_no = $('.validate-input input[name = "sl_no"]'),
                prod_type = $('.validate-input input[name = "prod_type"]');

            $('#form').submit(function(e) {

                var check = true;

                $('.validate-form .input1').each(function(){

                    hideAlertdate(this);

                });

                $('.validate-form .input1').each(function(){

                    hideAlertdate(this);

                });

                if($(prod_desc).val().trim() == '') {

                    showValidate(prod_desc);
                    check=false;
                }

                return check;
            });

            showData(prod_desc);
            showData(sl_no);
            showData(prod_type);

            $('.validate-form .input1').each(function() {

                $(this).focus(function() {
                    hideValidate(this);
                });

            });

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

            function hideAlertdate(input) {

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

                <div class="col-lg-4 col-md-6">

                    <?php require("../post/menu.php"); ?>

                </div>

                <div class="col-lg-8 col-md-6">

                    <div class="container-contact1">

                        <form class="contact1-form validate-form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                                <span class="contact1-form-title">

                                  Edit Product

                                </span>

                            <div class="wrap-input1 validate-input" data-alert="Sl No.">

                                <input type="text" class="input1" name="sl_no" value="<?php echo $slno; ?>" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product Type is required" data-alert="Product Type" >

                                <input type="text" class="input1" name="prod_type" value="<?php echo $prodtype; ?>" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product Name is required" data-alert="Product Name">

                                <input type="text" class="input1" id="prod_desc" name="prod_desc" value="<?php echo $proddesc; ?>" placeholder="Product Name" />

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


