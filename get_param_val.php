<?php

    function f_getParam($param_no, $db_connect) {

        $sql = "SELECT param_value FROM m_params
                                   WHERE paran_no = $param_no";
        $result = mysqli_query($db_connect, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data['param_value'];
    }

?>