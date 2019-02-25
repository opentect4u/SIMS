<?php

    /*ini_set("display_errors","1");
    error_reporting("E_ALL");

    require("../db/db_connect.php");
    require("../session.php");

    $memono  =   $_SESSION['memono'];
    //echo $memono; die;

        // Fetching Allotment Sheet details as per memo no

        $sql= "SELECT prod_desc, del_cd, amount FROM td_allotment_sheet_np 
                WHERE memoNo = '$memono' ORDER BY prod_desc ";

        $product_result = mysqli_query($db_connect, $sql);

        //echo $sql; die;

                // Table Head Printing Start

        $sql= "SELECT * FROM m_products WHERE prod_type = 'NON PDS' ";
        $table_result = mysqli_query($db_connect, $sql);

        echo "<table style= 'margin-left:36px'>
                            <tr align= center>
                                <th>Dealer<br>Code</th>
                                <th>Dealer<br>Name</th>
                                <th>Region</th>";

        while($row = mysqli_fetch_assoc($table_result)){

                        echo "<th>" .$row['prod_desc']. "</th>";             
        }
        echo  "</tr> ";
        
        //die;
                        
        if(mysqli_num_rows($product_result) > 0 ){

            while($row = mysqli_fetch_assoc($product_result)){

                $prod_desc       =       $row['prod_desc'];
                $del_cd          =       $row['del_cd'];
                $amount          =       $row['amount'];

                    // Table Head Printing END ---- Here the Product Names in Head are dynamic

            }   
                //echo  "</tr> ";
                //die();

                        // Featching Dealer's Details from Dealer Master as per "del_cd"
                        
                $sql = "SELECT del_name, del_reg FROM m_dealers
                        WHERE del_cd = '$del_cd' ";

                $dealer_result = mysqli_query($db_connect, $sql);

                while($row = mysqli_fetch_assoc($dealer_result)){

                    $del_name          =       $row['del_name'];
                    $del_reg           =       $row['del_reg'];
                        // Table Body Printing

                    echo "<tr>";
                        echo "<td>". $del_cd ."</td>";
                        echo "<td>" . $row['del_name'] . "</td>";
                        echo "<td>" . $row['del_reg'] ."</td>";
                        echo "<td>". $amount ."</td>";
                    echo "</tr>";
                       
                }

            echo "</table>";           
        }*/

?>

<?php
    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require("../db/db_connect.php");
    require("../session.php");

    $memono  =   $_SESSION['memono'];
?>

<html>

        <head>
            <title>Synergic Inventory Management System-Add Stock</title>

            <meta name="viewport" content="width=device-width,initial-scale=1.0">

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


            <link rel="stylesheet" type="text/css" href="../css/form_design.css">
            <link rel="stylesheet" type="text/css" href="../css/dashboard.css">

            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    </head>

    <body class="body">

        <?php require '../post/nav.php'; ?>

        <h1 class='elegantshadow'>Laxmi Narayan Stores</h1>

        <hr class='hr'>

        <div class="container" style="margin-left: 10px">

            <div class="row">

                <style>
                        #customers {
                            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                            border-collapse: collapse;
                            width: 100%;
                        }

                        #customers td, #customers th {
                            border: 1px solid #ddd;
                            padding: 8px;
                        }

                        #customers tr:nth-child{background-color: #f2f2f2;}

                        #customers tr:hover {background-color: #ddd;}

                        #customers th {

                            padding-top: 12px;
                            padding-bottom: 12px;
                            text-align: left;
                            background-color: #021103;
                            color: white;
                        }

                </style>

                <div class="w3-row-padding">
                    <?php
                        echo "<table id='customers'style= 'margin-left:36px'>
                        <tr align= center>
                        <th>MemoNo</th>
                        <th>Date</th>
                        <th>Dealer Code</th>
                        <th>Dealer Name</th>
                        <th>Dealer Region</th>
                        <th>Product Name</th>
                        <th>Amount</th>
                        </tr>";
                    ?>
                </div>

                <?php

                    $con="SELECT a.memoNo, a.gen_date, a.del_cd, a.prod_desc, a.amount, d.del_name, d.del_reg, r.per_unit
                    FROM td_allotment_sheet_np a, m_dealers d, m_rate_master_np r
                    WHERE a.del_cd = d.del_cd 
                    AND a.prod_desc = r.prod_desc
                    AND a.memono = '$memono' ";

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
                            echo "<td>" . $row['memoNo'] . "</td>";
                            echo "<td>" . $row['gen_date'] . "</td>";
                            echo "<td>" . $row['del_cd'] . "</td>";
                            echo "<td>" . $row['del_name'] . "</td>";
                            echo "<td>" . $row['del_reg'] . "</td>";
                            echo "<td>" . $row['prod_desc'] . "</td>";
                            echo "<td>" . $row['amount'] ." ". $row['per_unit']. "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                ?>

                <div>
                    <br><br>
                    <button class="btn btn-primary">

                        Print <i class="fa fa-print fa-lg" aria-hidden="true"></i>

                    </button>

                </div>

            </div>
        </div>

    </body>
            <!-- MOdal -->
    <div class="modal fade" id="allot_report_np" role="dialog">

        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body">

                </div>

            </div>

        </div>

    </div>

    <script>

        $(document).ready(function(){
            
            $('.btn').click( function () {

                var id = $(this).attr('id'),
                    date = $(this).attr('date');

                $.get("allot_sheet_bill_np.php", { gen_date: date, memo_no : "<?php echo $memono;?>" })
                
                .done(function (data) {

                    $(".modal-body").html(data);

                    $("#allot_report_np").modal('show');

                });

            });

        });

    </script>

    <?php

        $_SESSION['memoNo']         =   $memono;
        /*$_SESSION['gen_date']       =   $gen_date;
        $_SESSION['del_cd']         =   $del_cd;
        $_SESSION['del_name']       =   $del_name;
        $_SESSION['del_reg']        =   $del_reg;
        $_SESSION['prod_desc']      =   $prod_desc;
        $_SESSION['amount']         =   $amount; */
    ?>



</html>