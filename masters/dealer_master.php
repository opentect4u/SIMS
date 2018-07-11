<?php
        ini_set("display_errors","1");
        error_reporting(E_ALL);

        require("../db/db_connect.php");
        require("../session.php");
//      require("nav.php");
//      echo"<br><br>";
//      echo "<h1 class='elegantshadow'>Laxmi Narayan Stores</h1>";
//      echo "<hr class='hr'>";

//      require("menu.php");

        $delcdErr = $delnameErr = $delregErr = "";

        if ($_SERVER["REQUEST_METHOD"]=="POST"){

            $delcd = null;

            if (empty($_POST["del_cd"])) {
                $delcdErr = "Invalid Input";
            }else {
                $delcd = test_input($_POST["del_cd"]);
            }

            if (empty($_POST["del_name"])) {
                $delnameErr = "Invalid Input";
            }else {
                $delname = test_input($_POST["del_name"]);
            }

            if (empty($_POST["del_reg"])) {
                $delregErr = "Invalid Input";
            }else {
                $delreg = test_input($_POST["del_reg"]);
            }


			$deladr=$_POST["del_adr"];
			$deldist=$_POST["del_dist"];
			$user_id=$_SESSION["user_id"];
			$time=date("Y-m-d h:i:s");

            if(!is_null($delcd) && isset($user_id)) {
              $sql="insert into m_dealers(del_cd,del_name,del_adr,del_reg,del_dist,created_by,created_dt)
             values('$delcd','$delname','$deladr','$delreg','$deldist','$user_id','$time')";

              $result=mysqli_query($db_connect,$sql);
            }
                        
        }


        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

?>
<html>
<head>
        <title>Synergic Inventory Management System-Add Dealer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/master.css">
</head>
<script>
    $(document).ready(function() {

        $('#form').submit(function(e) {
            //e.preventDefault();
            var del_cd = $('#del_cd').val(),
                del_name = $('#del_name').val(),
                del_reg = $('#del_reg').val();

            $(".error").remove();

            if (del_cd == 0) {
                e.preventDefault();
                $('#del_cd').after('<span class="error">Invalid Input</span>');
            }
            if (del_name == 0) {
                e.preventDefault();
                $('#del_name').after('<span class="error">Invalid Input</span>');
            }
            if (del_reg == 0) {
                e.preventDefault();
                $('#del_reg').after('<span class="error">Invalid Input</span>');
            }


        });

    });
</script>
<body>
        <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <table>
                <tr>
                    <td><div class="alignlabel"><label for="del_cd"><strong style="color: red;">*</strong>Dealer Code:</label></div></td>
                    <td><input type ="text" name="del_cd" id="del_cd" size="150" style="width:400px"><span class="error"><?php echo $delcdErr;?></span></td>
                </tr>

                <tr>
                    <td><div class="alignlabel"><label for="del_name"><strong style="color: red;">*</strong>Name:</label></div></td>
                    <td><input type ="text" name="del_name" id="del_name" size="150" style="width:400px"><span class="error"><?php echo $delnameErr;?></td>
                </tr>

                <tr>
                    <td><div class="alignlabel"><label for="del_adr">Address:</label></div></td>
                    <td><textarea rows ="5" cols="50" name="del_adr" size="150" style="width:400px">Enter Address Here..</textarea></td>
                </tr>

                <tr>
                    <td><div class="alignlabel"><label for="del_reg"><strong style="color: red;">*</strong>Region:</label></div></td>
                    <td><input type ="text" name="del_reg" id="del_reg" size="150" style="width:400px"><span class="error"><?php echo $delregErr;?></td>
                </tr>

                <tr>
                    <?php require '../get_param_val.php';
                    ?>
                    <td><div class="alignlabel"><label for="del_dist">District:</label></div></td>
                    <td><input type ="text" name="del_dist" value="<?php echo f_getParam(4, $db_connect); ?>" readonly size="150" style="width:400px"></td>
                </tr>

                <tr>
                    <td><input type="submit" name="submit" value="save"></td>
                </tr>
            </table>
        </form>
</body>
</html>


