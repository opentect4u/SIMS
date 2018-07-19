<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");
//	require("nav.php");
//	echo"<br><br>";
//	echo "<h1 class='elegantshadow'>Laxmi Narayan Stores</h1>";
//      echo "<hr class='hr'>";

//	require("menu.php");

    	$prodtypeErr = "";

	if($_SESSION['ins_flag'] == true){
		echo"<script>alert('Product Type Successfully Added')</script>";
		$_SESSION['ins_flag']=false;
	}

	if($_SESSION['prod_type_edit'] == true){
		echo"<script>alert('Product Type Successfully Updated')</script>";
		$_SESSION['prod_type_edit']=false;
	}		

	$rtv="select sl_no,prod_type from m_prod_type";
	$result=mysqli_query($db_connect,$rtv);
?>	
	
<html>
<head>
	<title>Synergic Inventory Management System-View Product Type</title>
<head>
<body>
	
	<table border="1">
		<tr>
                	<th>Sl.No.</th>
                        <th>Product Type</th>       
                        <th>Options</th>    
                </tr>

		<?php
			if($result){
                		if(mysqli_num_rows($result) > 0){
                        		while($rtv_data=mysqli_fetch_assoc($result)){
                                		$slno=$rtv_data['sl_no'];
						$prodtype=$rtv_data['prod_type'];
						
		?>
						<tr>
						    <td><?php echo $slno; ?></td>
						    <td><?php echo $prodtype; ?></td>
						    <td><a href="../edit/prod_type_edit.php?sl_no=<?php echo $slno; ?>" >Edit</td>
						</tr>
		<?php
                                		}
                			}
        		}
		?>

        </table>
   
</body>
</html>

