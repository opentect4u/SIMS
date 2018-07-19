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
					  $_SESSION['prod_type_edit']=false;
					  $_SESSION['prod_catg_edit']=false;
					  $_SESSION['prod_qty_edit']=false;
					  $_SESSION['prod_edit']=false;
				 	  $_SESSION['dealer_master'] = false;
					  $_SESSION['allot_scale']=false;


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

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/bootstrap.min.css">
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<link href="./css/login.css" rel="stylesheet" id="bootstrap-css">
<script src="./js/login.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!--Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pr-wrap">
                <div class="pass-reset">
                    <label>
                        Enter the email you signed up with</label>
                    <input type="email" placeholder="Email" />
                    <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                </div>
            </div>
	    <div class="wrap">
		<h1 class="head-title">Synergic Inventory Management System</h1>
                <p class="form-title">Sign In</p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"  class="login">
                <input type="text" placeholder="Username" name="user_id"  autofocus required />
                <input type="password" placeholder="Password" name="user_pwd" required/>
                <input type="submit" value="Sign In" class="btn btn-success btn-sm" />
                <!--<div class="remember-forgot">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" />
                                    Remember Me
                                </label>
                            </div>
                        </div>
                       	    <div class="col-md-6 forgot-pass-content">
                            <a href="javascription:void(0)" class="forgot-pass">Forgot Password</a>
		       </div>
                    </div>
		</div>-->
                </form>
            </div>
        </div>
    </div>
    <div class="posted-by">Developed By: <a href="http://www.Synergicsoftek.in" target=_blank>Synergic Softek Solutions Pvt.Ltd.</a></div>
</div>

