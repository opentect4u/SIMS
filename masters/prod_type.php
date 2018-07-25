<?php

	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");

	require("../session.php");

//	require("nav.php");
//	echo"<br><br>";
//	echo "<h1 class='elegantshadow'>Laxmi Narayan Stores</h1>";
//      echo "<hr class='hr'>";

//	require("menu.php");

	if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $prodtype = null;

            if (empty($_POST["prod_type"])) {

                echo "<script>alert('Invalid Input')</script>";

            }
            else {

                $prodtype = test_input($_POST["prod_type"]);

            }

			$user_id=$_SESSION["user_id"];

			$time=date("Y-m-d h:i:s");


			if(!is_null($prodtype) && isset($user_id)) {

			  $sql="insert into m_prod_type(prod_type,created_by,created_dt)
		   				 values('$prodtype','$user_id','$time')";
			  $result=mysqli_query($db_connect,$sql);
			}
			
			if($result){

				$_SESSION['ins_flag'] = true;

				Header("Location:prod_type_view.php");

			}

	}

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>
<html>
<head>
	<title>Synergic Inventory Management System-Add Product Type</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <link rel="stylesheet" type="text/css" href="../css/form_design.css">
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<script>

    $(document).ready(function() {

        var name = $('.validate-input input[name = "prod_type"]');
        var check = true;

        $('#form').submit(function(e) {

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
                           Products Type
                        </span>

                        <div class="wrap-input1 validate-input" data-validate="Product type is required">
                            <input type="text" class="input1" id="prod_type" name="prod_type" placeholder="Product Type" autofocus>
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




<script type="text/javascript">

    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }

    document.getElementById("loutbtn").onclick = function() {
        location.href = "../logout.php";
    }
    document.getElementById("dashbtn").onclick = function() {
        location.href = "http://localhost/SIMS/post/dashboard.php";
    }
</script>

</body>

<html>	 
				  	
	
