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

if(isset($_POST['update']))
{
$p_name=$_POST['p_name'];
$p_attr=$_POST['p_attr'];
$vendor=$_POST['vendor'];
$brand=$_POST['brand'];
$mouse=$_POST['mouse'];
$charger=$_POST['charger'];
$os=$_POST['os'];
$p_status=$_POST['p_status'];
$process=$_POST['process'];
$pid=intval($_GET['pid']);
$sql="update  product set Product_name=:p_name,prduct_attr=:p_attr,brand_id=:brand,vendor_id=:vendor,os=:os,mouse=:mouse,charger=:charger,status=:p_status,processer=:process where id=:pid";
$query = $dbh->prepare($sql);
$query->bindParam(':p_name',$p_name,PDO::PARAM_STR);
$query->bindParam(':p_attr',$p_attr,PDO::PARAM_STR);
$query->bindParam(':vendor',$vendor,PDO::PARAM_INT);
$query->bindParam(':brand',$brand,PDO::PARAM_INT);
$query->bindParam(':pid',$pid,PDO::PARAM_INT);
$query->bindParam(':p_status',$p_status,PDO::PARAM_INT);
$query->bindParam(':os',$os,PDO::PARAM_INT);
$query->bindParam(':process',$process,PDO::PARAM_STR);
$query->bindParam(':mouse',$mouse,PDO::PARAM_INT);
$query->bindParam(':charger',$charger,PDO::PARAM_INT);
$query->execute();
$_SESSION['msg']="Product info updated successfully";
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
    <title>Inventory Management System | Edit Product</title>
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
<?php 
$pid=intval($_GET['pid']);
$sql = "SELECT product.Product_name,product.prduct_attr,product.mouse,product.processer,product.charger,product.os,product.status,tblbrand.brand_name,tblbrand.id,tblvendor.vendor_name,tblvendor.id,product.id from  product join tblbrand on tblbrand.id=product.brand_id join tblvendor on tblvendor.id=product.vendor_id where product.id=:pid";
$query = $dbh -> prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="form-group">
<label>Product Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="p_name" value="<?php echo htmlentities($result->Product_name);?>" required />
</div>

<div class="form-group">
<label>Product Attribute<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="p_attr" value="<?php echo htmlentities($result->prduct_attr);?>" required />
</div>

<div class="form-group">
<label>Brand<span style="color:red;">*</span></label>
<select class="form-control" name="brand" required="required">
<option value="<?php echo htmlentities($result->cid);?>"> <?php echo htmlentities($catname=$result->brand_name);?></option>
<?php 
$status=1;
$sql1 = "SELECT * from  tblbrand where is_active=:status";
$query1 = $dbh -> prepare($sql1);
$query1-> bindParam(':status',$status, PDO::PARAM_STR);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
    ?>  
<option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->brand_name);?></option>
 <?php }} ?> 
</select>
</div>


<div class="form-group">
<label> Vendor<span style="color:red;">*</span></label>
<select class="form-control" name="vendor" required="required">
<option value="<?php echo htmlentities($result->athrid);?>"> <?php echo htmlentities($athrname=$result->vendor_name);?></option>
<?php 

$sql2 = "SELECT * from  tblvendor";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
foreach($result2 as $ret)
{           
     ?>  
<option value="<?php echo htmlentities($ret->id);?>"><?php echo htmlentities($ret->vendor_name);?></option>
 <?php }} ?> 
</select>
</div>

<div class="form-group">
<label>Product Status<span style="color:red;">*</span></label>
<select class="form-control" name="p_status" required="required">
<?php if($result->status==1) {?> 
    <option value="1">Free</option>
<?php }elseif($result->status==2) {?>
    <option value="2">Used</option>
<?php } else {?> 
    <option value="0">Issue</option>
<?php } ?>   
<option value="1">Free</option>
<option value="2">Used</option>
<option value="0">Issue</option>
</select>
</div>

<div class="form-group">
<label>Mouse<span style="color:red;">*</span></label>
<select class="form-control" name="mouse" required="required">
<?php if($result->mouse==1) {?> 
    <option value="1">Yes</option>
<?php } else {?> 
    <option value="0">No</option>
<?php } ?>   
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</div>

<div class="form-group">
<label>Charger<span style="color:red;">*</span></label>
<select class="form-control" name="charger" required="required">
<?php if($result->charger==1) {?> 
    <option value="1">Yes</option>
<?php } else {?> 
    <option value="0">No</option>
<?php } ?>   
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</div>

<div class="form-group">
<label>Processer<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="process" value="<?php echo htmlentities($result->processer);?>"  required="required" />
</div>

<div class="form-group">
<label>Os</label>
<?php if($result->os==1) {?>
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
<?php } else { ?>
<div class="radio">
<label>
<input type="radio" name="os" id="os" value="0" checked="checked">Linux
</label>
</div>
 <div class="radio">
<label>
<input type="radio" name="os" id="os" value="1">Windows
</label>
</div>
<?php } ?>
</div>
<?php } ?>


 <?php } ?>
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
