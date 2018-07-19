<?php
        ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

        $prodtypeErr= "";

        if($_SESSION['ins_flag']==true){
                echo "<script>alert('Product Unit Successfully Added')</script>";
                $_SESSION['ins_flag']=false;
        }

	if($_SESSION['prod_qty_edit'] == true){
		echo"<script>alert('Product unit Successfully Updated')</script>";
		$_SESSION['prod_qty_edit']=false;
	}			
	
	$rtv="select sl_no,prod_qty from m_prod_qty";
	$result=mysqli_query($db_connect,$rtv);	

?>
<html>
<head>
	<title>Synergic Inventory Management System-View Product Unit</title>
<head>
<body>
	
	<table border="1">
		<tr>
                	<th>Sl.No.</th>
			<th>Unit Type</th>   
                        <th>Options</th>    
                </tr>

		<?php
			if($result){
                		if(mysqli_num_rows($result) > 0){
                        		while($rtv_data=mysqli_fetch_assoc($result)){
                                		$slno=$rtv_data['sl_no'];
						$prodqty=$rtv_data['prod_qty'];
						
		?>
						<tr>
						    <td><?php echo $slno; ?></td>
						    <td><?php echo $prodqty; ?></td>
						    <td><a href="../edit/prod_qty_edit.php?sl_no=<?php echo $slno; ?>" >Edit</td>
						</tr>
		<?php
                                		}
                			}
        		}
		?>

        </table>
   
</body>
</html>

