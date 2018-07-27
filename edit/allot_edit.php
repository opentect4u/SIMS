<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$proddesc=$_GET['prod_desc'];
		$eftdt=$_GET['effective_dt'];
	

		$rtv="select effective_dt,prod_desc,prod_catg,per_unit,unit_val from m_allot_scale where prod_desc='$proddesc'
											           and  effective_dt='$eftdt'";	

		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$prodcatg=$rtv_data['prod_catg'];
				$perunit=$rtv_data['per_unit'];
				$unitval=$rtv_data['unit_val'];	
					
			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $unitval = 0;
	  
	  if (empty($_POST["unit_val"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $unitval  = test_input($_POST["unit_val"]);
		   $eftdt    = test_input($_POST["effective_dt"]);
		   $proddesc = test_input($_POST["prod_desc"]);
		   $prodcatg = test_input($_POST['prod_catg']);	
		   $perunit  = test_input($_POST['per_unit']);
	     	  } 
	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

		
 	     if(!is_null($unitval) && isset($user_id)) {

		$sql="update m_allot_scale set unit_val='$unitval'
		     where effective_dt ='$eftdt'
		     and   prod_desc ='$proddesc'";

		 
		      	
		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION['allot_scale'] = true;
		Header("Location:../masters/allot_scale_view.php");
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

            var unit_val = $('.validate-input input[name = "unit_val"]');


            $('#form').submit(function(e) {

                var check = true;

                if($(unit_val).val().trim() == '') {

                    showValidate(unit_val);
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

                                  Edit Allotment Sheet
                                    
                                </span>

                            <div class="wrap-input1 validate-input">

                                <input type="date" class="input1" name="effective_dt" value="<?php echo $eftdt; ?>" readonly />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input">

                                <input type="text" class="input1" name="prod_desc" value="<?php echo $proddesc; ?>" readonly />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input">

                                <input type="text" class="input1" id="prod_catg" name="prod_catg" value="<?php echo $prodcatg; ?>"readonly />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input">

                                <input type="text" class="input1" id="per_unit" name="per_unit" value="<?php echo $perunit; ?>" readonly />

                                <span class="shadow-input1"></span>

                            </div>


                            <div class="wrap-input1 validate-input" data-validate="Unit is required">

                                <input type="text" class="input1" id="unit_val" name="unit_val" value="<?php echo $unitval; ?>" />

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


