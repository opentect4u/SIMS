<?php

    ini_set("display_errors","1");
    error_reporting("E_ALL");

    require("../db/db_connect.php");
    require("../session.php");

        $rep_data['mr_no']                  = [];
        $rep_data['trans_dt']               = [];
        $rep_data['cash_paid']              = [];
        $rep_data['material_paid']          = [];
        $rep_data['due_amnt']               = [];

    if ($_SERVER['REQUEST_METHOD'] == "POST") 
    {
        $mr_no = $_POST['del_cd'];
        $start_dt = $_POST['start_dt'];
        $end_dt = $_POST['end_dt'];
    }


    $sql = "SELECT * FROM td_del_payment 
            WHERE mr_no = '$mr_no'
            AND trans_dt >= '$start_dt'
            AND trans_dt <= '$end_dt' ";

    $no     = mysqli_query($db_connect,$sql);
    $count  = mysqli_num_rows($no);

    while($start_dt <= $end_dt)
    {

        $countSql = "SELECT * FROM td_del_payment 
                         WHERE mr_no = $mr_no 
                         AND   trans_dt   = '$start_dt' ";

        $countResult = mysqli_query($db_connect,$countSql);  

        If(mysqli_num_rows($countResult) > 0)
        {

            while($data = mysqli_fetch_assoc($countResult))
            {

                $mr_no = $data['mr_no'];
                $trans_dt  = $data['trans_dt'];
                $cash_paid  = $data['cash_paid'];
                $material_paid  = $data['material_paid'];
                $due_amnt  = $data['due_amnt'];

                array_push($rep_data['mr_no'],$mr_no); 
                array_push($rep_data['trans_dt'],$trans_dt);
                array_push($rep_data['cash_paid'],$cash_paid);
                array_push($rep_data['material_paid'], $material_paid);
                array_push($rep_data['due_amnt'], $due_amnt);
                


            }

        }

        $start_dt = date('Y-m-d', strtotime($start_dt. ' + 1 days'));

    }



?>

<html>

     <head>

        <title>Synergic Inventory Management System-PDS Challan</title>

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

    <style>

        h1 {
            font-size: 65px;
        }

    </style>


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

        <div id="divToPrint">

            <div class="row" >

                <div class="col-lg-12 col-md-6">

                    <div class="container-contact2" style="margin-left: 10px; width: 100%;">

                        <table id="intro" class="table table-bordered table-hover">

                            <thead style="background-color: #212529; color: #fff; text-align: right;">

                                <tr>

                                    <th>MR. No.</th>

                                    <th>Date</th>

                                    <th>Cash Paid</th>

                                    <th>Material Paid</th>

                                    <th>Due Amount</th>

                                </tr>

                            </thead>

                            <tbody>

                                
                                <?php     

                                /*if($_SERVER['REQUEST_METHOD'] == "POST") {   

                                    while ($data = mysqli_fetch_assoc($sql_join)) { */

                                    for($j=0; $j < $count; $j++) {
                                    

                                    ?>

                                        <tr>

                                            <td><?php echo $rep_data['mr_no'][$j]; ?></td>

                                            <td><?php echo $rep_data['trans_dt'][$j]; ?></td>

                                            <td><?php echo $rep_data['cash_paid'][$j]; ?></td>

                                            <td><?php echo $rep_data['material_paid'][$j]; ?> </td>

                                            <td><?php echo $rep_data['due_amnt'][$j]; ?> </td>


                                        </tr>

                                    <?php //}

                                }
                            // } ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        <div class="modal-footer">

            <a class="btn btn-default" href="../report/del_pay_report.php"
               style="color: #fff; background-color: #868e96;  border-color: #868e96;">

                Back</a>

            <button class="btn btn-primary" id="print" type="button">Print</button>

        </div>


    </body>

    <script src="../js/collapsible.js"></script>



</html> 
