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
    $aay_wheat    =   $_POST['aay_wheat'];
    $aay_atta     =   $_POST['aay_atta'];
    $aay_sugar    =   $_POST['aay_sugar'];

    $phh_unit     =   $_POST['phh'];
    $phh_rice     =   $_POST['phh_rice'];
    $phh_atta     =   $_POST['phh_atta'];
    $phh_wheat    =   $_POST['phh_wheat'];

    $sphh_unit    =   $_POST['sphh'];
    $sphh_rice    =   $_POST['sphh_rice'];
    $sphh_atta    =   $_POST['sphh_atta'];
    $sphh_wheat   =   $_POST['sphh_wheat'];
    $sphh_sugar   =   $_POST['sphh_sugar'];

    $rksy1_unit   =   $_POST['rksy1'];
    $rksy1_rice   =   $_POST['rksy1_rice'];
    $rksy1_atta   =   $_POST['rksy1_atta'];
    $rksy1_wheat  =   $_POST['rksy1_wheat'];

    $rksy2_unit   =   $_POST['rksy2'];
    $rksy2_rice   =   $_POST['rksy2_rice'];
    $rksy2_wheat  =   $_POST['rksy2_wheat'];
    $rksy2_atta   =   $_POST['rksy2_atta'];

    $sql = "DELETE FROM td_allotment_sheet WHERE memo_no = '$memoNo'";

    mysqli_query($db_connect, $sql);

    unset($sql);

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
                                                 aay_atta,
                                                 aay_sugar,
                                                 phh_head,
                                                 phh_rice,
                                                 phh_wheat,
                                                 phh_atta,
                                                 sphh_head,
                                                 sphh_rice,
                                                 sphh_wheat,
                                                 sphh_atta,
                                                 sphh_sugar,
                                                 rksy1_head,
                                                 rksy1_rice,
                                                 rksy1_wheat,
                                                 rksy1_atta,
                                                 rksy2_head,
                                                 rksy2_rice,
                                                 rksy2_wheat,
                                                 rksy2_atta,
                                                 created_by,
                                                 created_dt ) VALUES ( '$memoNo',
                                                                            $alt_month,
                                                                            $alt_year,
                                                                           '$date',
                                                                           '$mrNo[$i]',
                                                                           '$dealer_name[$i]',
                                                                           '$region[$i]',
                                                                            $aay_unit[$i],
                                                                            $aay_rice[$i],
                                                                            $aay_wheat[$i],
                                                                            $aay_atta[$i],
                                                                            $aay_sugar[$i],
                                                                            $phh_unit[$i],
                                                                            $phh_rice[$i],
                                                                            $phh_wheat[$i],
                                                                            $phh_atta[$i],
                                                                            $sphh_unit[$i],
                                                                            $sphh_rice[$i],
                                                                            $sphh_wheat[$i],
                                                                            $sphh_atta[$i],
                                                                            $sphh_sugar[$i],
                                                                            $rksy1_unit[$i],
                                                                            $rksy1_rice[$i],
                                                                            $rksy1_wheat[$i],
                                                                            $rksy1_atta[$i],
                                                                            $rksy2_unit[$i],
                                                                            $rksy2_rice[$i],
                                                                            $rksy2_wheat[$i],
                                                                            $rksy2_atta[$i],
                                                                           '$user_name',
                                                                           '$sysDate')";


        mysqli_query($db_connect, $sql);
    }

    echo "<script>alert('Allotment Sheet Updated');</script>";

}


