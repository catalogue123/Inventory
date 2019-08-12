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
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from product  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_INT);
$query -> execute();
$_SESSION['delmsg']="Product deleted scuccessfully ";
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
    <title>Inventory Management System | Manage Products</title>
    <link rel="icon" type="image/png" href="http://parts.carcrew.in:80/public/image/icon/ccfavicon.png">
    <link rel="shortcut icon" type="image/png" href="http://parts.carcrew.in:80/public/image/icon/ccfavicon.png">
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Manage Product</h4>
    </div>
     <div class="row">
    <?php if($_SESSION['error']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-danger" >
 <strong>Error :</strong> 
 <?php echo htmlentities($_SESSION['error']);?>
<?php echo htmlentities($_SESSION['error']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['msg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['msg']);?>
<?php echo htmlentities($_SESSION['msg']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['updatemsg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['updatemsg']);?>
<?php echo htmlentities($_SESSION['updatemsg']="");?>
</div>
</div>
<?php } ?>


   <?php if($_SESSION['delmsg']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['delmsg']);?>
<?php echo htmlentities($_SESSION['delmsg']="");?>
</div>
</div>
<?php } ?>

</div>


        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Product Listing
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Brand Name</th>
                                            <th>Vendor Name</th>
                                            <th>Product Attributes</th>
                                            <th>processer</th>
                                            <th>Os</th>
                                            <th>Mouse</th>
                                            <th>Charger</th>
                                            <th>status</th>
                                            <th>Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT product.Product_name,tblbrand.brand_name,tblvendor.vendor_name,product.prduct_attr,product.id,product.os,product.p_qty,product.processer,product.mouse,product.charger,product.status from  product join tblbrand on tblbrand.id=product.brand_id join tblvendor on tblvendor.id=product.vendor_id";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->Product_name);?></td>
                                            <td class="center"><?php echo htmlentities($result->brand_name);?></td>
                                            <td class="center"><?php echo htmlentities($result->vendor_name);?></td>
                                            <td class="center"><?php echo htmlentities($result->prduct_attr);?></td>
                                            <td class="center"><?php echo htmlentities($result->processer);?></td>
                                            <td class="center"><?php if($result->os==1) {?>
                                            <a href="#" class="btn btn-success btn-xs">Windows</a>
                                            <?php } else {?>
                                            <a href="#" class="btn btn-danger btn-xs">Linux</a>
                                            <?php } ?></td>
                                            <td class="center"><?php if($result->mouse==1) {?>
                                            <a href="#" class="btn btn-success btn-xs">Yes</a>
                                            <?php } else {?>
                                            <a href="#" class="btn btn-danger btn-xs">No</a>
                                            <?php } ?></td>
                                            <td class="center"><?php if($result->charger==1) {?>
                                            <a href="#" class="btn btn-success btn-xs">Yes</a>
                                            <?php } else {?>
                                            <a href="#" class="btn btn-danger btn-xs">No</a>
                                            <?php } ?></td>     

                                            <?php if($result->status==1) {?> 
                                                <td class="center">Free</td> 
                                            <?php }elseif($result->status==2) {?>
                                                <td class="center">Used</td>
                                            <?php } else {?> 
                                                <td class="center">Issue</td>
                                            <?php } ?> 
                                            <td class="center"><?php echo htmlentities($result->p_qty);?></td>   

                                            <td class="center">

                                            <a href=<?php echo BASE_URL."/edit-product.php?pid="?><?php echo htmlentities($result->id);?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> 
                                          <a href=<?php echo BASE_URL."/manage-product.php?del="?><?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to delete?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>
                                            </td>
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
