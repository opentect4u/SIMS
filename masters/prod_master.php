<?php
	require("../db/db_connect.php");
	require("../session.php");
//	require("nav.php");
//	echo"<br><br>";
//	echo "<h1 class='elegantshadow'>Laxmi Narayan Stores</h1>";
//      echo "<hr class='hr'>";

//	require("menu.php");

    $prodtypeErr = $proddescErr = $prodcatgErr = $srt_fctrErr = '';

	if ($_SERVER["REQUEST_METHOD"]=="POST"){

        $prodtype = null;

        if (empty($_POST["prod_type"])) {
            $prodtypeErr = "Invalid Input";
        }else {
            $prodtype = test_input($_POST["prod_type"]);
        }

        //==============================

        if (empty($_POST["prod_name"])) {
            $proddescErr = "Invalid Input";
        }else {
            $proddesc = test_input($_POST["prod_name"]);
        }

        $user_id=$_SESSION["user_id"];
        $time=date("Y-m-d h:i:s");


        if(!is_null($prodtype)&&!is_null($proddesc)) {
          $sql="insert into m_products(prod_type,prod_desc,created_by,created_dt)
                     values('$prodtype','$proddesc','$user_id','$time')";
          $result=mysqli_query($db_connect,$sql);
	}
		if($result){
                             $_SESSION['ins_flag']=true;
                             Header("Location:prod_master_view.php");
                        }


	}

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

	$select = "Select prod_type from m_prod_type";
	$prdtype=mysqli_query($db_connect,$select);

?>
<html>
<head>
	<title>Synergic Inventory Management System-Add Product</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/master.css">
</head>

<body>
	<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
	<table>
		<tr>
			<td><div class="alignlabel"><label for="prod_type"><strong style="color: red;">*</strong>Product Type:</label></div></td>
			<td><select name="prod_type" id="prod_type" style="width:400px">
                     	<option value="0">Select</option>
				<?php 
                    			  while($row=mysqli_fetch_assoc($prdtype)){
					  echo ("<option value='".$row["prod_type"]."'>".$row["prod_type"]."</option>") ;
					 }
				?>
			</select><span class="error"><?php echo $prodtypeErr;?></span></td>
		</tr>
		<tr>
			<td><div class="alignlabel"><label for="prod_name"><strong style="color: red;">*</strong>Product Name:</label></div></td>
			<td><input type="text" placeholder="Enter Product Name" id="prod_name" name="prod_name" size="150" style="width:400px"><span c					lass="error"><?php echo $proddescErr;?></span></td>
		</tr>

		<tr>
			<td><input type="submit" name="submit" value="Save"></td>
		</tr>
	</table>
</body>
<html>	 
				  	
	
