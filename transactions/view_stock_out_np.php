<?php
    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require("../db/db_connect.php");
    require("../session.php");
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

    <?php
        $sql="Select trans_dt,trans_cd,allot_no,prod_desc,trans_type,
        qty_bags_tin,qty_cs,qty_kg,qty_pieces,created_by,created_dt from td_stock_trans_np
	      where approval_status='U' AND trans_type= 'O' order by trans_cd";

        //echo $sql; die();
        $result=mysqli_query($db_connect,$sql);

    ?>

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

                            Approve NON PDS Stock Out Transactions

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
                                    <th>Allot No</th>
                                    <th>Product</th>
                                    <th>Transaction<br>Type</th>
                                    <th>Bag/Tin</th>
                                    <th>CS</th>
                                    <th>Kg</th>
                                    <th>Pieces</th>
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
                                                $trans_dt	=	$row['trans_dt'];
                                                $trans_cd	=	$row['trans_cd'];
                                                $allot_no	=	$row['allot_no'];
                                                //$allot_no	=	$row['allot_no'];
                                                $prod_desc	=	$row['prod_desc'];
                                                
                                                $trans_type  =	$row['trans_type'];
                                                $qty_bags_tin	=	$row['qty_bags_tin'];
                                                $qty_cs	        =	$row['qty_cs'];
                                                $qty_kg		    =	$row['qty_kg'];
                                                $qty_pieces		=	$row['qty_pieces'];
                                                $created_by	=	$row['created_by'];
                                                $created_dt	=	$row['created_dt'];

                                                if($trans_type=='I'){
                                                    $trans_type='In';
                                                }else{
                                                    $trans_type='Out';
                                                }
                            
                                ?>
                                    <tr>
                                        <td><?php echo date('d/m/Y',strtotime($trans_dt)); ?></td>
                                        <td><?php echo $allot_no; ?></td>
                                        <td><?php echo $prod_desc; ?></td>
                                        <td><?php echo $trans_type; ?></td>
                                        <td><?php echo $qty_bags_tin; ?></td>
                                        <td><?php echo $qty_cs; ?></td>
                                        <td><?php echo $qty_kg; ?></td>
                                        <td><?php echo $qty_pieces; ?></td>
                                        <td><?php echo $created_by; ?></td>
                                        <td><?php echo date('d/m/Y h:m:i',strtotime($created_dt)); ?></td>
                                        <td><a href="../edit/edit_np_stock_out.php?trans_dt=<?php echo $trans_dt;?>&trans_cd=<?php echo $trans_cd; ?>"
                                            style="color: black;">
                                                <i class="fa fa-edit fa-2x" style="color: #006eff"></i> Edit</a>

                                            <a href="../approve/aprv_np_stock_out.php?trans_dt=<?php echo $trans_dt;?>&trans_cd=<?php echo $trans_cd; ?>"
                                            style="color: black; margin-left: 15px;">
                                            <i class="fa fa-thumbs-up fa-2x" style="color: #006eff"></i> Approve</a>


                                        </td>
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
