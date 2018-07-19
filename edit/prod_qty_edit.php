<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$slno=$_GET['sl_no'];
		$rtv="select sl_no,prod_qty from m_prod_qty where sl_no=".$slno;
		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$slno=$rtv_data['sl_no'];
				$prodqty=$rtv_data['prod_qty'];
			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $prodqty = null;
	
	  if (empty($_POST["prod_qty"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $prodqty = test_input($_POST["prod_qty"]);
		   $slno=test_input($_POST["sl_no"]);
	     	  } 
	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

		
 	     if(!is_null($prodqty) && isset($user_id)) {

		$sql="update m_prod_qty set prod_qty="."'".$prodqty."'".
				           ",modified_by="."'".$user_id."'".
					   ",modified_dt="."'".$time."'".	
		     "where sl_no = ".$slno;


		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION['prod_qty_edit'] = true;
		Header("Location:../masters/prod_qty_view.php");
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
                <td><div class="alignlabel"><label for="prod_qty"><strong style="color: red;">*</strong>Product Unit Type:</label></div></td>
		<td><input type="text" id="prod_qty" name="prod_qty" size="150" style="width:400px"value="<?php echo $prodqty; ?>" ></td>
            </tr>
		
            <tr>
                <td><input type="submit" name="submit" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>


