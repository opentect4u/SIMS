<?php
      ini_set("display_errors","1");
      error_reporting("E_ALL");
	
      require("../db/db_connect.php");
      require("../session.php");

      $prodtypeErr="";

      if($_SERVER['REQUEST_METHOD']=="GET"){
      	$transdt	=	$_GET['trans_dt'];
	$transcd	=	$_GET['trans_cd'];
	
	$sql="Select do_no,
		     prod_desc,
                     prod_type,
                     prod_catg,
                     prod_sl_no,
                     qty_bag,
                     qty_qnt,
                     qty_kg,
                     qty_gm,
                     remarks 
                     from td_stock_trans_pds
	       where trans_dt = '$transdt'
	       and   trans_cd = $transcd"; 

	$result=mysqli_query($db_connect,$sql);

	if($result){
		if(mysqli_num_rows($result) > 0){

		while($row=mysqli_fetch_assoc($result)){
	  	$dono	=	$row['do_no'];
		$pdesc	=	$row['prod_desc'];
		$ptype 	=	$row['prod_type'];
		$pcatg	=	$row['prod_catg'];
		$pslno	=	$row['prod_sl_no'];
		$pbag	=	$row['qty_bag'];
		$pqnt	=	$row['qty_qnt'];
		$pkg	=	$row['qty_kg'];
		$pgm	=	$row['qty_gm'];
		$rkms	=	$row['remarks'];	
	  	}	
	  }
	}	

      }
           

      if($_SERVER['REQUEST_METHOD']=="POST"){
	$prod_bag	=	0;
	$prod_qnt	=	0;
	$prod_kg	=	0;
	$prod_gm	=	0;


	$transdt	=	test_input($_POST['trans_dt']);      
      	$prod_bag	=	test_input($_POST['qty_bag']);
	$prod_qnt	=	test_input($_POST['qty_qnt']);
	$prod_kg 	=	test_input($_POST['qty_kg']);
	$prod_gm 	=	test_input($_POST['qty_gm']);
	$transcd	=	test_input($_POST['trans_cd']);
	$remarks	=	test_input($_POST['remarks']);
       
        $user	=	$_SESSION['user_id'];
        $time	=	date("Y-m-d h:i:s");

	if(!is_null($prod_bag) && !is_null($prod_qnt) && !is_null($prod_kg) && !is_null($prod_gm) && isset($user)){
		$update="Update td_stock_trans_pds
			 set qty_bag = '$prod_bag',
			     qty_qnt = '$prod_qnt',
			     qty_kg  = '$prod_kg',
			     qty_gm  = '$prod_gm',
			     remarks = '$remarks',
			     modified_by = '$user',
			     modified_dt = '$time'
			  where trans_dt = '$transdt'
			  and   trans_cd = '$transcd'";

		$result	= mysqli_query($db_connect,$update);	
		} 
		if($result){
			$_SESSION['edit_in']="true";
			Header("Location:../transactions/view_stock_in_pds.php");		
		}
      }

	function test_input($data) {
                        $data = trim($data);
                        $data = strtoupper($data);
                        return $data;
                        }

	
?>
<html>
	<head>
		<title>Synergic Inventory Management System-Add Stock</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/master.css">
    </head>
    <script>
        /*$(document).ready(function() {

            $('#form').submit(function(e) {
                var do_no = $('#do_no').val(),
                    prod_sl_no = $('#prod_sl_no').val(),
                    prod_desc = $('#prod_desc').val();

                $(".error").remove();

                if (do_no.length < 1) {
                    e.preventDefault();
                    $('#do_no').after('<span class="error">Invalid DO No</span>');
                }
                if (prod_sl_no == 0) {
                    e.preventDefault();
                    $('#prod_sl_no').after('<span class="error">Please select a valid serial</span>');
                }
            });

            $('#prod_sl_no').change( function () {

                $('#prod_desc').val($(this).find(':selected').attr('data-id'));

            });

	});*/

	/*$(document).ready(function() {
                $('#prod_desc').change(function () {

		  $('#prod_type').val($(this).find(':selected').attr('data-val'));
		  $('#sl_no').val($(this).find(':selected').attr('prod-cd'));

            });
	});*/

    </script>
	<body>
		<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <table>
                <tr>
                    <td><div class="alignlabel"><label for="trans_dt">Date:</label></div></td>
                    <td><input type="date" name="trans_dt" readonly value="<?php echo date($transdt); ?>" size="50" style="width:150px"</td>
		</tr>

		<tr>
		    <td><div class="alignlabel"><label for="trans_cd">Transaction No.:</label></div></td>
		    <td><input type="text" name="trans_cd" readonly value="<?php echo date($transcd); ?>" size="50" style="width:150px"</td>	
		</tr>

                <tr>
                    <td><div class="alignlabel"><label for="do_no">DO No.:</label></div></td>
		    <td><input type="text" name="do_no" id="do_no" value="<?php echo $dono; ?>" size="50" style="width:150px" readonly ></td>
		</tr>

		<tr>
                    <td><div class="alignlabel"><label for="prod_desc">Product:</label></div></td>
		    <td><input type="text" name="prod_desc" id="prod_desc" value="<?php echo $pdesc; ?>" size="150" style="width:400px"readonly></td>
		</tr>

		<tr>
		    <td><div class="alignlabel"><label for="prod_catg">Category:</label></div></td>
		    <td><input type="text" name="prod_catg" id="prod_catg" value="<?php echo $pcatg; ?>" size="150" style="width:400px"readonly></td>		     </tr>

		<tr>
                    <td><div class="alignlabel"><label for="prod_type">Type:</label></div></td>
		    <td><input type="text" name="prod_type" id="prod_type" value="<?php echo $ptype;?>"size="150" style="width:400px" readonly></td>
		</tr>                
		<tr>
         
                    <td><div class="alignlabel"><label for="sl_no">Product Code:</label></div></td>
		    <td><input type="text" name="sl_no" value="<?php echo $pslno; ?>" id="sl_no" size="150" style="width:400px;" readonly></td>
                </tr>

               <tr>

                    <td><div class="alignlabel"><label for="qty_bag">Bag/Tin:</label></div></td>
		    <td><input type="text" name="qty_bag" size="150" value="<?php echo $pbag; ?>" style="width:400px"></td>
                </tr>

                <tr>

                    <td><div class="alignlabel"><label for="qty_qnt">Quintal:</label></div></td>
                    <td><input type="text" name="qty_qnt" size="150" value="<?php echo $pqnt; ?>" style="width:400px"></td>
                </tr>

                <tr>

                    <td><div class="alignlabel"><label for="qty_kg">Kg:</label></div></td>
                    <td><input type="text" name="qty_kg" size="150" value="<?php echo $pkg; ?>" style="width:400px"></td>

                </tr>

                <tr>

                    <td><div class="alignlabel"><label for="qty_gm">Gm:</label></div></td>
                    <td><input type="text" name="qty_gm" size="150" value="<?php echo $pgm; ?>" style="width:400px"></td>

                </tr>

                <tr>

                    <td><div class="alignlabel"><label for-"remarks">Remarks:</label></div></td>
		    <td><textarea rows="5" cols="50" name="remarks" size="150" style="width:400px"><?php echo $rkms; ?></textarea></td>	

                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Update"></td>
                </tr>
            </table>
        </form>
	</body>
</html>
