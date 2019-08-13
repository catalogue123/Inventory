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

    $mouse = $keyboard = $pd = $charger = $usb = 0; 

    if(!empty($_POST['mouse'])) $mouse=$_POST['mouse'];
    if(!empty($_POST['keyboard'])) $keyboard=$_POST['keyboard'];
    if(!empty($_POST['pd'])) $pd=$_POST['pd'];
    if(!empty($_POST['charger'])) $charger=$_POST['charger'];
    if(!empty($_POST['usb'])) $usb=$_POST['usb'];

$rid=intval($_GET['rid']);
$sql="update Assignee set mouse=:mouse,keyboard=:keyboard,pd=:pd,charger=:charger,usb=:usb where id=:rid";
$query = $dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_INT);
$query->bindParam(':mouse',$mouse,PDO::PARAM_INT);
$query->bindParam(':keyboard',$keyboard,PDO::PARAM_INT);
$query->bindParam(':pd',$pd,PDO::PARAM_INT);
$query->bindParam(':charger',$charger,PDO::PARAM_INT);
$query->bindParam(':usb',$usb,PDO::PARAM_INT);
$query->execute();
$_SESSION['updatemsg']="Assignee updated successfully";
header('location:'.BASE_URL.'/manage-asign-product.php');


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inventory Management System | Edit Asignee</title>
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
$rid=intval($_GET['rid']);
$sql="SELECT tblemployee.emp_name,tblemployee.emp_dept,product.Product_name,product.os,Assignee.emp_id,Assignee.product_id,Assignee.assn_date,Assignee.mouse,Assignee.keyboard,Assignee.usb,Assignee.pd,Assignee.charger,Assignee.id as aid from  Assignee join tblemployee on tblemployee.id=Assignee.emp_id join product on product.id=Assignee.product_id where Assignee.id = :rid";
$query=$dbh->prepare($sql);
$query-> bindParam(':rid',$rid, PDO::PARAM_INT);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
  ?> 
<div class="form-group">
<label>Employee Name</label>
<input class="form-control" type="text" name="emp_name" value="<?php echo htmlentities($result->emp_name);?>" required />
</div>

<div class="form-group">
<label>Employee Dept</label>
<input class="form-control" type="text" name="emp_dept" value="<?php echo htmlentities($result->emp_dept);?>" required />
</div>

<div class="form-group">
<label>Laptop Name</label>
<input class="form-control" type="text" name="emp_dept" value="<?php echo htmlentities($result->Product_name);?>" required />
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="mouse" value="1" id="mouse" <?php echo htmlentities($result->mouse) ? 'checked' : '';?>>
  <label class="form-check-label" for="mouse">
    Mouse
  </label>

  <input class="form-check-input" type="checkbox" name="keyboard" value="1" id="keyboard" <?php echo htmlentities($result->keyboard) ? 'checked' : '';?>>
  <label class="form-check-label" for="keyboard">
    Keyboard
  </label>

  <input class="form-check-input" type="checkbox" name="pd" value="1" id="pd" <?php echo htmlentities($result->pd) ? 'checked' : '';?>>
  <label class="form-check-label" for="pd">
    Pendrive
  </label>

  <input class="form-check-input" type="checkbox" name="charger" value="1" id="charger" <?php echo htmlentities($result->charger) ? 'checked' : '';?>>
  <label class="form-check-label" for="charger">
    Charger
  </label>

  <input class="form-check-input" type="checkbox" name="usb" value="1" id="usb" <?php echo htmlentities($result->usb) ? 'checked' : '';?>>
  <label class="form-check-label" for="usb">
    USB Cabel
  </label>

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
<?php }} }?>
