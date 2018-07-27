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

        $delcdErr = $delnameErr = $delregErr = "";

        if ($_SERVER["REQUEST_METHOD"]=="POST"){

            $delcd = null;

            if (empty($_POST["del_cd"])) {
                $delcdErr = "Invalid Input";
            }else {
                $delcd = test_input($_POST["del_cd"]);
            }

            if (empty($_POST["del_name"])) {
                $delnameErr = "Invalid Input";
            }else {
                $delname = test_input($_POST["del_name"]);
            }

            if (empty($_POST["del_reg"])) {
                $delregErr = "Invalid Input";
            }else {
                $delreg = test_input($_POST["del_reg"]);
            }


			$deladr=$_POST["del_adr"];
			$deldist=$_POST["del_dist"];
			$user_id=$_SESSION["user_id"];
			$time=date("Y-m-d h:i:s");

            if(!is_null($delcd) && isset($user_id)) {
              $sql="insert into m_dealers(del_cd,del_name,del_adr,del_reg,del_dist,created_by,created_dt)
             values('$delcd','$delname','$deladr','$delreg','$deldist','$user_id','$time')";

              $result=mysqli_query($db_connect,$sql);
	    }
			if($result){
				$_SESSION['ins_flag']=true;
				Header("Location:dealer_master_view.php");
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

        <title>Synergic Inventory Management System-Add Dealer</title>

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

            var del_cd = $('.validate-input input[name = "del_cd"]');
            var del_name = $('.validate-input input[name = "del_name"]');
            var del_reg = $('.validate-input input[name = "del_reg"]');

            $('#form').submit(function(e) {

                var check = true;

                if($(del_cd).val().trim() == '') {

                    showValidate(del_cd);

                    check=false;
                }

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

                <div class="col-lg-4 col-md-6">

                    <?php require("../post/menu.php"); ?>

                </div>

                <div class="col-lg-8 col-md-6">

                    <div class="container-contact1">

                        <form class="contact1-form validate-form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                                <span class="contact1-form-title">
                                  Dealer Details
                                </span>

                            <div class="wrap-input1 validate-input" data-validate="Dealer code required">

                                <input type ="text" class="input1" name="del_cd" id="del_cd" placeholder="Dealer Code" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Dealer name required">

                                <input type ="text" class="input1" name="del_name" id="del_name" placeholder="Dealer Name" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product address required">

                                <textarea class="input1" rows ="5" cols="50" name="del_adr" >Enter Address Here..</textarea>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Region required">

                                <input type ="text" class="input1" name="del_reg" id="del_reg" placeholder="Region" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product type required">

                                <?php require '../get_param_val.php'; ?>

                                <input type ="text" class="input1" name="del_dist" value="<?php echo f_getParam(4, $db_connect); ?>" readonly />

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


