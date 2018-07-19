<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$slno=$_GET['sl_no'];
		$rtv="select sl_no,prod_catg,per_unit from m_prod_catg where sl_no=".$slno;
		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$slno=$rtv_data['sl_no'];
				$prodcatg=$rtv_data['prod_catg'];
				$produnit=$rtv_data['per_unit'];
			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $prodcatg = null;
	  $produnit = null;	
	
	  if (empty($_POST["prod_catg"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $prodcatg = test_input($_POST["prod_catg"]);
		   $slno=test_input($_POST["sl_no"]);
		   $produnit=test_input($_POST['per_unit']);	
	     	  } 
	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

	 	
		
 	     if(!is_null($prodcatg) && isset($user_id)) {

		$sql="update m_prod_catg set prod_catg="."'".$prodcatg."'".
					   ",per_unit="."'".$produnit."'".	
				           ",modified_by="."'".$user_id."'".
					   ",modified_dt="."'".$time."'".	
		     "where sl_no = ".$slno;


		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION['prod_catg_edit'] = true;
		Header("Location:../masters/prod_catg_view.php");
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
		<td><div class="alignlabel"><label for="sl_no">Sl.No.:</label></div></td>
		<td><input type="text" name="sl_no" size="150" style="width:400px" value="<?php echo $slno; ?>" readonly></td>
	    </tr>

	    <tr>			
                <td><div class="alignlabel"><label for="prod_catg"><strong style="color: red;">*</strong>Category:</label></div></td>
		<td><input type="text" id="prod_catg" name="prod_catg" size="150" style="width:400px"value="<?php echo $prodcatg; ?>" ></td>
            </tr>
		
	    <tr>
                <td><div class="alignlabel"><label for="per_unit"><strong style="color: red;">*</strong>Unit:</label></div></td>
                <td><select name="per_unit" id="per_unit" style="width:400px">
                          	<option value="0">Select</option>
                          	<option value="Family" <?php echo $produnit == "Family"?'selected':'';?> >Family</option>
                          	<option value="Head" <?php echo $produnit == "Head"?'selected':'';?> >Head</option>
                     </select>
                 </td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>


