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

        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


        <link rel="stylesheet" type="text/css" href="../css/form_design.css">
        <link rel="stylesheet" type="text/css" href="../css/dashboard.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <head>

    <body class="body">

    <?php require '../post/nav.php'; ?>

    <h1 class='elegantshadow'>Laxmi Narayan Stores</h1>

    <hr class='hr'>

    <div class="container" style="margin-left: 10px">

        <div class="row">

            <div class="col-lg-4 col-md-6">

                <?php require("../post/menu.php"); ?>

            </div>


            <div class="col-lg-8 col-md-6">

                <div class="container-contact1">

                        <span class="contact1-form-title" style="text-align: center;">
                         List of Allotment Scales
                        </span>

                    <table class="table table-bordered table-hover">

                        <thead style="background-color: #212529; color: #fff;">

                            <tr>
                                <th>Effective Date</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Options</th>
                            </tr>

                        </thead>

                        <tbody>

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
                                            echo $eftdt; ?>  " >
                                                <i class="fa fa-edit fa-2x" style="color: #006eff"></i></a></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/collapsible.js"></script>

    </body>

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

