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
$brand=$_POST['brand'];
$status=$_POST['status'];
$vendor=$_POST['vendor'];
$branid=intval($_GET['branid']);
$sql="update tblbrand set brand_name=:brand,is_active=:status,vendor_id=:vendor where id=:branid";
$query = $dbh->prepare($sql);
$query->bindParam(':brand',$brand,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_INT);
$query->bindParam(':vendor',$vendor,PDO::PARAM_INT);
$query->bindParam(':branid',$branid,PDO::PARAM_INT);
$query->execute();
$_SESSION['updatemsg']="Brand updated successfully";
header('location:'.BASE_URL.'/manage-brand.php');


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inventory Management System | Edit Brand</title>
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
                <h4 class="header-line">Edit category</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Category Info
</div>
 
<div class="panel-body">
<form role="form" method="post">
<?php 
$branid=intval($_GET['branid']);
$sql="SELECT tblbrand.id,tblbrand.brand_name,tblbrand.is_active,tblbrand.vendor_id,tblbrand.CreationDate,tblbrand.updated_date,tblvendor.vendor_name from  tblbrand join tblvendor on tblbrand.vendor_id = tblvendor.id where tblbrand.id = :branid";
$query=$dbh->prepare($sql);
$query-> bindParam(':branid',$branid, PDO::PARAM_INT);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
  ?> 
<div class="form-group">
<label>Brand Name</label>
<input class="form-control" type="text" name="brand" value="<?php echo htmlentities($result->brand_name);?>" required />
</div>
<div class="form-group">
<label>Status</label>
<?php if($result->is_status==1) {?>
 <div class="radio">
<label>
<input type="radio" name="status" id="status" value="1" checked="checked">Active
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="status" id="status" value="0">Inactive
</label>
</div>
<?php } else { ?>
<div class="radio">
<label>
<input type="radio" name="status" id="status" value="0" checked="checked">Inactive
</label>
</div>
 <div class="radio">
<label>
<input type="radio" name="status" id="status" value="1">Active
</label>
</div
<?php } ?>
</div>
<?php }} ?>

<div class="form-group">
<label>Vendors<span style="color:red;">*</span></label>
<select class="form-control" name="vendor" required="required">
<option value="<?php echo htmlentities($result->id);?>"> <?php echo htmlentities($catname=$result->vendor_name);?></option>
<?php 
$status=1;
$sql1 = "SELECT * from  tblvendor";
$query1 = $dbh -> prepare($sql1);
$query1-> bindParam(':status',$status, PDO::PARAM_INT);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
// print_r($resultss);exit;
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
if($catname==$row->vendor_name)
{
continue;
}
else
{
    ?>  
<option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->vendor_name);?></option>
 <?php }}} ?> 
</select>
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
