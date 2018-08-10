<?php

    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require("../db/db_connect.php");
    require("../session.php");

    $memoNo = $_SESSION['memo_no'];

    $result_array['gen_date'] =
    $result_array['mr_no'] =
    $result_array['delr_name'] =
    $result_array['delr_region'] =
    $result_array['aay_family'] =
    $result_array['aay_rice'] =
    $result_array['aay_wheat'] =
    $result_array['aay_atta'] =
    $result_array['aay_sugar'] =
    $result_array['phh_head'] =
    $result_array['phh_rice'] =
    $result_array['phh_wheat'] =
    $result_array['phh_atta'] =
    $result_array['sphh_head'] =
    $result_array['sphh_rice'] =
    $result_array['sphh_wheat'] =
    $result_array['sphh_atta'] =
    $result_array['sphh_sugar'] =
    $result_array['rksy1_head'] =
    $result_array['rksy1_rice'] =
    $result_array['rksy1_wheat'] =
    $result_array['rksy1_atta'] =
    $result_array['rksy2_head'] =
    $result_array['rksy2_rice'] =
    $result_array['rksy2_wheat'] =
    $result_array['rksy2_atta'] = [];

    $sql = "SELECT   gen_date,
                     mr_no,
                     delr_name,
                     delr_region,
                     aay_family,
                     aay_rice,
                     aay_wheat,
                     aay_atta,
                     aay_sugar,
                     phh_head,
                     phh_rice,
                     phh_wheat,
                     phh_atta,
                     sphh_head,
                     sphh_rice,
                     sphh_wheat,
                     sphh_atta,
                     sphh_sugar,
                     rksy1_head,
                     rksy1_rice,
                     rksy1_wheat,
                     rksy1_atta,
                     rksy2_head,
                     rksy2_rice,
                     rksy2_wheat,
                     rksy2_atta FROM td_allotment_sheet WHERE memo_no = '$memoNo'";

    $result = mysqli_query($db_connect, $sql);

    while ($data = mysqli_fetch_assoc($result)) {

        array_push($result_array['gen_date'], $data['gen_date']);
        array_push($result_array['mr_no'], $data['mr_no']);
        array_push($result_array['delr_name'], $data['delr_name']);
        array_push($result_array['delr_region'], $data['delr_region']);
        array_push($result_array['aay_family'], $data['aay_family']);
        array_push($result_array['aay_rice'], $data['aay_rice']);
        array_push($result_array['aay_wheat'], $data['aay_wheat']);
        array_push($result_array['aay_atta'], $data['aay_atta']);
        array_push($result_array['aay_sugar'], $data['aay_sugar']);
        array_push($result_array['phh_head'], $data['phh_head']);
        array_push($result_array['phh_rice'], $data['phh_rice']);
        array_push($result_array['phh_wheat'], $data['phh_wheat']);
        array_push($result_array['phh_atta'], $data['phh_atta']);
        array_push($result_array['sphh_head'], $data['sphh_head']);
        array_push($result_array['sphh_rice'], $data['sphh_rice']);
        array_push($result_array['sphh_wheat'], $data['sphh_wheat']);
        array_push($result_array['sphh_atta'], $data['sphh_atta']);
        array_push($result_array['sphh_sugar'], $data['sphh_sugar']);
        array_push($result_array['rksy1_head'], $data['rksy1_head']);
        array_push($result_array['rksy1_rice'], $data['rksy1_rice']);
        array_push($result_array['rksy1_wheat'], $data['rksy1_wheat']);
        array_push($result_array['rksy1_atta'], $data['rksy1_atta']);
        array_push($result_array['rksy2_head'], $data['rksy2_head']);
        array_push($result_array['rksy2_rice'], $data['rksy2_rice']);
        array_push($result_array['rksy2_wheat'], $data['rksy2_wheat']);
        array_push($result_array['rksy2_atta'], $data['rksy2_atta']);
    }

?>

