<?php

    require("../db/db_connect.php");

    $dataList['unit'] = [];

    $sql    =   "Select prod_qty from m_prod_qty";

    $result =   mysqli_query($db_connect, $sql);

    while ($data = mysqli_fetch_assoc($result)) {

        array_push($dataList['unit'], $data['prod_qty']);

    }

    echo json_encode($dataList);

?>