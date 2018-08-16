<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$slno=$_GET['sl_no'];
		$rtv="select sl_no,del_cd,del_name,del_adr,del_reg,del_dist from m_dealers where sl_no=".$slno;
		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$slno=$rtv_data['sl_no'];
				$delcd=$rtv_data['del_cd'];
				$delname=$rtv_data['del_name'];
				$deladr=$rtv_data['del_adr'];
				$delreg=$rtv_data['del_reg'];
				$deldist=$rtv_data['del_dist'];
			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $delname = null;
	  $deladr  = null;	
	  $delreg  = null; 
	  $deldist = null;  	
	
	  if (empty($_POST["del_name"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $delname = test_input($_POST["del_name"]);
		   $slno=test_input($_POST["sl_no"]);
		   $deladr=test_input($_POST['del_adr']);
		   $delreg=test_input($_POST['del_reg']);
	     	  } 
	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

		
 	     if(!is_null($delname) && isset($user_id)) {

		$sql="update m_dealers set del_name="."'".$delname."'".
					   ",del_adr="."'".$deladr."'".
					   ",del_reg="."'".$delreg."'".
				           ",modified_by="."'".$user_id."'".
					   ",modified_dt="."'".$time."'".	
		     "where sl_no = ".$slno;


		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION['dealer_master'] = true;
		Header("Location:../masters/dealer_master_view.php");
	     }

	}

    function test_input($data) {

			$data = trim($data);
			return $data;

	}



?>
<html>

    <head>

        <title>Synergic Inventory Management System-Edit Product Category</title>

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

            var del_name = $('.validate-input input[name = "del_name"]');
            var del_reg = $('.validate-input input[name = "del_reg"]');
            var del_cd = $('.validate-input input[name = "del_cd"]');

            $('#form').submit(function(e) {

                var check = true;

                $('.validate-form .input1').each(function(){

                    hideAlertdate(this);

                });

                if($(del_name).val().trim() == '') {

                    showValidate(del_name);
                    check=false;
                }

                if($(del_reg).val().trim() == '') {

                    showValidate(del_reg);
                    check=false;
                }

                return check;

            });

            showData(del_name);
            showData(del_reg);
            showData(del_cd);

            $('.validate-form .input1').each(function() {

                $(this).focus(function() {
                    hideValidate(this);
                });

            });

            function showData(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).addClass('alert-data');

            }

            function showValidate(input) {

                var thisAlert = $(input).parent();

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

                <div class="col-lg-4 col-md-2">

                    <?php require("../post/menu.php"); ?>

                </div>

                <div class="col-lg-8 col-md-10">

                    <div class="container-contact1">

                        <form class="contact1-form validate-form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                                <span class="contact1-form-title">

                                  Edit Dealer Details

                                </span>

                                <input type="hidden" name="sl_no" value="<?php echo $slno; ?>" readonly />

                            <div class="wrap-input1 validate-input" data-alert="Dealer Code" >

                                <input type="text" class="input1" name="del_cd" value="<?php echo $delcd; ?>" readonly />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-validate="Dealer Name required" data-alert="Dealer Name">

                                <input type="text" class="input1" id="del_name" name="del_name" value="<?php echo $delname; ?>" />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input">

                                <textarea class="input1" rows ="5" cols="50" id="del_adr" name="del_adr">

                                    <?php echo $deladr; ?>

                                </textarea>

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-validate="Region is required" data-alert="Region">

                                <input type="text" class="input1" id="del_reg" name="del_reg" value="<?php echo $delreg; ?>" />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input">

                                <input type="text" class="input1" id="del_dist" name="del_dist" value="<?php echo $deldist; ?>" readonly />

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


