<?php

    require ("../db/db_connect.php");

    $del_cd          =       $_GET['del_cd'];
    
    $sql = "SELECT MAX(trans_dt) trans_dt FROM td_del_payment
            WHERE mr_no = $del_cd ";

    $result    =   mysqli_query($db_connect, $sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $trans_dt = $row['trans_dt'];
    }

    $sql_due = "SELECT due_amnt FROM td_del_payment WHERE
                mr_no = $del_cd AND trans_dt = '$trans_dt' ";

    $result_due    =   mysqli_query($db_connect, $sql_due);
    while($row = mysqli_fetch_assoc($result_due))
    {
        $due_amnt = $row['due_amnt'];
    }
    
    echo json_encode($due_amnt);


?>