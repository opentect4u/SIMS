<?php

require '../db/db_connect.php';

    $sql = "SELECT MAX(effective_dt) effective_dt FROM m_allot_scale";
    $result_data['prod_catg'] = $result_data['prod_desc'] = $result_data['unit_val'] = [];

    $result = mysqli_query($db_connect, $sql);

    $data = mysqli_fetch_assoc($result);

    $effective_dt = $data['effective_dt'];

    unset($sql);
    unset($result);

    $sql = "SELECT prod_catg,
                   prod_desc,
                   unit_val FROM m_allot_scale WHERE effective_dt = '$effective_dt'
                                                   GROUP BY prod_catg, prod_desc
                                                   ORDER BY prod_catg";


    $data = mysqli_query($db_connect, $sql);

    //$data = mysqli_fetch_assoc($result);

    while($result = mysqli_fetch_assoc($data)) {

        array_push($result_data['prod_catg'], $result['prod_catg']);

        array_push($result_data['prod_desc'], $result['prod_desc']);

        array_push($result_data['unit_val'], $result['unit_val']);

    }

    echo json_encode($result_data);
?>