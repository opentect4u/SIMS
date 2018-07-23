<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
			$effectdt	=	$_POST["effective_dt"];
			$proddesc	=	$_POST["prod_desc"];
			$prodtype	=	$_POST["prod_type"];
			$prodcatg	=	$_POST['prod_catg'];
			$perunit	=	$_POST['per_unit'];	
			$prodrate	=	$_POST['prod_rate'];
			$user_id    	= 	$_SESSION["user_id"];

			$time = date("Y-m-d h:i:s");

			if(!is_null($effectdt)) {

				echo $prodtype;
				echo $perunit;

				$sql="insert into m_rate_master(effective_dt,
								     prod_desc,
								     prod_type,
								     prod_catg,
								     per_unit,
								     prod_rate,
								     created_by,
								     created_dt)
							      values('$effectdt',
								     '$proddesc',
								     '$prodtype',
								     '$prodcatg',
								     '$perunit',
								     '$prodrate',
								     '$user_id',
								     '$time'
							     	      )";

                          $result=mysqli_query($db_connect,$sql);
			}

			if($result){
				$_SESSION['ins_flag']=true;
				Header("Location:rate_master_view.php");
			}

	}
	$select_catg="Select prod_catg from m_prod_catg ORDER BY prod_catg";
	$prdcatg=mysqli_query($db_connect,$select_catg);

	$select_prd="Select prod_desc,prod_type from m_products";
	$prdesc=mysqli_query($db_connect,$select_prd);


	$select_unit="Select sl_no,prod_qty from m_prod_qty";
	$produnit=mysqli_query($db_connect,$select_unit);


?>
<html>
	<head>
		<title>Synergic Inventory Management System-Add Product Rate</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/master.css">
    </head>

    <script>
        $(document).ready(function() {
                $('#prod_desc').change(function () {

                $('#prod_type').val($(this).find(':selected').attr('data-val'));

            });
        });

    </script>
    <body>
	<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

	<table>

	  <tr>
	      <td><div class="alignlabel"><label for="effective_dt"><strong style="color: red;">*</strong>Effective Date:</label></div></td>
	      <td><input type="date" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" size="50" style="width:150px"</td>
	  </tr>
	  <tr>    
              <td><div class="alignlabel"><label for="prod_desc"><strong style="color: red;">*</strong>Product:</label></div></td>
              <td><select name="prod_desc" id="prod_desc" style="width:400px">
                  <option value="0">Select</option>
			<?php
                             while($row=mysqli_fetch_assoc($prdesc)){
			       echo ("<option value=".$row['prod_desc']." data-val=".$row['prod_type'].">".$row['prod_desc']."</option>");
			     }
                         ?>
                    </select>
                </td>
	   </tr>

	   <tr>
                <td><div class="aligntable"><label for="prod_type">Product Type:</label></div></td>
                <td><input type="text" name="prod_type" id="prod_type" style="width:400px" size="150" readonly></td>
           </tr>
	

	   <tr>    
              <td><div class="alignlabel"><label for="prod_catg"><strong style="color: red;">*</strong>Category:</label></div></td>
                <td><select name="prod_catg" id="prod_catg" style="width:400px">
		<option value="0">Select</option>
		<?php
		      while($row=mysqli_fetch_assoc($prdcatg)){
		       echo("<option value=".$row['prod_catg'].">".$row['prod_catg']."</option>");
		      }		
		?>

	    <tr>    
                <td><div class="alignlabel"><label for="per_unit"><strong style="color: red;">*</strong>Unit Type:</label></div></td>
		<td><select name="per_unit" id="per_unit" style="width:400px">
		    <option value="0">Select</option>
		    <?php
			while($row=mysqli_fetch_assoc($produnit)){
			  echo ("<option value=".$row['prod_qty'].">".$row['prod_qty']."</option>");
			}	
		    ?>
	          </select>
		</td>
	   </tr>

	   <tr>    
                <td><div class="alignlabel"><label for="prod_rate"><strong style="color: red;">*</strong>Rate:</label></div></td>
                <td><input type="text" name="prod_rate" id="prod_rate" value="0.00" size="150" style="width:400px"></td>
	   </tr>

	   <tr>
		<td><input type="submit" name="submit" value="Save"></td>
	   </tr>
    </table>
</body>
</html>
