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

	$sql="Select trans_dt,trans_cd,do_no,allot_no,prod_desc,prod_catg,trans_type,
	      qty_bag,qty_qnt,qty_kg,qty_gm,created_by,created_dt from td_stock_trans_pds
	      where approval_status='U' order by trans_cd";

        $result=mysqli_query($db_connect,$sql);
?>




<html>

	<head>

		<title>Synergic Inventory Management System-Approve PDS Stock Transactions</title>

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

                    <div class="contact1-form">

                        <span class="contact1-form-title">

                           Approve Stock Transactions

                        </span>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-8 col-md-6">

                <div class="container-contact2" style="margin-top: 20px; margin-left: 0;">

                    <table class="table table-bordered table-hover">

                        <thead style="background-color: #212529; color: #fff;">

                            <tr>
                                <th>Trans Date</th>
                                <th>DO No.</th>
                                <th>Allot No.</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Transaction<br>Type</th>
                                <th>Bag/Tin</th>
                                <th>Quintal</th>
                                <th>Kg</th>
                                <th>Gm</th>
                                <th>Created By</th>
                                <th>Created Date</th>
                                <th>Options</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php
                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                while($row=mysqli_fetch_assoc($result)){
                                    $transdt	=	$row['trans_dt'];
                                    $transcd	=	$row['trans_cd'];
                                    $dono	    =	$row['do_no'];
                                    $allotno	=	$row['allot_no'];
                                    $prodesc	=	$row['prod_desc'];
                                    $prodcatg	=	$row['prod_catg'];
                                    $trtype   	=	$row['trans_type'];
                                    $bag	=	$row['qty_bag'];
                                    $qnt	=	$row['qty_qnt'];
                                    $kg		=	$row['qty_kg'];
                                    $gm		=	$row['qty_gm'];
                                    $createdby	=	$row['created_by'];
                                    $createddt	=	$row['created_dt'];

                                    if($trtype=='I'){
                                        $transtype='In';
                                    }else{
                                        $transtype='Out';
                                    }

                                    ?>
                                    <tr>
                                        <td><?php echo date('d/m/Y',strtotime($transdt)); ?></td>
                                        <td><?php echo $dono; ?></td>
                                        <td><?php echo $allotno; ?></td>
                                        <td><?php echo $prodesc; ?></td>
                                        <td><?php echo $prodcatg; ?></td>
                                        <td><?php echo $transtype; ?></td>
                                        <td><?php echo $bag; ?></td>
                                        <td><?php echo $qnt; ?></td>
                                        <td><?php echo $kg; ?></td>
                                        <td><?php echo $gm; ?></td>
                                        <td><?php echo $createdby; ?></td>
                                        <td><?php echo date('d/m/Y h:m:i',strtotime($createddt)); ?></td>
                                        <td><a href="../edit/edit_pds_stock_in.php?trans_dt=<?php echo $transdt;?>&trans_cd=<?php echo $transcd; ?>"
                                                style="color: black;"
                                            >
                                                <i class="fa fa-edit fa-2x" style="color: #006eff"></i> Edit</a>

                                            <a href="../approve/aprv_pds_stock_in.php?trans_dt=<?php echo $transdt; ?>&trans_cd=<?php echo $transcd; ?>"
                                               style="color: black; margin-left: 15px;"
                                            >
                                                <i class="fa fa-thumbs-up fa-2x" style="color: #006eff"></i> Approve</a></td>
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
