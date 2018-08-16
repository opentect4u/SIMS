<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$slno=$_GET['sl_no'];
		$rtv="select sl_no,prod_catg,per_unit from m_prod_catg where sl_no=".$slno;
		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$slno=$rtv_data['sl_no'];
				$prodcatg=$rtv_data['prod_catg'];
				$produnit=$rtv_data['per_unit'];
			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $prodcatg = null;
	  $produnit = null;	
	
	  if (empty($_POST["prod_catg"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $prodcatg = test_input($_POST["prod_catg"]);
		   $slno=test_input($_POST["sl_no"]);
		   $produnit=test_input($_POST['per_unit']);	
	     	  } 
	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

	 	
		
 	     if(!is_null($prodcatg) && isset($user_id)) {

		$sql="update m_prod_catg set prod_catg="."'".$prodcatg."'".
					   ",per_unit="."'".$produnit."'".	
				           ",modified_by="."'".$user_id."'".
					   ",modified_dt="."'".$time."'".	
		     "where sl_no = ".$slno;


		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION['prod_catg_edit'] = true;
		Header("Location:../masters/prod_catg_view.php");
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

        $(document).ready( function () {

            var name = $('.validate-input input[name = "prod_catg"]'),
                sl_no = $('.validate-input input[name = "sl_no"]'),
                per_unit = $('.validate-input select[name = "per_unit"]');


            $('#form').submit(function(e) {

                var check = true;

                $('.validate-form .input1').each(function(){

                    hideAlertdate(this);

                });

                if($(name).val().trim() == '') {

                    showValidate(name);
                    check=false;
                }

                if($(per_unit).val().trim() == '0') {

                    showValidate(per_unit);
                    check=false;
                }

                return check;
            });

            showData(name);
            showData(sl_no);
            showData(per_unit);

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

                        <div class="wrap-input1 validate-input" data-alert="Sl No.">

                            <input type="text" class="input1" id="sl_no" name="sl_no" value="<?php echo $slno; ?>" readonly/>

                            <span class="shadow-input1"></span>

                        </div>

                        <div class="wrap-input1 validate-input" data-validate="Product's Category is required" data-alert="Product's Category">

                            <input type="text" class="input1" id="prod_catg" name="prod_catg" value="<?php echo $prodcatg; ?>" placeholder="Category"/>

                            <span class="shadow-input1"></span>

                        </div>

                        <div class="wrap-input1 validate-input" data-validate="Product is required" data-alert="Product's Category">

                            <select class="input1" name="per_unit" id="per_unit" >

                                <option value="0">Select</option>

                                <option value="Family" <?php echo ($produnit == "Family")?'selected':'';?> >Family</option>

                                <option value="Head" <?php echo ($produnit == "Head")?'selected':'';?> >Head</option>

                            </select>

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