<html>

    <head>

        <title>Synergic Inventory Management Allotment Sheet Report</title>

        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

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
        
        $(document).ready( function () {

            // Declaring global_var to store allotment scale input....

            var global_var, global_var1;


            //Fetching allotment scale details....

            $.ajax({

                url:"../fetch/allot_scale_dtls.php",

                type:"post"

            }).done( function ( result ) {

                global_var = JSON.parse(result);

                console.log(global_var);

            });


            //Fetching allotment sheet....

            $.ajax({

                url: "../fetch/allot_sheet_dtls.php",

                data: {

                    memo_no: "<?php echo $memo_no ?>"

                },

                dataType: "json",

                type: "GET"

            }).done(function (result) {

                console.log(result);

                    /*for (var i = 0; i < result.mr_no.length; i++) {

                        tableRow();

                        $('.mr_no').eq(i).val(result.mr_no[i]);
                        $('.dealer_name').eq(i).val(result.delr_name[i]);
                        $('.region').eq(i).val(result.delr_region[i]);

                        $('.aay').eq(i).val(result.aay_family[i]);
                        $('.aay_rice').eq(i).val(result.aay_rice[i]);
                        $('.aay_wheat').eq(i).val(result.aay_wheat[i]);
                        $('.aay_atta').eq(i).val(result.aay_atta[i]);
                        $('.aay_sugar').eq(i).val(result.aay_sugar[i]);

                        $('.phh').eq(i).val(result.phh_head[i]);
                        $('.phh_rice').eq(i).val(result.phh_rice[i]);
                        $('.phh_wheat').eq(i).val(result.phh_wheat[i]);
                        $('.phh_atta').eq(i).val(result.phh_atta[i]);

                        $('.sphh').eq(i).val(result.sphh_head[i]);
                        $('.sphh_rice').eq(i).val(result.sphh_rice[i]);
                        $('.sphh_wheat').eq(i).val(result.sphh_wheat[i]);
                        $('.sphh_atta').eq(i).val(result.sphh_wheat[i]);
                        $('.sphh_sugar').eq(i).val(result.sphh_sugar[i]);

                        $('.rksy1').eq(i).val(result.rksy1_head[i]);
                        $('.rksy1_rice').eq(i).val(result.rksy1_rice[i]);
                        $('.rksy1_wheat').eq(i).val(result.rksy1_wheat[i]);
                        $('.rksy1_atta').eq(i).val(result.rksy2_wheat[i]);

                        $('.rksy2').eq(i).val(result.rksy2_head[i]);
                        $('.rksy2_rice').eq(i).val(result.rksy2_rice[i]);
                        $('.rksy2_wheat').eq(i).val(result.rksy2_wheat[i]);
                        $('.rksy2_atta').eq(i).val(result.rksy2_wheat[i]);
                    }*/

            });


            function tableRow() {

                $('#intro').append('<tr>
                    '
                    '                                            <td><input type="text" name="mr_no[]" class="input2 mr_no" style="width:80px"/></td>
                    '                                            <td><input type="text" name="dealer_name[]" class="input2 dealer_name" style="width:150px" readonly /></td>
                    '                                            <td><input type="text" name="region[]" class="input2 region" style="width:150px" readonly/></td>
                    '
                    '                                            <td><input type="number" name="aay[]" class="input2 aay" style="width:100px"/></td>
                    '                                            <td><input type="text" name="aay_rice[]" class="input2 aay_rice" style="width:100px"></td>
                    '                                            <td><input type="text" name="aay_wheat[]" class="input2 aay_wheat" style="width:100px"></td>
                    '                                            <td><input type="text" name="aay_atta[]" class="input2 aay_atta" style="width:100px" /></td>
                    '                                            <td><input type="text" name="aay_sugar[]" class="input2 aay_sugar" style="width:100px" /></td>
                    '
                    '                                            <td><input type="number" name="phh[]" class="input2 phh" style="width:100px"/></td>
                    '                                            <td><input type="text" name="phh_rice[]" class="input2 phh_rice" style="width:100px" /></td>
                    '                                            <td><input type="text" name="phh_wheat[]" class="input2 phh_wheat" style="width:100px" /></td>
                    '                                            <td><input type="text" name="phh_atta[]" class="input2 phh_atta" style="width:100px" /></td>
                    '
                    '                                            <td><input type="number" name="sphh[]" class="input2 sphh" style="width:100px"/></td>
                    '                                            <td><input type="text" name="sphh_rice[]" class="input2 sphh_rice" style="width:100px"/></td>
                    '                                            <td><input type="text" name="sphh_wheat[]" class="input2 sphh_wheat" style="width:100px"/></td>
                    '                                            <td><input type="text" name="sphh_atta[]" class="input2 sphh_atta" style="width:100px" /></td>
                    '                                            <td><input type="text" name="sphh_sugar[]" class="input2 sphh_sugar" style="width:100px" /></td>
                    '
                    '                                            <td><input type="number" name="rksy1[]" class="input2 rksy1" style="width:100px"/></td>
                    '                                            <td><input type="text" name="rksy1_rice[]" class="input2 rksy1_rice" style="width:100px" /></td>
                    '                                            <td><input type="text" name="rksy1_wheat[]" class="input2 rksy1_wheat" style="width:100px" /></td>
                    '                                            <td><input type="text" name="rksy1_atta[]" class="input2 rksy1_atta" style="width:100px" /></td>
                    '
                    '                                            <td><input type="number" name="rksy2[]" class="input2 rksy2" style="width:100px"/></td>
                    '                                            <td><input type="text" name="rksy2_rice[]" class="input2 rksy2_rice" style="width:100px"/></td>
                    '                                            <td><input type="text" name="rksy2_wheat[]" class="input2 rksy2_wheat" style="width:100px"/></td>
                    '                                            <td><input type="text" name="rksy2_atta[]" class="input2 rksy2_atta" style="width:100px" /></td>
                    '
                    '                                        </tr>');
            }


        });
        
    </script>

    <script>

        $(document).ready(function () {

            $('#print').click(function () {

                printDiv();
                
            });

            function printDiv() {

                var divToPrint=document.getElementById('divToPrint');

                var WindowObject=window.open('','Print-Window');
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
                setTimeout(function(){ WindowObject.close();},10);

            }

        });

    </script>

    <body class="body">

        <div id="divToPrint">

            <div>

                <p class="center underline" style="font-size: 18px;">

                    ALLOTMENT SHEET OF NFSA (AAY & PHH + SPHH) & RKSY-I & RKSY-II 2nd F.N. FOR JUNE - 2018

                </p>

            </div>

            <div>

                <p class="inline">

                    Memo No.-

                </p>

                <p class="center inline" style="margin-left: 80%">

                    Date:-

                </p>

            </div>

            <br style="line-height: 15px;">

            <div>

                <p>

                    M/S Laxmi Narayan Stores, M.R. Distributor, Belgram,
                    Udaynarayanpur, Howrah. You hereby instructed to deliver
                    M.R. Cereals to the following M.R. Dealers of U.N.Pur as per allocation
                    payment at Govt. fixed rate against proper cash memo.

                </p>

            </div>

            // Allotment scale details..............................

            <div>

                <table class="center" style="width: 100%">

                    <tr>

                        <td rowspan="2"><b>SCALE</b></td>

                        <td>AAY RICE</td>

                        <td>AAY ATTA</td>


                        <td>PHH RICE</td>

                        <td>PHH ATTA</td>


                        <td>SPHH RICE</td>

                        <td>SPHH ATTA</td>


                        <td>RKSY-I RICE</td>

                        <td>RKSY-I WHEAT</td>


                        <td>RKSY-II RICE</td>

                        <td>RKSY-II WHEAT</td>

                    </tr>

                    <tr>

                        <td>100 Kg/Family</td>

                        <td>100 Kg/Family</td>


                        <td>100 Kg/Head</td>

                        <td>100 Kg/Head</td>


                        <td>100 Kg/Head</td>

                        <td>100 Kg/Head</td>


                        <td>100 Kg/Head</td>

                        <td>100 Kg/Head</td>


                        <td>100 Kg/Head</td>

                        <td>100 Kg/Head</td>

                    </tr>

                </table>

            </div>


            <br style="line-height: 15px;">


            <!-- Allotment Sheet............................................. -->

            <div>

                <table id="intro" class="table table-bordered table-hover" style="width: 100%;">

                    <thead style="background-color: #212529; color: #fff; text-align: center;" >

                    <tr>

                        <th>MR<br>NO</th>

                        <th>NAME OF<br>DEALER</th>

                        <th>ANCHAL</th>


                        <th>AAY<br>FAMILY</th>

                        <?php

                            if($result_array['aay_rice'][2] != 0.00) {

                                echo "<th>RICE</th>";

                            }

                            else {

                                echo "<th style='display: none'>RICE</th>";

                            }

                        ?>


                        <?php

                            if($result_array['aay_wheat'][2] != 0.00) {

                                echo "<th>WHEAT</th>";

                            }

                            else {

                                echo "<th style='display: none'>WHEAT</th>";

                            }

                        ?>


                        <?php

                            if($result_array['aay_atta'][1] != 0.00){

                                echo "<th>ATTA</th>";

                            }

                            else {

                                echo "<th style='display: none'>ATTA</th>";

                            }

                        ?>


                        <?php

                            if($result_array['aay_sugar'][2] != 0.00){

                                echo "<th>SUGAR</th>";

                            }

                            else {

                                echo "<th style='display: none'>SUGAR</th>";

                            }

                        ?>

                        <th>PHH<br>HEAD</th>

                        <?php

                        if($result_array['phh_rice'][2] != 0.00){

                            echo "<th>RICE</th>";

                        }

                        else {

                            echo "<th style='display: none'>RICE</th>";

                        }

                        ?>


                        <?php

                        if($result_array['phh_wheat'][2] != 0.00){

                            echo "<th>WHEAT</th>";

                        }

                        else {

                            echo "<th style='display: none'>WHEAT</th>";

                        }

                        ?>


                        <?php

                        if($result_array['phh_atta'][1] != 0.00){

                            echo "<th>ATTA</th>";

                        }

                        else {

                            echo "<th style='display: none'>ATTA</th>";

                        }

                        ?>


                        <th>SPHH<br>HEAD</th>

                        <?php

                        if($result_array['sphh_rice'][2] != 0.00){

                            echo "<th>RICE</th>";

                        }

                        else {

                            echo "<th style='display: none'>RICE</th>";

                        }

                        ?>


                        <?php

                        if($result_array['sphh_wheat'][2] != 0.00){

                            echo "<th>WHEAT</th>";

                        }

                        else {

                            echo "<th style='display: none'>WHEAT</th>";

                        }

                        ?>


                        <?php

                        if($result_array['sphh_atta'][1] != 0.00){

                            echo "<th>ATTA</th>";

                        }

                        else {

                            echo "<th style='display: none'>ATTA</th>";

                        }

                        ?>


                        <?php

                        if($result_array['sphh_sugar'][2] != 0.00){

                            echo "<th>SUGAR</th>";

                        }

                        else {

                            echo "<th style='display: none'>SUGAR</th>";

                        }

                        ?>


                        <th>RKSY-I<br>HEAD</th>

                        <?php

                        if($result_array['rksy1_rice'][2] != 0.00){

                            echo "<th>RICE</th>";

                        }

                        else {

                            echo "<th style='display: none'>RICE</th>";

                        }

                        ?>


                        <?php

                        if($result_array['rksy1_wheat'][2] != 0.00){

                            echo "<th>WHEAT</th>";

                        }

                        else {

                            echo "<th style='display: none'>WHEAT</th>";

                        }

                        ?>


                        <?php

                        if($result_array['rksy1_atta'][1] != 0.00){

                            echo "<th>ATTA</th>";

                        }

                        else {

                            echo "<th style='display: none'>ATTA</th>";

                        }

                        ?>


                        <th>RKSY-II<br>HEAD</th>

                        <?php

                        if($result_array['rksy2_rice'][2] != 0.00){

                            echo "<th>RICE</th>";

                        }

                        else {

                            echo "<th style='display: none'>RICE</th>";

                        }

                        ?>


                        <?php

                        if($result_array['rksy2_wheat'][2] != 0.00){

                            echo "<th>WHEAT</th>";

                        }

                        else {

                            echo "<th style='display: none'>WHEAT</th>";

                        }

                        ?>


                        <?php

                        if($result_array['rksy2_atta'][1] != 0.00){

                            echo "<th>ATTA</th>";

                        }

                        else {

                            echo "<th style='display: none'>ATTA</th>";

                        }

                        ?>


                    </tr>

                    </thead>

                    <tbody style="text-align: right; background-color: aliceblue;" >

                    <?php

                        for ($i = 0; $i < count($result_array['mr_no']); $i++ ) {

                    ?>

                            <tr>

                                <td style="text-align: center;"><?php echo $result_array['mr_no'][$i] ?></td>
                                <td style="text-align: center;"><?php echo $result_array['delr_name'][$i] ?></td>
                                <td style="text-align: center;"><?php echo $result_array['delr_region'][$i] ?></td>

                                <td><?php echo $result_array['aay_family'][$i] ?></td>

                                <?php

                                if($result_array['aay_rice'][2] != 0.00) {

                                    echo "<td>".$result_array['aay_rice'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['aay_rice'][$i]."</td>";

                                }

                                ?>


                                <?php

                                if($result_array['aay_wheat'][2] != 0.00) {

                                    echo "<td>".$result_array['aay_wheat'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['aay_wheat'][$i]."</td>";

                                }

                                ?>

                                <?php

                                if($result_array['aay_atta'][2] != 0.00) {

                                    echo "<td>".$result_array['aay_atta'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['aay_atta'][$i]."</td>";

                                }

                                ?>

                                <td><?php echo $result_array['phh_head'][$i] ?></td>

                                <?php

                                if($result_array['phh_rice'][2] != 0.00) {

                                    echo "<td>".$result_array['phh_rice'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['phh_rice'][$i]."</td>";

                                }

                                ?>

                                <?php

                                if($result_array['phh_wheat'][2] != 0.00) {

                                    echo "<td>".$result_array['phh_wheat'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['phh_wheat'][$i]."</td>";

                                }

                                ?>


                                <?php

                                if($result_array['phh_atta'][2] != 0.00) {

                                    echo "<td>".$result_array['phh_atta'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['phh_atta'][$i]."</td>";

                                }

                                ?>

                                <td><?php echo $result_array['sphh_head'][$i] ?></td>

                                <?php

                                if($result_array['sphh_rice'][2] != 0.00) {

                                    echo "<td>".$result_array['sphh_rice'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['sphh_rice'][$i]."</td>";

                                }

                                ?>


                                <?php

                                if($result_array['sphh_wheat'][2] != 0.00) {

                                    echo "<td>".$result_array['sphh_wheat'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['sphh_wheat'][$i]."</td>";

                                }

                                ?>


                                <?php

                                if($result_array['sphh_atta'][2] != 0.00) {

                                    echo "<td>".$result_array['sphh_atta'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['sphh_atta'][$i]."</td>";

                                }

                                ?>


                                <?php

                                if($result_array['sphh_sugar'][2] != 0.00) {

                                    echo "<td>".$result_array['sphh_sugar'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['sphh_sugar'][$i]."</td>";

                                }

                                ?>


                                <td><?php echo $result_array['rksy1_head'][$i] ?></td>

                                <?php

                                if($result_array['rksy1_rice'][2] != 0.00) {

                                    echo "<td>".$result_array['sphh_sugar'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['rksy1_rice'][$i]."</td>";

                                }

                                ?>


                                <?php

                                if($result_array['rksy1_wheat'][2] != 0.00) {

                                    echo "<td>".$result_array['rksy1_wheat'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['rksy1_wheat'][$i]."</td>";

                                }

                                ?>


                                <?php

                                if($result_array['rksy1_atta'][2] != 0.00) {

                                    echo "<td>".$result_array['rksy1_atta'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['rksy1_atta'][$i]."</td>";

                                }

                                ?>

                                <td><?php echo $result_array['rksy2_head'][$i] ?></td><td><?php echo $result_array['rksy2_head'][$i] ?></td>

                                <?php

                                if($result_array['rksy2_rice'][2] != 0.00) {

                                    echo "<td>".$result_array['rksy2_rice'][$i]."</td>";

                                }

                                else {

                                    echo "<td style='display: none'>".$result_array['rksy2_rice'][$i]."</td>";

                                }

                                ?>

                                <td><?php echo $result_array['rksy2_rice'][$i] ?></td>
                                <td><?php echo $result_array['rksy2_wheat'][$i] ?></td>
                                <td><?php echo $result_array['rksy2_atta'][$i] ?></td>

                            </tr>


                    <?php

                        }

                    ?>

                    </tbody>

                </table>

            </div>

        </div>


        <div class="modal-footer">

            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

            <button class="btn btn-secondary" id="print" type="button">Print</button>

        </div>

    </body>

</html>







