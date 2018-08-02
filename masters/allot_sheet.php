<?php
ini_set("display_errors","1");
error_reporting(E_ALL);

require("../db/db_connect.php");
require("../session.php");

if ($_SERVER["REQUEST_METHOD"]=="POST") {

        $user_name    =   $_SESSION['user_id'];
        $sysDate      =   date('Y-m-d');
        $memoNo	      =	  $_POST["memoNo"];
        $date	      =	  $_POST["effective_dt"];
        $alt_month    =   substr($date,5,2);
        $alt_year     =   substr($date,0,4);
        $mrNo         =   $_POST['mr_no'];
        $dealer_name  =   $_POST['dealer_name'];
        $region       =   $_POST['region'];

        $aay_unit     =   $_POST["aay"];
        $aay_rice     =   $_POST['aay_rice'];
        $aay_atta     =   $_POST['aay_atta'];
        $aay_sugar    =   $_POST['aay_sugar'];

        $phh_unit     =   $_POST['phh'];
        $phh_rice     =   $_POST['phh_rice'];
        $phh_atta     =   $_POST['phh_atta'];

        $sphh_unit    =   $_POST['sphh'];
        $sphh_rice    =   $_POST['sphh_rice'];
        $sphh_atta    =   $_POST['sphh_atta'];
        $sphh_sugar   =   $_POST['sphh_sugar'];

        $rksy1_unit   =   $_POST['rksy1'];
        $rksy1_rice   =   $_POST['rksy1_rice'];
        $rksy1_atta   =   $_POST['rksy1_atta'];

        $rksy2_unit   =   $_POST['rksy2'];
        $rksy2_rice   =   $_POST['rksy2_rice'];
        $rksy2_atta   =   $_POST['rksy2_atta'];




        for ($i = 0; $i < count($mrNo); $i++) {

            $sql = "INSERT INTO td_allotment_sheet ( memo_no,
                                                     alt_month,
                                                     alt_year,
                                                     gen_date,
                                                     mr_no,
                                                     delr_name,
                                                     delr_region,
                                                     aay_family,
                                                     aay_rice,
                                                     aay_wheat,
                                                     aay_sugar,
                                                     phh_head,
                                                     phh_rice,
                                                     phh_wheat,
                                                     sphh_head,
                                                     sphh_rice,
                                                     sphh_wheat,
                                                     sphh_sugar,
                                                     rksy1_head,
                                                     rksy1_rice,
                                                     rhsy1_wheat,
                                                     rksy2_head,
                                                     rksy2_rice,
                                                     rksy2_wheat,
                                                     created_by,
                                                     created_dt ) VALUES ( '$memoNo',
                                                                            $alt_month,
                                                                            $alt_year,
                                                                            '$date',
                                                                            $mrNo[$i],
                                                                            '$dealer_name[$i]',
                                                                            '$region[$i]',
                                                                            $aay_unit[$i],
                                                                            $aay_rice[$i],
                                                                            $aay_atta[$i],
                                                                            $aay_sugar[$i],
                                                                            $phh_unit[$i],
                                                                            $phh_rice[$i],
                                                                            $phh_atta[$i],
                                                                            $sphh_unit[$i],
                                                                            $sphh_rice[$i],
                                                                            $sphh_atta[$i],
                                                                            $sphh_sugar[$i],
                                                                            $rksy1_unit[$i],
                                                                            $rksy1_rice[$i],
                                                                            $rksy1_atta[$i],
                                                                            $rksy2_unit[$i],
                                                                            $rksy2_rice[$i],
                                                                            $rksy2_atta[$i],
                                                                            '$user_name',
                                                                            '$sysDate')";

            mysqli_query($db_connect, $sql);
        }

        echo "<script>alert('Allotment Sheet Created');</script>";

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


    <script>

        $(document).ready(function() {

            $('.defaultHide').hide();

            $('#form').submit(function(e) {
                //e.preventDefault();
                var prod_desc = $('#prod_desc').val(),
                    prod_catg = $('#prod_catg').val(),
                    per_unit  = $('#per_unit').val(),
                    unit_val  = $('#unit_val').val();

                $(".error").remove();


                if (prod_desc == 0) {
                    e.preventDefault();
                    $('#prod_desc').after('<span class="error">Invalid Input</span>');
                }

                if (prod_catg == 0) {
                    e.preventDefault();
                    $('#prod_catg').after('<span class="error">Invalid Input</span>');
                }

                if(per_unit.length < 1) {
                    e.preventDefault();
                    $('#per_unit').after('<span class="error">Invalid Input</span>');
                }

                if(unit_val.length < 1) {
                    e.preventDefault();
                    $('#unit_val').after('<span class="error">Invalid Input</span>');
                }
            });

            $('#effective_dt').on("change", function() {
                var today = new Date();

                var to_date = $('#effective_dt').val().split("-");

                var mydate = new Date(to_date[0], to_date[1] - 1, to_date[2]);
                if (mydate > today) {
                    alert("Arrival date can't be greater than system date!");
                    $('#effective_dt').val('');
                    return false;
                }
            });

            $('#prod_catg').change(function () {

                $('#per_unit').val($(this).find(':selected').attr('data-val'));

            });


        });
    </script>

    <script>

        $(document).ready(function(){

            // Declaring global_var to store allotment scale input....

            var global_var;

            $.ajax({

                url:"../fetch/allot_scale_dtls.php",

                type:"get"

            }).done( function ( result ) {

                global_var = JSON.parse(result);

                console.log(global_var);

            });

        // Row add....

            $('#addRow').click(function () {

                $('#intro').append('<tr>\n' +
                    '            <td><input type="text" name="mr_no[]" class="input2 mr_no" style="width:50px" /></td>\n' +
                    '            <td><input type="text" name="dealer_name[]" class="input2 dealer_name" style="width:150px" readonly/></td>\n' +
                    '            <td><input type="text" name="region[]" class="input2 region" style="width:150px" readonly></td>\n' +
                    '\n' +
                    '            <td><input type="number" name="aay[]" class="input2 aay" style="width:75px"/></td>\n' +
                    '            <td><input type="text" name="aay_rice[]" class="input2 aay_rice" style="width:75px"></td>\n' +
                    '            <td><input type="text" name="aay_atta[]" class="input2 aay_atta" style="width:75px" /></td>\n' +
                    '            <td><input type="text" name="aay_sugar[]" class="input2 aay_sugar" style="width:75px" /></td>\n' +
                    '\n' +
                    '            <td><input type="number" name="phh[]" class="input2 phh" style="width:75px"/></td>\n' +
                    '            <td><input type="text" name="phh_rice[]" class="input2 phh_rice" style="width:75px" /></td>\n' +
                    '            <td><input type="text" name="phh_atta[]" class="input2 phh_atta" style="width:75px" /></td>\n' +
                    '\n' +
                    '            <td><input type="number" name="sphh[]" class="input2 sphh" style="width:75px"/></td>\n' +
                    '            <td><input type="text" name="sphh_rice[]" class="input2 sphh_rice" style="width:75px"></td>\n' +
                    '            <td><input type="text" name="sphh_atta[]" class="input2 sphh_atta" style="width:75px" /></td>\n' +
                    '            <td><input type="text" name="sphh_sugar[]" class="input2 sphh_sugar" style="width:75px" /></td>\n' +
                    '\n' +
                    '            <td><input type="number" name="rksy1[]" class="input2 rksy1" style="width:75px"/></td>\n' +
                    '            <td><input type="text" name="rksy1_rice[]" class="input2 rksy1_rice" style="width:75px" /></td>\n' +
                    '            <td><input type="text" name="rksy1_atta[]" class="input2 rksy1_atta" style="width:75px" /></td>\n' +
                    '\n' +
                    '            <td><input type="number" name="rksy2[]" class="input2 rksy2" style="width:75px"/></td>\n' +
                    '            <td><input type="text" name="rksy2_rice[]" class="input2 rksy2_rice" style="width:75px"></td>\n' +
                    '            <td><input type="text" name="rksy2_atta[]" class="input2 rksy2_atta" style="width:75px" /></td>\n' +
                    '\n' +
                    '        </tr>');
            });


        // Dealers details fetch and show....

            $('#intro').on('change', '.mr_no', function () {

                var mr_no = $(this).val(),
                    index_no = $('.mr_no').index(this);

                $.ajax({
                    url:"../fetch/dealers_dtls.php",
                    data:  { mr_no: mr_no },
                    dataType:'json',
                    type: 'POST'

                }).done( function(result) {

                    console.log(result);

                    $('.dealer_name').eq(index_no).val(result.del_name);

                    $('.region').eq(index_no).val(result.del_reg);

                });

            });


        // AAY unit-value setup....

            $('#intro').on('change', '.aay', function(){

                var aay_data = $(this).val(),
                    aay_index_no = $('.aay').index(this);

                $('.aay_rice').eq(aay_index_no).val((aay_data * global_var.unit_val[0] / 100).toFixed(2));
                $('.aay_sugar').eq(aay_index_no).val((aay_data * global_var.unit_val[1] / 100).toFixed(2));
                $('.aay_atta').eq(aay_index_no).val((aay_data * global_var.unit_val[2] / 100).toFixed(2));

            });

        // PHH unit-value setup....

            $('#intro').on('change', '.phh', function(){

                var phh_data = $(this).val(),
                    phh_index_no = $('.phh').index(this);

                $('.phh_rice').eq(phh_index_no).val((phh_data * global_var.unit_val[3] / 100).toFixed(2));
                $('.phh_atta').eq(phh_index_no).val((phh_data * global_var.unit_val[4] / 100).toFixed(2));

            });

            // SPHH unit-value setup....

            $('#intro').on('change', '.sphh', function(){

                var sphh_data = $(this).val(),
                    sphh_index_no = $('.sphh').index(this);

                $('.sphh_rice').eq(sphh_index_no).val((sphh_data * global_var.unit_val[9] / 100).toFixed(2));
                $('.sphh_sugar').eq(sphh_index_no).val((sphh_data * global_var.unit_val[10] / 100).toFixed(2));
                $('.sphh_atta').eq(sphh_index_no).val((sphh_data * global_var.unit_val[11] / 100).toFixed(2));

            });

            // RKSY-I unit-value setup....

            $('#intro').on('change', '.rksy1', function(){

                var rksy1_data = $(this).val(),
                    rksy1_index_no = $('.rksy1').index(this);

                $('.rksy1_rice').eq(rksy1_index_no).val((rksy1_data * global_var.unit_val[5] / 100).toFixed(2));
                $('.rksy1_atta').eq(rksy1_index_no).val((rksy1_data * global_var.unit_val[6] / 100).toFixed(2));

            });

            // RKSY-II unit-value setup....

            $('#intro').on('change', '.rksy2', function(){

                var rksy2_data = $(this).val(),
                    rksy2_index_no = $('.rksy2').index(this);

                $('.rksy2_rice').eq(rksy2_index_no).val((rksy2_data * global_var.unit_val[7] / 100).toFixed(2));
                $('.rksy2_atta').eq(rksy2_index_no).val((rksy2_data * global_var.unit_val[8] / 100).toFixed(2));

            });

            $('#undoAayRice').click(function(){
                $('.aay_rice').val('0.00');
            });
            $('#undoAayAtta').click(function(){
                $('.aay_atta').val('0.00');
            });
            $('#undoAaySugar').click(function(){
                $('.aay_sugar').val('0.00');
            });
            $('#undoPhhRice').click(function(){
                $('.phh_rice').val('0.00');
            });
            $('#undoPhhAtta').click(function(){
                $('.phh_atta').val('0.00');
            });
            $('#undoSphhRice').click(function(){
                $('.sphh_rice').val('0.00');
            });
            $('#undoSphhAtta').click(function(){
                $('.sphh_atta').val('0.00');
            });
            $('#undoSphhSugar').click(function(){
                $('.sphh_sugar').val('0.00');
            });
            $('#undoRksy1Rice').click(function(){
                $('.rksy1_rice').val('0.00');
            });
            $('#undoRksy1Atta').click(function(){
                $('.rksy1_atta').val('0.00');
            });
            $('#undoRksy2Rice').click(function(){
                $('.rksy2_rice').val('0.00');
            });
            $('#undoRksy2Atta').click(function(){
                $('.rksy2_atta').val('0.00');
            });

        });

    </script>

    <style>

        .inline {

            display: inline;
        }

    </style>


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

                                <div class="wrap-input1 validate-input" data-validate="Date is required">

                                    <input type="text" class="input1" name="memoNo" id="memoNo" placeholder="Memo No" />

                                    <span class="shadow-input1"></span>

                                </div>


                                <div class="wrap-input1 validate-input" data-validate="Date is required">

                                    <input type="date" class="input1" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" />

                                    <span class="shadow-input1"></span>

                                </div>


                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <div class="col-lg-12 col-md-6">

                            <div class="container-contact2" style="margin-left: 0">

                                <div class="contact2-form" style="margin-bottom: 20px; margin-top: 10px ">

                                    <div class="container-contact2-form-btn">

                                        <button type="button" class="contact2-form-btn" id="addRow" >

                                        <span>

                                            Add New Row

                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                        </span>

                                        </button>

                                    </div>

                                </div>


                                <table id="intro" class="table table-bordered table-hover">

                                    <thead style="background-color: #212529; color: #fff;">

                                    <tr>

                                        <th>MR No</th>
                                        <th>Dealer Name</th>
                                        <th>Region</th>

                                        <th>AAY<br>Family</th>
                                        <th><span class="inline"> Rice </span> <button type="button" class="anav inline" id="undoAayRice" > <i class="fa fa-undo" style="margin-left: 15px;"></i> </button></th>
                                        <th><span class="inline"> Wheat /<br>Atta </span> <button type="button" class="anav inline" id="undoAayAtta" > <i class="fa fa-undo" style="margin-left: 15px;"></i> </button></th>
                                        <th><span class="inline"> Sugar </span> <button type="button" class="anav inline" id="undoAaySugar" > <i class="fa fa-undo" style="margin-left: 15px;"></i> </button></th>

                                        <th>PHH<br>Head</th>
                                        <th><span class="inline"> Rice </span> <button type="button" class="anav inline" id="undoPhhRice" > <i class="fa fa-undo" style="margin-left: 15px;"> </i> </button> </th>
                                        <th><span class="inline"> Wheat/ <br>Atta </span> <button type="button" class="anav inline" id="undoPhhAtta" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>

                                        <th>SPHH<br>Head</th>
                                        <th><span class="inline"> Rice </span> <button type="button" class="anav inline" id="undoSphhRice"> <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>
                                        <th><span class="inline"> Wheat /<br>Atta </span> <button type="button" class="anav inline" id="undoSphhAtta" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>
                                        <th><span class="inline"> Sugar </span> <button type="button" class="anav inline" id="undoSphhSugar" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>

                                        <th>RKSY-I<br>Head</th>
                                        <th><span class="inline"> Rice </span> <button type="button" class="anav inline" id="undoRksy1Rice" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>
                                        <th><span class="inline"> Wheat /<br>Atta </span> <button type="button" class="anav inline" id="undoRksy1Atta" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>

                                        <th>RKSY-II<br>Head</th>
                                        <th><span class="inline"> Rice </span> <button type="button" class="anav inline" id="undoRksy2Rice" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>
                                        <th><span class="inline"> Wheat /<br>Atta </span> <button type="button" class="anav inline" id="undoRksy2Atta" >  <i class="fa fa-undo" style="margin-left: 15px;">  </button></th>

                                    </tr>

                                    </thead>

                                    <tbody style="text-align: right;">

                                    <tr>

                                        <td><input type="text" name="mr_no[]" class="input2 mr_no" /></td>
                                        <td><input type="text" name="dealer_name[]" class="input2 dealer_name" style="width:150px" readonly/></td>
                                        <td><input type="text" name="region[]" class="input2 region" style="width:150px" readonly/></td>

                                        <td><input type="number" name="aay[]" class="input2 aay" style="width:75px"/></td>
                                        <td><input type="text" name="aay_rice[]" class="input2 aay_rice" style="width:75px"></td>
                                        <td><input type="text" name="aay_atta[]" class="input2 aay_atta" style="width:75px" /></td>
                                        <td><input type="text" name="aay_sugar[]" class="input2 aay_sugar" style="width:75px" /></td>

                                        <td><input type="number" name="phh[]" class="input2 phh" style="width:75px"/></td>
                                        <td><input type="text" name="phh_rice[]" class="input2 phh_rice" style="width:75px" /></td>
                                        <td><input type="text" name="phh_atta[]" class="input2 phh_atta" style="width:75px" /></td>

                                        <td><input type="number" name="sphh[]" class="input2 sphh" style="width:75px"/></td>
                                        <td><input type="text" name="sphh_rice[]" class="input2 sphh_rice" style="width:75px"/></td>
                                        <td><input type="text" name="sphh_atta[]" class="input2 sphh_atta" style="width:75px" /></td>
                                        <td><input type="text" name="sphh_sugar[]" class="input2 sphh_sugar" style="width:75px" /></td>

                                        <td><input type="number" name="rksy1[]" class="input2 rksy1" style="width:75px"/></td>
                                        <td><input type="text" name="rksy1_rice[]" class="input2 rksy1_rice" style="width:75px" /></td>
                                        <td><input type="text" name="rksy1_atta[]" class="input2 rksy1_atta" style="width:75px" /></td>

                                        <td><input type="number" name="rksy2[]" class="input2 rksy2" style="width:75px"/></td>
                                        <td><input type="text" name="rksy2_rice[]" class="input2 rksy2_rice" style="width:75px"/></td>
                                        <td><input type="text" name="rksy2_atta[]" class="input2 rksy2_atta" style="width:75px" /></td>

                                    </tr>

                                    </tbody>

                                </table>

                                <div class="contact2-form" style="margin-bottom: 10px">

                                    <div class="container-contact2-form-btn">

                                        <button class="contact1-form-btn" >

                                        <span>

                                            Save

                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                                        </span>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <script src="../js/collapsible.js"></script>

    </body>

</html>
