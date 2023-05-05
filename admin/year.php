<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {

    if(isset($_POST['submit'])) {
        $year=$_POST['sesssion'];
        $ret=mysqli_query($bd, "INSERT INTO year(year) VALUES('$year')");
        if($ret) {
            $_SESSION['msg']="Year Created Successfully !!";
        } else {
            $_SESSION['msg']="Error : Year not created";
        }
    }
    if(isset($_GET['del'])) {
        mysqli_query($bd, "DELETE FROM year where id = '".$_GET['id']."'");
        $_SESSION['delmsg']="Year deleted !!";
    }
    ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Session</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
   
<?php if($_SESSION['alogin']!="") {
    include('includes/menubar.php');
}
    ?>
   
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Add Year  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Session
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="session" method="post">
   <div class="form-group">
    <label for="session">Create Session </label>
    <input type="text" class="form-control" id="sesssion" name="sesssion" placeholder="Session" />
  </div>
 <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                   
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Session
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Year</th>
                                            <th>Creation Date</th>
                                            <th>Updated Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql=mysqli_query($bd, "select * from year");

                                    while($row=mysqli_fetch_array($sql)) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlentities($row['id']);?></td>
                                        <td><?php echo htmlentities($row['year']);?></td>
                                        <td><?php echo htmlentities($row['created_date']);?></td>
                                        <td><?php echo htmlentities($row['update_date']);?></td>
                                        <td>
                                            <a href="year.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                                <button class="btn btn-danger">Delete</button>
                                            </a>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     
                </div>
            </div>





        </div>
    </div>
    
  <?php include('includes/footer.php');?>
    
    <script src="assets/js/jquery-1.11.1.js"></script>
    
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>