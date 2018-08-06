<?php
        ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");
//      require("nav.php");
//      echo"<br><br>";
//      echo "<h1 class='elegantshadow'>Laxmi Narayan Stores</h1>";
//      echo "<hr class='hr'>";

//      require("menu.php");

        if ($_SERVER["REQUEST_METHOD"]=="POST"){
                        $prodqty=$_POST["prod_qty"];
                        $user_id=$_SESSION["user_id"];
                        $time=date("Y-m-d h:i:s");

                        if(!is_null($prodqty)) {
                          $sql="insert into m_prod_qty(prod_qty,created_by,created_dt)
                                                 values('$prodqty','$user_id','$time')";
                          $result=mysqli_query($db_connect,$sql);                                 
			} 

		  	if($result){
                             $_SESSION['ins_flag']=true;
                             Header("Location:prod_qty_view.php");
                        }       
	
                        
        }

?>
<html>

    <head>

        <title>Synergic Inventory Management System-Product Scale</title>

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

            var name = $('.validate-input input[name = "prod_qty"]');


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
                                  Scale Type
                                </span>

                            <div class="wrap-input1 validate-input" data-validate="Unit is required">
                                <input type="text" class="input1" id="prod_qty" name="prod_qty" placeholder="Scale Type" />
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


