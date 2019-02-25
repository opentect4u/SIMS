<?php

    ini_set("display_errors","1");
    error_reporting("E_ALL");
 
    require("../db/db_connect.php");
    require("../session.php");

    $prodtypeErr="";

    if($_SERVER['REQUEST_METHOD']=="GET"){

        $trans_dt	=	$_GET['trans_dt'];
        $trans_cd	=	$_GET['trans_cd'];

        $sql="Select trans_dt, 
                do_no,
                allot_no,		
                prod_desc,
                prod_type,
                prod_sl_no,
                qty_bags_tin,
                qty_cs,
                qty_kg,
                qty_pieces,
                bag_tin_bal,
                cs_bal,
                kg_bal,
                pieces_bal,
                remarks,
                approval_status
                from td_stock_trans_np
                where trans_dt = '$trans_dt'
                and trans_cd   =  $trans_cd";

        $result	=  mysqli_query($db_connect,$sql);

        if($result){

            if(mysqli_num_rows($result) > 0 ){

                $row = mysqli_fetch_assoc($result);
                
                $trans_dt           =      $row['trans_dt'];
                $do_no              =      $row['do_no'];
                $allot_no           =	   $row['allot_no'];
                $prod_desc          =      $row['prod_desc'];
                $prod_type          =      $row['prod_type'];
               // $pcatg   =       $row['prod_catg'];
                $prod_sl_no         =       $row['prod_sl_no'];
                $qty_bags_tin       =       $row['qty_bags_tin'];
                $qty_cs             =       $row['qty_cs'];
                $qty_kg             =       $row['qty_kg'];
                $qty_pieces         =       $row['qty_pieces'];
                $bag_tin_bal        =       $row['bag_tin_bal'];
                $cs_bal             =       $row['cs_bal'];
                $kg_bal             =       $row['kg_bal'];
                $pieces_bal         =       $row['pieces_bal'];
                $remarks            =       $row['remarks'];
                $approval_status    =	    $row['approval_status'];
                
                if($approval_status=='U'){

                    $status="Unapproved";

                }else{
                    $status="Approved";
                }

            }
        }

    }

    if($_SERVER['REQUEST_METHOD']=="POST"){


        $trans_dt = $_POST['trans_dt'];
        $trans_cd = $_POST['trans_cd'];
        $user_id  = $_SESSION['user_id'];
        $time     = date("Y-m-d h:i:s");
        $prod_sl_no = $_POST['prod_sl_no'];

        $qty_bags_tin       =    $_POST['qty_bags_tin'];
        $qty_cs             =    $_POST['qty_cs'];
        $qty_kg             =    $_POST['qty_kg'];
        $qty_pieces         =    $_POST['qty_pieces'];

        $max = "select ifnull(max(trans_dt),'1900-01-01')trans_dt,
                      ifnull(max(trans_cd),0)trans_cd 
               from td_stock_trans_np
               where prod_sl_no = $prod_sl_no
               and approval_status = 'A'";

        $maxResult = mysqli_query($db_connect, $max);     

        $maxData = mysqli_fetch_assoc($maxResult);

        $maxTransDt = $maxData['trans_dt'];
        //$maxTransCd = $maxData['trans_cd'];

        $max_trans_cd= "SELECT ifnull(max(trans_cd),0)trans_cd
                        FROM td_stock_trans_np
                        WHERE prod_sl_no= $prod_sl_no
                        AND  approval_status= 'A'
                        AND trans_dt= '$maxTransDt'";

            $max_cdResult= mysqli_query($db_connect, $max_trans_cd);
            $max_cdData = mysqli_fetch_assoc($max_cdResult);

            $maxTransCd = $max_cdData['trans_cd'];

        $bal = "select ifnull(max(bag_tin_bal),0)bag_tin_bal,
                       ifnull(max(kg_bal),0)kg_bal,
                       ifnull(max(cs_bal),0)cs_bal,
                       ifnull(max(pieces_bal),0)pieces_bal
                from   td_stock_trans_np
                where  prod_sl_no = $prod_sl_no
                and    trans_dt   = '$maxTransDt'
                and    trans_cd   =  $maxTransCd";

        $balResult = mysqli_query($db_connect,$bal);     

        $balData = mysqli_fetch_assoc($balResult);
        
        $bagBal = $balData['bag_tin_bal'];
        $kgBal  = $balData['kg_bal'];  
        $csBal  = $balData['cs_bal'];
        $pcBal  = $balData['pieces_bal'];  
        
      /*  echo "bagBal ".$bagBal."<br>";
        echo "kgBal ".$kgBal."<br>";
        echo "csBal ".$csBal."<br>";
        echo "pcBal ".$pcBal."<br>";*/

        if($maxTransDt != NULL){
        
            $bags_tin_opn   =   $bagBal;
            $cs_opn         =   $kgBal;
            $kg_opn         =   $csBal;
            $pieces_opn     =   $pcBal;

        }
        else{

            $bags_tin_opn   =   0;
            $cs_opn         =   0;
            $kg_opn         =   0;
            $pieces_opn     =   0;

        }


        $bag_tin_bal        =   $qty_bags_tin   +  $bagBal;
        $cs_bal             =   $qty_cs         +  $csBal;
        $kg_bal             =   $qty_kg         +  $kgBal;  
        $pieces_bal         =   $qty_pieces     +  $pcBal; 

      /*  echo "bag_tin_bal ".$bag_tin_bal."<br>";
        echo "cs_bal ".$cs_bal."<br>";
        echo "kg_bal ".$kg_bal."<br>";
        echo "pieces_bal ".$pieces_bal."<br>";*/

        // New // Opening data ***********************//

        $sql_maxDt= "SELECT max(trans_dt) 
                    From td_stock_trans_np
                    WHERE prod_sl_no= $prod_sl_no 
                    AND approval_status= 'A'";

        //echo $sql_maxDt; die;           

        $maxDt_result= mysqli_query($db_connect,$sql_maxDt);
        $maxDt_row = mysqli_fetch_assoc($maxDt_result);

        $max_trans_dt = $maxDt_row['max(trans_dt)'];

       // echo $max_trans_dt; die;

     /*  if($max_trans_dt != NULL)
       {

            $sql_opn = "SELECT sum(bag_tin_bal),
                            sum(kg_bal),
                            sum(cs_bal),
                            sum(pieces_bal)
                    FROM td_stock_trans_np
                    WHERE prod_sl_no= $prod_sl_no
                    AND  trans_dt = '$max_trans_dt'
                    AND approval_status= 'A' ";

            //echo $sql_opn; echo die;

            $opn_result= mysqli_query($db_connect,$sql_opn);
            $opn_row=  mysqli_fetch_assoc($opn_result);

            $bags_tin_opn       =       $opn_row['sum(bag_tin_bal)'];
            $cs_opn             =       $opn_row['sum(kg_bal)'];
            $kg_opn             =       $opn_row['sum(cs_bal)'];
            $pieces_opn         =       $opn_row['sum(pieces_bal)'];

       }
       else{

            $bags_tin_opn   =   0;
            $cs_opn         =   0;
            $kg_opn         =   0;
            $pieces_opn     =   0;

       } */
        
       /* echo $bags_tin_opn; echo "<br>";
        echo $cs_opn; echo "<br>";
        echo $kg_opn; echo "<br>";
        echo $pieces_opn; echo "<br>";
        die(); */

       // NEW // Opening Data ************** from ln_no: 135 *************
           
        $sql = "UPDATE td_stock_trans_np 
                SET bags_tin_opn        =   $bags_tin_opn,
                    cs_opn              =   $cs_opn,
                    kg_opn              =   $kg_opn,
                    pieces_opn          =   $pieces_opn,
                    approval_status     =   'A',
                    bag_tin_bal         =   $bag_tin_bal,
                    cs_bal              =   $cs_bal,
                    kg_bal              =   $kg_bal,
                    pieces_bal          =   $pieces_bal,
                    approved_by         =   '$user_id',
                    approved_dt         =   '$time'
                where  trans_dt         =   '$trans_dt'
                and    trans_cd         =   $trans_cd ";

       
        mysqli_query($db_connect, $sql);
        $_SESSION['approve']="true";
        Header("Location:../transactions/view_stock_in_np.php");

    }

