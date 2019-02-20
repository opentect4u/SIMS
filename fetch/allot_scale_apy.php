<?php

    require '../db/db_connect.php';

    $sql = "SELECT MAX(effective_dt) effective_dt FROM m_allot_scale";
    $result_data['prod_catg'] = $result_data['prod_desc'] = $result_data['unit_val'] = [];

    $result = mysqli_query($db_connect, $sql);

    $data = mysqli_fetch_assoc($result);

    $effective_dt = $data['effective_dt'];

    unset($sql);
    unset($result);

    $sql = "SELECT unit_val FROM m_allot_scale WHERE effective_dt = '$effective_dt' 
                                                AND prod_catg = 'APY'
                                                AND prod_desc = 'Rice'
                                                AND per_unit = 'Head' ";

    
    $data = mysqli_query($db_connect, $sql);
    $data_unit = mysqli_fetch_assoc($data);
    $unit_val = $data_unit['unit_val'];
                   
    echo json_encode($unit_val);
                                               

?>