<?php
    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require("../db/db_connect.php");
    require("../session.php");

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

                        <span class="contact1-form-title">

                            NON PDS Allotment Sheet
                        
                        </span>

                    </div> 
                </div>  

                <div class="w3-row-padding">
                    <?php
                        echo "<table id='customers'style= 'margin-left:36px'>
                        <tr align= center>
                        <th>MemoNo</th>
                        <th>Date</th>
                        <th>Dealer Code</th>
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Update</th>
                        <th>Delete</th>
                        </tr>";
                    ?>
                </div> 

                    <?php

                        $con="SELECT * FROM td_allotment_sheet_np";
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $result = mysqli_query($db_connect,$con);      
                        
                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<tr>";
                            echo "<td>" . $row['memoNo'] . "</td>";
                            echo "<td>" . $row['gen_date'] . "</td>";
                            echo "<td>" . $row['del_cd'] . "</td>";
                            echo "<td>" . $row['prod_desc'] . "</td>";
                            echo "<td>" . $row['amount'] . "</td>";
                            echo '<td><b><font color="blue"><a href="edit_allot_sheet_np.php?memoNo='.$row['memoNo'].'&prod_desc='.$row['prod_desc'] .'&del_cd='. $row['del_cd'].'&gen_date='.$row['gen_date'].'">Edit</a></font></b></td>';
                            echo '<td><b><font color="red"><a href="delete_allot_sheet_np.php?memoNo='.$row['memoNo'].'&prod_desc='.$row['prod_desc'] .'&del_cd='. $row['del_cd'].'&gen_date='.$row['gen_date'].'">Delete</a></font></b></td>';
                            echo "</tr>";
                        }
                        echo "</table>";
                            
                    ?>
                        
            </div>
        </div>

        <script src="../js/collapsible.js"></script>
       
    </body>
</html>

