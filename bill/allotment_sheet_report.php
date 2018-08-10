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

    if (mysqli_num_rows($result) > 0) {

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


        $result_data['prod_catg'] = $result_data['prod_desc'] = $result_data['unit_val'] = [];

        $result = mysqli_query($db_connect, $sql);

        $data = mysqli_fetch_assoc($result);

        $effective_dt = $result_array['gen_date'][0];

        unset($sql);
        unset($data);
        unset($result);

        $sql = "SELECT MAX(effective_dt) effective_dt FROM m_allot_scale 
                                                          WHERE effective_dt <= '$effective_dt'";

        $data = mysqli_query($db_connect, $sql);

        $result = mysqli_fetch_assoc($data);

        $effective_dt = $result['effective_dt'];

        unset($sql);
        unset($data);
        unset($result);

        $sql = "SELECT prod_catg,
                           prod_desc,
                           unit_val FROM m_allot_scale WHERE effective_dt = '$effective_dt'
                                                       ORDER BY prod_catg, prod_desc";


        $data = mysqli_query($db_connect, $sql);

        while ($result = mysqli_fetch_assoc($data)) {

            array_push($result_data['prod_catg'], $result['prod_catg']);

            array_push($result_data['prod_desc'], $result['prod_desc']);

            array_push($result_data['unit_val'], $result['unit_val']);

        }

        $aay_total =
        $ar_total =
        $aw_total =
        $aa_total =
        $as_total =

        $phh_total =
        $pr_total =
        $pw_total =
        $pa_total =

        $sphh_total =
        $sr_total =
        $sw_total =
        $sa_total =
        $ss_total =

        $rk1_total =
        $rr1_total =
        $rw1_total =
        $ra1_total =

        $rk2_total =
        $rr2_total =
        $rw2_total =
        $ra2_total = 0.00;

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
            <link rel="stylesheet"
                  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

        <div id="divToPrint">

            <div class="container-contact2" style="margin: 0; width: 100%">

                <div>

                    <p class="center underline" style="text-align: center; font-size: 18px;">

                        ALLOTMENT SHEET OF NFSA (AAY & PHH + SPHH) & RKSY-I & RKSY-II 2nd F.N. FOR JUNE - 2018

                    </p>

                </div>

                <div class="inline">

                    <p class="inline" style="display: inline;">

                        Memo No.- <?php echo $memoNo; ?>

                    </p>

                    <p class="inline" style="margin-left: 70%; display: inline;">

                        Date:- <?php echo date("d.m.Y", strtotime($result_array['gen_date'][0])); ?>

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

                <div>

                    <table class="table table-bordered table-hover" style="width: 100%; background-color: aliceblue;">

                        <tr>

                            <td rowspan="2"><b>SCALE</b></td>

                            <?php

                            if ($result_data['unit_val'][1] != 0.00) {

                                echo "<td>AAY RICE</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][3] != 0.00) {

                                echo "<td>AAY WHEAT</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][0] != 0.00) {

                                echo "<td>AAY ATTA</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][2] != 0.00) {

                                echo "<td>AAY SUGAR</td>";

                            }

                            ?>

                            <!-- PHH -->

                            <?php

                            if ($result_data['unit_val'][5] != 0.00) {

                                echo "<td>PHH RICE</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][6] != 0.00) {

                                echo "<td>PHH WHEAT</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][4] != 0.00) {

                                echo "<td>PHH ATTA</td>";

                            }

                            ?>

                            <!-- SPHH -->

                            <?php

                            if ($result_data['unit_val'][14] != 0.00) {

                                echo "<td>SPHH RICE</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][16] != 0.00) {

                                echo "<td>SPHH WHEAT</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][13] != 0.00) {

                                echo "<td>SPHH ATTA</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][15] != 0.00) {

                                echo "<td>SPHH SUGAR</td>";

                            }

                            ?>


                            <!-- RKSY-I -->

                            <?php

                            if ($result_data['unit_val'][8] != 0.00) {

                                echo "<td>RKSY-I RICE</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][9] != 0.00) {

                                echo "<td>RKSY-I WHEAT</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][7] != 0.00) {

                                echo "<td>RKSY-I ATTA</td>";

                            }

                            ?>

                            <!-- RKSY-II -->

                            <?php

                            if ($result_data['unit_val'][11] != 0.00) {

                                echo "<td>RKSY-II RICE</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][12] != 0.00) {

                                echo "<td>RKSY-II WHEAT</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][10] != 0.00) {

                                echo "<td>RKSY-II ATTA</td>";

                            }

                            ?>

                        </tr>

                        <tr>

                            <?php

                            if ($result_data['unit_val'][1] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][1] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][3] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][3] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][0] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][0] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][2] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][2] . "</td>";

                            }

                            ?>

                            <!-- PHH -->

                            <?php

                            if ($result_data['unit_val'][5] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][5] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][6] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][6] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][4] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][4] . "</td>";

                            }

                            ?>

                            <!-- SPHH -->

                            <?php

                            if ($result_data['unit_val'][14] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][14] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][16] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][16] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][13] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][1] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][15] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][15] . "</td>";

                            }

                            ?>


                            <!-- RKSY-I -->

                            <?php

                            if ($result_data['unit_val'][8] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][8] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][9] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][9] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][7] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][7] . "</td>";

                            }

                            ?>

                            <!-- RKSY-II -->

                            <?php

                            if ($result_data['unit_val'][11] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][11] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][12] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][12] . "</td>";

                            }

                            ?>

                            <?php

                            if ($result_data['unit_val'][10] != 0.00) {

                                echo "<td>" . $result_data['unit_val'][10] . "</td>";

                            }

                            ?>

                        </tr>

                    </table>

                </div>

            </div>

            <br style="line-height: 15px;">


            <!-- Allotment Sheet............................................. -->

            <div>

                <div class="container-contact2" style="margin: 0; width: 100%">

                    <table id="intro" class="table table-bordered table-hover" style="width: 100%;">

                        <thead style="background-color: #212529; color: #fff; text-align: center;">

                        <tr>

                            <th>MR<br>NO</th>

                            <th>NAME OF<br>DEALER</th>

                            <th>ANCHAL</th>


                            <th>AAY<br>FAMILY</th>

                            <?php

                            if ($result_array['aay_rice'][2] != 0.00) {

                                echo "<th>RICE</th>";

                            } else {

                                echo "<th style='display: none'>RICE</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['aay_wheat'][2] != 0.00) {

                                echo "<th>WHEAT</th>";

                            } else {

                                echo "<th style='display: none'>WHEAT</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['aay_atta'][1] != 0.00) {

                                echo "<th>ATTA</th>";

                            } else {

                                echo "<th style='display: none'>ATTA</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['aay_sugar'][2] != 0.00) {

                                echo "<th>SUGAR</th>";

                            } else {

                                echo "<th style='display: none'>SUGAR</th>";

                            }

                            ?>

                            <th>PHH<br>HEAD</th>

                            <?php

                            if ($result_array['phh_rice'][2] != 0.00) {

                                echo "<th>RICE</th>";

                            } else {

                                echo "<th style='display: none'>RICE</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['phh_wheat'][2] != 0.00) {

                                echo "<th>WHEAT</th>";

                            } else {

                                echo "<th style='display: none'>WHEAT</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['phh_atta'][1] != 0.00) {

                                echo "<th>ATTA</th>";

                            } else {

                                echo "<th style='display: none'>ATTA</th>";

                            }

                            ?>


                            <th>SPHH<br>HEAD</th>

                            <?php

                            if ($result_array['sphh_rice'][2] != 0.00) {

                                echo "<th>RICE</th>";

                            } else {

                                echo "<th style='display: none'>RICE</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['sphh_wheat'][2] != 0.00) {

                                echo "<th>WHEAT</th>";

                            } else {

                                echo "<th style='display: none'>WHEAT</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['sphh_atta'][1] != 0.00) {

                                echo "<th>ATTA</th>";

                            } else {

                                echo "<th style='display: none'>ATTA</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['sphh_sugar'][2] != 0.00) {

                                echo "<th>SUGAR</th>";

                            } else {

                                echo "<th style='display: none'>SUGAR</th>";

                            }

                            ?>


                            <th>RKSY-I<br>HEAD</th>

                            <?php

                            if ($result_array['rksy1_rice'][2] != 0.00) {

                                echo "<th>RICE</th>";

                            } else {

                                echo "<th style='display: none'>RICE</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['rksy1_wheat'][2] != 0.00) {

                                echo "<th>WHEAT</th>";

                            } else {

                                echo "<th style='display: none'>WHEAT</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['rksy1_atta'][1] != 0.00) {

                                echo "<th>ATTA</th>";

                            } else {

                                echo "<th style='display: none'>ATTA</th>";

                            }

                            ?>


                            <th>RKSY-II<br>HEAD</th>

                            <?php

                            if ($result_array['rksy2_rice'][2] != 0.00) {

                                echo "<th>RICE</th>";

                            } else {

                                echo "<th style='display: none'>RICE</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['rksy2_wheat'][2] != 0.00) {

                                echo "<th>WHEAT</th>";

                            } else {

                                echo "<th style='display: none'>WHEAT</th>";

                            }

                            ?>


                            <?php

                            if ($result_array['rksy2_atta'][1] != 0.00) {

                                echo "<th>ATTA</th>";

                            } else {

                                echo "<th style='display: none'>ATTA</th>";

                            }

                            ?>


                        </tr>

                        </thead>

                        <tbody style="text-align: right; background-color: aliceblue;">

                        <?php

                        for ($i = 0; $i < count($result_array['mr_no']); $i++) {

                            $aay_total += $result_array['aay_family'][$i];
                            $phh_total += $result_array['phh_head'][$i];
                            $sphh_total += $result_array['sphh_head'][$i];
                            $rk1_total += $result_array['rksy1_head'][$i];
                            $rk2_total += $result_array['rksy2_head'][$i];

                            ?>

                            <tr>

                                <td style="text-align: center;"><?php echo $result_array['mr_no'][$i] ?></td>
                                <td style="text-align: center;"><?php echo $result_array['delr_name'][$i] ?></td>
                                <td style="text-align: center;"><?php echo $result_array['delr_region'][$i] ?></td>

                                <td><?php echo $result_array['aay_family'][$i] ?></td>

                                <?php

                                if ($result_array['aay_rice'][2] != 0.00) {

                                    echo "<td>" . $result_array['aay_rice'][$i] . "</td>";

                                    $ar_total += $result_array['aay_rice'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['aay_rice'][$i] . "</td>";

                                }

                                ?>


                                <?php

                                if ($result_array['aay_wheat'][2] != 0.00) {

                                    echo "<td>" . $result_array['aay_wheat'][$i] . "</td>";

                                    $aw_total += $result_array['aay_wheat'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['aay_wheat'][$i] . "</td>";

                                }

                                ?>

                                <?php

                                if ($result_array['aay_atta'][2] != 0.00) {

                                    echo "<td>" . $result_array['aay_atta'][$i] . "</td>";

                                    $aa_total += $result_array['aay_atta'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['aay_atta'][$i] . "</td>";

                                }

                                ?>

                                <?php

                                if ($result_array['aay_sugar'][2] != 0.00) {

                                    echo "<td>" . $result_array['aay_sugar'][$i] . "</td>";

                                    $as_total += $result_array['aay_sugar'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['aay_atta'][$i] . "</td>";

                                }

                                ?>

                                <td><?php echo $result_array['phh_head'][$i] ?></td>

                                <?php

                                if ($result_array['phh_rice'][2] != 0.00) {

                                    echo "<td>" . $result_array['phh_rice'][$i] . "</td>";

                                    $pr_total += $result_array['phh_rice'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['phh_rice'][$i] . "</td>";

                                }

                                ?>

                                <?php

                                if ($result_array['phh_wheat'][2] != 0.00) {

                                    echo "<td>" . $result_array['phh_wheat'][$i] . "</td>";

                                    $pw_total += $result_array['phh_wheat'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['phh_wheat'][$i] . "</td>";

                                }

                                ?>


                                <?php

                                if ($result_array['phh_atta'][2] != 0.00) {

                                    echo "<td>" . $result_array['phh_atta'][$i] . "</td>";

                                    $pa_total += $result_array['phh_atta'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['phh_atta'][$i] . "</td>";

                                }

                                ?>

                                <td><?php echo $result_array['sphh_head'][$i] ?></td>

                                <?php

                                if ($result_array['sphh_rice'][2] != 0.00) {

                                    echo "<td>" . $result_array['sphh_rice'][$i] . "</td>";

                                    $sr_total += $result_array['sphh_rice'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['sphh_rice'][$i] . "</td>";

                                }

                                ?>


                                <?php

                                if ($result_array['sphh_wheat'][2] != 0.00) {

                                    echo "<td>" . $result_array['sphh_wheat'][$i] . "</td>";

                                    $sw_total += $result_array['sphh_wheat'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['sphh_wheat'][$i] . "</td>";

                                }

                                ?>


                                <?php

                                if ($result_array['sphh_atta'][2] != 0.00) {

                                    echo "<td>" . $result_array['sphh_atta'][$i] . "</td>";

                                    $sa_total += $result_array['sphh_atta'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['sphh_atta'][$i] . "</td>";

                                }

                                ?>


                                <?php

                                if ($result_array['sphh_sugar'][2] != 0.00) {

                                    echo "<td>" . $result_array['sphh_sugar'][$i] . "</td>";

                                    $ss_total += $result_array['sphh_sugar'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['sphh_sugar'][$i] . "</td>";

                                }

                                ?>


                                <td><?php echo $result_array['rksy1_head'][$i] ?></td>

                                <?php

                                if ($result_array['rksy1_rice'][2] != 0.00) {

                                    echo "<td>" . $result_array['rksy1_rice'][$i] . "</td>";

                                    $rr1_total += $result_array['rksy1_rice'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['rksy1_rice'][$i] . "</td>";

                                }

                                ?>


                                <?php

                                if ($result_array['rksy1_wheat'][2] != 0.00) {

                                    echo "<td>" . $result_array['rksy1_wheat'][$i] . "</td>";

                                    $rw1_total += $result_array['rksy1_wheat'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['rksy1_wheat'][$i] . "</td>";

                                }

                                ?>


                                <?php

                                if ($result_array['rksy1_atta'][2] != 0.00) {

                                    echo "<td>" . $result_array['rksy1_atta'][$i] . "</td>";

                                    $ra1_total += $result_array['rksy1_atta'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['rksy1_atta'][$i] . "</td>";

                                }

                                ?>

                                <td><?php echo $result_array['rksy2_head'][$i] ?></td>

                                <?php

                                if ($result_array['rksy2_rice'][2] != 0.00) {

                                    echo "<td>" . $result_array['rksy2_rice'][$i] . "</td>";

                                    $rr2_total += $result_array['rksy2_rice'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['rksy2_rice'][$i] . "</td>";

                                }

                                ?>


                                <?php

                                if ($result_array['rksy2_wheat'][2] != 0.00) {

                                    echo "<td>" . $result_array['rksy2_wheat'][$i] . "</td>";

                                    $rw2_total += $result_array['rksy2_wheat'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['rksy2_wheat'][$i] . "</td>";

                                }

                                ?>


                                <?php

                                if ($result_array['rksy2_atta'][2] != 0.00) {

                                    echo "<td>" . $result_array['rksy2_atta'][$i] . "</td>";

                                    $ra2_total += $result_array['rksy2_atta'][$i];

                                } else {

                                    echo "<td style='display: none'>" . $result_array['rksy2_atta'][$i] . "</td>";

                                }

                                ?>


                            </tr>

                            <?php

                        }

                        ?>

                        <tr>

                            <td colspan="3">Total:</td>

                            <?php

                            echo "<td>" . $aay_total . "</td>";

                            if ($ar_total != 0.00) {

                                echo "<td>" . $ar_total . "</td>";

                            }

                            ?>


                            <?php

                            if ($aw_total != 0.00) {

                                echo "<td>" . $aw_total . "</td>";

                            }

                            ?>


                            <?php

                            if ($aa_total != 0.00) {

                                echo "<td>" . $aa_total . "</td>";

                            }

                            ?>


                            <?php

                            if ($as_total != 0.00) {

                                echo "<td>" . $as_total . "</td>";

                            }

                            ?>


                            <?php

                            echo "<td>" . $phh_total . "</td>";

                            if ($pr_total != 0.00) {

                                echo "<td>" . $pr_total . "</td>";

                            }

                            ?>


                            <?php

                            if ($pw_total != 0.00) {

                                echo "<td>" . $pw_total . "</td>";

                            }

                            ?>


                            <?php

                            if ($pa_total != 0.00) {

                                echo "<td>" . $pa_total . "</td>";

                            }

                            ?>


                            <?php

                            echo "<td>" . $sphh_total . "</td>";

                            if ($sr_total != 0.00) {

                                echo "<td>" . $sr_total . "</td>";

                            }

                            ?>

                            <?php

                            if ($sw_total != 0.00) {

                                echo "<td>" . $sw_total . "</td>";

                            }

                            ?>

                            <?php

                            if ($sa_total != 0.00) {

                                echo "<td>" . $sa_total . "</td>";

                            }

                            ?>

                            <?php

                            if ($ss_total != 0.00) {

                                echo "<td>" . $ss_total . "</td>";

                            }

                            ?>


                            <?php

                            echo "<td>" . $rk1_total . "</td>";

                            if ($rr1_total != 0.00) {

                                echo "<td>" . $rr1_total . "</td>";

                            }

                            ?>

                            <?php

                            if ($rw1_total != 0.00) {

                                echo "<td>" . $rw1_total . "</td>";

                            }

                            ?>

                            <?php

                            if ($ra1_total != 0.00) {

                                echo "<td>" . $ra1_total . "</td>";

                            }

                            ?>

                            <?php

                            echo "<td>" . $rk1_total . "</td>";

                            if ($rr2_total != 0.00) {

                                echo "<td>" . $rr2_total . "</td>";

                            }

                            ?>

                            <?php

                            if ($rw2_total != 0.00) {

                                echo "<td>" . $rw2_total . "</td>";

                            }

                            ?>

                            <?php

                            if ($ra2_total != 0.00) {

                                echo "<td>" . $ra2_total . "</td>";

                            }

                            ?>

                        </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <div class="modal-footer">

            <a class="btn btn-default" href="../report/allot_sheet_report.php"
               style="color: #fff; background-color: #868e96;  border-color: #868e96;">

                Back</a>

            <button class="btn btn-primary" id="print" type="button">Print</button>

        </div>

        </body>

        </html>

        <?php
    }

    else {

        echo "Sorry No Data Found for given Memo No";

    }

        ?>









