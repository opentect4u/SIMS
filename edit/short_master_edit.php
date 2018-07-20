<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$proddesc=$_GET['prod_desc'];
		$eftdt=$_GET['effective_dt'];
	
		echo $proddesc;
		echo $eftdt;

		$rtv="select effective_dt,prod_desc,prod_catg,per_unit,unit_val from m_allot_scale where prod_desc='$proddesc'
											           and  effective_dt='$eftdt'";	

		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$prodcatg=$rtv_data['prod_catg'];
				$perunit=$rtv_data['per_unit'];
				$unitval=$rtv_data['unit_val'];	
					
			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $unitval = 0;
	  
	  if (empty($_POST["unit_val"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $unitval  = test_input($_POST["unit_val"]);
		   $eftdt    = test_input($_POST["effective_dt"]);
		   $proddesc = test_input($_POST["prod_desc"]);
		   $prodcatg = test_input($_POST['prod_catg']);	
		   $perunit  = test_input($_POST['per_unit']);
	     	  } 
	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

		
 	     if(!is_null($unitval) && isset($user_id)) {

		echo $unitval;
		echo $eftdt;
		echo $proddesc;

		$sql="update m_allot_scale set unit_val='$unitval'
		     where effective_dt ='$eftdt'
		     and   prod_desc ='$proddesc'";

		 
		      	
		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION['allot_scale'] = true;
		Header("Location:../masters/allot_scale_view.php");
	     }

	}

function test_input($data) {
			$data = trim($data);
			$data = strtoupper($data);
			return $data;
			}



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
