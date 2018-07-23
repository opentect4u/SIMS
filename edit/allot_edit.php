<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$proddesc=$_GET['prod_desc'];
		$eftdt=$_GET['effective_dt'];
	

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
	<title>Synergic Inventory Management System-Edit Product Category</title>
</head>
<body>
	<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>
	    <tr>
		<td><div class="alignlabel"><label for="effective_dt">Effective Date:</label></div></td>
		<td><input type="date" name="effective_dt" size="150" style="width:400px" value="<?php echo $eftdt; ?>" readonly></td>
	    </tr>

	    <tr>
		<td><div class="alignlabel"><label for="prod_desc">Product:</label></div></td>
		<td><input type="text" name="prod_desc" size="150" style="width:400px" value="<?php echo $proddesc; ?>" readonly></td>
	    </tr>	

	    <tr>			
                <td><div class="alignlabel"><label for="prod_catg"><strong style="color: red;">*</strong>Category:</label></div></td>
		<td><input type="text" id="prod_catg" name="prod_catg" size="150" style="width:400px"value="<?php echo $prodcatg; ?>"readonly></td>
            </tr>

	    
	    <tr>			
                <td><div class="alignlabel"><label for="per_unit"><strong style="color: red;">*</strong>Unit:</label></div></td>
		<td><input type="text" id="per_unit" name="per_unit" size="150" style="width:400px"value="<?php echo $perunit; ?>" readonly ></td>
            </tr>		

	    <tr>			
                <td><div class="alignlabel"><label for="unit_val"><strong style="color: red;">*</strong>Value:</label></div></td>
		<td><input type="text" id="unit_val" name="unit_val" size="150" style="width:400px"value="<?php echo $unitval; ?>"></td>
            </tr>		
		
            <tr>
                <td><input type="submit" name="submit" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>


