<?php
    ini_set("display_errors","1");
    error_reporting("E_ALL");
   
    require("../db/db_connect.php");
    require("../session.php");

    $prodtypeErr="";

    if($_SERVER['REQUEST_METHOD']=="GET"){

        $effective_dt	=	$_GET['effective_dt'];
        $prod_desc	    =	$_GET['prod_desc'];

        $sql= "SELECT effective_dt,
                    prod_desc,
                    prod_cd,
                    per_unit,
                    prod_rate
                FROM m_rate_master_np
                WHERE effective_dt  =   '$effective_dt'
                AND prod_desc       =   '$prod_desc' ";
        
        $result= mysqli_query($db_connect,$sql);

        if($result){
            if(mysqli_num_rows($result) > 0){

                while($row=mysqli_fetch_assoc($result)){

                    $effective_dt	=	$row['effective_dt'];
                    $prod_desc	    =	$row['prod_desc'];
                    $prod_cd 	    =	$row['prod_cd'];
                    $per_unit	    =	$row['per_unit'];
                    $prod_rate	    =	$row['prod_rate'];
                    	
                }	
            }
        }	

    }

   if($_SERVER["REQUEST_METHOD"]=="POST"){

       /* $effective_dt	=	0;
        $prod_desc	    =	0;
        $prod_cd	    =	0;
        $per_unit	    =	0;
        $prod_rate	    =	0;
        $prod_type	    =	0; */
        
        $effective_dt	    =	    test_input($_POST['effective_dt']);
        $prod_desc	        =	    test_input($_POST['prod_desc']);
        $prod_cd	        =	    test_input($_POST['prod_cd']);
        $per_unit 	        =	    test_input($_POST['unit']);
        $prod_rate 	        =	    test_input($_POST['prod_rate']);
        $prod_type	        =	    test_input($_POST['prod_type']);
       
        //echo $per_unit;
        //echo $prod_rate;

        $user	=	$_SESSION['user_id'];
        $time	=	date("Y-m-d h:i:s");
   
            $update="Update m_rate_master_np
                set effective_dt        =   '$effective_dt',
                    per_unit            =   '$per_unit',
                    prod_rate           =   $prod_rate,
                    modified_by         =   '$user',
                    modified_dt         =   '$time'
                where prod_desc         =   '$prod_desc'
                and   prod_cd           =   $prod_cd";

                //echo $update; die();
                    
            $result	= mysqli_query($db_connect,$update);
        

            if($result){
               // $_SESSION['edit_in']="true";
                Header("Location:../masters/rate_master_np_view.php");
            }
    } 

    function test_input($data) {

        $data = trim($data);

        return $data;

    }


?>

<html>
    <head>

    <title>Synergic Inventory Management System-Add Product Rate</title>

        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="../css/form_design.css">
        <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="../css/autocomplete_style.css">

         <!--jQuery library-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- JQuery Autocomplete -->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </head>

    <script>

        $(document).ready(function() {

            var    prod_desc        =    $('.validate-input input[name = "prod_desc"]');
            var    prod_cd          =    $('.validate-input select[name = "prod_cd"]');
            var    unit             =    $('.validate-input input[name = "unit"]');
            var    prod_rate        =    $('.validate-input input[name = "prod_rate"]');
            var    effective_dt     =    $('.validate-input input[name = "effective_dt"]');
            var    prod_type        =    $('.validate-input input[name = "prod_type"]');

            $('#form').submit(function(e) {

                var check = true;

                $('.validate-form .input1').each(function(){

                    hideAlertdate(this);

                });

                if($(prod_desc).val().trim() == '0') {

                    showValidate(prod_desc);

                    check = false;

                }

                /*if($(prod_catg).val() == '0') {

                    showValidate(prod_catg);

                    check = false;

                }*/

                if($(per_unit).val() == '0') {

                    showValidate(per_unit);

                    check = false;
                }

                if($(prod_rate).val() < '0') {

                    showValidate(prod_rate);

                    check = false;

                }

                return check;

            });

            showData(prod_desc);
            showData(prod_cd);
            showData(unit);
            showData(prod_rate);
            showData(effective_dt);
            showData(prod_type);

            $('.validate-form .input1').each(function(){

                $(this).focus(function(){

                    hideValidate(this);

                });

            });

            function showData(input) {

                var thisAlert = $(input).parent();

                $(thisAlert).addClass('alert-data');

            }

            function showValidate(input) {

                var thisAlert = $(input).parent();

                //console.log($(input).parent());

                $(thisAlert).addClass('alert-validate');

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

                                NP Product's Rate

                            </span>

                            <div class="wrap-input1 validate-input" data-alert="Effective Date" >

                                <input type="date" class="input1" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" readonly />

                                <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-validate="Product name is required" data-alert="Product Name">

                                   <input type= "text" class="input1" id= "prod_desc" value= "<?php echo  $prod_desc;?>" name= "prod_desc" readonly/>

                                    <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Serial No.">

                                    <input type= "text" class="input1" value= "<?php echo $prod_cd; ?> " name= "prod_cd" id="prod_cd" readonly />

                                    <span class="shadow-input1"></span>

                            </div>

                            <div class="wrap-input1 validate-input" data-alert="Product Type" >

                                <input  class="input1" name="prod_type" id="prod_type" value= "NON PDS" readonly />

                                <span class="shadow-input1"></span>

                            </div>
   

                            <div class="wrap-input1 validate-input" data-validate="Unit type is required" data-alert="unit" >

                                <select class="input1" name="unit" id="unit">
   
                                    <option value="Kg" <?php echo ('Kg' == $per_unit)?'selected':''; ?>> Kg </option>
                                    <option value="Cs" <?php echo ('Cs' == $per_unit)?'selected':''; ?>> Cs </option>
                                    <option value="Pieces" <?php echo ('Pieces' == $per_unit)?'selected':''; ?>> Pieces </option>
                                    <option value="Bags/Tin" <?php echo ('Bags/Tin' == $per_unit)?'selected':''; ?>> Bags/Tin </option>
                                
                                </select>

                            </div>
        
                            <div class="wrap-input1 validate-input" data-validate="Rate is required" data-alert="Product Rate" >

                                <input type="text" class="input1" name="prod_rate" id="prod_rate" value="<?php echo $prod_rate; ?>">

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