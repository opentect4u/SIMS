<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
    require("../session.php");
    require("../post/sims_function.php");

        $errMsg = '';

	if ($_SERVER["REQUEST_METHOD"]=="POST"){

            //$qtybag = $qtyqnt = $qtykg = $qtygm = 0.00;

            //$transdt	=	DateTime::createFromFormat('d-m-Y', $_POST["trans_dt"]);
            $transdt    =   date('Y-m-d');
			$allotno	=	$_POST["do_no"];
			$prodslno	=	$_POST["sl_no"];
			$proddesc	=	$_POST["prod_desc"];
			$transtype	=	"O";
			$qtybag		=	$_POST['qty_bag'];
			$qtyqnt		=	$_POST['qty_qnt'];	
			$qtykg		=	$_POST['qty_kg'];
			$qtygm		=	$_POST['qty_gm'];	
			$prodtype	=	$_POST['prod_type'];
			$prodcatg	=	$_POST['prod_catg'];	
			$remarks	=	$_POST['remarks'];
			$transcd	=	1;
            $user_id    =   $_SESSION["user_id"];
			$time       =   date("Y-m-d h:i:s");

			$prod_cd = f_getprodcd($proddesc,$db_connect);
			$catg_cd = f_getcatgcd($prodcatg,$db_connect);
			$qty_bal = f_getallotbal($allotno,$catg_cd,$prod_cd,$db_connect);
			$tot_bal = f_getquintal($qtyqnt,$qtykg,$qtygm,$db_connect); 
		         	
			/*echo "prod_cd- $prod_cd"."<br>";
			echo "catg_cd -$catg_cd"."<br>";
			echo "qty_bal-$qty_bal"."<br>";
			echo "tot_bal-$tot_bal";*/

		    try{

				f_check_balance($qty_bal,$tot_bal);
			}		

			catch (Exception $e ){
				echo $e->getMessage();
				return;
			}	

			if(array_sum(array($qtybag, $qtyqnt, $qtykg, $qtygm)) > 0 && !is_null($allotno)) {
			    $sql = "SELECT MAX(trans_cd) trans_cd FROM td_stock_trans_pds
                                                      WHERE trans_dt = '$transdt'";

			    $result = mysqli_query($db_connect, $sql);

			    if (mysqli_num_rows($result) > 0) {
			        $data = mysqli_fetch_assoc($result);
                    		$transcd += $data['trans_cd'];
                		}


			    $sql="insert into td_stock_trans_pds (trans_dt,
                                                     trans_cd,
                                                     allot_no,
                                                     prod_sl_no,
                                                     prod_desc,
                                                     prod_type,
                                                     prod_catg,
                                                     trans_type,
                                                     qty_bag,
                                                     qty_qnt,
                                                     qty_kg,
                                                     qty_gm,
                                                     remarks,
                                                     approval_status,			
                                                     created_by,
                                                     created_dt,
                                                     sht_kg,
                                                     sht_gm)
                                                     
                                              values('$transdt',
                                                     '$transcd',
                                                     '$allotno',
                                                     '$prodslno',
                                                     '$proddesc',
                                                     '$prodtype',
                                                     '$prodcatg',
                                                     '$transtype',
                                                      $qtybag,
                                                      $qtyqnt,
                                                      $qtykg,
                                                      $qtygm,
                                                     '$remarks',
                                                     'U',									     
                                                     '$user_id',
                                                     '$time',
                                                          0,
                                                          0)";

			    $result=mysqli_query($db_connect,$sql);

			    header("Location: view_stock_in_pds.php");	

            }
            else{

			    echo "<script>alert('Please Insert Valid Unit, Transaction Failed');</script>";

            }

        }

        unset($sql);

        $prod_sql = "SELECT sl_no,prod_type,prod_desc FROM m_products ORDER BY sl_no";

        $prod_result = mysqli_query($db_connect, $prod_sql);


        $catg_sql	=   "Select prod_catg from m_prod_catg WHERE prod_catg != 'SPHH' ";

        $result_catg = mysqli_query($db_connect,$catg_sql);
		

