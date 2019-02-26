<?php

    ini_set("display_errors","1");
    error_reporting("E_ALL");

    require("../db/db_connect.php");
    require("../session.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") 
    {

        $memono = $_POST['memono'];

        $sql = "SELECT gen_date,
                        del_cd,
                        prod_desc,
                        amount 
                FROM td_allotment_sheet_np
                WHERE memono = '$memono'";

        //echo $sql; die();

        $allotment_result = mysqli_query($db_connect, $sql);

        $sql= "SELECT m.del_cd, m.del_name, m.del_reg, MAX(t.gen_date) gen_date
            FROM m_dealers m, td_allotment_sheet_np t
            WHERE m.del_cd = t.del_cd
            AND t.memoNo = '$memono'
            GROUP BY m.del_cd, m.del_name, m.del_reg";

        $sql_join = mysqli_query($db_connect, $sql);
    }

    
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

                    <form class="contact1-form validate-form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                            <span class="contact1-form-title">

                               Memo No.

                            </span>

                        <div class="wrap-input1 validate-input" data-validate="Memo No is required">

                            <input type="text" class="input1" name="memono" placeholder="Memo No" />

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

 <?php

        //$del_name          =      $row['del_name'];
        //$del_adr           =      $row['del_adr'];
        //$del_reg           =      $row['del_reg'];
        //$del_dist          =      $row['del_dist'];  
    /*
        if($allotment_result)
        {

            if(mysqli_num_rows($allotment_result) > 0 )
            {

                while($row = mysqli_fetch_assoc($allotment_result))
                {
                
                    $gen_date       =       $row['gen_date'];
                    $del_cd         =       $row['del_cd'];
                    $prod_desc      =       $row['prod_desc'];
                    $amount         =       $row['amount'];
                    
                }
                //echo $del_cd; die;
            }

        }

        
        
    /* echo $gen_date;
        echo $del_cd;
        echo $prod_desc;
        echo $amount;
        die; */
        
            //$del_cd	=	$_GET['del_cd'];

        /*    $sql= "SELECT   del_cd,
                            del_name, 
                            del_adr, 
                            del_reg, 
                            del_dist 
                        FROM m_dealers 
                        WHERE del_cd = '$del_cd' ";
        //echo $sql;

        $dealer_result	=  mysqli_query($db_connect,$sql);

    /* if($dealer_result){

            if(mysqli_num_rows($dealer_result) > 0 ){

                /* echo $del_name;
                    echo $del_adr;
                    echo $del_reg;
                    echo $del_dist; die;

                
            }
        } */

    /*  $sql= "SELECT m.del_cd, m.del_name, m.del_reg, MAX(t.gen_date) 
            FROM m_dealers m, td_allotment_sheet_np t
            WHERE m.del_cd = t.del_cd
            AND t.memoNo = '$memono'
            GROUP BY m.del_cd, m.del_name, m.del_reg";

        $sql_join = mysqli_query($db_connect, $sql);

        */
?>


    <div class="row" >

        <div class="col-lg-12 col-md-6">

            <div class="container-contact2" style="margin-left: 10px; width: 100%;">

                <table id="intro" class="table table-bordered table-hover">

                    <thead style="background-color: #212529; color: #fff; text-align: right;">

                        <tr>

                            <th>MR. No.</th>

                            <th>Dealer's Name</th>

                            <th>Date</th>

                            <th>Region</th>

                            <th>Option</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if($_SERVER['REQUEST_METHOD'] == "POST") {

                            while ($data = mysqli_fetch_assoc($sql_join)) { ?>

                                <tr>

                                    <td><?php echo $data['del_cd']; ?></td>

                                    <td><?php echo $data['del_name']; ?></td>

                                    <td><?php echo date('d/m/Y', strtotime($data['gen_date'])); ?></td>

                                    <td><?php echo $data['del_reg']; ?></td>

                                    <td><button class="btn btn-primary"

                                            id="<?php echo urlencode($data['del_cd']); ?>"
                                            date="<?php echo urlencode($data['gen_date']); ?>"
                                            memono= "<?php echo urlencode($memono); ?>" >

                                            Print <i class="fa fa-print fa-lg" aria-hidden="true"></i>

                                        </button>

                                    </td>

                                </tr>

                            <?php } ?>

                        <?php }?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="modal fade" id="pdsChallan" role="dialog">

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

    <script src="../js/collapsible.js"></script>

    </body>

    <script>

        $(document).ready(function(){
            
            $('.btn').click( function () {

                var id = $(this).attr('id'),
                    date = $(this).attr('date');

                $.get("../bill/non_pds_bill.php", { del_cd: id, gen_date: date, memono : "<?php echo $memono;?>" })
                
                .done(function (data) {

                    $(".modal-body").html(data);

                    $("#pdsChallan").modal('show');

                });

            });

        });

    </script>

    <?php
    
       // $_SESSION['memono']         =       $memono;
        //$_SESSION['gen_date']       =       $gen_date;
       // $_SESSION['del_cd']         =       $del_cd; 
        
    ?>

</html>