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

    $prodtypeErr = "";

	if ($_SERVER["REQUEST_METHOD"]=="POST") {
            $prodtype = null;

            if (empty($_POST["prod_type"])) {
                $prodtypeErr = "Invalid Input";
            }else {
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../css/master.css">
</head>
<script>
    $(document).ready(function() {

        $('#form').submit(function(e) {
            var prod_type = $('#prod_type').val();

            $(".error").remove();

            if (prod_type.length < 1) {
                e.preventDefault();
                $('#prod_type').after('<span class="error">Invalid Input</span>');
            }
        });

    });
</script>
<body>
	<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>
            <tr>
                <td><div class="alignlabel"><label for="prod_type"><strong style="color: red;">*</strong>Product Type:</label></div></td>
                <td><input type="text" id="prod_type" name="prod_type" size="150" style="width:400px"><span class="error"><?php echo $prodtypeErr;?></span></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Save"></td>
            </tr>
        </table>
    </form>
</body>
<html>	 
				  	
	
