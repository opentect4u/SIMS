<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
			$effectdt	=	$_POST["effective_dt"];
			$proddesc	=	$_POST["prod_desc"];
			$prodcatg	=	$_POST['prod_catg'];
			$perunit	=	$_POST['unit_type'];	
			$unitval	=	$_POST['unit_val'];
			
                        $user_id=$_SESSION["user_id"];
			$time=date("Y-m-d h:i:s");

			if(!is_null($effectdt)) {

				$sql="insert into m_allot_scale(effective_dt,
								     prod_desc,
								     prod_catg,
								     per_unit,
								     unit_val,
								     created_by,
								     created_dt)
							      values('$effectdt',
								     '$proddesc',
								     '$prodcatg',
								     '$perunit',
								     '$unitval',
								     '$user_id',
								     '$time'
							     	      )";

                          $result=mysqli_query($db_connect,$sql);
                        }

	}
	$select_catg="Select prod_catg from m_prod_catg";
	$prdcatg=mysqli_query($db_connect,$select_catg);

	$select_prd="Select prod_desc from m_products";
	$prddesc=mysqli_query($db_connect,$select_prd);


?>
<html>
	<head>
		<title>Synergic Inventory Management System-Add Stock</title>
		<link rel="stylesheet" href="../css/master.css">
	</head>
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

		<table>

			<tr>
				<td><div class="alignlabel"><label for="effective_dt">Effective Date:</label></div></td>	
				<td><input type="date"name="effective_dt" size="50" style="width:150px"</td>
			</tr>

			<tr>    
                                <td><div class="alignlabel"><label for="prod_desc">Product:</label></div></td>
                                	<td><select name="prod_desc" id="prod_desc" style="width:400px">
                                                <option value="0">Select</option>
                                                <?php
                                                        while($row=mysqli_fetch_assoc($prddesc)){
                                                        echo ("<option value='".$row["prod_desc"]."'>".$row["prod_desc"]."</option>") ;
                                                        }
                                                ?>
                                            </select></td>
        
			</tr>

			<tr>    
                                <td><div class="alignlabel"><label for="prod_catg">Category:</label></div></td>
                                	<td><select name="prod_catg" id="prod_catg" style="width:400px">
                    				<option value="0">Select</option>
                    				<?php
                            				while($row=mysqli_fetch_assoc($prdcatg)){
                            				echo ("<option value='".$row["prod_catg"]."'>".$row["prod_catg"]."</option>") ;
                            				}
                    				?>
            				    </select></td>        
			</tr>

			<tr>    
                                <td><div class="alignlabel"><label for="per_unit">Unit Type:</label></div></td>
                                <td><input type="text" name="unit_type" size="150" style="width:400px"></td>        
			</tr>

			<tr>    
                                <td><div class="alignlabel"><label for="unit_val">Value(Kg):</label></div></td>
                                <td><input type="text" name="unit_val" size="150" style="width:400px"></td>        
			</tr>

			<tr>
				<td><input type="submit" name="submit" value="Save"></td>
			</tr>
		</table>
	</body>
</html>
