<?php
	require ("../db/db_connect.php");
	//require ("nav.php");
?>

<html>
<head>
	<title>Synergic Inventory Management System</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/collapsible.css">
	
	<style>
		a {text-decoration :none;
		   color: #021103;
		  }
	</style>
</head>
<body class="body">	
	<div class="block">
	<div>
	    <button id="dashbtn" class="collapsible"><i class="fa fa-home fa-fw" aria-hidden="true"></i>Dashboard</button>
	</div>	
	<div>
	     <button class="collapsible">
		<i class="fa fa-asterisk fa-fw" aria-hidden="true"></i>Master
		<i class="fa fa-angle-down pull-right" aria-hidden="true"></i>
	     </button>
		<div class="content" >
			<div> <br>
				<a class="abtn green" href="../masters/prod_type.php">
				<i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add Product Type</a>
			    <br><br>
			</div>

			<div><a class="abtn green" href="../masters/prod_catg.php">
				<i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add Category</a>
				<br><br>
			</div>	

			<div>
                            <a class="abtn green" href="../masters/prod_qty.php">
                                <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add Unit</a>        
                            <br><br>
                        </div>


			<div>
			    <a class="abtn green" href="../masters/prod_master.php">
				<i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add Product</a>
			    <br><br>
			</div>
		
			<div><a class="abtn green" href="../masters/dealer_master.php">
                                <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add Dealer</a>
                                <br><br>
                        </div>

		</div>
	</div>	
	<div>
	     <button class="collapsible">
	 	<i class="fa fa-cube fa-fw" aria-hidden="true"></i>Transaction
		<i class="fa fa-angle-down pull-right"></i>
	     </button>
		<div class="content">
			<p>Set Transaction Menu here </p>
		</div>
	</div>
	<div>
	    <button class="collapsible">
		<i class="fa fa-file-text fa-fw" aria-hidden="true"></i>Reports
		<i class="fa fa-angle-down pull-right"></i>
	    </button>
		<div class="content">
			<p>Set Menu here</p>
		</div>
	</div>	
	<div>
	    <button class="collapsible">
		<i class="fa fa-user fa-fw" aria-hidden="true"></i>User
		<i class="fa fa-angle-down pull-right"></i></button>
		<div class="content">
			<div><a href="user.php">Add User</a></div>	
		</div>
	</div>
	<div>
	    <button id="loutbtn" class="collapsible">
		<i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout</button>
	</div>
	
	</div>
	</div>	
	<script type="text/javascript">
		var coll = document.getElementsByClassName("collapsible");
		var i;

		for (i = 0; i < coll.length; i++) {
    			coll[i].addEventListener("click", function() {
        		this.classList.toggle("active");
        		var content = this.nextElementSibling;
        		if (content.style.display === "block") {
            			content.style.display = "none";
        		} else {
            			content.style.display = "block";
        			}
    				});
		}
		
		document.getElementById("loutbtn").onclick = function() {
			location.href = "../logout.php";	
			}
		document.getElementById("dashbtn").onclick = function() {
			location.href = "dashboard.php";
			}	
	</script>



</body>
</html>
