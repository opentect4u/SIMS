<?php
      	ini_set("display_errors","1");
	error_reporting(E_ALL);
	
	require("../db/db_connect.php");
	require("menu.php");
	require("../session.php");

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
		$userid	  = check($_POST["user_id"]);
		$pwd      = check($_POST["user_pwd"]);
		$pwd_hash = password_hash($pwd,PASSWORD_DEFAULT);
		$uname    = check($_POST["user_name"]);
		$utype    = check($_POST["user_type"]);
		$create   = $_SESSION["user_id"];
		$time	  = date("Y-m-d h:i:s");

		if (!is_null($userid) && !is_null($pwd)){
		
		       $sql = "insert into m_login_user(user_id,
							password,
							user_type,
			   			   	user_name,
							user_status,
					   	   	created_by,
							created_dt)
					   	values('$userid',
						       '$pwd_hash',
						       '$utype',
						       '$uname',
						       'A',
				            	       '$create',
						       '$time')";
		       $result = mysqli_query($db_connect,$sql);       			       
		}
	}

	function check($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
	}

?>
<html>
<head>
	<title>Synergic Inventory Management System</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
	     User ID: <input type="text" name="user_id" size="50">
	     <br>	
	     Password:<input type="password" name="user_pwd" size="50">
	     <br>
	     Name:<input type="text" name="user_name" size="50">
	     <br>	
	     User Type:<select name="user_type">
			 <option value="A">Administrator</option>
			 <option value="G">General</option>
			</select>
	     <br>
	     <input type="submit" name="submit" value="Save">			
	</form>
</body>
</html>

						 
	     					 
