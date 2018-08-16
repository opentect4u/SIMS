<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");

	require("../session.php");


	if ($_SERVER["REQUEST_METHOD"]=="POST"){
			$prodcatg=$_POST["prod_catg"];
			$produnit=$_POST["per_unit"];
			$user_id=$_SESSION["user_id"];
			$time=date("Y-m-d h:i:s");

			if(!is_null($prodcatg) && isset($user_id)) {
			  $sql="insert into m_prod_catg(prod_catg,per_unit,created_by,created_dt)
		   				 values('$prodcatg','$produnit','$user_id','$time')";
			  $result=mysqli_query($db_connect,$sql);				  
			}
			if($result){
				$_SESSION['ins_flag']=true;
				Header("Location:prod_catg_view.php");
			}				
		}

?>
<html>

    <head>
	<title>Synergic Inventory Management System-Add Category</title>
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

        var name = $('.validate-input input[name = "prod_catg"]');

        var perunit = $('.validate-input select[name = "per_unit"]');

        $('#form').submit(function(e) {

            var check = true;

            $('.validate-form .input1').each(function(){

                hideAlertdate(this);

            });

            if($(name).val().trim() == '') {

                showValidate(name);
                check=false;
            }

            if($(perunit).val().trim() == '0') {

                showValidate(per_unit);
                check=false;
            }

            console.log(check);

            return check;
        });

        showData(name);
        showData(perunit);

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

                                   Product Category

                                </span>

                            <div class="wrap-input1 validate-input" data-validate="Category is required" data-alert="Category Name">

                                <input type="text" class="input1" id="prod_catg" name="prod_catg" placeholder="Category" autofocus>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Unit required" data-alert="Category Type">

                                <select name="per_unit" class="input1" id="per_unit">

                                    <option value="0">Select Unit</option>

                                    <option value="Family">Family</option>

                                    <option value="Head">Head</option>

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

<html>	 
				  	
	
