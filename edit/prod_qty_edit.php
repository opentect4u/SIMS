<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$slno=$_GET['sl_no'];
		$rtv="select sl_no,prod_qty from m_prod_qty where sl_no=".$slno;
		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$slno=$rtv_data['sl_no'];
				$prodqty=$rtv_data['prod_qty'];
			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $prodqty = null;
	
	  if (empty($_POST["prod_qty"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $prodqty = test_input($_POST["prod_qty"]);
		   $slno=test_input($_POST["sl_no"]);
	     	  } 
	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

		
 	     if(!is_null($prodqty) && isset($user_id)) {

		$sql="update m_prod_qty set prod_qty="."'".$prodqty."'".
				           ",modified_by="."'".$user_id."'".
					   ",modified_dt="."'".$time."'".	
		     "where sl_no = ".$slno;


		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION['prod_qty_edit'] = true;
		Header("Location:../masters/prod_qty_view.php");
	     }

	}

        function test_input($data) {
            $data = trim($data);
            return $data;
        }



?>
<html>

    <head>

        <title>Synergic Inventory Management System-Edit Product Scale</title>

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

            var name = $('.validate-input input[name = "prod_qty"]'),
                sl_no = $('.validate-input input[name = "sl_no"]');


            $('#form').submit(function(e) {

                var check = true;

                $('.validate-form .input1').each(function(){

                    hideAlertdate(this);

                });

                if($(name).val().trim() == '') {

                    showValidate(name);
                    check=false;
                }

                return check;
            });

            showData(name);
            showData(sl_no);

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
                //console.log(thisAlert);
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

                         Edit Scale Type

                        </span>

                        <div class="wrap-input1 validate-input" data-alert="Sl No.">

                            <input type="text" class="input1" name="sl_no" value="<?php echo $slno; ?>" readonly />

                            <span class="shadow-input1"></span>
                        </div>

                        <div class="wrap-input1 validate-input" data-validate="Scale is required" data-alert="Scale's Name">

                            <input type="text" class="input1" id="prod_qty" name="prod_qty" value="<?php echo $prodqty; ?>" />

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


