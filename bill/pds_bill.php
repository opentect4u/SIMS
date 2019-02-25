<?php

    require("../db/db_connect.php");

    $mr_no      =   $_GET['mr_no'];
    $date       =   $_GET['date'];
    $memo_no    =   $_GET['memo_no'];


    $sql = "SELECT md.del_cd del_cd,
                   md.del_name del_name,
                   md.del_adr del_adr,
                   md.del_reg del_reg,
                   md.del_dist del_dist,
                   
                   ta.aay_rice aay_rice,
                   ta.ar_unit ar_unit,
                   ta.ar_tot ar_tot,
                   
                   ta.aay_wheat aay_wheat,
                   ta.aw_unit aw_unit,
                   ta.aw_tot aw_tot,
                   
                   ta.aay_atta aay_atta,
                   ta.aa_unit aa_unit,
                   ta.aa_tot aa_tot,
                   
                   ta.aay_sugar aay_sugar,
                   ta.as_unit as_unit,
                   ta.as_tot as_tot,
                   
                   ta.phh_rice phh_rice,
                   ta.pr_unit pr_unit,
                   ta.pr_tot pr_tot,
                   
                   ta.phh_wheat phh_wheat,
                   ta.pw_unit pw_unit,
                   ta.pw_tot pw_tot, 
                   
                   ta.phh_atta phh_atta,
                   ta.pa_unit pa_unit,
                   ta.pa_tot pa_tot,
                   
                   ta.sphh_rice sphh_rice,
                   ta.sr_unit sr_unit,
                   ta.sr_tot sr_tot,
                   
                   ta.sphh_wheat sphh_wheat,
                   ta.sw_unit sw_unit,
                   ta.sw_tot sw_tot,
                   
                   ta.sphh_atta sphh_atta,
                   ta.sa_unit sa_unit,
                   ta.sa_tot sa_tot,
                   
                   ta.sphh_sugar sphh_sugar,
                   ta.ss_unit ss_unit,
                   ta.ss_tot ss_tot,
                   
                   ta.rksy1_rice rksy1_rice,
                   ta.rr1_unit rr1_unit,
                   ta.rr1_tot rr1_tot,
                   
                   ta.rksy1_wheat rksy1_wheat,
                   ta.rw1_unit rw1_unit,
                   ta.rw1_tot rw1_tot,
                   
                   ta.rksy1_atta rksy1_atta,
                   ta.ra1_unit ra1_unit,
                   ta.ra1_tot ra1_tot,
                   
                   ta.rksy2_rice rksy2_rice,
                   ta.rr2_unit rr2_unit,
                   ta.rr2_tot rr2_tot,
                   
                   ta.rksy2_wheat rksy2_wheat,
                   ta.rw2_unit rw2_unit,
                   ta.rw2_tot rw2_tot,
                   
                   ta.rksy2_atta rksy2_atta,
                   ta.ra2_unit ra2_unit,
                   ta.ra2_tot ra2_tot,

                   tp.apy_rice
                   
                   FROM m_dealers md,
                        td_allotment_sheet ta LEFT JOIN td_apy_allot_sheet tp 

                        ON ta.mr_no = tp.mr_no AND ta.memo_no = tp.memo_no
                        
                   WHERE  md.del_cd = $mr_no
                   AND    md.del_cd = ta.mr_no
                   AND    ta.memo_no  = '$memo_no'";

    $result = mysqli_query($db_connect, $sql);

    $data = mysqli_fetch_assoc($result);
    $param_no = 1;

    function f_get_param_val($param_no, $db_connect) {

        $sql = "SELECT param_value FROM m_params WHERE paran_no = $param_no";

        $result = mysqli_query($db_connect, $sql);

        $data   =   mysqli_fetch_assoc($result);

        return $data['param_value'];

    }

    $total_price = $data['ar_tot']
                 + $data['aa_tot']
                 + $data['as_tot']
                 + $data['pr_tot']
                 + $data['pa_tot']
                 + $data['sr_tot']
                 + $data['sa_tot']
                 + $data['ss_tot']
                 + $data['rr1_tot']
                 + $data['rw1_tot']
                 + $data['rr2_tot']
                 + $data['rw2_tot'];


?>


<style>

    .center { text-align: center;}
    .inline { display: inline; }
    .underline { text-decoration: underline; }

    table, th, td { border: 1px solid black; border-collapse: collapse; }
    th, td { padding: 5px; }

    u {border-bottom: 1px dotted #000;text-decoration: none;}

    h1 {

        font-size: 25px;

    }

</style>

<script>
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
            '                                          table, th, td { border: 1px solid black; border-collapse: collapse; }' +
            '                                           th, td { padding: 5px; }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed }' +
            '                                          u {border-bottom: 1px dotted #000;text-decoration: none;} ' +
            ' } </style>');
        // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function(){ WindowObject.close();},10);

    }

