<?php

    require ("../db/db_connect.php");

    $memoNo = $_GET['allotmentNo'];

    $sql = "SELECT 1 FROM td_allotment_sheet WHERE memo_no = '$memoNo'";

    $result = mysqli_query($db_connect, $sql);

    if(mysqli_num_rows($result) > 0) {

        echo 1;

    }
    else {

        echo 0;

    }

?>