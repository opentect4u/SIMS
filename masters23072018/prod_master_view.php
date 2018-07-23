<?php
        ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

        $prodtypeErr= "";

        if($_SESSION['ins_flag']==true){
                echo "<script>alert('New Product Successfully Added')</script>";
                $_SESSION['ins_flag']=false;
        }
 
	if($_SESSION['prod_edit'] == true){
		echo"<script>alert('Product Successfully Updated')</script>";
		$_SESSION['prod_edit']=false;
	}			
	
	$rtv="select sl_no,prod_type,prod_desc from m_products";
	$result=mysqli_query($db_connect,$rtv);	

?>
<html>
<head>
	<title>Synergic Inventory Management System-View Products</title>
<head>
<body>
	
	<table border="1">
		<tr>
                	<th>Sl.No.</th>
			<th>Product Type</th>
			<th>Product Description</th>   
                        <th>Options</th>    
                </tr>

		<?php
			if($result){
                		if(mysqli_num_rows($result) > 0){
                        		while($rtv_data=mysqli_fetch_assoc($result)){
                                		$slno=$rtv_data['sl_no'];
						$prodtype=$rtv_data['prod_type'];
						$proddesc=$rtv_data['prod_desc'];
						
						
		?>
						<tr>
						    <td><?php echo $slno; ?></td>
						    <td><?php echo $prodtype; ?></td>
						    <td><?php echo $proddesc; ?></td>	
						    <td><a href="../edit/prod_edit.php?sl_no=<?php echo $slno; ?>" >Edit</td>
						</tr>
		<?php
                                		}
                			}
        		}
		?>

        </table>
   
</body>
</html>

