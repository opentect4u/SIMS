<?php
	ini_set("display_errors","1");
	error_reporting("E_ALL");

	require("../db/db_connect.php");
	require("../session.php");

	if($_SESSION['approve'] == true){
		echo "<script>alert('Approve Successful')</script>";
		$_SESSION['approve']=false;
	}

	if($_SERVER['REQUEST_METHOD']=="GET"){
		$sql = "select memo_no,
			       gen_date,
			       alt_year,
			       alt_month,
			       created_by,
			       created_dt,
			       modified_by,
			       modified_dt	
			  from td_allotment_sheet
			  where  approval_status = 'U'";
			
		$result = mysqli_query($db_connect,$sql);

		if($result){
			if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				$memo_no	= $row['memo_no'];
				$gen_date	= $row['gen_date'];
				$alt_year	= $row['alt_year'];
				$alt_month      = $row['alt_month'];
				$created_by     = $row['created_by'];
				$created_dt     = $row['created_dt'];
				$modified_by	= $row['modified_by'];
				$modified_dt    = $row['modified_dt'];

				switch($alt_month){
					case 1:
						$mth = "JAN";
						break;
					case 2:
						$mth = "FEB";
						break;
					case 3:
						$mth = "MAR";
						break;
					case 4:
						$mth = "APR";
						break;
					case 5:	
						$mth = "MAY";
						break;
					case 6:
						$mth = "JUN";
						break;
					case 7:
						$mth = "JUL";
						break;
					case 8:
						$mth = "AUG";
						break;
					case 9:
						$mth = "SEP";
						break;
					case 10:
						$mth = "OCT";
						break;
					case 11:
						$mth = "NOV";
						break;
					case 12:
						$mth = "DEC";
						break;
					default:
						$mth = "NA";		
				}

			}
		}
	
	}	
?>

<html>

	<head>

		<title>Synergic Inventory Management System-Approve Allotment Sheet</title>

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

                        <div class="contact1-form validate-form" >

                            <span class="contact1-form-title">

                               Approve Allotment Sheet

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row" >

            <div class="col-lg-12 col-md-6">

                <div class="container-contact2" style="margin-left: 10px; width: 100%;">

                    <table id="intro" class="table table-bordered table-hover">

                        <thead style="background-color: #212529; color: #fff; text-align: right;">

                            <tr>

                                <th>Memo No.</th>
                                <th>Date</th>
                                <th>Year</th>
                                <th>Month</th>
                                <th>Created By</th>
                                <th>Created Date</th>
                                <th>Modified By</th>
                                <th>Option</th>

                            </tr>

                        </thead>

                        <tbody  style="text-align: right;">

                            <tr>
                                <td><?php echo $memo_no; ?></td>
                                <td><?php echo date('d/m/Y',strtotime($gen_date)); ?></td>
                                <td><?php echo $alt_year; ?></td>
                                <td><?php echo $mth; ?></td>
                                <td><?php echo $created_by; ?></td>
                                <td><?php echo $created_dt; ?></td>
                                <td><?php echo $modified_dt; ?></td>
                                <td><a class="contact1-form-btn hideFirst"

                                       href="aprv_calc.php?memo_no=<?php echo urlencode($memo_no);?>&gen_date=<?php echo $gen_date;?>"

                                        style="width: 25px;"

                                    > Approve <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <script src="../js/collapsible.js"></script>

	</body>

</html>
