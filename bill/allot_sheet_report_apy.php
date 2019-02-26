<?php
    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require("../db/db_connect.php");
    require("../session.php");

    $memo_no  =   $_SESSION['memo_no'];
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
                        <th>Mr No.</th>
                        <th>Dealer Name</th>
                        <th>Anchal</th>
                        <th>APY Unit</th>
                        <th>APY Rice</th>
                        </tr>";
                    ?>
                </div>

                <!-- php code -->

                <?php

                    $con="SELECT a.memo_no, a.gen_date, a.mr_no, a.apy_head, a.apy_rice,
                                d.del_name, d.del_reg 
                                
                    FROM td_apy_allot_sheet a, 
                        m_dealers d   

                    WHERE a.mr_no = d.del_cd 
                    AND a.memo_no = '$memo_no' ";

                    //echo $con; die;

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


                <div>
                    <br><br>
                    <button class="btn btn-primary">

                        Print <i class="fa fa-print fa-lg" aria-hidden="true"></i>

                    </button>

                </div>

            </div>
        </div>

    </body>

    <div class="modal fade" id="allot_report_apy" role="dialog">

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


<!-- js code -->

    <script>

        $(document).ready(function(){
            
            $('.btn').click( function () {

                var id = $(this).attr('id'),
                    date = $(this).attr('date');

                $.get("allot_sheet_bill_apy.php", { gen_date: date, memo_no : "<?php echo $memo_no;?>" })
                
                .done(function (data) {

                    $(".modal-body").html(data);

                    $("#allot_report_apy").modal('show');

                });

            });

        });

    </script>


<!-- Assigning memo_no in session  -->

    <?php $_SESSION['memo_no']         =   $memo_no; ?>


</html>