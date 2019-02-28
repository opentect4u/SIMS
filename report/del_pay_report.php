<?php

    ini_set("display_errors","1");
    error_reporting("E_ALL");

    require("../db/db_connect.php");
    require("../session.php");

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
    
        $(document).ready(function(){

            var    start_dt         =    $('.validate-input input[name = "start_dt"]');
            var    end_dt           =    $('.validate-input input[name = "end_dt"]'); 
            var    del_cd         =    $('.validate-input input[name = "del_cd"]');            
            
            $('#form').submit(function(e) {

                var check = true;

                $('.validate-input .input1').each(function(){

                    hideAlertdate(this);

                });

            });

            showData(del_cd);
            showData(start_dt);
            showData(end_dt);                
            
            
            function showValidate(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).addClass('alert-validate');

            }


            function showData(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).addClass('alert-data');

            }


            function hideValidate(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).removeClass('alert-validate');

                //$(thisAlert).removeClass('alert-data');
            }


            function hideAlertdate(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).removeClass('alert-data');

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

                    <div class="container-contact1">

                        <form class="contact1-form validate-form" id="form" action="payment_report.php" method="POST">

                                <span class="contact1-form-title">

                                Select Dealer

                                </span>

                            <div class="wrap-input1 validate-input" data-validate="Dealer Name is required" data-alert="Dealer Name" >

                                <select class="input1" name="del_cd" id="del_cd" required>
                                                
                                    <option value="0">Select Dealer Name</option>

                                    <?php
                                        $select_del= "SELECT del_name, del_cd FROM m_dealers";
                                        $result=mysqli_query($db_connect,$select_del);

                                        while($row=mysqli_fetch_assoc($result)){
                                            echo ("<option value= '".$row["del_cd"]."' > " .$row["del_name"]." </option>");

                                        }
                                    ?>

                                </select>
                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Start Date is required" data-alert="Start Date">

                                <input type="date" class="input1" name="start_dt" id="start_dt" value="<?php echo date("Y-m-d");?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="End Date is required" data-alert="End Date">

                                <input type="date" class="input1" name="end_dt" id="end_dt" value="<?php echo date("Y-m-d");?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="container-contact1-form-btn">

                                <button class="contact1-form-btn">

                                    <span>

                                        Proceed

                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                    </span>

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>



    </body>

    <script src="../js/collapsible.js"></script>

</html>