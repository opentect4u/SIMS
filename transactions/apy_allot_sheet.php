<?php

    require("../db/db_connect.php");
    require("../session.php");

    if ($_SERVER["REQUEST_METHOD"]=="POST") 
    {

        $created_by      =      $_SESSION['user_id'];
        $created_dt      =      date('y-m-d H:i:s');
        $memo_no	     =	    $_POST["memoNo"];
        $effective_dt    =      $_POST["effective_dt"];
        $mr_no           =      $_POST["del_cd"];
        $apy_head        =      $_POST["apy_head"];
        $apy_rice        =      $_POST["apy_rice"];

        $sql = "INSERT INTO td_apy_allot_sheet(memo_no,
                                               gen_date,
                                               mr_no,
                                               apy_head,
                                               apy_rice,
                                               created_by,
                                               created_dt)
                                               VALUES ('$memo_no',
                                                        '$effective_dt',
                                                        '$mr_no',
                                                        '$apy_head',
                                                        '$apy_rice',
                                                        '$created_by',
                                                        '$created_dt')";

        //echo $sql; die;
        mysqli_query($db_connect, $sql);
        
    }

    //echo "<script>alert('Allotment Sheet Created');</script>";
    //Header("Location:apy_allot_sheet.php");

    /*echo "<script> alert('Successfully Saved');
                document.location= 'apy_allot_sheet.php' </script>"; */

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

</head>








<body class="body">

<?php require '../post/nav.php'; ?>

<h1 class='elegantshadow'>Laxmi Narayan Stores</h1>

<hr class='hr'>

<div class="container" style="margin-left: 10px">

    <div class="row">

        <div class="col-lg-4 col-md-6">

            <?php require("../post/menu.php"); ?>

        </div>

        <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="col-lg-8 col-md-6">

                <div class="container-contact1">

                    <div class="contact1-form">

                        <div class="wrap-input1 validate-input" data-validate="Memo No is required" data-alert="Momo No." >

                            <input type="text" class="input1" name="memoNo" id="memoNo" placeholder="Memo No" />

                            <span class="shadow-input1"></span>

                        </div>


                        <div class="wrap-input1 validate-input" data-validate="Date is required" data-alert="Effective Date" >

                            <input type="date" class="input1" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" />

                            <span class="shadow-input1"></span>

                        </div>

                       <!-- <div class="wrap-input1 validate-input" data-validate="mr_no is required" data-alert="Mr No" >

                            <input type="text" class="input1" name="mr_no" id="mr_no"  placeholder="Mr No"/>

                            <span class="shadow-input1"></span>

                        </div> -->

                      <!--  <div class="wrap-input1 validate-input" data-validate=" Dealer name is required" data-alert="Dealer Name" >

                            <input type="text" class="input1" name="delr_name" id="delr_name"  placeholder="Dealer" readonly/>

                            <span class="shadow-input1"></span>

                        </div> -->

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


                      <!--  <div class="wrap-input1 validate-input" data-validate=" Dealer region is required" data-alert="Dealer reagion" >

                            <input type="text" class="input1" name="delr_region" id="delr_region"  placeholder="Dealer Reagion" readonly/>

                            <span class="shadow-input1"></span>

                        </div> -->


                        <div class="wrap-input1 validate-input" data-validate="APY Unit is required" data-alert="Apy Unit" >

                            <input type="text" class="input1" name="apy_head" id="apy_head"  placeholder="APY Unit" />

                            <span class="shadow-input1"></span>

                        </div>

                        <div class="wrap-input1 validate-input" data-validate="APY Rice is required" data-alert="Apy Rice" >

                            <input type="text" class="input1" name="apy_rice" id="apy_rice"  placeholder="APY Rice" readonly />

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


                    </div>

                </div>

            </div>


            

        </form>

    </div>

</div>

 <script src="../js/collapsible.js"></script> 

<script>

    $(document).ready( function () {

        $('#memoNo').change( function () {

            var pattern = "<?php// echo $pattern ?>";

            if ($(this).val().trim() === pattern.trim()) {


            }

            else {

                if(! confirm('Pattern Doesn\'t match. Do you want to continue?')) {

                    $(this).val('');

                }

            }

        });

    });

</script> 

<script>

    $(document).ready(function(){
        $('#apy_head').change(function() {

            $.get("../fetch/allot_scale_apy.php")

            .done(
                function(data)
                {
                    //console.log(data);
                    var apy_head_val = $('#apy_head').val();
                    //console.log(data1);
                    var apy_scl = JSON.parse(data);
                    //console.log(apy_scl*apy_head_val);
                    $('#apy_rice').val(apy_scl*apy_head_val);

                }
            );

        });

    });

</script>

</body>

</html>


