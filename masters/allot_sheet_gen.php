<?php
ini_set("display_errors","1");
error_reporting(E_ALL);

require("../db/db_connect.php");
require("../session.php");

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $effectdt	=	$_POST["effective_dt"];
    $proddesc	=	$_POST["prod_desc"];
    $prodcatg	=	$_POST['prod_catg'];
    $perunit	=	$_POST['unit_type'];
    $unitval	=	$_POST['unit_val'];
    $user_id    = $_SESSION["user_id"];

    $time = date("Y-m-d h:i:s");

    if($unitval <= 0){
        echo "<script>alert('Value(Kg) can\'t be less then or equals to zero');</script>";

        $effectdt = null;
    }

    if(!is_null($effectdt)) {

        $sql="insert into m_allot_scale(effective_dt,
								     prod_desc,
								     prod_catg,
								     per_unit,
								     unit_val,
								     created_by,
								     created_dt)
							      values('$effectdt',
								     '$proddesc',
								     '$prodcatg',
								     '$perunit',
								     '$unitval',
								     '$user_id',
								     '$time'
							     	      )";

        $result=mysqli_query($db_connect,$sql);
    }

}
$select_catg="Select prod_catg, per_unit from m_prod_catg ORDER BY prod_catg";


?>
<html>
<head>
    <title>Synergic Inventory Management System-Add Stock</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--<link rel="stylesheet" href="../css/master.css">-->
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
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

        $.ajax({
            url:"../fetch/allot_scale_dtls.php",
            type:"post"
        }).done( function ( result ) {
            console.log(result);
        });

    // Row add....

        $('#addRow').click(function () {
            $('#intro').append('<tr>\n' +
                '            <td><input type="text" name="mr_no[]" class="mr_no" style="width:50px" /></td>\n' +
                '            <td><input type="text" name="dealer_name" class="dealer_name" size="50" style="width:75px" readonly/></td>\n' +
                '            <td><input type="text" name="region" class="region" style="width:75px" readonly></td>\n' +
                '\n' +
                '            <td><input type="number" name="ayy[]" class="aay" style="width:75px"/></td>\n' +
                '            <td><input type="text" name="ayy_rice[]" class="ayy_rice" style="width:75px"></td>\n' +
                '            <td><input type="text" name="ayy_atta[]" class="ayy_atta" style="width:75px" /></td>\n' +
                '            <td><input type="text" name="ayy_sugar[]" class="ayy_sugar" style="width:75px" /></td>\n' +
                '\n' +
                '            <td><input type="number" name="phh[]" class="phh" style="width:75px"/></td>\n' +
                '            <td><input type="text" name="phh_rice[]" class="phh_rice" style="width:75px" /></td>\n' +
                '            <td><input type="text" name="phh_atta[]" class="phh_atta" style="width:75px" /></td>\n' +
                '\n' +
                '            <td><input type="number" name="sphh[]" class="sphh" style="width:75px"/></td>\n' +
                '            <td><input type="text" name="sphh_rice[]" class="sphh_rice" style="width:75px"></td>\n' +
                '            <td><input type="text" name="sphh_atta[]" class="sphh_atta" style="width:75px" /></td>\n' +
                '            <td><input type="text" name="sphh_sugar[]" class="sphh_sugar" style="width:75px" /></td>\n' +
                '\n' +
                '            <td><input type="number" name="rksy1[]" class="rksy1" style="width:75px"/></td>\n' +
                '            <td><input type="text" name="rksy1_rice[]" class="rksy1_rice" style="width:75px" /></td>\n' +
                '            <td><input type="text" name="rksy1_atta[]" class="rksy1_atta" style="width:75px" /></td>\n' +
                '\n' +
                '            <td><input type="number" name="rksy2[]" class="rksy2" style="width:75px"/></td>\n' +
                '            <td><input type="text" name="rksy2_rice[]" id="rksy2_rice" style="width:75px"></td>\n' +
                '            <td><input type="text" name="rksy2_atta[]" id="rksy2_atta" style="width:75px" /></td>\n' +
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

                console.log(index_no);

                $('.dealer_name').eq(index_no).val(result.del_name);

                $('.region').eq(index_no).val(result.del_reg);

            });

        });


    // For unit calculation, data fetching and store in an array....

        $('#intro').on('change', '.aay', function(){

            var ayy_data = $(this).val(),
                index_no = $('.ayy').index(this);

            $.ajax({
                url:"",

                data:{

                },
                dataType:"json"
            }).done(function ( result ) {

            });

        });

    });



</script>

<body>
<button id="addRow">Click</button>
<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

    <table>
        <tr>
            <td><div class="alignlabel"><label for="effective_dt"><strong style="color: red;">*</strong>Effective Date:</label></div></td>
            <td><input type="date" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" size="50" style="width:150px"</td>
        </tr>

    </table>

    <br>

    <table id="intro">

        <tr>
            <th>MR No</th>
            <th>Dealer Name</th>
            <th>Region</th>

            <th>AAY<br>Family</th>
            <th>Rice</th>
            <th>Wheat/<br>Atta</th>
            <th>Sugar</th>

            <th>PHH<br>Head</th>
            <th>Rice</th>
            <th>Wheat/<br>Atta</th>

            <th>SPHH<br>Head</th>
            <th>Rice</th>
            <th>Wheat/<br>Atta</th>
            <th>Sugar</th>

            <th>RKSY-I<br>Head</th>
            <th>Rice</th>
            <th>Wheat/<br>Atta</th>

            <th>RKSY-II<br>Head</th>
            <th>Rice</th>
            <th>Wheat/<br>Atta</th>
        </tr>

        <tr>
            <td><input type="text" name="mr_no[]" class="mr_no" style="width:50px" /></td>
            <td><input type="text" name="dealer_name" class="dealer_name" size="50" style="width:75px" readonly/></td>
            <td><input type="text" name="region" class="region" style="width:75px" readonly></td>

            <td><input type="number" name="ayy[]" class="aay" style="width:75px"/></td>
            <td><input type="text" name="ayy_rice[]" class="ayy_rice" style="width:75px"></td>
            <td><input type="text" name="ayy_atta[]" class="ayy_atta" style="width:75px" /></td>
            <td><input type="text" name="ayy_sugar[]" class="ayy_sugar" style="width:75px" /></td>

            <td><input type="number" name="phh[]" class="phh" style="width:75px"/></td>
            <td><input type="text" name="phh_rice[]" class="phh_rice" style="width:75px" /></td>
            <td><input type="text" name="phh_atta[]" class="phh_atta" style="width:75px" /></td>

            <td><input type="number" name="sphh[]" class="sphh" style="width:75px"/></td>
            <td><input type="text" name="sphh_rice[]" class="sphh_rice" style="width:75px"></td>
            <td><input type="text" name="sphh_atta[]" class="sphh_atta" style="width:75px" /></td>
            <td><input type="text" name="sphh_sugar[]" class="sphh_sugar" style="width:75px" /></td>

            <td><input type="number" name="rksy1[]" class="rksy1" style="width:75px"/></td>
            <td><input type="text" name="rksy1_rice[]" class="rksy1_rice" style="width:75px" /></td>
            <td><input type="text" name="rksy1_atta[]" class="rksy1_atta" style="width:75px" /></td>

            <td><input type="number" name="rksy2[]" class="rksy2" style="width:75px"/></td>
            <td><input type="text" name="rksy2_rice[]" class="rksy2_rice" style="width:75px"></td>
            <td><input type="text" name="rksy2_atta[]" class="rksy2_atta" style="width:75px" /></td>

        </tr>

    </table>

</body>
</html>
