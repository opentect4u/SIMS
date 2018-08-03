<?php   

	ini_set("display_errors","1");
	error_reporting(E_ALL);
	
	require ("../db/db_connect.php");
	require("../session.php");
	
	$prodtypeErr = "";

?>

<html>

    <head>
        <title>Synergic Inventory Management System</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>

            a {
                text-decoration :none;
                color: #021103;
            }

            a:hover {
                text-decoration :none;
                color: #ffffff;
            }

            .coll {
                background-color: #021103;
                color: #ffffff;
                text-align: center;
                margin-top: 35px;
                margin-left: 35px;
                margin-right: 10px;
                font-size: 15px;
                border-style: outset;
                border-color: #606c58;
                border-style: solid;
                border-width: 2px 5px 5px 2px;
            }

            a.one:hover {
                text-decoration :none;
                color:#e2e88f;
            }

            .coll:hover {
                background-color: #000500;
                color:#e2e88f;
            }

            .alink {
                text-decoration :none;
                color: #ffffff;
            }


        </style>

    </head>

    <body class="body">

    <?php

        require("./nav.php");

        echo "<h1 class='elegantshadow'>Laxmi Narayan Stores</h1>";

        echo "<hr class='hr'>";?>

        <div class="container" style="margin-left: 10px">

            <div class="row">

                <div class="col-lg-4 col-md-12">

                    <?php require("menu.php"); ?>

                </div>

                <div class="col-lg-8 col-md-12" style="margin-top: 10px;">

                    <div class="col-lg-3 col-md-4 col-xs-6 coll">

                        <a href="../masters/prod_master.php" class="alink one">

                            <div class="form-group" style="margin-left: 40%; margin-top: 10px">

                                <div class="form-row">

                                    <i class="fa fa-product-hunt fa-4x" aria-hidden="true"></i>

                                </div>

                            </div>

                            <div class="form-group" style="margin-left: 35%">

                                <div class="form-row">

                                    <p style="margin-left: 8%">Product</p>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6 coll">

                        <a href="../masters/dealer_master.php" class="alink one">

                            <div class="form-group" style="margin-left: 40%; margin-top: 10px">

                                <div class="form-row">

                                    <i class="fa fa-users fa-4x" aria-hidden="true"></i>

                                </div>

                            </div>

                            <div class="form-group" style="margin-left: 35%">

                                <div class="form-row">

                                    <p style="margin-left: 8%">Dealer</p>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6 coll">

                        <a href="../masters/rate_master.php" class="alink one">

                            <div class="form-group" style="margin-left: 40%; margin-top: 10px">

                                <div class="form-row">

                                    <i class="fa fa-inr fa-4x" aria-hidden="true"></i>

                                </div>

                            </div>

                            <div class="form-group" style="margin-left: 38%">

                                <div class="form-row">

                                    <p "margin-left: 8%">Rate</p>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6 coll">

                        <a href="../masters/allot_sheet_gen.php" class="alink one">

                            <div class="form-group" style="margin-left: 40%; margin-top: 10px">

                                <div class="form-row">

                                    <i class="fa fa-file-text fa-4x" aria-hidden="true">

                                    </i>

                                </div>

                            </div>

                            <div class="form-group" style="margin-left: 25%">

                                <div class="form-row">

                                    <p>Allotment Sheet</p>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6 coll">

                        <a href="../transactions/stock_in_pds.php" class="alink one">

                            <div class="form-group" style="margin-left: 40%; margin-top: 10px">

                                <div class="form-row">

                                    <i class="fa fa-plus-circle fa-4x" aria-hidden="true"></i>

                                </div>

                            </div>

                            <div class="form-group" style="margin-left: 35%">

                                <div class="form-row">

                                    <p style="margin-left: 8%">Stock In</p>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6 coll">

                        <a href="../transactions/stock_out_pds.php" class="alink one">

                            <div class="form-group" style="margin-left: 40%; margin-top: 10px">

                                <div class="form-row">

                                    <i class="fa fa-minus-circle fa-4x" aria-hidden="true"></i>

                                </div>

                            </div>

                            <div class="form-group" style="margin-left: 35%">

                                <div class="form-row">

                                    <p style="margin-left: 8%">Stock Out</p>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6 coll">

                        <a href="user.php" class="alink one">

                            <div class="form-group" style="margin-left: 40%; margin-top: 10px">

                                <div class="form-row">

                                    <i class="fa fa-user fa-4x" aria-hidden="true"></i>

                                </div>

                            </div>

                            <div class="form-group" style="margin-left: 35%">

                                <div class="form-row">

                                    <p style="margin-left: 8%">User</p>

                                </div>

                            </div>

                        </a>

                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6 coll">

                        <a href="../logout.php" class="alink one">

                            <div class="form-group" style="margin-left: 40%; margin-top: 10px">

                                <div class="form-row">

                                    <i class="fa fa-sign-out fa-4x" aria-hidden="true"></i>

                                </div>

                            </div>

                            <div class="form-group" style="margin-left: 35%">

                                <div class="form-row">

                                    <p style="margin-left: 8%">Log Out</p>

                                </div>

                            </div>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    <script src="../js/collapsible.js"></script>

    </body>

</html>

