<?php

	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");
/*
	$prod_no    = 14;
	$prod_catg  = 'AAY';
	$start_dt   = '2018-07-24';
	$end_dt     = '2018-07-27';*/

	    $rep_data['start_dt']           = [];
        $rep_data['bag_opn_bal']        = [];
        $rep_data['qnt_opn_bal']        = [];
        $rep_data['kg_opn_bal']         = [];
        $rep_data['gm_opn_bal']         = [];
		$rep_data['do_no']         		= [];
        $rep_data['qty_bag']            = [];
        $rep_data['qty_qnt']            = [];
        $rep_data['qty_kg']             = [];
		$rep_data['qty_gm']             = [];
		$rep_data['allot_no']			= [];
		$rep_data['out_bag']            = [];
		$rep_data['out_qnt']            = [];
		$rep_data['out_kg']             = [];
		$rep_data['out_gm']             = [];
		$rep_data['sht_kg']				= [];
		$rep_data['sht_gm']				= [];
        $rep_data['bag_bal']            = [];
        $rep_data['qnt_bal']            = [];
        $rep_data['kg_bal']             = [];
		$rep_data['gm_bal']             = [];

	if ($_SERVER['REQUEST_METHOD']=="POST"){
		$prod_no 	= 	$_POST['sl_no'];
		$prod_catg 	= 	$_POST['prod_catg'];
		$start_dt 	= 	$_POST['start_dt'];
		$end_dt 	= 	$_POST['end_dt'];
	}

	$prod = "select prod_desc from m_products where sl_no = '$prod_no'";
	$rtv  = mysqli_query($db_connect,$prod);
	$row  = mysqli_fetch_assoc($rtv);
	$prod_desc = $row['prod_desc'];

	$header = "Stock Register For ".$prod_desc ." ".$prod_catg." Between ".date('d/m/Y',strtotime($start_dt))." To ".date('d/m/Y',strtotime($end_dt));

	$Sql    = "select * from td_stock_trans_pds 
                   where prod_sl_no = $prod_no 
                   and   trans_dt   >= '$start_dt'
				   and   trans_dt   <= '$end_dt'
				   and	 prod_catg  =  '$prod_catg'
                   and   approval_status = 'A'";

        $no     = mysqli_query($db_connect,$Sql);

		$count  = mysqli_num_rows($no);

		//echo $count; die;
		
	while($start_dt <= $end_dt)
	{
		
		$countSql = "select * from td_stock_trans_pds 
                        where prod_sl_no = $prod_no 
						and   trans_dt   = '$start_dt'
						and	 prod_catg  =  '$prod_catg'
                        and   approval_status = 'A'
                        order by trans_dt,trans_cd";

		$countResult = mysqli_query($db_connect,$countSql);

		//echo $countSql; die;
		
		If(mysqli_num_rows($countResult) > 0){

			while($data = mysqli_fetch_assoc($countResult))
            {

				$transDt = $data['trans_dt'];
                $trnsNo  = $data['trans_cd'];
                $trnTpe  = $data['trans_type'];

                $bagOpn  = $data['bag_opn'];
                $qntOpn   = $data['qnt_opn'];
                $kgOpn   = $data['kg_opn'];
                $gmOpn   = $data['gm_opn'];

                $bagCls  = $data['bag_bal'];
                $qntCls   = $data['qnt_bal'];
                $kgCls   = $data['kg_bal'];
				$gmCls   = $data['gm_bal'];

				$sht_kg   = $data['sht_kg'];
				$sht_gm   = $data['sht_gm'];

			/*	echo $transDt; echo "<br>";
				echo $trnsNo; echo "<br>";
				echo $trnTpe; echo "<br>";
				echo $bagOpn; echo "<br>";
				echo $kgOpn; echo "<br>";
				echo $bagCls; echo "<br>";
				echo $kgCls; echo "<br>";
				die; */
				
				if($trnTpe == 'I'){  

					$doNo    = $data['do_no'];
					$altNo   = 'NA';
					$bagRcv  = $data['qty_bag'];
					$qntRcv  = $data['qty_qnt'];
					$kgRcv   = $data['qty_kg'];
					$gmRcv   = $data['qty_gm'];
					//$altNo   = $data['allot_no'];
					$bagSld  = 0;
					$qntSld  = 0;
					$kgSld   = 0;
					$gmSld   = 0;

				}

				else{

					$doNo    = 'NA';
					$altNo   = $data['allot_no'];
					$bagRcv  = 0;
					$qntRcv   = 0;
					$kgRcv   = 0;
					$gmRcv   = 0;
					//$altNo   = $data['allot_no'];
					$bagSld  = $data['qty_bag'];
					$qntSld   = $data['qty_qnt'];
					$kgSld   = $data['qty_kg'];
					$gmSld   = $data['qty_gm'];

				}   
				
			/*	echo $doNo; echo "<br>";
				echo $altNo; echo "<br>";
				echo $bagRcv; echo "<br>";
				echo $qntRcv; echo "<br>";
				echo $kgRcv; echo "<br>";
				echo $gmRcv; echo "<br>";
				//echo $altNo; echo "<br>";
				echo $bagSld; echo "<br>";
				echo $qntSld; echo "<br>";
				echo $kgSld; echo "<br>";
				echo $gmSld; echo "<br>";
				die; */


				array_push($rep_data['start_dt'],$transDt); 
            //    array_push($rep_data['trn_no'],$trnsNo);
                array_push($rep_data['bag_opn_bal'],$bagOpn);
                array_push($rep_data['qnt_opn_bal'], $qntOpn);
                array_push($rep_data['kg_opn_bal'], $kgOpn);
                array_push($rep_data['gm_opn_bal'],$gmOpn);
                array_push($rep_data['do_no'],$doNo);
				array_push($rep_data['qty_bag'], $bagRcv);
				array_push($rep_data['qty_qnt'], $qntRcv);
				array_push($rep_data['qty_kg'], $kgRcv);
				array_push($rep_data['qty_gm'], $gmRcv);
				array_push($rep_data['allot_no'],$altNo);
				array_push($rep_data['out_bag'],$bagSld);
				array_push($rep_data['out_qnt'],$qntSld);
				array_push($rep_data['out_kg'],$kgSld);
				array_push($rep_data['out_gm'],$gmSld);
				array_push($rep_data['sht_kg'],$sht_kg);
				array_push($rep_data['sht_gm'],$sht_gm);
				array_push($rep_data['bag_bal'], $bagCls);
				array_push($rep_data['qnt_bal'], $qntCls);
				array_push($rep_data['kg_bal'], $kgCls);
				array_push($rep_data['gm_bal'], $gmCls);

			}
		
		}

		$start_dt = date('Y-m-d', strtotime($start_dt. ' + 1 days'));

	}

