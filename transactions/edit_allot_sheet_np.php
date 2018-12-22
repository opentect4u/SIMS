<?php

    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require("../db/db_connect.php");
    require("../session.php");

?>

<?php

    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $memoNo     =   $_GET["memoNo"];
        $gen_date   =   $_GET["gen_date"];
        $prod_desc  =   $_GET["prod_desc"];
        $del_cd     =   $_GET["del_cd"];
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST")
    {
        //$memoNo         =   $_POST['memoNo'];
       //$gen_date       =   $_POST['gen_date'];
        //$del_cd         =   $_POST['del_cd'];
        $prod_desc      =   $_POST['prod_desc[]'];
        $amount         =   $_POST['amount'];
 
        $sql= "UPDATE td_allotment_sheet_np SET amount= '$amount', prod_desc= '$prod_desc'      
        WHERE memoNo= '$memoNo' AND gen_date= '$gen_date' AND del_cd= '$del_cd' ";
        $result= mysqli_query($db_connect, $sql);

        echo $sql;
 
        echo "<script>
                function alert_function()
                {
                    alert('Successfully Updated');
                    window.location.href='view_allot_sheet_np.php';
                } 
                alert_function();

            </script>";
         
            header("Location: view_allot_sheet_np.php"); 
    } 

    /*else
    {
        //header("Location: view_allot_sheet_np.php");
    }*/

?>

<?php
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $memoNo     =   $_GET["memoNo"];
        $gen_date   =   $_GET["gen_date"];
        $prod_desc  =   $_GET["prod_desc"];
        $del_cd     =   $_GET["del_cd"];
    

    //echo $gen_date; die;
    $sql= "SELECT amount FROM td_allotment_sheet_np WHERE memoNo = '$memoNo'
            AND gen_date= '$gen_date'
            AND prod_desc= '$prod_desc' ";
    
    //echo $memoNo; 

    $result= mysqli_query($db_connect,$sql);
    $row = mysqli_fetch_assoc($result);
    $amount= $row['amount'];

    $del_sql= "SELECT del_name FROM m_dealers
            WHERE del_cd = $del_cd";
    $del_result= mysqli_query($db_connect,$del_sql);
    $del_row = mysqli_fetch_assoc($del_result);
    
    //echo $row["del_name"]; die;
    //echo $del_cd; 
    //echo $sql;
    //echo "<pre>";
    //var_dump($row); 
    
     $prod_sl_sql= "SELECT sl_no FROM m_products
                    WHERE prod_desc= '$prod_desc' ";
        $prod_sl_result= mysqli_query($db_connect,$prod_sl_sql);
        $prod_sl_row= mysqli_fetch_assoc($prod_sl_result);
        $prod_sl_no= $prod_sl_row['sl_no'];
    
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

        $(document).ready(function() {

            var    effective_dt     =    $('.validate-input input[name = "effective_dt"]');
            var    memoNo            =    $('.validate-input input[name = "memoNo"]');
            var    del_cd            =    $('.validate-input input[name = "del_cd"]');
            var    prod_desc        =    $('.validate-input select[name = "prod_desc"]');

            showData(memoNo);
            showData(gen_date);
            showData(del_cd);
            
            
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

            }

            function hideAlertdate(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).removeClass('alert-data');

            }
        });

    </script>

<?php
        
      /*  $prod_sql= "SELECT * FROM td_allotment_sheet_np
                WHERE memoNo= '$memoNo' AND del_cd= '$del_cd'
                AND gen_date= '$gen_date'";
                                                    
        $prod_result= mysqli_query($db_connect,$prod_sql);
        $prod_row = mysqli_fetch_assoc($prod_result);   
        $prod_desc= $prod_row['prod_desc']; */

        //echo count($row['prod_desc']); die;
        //echo  $prod_sql; die;
        //echo $row['prod_desc']; die;

    ?>
    
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

                                UPDATE NON PDS Allotment Sheet

                            </span>

                            <div class="wrap-input1 validate-input" data-validate="Memo No is required" data-alert="Momo No." >

                                <input type="text" class="input1" name="memoNo" value="<?php echo $memoNo; ?>" placeholder="Memo No" readonly />

                                <span class="shadow-input1"></span>

                            </div>
                            
                            <div class="wrap-input1 validate-input" data-validate="Date is required" data-alert="Effective Date" >

                                <input type="text" class="input1" name="gen_date" id= "gen_date" value="<?php echo $gen_date; ?>" readonly/>

                                <span class="shadow-input1"></span>

                            </div>
                            <div class="wrap-input1 validate-input" data-validate="Dealer Name is required" data-alert="Dealer Name" >

                               <!-- <select class= "w3-input w3-border" name="del_cd" value="<?php //echo ("<option value= '".$row["del_cd"]."' > ".$row["del_cd"]. " > " .$row["del_name"]." </option>"); ?>" required> -->
                               
                               <input type="text" class="input1" name="del_cd" value="<?php echo $del_row['del_name'] ?>" readonly/>   
                                <span class="shadow-input1"></span>

                            </div>
                            <br>

                        <table class="table table-bordered">
                                
                            <tr>
                                <div>
                                    
                                    <td><button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i>Add Row</button> </td>
                                    <td> <button  type= "submit" class="btn btn-success"> Save </button></td>
                                </div>
                            </tr>
                        </table>

                            <table id= "intro">
                            
                                <div class="w3-row-padding" data-validate= "Product name is required">
                                   
                                    <td>
                                        <select class= "w3-input w3-border" name="prod_desc" id="prod_desc" required>
             
                                               <!-- <option value=""><?php// echo  '.$prod_sl_no. ' " " '.$prod_desc.' ; ?></option> -->

                                                <?php

                                                    echo ('<option value="'.$prod_desc.'">'.$prod_sl_no.' ' .$prod_desc.'</option>') ;
                                                    require("add_row.php");
                                            
                                                ?>

                                        </select>
                                    </td>

                                    <td>  
                                        <input type= "text" class= "w3-input w3-border"  name= "amount" value= "<?php echo $amount; ?>" placeholder="Amount"/>
                                        <span class="shadow-input1"></span>
                                    </td>
                                    
                                </div>
                            
                            </table>
                    
                        </form>

                    </div>

                </div>     

            </div>

        </div>

        <script>

            $(document).ready(function(){
            
                $("#addrow").click(function(){

                    var newElement= '<tr><td><select class= "w3-input w3-border" name="prod_desc[]" id="prod_desc"><option value="">Select Product</option><?php  require("add_row.php"); ?></select></td>  <td><input type= "text" class= "w3-input w3-border"  name= "amount[]" placeholder="Amount"/><span class="shadow-input1"></span></td> <td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td> </tr>';
                                                           
                    $("#intro").append($(newElement));
                                                                  
                });

                $("#intro").on("click","#removeRow", function(){

                    $(this).parent().parent().remove();
                });
            });

        </script>

        <script src="../js/collapsible.js"></script>

    </body>
    
</html>



