<?php

    require '../db/db_connect.php';

    $memoNo = $_GET['memo_no'];

    $result_array['memo_no'] =
    $result_array['gen_date'] =
    $result_array['mr_no'] =
    $result_array['delr_name'] =
    $result_array['delr_region'] =
    $result_array['aay_family'] =
    $result_array['aay_rice'] =
    $result_array['aay_wheat'] =
    $result_array['aay_sugar'] =
    $result_array['phh_head'] =
    $result_array['phh_rice'] =
    $result_array['phh_wheat'] =
    $result_array['sphh_head'] =
    $result_array['sphh_rice'] =
    $result_array['sphh_wheat'] =
    $result_array['sphh_sugar'] =
    $result_array['rksy1_head'] =
    $result_array['rksy1_rice'] =
    $result_array['rhsy1_wheat'] =
    $result_array['rksy2_head'] =
    $result_array['rksy2_rice'] =
    $result_array['rksy2_wheat'] = [];

    $sql = "SELECT   memo_no,
                     gen_date,
                     mr_no,
                     delr_name,
                     delr_region,
                     aay_family,
                     aay_rice,
                     aay_wheat,
                     aay_sugar,
                     phh_head,
                     phh_rice,
                     phh_wheat,
                     sphh_head,
                     sphh_rice,
                     sphh_wheat,
                     sphh_sugar,
                     rksy1_head,
                     rksy1_rice,
                     rhsy1_wheat,
                     rksy2_head,
                     rksy2_rice,
                     rksy2_wheat FROM td_allotment_sheet WHERE memo_no = '$memoNo'";

    $result = mysqli_query($db_connect, $sql);

    while ($data = mysqli_fetch_assoc($result)) {

        array_push($result_array['memo_no'], $data['memo_no']);
        array_push($result_array['gen_date'], $data['gen_date']);
        array_push($result_array['mr_no'], $data['mr_no']);
        array_push($result_array['delr_name'], $data['delr_name']);
        array_push($result_array['delr_region'], $data['delr_region']);
        array_push($result_array['aay_family'], $data['aay_family']);
        array_push($result_array['aay_rice'], $data['aay_rice']);
        array_push($result_array['aay_wheat'], $data['aay_wheat']);
        array_push($result_array['aay_sugar'], $data['aay_sugar']);
        array_push($result_array['phh_head'], $data['phh_head']);
        array_push($result_array['phh_rice'], $data['phh_rice']);
        array_push($result_array['phh_wheat'], $data['phh_wheat']);
        array_push($result_array['sphh_head'], $data['sphh_head']);
        array_push($result_array['sphh_rice'], $data['sphh_rice']);
        array_push($result_array['sphh_wheat'], $data['sphh_wheat']);
        array_push($result_array['sphh_sugar'], $data['sphh_sugar']);
        array_push($result_array['rksy1_head'], $data['rksy1_head']);
        array_push($result_array['rksy1_rice'], $data['rksy1_rice']);
        array_push($result_array['rhsy1_wheat'], $data['rhsy1_wheat']);
        array_push($result_array['rksy2_head'], $data['rksy2_head']);
        array_push($result_array['rksy2_rice'], $data['rksy2_rice']);
        array_push($result_array['rksy2_wheat'], $data['rksy2_wheat']);
    }

    echo json_encode($result_array);

?>