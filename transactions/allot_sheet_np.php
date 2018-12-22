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

   <!-- <script>  
        
        $(document).ready(function(){

            $('#del_name').change(function(){
            
                $.get(
                        $del_name = $_GET['del_name'];
                        $select_del= "SELECT del_cd FROM m_dealers WHERE del_name = '$del_name'";
                        $result=mysqli_query($db_connect,$select_del);

                        $data = mysqli_fetch_assoc($result);
                        echo $data['del_cd'];
                        
                    {
                        "del_name": $(this).val()

                    }
                )

                .done(function(data){
                // $.each(JSON.parse(data), function( index, value )
                //console.log(data);
                    $('#del_cd').val(data); 
                    
                });
        
            });

        });

    </script> -->

    <script>

        $(document).ready(function() {

            var    effective_dt     =    $('.validate-input input[name = "effective_dt"]');
            var    memoNo            =    $('.validate-input input[name = "memoNo"]');
            var    del_cd            =    $('.validate-input input[name = "del_cd"]');
            var    prod_desc        =    $('.validate-input select[name = "prod_desc"]');

            showData(effective_dt);
            showData(memoNo);
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
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            
            //echo "<pre>";
            //var_dump();
            $memoNo         =     $_POST["memoNo"];
            $effective_dt   =     $_POST["effective_dt"];
            $del_cd         =     $_POST["del_cd"];
            $prod_desc      =     $_POST["prod_desc"];
            $amount         =     $_POST["amount"];
            $prod_count     =     count($prod_desc);
            $amount_count   =     count($amount);

            for ($i=0; $i< count($prod_desc); $i++)
            {
                
               // echo $prod_desc[$i].'<br>';
              //  echo $amount[$i].'<br>';
            
            /*$memoNo       =     $_POST["memoNo"];
            $effective_dt =     $_POST["effective_dt"];
            $del_cd       =     $_POST["del_cd"];
            $prod_desc    =     
            $amount       =     $_POST["amount"];
            $prod_count   =     count($prod_desc);
            $amount_count =     count($amount);
           // echo $prod_count; 
           // echo $amount_count;
           //echo $prod_desc;
           //echo $amount;

           $Prod_Desc = implode(' ', $prod_desc);
           $Amount = implode(' ', $amount);

           // var_dump($prod_desc);
            //var_dump($amount);*/
           
                $sql="insert into td_allotment_sheet_np(memoNo,
                                                gen_date,
                                                del_cd,
                                                prod_desc,
                                                amount)
                                        values('$memoNo',
                                                '$effective_dt',
                                                '$del_cd',
                                                '$prod_desc[$i]',
                                                $amount[$i])";                        
                $result=mysqli_query($db_connect,$sql);	
                //echo $sql; 
            
            //echo $sql; die();

           /* if($result){
				$_SESSION['ins_flag']=true;
                Header("Location:allot_sheet_view_np.php");
            }*/
            }
        
        }
    
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

                                NON PDS Allotment Sheet

                            </span>
                            <div class="wrap-input1 validate-input" data-validate="Memo No is required" data-alert="Momo No." >

                                <input type="text" class="input1" name="memoNo" id="memoNo" placeholder="Memo No" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Date is required" data-alert="Effective Date" >

                                <input type="date" class="input1" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Dealer Name is required" data-alert="Dealer Name" >

                                <select class="input1" name="del_cd" id="del_cd" required>
                                                
                                    <option value="0">Select Dealer Name</option>

                                    <?php
                                        $select_del= "SELECT del_name, del_cd FROM m_dealers";
                                        $result=mysqli_query($db_connect,$select_del);

                                        while($row=mysqli_fetch_assoc($result)){
                                            echo ("<option value= '".$row["del_cd"]."' > ".$row["del_cd"]. " > " .$row["del_name"]." </option>");

                                        }
                                    ?>

                                </select>
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
                                            <select class= "w3-input w3-border" name="prod_desc[]" id="prod_desc" required>
                                                
                                                <option value="">Select Product</option>

                                                <?php

                                                    require("add_row.php");
                                                
                                                ?>

                                            </select>
                                        </td>

                                        <td>  
                                            <input type= "text" class= "w3-input w3-border"  name= "amount[]" placeholder="Amount"/>
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