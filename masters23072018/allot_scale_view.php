<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");

	$prodtypeErr= "";

	if($_SESSION['ins_flag']==true){
		echo "<script>alert('Scale Successfully Added')</script>";
		$_SESSION['ins_flag']=false;
	}

	if($_SESSION['allot_scale'] == true){
		echo"<script>alert('Allotment Scale Successfully Updated')</script>";
		$_SESSION['allot_scale']=false;
	}			
	
	$rtv="select effective_dt,prod_desc,prod_catg,per_unit,unit_val from m_allot_scale order by prod_catg";
	$result=mysqli_query($db_connect,$rtv);	

?>
<html>
<head>
	<title>Synergic Inventory Management System-View Dealers</title>
<head>
<body>
	
	<table border="1">
		<tr>
                	<th>Effective Date</th>
			<th>Product</th>
			<th>Category</th>
                        <th>Options</th>    
                </tr>

		<?php
			if($result){
                		if(mysqli_num_rows($result) > 0){
                        		while($rtv_data=mysqli_fetch_assoc($result)){
                                		$eftdt=$rtv_data['effective_dt'];
						$proddesc=$rtv_data['prod_desc'];
					        $prodcatg=$rtv_data['prod_catg'];					
		?>
						<tr>
						    <td><?php echo $eftdt; ?></td>
						    <td><?php echo $proddesc; ?></td>
						    <td><?php echo $prodcatg; ?></td>	
						    <td>
							<a href="../edit/allot_edit.php?prod_desc=<?php echo $proddesc; ?>&effective_dt=<?php 
													echo $eftdt; ?>  " >Edit</td>
						</tr>
		<?php
                                		}
                			}
        		}
		?>

        </table>
   
</body>
</html>

