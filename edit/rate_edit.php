<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	require("../db/db_connect.php");
	require("../session.php");

	$prodtypeErr = "";
	
	if($_SERVER['REQUEST_METHOD']=="GET"){
		$eftdt	 =	$_GET['effective_dt'];
		$prdesc  =      $_GET['prod_desc'];
		$prdcatg =      $_GET['prod_catg'];
	
	    $rtv="Select effective_dt,
		    	 prod_type,
			 prod_desc,
			 prod_catg,
			 per_unit,
			 prod_rate
		  from m_rate_master
		  where effective_dt='$eftdt'
		  and   prod_desc   ='$prdesc'
		  and   prod_catg   = '$prdcatg'" ;

	   $result=mysqli_query($db_connect,$rtv);

	   if($result){
		   if(mysqli_num_rows($result) > 0){
	      		$row=mysqli_fetch_assoc($result);
	      		$protype=$row['prod_type'];
	      		$perunit=$row['per_unit'];
	      		$prorate=$row['prod_rate']; 
	   	    }	
	  }		
	}
  

 

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
			$prodrate=0;
			if(empty($_POST['prod_rate'])){
			  $prodtypeErr = "Invalid Input";	
			}else{
			      $eftdt    =       test_input($_POST['effective_dt']);	
			      $proddesc	=	test_input($_POST["prod_desc"]);
			      $prodtype	=	test_input($_POST["prod_type"]);
			      $prodcatg	=	test_input($_POST['prod_catg']);
			      $perunit	=	test_input($_POST['per_unit']);	
			      $prodrate	=	test_input($_POST['prod_rate']);
			 }    
			      $user_id  = 	$_SESSION["user_id"];    
			      $time = date("Y-m-d h:i:s");

			if(!is_null($prodrate) && isset($user_id)) {

				$sql="update m_rate_master set prod_rate='$prodrate',
				      modified_by ='$user_id',
				      modified_dt ='$time'
		     		      where effective_dt ='$eftdt'
				      and   prod_desc    ='$proddesc'
                                      and   prod_type    ='$prodtype'
				      and   prod_catg    ='$prodcatg'";
	

                          $update=mysqli_query($db_connect,$sql);
			}

			if($update){
				$_SESSION['rate_edit'] = true;
				Header("Location:../masters/rate_master_view.php");
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

		<title>Synergic Inventory Management System-Add Product Rate</title>

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

                <?php require("../post/menu.php"); ?>

            </div>

            <div class="col-lg-8 col-md-6">

                <div class="container-contact1">

                    <form class="contact1-form validate-form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                            <span class="contact1-form-title">
                              Edit Rate
                            </span>

                        <div class="wrap-input1 validate-input">

                            <input type="date" class="input1" name="effective_dt" id="effective_dt" value="<?php echo $eftdt; ?>" readonly />

                            <span class="shadow-input1"></span>

                        </div>

                        <div class="wrap-input1 validate-input">

                            <input type="text" class="input1" name="prod_desc" id="prod_desc" value="<?php echo $prdesc; ?>" readonly />

                            <span class="shadow-input1"></span>

                        </div>

                        <div class="wrap-input1 validate-input">

                            <input type="text" class="input1" name="prod_type" id="prod_type" value="<?php echo $protype; ?>" readonly />

                            <span class="shadow-input1"></span>

                        </div>

                        <div class="wrap-input1 validate-input">

                            <input type="text" class="input1" name="prod_catg" id="prod_catg" value="<?php echo $prdcatg; ?>" readonly />

                            <span class="shadow-input1"></span>

                        </div>

                        <div class="wrap-input1 validate-input">

                            <input type="text" class="input1" name="prod_unit" id="prod_unit" value="<?php echo $perunit; ?>" readonly />

                            <span class="shadow-input1"></span>

                        </div>

                        <div class="wrap-input1 validate-input">

                            <input type="text" class="input1" name="prod_rate" id="prod_rate" value="<?php echo $prorate; ?>" />

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



                        <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

	<table>

	  <tr>
	      <td><div class="alignlabel"><label for="effective_dt"><strong style="color: red;">*</strong>Effective Date:</label></div></td>
	      <td><input type="date" name="effective_dt" id="effective_dt" value="<?php echo $eftdt; ?>" size="50" style="width:150px" readonly></td>
	  </tr>
	  <tr>    
	      <td><div class="alignlabel"><label for="prod_desc"><strong style="color: red;">*</strong>Product:</label></div></td>
	      <td><input type="text" name="prod_desc" id="prod_desc" value="<?php echo $prdesc; ?>"style="width:400px" readonly></td>	
	   </tr>

	   <tr>
                <td><div class="aligntable"><label for="prod_type">Product Type:</label></div></td>
		<td><input type="text" name="prod_type" id="prod_type" value="<?php echo $protype; ?>" style="width:400px" size="150" readonly></td>
           </tr>
	

	   <tr>    
              <td><div class="alignlabel"><label for="prod_catg"><strong style="color: red;">*</strong>Category:</label></div></td>
              <td><input type="text" name="prod_catg" id="prod_catg" value="<?php echo $prdcatg; ?>"style="width:400px" readonly></td>

	    <tr>    
                <td><div class="alignlabel"><label for="per_unit"><strong style="color: red;">*</strong>Unit Type:</label></div></td>
		<td><input type="text" name="prod_unit" id="prod_unit" value="<?php echo $perunit; ?>"style="width:400px" readonly ></td>
	   </tr>

	   <tr>    
                <td><div class="alignlabel"><label for="prod_rate"><strong style="color: red;">*</strong>Rate:</label></div></td>
		<td><input type="text" name="prod_rate" id="prod_rate" value="<?php echo $prorate; ?>" size="150" style="width:400px"></td>
	   </tr>

	   <tr>
		<td><input type="submit" name="submit" value="Save"></td>
	   </tr>
    </table>
</body>
</html>
