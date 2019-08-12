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
$emp_name=$_POST['emp_name'];
$emp_dept=$_POST['Dept_name'];
$emp_code=$_POST['emp_code'];
$mobileno=$_POST['mobileno'];
$email=$_POST['email'];
$empid=intval($_GET['empid']);
$sql="update  tblemployee set emp_name=:emp_name,emp_code=:emp_code,emp_dept=:emp_dept,EmailId=:email,MobileNumber=:mobileno where id=:empid";
$query = $dbh->prepare($sql);
$query->bindParam(':emp_name',$emp_name,PDO::PARAM_STR);
$query->bindParam(':emp_dept',$emp_dept,PDO::PARAM_STR);
$query->bindParam(':emp_code',$emp_code,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_INT);
$query->execute();
$_SESSION['msg']="Employee info updated successfully";
header('location:'.BASE_URL.'/view-employee.php');


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inventory Management System | Edit Employee</title>
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
                <h4 class="header-line">Edit Employee Details</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Employee Details
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$empid=intval($_GET['empid']);
// $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblcategory.id as cid,tblauthors.AuthorName,tblauthors.id as athrid,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId where tblbooks.id=:bookid";

$sql = "SELECT tblemployee.EmailId,tblemployee.MobileNumber,tblemployee.emp_name,tblemployee.emp_code,tblemployee.emp_dept from tblemployee where tblemployee.id=:empid";

$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_INT);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="form-group">
<label>Employee Name :<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="emp_name" value="<?php echo htmlentities($result->emp_name);?>" required />
</div>

<div class="form-group">
<label>Employee Departament Name :<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="Dept_name" value="<?php echo htmlentities($result->emp_dept);?>" required />
</div>

<div class="form-group">
<label>Employee Code :<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="emp_code" value="<?php echo htmlentities($result->emp_code);?>" autocomplete="off" required />
</div>

<div class="form-group">
<label>Mobile Number :<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="mobileno" value="<?php echo htmlentities($result->MobileNumber);?>" maxlength="10" autocomplete="off" required />
</div>
                                        
<div class="form-group">
<label>Employee Email :<span style="color:red;">*</span></label>
<input class="form-control" type="email" name="email" id="emailid" value="<?php echo htmlentities($result->EmailId);?>" onBlur="checkAvailability()"  autocomplete="off" required  />
   <span id="user-availability-status" style="font-size:12px;"></span> 
</div>
 <?php }} ?>
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
