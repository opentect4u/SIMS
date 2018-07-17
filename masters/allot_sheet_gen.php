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
<body>
<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

    <table>
        <tr>
            <td><div class="alignlabel"><label for="effective_dt"><strong style="color: red;">*</strong>Effective Date:</label></div></td>
            <td><input type="date" name="effective_dt" id="effective_dt" value="<?php echo date("Y-m-d") ?>" size="50" style="width:150px"</td>
        </tr>

    </table>

    <br>

    <table>

        <tr>
            <th>MR No</th>
            <th>Dealer Name</th>
            <th>Region</th>
            <th>Category</th>
            <th>Set Unit</th>
            <th>Rice</th>
            <th>Atta</th>
            <th>Category</th>
            <th>Set Unit</th>
            <th>Rice</th>
            <th>Atta</th>
            <th>Category</th>
            <th>Set Unit</th>
            <th>Rice</th>
            <th>Atta</th>
            <th>Category</th>
            <th>Set Unit</th>
            <th>Rice</th>
            <th>Atta</th>
            <th>Category</th>
            <th>Set Unit</th>
            <th>Rice</th>
            <th>Atta</th>
        </tr>

        <tr>
            <td><input type="text" name="mr_no[]" id="mr_no" style="width:50px" /></td>
            <td><input type="text" name="dealer_name" id="dealer_name" size="50" style="width:100px" readonly/></td>
            <td><input type="text" name="region" id="region" style="width:100px" readonly></td>
            <td><select name="prod_catg1[]" id="prod_catg1" style="width: 100px;">
                    <option value="0">Select</option>
                    <?php
                    $prdcatg=mysqli_query($db_connect,$select_catg);
                    while($row=mysqli_fetch_assoc($prdcatg)) {
                        echo ("<option value='".$row["prod_catg"]."'>".$row["prod_catg"].' '.$row["per_unit"]."</option>") ;
                    }
                    ?>
                </select></td>
            <td><input type="text" name="per_unit1[]" id="per_unit1" style="width:50px"></td>

            <td><input type="text" name="rice1[]" id="rice1" style="width:100px" /></td>
            <td><input type="text" name="atta1[]" id="atta1" style="width:100px" /></td>
            <td><select name="prod_catg2[]" id="prod_catg2" style="width: 100px;" >
                    <option value="0">Select</option>
                    <?php
                    unset($prdcatg);
                    $prdcatg=mysqli_query($db_connect,$select_catg);
                    while($row=mysqli_fetch_assoc($prdcatg)) {
                        echo ("<option value='".$row["prod_catg"]."'>".$row["prod_catg"].' '.$row["per_unit"]."</option>") ;
                    }
                    ?>
                </select></td>
            <td><input type="text" name="per_unit2[]" id="per_unit2" style="width:50px"></td>

            <td><input type="text" name="rice2[]" id="rice2" style="width:100px" /></td>
            <td><input type="text" name="atta2[]" id="atta2" style="width:100px" /></td>
            <td><select name="prod_catg3[]" id="prod_catg" style="width: 100px;">
                    <option value="0">Select</option>
                    <?php
                    unset($prdcatg);
                    $prdcatg=mysqli_query($db_connect,$select_catg);
                    while($row=mysqli_fetch_assoc($prdcatg)) {
                        echo ("<option value='".$row["prod_catg"]."'>".$row["prod_catg"].' '.$row["per_unit"]."</option>") ;
                    }
                    ?>
                </select></td>
            <td><input type="text" name="per_unit3[]" id="per_unit3" style="width:50px"></td>

            <td><input type="text" name="rice3[]" id="rice3" style="width:100px" /></td>
            <td><input type="text" name="atta3[]" id="atta3" style="width:100px" /></td>
            <td><select name="prod_catg4[]" id="prod_catg" style="width: 100px;">
                    <option value="0">Select</option>
                    <?php
                    unset($prdcatg);
                    $prdcatg=mysqli_query($db_connect,$select_catg);
                    while($row=mysqli_fetch_assoc($prdcatg)) {
                        echo ("<option value='".$row["prod_catg"]."'>".$row["prod_catg"].' '.$row["per_unit"]."</option>") ;
                    }
                    ?>
                </select></td>
            <td><input type="text" name="per_unit4[]" id="per_unit4" style="width:50px"></td>

            <td><input type="text" name="rice4[]" id="rice4" style="width:100px" /></td>
            <td><input type="text" name="atta4[]" id="atta4" style="width:100px" /></td>
            <td><select name="prod_catg5[]" id="prod_catg" style="width: 100px;">
                    <option value="0">Select</option>
                    <?php
                    unset($prdcatg);
                    $prdcatg=mysqli_query($db_connect,$select_catg);
                    while($row=mysqli_fetch_assoc($prdcatg)) {
                        echo ("<option value='".$row["prod_catg"]."'>".$row["prod_catg"].' '.$row["per_unit"]."</option>") ;
                    }
                    ?>
                </select></td>
            <td><input type="text" name="per_unit5[]" id="per_unit5" style="width:50px"></td>

            <td><input type="text" name="rice5[]" id="rice5" style="width:100px" /></td>
            <td><input type="text" name="atta5[]" id="atta5" style="width:100px" /></td>

        </tr>

    </table>

</body>
</html>
