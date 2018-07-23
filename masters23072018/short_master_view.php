<?php
        ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

        $prodtypeErr= "";

        if($_SESSION['ins_flag']==true){
                echo "<script>alert('Shortage Parameters Successfully Added')</script>";
                $_SESSION['ins_flag']=false;
        }
 
	if($_SESSION['prod_edit'] == true){
		echo"<script>alert('Product Successfully Updated')</script>";
		$_SESSION['prod_edit']=false;
	}			
	
	$rtv="select effective_dt,prod_desc,prod_type,prod_catg,short_flag,short_factor from m_shortage";
	$result=mysqli_query($db_connect,$rtv);	

?>
<html>
<head>
	<title>Synergic Inventory Management System-View Shortage Parameters</title>
<head>
<body>
	
	<table border="1">
		<tr>
                	<th>Effective Date</th>
			<th>Product Description</th>
			<th>Product Category</th>
			<th>Shortage Factor</th>   
                        <th>Options</th>    
                </tr>

		<?php
			if($result){
                		if(mysqli_num_rows($result) > 0){
                        		while($rtv_data=mysqli_fetch_assoc($result)){
                                		$eftdt=$rtv_data['effective_dt'];
						$proddesc=$rtv_data['prod_desc'];
						$prodcatg=$rtv_data['prod_catg'];
						$shtftr=$rtv_data['short_factor'];
						
		?>
						<tr>
						    <td><?php echo $eftdt; ?></td>
						    <td><?php echo $proddesc; ?></td>
						    <td><?php echo $prodcatg; ?></td>
						    <td><?php echo $shtftr; ?></td>		
						    <td><a href="../edit/short_master_edit.php?sl_no=<?php echo $slno; ?>" >Edit</td>
						</tr>
		<?php
                                		}
                			}
        		}
		?>

        </table>
   
</body>
</html>

