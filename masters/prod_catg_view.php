<?php
        ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

        $prodtypeErr= "";

        if($_SESSION['ins_flag']==true){
                echo "<script>alert('Category Successfully Added')</script>";
                $_SESSION['ins_flag']=false;
        }

	if($_SESSION['prod_catg_edit'] == true){
		echo"<script>alert('Product Category Successfully Updated')</script>";
		$_SESSION['prod_catg_edit']=false;
	}			
	
	$rtv="select sl_no,prod_catg,per_unit from m_prod_catg";
	$result=mysqli_query($db_connect,$rtv);	
?>

<html>
<head>
	<title>Synergic Inventory Management System-View Product Category</title>
<head>
<body>
	
	<table border="1">
		<tr>
                	<th>Sl.No.</th>
                        <th>Category</th>    
			<th>Unit</th>   
                        <th>Options</th>    
                </tr>

		<?php
			if($result){
                		if(mysqli_num_rows($result) > 0){
                        		while($rtv_data=mysqli_fetch_assoc($result)){
                                		$slno=$rtv_data['sl_no'];
						$prodcatg=$rtv_data['prod_catg'];
						$produnit=$rtv_data['per_unit'];
						
		?>
						<tr>
						    <td><?php echo $slno; ?></td>
						    <td><?php echo $prodcatg; ?></td>
						    <td><?php echo $produnit; ?></td>
						    <td><a href="../edit/prod_catg_edit.php?sl_no=<?php echo $slno; ?>" >Edit</td>
						</tr>
		<?php
                                		}
                			}
        		}
		?>

        </table>
   
</body>
</html>
	

