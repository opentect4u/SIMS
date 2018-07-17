<?php

    require '../db/db_connect.php';

    $mr_no = $_POST['mr_no'];
    $dealer_dtls = [];

    $sql = "SELECT del_cd,
                   del_name,
                   del_reg FROM m_dealers WHERE del_cd = $mr_no";

    $result = mysqli_query($db_connect, $sql);

    $data = mysqli_fetch_assoc($result);

        $dealer_dtls['del_cd'] = $data['del_cd'];
        $dealer_dtls['del_name'] = $data['del_name'];
        $dealer_dtls['del_reg'] = $data['del_reg'];

    echo json_encode($dealer_dtls);

?>