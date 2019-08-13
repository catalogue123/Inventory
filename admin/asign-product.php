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

if(isset($_POST['issue']))
{ 

    $status=1;    
    $emp_name=$_POST['emp_name'];
    $a_uuid=$_POST['a_uuid'];
    $p_name=$_POST['p_name'];
    $mouse = $keyboard = $pd = $charger = $usb = 0; 
    
    if(!empty($_POST['mouse'])) $mouse=$_POST['mouse'];
    if(!empty($_POST['keyboard'])) $keyboard=$_POST['keyboard'];
    if(!empty($_POST['pd'])) $pd=$_POST['pd'];
    if(!empty($_POST['charger'])) $charger=$_POST['charger'];
    if(!empty($_POST['usb'])) $usb=$_POST['usb'];

    $sql="INSERT INTO Assignee(emp_id,product_id,is_active,mouse,keyboard,pd,charger,usb,uuid) VALUES(:emp_name,:p_name,:status,:mouse,:keyboard,:pd,:charger,:usb,:a_uuid)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':emp_name',$emp_name,PDO::PARAM_INT);
    $query->bindParam(':p_name',$p_name,PDO::PARAM_INT);
    $query->bindParam(':status',$status,PDO::PARAM_INT);
    $query->bindParam(':mouse',$mouse,PDO::PARAM_INT);
    $query->bindParam(':keyboard',$keyboard,PDO::PARAM_INT);
    $query->bindParam(':pd',$pd,PDO::PARAM_INT);
    $query->bindParam(':charger',$charger,PDO::PARAM_INT);
    $query->bindParam(':usb',$usb,PDO::PARAM_INT);
    $query->bindParam(':a_uuid',$a_uuid,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        $_SESSION['msg']="laptop issued successfully";

        // $state=2;

        $p_name=$_POST['p_name'];
        $sql="update product set p_qty=p_qty-1 where id=:p_name";
        $query = $dbh->prepare($sql);
        $query->bindParam(':p_name',$p_name,PDO::PARAM_INT);
        $query->execute();
    }
    else 
    {
    $_SESSION['error']="Something went wrong. Please try again";
    }
    header('location:'.BASE_URL.'/manage-asign-product.php');
  // }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Invetory Management System | Asign Laptop</title>
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
                <h4 class="header-line">Asign Laptop</h4>
                
                            </div>
    <div class="error_db col-md-12">
    <?php if($_SESSION['err_msg']!="")
    {?>
        <div class="col-md-6">
        <div class="alert alert-danger" >
         <strong>Error :</strong> 
         <?php echo htmlentities($_SESSION['err_msg']);?>
        <?php echo htmlentities($_SESSION['err_msg']="");?>
        </div>
        </div>
    <?php } ?>
    </div>
    
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Issue a New Book
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Select Employee<span style="color:red;">*</span></label>
<select class="form-control" name="emp_name" required="required">
<option value="<?php echo htmlentities($result->id);?>">Select Employee Name</option>
<?php 
$status=1;
$sql1 = "SELECT emp_name,id from  tblemployee";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
// print_r($resultss);exit;
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
    ?>  
<option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->emp_name);?></option>
 <?php }} ?> 
</select>
</div> 

<div class="form-group">
<label>Select Laptop<span style="color:red;">*</span></label>
<select class="form-control" name="p_name" required="required">
<option value="<?php echo htmlentities($result->id);?>">Select Laptop Name</option>
<?php 
$status=1;
$sql1 = "SELECT Distinct(Product_name),id from product where p_qty>0";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
// print_r($resultss);exit;
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
    ?>  
<option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->Product_name);?></option>
 <?php }} ?> 
</select>
</div> 

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="mouse" value="1" id="mouse">
  <label class="form-check-label" for="mouse">
    Mouse
  </label>

  <input class="form-check-input" type="checkbox" name="keyboard" value="1" id="keyboard">
  <label class="form-check-label" for="keyboard">
    Keyboard
  </label>

  <input class="form-check-input" type="checkbox" name="pd" value="1" id="pd">
  <label class="form-check-label" for="pd">
    Pendrive
  </label>

  <input class="form-check-input" type="checkbox" name="charger" value="1" id="charger">
  <label class="form-check-label" for="charger">
    Charger
  </label>

  <input class="form-check-input" type="checkbox" name="usb" value="1" id="usb">
  <label class="form-check-label" for="usb">
    USB Cabel
  </label>

</div>
<div class="form-group">
<label>Product Uuid_no.<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="a_uuid" autocomplete="off"  required />
</div>

<button type="submit" name="issue" id="submit" class="btn btn-info">Issue Laptop </button>

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
