<?php
	ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

        $prodtypeErr= "";

        if($_SESSION['ins_flag']==true){
                echo "<script>alert('Save Successful')</script>";
                $_SESSION['ins_flag']=false;
        }

        if($_SESSION['edit_in'] == true){
                echo"<script>alert('Update Successful')</script>";
                $_SESSION['edit_in']=false;
	}

	if($_SESSION['approve'] == true){
		echo "<script>alert('Approve Successful')</script>";
		$_SESSION['approve']=false;
	}

	$sql="Select trans_dt,trans_cd,do_no,prod_desc,prod_catg,trans_type,
	      qty_bag,qty_qnt,qty_kg,qty_gm,created_by,created_dt from td_stock_trans_pds
	      where approval_status='U' order by trans_cd";

        $result=mysqli_query($db_connect,$sql);
?>




<html>
	<head>
		<title>Synergic Inventory Management System-Approve PDS Stock Transactions</title>
        </head>

  <body>
	<table border="1">
	 <tr>
	     <th>Trans Date</th>
	     <th>DO No.</th>
             <th>Product</th>
	     <th>Category</th>
	     <th>Transaction Type</th>	
	     <th>Bag/Tin</th>	
	     <th>Quintal</th>
	     <th>Kg</th>
	     <th>Gm</th>		
	     <th>Created By</th>
	     <th>Created Date</th>
	     <th>Options</th>						
	 </tr>
	<?php
		if($result){
		   if(mysqli_num_rows($result) > 0){
		     while($row=mysqli_fetch_assoc($result)){
		      $transdt	=	$row['trans_dt'];
  		      $transcd	=	$row['trans_cd'];	
		      $dono	=	$row['do_no'];
		      $prodesc	=	$row['prod_desc'];
		      $prodcatg	=	$row['prod_catg'];
		      $trtype   =	$row['trans_type'];
		      $bag	=	$row['qty_bag'];
		      $qnt	=	$row['qty_qnt'];
		      $kg	=	$row['qty_kg'];
		      $gm	=	$row['qty_gm'];
		      $createdby=	$row['created_by'];
		      $createddt=	$row['created_dt'];

		      if($trtype=='I'){
		        $transtype='In';
		      }else{
		        $transtype='Out';
		      }

	?>
		<tr>	
		    <td><?php echo date('d/m/Y',strtotime($transdt)); ?></td>
		    <td><?php echo $dono; ?></td>
		    <td><?php echo $prodesc; ?></td>	
		    <td><?php echo $prodcatg; ?></td>	
		    <td><?php echo $transtype; ?></td>	
		    <td><?php echo $bag; ?></td>
		    <td><?php echo $qnt; ?></td>
		    <td><?php echo $kg; ?></td>
		    <td><?php echo $gm; ?></td>
		    <td><?php echo $createdby; ?></td>
		    <td><?php echo date('d/m/Y h:m:i',strtotime($createddt)); ?></td>	
		    <td><a href="../edit/edit_pds_stock_in.php?trans_dt=<?php echo $transdt;?>&trans_cd=<?php echo $transcd; ?>">Edit</td>
		    <td><a href="../approve/aprv_pds_stock_in.php?trans_dt=<?php echo $transdt; ?>&trans_cd=<?php echo $transcd; ?>">Approve</td>
		</tr>

	<?php

		     }
		   }	
		}	
	?>
	  		    
    	</table>
  </body>
</html>
