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

if(isset($_GET['issue_id']) && isset($_GET['assgin_id']) && isset($_GET['is_desc'])){
$id=$_GET['issue_id'];
$assn_id=$_GET['assgin_id'];
$is_desc=$_GET['is_desc'];
$sql = "UPDATE issue set is_status=0 WHERE is_id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_INT);
$query -> execute();

if($is_desc==3){

    $sql = "SELECT * from  issue where is_desc=3 AND assn_id=:assn_id";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':assn_id',$assn_id,PDO::PARAM_INT);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        foreach($results as $result)
        {  
            $p_name=($result->p_name);
            $sql1="update product set p_qty=p_qty+1 where Product_name=:p_name";
            $query1 = $dbh->prepare($sql1);
            $query1->bindParam(':p_name',$p_name,PDO::PARAM_STR);
            $query1->execute();

            $rid=($result->assn_id);
            $sql2="update Assignee set is_active=0 where id=:rid";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':rid',$rid,PDO::PARAM_INT);
            $query2->execute();
        }    
    }        
}
$_SESSION['resmsg']="Isuue Resolved Successfully";
header('location:'.BASE_URL.'/issue.php');

}

    ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inventory Management System | Manage Issue</title>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style type="text/css">
        .inactiveLink {
           pointer-events: none;
           cursor: not-allowed;
           opacity: 0.6;
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
                <h4 class="header-line">Issues In Laptops</h4>
    </div>
     <div class="row">

<?php if($_SESSION['resmsg']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['resmsg']);?>
 <?php echo htmlentities($_SESSION['resmsg']="");?>
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
                           Issue Having laptops
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Employee Name</th>
                                            <th>Laptop Name</th>
                                            <th>Issue Details</th>
                                            <th>Location status</th>
                                            <th>Creation</th>
                                            <th>Issue</th>
                                            <th>Comment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT issue.assn_id ,issue.CreationDate,issue.emp_name,issue.p_name,issue.is_id,issue.is_desc,issue.is_status,issue.is_loc,issue.is_com,Assignee.product_id,Assignee.emp_id from  issue join Assignee on issue.assn_id = Assignee.id";
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
                                            
                                            <td class="center"><?php echo htmlentities($result->emp_name);?></td>
                                            <td class="center"><?php echo htmlentities($result->p_name);?></td>                                            

                                            <td class="center">   
                                                
                                                <?php if($result->is_desc==1) {?> 
                                                    <option value="1">Repair</option>
                                                <?php } else if($result->is_desc==2) {?> 
                                                    <option value="2">New Asign</option>
                                                <?php } else {?>   
                                                    <option value="3">Return</option>
                                                <?php } ?> 
                                            </td>
                                        
                                           <td class="center">   
                                            
                                                <?php if($result->is_loc==1) {?> 
                                                    <option value="1">At Office</option>
                                                <?php } else {?> 
                                                    <option value="0">Out for serivce</option>
                                                <?php } ?>   
                                            
                                            </td>

                                        <td class="center"><?php echo htmlentities($result->CreationDate);?></td>
                                        <td class="center">   
                                            
                                                <?php if($result->is_status==1) {?> 
                                                    <option value="1">Not Resolved</option>
                                                <?php } else {?> 
                                                    <option value="0">Resolved</option>
                                                <?php } ?>   
                                            
                                        </td>

                                        <td class="center"><?php echo htmlentities($result->is_com);?></td>
                                        

                                            <td class="center">

                                            <a href="edit-issue.php?venid=<?php echo htmlentities($result->is_id);?>"><button class="btn btn-primary" type='submit' name="edit_status"><i class="fa fa-edit "></i> Edit status</button> 
                                          <a href="issue.php?issue_id=<?php echo $result->is_id ?>&assgin_id=<?php echo $result->assn_id ?>&is_desc=<?php echo $result->is_desc ?>" class="<?php echo htmlentities($result->is_status==0) ? 'inactiveLink' : '';?>">  <button class="btn btn-danger"><i class="fa fa-pencil"></i>Resolve</button>
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