?>


	
<?php
/*

while($start_dt <= $end_dt){	

	$select = "Select count(*)opn_trn
		   from   td_stock_trans_pds
		   where  prod_sl_no = '$prod_no'
		   and    prod_catg  = '$prod_catg'	
		   and    approval_status = 'A'	
		   and    trans_dt = (select max(trans_dt)
                   		      from   td_stock_trans_pds
                     		      where  prod_sl_no = '$prod_no'
                   		      and    prod_catg  = '$prod_catg'
				      and    trans_dt < '$start_dt'
				      and    approval_status = 'A')";

	$result = mysqli_query($db_connect,$select);

	if($result){
		$row = mysqli_fetch_assoc($result);
		$opn_trn = $row['opn_trn'];
	}

	unset($select);
	unset($result);

	if($opn_trn > 0){
		$select = "Select max(trans_dt)max_dt,
			   max(trans_cd)max_cd
	  		   from td_stock_trans_pds
			   where prod_sl_no = '$prod_no'
                   	   and    prod_catg = '$prod_catg'
			   and   trans_dt < '$start_dt'
			   and    approval_status = 'A'";
		$result = mysqli_query($db_connect,$select);

		if($result){
			$row = mysqli_fetch_assoc($result);
			$max_dt = $row['max_dt'];
			$max_cd = $row['max_cd'];
		}

		$opening = "Select ifnull(sum(bag_bal),0)bag_bal,
				   ifnull(sum(qnt_bal),0)qnt_bal,
				   ifnull(sum(kg_bal),0)kg_bal,
				   ifnull(sum(gm_bal),0)gm_bal
			    from td_stock_trans_pds
			    where prod_sl_no = '$prod_no'
            	and    prod_catg  = '$prod_catg'
			    and   trans_dt = '$max_dt'
			    and   trans_cd = '$max_cd'
			    and   approval_status = 'A'";

		$opening_result=mysqli_query($db_connect,$opening);

		if($opening_result){
			$data = mysqli_fetch_assoc($opening_result);		
			$bag_opn_bal 	= 	$data['bag_bal'];
			$qnt_opn_bal 	= 	$data['qnt_bal'];
			$kg_opn_bal  	= 	$data['kg_bal'];
			$gm_opn_bal  	= 	$data['gm_bal'];
		}
	}
	else{
		$bag_opn_bal = 0;
		$qnt_opn_bal = 0;
		$kg_opn_bal  = 0;
		$gm_opn_bal  = 0;
	}
	
	unset($select);
	unset($result);	

	$select="Select do_no,
 	       ifnull(sum(qty_bag),0)qty_bag,
               ifnull(sum(qty_qnt),0)qty_qnt,
               ifnull(sum(qty_kg),0)qty_kg,
               ifnull(sum(qty_gm),0)qty_gm
        from   td_stock_trans_pds
        where  prod_sl_no = '$prod_no'
        and    prod_catg  = '$prod_catg'
        and    trans_dt   = '$start_dt'
        and    trans_type =  'I'
        and    approval_status = 'A'
	group by do_no";
	   	
	$result = mysqli_query($db_connect,$select);

	if($result){

		if(mysqli_num_rows($result) > 0){

			$data = mysqli_fetch_assoc($result);
			$qty_bag = $data['qty_bag'];
			$qty_qnt = $data['qty_qnt'];
			$qty_kg  = $data['qty_kg'];
			$qty_gm  = $data['qty_gm'];
			$do_no   = $data['do_no'];
			$allot_no = '';

			
		}
		else{

			$qty_bag = 0;
			$qty_qnt = 0;
			$qty_kg  = 0;
			$qty_gm  = 0;	
			$do_no   = '';
			$allot_no = '';
		}
	}
				
	unset($select);
	unset($result);
	
	$select = "Select allot_no,
                        ifnull(sum(qty_bag),0)out_bag,
                        ifnull(sum(qty_qnt),0)out_qnt,
                        ifnull(sum(qty_kg),0)out_kg,
                        ifnull(sum(qty_gm),0)out_gm,
               		  	ifnull(sum(sht_kg),0)sht_kg,
               		  	ifnull(sum(sht_gm),0)sht_gm
        	  from   td_stock_trans_pds
        	  where  prod_sl_no = '$prod_no'
        	  and    prod_catg  = '$prod_catg'
        	  and    trans_dt   = '$start_dt'
        	  and    trans_type =  'O'
        	  and    approval_status = 'A'
		  group by allot_no";

	$result = mysqli_query($db_connect,$select);

        if($result){

            if(mysqli_num_rows($result) > 0){

					$data = mysqli_fetch_assoc($result);
					
                    $out_bag = $data['out_bag'];
                    $out_qnt = $data['out_qnt'];
                    $out_kg  = $data['out_kg'];
                    $out_gm  = $data['out_gm'];
					$allot_no= $data['allot_no'];
					$sht_kg  = $data['sht_kg'];
					$sht_gm  = $data['sht_gm'];
					$do_no = '';

			}

			else{
                $out_bag = 0;
                $out_qnt = 0;
                $out_kg  = 0;
				$out_gm  = 0;
				$sht_kg  = 0;
				$sht_gm  = 0;
				$do_no   = '';
				$allot_no= '';
          	}
        }

			
			$max = "select max(trans_cd)transcd
			        from   td_stock_trans_pds
			        where  prod_sl_no = '$prod_no'
                   		and    prod_catg  = '$prod_catg'
				and    trans_dt = '$start_dt'
				and    approval_status = 'A'";
			$max_result = mysqli_query($db_connect,$max);
			$row = mysqli_fetch_assoc($max_result);
			$transcd = $row['transcd'];

			$closing = "select ifnull(bag_bal,0)bag_bal,
					   ifnull(qnt_bal,0)qnt_bal,
					   ifnull(kg_bal,0)kg_bal,
					   ifnull(gm_bal,0)gm_bal
				    from   td_stock_trans_pds
                    where  prod_sl_no = '$prod_no'
                   	and    prod_catg  = '$prod_catg'
				    and    trans_dt = '$start_dt'
				    and    approval_status = 'A'";  

			$cls_result = mysqli_query($db_connect,$closing);	

			
			if($cls_result){
				if(mysqli_num_rows($cls_result) > 0){ 
					$data = mysqli_fetch_assoc($cls_result);
					$bag_bal = $data['bag_bal'];
					$qnt_bal = $data['qnt_bal'];
					$kg_bal  = $data['kg_bal'];
					$gm_bal  = $data['gm_bal'];
				}else{
					$bag_bal = 0;
					$qnt_bal = 0;
					$kg_bal  = 0;
					$gm_bal  = 0;	
				}		
			}
			
	array_push($rep_data['start_dt'], $start_dt); 
	array_push($rep_data['bag_opn_bal'], $bag_opn_bal);
	array_push($rep_data['qnt_opn_bal'], $qnt_opn_bal);
	array_push($rep_data['kg_opn_bal'], $kg_opn_bal);
	array_push($rep_data['gm_opn_bal'], $gm_opn_bal);
	array_push($rep_data['do_no'], $do_no);
	array_push($rep_data['qty_bag'], $qty_bag);
	array_push($rep_data['qty_qnt'], $qty_qnt);
	array_push($rep_data['qty_kg'], $qty_kg);
	array_push($rep_data['qty_gm'], $qty_gm);
	array_push($rep_data['allot_no'],$allot_no);
	array_push($rep_data['out_bag'],$out_bag);
    array_push($rep_data['out_qnt'],$out_qnt);
    array_push($rep_data['out_kg'],$out_kg);
    array_push($rep_data['out_gm'],$out_gm);
    array_push($rep_data['sht_kg'],$sht_kg);
	array_push($rep_data['sht_gm'],$sht_gm);
	array_push($rep_data['bag_bal'], $bag_bal);
	array_push($rep_data['qnt_bal'], $qnt_bal);
	array_push($rep_data['kg_bal'], $kg_bal);
	array_push($rep_data['gm_bal'], $gm_bal);

	$start_dt = date('Y-m-d', strtotime($start_dt. ' + 1 days'));
	
 }
	//var_dump ($rep_data['start_dt']);
	*/
