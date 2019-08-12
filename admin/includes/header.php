<div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://localhost/inventory/admin/dashboard.php">

                    <img src="http://parts.carcrew.in:80/public/image/logo-color.png" / width="250px" height="60px">
                </a>

            </div>

            <div class="right-div">
                <a href="logout.php" class="btn btn-danger pull-right">LOG OUT</a>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a class="menu-top-active" href=<?php echo BASE_URL."/dashboard.php" ?>>DASHBOARD</a></li>
                           
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Brands <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/add-brand.php"?>>Add Brand</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/manage-brand.php"?>>Manage Brands</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Vendor <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/add-vendor.php"?>>Add Vendor</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/manage-vendor.php"?>>Manage Vendors</a></li>
                                </ul>
                            </li>
 <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">Products<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/add-product.php"?>>Add Product</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/manage-product.php"?>>Manage Product</a></li>
                                </ul>
                            </li>

                           <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">Asign Laptop <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/asign-product.php"?>>Asign New Laptop</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/manage-asign-product.php"?>>Manage Asign Laptop</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/issue.php"?>>Issue In Laptop</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Mang. EMployee<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL.'/add-employee.php'?>>Add Employee</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/view-employee.php"?>>View Employee</a></li>
                                </ul>
                            </li> 
                    
  <li><a href=<?php echo BASE_URL."/change-password.php"?>>Change Password</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>