?>
<html>

	<head>

		<title>Synergic Inventory Management System-Stock Out</title>

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
            var    do_no            =    $('.validate-input input[name = "do_no"]');
            var    prod_desc        =    $('.validate-input select[name = "prod_desc"]');
            var    prod_catg        =    $('.validate-input select[name = "prod_catg"]');
            var    alloted_qnt      =    $('.validate-input input[name = "alloted_qnt"]');
            var    qty_bag          =    $('.validate-input input[name = "qty_bag"]');
            var    qty_qnt          =    $('.validate-input input[name = "qty_qnt"]');
            var    qty_kg           =    $('.validate-input input[name = "qty_kg"]');
            var    qty_gm           =    $('.validate-input input[name = "qty_gm"]');

            $('#form').submit(function(e) {

                var check = true;

                $('.validate-input .input1').each(function(){

                    hideAlertdate(this);

                });

                if($(do_no).val().trim() == '') {

                    showValidate(do_no);

                    check=false;

                }

                if($(prod_desc).val() == '0') {

                    showValidate(prod_desc);

                    check=false;

                }

                if($(prod_catg).val() == '0') {

                    showValidate(prod_catg);

                    check=false;
                }

                return check;

            });



            $('.validate-form .input1').each( function() {

                $(this).focus(function(){

                    hideValidate(this);

                });

            });

            showData(trans_dt);
            showData(do_no);
            showData(prod_desc);
            showData(prod_catg);
            showData(prod_type);
            showData(sl_no);
            showData(alloted_qnt);
            showData(qty_bag);
            showData(qty_qnt);
            showData(qty_kg);
            showData(qty_gm);


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

    <script>

	$(document).ready(function() {

        $('#prod_desc').change(function () {

		  $('#prod_type').val($(this).find(':selected').attr('data-val'));

		  $('#sl_no').val($(this).find(':selected').attr('prod-cd'));

        });

        $('#do_no').change( function () {

            var allotmentNo = $(this).val();

            $.ajax({

                url:"../fetch/checkAllotNo.php",

                data: {

                    allotmentNo : allotmentNo

                },

                type: "GET"

            }).done(function (data) {

                if(data != 1) {

                    alert("Allotment Number Doesn't Match");

                    $('#do_no').val('');

                }

            });

        });

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

                                   Stock Out

                                </span>

                            <div class="wrap-input1 validate-input" data-alert="Transaction Date" >

                                <input type="text" class="input1" name="trans_dt" value="<?php echo date("d-m-Y", strtotime(f_getparamval(7, $db_connect))) ?>" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Allotment Memo No. is required" data-alert="Allotment No.">

                                <input type="text" class="input1" name="do_no" id="do_no" placeholder="Allotment Number" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product name is required" data-alert="Product Name">

                                <select class="input1" name="prod_desc" id="prod_desc">

                                    <option value="0">Select Product</option>

                                    <?php

                                        while($row=mysqli_fetch_assoc($prod_result)){

                                            echo("<option value='".$row['prod_desc']."' data-val='".$row['prod_type']."' prod-cd='".$row['sl_no']."'>".$row['prod_desc']."</option>");

                                        }

                                    ?>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Category is required" data-alert="Category">

                                <select class="input1" name="prod_catg" id="prod_catg" >

                                    <option value="0">Select Category</option>

                                    <?php

                                        while($data=mysqli_fetch_assoc($result_catg)) {

                                            echo ("<option value='".$data['prod_catg']."'>".$data['prod_catg']."</option>");

                                        }

                                    ?>

                                </select>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Product Type">

                                <input type="text" class="input1" name="prod_type" id="prod_type" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Product No.">

                                <input type="text" class="input1" name="sl_no" id="sl_no" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="alloted_qnt" >

                                <input type="text" class="input1" id="alloted_qnt" name="alloted_qnt" value="0.00" placeholder="Alloted Qnt" readonly />

                                <span class="shadow-input1"></span>

                            </div>
                            
                            <div class="wrap-input1 validate-input" data-alert="Bag/Tin" >

                                <input type="text" class="input1" name="qty_bag" value="0.00" placeholder="Bag" />

                                <span class="shadow-input1"></span>

                            </div> 

                            <div class="wrap-input1 validate-input" data-alert="Quint" >

                                <input type="text" class="input1" id="qty_qnt" name="qty_qnt" value="0.00" placeholder="Quintal" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Kgs.">

                                <input type="text" class="input1" id="qty_kg" name="qty_kg" value="0.00" placeholder="Kg" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Grs.">

                                <input type="text" class="input1" id="qty_gm" name="qty_gm" value="0.00" placeholder="Gram" />

                                <span class="shadow-input1"></span>

                            </div> 

                            <div class="wrap-input1 validate-input" data-validate="Date is required">

                                <textarea class="input1" name="remarks" >Enter Remarks If Any..

                                </textarea>

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="container-contact1-form-btn">

                                <button class="contact1-form-btn">

                                        <span>

                                            Save

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


<script>

    $(document).ready(function()
                    {
                        $('#prod_catg').change(
                                function()
                                {
                                    var prod_catg = $(this).val();
                                    var do_no = $('#do_no').val();
                                    var prod_desc = $('#prod_desc').val();

                                    /*console.log(prod_catg);
                                    console.log(do_no);
                                    console.log(prod_desc); */

                                    $.ajax({

                                        url:"../fetch/stockOut_pds_amount.php",

                                        data:{
                                            prod_catg : prod_catg,
                                            do_no : do_no,
                                            prod_desc : prod_desc
                                        },
                                        type: "GET"

                                    }).done(function (data){

                                        var total_qnt = JSON.parse(data);
    
                                        $('#alloted_qnt').val(total_qnt);

                                    });

                                }
                        );
                    });

</script>