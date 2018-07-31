<?php
        ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

        $prodtypeErr= "";

        if($_SESSION['ins_flag']==true){
                echo "<script>alert('Shortage Parameters Successfully Added')</script>";
                $_SESSION['ins_flag']=false;
        }
 
	if($_SESSION['prod_edit'] == true){
		echo"<script>alert('Product Successfully Updated')</script>";
		$_SESSION['prod_edit']=false;
	}			
	
	$rtv="select effective_dt,prod_desc,prod_type,prod_catg,short_flag,short_factor from m_shortage";
	$result=mysqli_query($db_connect,$rtv);	

?>
<html>

    <head>

        <title>Synergic Inventory Management System-View Shortage Parameters</title>

    <head>


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
                         List of Sortage Parameter
                        </span>

                    <table class="table table-bordered table-hover" style="width: 100%">

                        <thead style="background-color: #212529; color: #fff;">
                            <tr>
                                <th>Effective Date</th>
                                <th>Product Description</th>
                                <th>Product Category</th>
                                <th>Shortage Factor</th>
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
                                        $shtftr=$rtv_data['short_factor'];

                            ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $eftdt; ?></td>
                                            <td style="text-align: center;"><?php echo $proddesc; ?></td>
                                            <td style="text-align: center;"><?php echo $prodcatg; ?></td>
                                            <td style="text-align: center;"><?php echo $shtftr; ?></td>
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

