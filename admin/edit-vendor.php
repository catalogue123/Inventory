<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
$_SESSION['ses_msg']="Oops!!! Your Session Has Expired!!!";
}
else{ 

if(isset($_POST['update']))
{
$venid=intval($_GET['venid']);
$vendor=$_POST['vendor'];
$sql="update  tblvendor set vendor_name=:vendor where id=:venid";
$query = $dbh->prepare($sql);
$query->bindParam(':vendor',$vendor,PDO::PARAM_STR);
$query->bindParam(':venid',$venid,PDO::PARAM_INT);
$query->execute();
$_SESSION['updatemsg']="Vendor info updated successfully";
header('location:'.BASE_URL.'/manage-vendor.php');



}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inventory Management System | Edit Vendor</title>
    <link rel="icon" type="image/png" href="http://parts.carcrew.in:80/public/image/icon/ccfavicon.png">
    <link rel="shortcut icon" type="image/png" href="http://parts.carcrew.in:80/public/image/icon/ccfavicon.png">
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Edit Vendor</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Vendor Info
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Vendor Name</label>
<?php 
$venid=intval($_GET['venid']);
$sql = "SELECT * from  tblvendor where id=:venid";
$query = $dbh -> prepare($sql);
$query->bindParam(':venid',$venid,PDO::PARAM_INT);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>   
<input class="form-control" type="text" name="vendor" value="<?php echo htmlentities($result->vendor_name);?>" required />
<?php }} ?>

<div class="form-group">
<label>Select Vendor Category<span style="color:red;">*</span></label>
<select class="form-control" name="vendor_cat" required="required">
    <?php if($result->vendor_cat==1){?>
        <option value="<?php echo htmlentities($result->vendor_cat);?>">IT</option>
    <?php } ?>
    <?php if($result->vendor_cat==2){?>
        <option value="<?php echo htmlentities($result->vendor_cat);?>">Account</option>
    <?php } ?>
    <?php if($result->vendor_cat==3){?>
        <option value="<?php echo htmlentities($result->vendor_cat);?>">Sales</option>
    <?php } ?>
    <?php if($result->vendor_cat==4){?>
        <option value="<?php echo htmlentities($result->vendor_cat);?>">Procurement</option>
    <?php } ?>   
<option value="1">IT</option>
<option value="2">Account</option>
<option value="3">Sales</option>
<option value="4">Procurement</option>
</select>
</div>

</div>

<button type="submit" name="update" class="btn btn-info">Update </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>