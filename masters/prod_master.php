<?php
	require("../db/db_connect.php");
	require("../session.php");
//	require("nav.php");
//	echo"<br><br>";
//	echo "<h1 class='elegantshadow'>Laxmi Narayan Stores</h1>";
//      echo "<hr class='hr'>";

//	require("menu.php");

    $prodtypeErr = $proddescErr = $prodcatgErr = $srt_fctrErr = '';

	if ($_SERVER["REQUEST_METHOD"]=="POST"){

        $prodtype = null;

        if (empty($_POST["prod_type"])) {
            $prodtypeErr = "Invalid Input";
        }else {
            $prodtype = test_input($_POST["prod_type"]);
        }

        //==============================

        if (empty($_POST["prod_name"])) {
            $proddescErr = "Invalid Input";
        }else {
            $proddesc = test_input($_POST["prod_name"]);
        }

        var_dump($prodtype);

        var_dump($proddesc);

        $user_id = $_SESSION["user_id"];
        $time = date("Y-m-d h:i:s");


        if(!is_null($prodtype)&&!is_null($proddesc)) {

          $sql="insert into m_products(prod_type,prod_desc,created_by,created_dt)
                     values('$prodtype','$proddesc','$user_id','$time')";
          echo $sql;
          $result=mysqli_query($db_connect,$sql);
	    }

		if($result){
            var_dump($result);
             $_SESSION['ins_flag']=true;
             Header("Location: prod_master_view.php");
        }


	}

    function test_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

	$select = "Select prod_type from m_prod_type";

	$prdtype=mysqli_query($db_connect,$select);

?>
<html>

    <head>

        <title>Synergic Inventory Management System-Add Product</title>

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

            var prod_type = $('.validate-input select[name = "prod_type"]');

            var perunit = $('.validate-input input[name = "prod_name"]');

            $('#form').submit(function(e) {

                var check = true;

                $('.validate-form .input1').each(function(){

                    hideAlertdate(this);

                });

                if($(perunit).val().trim() == '') {

                    showValidate(perunit);
                    check=false;
                }

                if($(prod_type).val().trim() == '0') {

                    showValidate(prod_type);
                    check=false;
                }

                return check;

            });

            showData(prod_type);
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

                              Add Product

                            </span>

                            <div class="wrap-input1 validate-input" data-validate="Product type required" data-alert="Product Type">

                                <select class="input1" name="prod_type" id="prod_type">

                                    <option value="0">Select Product Type</option>

                                    <?php

                                        while($row=mysqli_fetch_assoc($prdtype)){

                                            echo ("<option value='".$row["prod_type"]."'>".$row["prod_type"]."</option>") ;

                                        }

                                    ?>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product Name is required" data-alert="Product Name">

                                <input type="text" class="input1" id="prod_name" name="prod_name" placeholder="Product Name" />

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
				  	
	
