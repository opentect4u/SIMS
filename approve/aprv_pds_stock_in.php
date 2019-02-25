<?php

    ini_set("display_errors","1");
    error_reporting("E_ALL");

    require("../db/db_connect.php");
    require("../session.php");
    require_once("../post/sims_function.php");

    $prodtypeErr="";

    if($_SERVER['REQUEST_METHOD']=="GET"){

        $transdt	=	$_GET['trans_dt'];
        $transcd	=	$_GET['trans_cd'];

        $sql="Select do_no,
                    allot_no,		
                    prod_desc,
                    prod_type,
                    prod_catg,
                    prod_sl_no,
                    qty_bag,
                    qty_qnt,
                    qty_kg,
                    qty_gm,
                    remarks,
                    approval_status
                    from td_stock_trans_pds
                    where trans_dt = '$transdt'
                    and trans_cd = $transcd";

        $result	=  mysqli_query($db_connect,$sql);

        if($result){

            if(mysqli_num_rows($result) > 0 ){

                $row = mysqli_fetch_assoc($result);

                $dono    =       $row['do_no'];
                $allotno =	     $row['allot_no'];
                $pdesc   =       $row['prod_desc'];
                $ptype   =       $row['prod_type'];
                $pcatg   =       $row['prod_catg'];
                $pslno   =       $row['prod_sl_no'];
                $pbag    =       $row['qty_bag'];
                $pqnt    =       $row['qty_qnt'];
                $pkg     =       $row['qty_kg'];
                $pgm     =       $row['qty_gm'];
                $rkms    =       $row['remarks'];
                $aprv    =	     $row['approval_status'];

                if($aprv=='U'){

                    $status="Unapproved";

                }else{
                    $status="Approved";
                }
            }
        }

    }

    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $prod_bag	=	$_POST['qty_bag'];
        $prod_qnt	=	$_POST['qty_qnt'];
        $prod_kg	=	$_POST['qty_kg'];
        $prod_gm	=	$_POST['qty_gm'];
        $status		=	$_POST['approval_status'];
        $user		=	$_SESSION['user_id'];
        $time		=	date("Y-m-d h:m:i");
        $transdt	=	$_POST['trans_dt'];
        $transcd	=	$_POST['trans_cd'];
        $slno		=	$_POST['sl_no'];
        $prod_desc  =   $_POST['prod_desc'];
        $prodcatg	=	$_POST['prod_catg'];
        $allotno    =   $_POST['allot_no'];
        $do_no      =   $_POST['do_no'];

        
        if(!is_null($prod_bag) && !is_null($prod_qnt) && !is_null($prod_kg) && !is_null($prod_gm) && isset($user)){
            
            if($status=="Unapproved") {
                
                if ($allotno != 0) {
                     
                    $category_cd = f_getcatgcd($prodcatg, $db_connect);

                    $total_qty_curr   = f_getquintal($prod_qnt,$prod_kg,$prod_gm,$db_connect);

                    unset($sql);
                    unset($result);

                    $sql = "SELECT balance_qty 
            
                                FROM td_allot_dtls_pds  
                                
                                            WHERE allot_no = '$allotno'
                                            AND   catg_cd  = $category_cd
                                            AND   prod_cd  = $slno";

                    
                    $result =   mysqli_query($db_connect, $sql);

                    $data   =   mysqli_fetch_assoc($result);

                    if($total_qty_curr < $data['balance_qty']) {

                        unset($sql);
                        unset($result);

                        $balance_qty = $data['balance_qty'] - $total_qty_curr;



                        $sql = "UPDATE td_allot_dtls_pds SET balance_qty = $balance_qty,
                                                          prod_qty  = $total_qty_curr
                                                    WHERE allot_no  = '$allotno'
                                                    AND   catg_cd   = $category_cd
                                                    AND   prod_cd   = $slno";

                        mysqli_query($db_connect, $sql);

                        unset($sql);
                        unset($result);

                        require("update_balance.php");

                        $_SESSION['approve']="true";
                        header("Location:../transactions/view_stock_in_pds.php");

                    }

                    elseif($total_qty_curr == $data['balance_qty']) {

                        $cur_bag = 0;

                        unset($sql);
                        unset($result);

                        $sql = "UPDATE td_allot_dtls_pds SET balance_qty = 0.00,
                                                        prod_qty    = $total_qty_curr
                                                    WHERE allot_no  = '$allotno'
                                                    AND   catg_cd   = $category_cd
                                                    AND   prod_cd   = $slno";
                    

                        mysqli_query($db_connect, $sql);

                        unset($sql);
                        unset($result);

                        $total_qty = 0.00;

                        $sql = "SELECT qty_bag,
                                    qty_qnt,
                                    qty_kg,
                                    qty_gm
                                            FROM td_stock_trans_pds
                                            WHERE allot_no = '$allotno'
                                            AND   prod_sl_no = $slno
                                            AND   prod_catg  = '$prodcatg'";
                    

                        $result = mysqli_query($db_connect, $sql);

                        while ($cur_data = mysqli_fetch_assoc($result)) {

                            $total_qty += f_getquintal($cur_data['qty_qnt'], $cur_data['qty_kg'], $cur_data['qty_gm'], $db_connect);

                            $cur_bag = $cur_data['qty_bag'];

                        }

                        unset($sql);
                        unset($result);

                        $sql = "SELECT max(trans_dt) trans_dt,
                                    max(trans_cd) trans_cd,
                                    bag_bal,
                                    qnt_bal,
                                    kg_bal,
                                    gm_bal
                                        FROM td_stock_trans_pds
                                        WHERE allot_no = '$allotno'
                                        AND   approval_status = 'A'
                                        AND   prod_sl_no = $slno
                                        AND   prod_catg  = '$prodcatg'
                                        GROUP BY trans_dt, trans_cd 
                                        ORDER BY trans_dt, trans_cd DESC LIMIT 1";

                        $result = mysqli_query($db_connect, $sql);

                        $closing_data = mysqli_fetch_assoc($result);

                        $total_closing = f_getquintal($closing_data['qnt_bal'],$closing_data['kg_bal'],$closing_data['gm_bal'],$db_connect);

                        unset($sql);
                        unset($result);

                        $sql = "SELECT short_factor FROM m_shortage
                                                    WHERE prod_catg = '$prodcatg'
                                                    AND   prod_desc = '$prod_desc'";

                        $result = mysqli_query($db_connect, $sql);

                        $srt_factor = mysqli_fetch_assoc($result);

                        $srt_factor = $srt_factor['short_factor'];

                        $shortage = round(($total_qty * $srt_factor), 2);

                        $cur_qnt = $total_closing - ($total_qty_curr + $shortage);


                        $in_total = explode('.', (string) $cur_qnt);


                        $total_bag = $closing_data['bag_bal'] - $cur_bag;

                        $gm_bal = 0.00;


                        unset($sql);
                        unset($result);

                        $sql = "UPDATE td_stock_trans_pds SET sht_kg  = $shortage,
                                                            bag_bal = $total_bag,
                                                            qnt_bal = $in_total[0],
                                                            kg_bal  = $in_total[1],
                                                            gm_bal  = $gm_bal,
                                                            approval_status = 'A',
                                                            approved_by = '$user',
                                                            approved_dt = '$time'
                                                        WHERE allot_no = '$allotno'
                                                        AND   prod_sl_no = $slno
                                                        AND   prod_catg  = '$prodcatg'
                                                        AND   trans_dt   = '$transdt'
                                                        AND   trans_cd   =  $transcd";
                    

                        mysqli_query($db_connect, $sql);

                        $_SESSION['approve']="true";
                        header("Location:../transactions/view_stock_in_pds.php");

                    }

                }
                //For StockIn Approve
                else if($do_no != NULL){
                    
                    unset($result);
                    unset($data);
                    $sql = "SELECT ifnull(bag_bal, 0) bag_bal,
                                   ifnull(qnt_bal, 0) qnt_bal,
                                   ifnull(kg_bal, 0) kg_bal,
                                   ifnull(gm_bal, 0) gm_bal,
                                   max(trans_dt) trans_dt FROM td_stock_trans_pds 
                            WHERE prod_catg = '$prodcatg' AND prod_sl_no = $slno
                            AND approval_status = 'A'
                            AND trans_dt < '$transdt'
                            GROUP BY bag_bal, qnt_bal, kg_bal, gm_bal
                            ORDER BY trans_dt DESC LIMIT 1";
                    
                    $result =   mysqli_query($db_connect, $sql);
                    
                    $data   =   mysqli_fetch_assoc($result);

                    $sql = "UPDATE td_stock_trans_pds SET   bag_opn = ".(isset($data['bag_bal'])? $data['bag_bal'] : 0).",
                                                            qnt_opn = ".(isset($data['qnt_bal'])? $data['qnt_bal'] : 0) .",
                                                            kg_opn  = ".(isset($data['kg_bal'])? $data['kg_bal'] : 0) .",
                                                            gm_opn  = ".(isset($data['gm_bal'])? $data['gm_bal'] : 0) .",
                                                            bag_bal = ".((float) $prod_bag + (float) $data['bag_bal']).",
                                                            qnt_bal = ".((float) $prod_qnt + (float) $data['qnt_bal']).",
                                                            kg_bal  = ".((float) $prod_kg  + (float) $data['kg_bal']).",
                                                            gm_bal  = ".((float) $prod_gm  + (float) $data['gm_bal']).",                                                         
                                                            approval_status = 'A',
                                                            approved_by = '$user',
                                                            approved_dt = '$time'
                                                        WHERE do_no = '$do_no'
                                                        AND   prod_sl_no = $slno
                                                        AND   prod_catg  = '$prodcatg'
                                                        AND   trans_dt   = '$transdt'
                                                        AND   trans_cd   =  $transcd";
                    
                        
                        mysqli_query($db_connect, $sql);

                        $_SESSION['approve']="true";
                        header("Location:../transactions/view_stock_in_pds.php");
                }

            }
            
        }

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
        var    allot_no         =    $('.validate-input input[name = "allot_no"]');
        var    prod_type        =    $('.validate-input input[name = "prod_type"]');
        var    sl_no            =    $('.validate-input input[name = "sl_no"]');
        var    prod_desc        =    $('.validate-input input[name = "prod_desc"]');
        var    prod_catg        =    $('.validate-input input[name = "prod_catg"]');

        var    qty_bag          =    $('.validate-input input[name = "qty_bag"]');
        var    qty_qnt          =    $('.validate-input input[name = "qty_qnt"]');
        var    qty_kg           =    $('.validate-input input[name = "qty_kg"]');
        var    qty_gm           =    $('.validate-input input[name = "qty_gm"]');

        showData(trans_dt);
        showData(trans_cd);
        showData(do_no);
        showData(allot_no);
        showData(prod_desc);
        showData(prod_catg);
        showData(prod_type);
        showData(sl_no);

        showData(qty_bag);
        showData(qty_qnt);
        showData(qty_kg);
        showData(qty_gm);

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

                                   Approve PDS Stock In/Out

                                </span>

                    <div class="wrap-input1 validate-input" data-alert="Transaction Date">

                        <input type="date" class="input1" name="trans_dt" readonly value="<?php echo date($transdt); ?>" />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Transaction Code">

                        <input type="text" class="input1" name="trans_cd" readonly value="<?php echo date($transcd); ?>" />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Do No">

                        <input type="text" class="input1" name="do_no" id="do_no" value="<?php echo $dono; ?>" placeholder="DO No." readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Allotment No">

                        <input type="text" class="input1" name="allot_no" id="allot_no" value="<?php echo $allotno; ?>" placeholder="MEMO No." readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Product Name">

                        <input type="text" class="input1" name="prod_desc" id="prod_desc" value="<?php echo $pdesc; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Category">

                        <input type="text" class="input1" name="prod_catg" id="prod_catg" value="<?php echo $pcatg; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Product Type">

                        <input type="text" class="input1" name="prod_type" id="prod_type" value="<?php echo $ptype;?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Product Sl No.">

                        <input type="text" class="input1" name="sl_no" value="<?php echo $pslno; ?>" id="sl_no" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Bag">

                        <input type="text" class="input1" name="qty_bag" value="<?php echo $pbag; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Quintal">

                        <input type="text" class="input1" name="qty_qnt" value="<?php echo $pqnt; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Kg">

                        <input type="text" class="input1" name="qty_kg" value="<?php echo $pkg; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input" data-alert="Gram">

                        <input type="text" class="input1" name="qty_gm" value="<?php echo $pgm; ?>" readonly />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <input type="text" class="input1" name="approval_status" value="<?php echo $status; ?>" readonly style="color:green;" />

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="wrap-input1 validate-input">

                        <textarea class="input1" rows="5" cols="50" name="remarks" readonly><?php echo $rkms; ?></textarea>

                        <span class="shadow-input1"></span>

                    </div>

                    <div class="container-contact1-form-btn">

                        <button class="contact1-form-btn">

                                <span>

                                    Approve

                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script src="../js/collapsible.js"></script>

</body>

</html>
