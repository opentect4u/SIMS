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
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed; ' +
            '                                       ' +
            '                                   } } </style>');
        // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function(){ WindowObject.close();},10);

    }
</script>


<?php

    ini_set("display_errors","1");
    error_reporting("E_ALL");

    require("../db/db_connect.php");
    require("../session.php");

    $memo_no     =   $_SESSION['memo_no'];
    

    $sql = "SELECT gen_date FROM td_apy_allot_sheet 
            WHERE memo_no = '$memo_no' ";
    $result = mysqli_query($db_connect,$sql);

    //echo $sql; die;
    while($row = mysqli_fetch_array($result)){

        $gen_date= $row['gen_date'];

    }

    //echo $gen_date; die;

?>


<div id="divToPrint">

    <div>

        <h3 class="underline" style="margin-left: 25%">

            ALLOTMENT SHEET OF NON PDS ITEM

        </h3>

        <p class="inline" >

            No.- <?php echo $memo_no; ?>

        </p>

        <p class="inline" style="margin-left: 80%">

            Date : <?php echo $gen_date; ?>

        </p>

    </div>

    <div>

        <h4 class="center">

            M/S Laxmi Narayan Stores, M.R Distributor, Belgram, Udaynarayanpur, Howrah.
            You hereby Instructed to deliver M.R cereals to the following M.R Dealers of
            U.N.Pur as per allocation on cash payment at Govt. fixed rate against proper 
            cash memo. 

        </h4>
        <br><br>

    </div>

    <?php
        echo "<table id='customers'style= 'margin-left:30px'>
            <tr align= center>
            <th>MemoNo</th>
            <th>Date</th>
            <th>Mr No.</th>
            <th>Dealer Name</th>
            <th>Anchal</th>
            <th>APY Unit</th>
            <th>APY Rice</th>
            </tr>"; 
    ?>

    <?php

        $con="SELECT a.memo_no, a.gen_date, a.mr_no, a.apy_head, a.apy_rice,
                                d.del_name, d.del_reg 
                                
                    FROM td_apy_allot_sheet a, 
                        m_dealers d   

                    WHERE a.mr_no = d.del_cd 
                    AND a.memo_no = '$memo_no' ";

        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $result = mysqli_query($db_connect,$con);

                    //echo $con; 
                // die();

        while($row = mysqli_fetch_array($result))            
        {
                    // echo $row['del_cd']; die;
            echo "<tr>";
            echo "<td>" . $row['memo_no'] . "</td>";
            echo "<td>" . $row['gen_date'] . "</td>";
            echo "<td>" . $row['mr_no'] . "</td>";
            echo "<td>" . $row['del_name'] . "</td>";
            echo "<td>" . $row['del_reg'] . "</td>";
            echo "<td>" . $row['apy_head'] . "</td>";
            echo "<td>" . $row['apy_rice'] . "</td>";
            echo "</tr>";
        }
            echo "</table>";

    ?>

</div>

<div class="modal-footer">

    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <button class="btn btn-secondary" type="button" onclick="printDiv();">Print</button>

</div>

