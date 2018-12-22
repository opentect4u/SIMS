
    <div class="block">
        <div>
            <button class="collapsible"><?php require_once("../post/sims_function.php"); ?>

                Application Date: <?php echo date("d-m-Y", strtotime(f_getparamval(7, $db_connect))) ?></button>
        </div>

        <div>
            <button id="dashbtn" class="collapsible"><i class="fa fa-home fa-fw" aria-hidden="true"></i>Dashboard</button>
        </div>
        <div>
            <button class="collapsible">
                <i class="fa fa-asterisk fa-fw" aria-hidden="true"></i>Master
                <i class="fa fa-angle-down pull-right" aria-hidden="true"></i>
            </button>
            <div class="content" >
                <div class="manue">
                    <div> <br>
                        <a class="abtn green" href="../masters/prod_type.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add Product Type</a>
                        <br><br>
                    </div>

                    <div>
                        <a class="abtn green" href="../masters/prod_type_view.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View Product Type</a>
                    </div>

                    <hr class='hr' style="margin-top: 15px;">

                    <div><a class="abtn green" href="../masters/prod_catg.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add Category</a>
                        <br><br>
                    </div>

                    <div>
                        <a class="abtn green" href="../masters/prod_catg_view.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View Product Category</a>
                    </div>

                    <hr class='hr' style="margin-top: 15px;">

                    <div>
                        <a class="abtn green" href="../masters/prod_qty.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add Unit</a>
                        <br><br>
                    </div>

                    <div>
                        <a class="abtn green" href="../masters/prod_qty_view.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View Unit</a>
                    </div>

                    <hr class='hr' style="margin-top: 15px;">

                    <div>
                        <a class="abtn green" href="../masters/prod_master.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add Product</a>
                        <br><br>
                    </div>

                    <div>
                        <a class="abtn green" href="../masters/prod_master_view.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View Product</a>
                    </div>

                    <hr class='hr' style="margin-top: 15px;">

                    <!--<div>
                        <a class="abtn green" href="../masters/short_master.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Shortage Parameters</a>
                        <br><br>
                    </div>

                    <div>
                        <a class="abtn green" href="../masters/short_master_view.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View Shortage Parameters</a>
                    </div>

                    <hr class='hr' style="margin-top: 15px;"> -->

                    <div><a class="abtn green" href="../masters/dealer_master.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add Dealer</a>
                        <br><br>
                    </div>

                    <div>
                        <a class="abtn green" href="../masters/dealer_master_view.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View Dealer</a>
                    </div>

                    <hr class='hr' style="margin-top: 15px;">

                   <!-- <div><a class="abtn green" href="../masters/allot_scale.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Allotment Scale</a>
                        <br><br>
                    </div>

                    <div>
                        <a class="abtn green" href="../masters/allot_scale_view.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View Allotment Scale</a>
                    </div>

                    <hr class='hr' style="margin-top: 15px;">-->

                    <div>
                        <a class="abtn green" href="../masters/rate_master.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>PDS Rate</a>
                        <br><br>
                    </div>

                    <div>
                        <a class="abtn green" href="../masters/rate_master_view.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View PDS Rate</a>
                    </div>

                    <hr class='hr' style="margin-top: 15px;">

                    <div>
                        <a class="abtn green" href="../masters/rate_master_np.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>NON PDS Rate</a>
                            <br><br>
                    </div>
                    
                    <div>
                        <a class="abtn green" href="../masters/rate_master_np_view.php">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View NP Rate</a>
                        <br><br>
                    </div>

                    <hr class='hr' style="margin-top: 15px;">

                    <div>
                        <a class="abtn green" href="../masters/short_master.php">
                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Shortage Parameters</a>
                        <br><br>
                    </div>

                    <div>
                        <a class="abtn green" href="../masters/short_master_view.php">
                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View Shortage Parameters</a>
                    </div>
                    
                    <hr class='hr' style="margin-top: 15px;">
                    
                     <div>

                        <a class="abtn green" href="../masters/allot_scale.php">

                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Allotment Scale</a>
                        <br><br>

                    </div>

                    <div>

                        <a class="abtn green" href="../masters/allot_scale_view.php">

                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View Allotment Scale</a>

                    </div>

                </div>

            </div>

        </div>

        <div>
            <button class="collapsible">

                <i class="fa fa-cube fa-fw" aria-hidden="true"></i>PDS TRANSATION

                <i class="fa fa-angle-down pull-right"></i>

            </button>

            <div class= "content" >
                <div class= "menue">

                   <br>

                    <div>

                        <a class="abtn green" href="../transactions/stock_in_pds.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Stock In PDS</a>

                    </div>
                    <br>

                    <div>

                        <a class="abtn green" href="../transactions/allot_sheet.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>PDS Allotment Sheet</a>

                       

                    </div>

                    <br>
                    <div>

                        <a class="abtn green" href="../transactions/allot_sheet_view.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View PDS Allotment Sheet</a>
                    </div>
                    <br>

                    <div>

                        <a class="abtn green" href="../transactions/stock_out_pds.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Stock out PDS</a>


                    </div>
                    <br>

                    <div>

                        <a class="abtn green" href="../approve/aprv_allot_sheet.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Apprv PDS Allotment Sheet</a>

                    </div>
                    <br>

                    
                    <div>

                        <a class="abtn green" href="../transactions/view_stock_in_pds.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Apprv PDS Stock Trans</a>

                    </div>
                    <br>

                </div>

            </div>

        </div> 

       <!-- <div>
            <button class="collapsible">

                <i class="fa fa-asterisk fa-fw" aria-hidden="true"></i>Manage NON PDS

                <i class="fa fa-angle-down pull-right"></i>

            </button>

            <div class= "content">

                <div class= "menue">

                    <br>

                    <div>
                        <a class="abtn green" href="../masters/rate_master_np.php">
                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Product Rate</a>
                        <br><br>
                    </div>

                    <div>
                        <a class="abtn green" href="../masters/rate_master_np_view.php">
                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View Rate</a>
                    </div>
                    <br>

                </div>

            </div>
            
        </div>-->

        <div>

            <button class="collapsible">

                <i class="fa fa-cube fa-fw" aria-hidden="true"></i>NP Transaction

                <i class="fa fa-angle-down pull-right"></i>

            </button>

            <div class="content">

                <div class="manue">
                    <br>

                    <div>

                        <a class="abtn green" href="../transactions/stock_in_np.php">

                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Stock In NON PDS</a>

                    </div>
                    <br>

                    <div>

                        <a class="abtn green" href="../transactions/allot_sheet_np.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>NP Allotment Sheet</a>

                    </div>
                    <br>

                    <div>

                        <a class="abtn green" href="../transactions/view_allot_sheet_np.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>View NP Allotment Sheet</a>
                    </div>

                    <br>
                    <div>

                        <a class="abtn green" href="../transactions/stock_out_np.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Stock out NON PDS</a>

                    </div>
                    <br>

                    <div>

                        <a class="abtn green" href="../transactions/view_stock_in_np.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Approve NP Stock In</a>

                    </div>
                    <br>

                    <div>

                        <a class="abtn green" href="../transactions/view_stock_out_np.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Approve NP Stock Out</a>

                    </div>
                    <br>

                </div>

            </div>

        </div>

        <div>

            <button class="collapsible">

                <i class="fa fa-file-text fa-fw" aria-hidden="true"></i>Reports

                <i class="fa fa-angle-down pull-right"></i>

            </button>

            <div class="content">

                <div class="manue">

                    <br>

                    <div>

                        <a class="abtn green" href="../report/stock_reg_ip.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>PDS Stock Register</a>

                    </div>
                    <br>

                    <div>

                        <a class="abtn green" href="../report/stock_reg_ip_np.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>NP Stock Register</a>

                    </div>

                    <hr class='hr' style="margin-top: 15px;">

                    <div>

                        <a class="abtn green" href="../report/allot_sheet_report.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>

                            PDS Allotment Sheet Report

                        </a>

                        <br><br>
                        
                        <a class="abtn green" href="../report/allot_sheet_report_np.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>

                            NP Allotment Sheet Report

                        </a>

                    </div>

                    <hr class='hr' style="margin-top: 15px;">

                    <div>

                        <a class="abtn green" href="../report/pds_challan_form.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>PDS Challan</a>

                        <br><br>

                    </div>

                    <div>

                        <a class="abtn green" href= "../report/np_challan_form.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>NON PDS Challan</a>

                        <br><br>

                    </div>

                </div>

            </div>

        </div>

 <!--       <div>

            <button class="collapsible">

                <i class="fa fa-user fa-fw" aria-hidden="true"></i>User

                <i class="fa fa-angle-down pull-right"></i>

            </button>

            <div class="content">

                <div class="manue">

                    <br>

                    <div>

                        <a class="abtn green" href="../post/user.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add User</a>

                    </div> 

                    <hr class='hr' style="margin-top: 15px;">

                    <div>

                        <a class="abtn green" href="../post/software_date.php">

                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Software Date</a>

                    </div>

                    <br>

                </div>

            </div>

        </div> -->

       <!-- <div>

            <button id="loutbtn" class="collapsible">

                <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout</button>

        </div> -->

    </div>

