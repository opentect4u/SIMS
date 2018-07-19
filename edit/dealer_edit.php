<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

	$prodtypeErr = "";

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$slno=$_GET['sl_no'];
		$rtv="select sl_no,del_cd,del_name,del_adr,del_reg,del_dist from m_dealers where sl_no=".$slno;
		$result=mysqli_query($db_connect,$rtv);
		if($result){
			if(mysqli_num_rows($result) > 0){
				$rtv_data=mysqli_fetch_assoc($result);
				$slno=$rtv_data['sl_no'];
				$delcd=$rtv_data['del_cd'];
				$delname=$rtv_data['del_name'];
				$deladr=$rtv_data['del_adr'];
				$delreg=$rtv_data['del_reg'];
				$deldist=$rtv_data['del_dist'];
			}
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
	  $delname = null;
	  $deladr  = null;	
	  $delreg  = null; 
	  $deldist = null;  	
	
	  if (empty($_POST["del_name"])) {
	     $prodtypeErr = "Invalid Input";
	     }else{
		   $delname = test_input($_POST["del_name"]);
		   $slno=test_input($_POST["sl_no"]);
		   $deladr=test_input($_POST['del_adr']);
		   $delreg=test_input($_POST['del_reg']);
	     	  } 
	     $user_id=$_SESSION["user_id"];
	     $time=date("Y-m-d h:i:s");

		
 	     if(!is_null($delname) && isset($user_id)) {

		$sql="update m_dealers set del_name="."'".$delname."'".
					   ",del_adr="."'".$deladr."'".
					   ",del_reg="."'".$delreg."'".
				           ",modified_by="."'".$user_id."'".
					   ",modified_dt="."'".$time."'".	
		     "where sl_no = ".$slno;


		$update=mysqli_query($db_connect,$sql); 
	     }
	     
	     if($update){
		$_SESSION['dealer_master'] = true;
		Header("Location:../masters/dealer_master_view.php");
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
		<td><div class="alignlabel"><label for="del_cd">Dealer Code:</label></div></td>
		<td><input type="text" name="del_cd" size="150" style="width:400px" value="<?php echo $delcd; ?>" readonly></td>
	    </tr>	

	    <tr>			
                <td><div class="alignlabel"><label for="del_name"><strong style="color: red;">*</strong>Name:</label></div></td>
		<td><input type="text" id="del_name" name="del_name" size="150" style="width:400px"value="<?php echo $delname; ?>" ></td>
            </tr>

	     <tr>	
                <td><div class="alignlabel"><label for="del_adr"><strong style="color: red;">*</strong>Address:</label></div></td>
		<td><textarea rows ="5" cols="50" id="del_adr" name="del_adr" size="150" style="width:400px">
		     <?php echo $deladr; ?>
		    </textarea></td>
            </tr>

	    <tr>			
                <td><div class="alignlabel"><label for="del_reg"><strong style="color: red;">*</strong>Region:</label></div></td>
		<td><input type="text" id="del_reg" name="del_reg" size="150" style="width:400px"value="<?php echo $delreg; ?>" ></td>
            </tr>		

	    <tr>			
                <td><div class="alignlabel"><label for="del_dist"><strong style="color: red;">*</strong>District:</label></div></td>
		<td><input type="text" id="del_dist" name="del_dist" size="150" style="width:400px"value="<?php echo $deldist; ?>" readonly ></td>
            </tr>		
		
            <tr>
                <td><input type="submit" name="submit" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>


