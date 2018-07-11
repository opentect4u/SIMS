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

        if ($_SERVER["REQUEST_METHOD"]=="POST"){
                        $prodqty=$_POST["prod_qty"];
                        $user_id=$_SESSION["user_id"];
                        $time=date("Y-m-d h:i:s");

                        if(!is_null($prodqty)) {
                          $sql="insert into m_prod_qty(prod_qty,created_by,created_dt)
                                                 values('$prodqty','$user_id','$time')";
                          $result=mysqli_query($db_connect,$sql);                                 
                        }       
                        
        }

?>
<html>
<head>
    <title>Synergic Inventory Management System-Product Unit</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/master.css">
</head>
<script>
    $(document).ready(function() {

        $('#form').submit(function(e) {
            var prod_qty = $('#prod_qty').val();

            $(".error").remove();

            if (prod_qty.length < 1) {
                e.preventDefault();
                $('#prod_qty').after('<span class="error">Invalid Input</span>');
            }

        });

    });
</script>
<body>
    <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>
             <tr>
                <td><div class="alignlabel"><label for="prod_qty"><strong style="color: red;">*</strong>Product Unit Type:</label></div></td>
                <td><input type="text" id="prod_qty" name="prod_qty" size="150" style="width:400px"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="save"></td>
            </tr>
        </table>
    </form>
</body>
</html>


