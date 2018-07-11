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

        //==============================

        if (empty($_POST["prod_catg"])) {
            $prodcatgErr = "Invalid Input";
        }else {
            $prodcatg = test_input($_POST["prod_catg"]);
        }

        //==============================

        $srt_flag = test_input($_POST["short_flag"]);

        //==============================
        if (empty($_POST["short_factor"])) {
            $srt_fctrErr = "Invalid Input";
        }else {
            $srt_fctr = test_input($_POST["short_factor"]);
        }

        //==============================


        $user_id=$_SESSION["user_id"];
        $time=date("Y-m-d h:i:s");

        if ($prodtype == "NON PDS") {
            $prodcatg = "NON";
            $srt_fctr = 0;
        }

        if(!is_null($prodtype)&&!is_null($proddesc)) {
          $sql="insert into m_products(prod_type,prod_catg,prod_desc,short_flag,short_factor,created_by,created_dt)
                     values('$prodtype','$prodcatg','$proddesc','$srt_flag','$srt_fctr','$user_id','$time')";
          $result=mysqli_query($db_connect,$sql);
        }
	}

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

	$select = "Select prod_type from m_prod_type";
	$prdtype=mysqli_query($db_connect,$select);

	$select_catg="Select prod_catg from m_prod_catg";
	$prdcatg=mysqli_query($db_connect,$select_catg);


					
?>
<html>
<head>
	<title>Synergic Inventory Management System-Add Product</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/master.css">
</head>
<script>
    $(document).ready(function() {
        $('.defaultHide').hide();

        $('#form').submit(function(e) {
            //e.preventDefault();
            var prod_type = $('#prod_type').val(),
                prod_name = $('#prod_name').val();

            $(".error").remove();


            if (prod_type == 0) {
                e.preventDefault();
                $('#prod_type').after('<span class="error">Invalid Input</span>');
            }
            if ($.isNumeric(prod_name) || prod_name.length < 1) {
                e.preventDefault();
                $('#prod_name').after('<span class="error">Invalid Input</span>');
            }

            if(prod_type == 'PDS') {
                var prod_catg = $('#prod_catg').val();

                if(prod_catg == 0) {
                    e.preventDefault();
                    $('#prod_catg').after('<span class="error">Invalid Input</span>');
                }
                if(short_flag) {

                }
            }
        });

        $('#prod_type').change(function () {
            var prod_type = $('#prod_type').val();

            if (prod_type == 'PDS') {
                $('.defaultHide').show();
                $('#short_flag').html("<option value='Y' selected>Yes</option><option value='N'>No</option>");
                $('#short_factor').val('0.003');
            }
            else{
                $('.defaultHide').hide();
            }
        });

    });
</script>
<body>
	<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
	<table>
		<tr>
			<td><div class="alignlabel"><label for="prod_type"><strong style="color: red;">*</strong>Product Type:</label></div></td>
			<td><select name="prod_type" id="prod_type" style="width:400px">
                     <option value="0">Select</option>
				<?php 
                     while($row=mysqli_fetch_assoc($prdtype)){
					      echo ("<option value='".$row["prod_type"]."'>".$row["prod_type"]."</option>") ;
					 }
				?>
			</select><span class="error"><?php echo $prodtypeErr;?></span></td>
		</tr>
		<tr>
			<td><div class="alignlabel"><label for="prod_name"><strong style="color: red;">*</strong>Product Name:</label></div></td>
			<td><input type="text" placeholder="Enter Product Name" id="prod_name" name="prod_name" size="150" style="width:400px"><span class="error"><?php echo $proddescErr;?></span></td>
		</tr>
		<tr class="defaultHide">
			<td><div class="alignlabel"><label for="prod_catg"><strong style="color: red;">*</strong>Category:</label></div></td>
            <td><select name="prod_catg" id="prod_catg" style="width:400px">
                    <option value="0">Select</option>
                    <?php
                            while($row=mysqli_fetch_assoc($prdcatg)){
                            echo ("<option value='".$row["prod_catg"]."'>".$row["prod_catg"]."</option>") ;
                            }
                    ?>
            </select><span class="error"><?php echo $prodcatgErr;?></span></td>
		</tr>
		<tr class="defaultHide">
			<td><div class="alignlabel"><label for="short_flag"><strong style="color: red;">*</strong>Shortage Flag:</label><div></td>
			<td><select name="short_flag" id="short_flag" style="width:400px">
			    <option value="N">No</option>	
			    <option value="Y">Yes</option> 
			</select><span class="error"></span></td>
		</tr>
		<tr class="defaultHide">
			<td><div class="alignlabel"><label for="short_factor"><strong style="color: red;">*</strong>Shortage Factor:</label><div></td>
			<td><input type="text" id="short_factor" name="short_factor" size="150" stype="width:400px" min=0 /><span class="error"><?php echo $srt_fctrErr;?></span></td>
		</tr>
		<tr>
			<td><input type="submit" name="submit" value="Save"></td>
		</tr>
	</table>
</body>
<html>	 
				  	
	
