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
	</head>
	<body>
		<table>
				<thead>
					<tr>
					    <th>Memo No.</th>
					    <th>Date</th> 
					    <th>Year</th>
					    <th>Month</th>
					    <th>Created By</th>
					    <th>Created Date<th>
					    <th>Modified By</th>
                                            <th>Modified Date</th>
					</tr>	
				</thead>
				<tbody>	
				<tr>
				   <td><?php echo $memo_no; ?></td>
				   <td><?php echo date('d/m/Y',strtotime($gen_date)); ?></td>
				   <td><?php echo $alt_year; ?></td>
				   <td><?php echo $mth; ?></td>
				   <td><?php echo $created_by; ?></td>
				   <td><?php echo $created_dt; ?></td>
				   <td><?php echo $modified_by; ?></td>
				   <td><?php echo $modified_dt; ?></td>
				   <td><a href="aprv_calc.php?memo_no=<?php echo urlencode($memo_no);?>&gen_date=<?php echo $gen_date;?>">Approve</a></td>

				</tr>
				</tbody>			
			</table>
	</body>		
</html>
