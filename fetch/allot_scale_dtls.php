<?php

    require '../db/db_connect.php';

    $sql = "SELECT MAX(effective_dt) effective_dt FROM m_allot_scale";

    $result = mysqli_query($db_connect, $sql);

    $date = mysqli_fetch_assoc($result);

    $effective_dt = $date['effective_dt'];

    unset($sql);
    unset($result);

    $sql = "SELECT ";

?>