<?php

require '../db/db_connect.php';

$mr_no = $_POST['mr_no'];

$sql = "SELECT del_name,
                   del_reg FROM m_dealers WHERE del_cd = '$mr_no'";

$result = mysqli_query($db_connect, $sql);

$result_array = mysqli_fetch_assoc($result);

echo json_encode($result_array);

?>