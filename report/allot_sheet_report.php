<?php

    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require("../db/db_connect.php");
    require("../session.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_SESSION['memo_no'] = $_POST['memo_no'];

        header("Location: ../bill/allotment_sheet_report.php");

    }


    $sql = "SELECT DISTINCT memo_no FROM td_allotment_sheet
                                    WHERE approval_status = 'A'";

    $result = mysqli_query($db_connect, $sql);

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

    <script>

        $(document).ready(function() {

            var    memo_no        =    $('.validate-input select[name = "memo_no"]');

            $('#form').submit(function(e) {

                var check = true;

                if($(memo_no).val().trim() == '0') {

                    showValidate(memo_no);

                    check=false;

                }

                return check;

            });



            $('.validate-form .input1').each(function(){

                $(this).focus(function(){

                    hideValidate(this);

                });

            });



            function showValidate(input) {

                var thisAlert = $(input).parent();

                //console.log($(input).parent());

                $(thisAlert).addClass('alert-validate');

            }

            function hideValidate(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).removeClass('alert-validate');
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

                               Memo No.

                            </span>

                            <div class="wrap-input1 validate-input" data-validate="Memo No is required">

                                <select class="input1" name="memo_no">

                                    <option value="0">Select Memo No.</option>

                                    <?php

                                    while($row=mysqli_fetch_assoc($result)){

                                        echo ("<option value='".$row["memo_no"]."'>".$row["memo_no"]."</option>") ;

                                    }

                                    ?>

                                </select>

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

        <script src="../js/collapsible.js"></script>

    </body>

</html>
