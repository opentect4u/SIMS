<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");

        $errMsg = '';
	if ($_SERVER["REQUEST_METHOD"]=="POST"){
			$transdt	=	$_POST["trans_dt"];
			$dono		=	$_POST["do_no"];
			$prodslno	=	$_POST["prod_sl_no"];
			$proddesc	=	$_POST["prod_desc"];
			$transtype	=	"I";
			$qtybag		=	$_POST['qty_bag'];
			$qtyqnt		=	$_POST['qty_qnt'];	
			$qtykg		=	$_POST['qty_kg'];
			$qtygm		=	$_POST['qty_gm'];	

			$remarks	=	$_POST['remarks'];
			$transcd	=	1;
                        $user_id=$_SESSION["user_id"];
			$time=date("Y-m-d h:i:s");

			if(array_sum(array($qtybag, $qtyqnt, $qtykg, $qtygm)) != 0 && !is_null($dono)) {
				$sql="insert into td_stock_trans_pds(trans_dt,
								     trans_cd,
								     do_no,
								     prod_sl_no,
								     prod_desc,
								     trans_type,
								     qty_bag,
								     qty_qnt,
								     qty_kg,
								     qty_gm,
								     remarks,
								     approval_status,			
								     created_by,
								     created_dt,
								     sht_kg,
								     sht_gm)
							  values('$transdt',
								     '$transcd',
								     '$dono',
								     '$prodslno',
								     '$proddesc',
								     '$transtype',
							     	     '$qtybag',
								     '$qtyqnt',
								     '$qtykg',
								     '$qtygm',
								     '$remarks',
								     'U',									     
								     '$user_id',
								     '$time',
							     	      0,
							      	      0)";

                          $result=mysqli_query($db_connect,$sql);
            }
            else{
			    $errMsg = "Invalid Input";
            }

        }

        unset($sql);
        $sql = "SELECT sl_no,
                       prod_type,
                       prod_catg,
                       prod_desc FROM m_products
                                 ORDER BY sl_no";

	    $result = mysqli_query($db_connect, $sql)

?>
<html>
	<head>
		<title>Synergic Inventory Management System-Add Stock</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/master.css">
    </head>
    <script>
        $(document).ready(function() {

            $('#form').submit(function(e) {
                var do_no = $('#do_no').val(),
                    prod_sl_no = $('#prod_sl_no').val(),
                    prod_desc = $('#prod_desc').val();

                $(".error").remove();

                if (do_no.length < 1) {
                    e.preventDefault();
                    $('#do_no').after('<span class="error">Invalid Input</span>');
                }
                if (prod_sl_no.length < 1) {
                    e.preventDefault();
                    $('#prod_sl_no').after('<span class="error">Invalid Input</span>');
                }
                if (prod_desc.length < 1) {
                    e.preventDefault();
                    $('#prod_desc').after('<span class="error">Invalid Input</span>');
                }
            });

            $('#prod_sl_no').change( function () {

                $('#prod_desc').val($(this).find(':selected').attr('data-id'));

            });

        });

    </script>
	<body>
		<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <table>
                <tr>
                    <td><div class="alignlabel"><label for="trans_dt">Date:</label></div></td>
                    <td><input type="date"name="trans_dt" readonly value="<?php echo date("Y-m-d") ?>" size="50" style="width:150px"</td>
                </tr>
                <tr>
                    <td><div class="alignlabel"><label for="do_no"><strong style="color: red;">*</strong>Do No.:</label></div></td>
                    <td><input type="text" name="do_no" id="do_no" size="50" style="width:150px"></td>
                </tr>

                <tr>
                    <td><div class="alignlabel"><label for="prod_sl_no"><strong style="color: red;">*</strong>Product Code:</label></div></td>
                    <td>
                        <select name="prod_sl_no" id="prod_sl_no" style="width:400px;">
                            <option>Select</option>
                            <?php
                            while($data = mysqli_fetch_assoc($result)) { ?>
                                <option value="<?php echo $data['sl_no'];?>"
                                        data-id="<?php echo $data['prod_catg'].' '.$data['prod_desc'].' '.$data['prod_type'];?>">
                                    <?php echo $data['sl_no'].' '.$data['prod_catg'].' '.$data['prod_desc'].' '.$data['prod_type'];?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><div class="alignlabel"><label for="prod_desc"><strong style="color: red;">*</strong>Description:</label></div></td>
                    <td><input type="text" name="prod_desc" id="prod_desc" size="150" style="width:400px" readonly></td>
                </tr>

                <tr>

                    <td><div class="alignlabel"><label for="qty_bag">Bag/Tin:</label></div></td>
                    <td><input type="text" name="qty_bag" size="150" style="width:400px"><span class="error"><?php echo $errMsg;?></span></td>
                </tr>

                <tr>

                    <td><div class="alignlabel"><label for="qty_qnt">Quantity:</label></div></td>
                    <td><input type="text" name="qty_qnt" size="150" style="width:400px"><span class="error"><?php echo $errMsg;?></span></td>
                </tr>

                <tr>

                    <td><div class="alignlabel"><label for="qty_kg">Kg:</label></div></td>
                    <td><input type="text" name="qty_kg" size="150" style="width:400px"><span class="error"><?php echo $errMsg;?></span></td>

                </tr>

                <tr>

                    <td><div class="alignlabel"><label for="qty_gm">Gm:</label></div></td>
                    <td><input type="text" name="qty_gm" size="150" style="width:400px"><span class="error"><?php echo $errMsg;?></span></td>

                </tr>

                <tr>

                    <td><div class="alignlabel"><label for-"remarks">Remarks:</label></div></td>
                    <td><textarea rows="5" cols="50" name="remarks" size="150" style="width:400px">Enter Remarks If Any..</textarea></td>

                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Save"></td>
                </tr>
            </table>
        </form>
	</body>
</html>
