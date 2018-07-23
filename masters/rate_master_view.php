<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");

	$prodtypeErr= "";

	if($_SESSION['ins_flag']==true){
		echo "<script>alert('Rate Successfully Added')</script>";
		$_SESSION['ins_flag']=false;
	}

	if($_SESSION['rate_edit'] == true){
		echo"<script>alert('Rate Successfully Updated')</script>";
		$_SESSION['rate_edit']=false;
	}

	$rtv="Select effective_dt,prod_desc,prod_catg,prod_rate from m_rate_master order by effective_dt";
	$rtv_rate=mysqli_query($db_connect,$rtv);
?>
<html>
	<head>
		<title>Synergic Inventory Management System-View Product Rate</title>
        </head>

  <body>
	<table border="1">
	 <tr>
	     <th>Effective Date</th>
	     <th>Product</th>
             <th>Category</th>
	     <th>Rate</th>
	     <th>options</th>				
	 </tr>

	<?php
	      if($rtv_rate){
	        if(mysqli_num_rows($rtv_rate)>0){
		  while($row=mysqli_fetch_assoc($rtv_rate)){
			  $eftdt=$row['effective_dt'];
			  $prdesc=$row['prod_desc'];
			  $prcatg=$row['prod_catg'];
			  $prdrate=$row['prod_rate'];
	  ?>
		<tr>
		     <td><?php echo date('d/m/Y',strtotime($eftdt)); ?></td>
		     <td><?php echo $prdesc; ?></td>
		     <td><?php echo $prcatg; ?></td>
		     <td><?php echo $prdrate; ?></td>
<td><a href="../edit/rate_edit.php?effective_dt=<?php echo $eftdt;?>&prod_desc=<?php echo $prdesc ?>&prod_catg=<?php echo $prcatg ?> ">Edit</td>

		</tr>
	<?php			  
		  }
		}
	      } 	
	?>	
	  		    
    	</table>
  </body>
</html>
