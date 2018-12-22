<?php

	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
    require("../session.php");

        $rep_data['start_dt']               = [];
        $rep_data['trn_no']                 = [];
        $rep_data['bag_opn_bal']            = [];
        $rep_data['cs_opn_bal']             = [];
        $rep_data['kg_opn_bal']             = [];
        $rep_data['pieces_opn_bal']         = [];
		$rep_data['do_no']         		    = [];
        $rep_data['qty_bag']                = [];
        $rep_data['qty_cs']                 = [];
        $rep_data['qty_kg']                 = [];
		$rep_data['qty_pieces']             = [];
		$rep_data['allot_no']			    = [];
		$rep_data['out_bag_tin']            = [];
		$rep_data['out_cs']                 = [];
		$rep_data['out_kg']                 = [];
		$rep_data['out_pieces']             = [];
        $rep_data['bag_bal']                = [];
        $rep_data['cs_bal']                 = [];
        $rep_data['kg_bal']                 = [];
		$rep_data['pieces_bal']             = []; 

    if ($_SERVER['REQUEST_METHOD']=="POST"){
		$prod_no    = $_POST['sl_no'];
		$start_dt   = $_POST['start_dt'];
        $end_dt     = $_POST['end_dt'];

    }    

    $SELECT = "select prod_desc from m_products where sl_no = $prod_no";

    $prod   = mysqli_query($db_connect,$SELECT);

    $prodDesc = mysqli_fetch_assoc($prod);

    $header = "Stock Register For ".$prodDesc['prod_desc']." Between ".date('d/m/Y',strtotime($start_dt))." To ".date('d/m/Y',strtotime($end_dt));

        $Sql    = "select * from td_stock_trans_np 
                   where prod_sl_no = $prod_no 
                   and   trans_dt   >= '$start_dt'
                   and   trans_dt   <= '$end_dt'
                   and   approval_status = 'A'";

        $no     = mysqli_query($db_connect,$Sql);

        $count  = mysqli_num_rows($no);

        while($start_dt <= $end_dt)
        {
          
            $countSql = "select * from td_stock_trans_np 
                         where prod_sl_no = $prod_no 
                         and   trans_dt   = '$start_dt'
                         and   approval_status = 'A'
                         order by trans_dt,trans_cd";

            $countResult = mysqli_query($db_connect,$countSql);
            
            If(mysqli_num_rows($countResult) > 0){

               while($data = mysqli_fetch_assoc($countResult))
               {
               
                    $transDt = $data['trans_dt'];
                    $trnsNo  = $data['trans_cd'];
                    $trnTpe  = $data['trans_type'];

                    $bagOpn  = $data['bags_tin_opn'];
                    $csOpn   = $data['cs_opn'];
                    $kgOpn   = $data['kg_opn'];
                    $pcOpn   = $data['pieces_opn'];

                    $bagCls  = $data['bag_tin_bal'];
                    $csCls   = $data['cs_bal'];
                    $kgCls   = $data['kg_bal'];
                    $pcCls   = $data['pieces_bal'];

                    if($trnTpe == 'I'){  

                        $doNo    = $data['do_no'];
                        $altNo   = 'NA';
                        $bagRcv  = $data['qty_bags_tin'];
                        $csRcv   = $data['qty_cs'];
                        $kgRcv   = $data['qty_kg'];
                        $pcRcv   = $data['qty_pieces'];
                        $altNo   = $data['allot_no'];
                        $bagSld  = 0;
                        $csSld   = 0;
                        $kgSld   = 0;
                        $pcSld   = 0;

                    }
                    else{

                        $doNo    = 'NA';
                        $altNo   = $data['allot_no'];
                        $bagRcv  = 0;
                        $csRcv   = 0;
                        $kgRcv   = 0;
                        $pcRcv   = 0;
                        $altNo   = $data['allot_no'];
                        $bagSld  = $data['qty_bags_tin'];
                        $csSld   = $data['qty_cs'];
                        $kgSld   = $data['qty_kg'];
                        $pcSld   = $data['qty_pieces'];

                    }                   

                    array_push($rep_data['start_dt'],$transDt); 
                    array_push($rep_data['trn_no'],$trnsNo);
                    array_push($rep_data['bag_opn_bal'],$bagOpn);
                    array_push($rep_data['cs_opn_bal'], $csOpn);
                    array_push($rep_data['kg_opn_bal'], $kgOpn);
                    array_push($rep_data['pieces_opn_bal'],$pcOpn);
                    array_push($rep_data['do_no'],$doNo);
                    array_push($rep_data['qty_bag'], $bagRcv);
                    array_push($rep_data['qty_cs'], $csRcv);
                    array_push($rep_data['qty_kg'], $kgRcv);
                    array_push($rep_data['qty_pieces'], $pcRcv);
                    array_push($rep_data['allot_no'],$altNo);
                    array_push($rep_data['out_bag_tin'],$bagSld);
                    array_push($rep_data['out_cs'],$csSld);
                    array_push($rep_data['out_kg'],$kgSld);
                    array_push($rep_data['out_pieces'],$pcSld);
                    array_push($rep_data['bag_bal'], $bagCls);
                    array_push($rep_data['cs_bal'], $csCls);
                    array_push($rep_data['kg_bal'], $kgCls);
                    array_push($rep_data['pieces_bal'], $pcCls); 
                }  
            } 

            $start_dt = date('Y-m-d', strtotime($start_dt. ' + 1 days'));
        }
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
                                    <!--<th>Transaction No</th>-->
                                    <th>Opening<br>Stock<br>(Bag/Tin)</th>
                                    <th>Opening<br>Stock<br>(CS)</th>
                                    <th>Opening<br>Stock<br>(Kg)</th>
                                    <th>Opening<br>Stock<br>(Pieces)</th>
                                    <th>Do<br>No.</th>
                                    <th>Received<br>(Bag/Tin)</th>
                                    <th>Received<br>(CS)</th>
                                    <th>Received<br>(Kg)</th>
                                    <th>Received<br>(Pieces)</th>
                                    <th>Allotment No.</th>
                                    <th>Sold<br>(Bag/Tin)</th>
                                    <th>Sold<br>(CS)</th>
                                    <th>Sold<br>(Kg)</th>
                                    <th>Sold<br>(Pieces)</th>
                                    <th>Closing<br>Stock<br>(Bag/Tin)</th>
                                    <th>Closing<br>Stock<br>(CS)</th>
                                    <th>Closing<br>Stock<br>(Kg)</th>
                                    <th>Closing<br>Stock<br>(Pieces)</th>

                                </tr>

                                </thead>

                                <tbody style="text-align: right;">

                                <?php

                                     //   var_dump($count);die;

                                for($j=0; $j < $count; $j++) { ?>
                                    <tr>
                                        <td><?php echo date('d/m/Y',strtotime($rep_data['start_dt'][$j])); ?></td>
                                        <!--<td><?php //echo $rep_data['trn_no'][$j];?></td>-->
                                        <td><?php echo $rep_data['bag_opn_bal'][$j];?></td>
                                        <td><?php echo $rep_data['cs_opn_bal'][$j];?></td>
                                        <td><?php echo $rep_data['kg_opn_bal'][$j];?></td>
                                        <td><?php echo $rep_data['pieces_opn_bal'][$j];?></td>
                                        <td><?php echo $rep_data['do_no'][$j];?></td>
                                        <td><?php echo $rep_data['qty_bag'][$j];?></td>
                                        <td><?php echo $rep_data['qty_cs'][$j];?></td>
                                        <td><?php echo $rep_data['qty_kg'][$j];?></td>
                                        <td><?php echo $rep_data['qty_pieces'][$j];?></td>
                                        <td><?php echo $rep_data['allot_no'][$j] ?></td>
                                        <td><?php echo $rep_data['out_bag_tin'][$j];?></td>
                                        <td><?php echo $rep_data['out_cs'][$j];?></td>
                                        <td><?php echo $rep_data['out_kg'][$j];?></td>
                                        <td><?php echo $rep_data['out_pieces'][$j];?></td>
                                        <td><?php echo $rep_data['bag_bal'][$j];?></td>
                                        <td><?php echo $rep_data['cs_bal'][$j];?></td>
                                        <td><?php echo $rep_data['kg_bal'][$j];?></td>
                                        <td><?php echo $rep_data['pieces_bal'][$j];?></td>
                                    
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

            <a class="btn btn-default" href="../report/stock_reg_ip_np.php"
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
