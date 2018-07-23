<?php
	ini_set("display_errors","1");
	error_reporting("E_ALL");

	require("../db/db_connect.php");
	require("../session.php");

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$eftdt		=	$_POST['effective_dt'];
		$prodesc	=	$_POST['prod_desc'];
		$prodtype	=	$_POST['prod_type'];
		$prodcatg	=	$_POST['prod_catg'];
		$srtflg		=	$_POST['short_flag'];
		$srtftr		=	$_POST['short_factor'];
		$userid		=	$_SESSION['user_id'];
		$time		=	date("Y-m-d h:i:s");

		if (!is_null($eftdt)){
	             $insert="insert into m_shortage(effective_dt,
					       prod_desc,
				       	       prod_type,
				       	       prod_catg,
				       	       short_flag,
				       	       short_factor,
				       	       created_by,
				       	       created_dt)
					values('$eftdt',
					       '$prodesc',
					       '$prodtype',
	       				       '$prodcatg',
				               '$srtflg',
				               '$srtftr',
				       	       '$userid',
					       '$time')";
		     $data=mysqli_query($db_connect,$insert);
		}
		if($data){
		   $_SESSION['ins_flag']="true";
	   	   Header("Location:short_master_view.php");	   
		}
	}


	$select="Select prod_desc,prod_type from m_products";
	$prodesc=mysqli_query($db_connect,$select);

	$select_catg = "Select prod_catg from m_prod_catg";
	$prodcatg    = mysqli_query($db_connect,$select_catg);

?>

<html>
<head>
	<title>Synergic Inventory Management System-Add Shortage Item</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/master.css">

</head>
<script>
	$(document).ready(function() {
		$('#prod_desc').change(function () {

                $('#prod_type').val($(this).find(':selected').attr('data-val'));

            });
	});

</script>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
		 
	<table>
		<tr>
		    <td><div class="aligntable"><label for="effective_date"><strong style="color:red;">*</strong>Effective Date:</label></div></td>
		    <td><input type=date name="effective_dt"value="<?php echo date("Y-m-d");?>" size="50" style="width:150px"></td>
		</tr>

		<tr>
		    <td><div class="aligntable"><label for="prod_desc"><strong style="color:red;">*</strong>Product:</label></div></td>	
		    <td><select name="prod_desc" id="prod_desc" style="width:400px;">
			<option value="0">Select</option>
			<?php
				while($data=mysqli_fetch_assoc($prodesc)){
				   echo "<option value='".$data['prod_desc']."' data-val='".$data['prod_type']."'>".$data['prod_desc']."</option>";
				}
			?>
			</select>	
		    </td>		
		</tr>

		<tr>
		    <td><div class="aligntable"><label for="prod_type">Product Type:</label></div></td>	
		    <td><input type="text" name="prod_type" id="prod_type" style="width:400px" size="150" readonly></td>
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
		    <td><div class="aligntable"><label for="short_flag"><strong style="color:red;">*</strong>Shortage Flag:</label></div></td>	
		    <td><select name="short_flag" style="width:400px;">
			<option Value='0'>Select</option>
			<option value="Y">Yes</option>
			<option value='N'>No</option>
			</select></td>
		</tr>

		<tr>
		    <td><div class="aligntable"><label for="short_falctor"><strong style="color:red">*</strong>Shortage Factor:</lable></div></td>
		    <td><input type="text" name="short_factor" placeholder="0.0000" style="width:150px">	
		</tr>

		<tr>
		    <td><input type="submit" name="submit" value="Save"> 
		</tr>
		
	</table>
	</form>
</body>
</html>	
