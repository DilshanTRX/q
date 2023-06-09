<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {

    if(isset($_POST['submit'])) {
        $subject_code=$_POST['subject_code'];
        $subject_name=$_POST['subject_name'];
        $course_id=$_POST['course_id'];
        $ret=mysqli_query($bd, "INSERT into subject(subject_code,name,course_id) values('$subject_code','$subject_name','$course_id')");
        echo $ret;
        if($ret) {
            $_SESSION['msg']="Course Created Successfully !!";
        } else {
            $_SESSION['msg']="Error : Course not created";
        }
    }
    if(isset($_GET['del'])) {
        mysqli_query($bd, "delete from subject where code = '".$_GET['code']."'");
        $_SESSION['delmsg']="Subject deleted !!";
    }
    ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Subject</title>
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
                        <h1 class="page-head-line">Subject  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Subject 
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="sub" method="post">
   <div class="form-group">
    <label for="subject_code">Subject Code  </label>
    <input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="subject_code" required />
  </div>

 <div class="form-group">
    <label for="subject_name">Subject Name  </label>
    <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="subject_name" required />
  </div>
 <div class="form-group">
    <label for="coursename">Course   </label>
    <select name="course_id" id="coursename" class="form-control"  required>
      <option value="">Select a course</option>
        <?php
        $sql = mysqli_query($bd, "select id,courseName from course");
    while ($row = mysqli_fetch_array($sql)) {
        echo'<option value="'.$row[0].'">'.$row[1].'</option>';
    }
    ?>
    </select>
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
                            Manage Subject
                        </div>
                       
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course Code</th>
                                            <th>Course Name </th>
                                            <th>Subject Code </th>
                                            <th>Subject Name </th>
                                  
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "SELECT course.courseName,course.courseCode,subject.code, subject.name, subject.subject_code from course inner join subject on subject.course_id = course.id");
    $cnt=1;
    while($row=mysqli_fetch_array($sql)) {
        ?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['courseCode']);?></td>
                                            <td><?php echo htmlentities($row['courseName']);?></td>
                                            <td><?php echo htmlentities($row['subject_code']);?></td>
                                            <td><?php echo htmlentities($row['name']);?></td>
                                        
                                      
                                      
                                            <td>
                                                                         
  <a href="subject.php?code=<?php echo $row['code']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                            <button class="btn btn-danger">Delete</button>
</a>                                        </td>
                                        </tr>
<?php
        $cnt++;
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