<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$slno=$_GET['sl_no'];
		$rtv="select sl_no,prod_type from m_prod_type where sl_no=".$slno;
		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$slno=$rtv_data['sl_no'];
				$prodtype=$rtv_data['prod_type'];
			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $prodtype = null;
	
	  if (empty($_POST["prod_type"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $prodtype = test_input($_POST["prod_type"]);
		   $slno=test_input($_POST["sl_no"]);
	     	  } 
	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

	 	
		
 	     if(!is_null($prodtype) && isset($user_id)) {

		$sql="update m_prod_type set prod_type="."'".$prodtype."'".",modified_by="."'".$user_id."'".",modified_dt="."'".$time."'".
		     "where sl_no = ".$slno;


		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION[prod_type_edit] = true;
		Header("Location:../masters/prod_type_view.php");
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
	<title>Synergic Inventory Management System-Edit Product Type</title>
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
		<td><input type="text" id="prod_type" name="prod_type" size="150" style="width:400px"value="<?php echo $prodtype; ?>" ></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>


