<?php
      	ini_set("display_errors","1");
	error_reporting(E_ALL);
	
	require("../db/db_connect.php");
	require("../session.php");

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
		$userid	  = check($_POST["user_id"]);
		$pwd      = check($_POST["user_pwd"]);
		$pwd_hash = password_hash($pwd,PASSWORD_DEFAULT);
		$uname    = check($_POST["user_name"]);
		$utype    = check($_POST["user_type"]);
		$create   = $_SESSION["user_id"];
		$time	  = date("Y-m-d h:i:s");

		if (!is_null($userid) && !is_null($pwd)){
		
		       $sql = "insert into m_login_user(user_id,
							password,
							user_type,
			   			   	user_name,
							user_status,
					   	   	created_by,
							created_dt)
					   	values('$userid',
						       '$pwd_hash',
						       '$utype',
						       '$uname',
						       'A',
				            	       '$create',
						       '$time')";
		       $result = mysqli_query($db_connect,$sql);

		       echo "<script>alert('User Created');</script>";
		}
	}

	function check($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
	}

?>

<html>

    <head>

        <title>Synergic Inventory Management System</title>

        <meta name="viewport" content="width=device-width,initial-scale=1.0">

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

            var    user_id          =    $('.validate-input input[name = "user_id"]');
            var    user_pwd         =    $('.validate-input input[name = "user_pwd"]');
            var    user_name        =    $('.validate-input input[name = "user_name"]');
            var    user_type        =    $('.validate-input select[name = "user_type"]');


            $('#form').submit(function(e) {

                var check = true;

                if($(user_id).val().trim() == '') {

                    showValidate(user_id);

                    check=false;

                }

                if($(user_pwd).val().trim() == '') {

                    showValidate(user_pwd);

                    check=false;

                }

                if($(user_name).val().trim() == '') {

                    showValidate(user_name);

                    check=false;

                }


                if($(user_type).val() == '0') {

                    showValidate(user_type);

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

                //console.log($(input).parent());

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

                                       User Creation

                                    </span>

                            <div class="wrap-input1 validate-input" data-validate="User Id is required" >

                                <input type="text" class="input1" id="user_id" name="user_id" placeholder="User Id" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="User password is required" >

                                <input type="password" class="input1" name="user_pwd" placeholder="User Password" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="User name is required" >

                                <input type="text" class="input1" name="user_name"  placeholder="User's Name" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="User type is required">

                                <select name="user_type" class="input1">

                                    <option value="0">Select Role</option>

                                    <option value="A">Administrator</option>

                                    <option value="G">General</option>

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

						 
	     					 
