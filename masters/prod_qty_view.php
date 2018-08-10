<?php
        ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");

        $prodtypeErr= "";

        if($_SESSION['ins_flag']==true){
                echo "<script>alert('Product Scale Successfully Added')</script>";
                $_SESSION['ins_flag']=false;
        }

	if($_SESSION['prod_qty_edit'] == true){
		echo"<script>alert('Product Scale Successfully Updated')</script>";
		$_SESSION['prod_qty_edit']=false;
	}			
	
	$rtv="select sl_no,prod_qty from m_prod_qty";
	$result=mysqli_query($db_connect,$rtv);	

?>

<html>

    <head>

        <title>Synergic Inventory Management System-View Product Unit</title>

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
                         List of Product Scale
                        </span>

                        <table class="table table-bordered table-hover">

                            <thead style="background-color: #212529; color: #fff;">

                                <tr>
                                    <th>Sl.No.</th>
                                    <th>Scale Type</th>
                                    <th>Options</th>
                                </tr>

                            </thead>

                            <tbody>
                                <?php
                                    if($result){
                                        if(mysqli_num_rows($result) > 0){
                                            while($rtv_data=mysqli_fetch_assoc($result)){
                                                $slno=$rtv_data['sl_no'];
                                                $prodqty=$rtv_data['prod_qty'];

                                                ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $slno; ?></td>
                                                    <td style="text-align: center;"><?php echo $prodqty; ?></td>
                        </td>
                        </td>
                                                    <td style="text-align: center;"><a href="../edit/prod_qty_edit.php?sl_no=<?php echo $slno; ?>"
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

