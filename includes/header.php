<div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=<?php echo BASE_URL."/dashboard.php"?>>

                    <img src="http://parts.carcrew.in:80/public/image/logo-color.png" / width="250px" height="60px">

                </a>

            </div>
<?php if(isset($_SESSION['login']))
{
?> 
            <div class="right-div">
                <a href="logout.php" class="btn btn-danger pull-right">LOG OUT</a>
            </div>
            <?php }?>
        </div>
    </div>
    <!-- LOGO HEADER END-->
<?php if(isset($_SESSION['login']))
{
?>    
<section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a class="menu-top-active" href=<?php echo BASE_URL."/dashboard.php"?>>DASHBOARD</a></li>
                           
                          
   <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/my-profile.php"?>>My Profile</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/change-password.php"?>>Change Password</a></li>
                                </ul>
                            </li>
                            <li>
                                 <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">Manage Laptop <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/issued-product.php"?>>My Accessories</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo BASE_URL."/issue-details.php"?>>Issue Status</a></li>
                                    
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php } else { ?>
        <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">                        
                          
  <li><a href=<?php echo BASE_URL."/adminlogin.php"?>>Admin Login</a></li>
                            <li><a href=<?php echo BASE_URL."/signup.php"?>>User Signup</a></li>
                             <li><a href=<?php echo BASE_URL."/index.php"?>>User Login</a></li>
                          

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php } ?>