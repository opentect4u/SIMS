<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
			$transdt	=	$_POST["trans_dt"];
			$dono		=	$_POST["do_no"];
			$prodslno	=	$_POST["prod_sl_no"];
			$proddesc	=	$_POST["prod_desc"];
			$transtype	=	"I";
			$qtybag		=	$_POST['qty_bag'];
			$qtyqnt		=	$_POST['qty_qnt'];	
			$qtykg		=	$_POST['qty_kg'];
			$qtygm		=	$_POST['qty_gm'];	
			$shtkg		=	$_POST['sht_kg'];
			$shtgm		=	$_POST['sht_gm'];
			$remarks	=	$_POST['remarks'];
			$transcd	=	1;
                        $user_id=$_SESSION["user_id"];
			$time=date("Y-m-d h:i:s");

                        if(!is_null($dono)) {
				$sql="insert into td_stock_trans_pds(trans_dt,
								     trans_cd,
								     do_no,
								     prod_sl_no,
								     prod_desc,
								     trans_type,
								     qty_bag,
								     qty_qnt,
								     qty_kg,
								     qty_gm,
								     sht_kg,
								     sht_gm,
								     remarks,
								     approval_status,			
								     created_by,
								     created_dt)
							      values('$transdt',
								     '$transcd',
								     '$dono',
								     '$prodslno',
								     '$proddesc',
								     '$transtype',
							     	     '$qtybag',
								     '$qtyqnt',
								     '$qtykg',
								     '$qtygm',
								     '$shtkg',
								     '$shtgm',
								     '$remarks',
								     'U',									     
								     '$user_id',
								     '$time')";

                          $result=mysqli_query($db_connect,$sql);
                        }

        }
?>
<html>
	<head>
		<title>Synergic Inventory Management System</title>
		<link rel="stylesheet" href="../css/master.css">
	</head>
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

		<table>

			<tr>
				<td><div class="alignlabel"><label for="trans_dt">Date:</label></div></td>	
				<td><input type="date"name="trans_dt" readonly value="<?php echo date("Y-m-d") ?>" size="50" style="width:150px"</td>
			</tr>
			
			<tr>
			 
				<td><div class="alignlabel"><label for="do_no">Do No.:</label></div></td>
				<td><input type="text" name="do_no" size="50" style="width:150px"></td>	
			</tr>

			<tr>    
                                <td><div class="alignlabel"><label for="prod_sl_no">Product Code:</label></div></td>
                                <td><input type="text" name="prod_sl_no" size="150" style="width:400px"></td>        
			</tr>

			<tr>    
                                <td><div class="alignlabel"><label for="prod_desc">Description:</label></div></td>
                                <td><input type="text" name="prod_desc" size="150" style="width:400px"></td>        
			</tr>

			<tr>    
                                <td><div class="alignlabel"><label for="qty_bag">Bag/Tin:</label></div></td>
                                <td><input type="text" name="qty_bag" size="150" style="width:400px"></td>        
			</tr>

			<tr>    
                                <td><div class="alignlabel"><label for="qty_qnt">Quantity:</label></div></td>
                                <td><input type="text" name="qty_qnt" size="150" style="width:400px"></td>        
			</tr>

			<tr>    
                                <td><div class="alignlabel"><label for="qty_kg">Kg:</label></div></td>
                                <td><input type="text" name="qty_kg" size="150" style="width:400px"></td>        
			</tr>

			<tr>    
                                <td><div class="alignlabel"><label for="qty_gm">Gm:</label></div></td>
                                <td><input type="text" name="qty_gm" size="150" style="width:400px"></td>        
			</tr>

			<tr> 
                                <td><div class="alignlabel"><label for="sht_kg">Short Kg:</label></div></td>
                                <td><input type="text" name="sht_kg" size="150" style="width:400px"></td>
			</tr>

			<tr> 
				<td><div class="alignlabel"><label for="sht_gm">Short Gm:</label></div></td>
                                <td><input type="text" name="sht_gm" size="150" style="width:400px"></td>
                        </tr>


			<tr>    
                                <td><div class="alignlabel"><label for-"remarks">Remarks:</label></div></td>
                                <td><textarea rows="5" cols="50" name="remarks" size="150" style="width:400px">Enter Remarks If Any..</textarea></td>        
                        </tr>

			<tr>
				<td><input type="submit" name="submit" value="Save"></td>
			</tr>
		</table>
	</body>
</html>
