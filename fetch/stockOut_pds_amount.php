<?php

    require ("../db/db_connect.php");

    $do_no          =       $_GET['do_no'];
    $prod_catg      =       $_GET['prod_catg'];
    $prod_desc      =       $_GET['prod_desc'];

    if($prod_catg == "AAY")
    {

        if($prod_desc == "Rice")
        {

            $sql = "SELECT sum(ar_tot) ar_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $ar_tot = $row['ar_tot'];
            //$ar_tot = 1;
            echo json_encode($ar_tot);

        }
        else if($prod_desc == "Wheat") // not available as per client
        {

            $sql = "SELECT sum(aw_tot) aw_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $aw_tot = $row['aw_tot'];
            //$aw_tot = 2;
            echo json_encode($aw_tot);

        }
        else if($prod_desc == "Atta")
        {

            $sql = "SELECT sum(aa_tot) aa_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $aa_tot = $row['aa_tot'];
            //$aa_tot = 3;
            echo json_encode($aa_tot);

        }
        else if($prod_desc == "Sugar")
        {

            $sql = "SELECT sum(as_tot) as_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $as_tot = $row['as_tot'];
            //$as_tot = 4;
            echo json_encode($as_tot);

        }

    }
    else if($prod_catg == "PHH & SPHH")
    {

        if($prod_desc == "Rice")
        {

            $sql = "SELECT sum(pr_tot) pr_tot, sum(sr_tot) sr_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $pr_tot = $row['pr_tot'];
            $sr_tot = $row['sr_tot'];

            $psr_tot = $pr_tot + $sr_tot;

            //$psr_tot = 5;
            echo json_encode($psr_tot);

        }
        else if($prod_desc == "Wheat") // not available for both(phh, SPHH individually) as per client
        {

            $sql = "SELECT sum(pw_tot) pw_tot, sum(sw_tot) sw_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $pw_tot = $row['pw_tot'];
            $sw_tot = $row['sw_tot'];

            $psw_tot = $pw_tot + $sw_tot;

            //$psw_tot = 6;
            echo json_encode($psw_tot);

        }
        elseif($prod_desc == "Atta")
        {

            $sql = "SELECT sum(pa_tot) pa_tot, sum(sa_tot) sa_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $pa_tot = $row['pa_tot'];
            $sa_tot = $row['sa_tot'];

            $psa_tot = $pa_tot + $sa_tot;

            //$psa_tot = 7;
            echo json_encode($psa_tot);

        }
        elseif($prod_desc == "Sugar") // only for SPHH as per client
        {

            $sql = "SELECT sum(ss_tot) ss_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $ss_tot = $row['ss_tot'];

            //$ss_tot = 8;
            echo json_encode($ss_tot);

        }

    }
    elseif($prod_catg == "RKSY-I")
    {

        if($prod_desc == "Rice")
        {

            $sql = "SELECT sum(rr1_tot) rr1_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $rr1_tot = $row['rr1_tot'];

            //$rr1_tot = 9;
            echo json_encode($rr1_tot);

        }
        elseif($prod_desc == "Wheat") 
        {

            $sql = "SELECT sum(rw1_tot) rw1_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $rw1_tot = $row['rw1_tot'];

            //$rw1_tot = 10;
            echo json_encode($rw1_tot);

        }
        elseif($prod_desc == "Atta") // not available as per client 
        {

            $sql = "SELECT sum(ra1_tot) ra1_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $ra1_tot = $row['ra1_tot'];

            //$ra1_tot = 11;
            echo json_encode($ra1_tot);

        }
       /* elseif($prod_desc == "Sugar") // not available as per client
        {



        } */

    }
    elseif($prod_catg == "RKSY-II")
    {

        if($prod_desc == "Rice")
        {

            $sql = "SELECT sum(rr2_tot) rr2_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $rr2_tot = $row['rr2_tot'];

            //$rr2_tot = 12;
            echo json_encode($rr2_tot);

        }
        elseif($prod_desc == "Wheat") 
        {

            $sql = "SELECT sum(rw2_tot) rw2_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $rw2_tot = $row['rw2_tot'];

            //$rw2_tot = 13;
            echo json_encode($rw2_tot);

        }
        elseif($prod_desc == "Atta") // not available as per client
        {

            $sql = "SELECT sum(ra2_tot) ra2_tot FROM td_allotment_sheet WHERE memo_no = '$do_no' ";
            $result = mysqli_query($db_connect, $sql);

            $row = mysqli_fetch_array($result);

            $ra2_tot = $row['ra2_tot'];

            //$ra2_tot = 14;
            echo json_encode($ra2_tot);

        }
      /*  elseif($prod_desc == "Sugar") // not available as per client
        {



        } */

    }



?>