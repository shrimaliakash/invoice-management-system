<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo "uploads/$image"; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $login_session1; ?></p>
                <a href="admin_logout.php"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="Quotation">
                    <i class="fa fa-edit"></i> <span>Quotation</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="quotation.php"><i class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="Invoice">
                    <i class="fa fa-edit"></i> <span>Invoice</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="invoice.php"><i class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="Customer">
                    <i class="fa fa-user"></i> <span>Customer</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="customer.php"><i class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="Master">
                    <i class="fa fa-share"></i> <span>Master</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="Admin"><i class="fa fa-circle-o"></i> Admin</a>
                        <ul class="treeview-menu">
                            <li><a href="admin.php"><i class="fa fa-plus"></i> Add</a></li>
                        </ul>
                    </li>
                    <li><a href="Country"><i class="fa fa-circle-o"></i> Country</a>
                        <ul class="treeview-menu">
                            <li><a href="country.php"><i class="fa fa-plus"></i> Add</a></li>
                        </ul>
                    </li>
                    <li><a href="State"><i class="fa fa-circle-o"></i> State</a>
                        <ul class="treeview-menu">
                            <li><a href="state.php"><i class="fa fa-plus"></i> Add</a></li>
                        </ul>
                    </li>
                    <li><a href="City"><i class="fa fa-circle-o"></i> City</a>
                        <ul class="treeview-menu">
                            <li><a href="city.php"><i class="fa fa-plus"></i> Add</a></li>
                        </ul>
                    </li>
                    <li><a href="Category"><i class="fa fa-circle-o"></i> Category</a>
                        <ul class="treeview-menu">
                            <li><a href="category.php"><i class="fa fa-plus"></i> Add</a></li>
                        </ul>
                    </li>
                    <li><a href="Subcategory"><i class="fa fa-circle-o"></i> Subcategory</a>
                        <ul class="treeview-menu">
                            <li><a href="subcategory.php"><i class="fa fa-plus"></i> Add</a></li>
                        </ul>
                    </li>
                    <li><a href="Vendor"><i class="fa fa-circle-o"></i> Vendor</a>
                        <ul class="treeview-menu">
                            <li><a href="vendor.php"><i class="fa fa-plus"></i> Add</a></li>
                        </ul>
                    </li>
                    <li><a href="Product"><i class="fa fa-circle-o"></i> Product</a>
                        <ul class="treeview-menu">
                            <li><a href="product.php"><i class="fa fa-plus"></i> Add</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart"></i> <span>Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="invoice-report.php"><i class="fa fa-circle-o"></i> Invoice</a>
                    </li>
                    <li><a href="customer_invoice-report.php"><i class="fa fa-circle-o"></i> Customer wise Invoice</a>
                    </li>
                    <li><a href="quotation-report.php"><i class="fa fa-circle-o"></i> Quotation</a>
                    </li>
                    <li><a href="customer_quotation-report.php"><i class="fa fa-circle-o"></i> Customer wise Quotation</a>
                    </li>
                    <li><a href="product_sale-report.php"><i class="fa fa-circle-o"></i> Products</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>