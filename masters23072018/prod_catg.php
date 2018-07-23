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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../css/master.css">	
</head>
<script>
    $(document).ready(function() {

        $('#form').submit(function(e) {
            var prod_type = $('#prod_catg').val(),
                per_unit  = $('#per_unit').val();

            $(".error").remove();

            if (prod_type.length < 1) {
                e.preventDefault();
                $('#prod_catg').after('<span class="error">Invalid Input</span>');
            }

            if (per_unit == 0) {
                e.preventDefault();
                $('#per_unit').after('<span class="error">Invalid Input</span>');
            }

        });

    });
</script>
<body>
	<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>
            <tr>
                <td><div class="alignlabel"><label for="prod_catg"><strong style="color: red;">*</strong>Category:</label></div></td>
                <td><input type ="text" id="prod_catg" name="prod_catg" size="150" style="width:400px"></td>
            </tr>
            <tr>
                <td><div class="alignlabel"><label for="per_unit"><strong style="color: red;">*</strong>Unit:</label></div></td>
                <td><select name="per_unit" id="per_unit" style="width:400px">
                                    <option value="0">Select</option>
                                    <option value="Family">Family</option>
                                    <option value="Head">Head</option>
                                </select>
                            </td>

            </tr>


            <tr>
                <td><input type="submit" name="submit" value="Save"></td>
            </tr>
        </table>
    </form>
</body>
<html>	 
				  	
	
