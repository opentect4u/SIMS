<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$slno=$_GET['sl_no'];
		$rtv="select sl_no,prod_type from m_prod_type where sl_no=".$slno;
		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$slno=$rtv_data['sl_no'];
				$prodtype=$rtv_data['prod_type'];
			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $prodtype = null;
	
	  if (empty($_POST["prod_type"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $prodtype = test_input($_POST["prod_type"]);
		   $slno=test_input($_POST["sl_no"]);
	     	  } 
	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

	 	
		
 	     if(!is_null($prodtype) && isset($user_id)) {

		$sql="update m_prod_type set prod_type="."'".$prodtype."'".",modified_by="."'".$user_id."'".",modified_dt="."'".$time."'".
		     "where sl_no = ".$slno;


		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION[prod_type_edit] = true;
		Header("Location:../masters/prod_type_view.php");
	     }

	}

function test_input($data) {
			$data = trim($data);
			$data = strtoupper($data);
			return $data;
			}



?>
<html>

    <head>

        <title>Synergic Inventory Management System-Edit Product Type</title>

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
        
        $(document).ready( function () {

            var name = $('.validate-input input[name = "prod_type"]');


            $('#form').submit(function(e) {

                var check = true;

                if($(name).val().trim() == '') {

                    showValidate(name);
                    check=false;
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
                //console.log(thisAlert);
                $(thisAlert).addClass('alert-validate');
            }

            function hideValidate(input) {
                var thisAlert = $(input).parent();

                $(thisAlert).removeClass('alert-validate');
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
                              Edit Product Type
                            </span>

                            <div class="wrap-input1 validate-input">
                                <input type="text" class="input1" id="sl_no" name="sl_no" value="<?php echo $slno; ?>" placeholder="Category" readonly/>
                                <span class="shadow-input1"></span>
                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product is required">
                                <input type="text" class="input1" id="prod_type" name="prod_type" value="<?php echo $prodtype; ?>" placeholder="Category">
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


