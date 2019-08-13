<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:'.BASE_URL.'/index.php');
$_SESSION['ses_msg']="Oops!!! Your Session Has Expired!!!";
}
else{ 

if(isset($_POST['add']))
{
$p_name=$_POST['p_name'];
$p_attr=$_POST['p_attr'];
$brand=$_POST['brand'];
$vendor=$_POST['vendor'];
$process=$_POST['process'];
$mouse=$_POST['mouse'];
$os=$_POST['os'];
$p_qty=$_POST['p_qty'];
$p_status=$_POST['p_status'];
$charger=$_POST['charger'];
$sql="INSERT INTO product(product_name,prduct_attr,brand_id,vendor_id,status,os,processer,mouse,charger,p_qty) VALUES(:p_name,:p_attr,:brand,:vendor,:p_status,:os,:process,:mouse,:charger,:p_qty)";
$query = $dbh->prepare($sql);
$query->bindParam(':p_name',$p_name,PDO::PARAM_STR);
$query->bindParam(':p_attr',$p_attr,PDO::PARAM_STR);
$query->bindParam(':brand',$brand,PDO::PARAM_INT);
$query->bindParam(':vendor',$vendor,PDO::PARAM_INT);
$query->bindParam(':p_status',$p_status,PDO::PARAM_INT);
$query->bindParam(':os',$os,PDO::PARAM_INT);
$query->bindParam(':process',$process,PDO::PARAM_STR);
$query->bindParam(':mouse',$mouse,PDO::PARAM_INT);
$query->bindParam(':charger',$charger,PDO::PARAM_INT);
$query->bindParam(':p_qty',$p_qty,PDO::PARAM_INT);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Product Listed successfully";
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
}
header('location:'.BASE_URL.'/manage-product.php');

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inventory Management System | Add Product</title>
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
                <h4 class="header-line">Add Product</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Product Info
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Product Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="p_name" autocomplete="off"  required />
</div>

<div class="form-group">
<label>Product Attributes<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="p_attr" autocomplete="off"  required />
</div>

<div class="form-group">
<label>Brand<span style="color:red;">*</span></label>
<select class="form-control" name="brand" required="required">
<option value=""> Select Brands</option>
<?php 
$status=1;
$sql = "SELECT * from  tblbrand where is_active=:status";
$query = $dbh -> prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_INT);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->brand_name);?></option>
 <?php }} ?> 
</select>
</div>


<div class="form-group">
<label>Vendor<span style="color:red;">*</span></label>
<select class="form-control" name="vendor" required="required">
<option value=""> Select vendor</option>
<?php 

$sql = "SELECT * from  tblvendor";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->vendor_name);?></option>
 <?php }} ?> 
</select>
</div>

<div class="form-group">
<label>Os</label>
 <div class="radio">
<label>
<input type="radio" name="os" id="os" value="1" checked="checked">Windows
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="os" id="os" value="0">Linux
</label>
</div>
</div>

<div class="form-group">
<label>Product Status<span style="color:red;">*</span></label>
<select class="form-control" name="p_status" required="required">
<option value="1">Free</option>
<option value="2">Used</option>
<option value="0">Issue</option>
</select>
</div>

<div class="form-group">
<label>Mouse<span style="color:red;">*</span></label>
<select class="form-control" name="mouse" required="required">
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</div>

<div class="form-group">
<label>Processer<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="process" autocomplete="off"  required />
</div>

<div class="form-group">
<label>Charger<span style="color:red;">*</span></label>
<select class="form-control" name="charger" required="required">
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</div>

<div class="form-group">
<label>Product Quantity<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="p_qty" autocomplete="off"  required />
</div>


<button type="submit" name="add" class="btn btn-info">Add </button>

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
