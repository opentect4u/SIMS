<?php 

    $select_prd="select sl_no,prod_desc from m_products where prod_type ='NON PDS'";
    $prddesc=mysqli_query($db_connect,$select_prd);

    while($row=mysqli_fetch_assoc($prddesc)){
        echo ("<option value='".$row["prod_desc"]."'>".$row["prod_desc"]."</option>");
    }
    
?>






    