?>

<html>

    <head>

        <title>Synergic Inventory Management System-Approve Stock Transactions</title>

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

<script>

    $(document).ready(function() {

        var    trans_dt         =    $('.validate-input input[name = "trans_dt"]');
        var    trans_cd         =    $('.validate-input input[name = "trans_cd"]');
        var    do_no            =    $('.validate-input input[name = "do_no"]');
        //var    allot_no         =    $('.validate-input input[name = "allot_no"]');
        var    prod_type        =    $('.validate-input input[name = "prod_type"]');
        var    prod_sl_no            =    $('.validate-input input[name = "prod_sl_no"]');
        var    prod_desc        =    $('.validate-input input[name = "prod_desc"]');
        //var    prod_catg        =    $('.validate-input input[name = "prod_catg"]');
        var    qty_bags_tin    =    $('.validate-input input[name = "qty_bags_tin"]');
        var    qty_cs          =    $('.validate-input input[name = "qty_cs"]');
        var    qty_kg          =    $('.validate-input input[name = "qty_kg"]');
        var    qty_pieces      =    $('.validate-input input[name = "qty_pieces"]');

        showData(trans_dt);
        showData(trans_cd);
        showData(do_no);
       // showData(allot_no);
        showData(prod_desc);
        //showData(prod_catg);
        showData(prod_type);
        showData(prod_sl_no);

        showData(qty_bags_tin);
        showData(qty_cs);
        showData(qty_kg);
        showData(qty_pieces);

        function showData(input) {

            var thisAlert = $(input).parent();

            $(thisAlert).addClass('alert-data');

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

                <form class="contact1-form validate-form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                                <span class="contact1-form-title">

                                   Approve NON PDS Stock In

                                </span>

                    <div class="wrap-input1 validate-input" data-alert="Transaction Date">

                        <input type="date" class="input1" name="trans_dt" readonly value="<?php echo date($trans_dt); ?>" />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Transaction Code">

                        <input type="text" class="input1" name="trans_cd" readonly value="<?php echo date($trans_cd); ?>" />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Do No">

                        <input type="text" class="input1" name="do_no" id="do_no" value="<?php echo $do_no; ?>" placeholder="DO No." readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <!--<div class="wrap-input1 validate-input" data-alert="Allotment No">

                        <input type="text" class="input1" name="allot_no" id="allot_no" value="<?php// echo $allot_no; ?>" placeholder="MEMO No." readonly />

                        <span class="shadow-input1"></span>

                    </div>-->

                    <div class="wrap-input1 validate-input" data-alert="Product Name">

                        <input type="text" class="input1" name="prod_desc" id="prod_desc" value="<?php echo $prod_desc; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                   <!-- <div class="wrap-input1 validate-input" data-alert="Category">

                        <input type="text" class="input1" name="prod_catg" id="prod_catg" value="<?php //echo $pcatg; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div> -->

                    <div class="wrap-input1 validate-input" data-alert="Product Type">

                        <input type="text" class="input1" name="prod_type" id="prod_type" value="<?php echo $prod_type;?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                   <!--<div class="wrap-input1 validate-input" data-alert="Product Sl No.">-->

                        <input type="hidden" class="input1" name="prod_sl_no" value="<?php echo $prod_sl_no; ?>" id="prod_sl_no" readonly />

                        <span class="shadow-input1"></span>

                   <!-- </div>-->

                    <div class="wrap-input1 validate-input" data-alert="Bag/Tin">

                        <input type="text" class="input1" name="qty_bags_tin" value="<?php echo $qty_bags_tin; ?>" id= "qty_bags_tin" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Cs">

                        <input type="text" class="input1" name="qty_cs" value="<?php echo $qty_cs; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Kg">

                        <input type="text" class="input1" name="qty_kg" value="<?php echo $qty_kg; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Pieces">

                        <input type="text" class="input1" name="qty_pieces" value="<?php echo $qty_pieces; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="approval_status" value="<?php echo $status; ?>" readonly style="color:green;" />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <textarea class="input1" rows="5" cols="50" name="remarks" readonly><?php echo $remarks; ?></textarea>

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="container-contact1-form-btn">

                        <input type = "submit" name="submit" value="Approve" class="contact1-form-btn" />

                                <!--<span>

                                    Approve

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                </span>-->

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script src="../js/collapsible.js"></script>

</body>

</html>
