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

	$rtv="Select effective_dt,prod_desc,prod_catg,prod_rate from m_rate_master 
	      order by effective_dt,prod_desc,prod_catg";
	$rtv_rate=mysqli_query($db_connect,$rtv);
?>

<html>

	<head>

		<title>Synergic Inventory Management System-View Product Rate</title>

        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


        <link rel="stylesheet" type="text/css" href="../css/form_design.css">
        <link rel="stylesheet" type="text/css" href="../css/dashboard.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

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
                             List of Product Unit
                            </span>

                        <table class="table table-bordered table-hover">

                            <thead style="background-color: #212529; color: #fff;">
                                <tr>
                                    <th>Effective Date</th>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Rate</th>
                                    <th>options</th>
                                </tr>
                            </thead>

                            <tbody>

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
                                                <td><a href="../edit/rate_edit.php?effective_dt=<?php echo $eftdt;?>&prod_desc=<?php echo $prdesc ?>&prod_catg=<?php echo $prcatg ?> ">
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

</html>
