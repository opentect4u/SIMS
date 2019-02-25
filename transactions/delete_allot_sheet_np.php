<?php

    require("../db/db_connect.php");

    if (isset($_GET['memoNo']))
    {
        $memoNo = $_GET['memoNo'];
        $prod_desc = $_GET['prod_desc'];
     
        $sql= "DELETE FROM td_allotment_sheet_np WHERE memoNo='$memoNo' AND prod_desc= '$prod_desc'";
        $result = mysqli_query($db_connect,$sql);
        

       /* echo "<script>
                    function alert_function()s
                    {
                        alert('Successfully Deleted');
                        window.location.href='view_allot_sheet_np.php';
                    } 
                    alert_function();
                </script>";*/
        
        header("Location: view_allot_sheet_np.php");
    }
    else    
    {
        header("Location: view_allot_sheet_np.php");
    }

?>