?>
<html>

    <head>

        <title>Synergic Inventory Management System - Stock Register</title>

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

    <script>

        $(document).ready(function () {

            $('#print').click(function () {

                printDiv();

            });

            function printDiv() {

                var divToPrint = document.getElementById('divToPrint');

                var WindowObject = window.open('', 'Print-Window');
                WindowObject.document.open();
                WindowObject.document.writeln('<!DOCTYPE html>');
                WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


                WindowObject.document.writeln('@media print { .center { text-align: center;}' +
                    '                                         .inline { display: inline; }' +
                    '                                         .underline { text-decoration: underline; }' +
                    '                                         .left { margin-left: 315px;} ' +
                    '                                         .right { margin-right: 375px; display: inline; }' +
                    '                                          table { border-collapse: collapse; }' +
                    '                                          th, td { border: 1px solid black; border-collapse: collapse; padding: 10px;}' +
                    '                                           th, td { }' +
                    '                                         .border { border: 1px solid black; } ' +
                    '                                         .bottom { bottom: 5px; width: 100%; position: fixed ' +
                    '                                       ' +
                    '                                   } } </style>');
                // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
                WindowObject.document.writeln('</head><body onload="window.print()">');
                WindowObject.document.writeln(divToPrint.innerHTML);
                WindowObject.document.writeln('</body></html>');
                WindowObject.document.close();
                setTimeout(function () {
                    WindowObject.close();
                }, 10);

            }

        });

    </script>

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

                    <div class="container-contact1" style="margin-top: 100px;">

                        <div class="contact1-form">

                            <h3 style="text-align: center"><b><?php echo $header; ?></b></h3>

                        </div>

                    </div>

                </div>

            </div>

            <div id="divToPrint">

                <div class="row">

                    <div class="col-lg-8 col-md-6">

                        <div class="container-contact2" style="margin-left: 0">


                            <table class="table table-bordered table-hover" style="width: 100%">

                                <thead style="background-color: #212529; color: #fff;">

                                <tr>

                                    <th>Date</th>
                                    <th>Opening<br>Stock<br>(Bag/Tin)</th>
                                    <th>Opening<br>Stock<br>(Quintal)</th>
                                    <th>Opening<br>Stock<br>(Kg)</th>
                                    <th>Opening<br>Stock<br>(Gm)</th>
                                    <th>Do<br>No.</th>
                                    <th>Received<br>(Bag/Tin)</th>
                                    <th>Received<br>(Quintal)</th>
                                    <th>Received<br>(Kg)</th>
                                    <th>Received<br>(Gm)</th>
                                    <th>Allotment No.</th>
                                    <th>Sold<br>(Bag/Tin)</th>
                                    <th>Sold<br>(Quintal)</th>
                                    <th>Sold<br>(Kg)</th>
                                    <th>Sold<br>(Gm)</th>
                                    <th>Shortage<br>(Kg)</th>
                                    <th>Shortage<br>(Gm)</th>
                                    <th>Closing<br>Stock<br>(Bag/Tin)</th>
                                    <th>Closing<br>Stock<br>(Quintal)</th>
                                    <th>Closing<br>Stock<br>(Kg)</th>
                                    <th>Closing<br>Stock<br>(Gm)</th>

                                </tr>

                                </thead>

                                <tbody style="text-align: right;">

                                <?php

                                for($i=0; $i < $count; $i++) {?>

                                    <tr>
                                        <td><?php echo date('d/m/Y',strtotime($rep_data['start_dt'][$i])); ?></td>
                                        <td><?php echo $rep_data['bag_opn_bal'][$i];?></td>
                                        <td><?php echo $rep_data['qnt_opn_bal'][$i];?></td>
                                        <td><?php echo $rep_data['kg_opn_bal'][$i];?></td>
                                        <td><?php echo $rep_data['gm_opn_bal'][$i];?></td>
                                        <td><?php echo $rep_data['do_no'][$i];?></td>
                                        <td><?php echo $rep_data['qty_bag'][$i];?></td>
                                        <td><?php echo $rep_data['qty_qnt'][$i];?></td>
                                        <td><?php echo $rep_data['qty_kg'][$i];?></td>
                                        <td><?php echo $rep_data['qty_gm'][$i];?></td>
                                        <td><?php echo $rep_data['allot_no'][$i] ?></td>
                                        <td><?php echo $rep_data['out_bag'][$i];?></td>
                                        <td><?php echo $rep_data['out_qnt'][$i];?></td>
                                        <td><?php echo $rep_data['out_kg'][$i];?></td>
                                        <td><?php echo $rep_data['out_gm'][$i];?></td>
                                        <td><?php echo $rep_data['sht_kg'][$i];?></td>
                                        <td><?php echo $rep_data['sht_gm'][$i];?></td>
                                        <td><?php echo $rep_data['bag_bal'][$i];?></td>
                                        <td><?php echo $rep_data['qnt_bal'][$i];?></td>
                                        <td><?php echo $rep_data['kg_bal'][$i];?></td>
                                        <td><?php echo $rep_data['gm_bal'][$i];?></td>
                                    </tr>
                                    <?php
                                }

                                ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="modal-footer">

            <a class="btn btn-default" href="../report/stock_reg_ip.php"
               style="color: #fff; background-color: #868e96;  border-color: #868e96;">

                Back</a>

            <button class="btn btn-primary" id="print" type="button">Print</button>

        </div>

    <?php

        require("footer.html");

    ?>

        <script src="../js/collapsible.js"></script>

    </body>

</html>
