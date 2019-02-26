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
    //require("../session.php");

    //$memono     =   $_SESSION['memono'];
    //$gen_date   =   $_SESSION['gen_date'];

    //var_dump($memono);

    if ($_SERVER['REQUEST_METHOD'] == "GET"){
        
        $memono         =   $_GET['memono'];
        $gen_date       =   $_GET['gen_date'];
        $del_cd         =   $_GET['del_cd'];
       // $del_name       =   $_GET['del_name'];
        //$del_reg        =   $_GET['del_reg'];

       //var_dump($del_cd);

        $sql= "SELECT   del_cd,
                        del_name, 
                        del_adr, 
                        del_reg, 
                        del_dist 
                    FROM m_dealers 
                    WHERE del_cd = '$del_cd' ";        
    //var_dump($sql);

        $result = mysqli_query($db_connect, $sql);

        if($result){

            if(mysqli_num_rows($result) > 0 ){

                while($row = mysqli_fetch_assoc($result)){
                    $del_name       =       $row['del_name'];
                    $del_adr        =       $row['del_adr'];
                    $del_reg        =       $row['del_reg'];
                
                    //echo $del_name;
                }
            }
        }
    }
    //echo $del_name;
    //var_dump( $memono, $del_name, $del_adr, $del_cd);
?>

<div id="divToPrint">

    <div>

        <h3 class="underline" style="margin-left: 40%">

            Original

        </h3>

        <p class="inline">

            No.- <?php echo $memono; ?>

        </p>

        <p class="center inline" style="margin-left: 25%">

            Challan / Cash Memo

        </p>

        <p class="inline" style="margin-left: 20%">

            Date : <?php echo $gen_date; ?>

        </p>

    </div>

    <div>

        <h1 class="center">

            LAXMI NARAYAN STORES

        </h1>

        <h3 class="center">

            M.R.DISTRIBUTOR

        </h3>

        <h3 class="center">

            <?php

                echo strtoupper("Belegram, Thana - Udaynarayanpur, District - Howrah");

            ?>

        </h3>

    </div>

    <br style="line-height: 15px;">

    <div>

        <p class="inline">

            Dealer's Name : <?php echo $del_name; ?>

        </p>

        <p class="inline" style="margin-left: 5%">

            M.R. No : <?php  echo $del_cd; ?>
        </p>

    </div>

    <br style="line-height: 15px;">

    <div>

        <p class="inline">

            Address : <?php echo $del_adr; ?>
        </p>

        <p class="inline" style="margin-left: 5%">

            Region : <?php echo $del_reg; ?>

        </p>

    </div>

    <br style="line-height: 15px;">

    <div>

            <?php
                echo "<table style= 'width: 100%;'>";
                    echo "<thead style = 'text-align: center'>";
                    echo "<tr align= center>
                            <th>Date</th>
                            <th>Memo No.</th>
                            <th>Name of<br>Commo.</th>
                            <th>Ammount of<br> Commo.</th>
                            <th>Rate per <br>Unit</th>
                            <th>Total Price</th>
                        </tr>";
                    echo "</thead>";
            ?>

        <?php
            
            $sql_count = "SELECT count(amount) FROM td_allotment_sheet_np WHERE memono = '$memono' 
                        AND del_cd = '$del_cd' AND gen_date = '$gen_date' ";

            $result = mysqli_query($db_connect, $sql_count);
            
            
            $sql = "SELECT gen_date,
                        del_cd,
                        prod_desc,
                        amount
                        
                    FROM td_allotment_sheet_np
                    WHERE memono = '$memono' AND del_cd = '$del_cd' AND gen_date = '$gen_date' ";

                //echo $sql; die;

            $allotment_result = mysqli_query($db_connect, $sql);

            $tot_price_array = [];

            while($row = mysqli_fetch_assoc($allotment_result)){

                    
                    
                    $prod_desc       =       $row['prod_desc'];

                    $sql_join= "SELECT t.gen_date, t.del_cd, t.amount, t.prod_desc, t.memono,
                        p.per_unit, p.prod_rate, (t.amount* p.prod_rate) price
                        FROM td_allotment_sheet_np t, m_rate_master_np p 
                        WHERE t.prod_desc = p.prod_desc AND t.memono = '$memono'
                        AND p.prod_desc= '$prod_desc '"; 
                
                    $union_result= mysqli_query($db_connect, $sql_join);
                    // var_dump($sql_join);

                    while($row = mysqli_fetch_array($union_result)){

                        $tot_price = $row['price'];

                        //$new_tot_price =   $tot_price;
                        echo "<tbody style = 'text-align: center'>";
                            echo "<tr>";
                            echo "<td>" . $row['gen_date'] . "</td>";
                            echo "<td>" . $row['memono'] . "</td>";
                            echo "<td>" . $row['prod_desc'] ."</td>";
                            echo "<td>" . $row['amount'] .' '. $row['per_unit'] . "</td>";
                            echo "<td>" . $row['prod_rate'] . "</td>";
                            echo "<td>" . $tot_price . "</td>";
                            echo "<tr>";
                        echo "</tbody>";
                    }
                    
                    array_push($tot_price_array, $tot_price);
                    //$new_tot_price = $new_tot_price + $tot_price;
                    
            } 
            
            //print_r($tot_price_array);
            $total_price = 0;

            for($i=0; $i< count($tot_price_array); $i++)
            {

                $total_price += $tot_price_array[$i];
            }

            //echo $total_price;

            echo "<tfooter style = 'text-align: center'>";

                echo "<tr>
                        <td colspan='5' style='text-align: center;'>
                            <strong>TOTAL:</strong>
                        </td>
                        <td style='text-align: center;'>
                                $total_price
                        </td>
                    </tr> ";

            echo "</tfooter>";

            echo "</table>";


        ?>

       
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

    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <button class="btn btn-secondary" type="button" onclick="printDiv();">Print</button>

</div>

<?php

    /* $sql= "SELECT t.gen_date, t.del_cd, t.amount, p.per_unit, p.prod_rate 
    FROM td_allotment_sheet_np t, m_rate_master_np p 
    WHERE t.prod_desc = p.prod_desc AND p.prod_desc = 'OIL' AND t.del_cd = 24 
    AND t.memono = 'eqwq879888'"; */

?>