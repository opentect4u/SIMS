<?php
        ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

        $prodtypeErr= "";

        if($_SESSION['ins_flag']==true){
                echo "<script>alert('New Dealer Successfully Added')</script>";
                $_SESSION['ins_flag']=false;
        }

	if($_SESSION['dealer_master'] == true){
		echo"<script>alert('Dealer Details Successfully Updated')</script>";
		$_SESSION['dealer_master']=false;
	}			
	
	$rtv="select sl_no,del_cd,del_name,del_adr,del_reg,del_dist from m_dealers";
	$result=mysqli_query($db_connect,$rtv);	

?>
<html>
<head>
	<title>Synergic Inventory Management System-View Dealers</title>
<head>
<body>
	
	<table border="1">
		<tr>
                	<th>Sl.No.</th>
			<th>Dealer Code</th>
			<th>Dealer Name</th>
                        <th>Options</th>    
                </tr>

		<?php
			if($result){
                		if(mysqli_num_rows($result) > 0){
                        		while($rtv_data=mysqli_fetch_assoc($result)){
                                		$slno=$rtv_data['sl_no'];
						$delcd=$rtv_data['del_cd'];
					        $delname=$rtv_data['del_name'];
						
						
		?>
						<tr>
						    <td><?php echo $slno; ?></td>
						    <td><?php echo $delcd; ?></td>
						    <td><?php echo $delname; ?></td>	
						    <td><a href="../edit/dealer_edit.php?sl_no=<?php echo $slno; ?>" >Edit</td>
						</tr>
		<?php
                                		}
                			}
        		}
		?>

        </table>
   
</body>
</html>


