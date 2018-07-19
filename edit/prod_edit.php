<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$slno=$_GET['sl_no'];
		$rtv="select sl_no,prod_type,prod_catg,prod_desc,short_flag,short_factor from m_products where sl_no=".$slno;
		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$slno=$rtv_data['sl_no'];
				$prodcatg=$rtv_data['prod_catg'];
				$prodtype=$rtv_data['prod_type'];
			  	$proddesc=$rtv_data['prod_desc'];
				$prodsflg=$rtv_data['short_flag'];
			  	$prodsftr=$rtv_data['short_factor'];

			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $proddesc = null;
	  $prodsflg = null;
	  $prodsftr = 0;	
	
	  if (empty($_POST["prod_desc"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $proddesc = test_input($_POST["prod_desc"]);
		   $slno=test_input($_POST["sl_no"]);
		   $prodsflg=test_input($_POST['short_flag']);
		   $prodsftr=test_input($_POST['short_factor']);
		   $prodtype=test_input($_POST['prod_type']);
		   $prodcatg=test_input($_POST['prod_catg']);	

	     	  } 

	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

		
 	     if(!is_null($proddesc) && isset($user_id)) {


		$sql="update m_products set prod_desc="."'".$proddesc."'".
					   ",short_flag="."'".$prodsflg."'".	
					   ",short_factor="."'".$prodsftr."'".
				           ",modified_by="."'".$user_id."'".
					   ",modified_dt="."'".$time."'".	
		     "where sl_no = ".$slno;


		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION['prod_edit'] = true;
		Header("Location:../masters/prod_master_view.php");
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
	<title>Synergic Inventory Management System-Edit Product</title>
</head>
<body>
	<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>
	    <tr>
		<td><div class="alignlabel"><label for="sl_no">Sl.No.:</label></div></td>
		<td><input type="text" name="sl_no" size="150" style="width:400px" value="<?php echo $slno; ?>" readonly></td>
	    </tr>
		
	    <tr>			
                <td><div class="alignlabel"><label for="prod_type"><strong style="color: red;">*</strong>Product Type:</label></div></td>
		<td><input type="text" name="prod_type" size="150" style="width:400px" value="<?php echo $prodtype; ?>" readonly></td>
            </tr>	

	    <tr>			
                <td><div class="alignlabel"><label for="prod_desc"><strong style="color: red;">*</strong>Product Name:</label></div></td>
		<td><input type="text" id="prod_desc" name="prod_desc" size="150" style="width:400px"value="<?php echo $proddesc; ?>"></td>
            </tr>	

	    <tr>			
                <td><div class="alignlabel"><label for="prod_catg"><strong style="color: red;">*</strong>Category:</label></div></td>
		<td><input type="text" id="prod_catg" name="prod_catg" size="150" style="width:400px"value="<?php echo $prodcatg; ?>" readonly></td>
            </tr>
	
	    <tr>			
                <td><div class="alignlabel"><label for="short_flag"><strong style="color: red;">*</strong>Shortage Flag:</label></div></td>
		<td><select name="short_flag" id="short_flag" style="width:400px">
                          	<option value="Y" <?php echo $prodsflg == "Y"?'selected':'';?> >Yes</option>
                          	<option value="N"  <?php echo $prodsflg == "N"?'selected':'';?> >No</option>
                     </select>
                 </td>
            </tr>

	    <tr>			
                <td><div class="alignlabel"><label for="short_factor"><strong style="color: red;">*</strong>Shortage Factor:</label></div></td>
		<td><input type="text"id="short_factor"name="short_factor" size="150" style="width:400px"value="<?php echo $prodsftr;?>"></td>
            </tr>		
  
            <tr>
                <td><input type="submit" name="submit" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>


