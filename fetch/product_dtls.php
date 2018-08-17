<?php

    require("../db/db_connect.php");

    $dataList['product_id'] = $dataList['product_name'] = $dataList['product_type'] = [];

    $sql    =   "Select sl_no,prod_desc,prod_type from m_products";

    $result =   mysqli_query($db_connect, $sql);

    while ($data = mysqli_fetch_assoc($result)) {

        array_push($dataList['product_id'], $data['sl_no']);
        array_push($dataList['product_name'], $data['prod_desc']);
        array_push($dataList['product_type'], $data['prod_type']);

    }

    echo json_encode($dataList);

?>