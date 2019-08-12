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

if(isset($_POST['return']))
{
$rid=intval($_GET['rid']);
$issue_desc=$_POST['issue_desc'];
$emp_name=$_POST['emp_name'];
$p_name=$_POST['p_name'];
$is_com=$_POST['is_com'];
$status=1;
$is_loc=1;
$sql="INSERT INTO issue (assn_id,is_desc,emp_name,p_name,is_status,is_loc,is_com) VALUES(:rid,:issue_desc,:emp_name,:p_name,:status,:is_loc,:is_com)";
$query = $dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_INT);
$query->bindParam(':issue_desc',$issue_desc,PDO::PARAM_INT);
$query->bindParam(':emp_name',$emp_name,PDO::PARAM_STR);
$query->bindParam(':p_name',$p_name,PDO::PARAM_STR);
$query->bindParam(':is_com',$is_com,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_INT);
$query->bindParam(':is_loc',$is_loc,PDO::PARAM_INT);
$query->execute();

$_SESSION['msg']="Issue Raised successfully";
header('location:'.BASE_URL.'/issue-details.php');


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issued Raised</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

<style type="text/css">
  .others{
    color:red;
}

</style>


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
                <h4 class="header-line">Issued Book Details</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Issued Book Details
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$rid=intval($_GET['rid']);
$sql = "SELECT tblemployee.emp_name,product.Product_name,Assignee.emp_id,Assignee.product_id,Assignee.id as rid from  Assignee join tblemployee on tblemployee.id=Assignee.emp_id join product on product.id=Assignee.product_id where Assignee.id=:rid";
$query = $dbh -> prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                   



<div class="form-group">
<label>Employee Name</label>
<input class="form-control " type="text" name="emp_name" value="<?php echo htmlentities($result->emp_name);?>" />
</div>

<div class="form-group">
<label>Product Name</label>
<input class="form-control" type="text" name="p_name" value="<?php echo htmlentities($result->Product_name);?>"/>
</div>


<?php }} ?>

<div class="form-group">
<label>Select Issue<span style="color:red;">*</span></label>
<select class="form-control" name="issue_desc" required="required">
<option value="1">Repairing</option>
<option value="2">New Asign</option>
<option value="3">Return</option>
</select>
</div>

<div class="form-group">
<label>Leave Comment</label>
<textarea class="form-control" type="text" name="is_com" autocomplete="off" required ></textarea>
</div>

<button type="submit" name="return" id="submit" class="btn btn-info">Submit Issue </button>

 </div>

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
