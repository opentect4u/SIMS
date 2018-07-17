<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);

	$errmsg=$err=$usererr=$passerr='';
	$log_id=$log_pass='';

        require("db/db_connect.php");
        session_start();
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
		
	   if (empty($_POST["user_id"])){
                        $usererr = "Please Supply User ID";
                   }else{
                         $log_id    = check($_POST["user_id"]);
		   }
	   if (empty($_POST["user_pwd"])){
			$passerr = "Please Valid Supply Password";
		  }else{
	  		$log_pass  = $_POST["user_pwd"];
		  }
   	   		
		$sql       = "select * from m_login_user where user_id='$log_id'";
                $result    = mysqli_query($db_connect,$sql);
                if ($result){
			if (mysqli_num_rows($result) > 0) {
				$login_data = mysqli_fetch_assoc($result);
				$pwd_hash   = $login_data['password'];

				$pwd = password_verify($log_pass,$pwd_hash);

				if($pwd){
 					  $_SESSION['user_id']   = $login_data['user_id'];
					  $_SESSION['user_type'] = $login_data['user_type'];
					  $_SESSION['ins_flag']=false;
					  $user_id=$_SESSION['user_id'];
					  $time = date("Y-m-d h:i:s");
					  $terminalname=$_SERVER['REMOTE_ADDR'];

					  $audit="insert into t_audit_trail(login_dt,user_id,terminal_name)
				                  values('$time','$user_id','$terminalname')";
					  $insert = mysqli_query($db_connect,$audit);

				          $max_sl = "select max(sl_no)sl_no from t_audit_trail where user_id = '$user_id'";
				          $result = mysqli_query($db_connect,$max_sl);
	
	      				 if(mysqli_num_rows($result) > 0){
					     $row   = mysqli_fetch_assoc($result);
					     $_SESSION['sl_no']=$row["sl_no"];	 
				         }	
				
				mysqli_close($sql);

              		        header("Location:post/dashboard.php");
				}	
                        }
                        else{
                                $errmsg = "Invalid User ID or Password";
                        }
                }
                else{
                        $err = "Failed To Login";
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
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="./css/login.css">
<head>

<body background="./img/ration.jpg" style="background-repeat: no-repeat; background-size: 100% auto; ">
	<h1 class="heading">Synergic Inventory Management System</h1>	

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
	
	<div class="container">
	  <div>
	    <label for="uname"><b>Username</b></label>
	  </div>
	  <div>
	    <input type="text" placeholder="Enter Username" class="lginput" id="uname" name="user_id" autofocus required/>
	  </div>
	  <div>
	    <label for="psw"><b>Password</b></label>
	  </div>
          <div>
	    <input type="password" placeholder="Enter Password" class="lginput" id="psw" name="user_pwd" required/>
	  </div>
	    <button type="submit">Login</button>
	</div>
        </form>
</body>
</html>

