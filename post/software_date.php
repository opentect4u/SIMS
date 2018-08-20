<?php

    require("../db/db_connect.php");
    require("../session.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $transdt	=	DateTime::createFromFormat('d-m-Y', $_POST["effective_dt"]);

        $transdt    =   $transdt->format('Y-m-d');

        $sql    =   "UPDATE m_params SET param_value = '$transdt'
                                     WHERE paran_no = 7";

        mysqli_query($db_connect, $sql);

        header("Location: ./dashboard.php");

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

</head>

<body class="body">

<?php require '../post/nav.php'; ?>


<h1 class='elegantshadow'>Laxmi Narayan Stores</h1>

<hr class='hr'>

<div class="container" style="margin-left: 10px">

    <div class="row">

        <div class="col-lg-4 col-md-6">

            <?php require("../post/menu.php");

            $effective_date = f_getparamval(7, $db_connect);

            ?>

        </div>

        <div class="col-lg-8 col-md-6">

            <div class="container-contact1">

                <form class="contact1-form validate-form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                            <span class="contact1-form-title">

                               Software Date Setup

                            </span>

                    <div class="wrap-input1 validate-input" data-validate="Date is required" data-alert="Effective Date">

                        <input type="text"

                               class="input1"

                               name="effective_dt"

                               id="effective_dt"

                               value="<?php echo date("d-m-Y", strtotime(f_getparamval(7, $db_connect))) ?>"

                               placeholder="DD-MM-YYYY" />

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

<script>

    $(document).ready(function() {

        $('#effective_dt').on("change", function() {

            var today = new Date("<?php echo $effective_date ?>");

            var to_date = $('#effective_dt').val().split("-").reverse().join("-");

            var mydate = new Date(to_date);

            if (mydate < today) {

                alert("Given date can't be less than Application date!");

                $('#effective_dt').val('');

                return false;
            }
        });

    });

</script>

</body>

</html>