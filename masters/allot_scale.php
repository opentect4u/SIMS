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

			if($result){
				$_SESSION['ins_flag']=true;
				Header("Location:allot_scale_view.php");
			}

	}
	$select_catg="Select prod_catg, per_unit from m_prod_catg ORDER BY prod_catg";
	$prdcatg=mysqli_query($db_connect,$select_catg);

	$select_prd="Select prod_desc from m_products";
	$prddesc=mysqli_query($db_connect,$select_prd);


?>
<html>
	<head>
		<title>Synergic Inventory Management System-Add Stock</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/master.css">
    </head>
    <script>
        $(document).ready(function() {
            $('.defaultHide').hide();

            $('#form').submit(function(e) {
                //e.preventDefault();
                var prod_desc = $('#prod_desc').val(),
                    prod_catg = $('#prod_catg').val(),
                    per_unit = $('#per_unit').val(),
                    unit_val = $('#unit_val').val();

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

			<tr>    
                <td><div class="alignlabel"><label for="prod_desc"><strong style="color: red;">*</strong>Product:</label></div></td>
                <td><select name="prod_desc" id="prod_desc" style="width:400px">
                            <option value="`0">Select</option>
                            <?php
                                    while($row=mysqli_fetch_assoc($prddesc)){
                                    echo ("<option value='".$row["prod_desc"]."'>".$row["prod_desc"]."</option>") ;
                                    }
                            ?>
                    </select>
                </td>
        
			</tr>

			<tr>    
                <td><div class="alignlabel"><label for="prod_catg"><strong style="color: red;">*</strong>Category:</label></div></td>
                <td><select name="prod_catg" id="prod_catg" style="width:400px">
                <option value="0">Select</option>
                <?php
                        while($row=mysqli_fetch_assoc($prdcatg)){
                        echo ("<option value='".$row["prod_catg"]."' data-val='".$row['per_unit']."'>".$row["prod_catg"]."</option>") ;
                        }
                ?>
                    </select>
                </td>
			</tr>

			<tr>    
                <td><div class="alignlabel"><label for="per_unit"><strong style="color: red;">*</strong>Unit Type:</label></div></td>
                <td><input type="text" name="unit_type" id="per_unit" size="150" style="width:400px" readonly></td>
			</tr>

			<tr>    
                <td><div class="alignlabel"><label for="unit_val"><strong style="color: red;">*</strong>Value(Kg):</label></div></td>
                <td><input type="text" name="unit_val" id="unit_val" value="0.00" size="150" style="width:400px"></td>
			</tr>

			<tr>
				<td><input type="submit" name="submit" value="Save"></td>
			</tr>
		</table>
	</body>
</html>
