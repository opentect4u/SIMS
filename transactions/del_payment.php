<?php

    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require("../db/db_connect.php");
    require("../session.php");

    $errMsg = '';

    if($_SESSION['ins_flag']==true){
        echo "<script>alert('Save Successful')</script>";
        $_SESSION['ins_flag']=false;
    }

    // to get trans_cd -->$

    $date = date("Y-m-d");
    
    $sql = "SELECT  MAX(trans_cd) transCd FROM td_del_payment WHERE trans_dt = '$date' ";
    $result    =   mysqli_query($db_connect, $sql);

    //echo $sql; die;
    while($row = mysqli_fetch_assoc($result))
    {
        $trans_cd = $row['transCd'];
    }




    if ($_SERVER["REQUEST_METHOD"]=="POST"){

        $trans_dt	    =	$_POST["effective_dt"];
        $trans_cd	    =	$_POST["trans_cd"];
        $mr_no	        =	$_POST["del_cd"];
        $cash_paid	    =	$_POST["cash_paid"];
        $material_paid	=	$_POST["material_paid"];
        $due_amnt	    =	$_POST["due_amnt"];
        $remarks	    =	$_POST["remarks"];

        $user_id        =   $_SESSION["user_id"];
        $time           =   date("Y-m-d h:i:s");

        $sql_insert = " insert into td_del_payment (trans_dt,
                                                    trans_cd,
                                                    mr_no,
                                                    cash_paid,
                                                    material_paid,
                                                    due_amnt,
                                                    remarks,
                                                    created_by,
                                                    created_dt)

                                            values('$trans_dt',
                                                    $trans_cd,
                                                    $mr_no,
                                                    $cash_paid,
                                                    $material_paid,
                                                    $due_amnt,
                                                    '$remarks',
                                                    '$user_id',
                                                    '$time' )";
                                                
        //echo $sql_insert; die;

        $result = mysqli_query($db_connect,$sql_insert);

        if($result)
        {
            $_SESSION['ins_flag']=true;
            Header("Location:del_payment.php");
    
        }

    }

    
    

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


    <script>
    // valiadtion (js)

        $(document).ready(function() {

            var    trans_dt         =    $('.validate-input input[name = "effective_dt"]');
            var    del_cd           =    $('.validate-input select[name = "del_cd"]'); 
            var    prev_due         =    $('.validate-input input[name = "prev_due"]');            
            var    cash_paid        =    $('.validate-input input[name = "cash_paid"]');
            var    material_paid    =    $('.validate-input input[name = "material_paid"]');
            var    due_amnt         =    $('.validate-input input[name = "due_amnt"]');
            var    remarks          =    $('.validate-input input[name = "remarks"]');
            


            $('#form').submit(function(e) {

                var check = true;

                $('.validate-input .input1').each(function(){

                    hideAlertdate(this);

                });

            });

                showData(trans_dt);
                showData(del_cd);
                showData(prev_due);                
                showData(cash_paid);
                showData(material_paid);
                showData(due_amnt);
                showData(remarks);

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

                        <form class="contact1-form validate-form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <span class="contact1-form-title">

                                Dealer Payment

                            </span>

                            <div class="wrap-input1 validate-input" data-validate="Date is required" data-alert="Effective Date" >

                                <input type="date" class="input1" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <input type="hidden" class="input1" name="trans_cd" id="trans_cd" value="<?php echo $trans_cd + 1 ; ?>" />

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

                            <div class="wrap-input1 validate-input" data-validate="cash_paid is required" data-alert="Previous Due" >

                                <input type="text" class="input1" name="prev_due" id="prev_due" value= "0.00" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="cash_paid is required" data-alert="Cash Paid " >

                                <input type="text" class="input1" name="cash_paid" id="cash_paid" value= "0.00" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="material_paid is required" data-alert="Material Paid " >

                                <input type="text" class="input1" name="material_paid" id="material_paid" value= "0.00" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="due_amnt is required" data-alert="Total Due " >

                                <input type="text" class="input1" name="due_amnt" id="due_amnt" value= "0.00" />

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
                        $('#del_cd').change(
                                function()
                                {
                                    var del_cd = $(this).val();
                                    
                                    console.log(del_cd);
                                    
                                    $.ajax({

                                        url:"../fetch/get_dealer_due.php",

                                        data:{
                                            del_cd : del_cd,
                                            
                                        },
                                        type: "GET" 

                                    }).done(function (data){

                                        var prev_due = JSON.parse(data);
    
                                        $('#prev_due').val(prev_due); 

                                    });

                                }
                        );

                    });


    $(document).ready(function()
                    {
                        $('#material_paid').change(
                                function()
                                {
                                    var material_paid = $(this).val();
                                    var cash_paid = $('#cash_paid').val();
                                    var prev_due = $('#prev_due').val();
                                    var paid = parseFloat(cash_paid) + parseFloat(material_paid);

                                    /*console.log(material_paid);
                                    console.log(cash_paid);
                                    console.log(prev_due);
                                    console.log(paid); */

                                    var due_amnt = parseFloat(prev_due) - parseFloat(paid);
                                    //console.log(due_amnt);
    
                                    $('#due_amnt').val(due_amnt);   

                                }
                        );

                    });



</script>