</script>


    <div id="divToPrint">

        <div>

            <h3 class="underline" style="margin-left: 40%">

                Original

            </h3>

            <p class="inline">

                Serial No.-

            </p>

            <p class="center inline" style="margin-left: 25%">

                Challan / Cash Memo

            </p>

            <p class="inline" style="margin-left: 28%">

                Date <u><?php echo date('d-m-Y', strtotime($date));?></u>

            </p>

        </div>

        <div>

            <h1 class="center">

                Distributor Name - <?php echo f_get_param_val(1, $db_connect);?>

            </h1>

            <h3 class="center">

                <?php echo f_get_param_val(3, $db_connect);?>

            </h3>

        </div>

        <div>

            <p class="inline">

                Distributor No.- <?php echo f_get_param_val(2, $db_connect);?>

            </p>

            <p class="inline" style="margin-left: 62%">

                Car No.- ..................

            </p>

        </div>

        <br style="line-height: 15px;">

        <div>

            <p class="inline">

                S.C.F & S Order No. <u><?php echo f_get_param_val(6, $db_connect);?></u>

            </p>

            <p class="inline" style="margin-left: 58%">

                Date <u><?php echo date('d-m-Y', strtotime($date));?></u>

            </p>

        </div>

        <br style="line-height: 15px;">

        <div>

            <p class="inline">

                Dealer's Name <u><?php echo $data['del_name'];?></u>

            </p>

        </div>

        <br style="line-height: 15px;">

        <div>

            <p class="inline">

                Address <u><?php echo $data['del_adr'];?></u>

            </p>

            <p class="inline" style="margin-left: 48%">

                Region <u><?php echo $data['del_reg'];?></u>

            </p>

        </div>

        <br style="line-height: 15px;">

        <div>

            <p class="inline">

                District <u><?php echo f_get_param_val(4, $db_connect);?></u>

            </p>

            <p class="inline" style="margin-left: 64%">

                Dealer No. / Code <u><?php echo $data['del_cd'];?></u>

            </p>

        </div>

        <br style="line-height: 15px;">

        <div>

            <table style="width: 100%;">

                <thead style="text-align: center;" >

                <tr>

                    <th width="5%">Category</th>

                    <th>Substance</th>

                    <th>Quantity</th>

                    <th>Worth</th>

                    <th>Price</th>

                </tr>

                </thead>

                <tbody style="text-align: right;" >

                <tr>

                    <td rowspan="3" style="text-align: center;">AAY</td>

                    <td style="text-align: center;">Rice</td>

                    <td><?php echo ($data['aay_rice'] == '0.00')?'': $data['aay_rice']; ?></td>

                    <td><?php echo ($data['ar_unit'] == '0.00')?'': $data['ar_unit']; ?></td>

                    <td><?php echo ($data['ar_tot'] == '0.00')?'': $data['ar_tot']; ?></td>

                </tr>

                <tr>

                    <td style="text-align: center;">Atta</td>

                    <td><?php echo ($data['aay_atta'] == '0.00')?'': $data['aay_atta']; ?></td>

                    <td><?php echo ($data['aa_unit'] == '0.00')?'': $data['aa_unit']; ?></td>

                    <td><?php echo ($data['aa_tot'] == '0.00')?'': $data['aa_tot']; ?></td>

                </tr>

                <tr>

                    <td style="text-align: center;">Sugar</td>

                    <td><?php echo ($data['aay_sugar'] == '0.00')?'': $data['aay_sugar']; ?></td>

                    <td><?php echo ($data['as_unit'] == '0.00')?'': $data['as_unit']; ?></td>

                    <td><?php echo ($data['as_tot'] == '0.00')?'': $data['as_tot']; ?></td>

                </tr>

                <tr>

                    <td rowspan="2" style="text-align: center;">PHH</td>

                    <td style="text-align: center;">Rice</td>

                    <td><?php echo ($data['phh_rice'] == '0.00')?'': $data['phh_rice']; ?></td>

                    <td><?php echo ($data['pr_unit'] == '0.00')?'': $data['pr_unit']; ?></td>

                    <td><?php echo ($data['pr_tot'] == '0.00')?'': $data['pr_tot']; ?></td>

                </tr>

                <tr>

                    <td style="text-align: center;">Atta</td>

                    <td><?php echo ($data['phh_atta'] == '0.00')?'': $data['phh_atta']; ?></td>

                    <td><?php echo ($data['pa_unit'] == '0.00')?'': $data['pa_unit']; ?></td>

                    <td><?php echo ($data['pa_tot'] == '0.00')?'': $data['pa_tot']; ?></td>

                </tr>

                <tr>

                    <td rowspan="3" style="text-align: center;">SPHH</td>

                    <td style="text-align: center;">Rice</td>

                    <td><?php echo ($data['sphh_rice'] == '0.00')?'': $data['sphh_rice']; ?></td>

                    <td><?php echo ($data['sr_unit'] == '0.00')?'': $data['sr_unit']; ?></td>

                    <td><?php echo ($data['sr_tot'] == '0.00')?'': $data['sr_tot']; ?></td>

                </tr>

                <tr>

                    <td style="text-align: center;">Atta</td>

                    <td><?php echo ($data['sphh_atta'] == '0.00')?'': $data['sphh_atta']; ?></td>

                    <td><?php echo ($data['sa_unit'] == '0.00')?'': $data['sa_unit']; ?></td>

                    <td><?php echo ($data['sa_tot'] == '0.00')?'': $data['sa_tot']; ?></td>

                </tr>

                <tr>

                    <td style="text-align: center;">Sugar</td>

                    <td><?php echo ($data['sphh_sugar'] == '0.00')?'': $data['sphh_sugar']; ?></td>

                    <td><?php echo ($data['ss_unit'] == '0.00')?'': $data['ss_unit']; ?></td>

                    <td><?php echo ($data['ss_tot'] == '0.00')?'': $data['ss_tot']; ?></td>

                </tr>



                <tr>

                    <td rowspan="2" style="text-align: center;">RKSY-I</td>

                    <td style="text-align: center;">Rice</td>

                    <td><?php echo ($data['rksy1_rice'] == '0.00')?'': $data['rksy1_rice']; ?></td>

                    <td><?php echo ($data['rr1_unit'] == '0.00')?'': $data['rr1_unit']; ?></td>

                    <td><?php echo ($data['rr1_tot'] == '0.00')?'': $data['rr1_tot']; ?></td>

                </tr>

                <tr>

                    <td style="text-align: center;">Wheat</td>

                    <td><?php echo ($data['rksy1_wheat'] == '0.00')?'': $data['rksy1_wheat']; ?></td>

                    <td><?php echo ($data['rw1_unit'] == '0.00')?'': $data['rw1_unit']; ?></td>

                    <td><?php echo ($data['rw1_tot'] == '0.00')?'': $data['rw1_tot']; ?></td>

                </tr>

                <tr>

                    <td rowspan="2" style="text-align: center;">RKSY-II</td>

                    <td style="text-align: center;">Rice</td>

                    <td><?php echo ($data['rksy2_rice'] == '0.00')?'': $data['rksy2_rice']; ?></td>

                    <td><?php echo ($data['rr2_unit'] == '0.00')?'': $data['rr2_unit']; ?></td>

                    <td><?php echo ($data['rr2_tot'] == '0.00')?'': $data['rr2_tot']; ?></td>

                </tr>

                <tr>

                    <td style="text-align: center;">Wheat</td>

                    <td><?php echo ($data['rksy2_wheat'] == '0.00')?'': $data['rksy2_wheat']; ?></td>

                    <td><?php echo ($data['rw2_unit'] == '0.00')?'': $data['rw2_unit']; ?></td>

                    <td><?php echo ($data['rw2_tot'] == '0.00')?'': $data['rw2_tot']; ?></td>

                </tr>

                <tr>

                    <td style="text-align: center;">APY</td>

                    <td style="text-align: center;">Rice</td>

                    <td><?php echo ($data['apy_rice'] == '0.00')?'': $data['rksy2_rice']; ?></td>

                    <td></td>

                    <td></td>

                </tr>

                <tr>

                    <td colspan="4" style="text-align: center;">Total</td>

                    <td><?php echo $total_price; ?></td>

                </tr>

                </tbody>

            </table>

        </div>

        <br style="line-height: 50px;">

        <div class="bottom">

            <div style="margin-left: 5%">

                <p class="center inline">-------------------------------</p>

                <p class="center inline" style="margin-left: 43%">-------------------------------</p>

            </div>

            <div style="margin-left: 8%">

                <p class="center inline">Dealer's Signature</p>

                <p class="center inline" style="margin-left: 50%">Distributor's Signature</p>

            </div>


        </div>

    </div>

    <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="button" class="btn btn-default" onclick="printDiv();">Print</button>

    </div>




