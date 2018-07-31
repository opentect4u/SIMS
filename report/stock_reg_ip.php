<?php
	ini_set("display_errors","1");
	error_reporting("E_ALL");
	
	require("../db/db_connect.php");
	require("../session.php");

	$sql = "select sl_no,prod_desc from m_products";
	$proddesc = mysqli_query($db_connect,$sql);

	$select_catg = "Select prod_catg from m_prod_catg";
	$prodcatg    = mysqli_query($db_connect,$select_catg);

	/*if($_SERVER['REQUEST_METHOD']=="GET"){
		$sl_no 		= $_GET['sl_no'];
		$prod_catg	= $_GET['prod_catg'];	
		$start_dt	= $_GET['start_dt'];
		$end_dt		= $_GET['end_dt'];
		
	//Header("Location:stock_register.php");

		
	}*/




?>

<html>
<head>
	<title>Synergic Inventory Management System - Stock Register</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<script>
        $(document).ready(function() {
                $('#prod_desc').change(function () {

                $('#sl_no').val($(this).find(':selected').attr('data-val'));

            });
        });

</script>


	<body>
	<form action = "stock_register.php" method = "POST" >
	<table>
		<tr>
		    <td><div class="aligntable"><label for="prod_desc"><strong style="color:red;">*</strong>Product:</label></div></td>
                    <td><select name="prod_desc" id="prod_desc" style="width:400px;">
                        <option value="0">Select</option>
                        <?php
				while($data=mysqli_fetch_assoc($proddesc)){
					echo "<option value='".$data['prod_desc']."' data-val='".$data['sl_no']."'>".$data['prod_desc']."</option>";
                                }
                        ?>
                        </select>
		    </td>

		    <td><div class="aligntable"><label for="sl_no"><strong style="color:red;">*</strong>Sl.No.:</label></div></td>
                    <td><input type="text" name="sl_no" id="sl_no" style="width:400px" size="150" readonly></td>	

		</tr>

		<tr>
                    <td><div class="aligntable"><label for="prod_catg"><strong style="color:red;">*</strong>Category:</label></div></td>
                    <td><select name="prod_catg" style="width:400px;">
                    <option value="0">Select</option>
                    <?php
                        while($data=mysqli_fetch_assoc($prodcatg)){
                        echo "<option value=".$data['prod_catg'].">".$data['prod_catg']."</option>";
                        }
                    ?>
                    </select></td>
                </tr>

		<tr>
                    <td><div class="aligntable"><label for="start_date"><strong style="color:red;">*</strong>Start Date:</label></div></td>
                    <td><input type=date name="start_dt"value="<?php echo date("Y-m-d");?>" size="50" style="width:150px"></td>
           
                    <td><div class="aligntable"><label for="end_date"><strong style="color:red;">*</strong>End Date:</label></div></td>
                    <td><input type=date name="end_dt"value="<?php echo date("Y-m-d");?>" size="50" style="width:150px"></td>
                </tr>
		
		 <tr>
                    <td><input type="submit" name="submit" value="Ok">
                </tr>

		
	</table>
	</body>	
</html>
