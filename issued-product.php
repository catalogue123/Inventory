<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:'.BASE_URL.'/index.php');
$_SESSION['ses_msg']="Oops!!! Your Session Has Expired!!!";
}
else{ 
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from tblbooks  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$_SESSION['delmsg']="Category deleted scuccessfully ";
header('location:'.BASE_URL.'/manage-books.php');

}


    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inventory Management System | Asigned Laptop</title>
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
                <h4 class="header-line">Asigned Laptop</h4>
    </div>
    
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

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Asigned Laptop
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Employee Name</th>
                                            <th>Employee Dept</th>
                                            <th>Laptop Name</th>
                                            <th>Asign Date</th>
                                            <th>Os</th>
                                            <th>Mouse</th>
                                            <th>charger</th>
                                            <th>Keyboard</th>
                                            <th>PenDrive</th>
                                            <th>Uuid</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$sid=$_SESSION['stdid'];
$sql="SELECT product.Product_name,product.os,tblemployee.emp_name,tblemployee.emp_dept,Assignee.emp_id,Assignee.product_id,Assignee.charger,Assignee.is_active,Assignee.assn_date,Assignee.pd,Assignee.keyboard,Assignee.mouse,Assignee.uuid,Assignee.id as rid from  Assignee join tblemployee on tblemployee.id=Assignee.emp_id join product on product.id=Assignee.product_id where tblemployee.id=:sid AND Assignee.is_active=1 order by Assignee.id desc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->emp_name);?></td>
                                            <td class="center"><?php echo htmlentities($result->emp_dept);?></td>
                                            <td class="center"><?php echo htmlentities($result->Product_name);?></td>
                                            <td class="center"><?php echo htmlentities($result->assn_date);?></td>

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
                                            <td class="center"><?php if($result->pd==1) {?>
                                            <a href="#" class="btn btn-success btn-xs">Yes</a>
                                            <?php } else {?>
                                            <a href="#" class="btn btn-danger btn-xs">No</a>
                                            <?php } ?></td> 
                                            <td class="center"><?php if($result->keyboard==1) {?>
                                            <a href="#" class="btn btn-success btn-xs">Yes</a>
                                            <?php } else {?>
                                            <a href="#" class="btn btn-danger btn-xs">No</a>
                                            <?php } ?></td>

                                            <td class="center"><?php echo htmlentities($result->uuid);?></td>

                                            <td class="center">

                                            <a href=<?php echo BASE_URL."/complain.php?rid="?><?php echo htmlentities($result->rid);?>"><button class="btn btn-danger"><i class="fa fa-edit "></i>Raise Issue</button> 
                                         
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
