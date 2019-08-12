<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{
//code for captach verification
// if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
//         echo "<script>alert('Incorrect verification code');</script>" ;
//     } 
       
//Code for student ID
// $count_my_page = ("StudentId.txt");
// $hits = file($count_my_page);
// $hits[0] ++;
// $fp = fopen($count_my_page , "w");
// fputs($fp , "$hits[0]");
// fclose($fp); 
// $StudentId= $hits[0];   
$emp_name=$_POST['fullanme'];
$mobileno=$_POST['mobileno'];
$emp_code=$_POST['emp_code'];
$emp_dept=$_POST['Dept_name'];
$email=$_POST['email']; 
$password=md5($_POST['password']); 
$status=1;
$sql="INSERT INTO  tblemployee(emp_code,emp_dept,emp_name,MobileNumber,EmailId,Password,Status) VALUES(:emp_code,:emp_dept,:emp_name,:mobileno,:email,:password,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':emp_dept',$emp_dept,PDO::PARAM_STR);
$query->bindParam(':emp_code',$emp_code,PDO::PARAM_STR);
$query->bindParam(':emp_name',$emp_name,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();


if($lastInsertId)
{
    $success = array();
    $success[]="Success : Registration successfull with ".$emp_name."*";
}
else 
{
    $err = array();
    $err[] = "Something went wrong. Please try again!!!!";
}

}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Inventory Management System | Employee Signup</title>
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
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>   

<style type="text/css">
        .success_title{
            background-color: #05ab40;
            color:#fff;
            padding:15px;
            width: 50%;
            font-size: 16px;
        }
        .err_title{
            background-color: #e25746;
            color:#fff;
            padding:15px;
            width: 50%;
            font-size: 16px;
        }
        .pad-botm{
            padding-bottom: 0px;
        }
</style>  

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">User Signup</h4>
                
                            </div>               

        </div>

        <div class="err_cred">
            <?php if($success) {?>
                <h3 class="success_title"><?php echo $success[0];?></h3>
             <?php } ?> 
             <?php if($err) {?>
                <h3 class="err_title"><?php echo $err[0];?></h3>
             <?php } ?>     
        </div>     
        
             <div class="row">
           
<div class="col-md-9 col-md-offset-1">
               <div class="panel panel-danger">
                        <div class="panel-heading">
                           SINGUP FORM
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post" onSubmit="return valid();">
<div class="form-group">
<label>Enter Full Name</label>
<input class="form-control" type="text" name="fullanme" autocomplete="off" required />
</div>

<div class="form-group">
<label>Enter Departament Name<span style="color:red;">*</span></label>
<select class="form-control" name="Dept_name" required="required">
<option value="IT">IT</option>
<option value="Account">Account</option>
<option value="Sales">Sales</option>
<option value="Procurement">Procurement</option>
</select>
</div>

<div class="form-group">
<label>Enter Employee Code</label>
<input class="form-control" type="text" name="emp_code" autocomplete="off" required />
</div>

<div class="form-group">
<label>Mobile Number :</label>
<input class="form-control" type="text" name="mobileno" maxlength="10" autocomplete="off" required />
</div>
                                        
<div class="form-group">
<label>Enter Email</label>
<input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()"  autocomplete="off" required  />
   <span id="user-availability-status" style="font-size:12px;"></span> 
</div>

<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="password" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Confirm Password </label>
<input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
</div>
 <!-- <div class="form-group">
<label>Verification code : </label>
<input type="text"  name="vercode" maxlength="5" autocomplete="off" required style="width: 150px; height: 25px;" />&nbsp;<img src="captcha.php">
</div> -->                                
<button type="submit" name="signup" class="btn btn-danger" id="submit">Register Now </button>

                                    </form>
                            </div>
                        </div>
                            </div>
        </div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