$sql = "SELECT DISTINCT memo_no FROM td_allotment_sheet
                                    WHERE approval_status = 'U' ";

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

        var memoNo          =   $('.validate-input select[name = "memoNo"]'),
            effective_dt    =   $('.validate-input input[name = "effective_dt"]');

        $('#form').submit(function(e) {

            var check = true;

            $('.validate-input .input1').each(function(){

                hideAlertdate(this);

            });

            if($(memoNo).val().trim() == '0') {

                showValidate(memoNo);

                check=false;
            }

            if($(effective_dt).val().trim() == '') {

                showValidate(effective_dt);

                check=false;
            }

            return check;

        });

        showData(memoNo);
        showData(effective_dt);

        $('.validate-input .input1').each(function() {

            $(this).focus(function() {

                hideValidate(this);

            });

        });

        function showData(input) {

            var thisAlert = $(input).parent();

            $(thisAlert).addClass('alert-data');

        }

        function showValidate(input) {

            var thisAlert = $(input).parent();

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

<script>

    $(document).ready(function() {

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

    });

</script>

<script>

    var className = "",
        targetId  = "";

    $(document).ready(function() {

        $('.hideFirst').hide();

        // Declaring global_var to store allotment scale input....

        var global_var;

        $.ajax({

            url:"../fetch/allot_scale_dtls.php",

            type:"post"

        }).done( function ( result ) {

            global_var = JSON.parse(result);

        });


        // Allotment sheet generation

        $('#memoNo').change( function () {

            var memo_no = $(this).val();

            $.ajax({

                url: "../fetch/allot_sheet_dtls.php",
                data: {
                    memo_no: memo_no
                },
                dataType: "json",

                type: "GET"

            }).done(function (result) {
                //console.log(result.gen_date[0]);
                console.log(result);

                if(result) {

                    $('.hideFirst').show();

                    $('#effective_dt').val(result.gen_date[1]);

                    for (var i = 0; i < result.mr_no.length; i++) {

                        tableRow();

                        $('.mr_no').eq(i).val(result.mr_no[i]);
                        $('.dealer_name').eq(i).val(result.delr_name[i]);
                        $('.region').eq(i).val(result.delr_region[i]);

                        $('.aay').eq(i).val(result.aay_family[i]);
                        $('.aay_rice').eq(i).val(result.aay_rice[i]);
                        $('.aay_wheat').eq(i).val(result.aay_wheat[i]);
                        $('.aay_atta').eq(i).val(result.aay_atta[i]);
                        $('.aay_sugar').eq(i).val(result.aay_sugar[i]);

                        $('.phh').eq(i).val(result.phh_head[i]);
                        $('.phh_rice').eq(i).val(result.phh_rice[i]);
                        $('.phh_wheat').eq(i).val(result.phh_wheat[i]);
                        $('.phh_atta').eq(i).val(result.phh_atta[i]);

                        $('.sphh').eq(i).val(result.sphh_head[i]);
                        $('.sphh_rice').eq(i).val(result.sphh_rice[i]);
                        $('.sphh_wheat').eq(i).val(result.sphh_wheat[i]);
                        $('.sphh_atta').eq(i).val(result.sphh_wheat[i]);
                        $('.sphh_sugar').eq(i).val(result.sphh_sugar[i]);

                        $('.rksy1').eq(i).val(result.rksy1_head[i]);
                        $('.rksy1_rice').eq(i).val(result.rksy1_rice[i]);
                        $('.rksy1_wheat').eq(i).val(result.rksy1_wheat[i]);
                        $('.rksy1_atta').eq(i).val(result.rksy2_wheat[i]);

                        $('.rksy2').eq(i).val(result.rksy2_head[i]);
                        $('.rksy2_rice').eq(i).val(result.rksy2_rice[i]);
                        $('.rksy2_wheat').eq(i).val(result.rksy2_wheat[i]);
                        $('.rksy2_atta').eq(i).val(result.rksy2_wheat[i]);
                    }
                }

                else{

                    alert('Please refress the page!');

                }

                //For AAY=============================

                var className = $('.aay'),
                    targetId  = $('#aay_total');

                addColumns(className, targetId);


                className = $('.aay_rice'),
                    targetId  = $('#aay_rice_total');

                addColumns(className, targetId);


                className = $('.aay_wheat'),
                    targetId  = $('#aay_wheat_total');

                addColumns(className, targetId);


                className = $('.aay_atta'),
                    targetId  = $('#aay_atta_total');

                addColumns(className, targetId);

                className = $('.aay_sugar'),
                    targetId  = $('#aay_sugar_total');

                addColumns(className, targetId);


                //For PHH=============================

                className = $('.phh'),
                    targetId  = $('#phh_total');

                addColumns(className, targetId);

                className = $('.phh_rice'),
                    targetId  = $('#phh_rice_total');

                addColumns(className, targetId);


                className = $('.phh_wheat'),
                    targetId  = $('#phh_wheat_total');

                addColumns(className, targetId);


                className = $('.phh_atta'),
                    targetId  = $('#phh_atta_total');

                addColumns(className, targetId);


                //For SPHH=============================

                className = $('.sphh'),
                    targetId  = $('#sphh_total');

                addColumns(className, targetId);

                className = $('.sphh_rice'),
                    targetId  = $('#sphh_rice_total');

                addColumns(className, targetId);


                className = $('.sphh_wheat'),
                    targetId  = $('#sphh_wheat_total');

                addColumns(className, targetId);


                className = $('.sphh_atta'),
                    targetId  = $('#sphh_atta_total');

                addColumns(className, targetId);

                className = $('.sphh_sugar'),
                    targetId  = $('#sphh_sugar_total');

                addColumns(className, targetId);


                //For RKSY-I=============================

                className = $('.rksy1'),
                    targetId  = $('#rksy1_total');

                addColumns(className, targetId);


                className = $('.rksy1_rice'),
                    targetId  = $('#rksy1_rice_total');

                addColumns(className, targetId);


                className = $('.rksy1_wheat'),
                    targetId  = $('#rksy1_wheat_total');

                addColumns(className, targetId);


                className = $('.rksy1_atta'),
                    targetId  = $('#rksy1_atta_total');

                addColumns(className, targetId);


                //For RKSY-II=============================

                className = $('.rksy2'),
                    targetId  = $('#rksy2_total');



                addColumns(className, targetId);

                className = $('.rksy2_rice'),
                    targetId  = $('#rksy2_rice_total');

                addColumns(className, targetId);


                className = $('.rksy2_wheat'),
                    targetId  = $('#rksy2_wheat_total');

                addColumns(className, targetId);


                className = $('.rksy2_atta'),
                    targetId  = $('#rksy2_atta_total');

                addColumns(className, targetId);


            });

        });



        // Row add....

        $('#addRow').click(function () {

		//tableRow();
	   $('#intro').prepend('<tr>\n' +
           '\n' +
           '                                <td><input type="text" name="mr_no[]" class="input2 mr_no" style="width:80px"/></td>\n' +
           '                                <td><input type="text" name="dealer_name[]" class="input2 dealer_name" style="width:150px" readonly /></td>\n' +
           '                                <td><input type="text" name="region[]" class="input2 region" style="width:150px" readonly/></td>\n' +
           '\n' +
           '                                <td><input type="number" name="aay[]" class="input2 aay" style="width:100px"/></td>\n' +
           '                                <td><input type="text" name="aay_rice[]" class="input2 aay_rice" style="width:100px"></td>\n' +
           '                                <td><input type="text" name="aay_wheat[]" class="input2 aay_wheat" style="width:100px"></td>\n' +
           '                                <td><input type="text" name="aay_atta[]" class="input2 aay_atta" style="width:100px" /></td>\n' +
           '                                <td><input type="text" name="aay_sugar[]" class="input2 aay_sugar" style="width:100px" /></td>\n' +
           '\n' +
           '                                <td><input type="number" name="phh[]" class="input2 phh" style="width:100px"/></td>\n' +
           '                                <td><input type="text" name="phh_rice[]" class="input2 phh_rice" style="width:100px" /></td>\n' +
           '                                <td><input type="text" name="phh_wheat[]" class="input2 phh_wheat" style="width:100px" /></td>\n' +
           '                                <td><input type="text" name="phh_atta[]" class="input2 phh_atta" style="width:100px" /></td>\n' +
           '\n' +
           '                                <td><input type="number" name="sphh[]" class="input2 sphh" style="width:100px"/></td>\n' +
           '                                <td><input type="text" name="sphh_rice[]" class="input2 sphh_rice" style="width:100px"/></td>\n' +
           '                                <td><input type="text" name="sphh_wheat[]" class="input2 sphh_wheat" style="width:100px"/></td>\n' +
           '                                <td><input type="text" name="sphh_atta[]" class="input2 sphh_atta" style="width:100px" /></td>\n' +
           '                                <td><input type="text" name="sphh_sugar[]" class="input2 sphh_sugar" style="width:100px" /></td>\n' +
           '\n' +
           '                                <td><input type="number" name="rksy1[]" class="input2 rksy1" style="width:100px"/></td>\n' +
           '                                <td><input type="text" name="rksy1_rice[]" class="input2 rksy1_rice" style="width:100px" /></td>\n' +
           '                                <td><input type="text" name="rksy1_wheat[]" class="input2 rksy1_wheat" style="width:100px" /></td>\n' +
           '                                <td><input type="text" name="rksy1_atta[]" class="input2 rksy1_atta" style="width:100px" /></td>\n' +
           '\n' +
           '                                <td><input type="number" name="rksy2[]" class="input2 rksy2" style="width:100px"/></td>\n' +
           '                                <td><input type="text" name="rksy2_rice[]" class="input2 rksy2_rice" style="width:100px"/></td>\n' +
           '                                <td><input type="text" name="rksy2_wheat[]" class="input2 rksy2_wheat" style="width:100px"/></td>\n' +
           '                                <td><input type="text" name="rksy2_atta[]" class="input2 rksy2_atta" style="width:100px" /></td>\n' +
           '\n' +
           '                            </tr>');

        });

        function tableRow() {

            $('#intro').append('<tr>\n' +
                '\n' +
                '                                <td><input type="text" name="mr_no[]" class="input2 mr_no" style="width:80px"/></td>\n' +
                '                                <td><input type="text" name="dealer_name[]" class="input2 dealer_name" style="width:150px" readonly /></td>\n' +
                '                                <td><input type="text" name="region[]" class="input2 region" style="width:150px" readonly/></td>\n' +
                '\n' +
                '                                <td><input type="number" name="aay[]" class="input2 aay" style="width:100px"/></td>\n' +
                '                                <td><input type="text" name="aay_rice[]" class="input2 aay_rice" style="width:100px"></td>\n' +
                '                                <td><input type="text" name="aay_wheat[]" class="input2 aay_wheat" style="width:100px"></td>\n' +
                '                                <td><input type="text" name="aay_atta[]" class="input2 aay_atta" style="width:100px" /></td>\n' +
                '                                <td><input type="text" name="aay_sugar[]" class="input2 aay_sugar" style="width:100px" /></td>\n' +
                '\n' +
                '                                <td><input type="number" name="phh[]" class="input2 phh" style="width:100px"/></td>\n' +
                '                                <td><input type="text" name="phh_rice[]" class="input2 phh_rice" style="width:100px" /></td>\n' +
                '                                <td><input type="text" name="phh_wheat[]" class="input2 phh_wheat" style="width:100px" /></td>\n' +
                '                                <td><input type="text" name="phh_atta[]" class="input2 phh_atta" style="width:100px" /></td>\n' +
                '\n' +
                '                                <td><input type="number" name="sphh[]" class="input2 sphh" style="width:100px"/></td>\n' +
                '                                <td><input type="text" name="sphh_rice[]" class="input2 sphh_rice" style="width:100px"/></td>\n' +
                '                                <td><input type="text" name="sphh_wheat[]" class="input2 sphh_wheat" style="width:100px"/></td>\n' +
                '                                <td><input type="text" name="sphh_atta[]" class="input2 sphh_atta" style="width:100px" /></td>\n' +
                '                                <td><input type="text" name="sphh_sugar[]" class="input2 sphh_sugar" style="width:100px" /></td>\n' +
                '\n' +
                '                                <td><input type="number" name="rksy1[]" class="input2 rksy1" style="width:100px"/></td>\n' +
                '                                <td><input type="text" name="rksy1_rice[]" class="input2 rksy1_rice" style="width:100px" /></td>\n' +
                '                                <td><input type="text" name="rksy1_wheat[]" class="input2 rksy1_wheat" style="width:100px" /></td>\n' +
                '                                <td><input type="text" name="rksy1_atta[]" class="input2 rksy1_atta" style="width:100px" /></td>\n' +
                '\n' +
                '                                <td><input type="number" name="rksy2[]" class="input2 rksy2" style="width:100px"/></td>\n' +
                '                                <td><input type="text" name="rksy2_rice[]" class="input2 rksy2_rice" style="width:100px"/></td>\n' +
                '                                <td><input type="text" name="rksy2_wheat[]" class="input2 rksy2_wheat" style="width:100px"/></td>\n' +
                '                                <td><input type="text" name="rksy2_atta[]" class="input2 rksy2_atta" style="width:100px" /></td>\n' +
                '\n' +
                '                            </tr>');
        }


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

        $('#intro').on('change', '.aay', function() {

            var aay_data = $(this).val(),
                aay_index_no = $('.aay').index(this);

            $('.aay_sugar').eq(aay_index_no).val((aay_data * global_var.unit_val[0] / 100).toFixed(2));
            $('.aay_wheat').eq(aay_index_no).val((aay_data * global_var.unit_val[1] / 100).toFixed(2));
            $('.aay_atta').eq(aay_index_no).val((aay_data * global_var.unit_val[2] / 100).toFixed(2));
            $('.aay_rice').eq(aay_index_no).val((aay_data * global_var.unit_val[3] / 100).toFixed(2));


            className = $('.aay'),
                targetId  = $('#aay_total');

            addColumns(className, targetId);


            className = $('.aay_rice'),
                targetId  = $('#aay_rice_total');

            addColumns(className, targetId);


            className = $('.aay_wheat'),
                targetId  = $('#aay_wheat_total');

            addColumns(className, targetId);


            className = $('.aay_atta'),
                targetId  = $('#aay_atta_total');



            addColumns(className, targetId);

            className = $('.aay_sugar'),
                targetId  = $('#aay_sugar_total');

            addColumns(className, targetId);


        });


        $('#intro').on('change', '.aay_rice', function() {

            className = $('.aay_rice'),
                targetId  = $('#aay_rice_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.aay_wheat', function() {

            className = $('.aay_wheat'),
                targetId  = $('#aay_wheat_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.aay_atta', function() {

            className = $('.aay_atta'),
                targetId  = $('#aay_atta_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.aay_sugar', function() {

            className = $('.aay_sugar'),
                targetId  = $('#aay_sugar_total');

            addColumns(className, targetId);

        });

        // PHH unit-value setup....

        $('#intro').on('change', '.phh', function(){

            var phh_data = $(this).val(),
                phh_index_no = $('.phh').index(this);

            $('.phh_rice').eq(phh_index_no).val((phh_data * global_var.unit_val[4] / 100).toFixed(2));
            $('.phh_atta').eq(phh_index_no).val((phh_data * global_var.unit_val[5] / 100).toFixed(2));
            $('.phh_wheat').eq(phh_index_no).val((phh_data * global_var.unit_val[6] / 100).toFixed(2));


            className = $('.phh'),
                targetId  = $('#phh_total');

            addColumns(className, targetId);

            className = $('.phh_rice'),
                targetId  = $('#phh_rice_total');

            addColumns(className, targetId);


            className = $('.phh_wheat'),
                targetId  = $('#phh_wheat_total');

            addColumns(className, targetId);


            className = $('.phh_atta'),
                targetId  = $('#phh_atta_total');

            addColumns(className, targetId);


        });

        $('#intro').on('change', '.phh_rice', function() {

            className = $('.phh_rice'),
                targetId  = $('#phh_rice_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.phh_wheat', function() {

            className = $('.phh_wheat'),
                targetId  = $('#phh_wheat_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.phh_atta', function() {

            className = $('.phh_atta'),
                targetId  = $('#phh_atta_total');

            addColumns(className, targetId);

        });

        // SPHH unit-value setup....

        $('#intro').on('change', '.sphh', function(){

            var sphh_data = $(this).val(),
                sphh_index_no = $('.sphh').index(this);

            $('.sphh_wheat').eq(sphh_index_no).val((sphh_data * global_var.unit_val[13] / 100).toFixed(2));
            $('.sphh_atta').eq(sphh_index_no).val((sphh_data * global_var.unit_val[14] / 100).toFixed(2));
            $('.sphh_rice').eq(sphh_index_no).val((sphh_data * global_var.unit_val[15] / 100).toFixed(2));
            $('.sphh_sugar').eq(sphh_index_no).val((sphh_data * global_var.unit_val[16] / 100).toFixed(2));


            className = $('.sphh'),
                targetId  = $('#sphh_total');

            addColumns(className, targetId);

            className = $('.sphh_rice'),
                targetId  = $('#sphh_rice_total');

            addColumns(className, targetId);


            className = $('.sphh_wheat'),
                targetId  = $('#sphh_wheat_total');

            addColumns(className, targetId);


            className = $('.sphh_atta'),
                targetId  = $('#sphh_atta_total');

            addColumns(className, targetId);


            className = $('.sphh_sugar'),
                targetId  = $('#sphh_sugar_total');


            addColumns(className, targetId);

        });


        $('#intro').on('change', '.sphh_rice', function() {

            className = $('.sphh_rice'),
                targetId  = $('#sphh_rice_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.aay_wheat', function() {

            className = $('.sphh_wheat'),
                targetId  = $('#sphh_wheat_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.aay_atta', function() {

            className = $('.sphh_atta'),
                targetId  = $('#sphh_atta_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.aay_sugar', function() {

            className = $('.sphh_sugar'),
                targetId  = $('#sphh_sugar_total');

            addColumns(className, targetId);

        });


        // RKSY-I unit-value setup....

        $('#intro').on('change', '.rksy1', function(){

            var rksy1_data = $(this).val(),
                rksy1_index_no = $('.rksy1').index(this);

            $('.rksy1_wheat').eq(rksy1_index_no).val((rksy1_data * global_var.unit_val[7] / 100).toFixed(2));
            $('.rksy1_atta').eq(rksy1_index_no).val((rksy1_data * global_var.unit_val[8] / 100).toFixed(2));
            $('.rksy1_rice').eq(rksy1_index_no).val((rksy1_data * global_var.unit_val[9] / 100).toFixed(2));


            className = $('.rksy1'),
                targetId  = $('#rksy1_total');

            addColumns(className, targetId);


            className = $('.rksy1_rice'),
                targetId  = $('#rksy1_rice_total');

            addColumns(className, targetId);


            className = $('.rksy1_wheat'),
                targetId  = $('#rksy1_wheat_total');

            addColumns(className, targetId);


            className = $('.rksy1_atta'),
                targetId  = $('#rksy1_atta_total');

            addColumns(className, targetId);


        });

        $('#intro').on('change', '.rksy1', function() {

            className = $('.rksy1_rice'),
                targetId  = $('#rksy1_rice_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.phh_wheat', function() {

            className = $('.rksy1_wheat'),
                targetId  = $('#rksy1_wheat_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.aay_atta', function() {

            className = $('.rksy1_atta'),
                targetId  = $('#rksy1_atta_total');

            addColumns(className, targetId);

        });

        // RKSY-II unit-value setup....

        $('#intro').on('change', '.rksy2', function(){

            var rksy2_data = $(this).val(),
                rksy2_index_no = $('.rksy2').index(this);

            $('.rksy2_wheat').eq(rksy2_index_no).val((rksy2_data * global_var.unit_val[10] / 100).toFixed(2));
            $('.rksy2_rice').eq(rksy2_index_no).val((rksy2_data * global_var.unit_val[11] / 100).toFixed(2));
            $('.rksy2_atta').eq(rksy2_index_no).val((rksy2_data * global_var.unit_val[12] / 100).toFixed(2));


            className = $('.rksy2'),
                targetId  = $('#rksy2_total');


            addColumns(className, targetId);

            className = $('.rksy2_rice'),
                targetId  = $('#rksy2_rice_total');

            addColumns(className, targetId);


            className = $('.rksy2_wheat'),
                targetId  = $('#rksy2_wheat_total');

            addColumns(className, targetId);


            className = $('.rksy2_atta'),
                targetId  = $('#rksy2_atta_total');

            addColumns(className, targetId);

        });


        $('#intro').on('change', '.rksy2_rice', function() {

            className = $('.rksy2_rice'),
                targetId  = $('#rksy2_rice_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.rksy2_wheat', function() {

            className = $('.rksy2_wheat'),
                targetId  = $('#rksy2_wheat_total');

            addColumns(className, targetId);

        });

        $('#intro').on('change', '.rksy2_atta', function() {

            className = $('.rksy2_atta'),
                targetId  = $('#rksy2_atta_total');

            addColumns(className, targetId);

        });


        //Resetting columns to 0.00....

        $('#undoAayRice').click(function(){

            $('.aay_rice').val('0.00');

            $('#aay_rice_total').val('0.00');

        });

        $('#undoAayWheat').click(function(){

            $('.aay_wheat').val('0.00');

            $('#aay_wheat_total').val('0.00');

        });

        $('#undoAayAtta').click(function(){

            $('.aay_atta').val('0.00');

            $('#aay_atta_total').val('0.00');

        });

        $('#undoAaySugar').click(function(){

            $('.aay_sugar').val('0.00');

            $('#aay_sugar_total').val('0.00');

        });

        $('#undoPhhRice').click(function(){

            $('.phh_rice').val('0.00');

            $('#phh_rice_total').val('0.00');

        });

        $('#undoPhhWheat').click(function(){

            $('.phh_wheat').val('0.00');

            $('#phh_wheat_total').val('0.00');

        });

        $('#undoPhhAtta').click(function(){

            $('.phh_atta').val('0.00');

            $('#phh_atta_total').val('0.00');

        });


        $('#undoSphhRice').click(function(){

            $('.sphh_rice').val('0.00');

            $('#sphh_rice_total').val('0.00');

        });

        $('#undoSphhWheat').click(function(){

            $('.sphh_wheat').val('0.00');

            $('#sphh_wheat_total').val('0.00');

        });

        $('#undoSphhAtta').click(function(){

            $('.sphh_atta').val('0.00');

            $('#sphh_atta_total').val('0.00');

        });

        $('#undoSphhSugar').click(function(){

            $('.sphh_sugar').val('0.00');

            $('#sphh_sugar_total').val('0.00');

        });

        $('#undoRksy1Rice').click(function(){

            $('.rksy1_rice').val('0.00');

            $('#rksy1_rice_total').val('0.00');
        });

        $('#undoRksy1Wheat').click(function(){

            $('.rksy1_wheat').val('0.00');

            $('#rksy1_wheat_total').val('0.00');

        });

        $('#undoRksy1Atta').click(function(){

            $('.rksy1_atta').val('0.00');

            $('#rksy1_atta_total').val('0.00');

        });

        $('#undoRksy2Rice').click(function(){

            $('.rksy2_rice').val('0.00');

            $('#rksy2_rice_total').val('0.00');

        });

        $('#undoRksy2Wheat').click(function(){

            $('.rksy2_wheat').val('0.00');

            $('#rksy2_wheat_total').val('0.00');

        });

        $('#undoRksy2Atta').click(function(){

            $('.rksy2_atta').val('0.00');

            $('#rksy2_atta_total').val('0.00');

        });


        function addColumns(className, targetId) {

            var total = 0;

            $.each( className, function () {

                total += +$(this).val();

                $(targetId).val(total.toFixed(2));

            });

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

        <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="col-lg-8 col-md-6">

                <div class="container-contact1">

                    <div class="contact1-form validate-form">

                        <div class="wrap-input1 validate-input" data-validate="Allotment No. is required" data-alert="Momo No.">

                            <select class="input1" name="memoNo" id="memoNo" >

                                <option value="0">Select Allotment No.</option>

                                <?php

                                while ($data = mysqli_fetch_assoc($result)) {?>

                                    <option value="<?php echo $data['memo_no']; ?>"><?php echo $data['memo_no']; ?></option>

                                    <?php

                                }

                                ?>

                            </select>

                            <span class="shadow-input1"></span>

                        </div>


                        <div class="wrap-input1 validate-input" data-validate="Date is required" data-alert="Effective Date" >

                            <input type="date" class="input1" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" />

                            <span class="shadow-input1"></span>

                        </div>


                    </div>

                </div>

            </div>


            <div class="row" >

                <div class="col-lg-12 col-md-6">

                    <div class="container-contact2" style="margin-left: 0">

                        <div class="contact2-form" style="margin-bottom: 20px; margin-top: 10px ">

                            <div class="container-contact2-form-btn">

                                <button type="button" class="contact2-form-btn hideFirst" id="addRow" >

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
                                <th><span class="inline"> Wheat </span> <button type="button" class="anav inline" id="undoAayWheat" > <i class="fa fa-undo" style="margin-left: 15px;"></i> </button></th>
                                <th><span class="inline"> Atta </span> <button type="button" class="anav inline" id="undoAayAtta" > <i class="fa fa-undo" style="margin-left: 15px;"></i> </button></th>
                                <th><span class="inline"> Sugar </span> <button type="button" class="anav inline" id="undoAaySugar" > <i class="fa fa-undo" style="margin-left: 15px;"></i> </button></th>

                                <th>PHH<br>Head</th>
                                <th><span class="inline"> Rice </span> <button type="button" class="anav inline" id="undoPhhRice" > <i class="fa fa-undo" style="margin-left: 15px;"> </i> </button> </th>
                                <th><span class="inline"> Wheat </span> <button type="button" class="anav inline" id="undoPhhWheat" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>
                                <th><span class="inline"> Atta </span> <button type="button" class="anav inline" id="undoPhhAtta" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>

                                <th>SPHH<br>Head</th>
                                <th><span class="inline"> Rice </span> <button type="button" class="anav inline" id="undoSphhRice"> <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>
                                <th><span class="inline"> Wheat </span> <button type="button" class="anav inline" id="undoSphhWheat" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>
                                <th><span class="inline"> Atta </span> <button type="button" class="anav inline" id="undoSphhAtta" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>
                                <th><span class="inline"> Sugar </span> <button type="button" class="anav inline" id="undoSphhSugar" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>

                                <th>RKSY-I<br>Head</th>
                                <th><span class="inline"> Rice </span> <button type="button" class="anav inline" id="undoRksy1Rice" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>
                                <th><span class="inline"> Wheat </span> <button type="button" class="anav inline" id="undoRksy1Wheat" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>
                                <th><span class="inline"> Atta </span> <button type="button" class="anav inline" id="undoRksy1Atta" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>

                                <th>RKSY-II<br>Head</th>
                                <th><span class="inline"> Rice </span> <button type="button" class="anav inline" id="undoRksy2Rice" > <i class="fa fa-undo" style="margin-left: 15px;"> </button></th>
                                <th><span class="inline"> Wheat </span> <button type="button" class="anav inline" id="undoRksy2Wheat" >  <i class="fa fa-undo" style="margin-left: 15px;">  </button></th>
                                <th><span class="inline"> Atta </span> <button type="button" class="anav inline" id="undoRksy2Atta" >  <i class="fa fa-undo" style="margin-left: 15px;">  </button></th>

                            </tr>

                            </thead>

                            <tbody style="text-align: right;">

                            </tbody>

                            <tfoot style="text-align: right;">

                            <tr>

                                <td colspan="3" style="text-align: center;"><b style="font-size: 35px;">Total:</b></td>

                                <td><input type="text" class="input2" id="aay_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="aay_rice_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="aay_wheat_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="aay_atta_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="aay_sugar_total" style="width: 100px" readonly /></td>

                                <td><input type="text" class="input2" id="phh_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="phh_rice_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="phh_wheat_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="phh_atta_total" style="width: 100px" readonly /></td>

                                <td><input type="text" class="input2" id="sphh_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="sphh_rice_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="sphh_wheat_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="sphh_atta_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="sphh_sugar_total" style="width: 100px" readonly /></td>

                                <td><input type="text" class="input2" id="rksy1_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="rksy1_rice_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="rksy1_wheat_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="rksy1_atta_total" style="width: 100px" readonly /></td>

                                <td><input type="text" class="input2" id="rksy2_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="rksy2_rice_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="rksy2_wheat_total" style="width: 100px" readonly /></td>
                                <td><input type="text" class="input2" id="rksy2_atta_total" style="width: 100px" readonly /></td>

                            </tr>

                            </tfoot>

                            </tbody>

                        </table>

                        <div class="contact2-form" style="margin-bottom: 10px">

                            <div class="container-contact2-form-btn">

                                <button class="contact1-form-btn hideFirst" >

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
