<?php
    include_once "includes/db_conn.php";
    include_once "includes/functions.inc.php";

    if(isset($_GET['archivestudent'])){
        $arc_stud = $_GET['archivestudent'];
        if(archiveStudent($conn, $arc_stud) !== false){
            header ("location: student.php?arcstud=yes");
            exit();
        }
        else{
            header ("location: student.php?arcstud=no");
            exit();
        }
    }
?>
<html>

<head>
    <title>Student</title>
    <?php include_once "header.php";?>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <?php include_once "nav.php"; ?>
    <div class="container-fluid mt-5 panel-1">
        <div class="row">
           <div class="col-lg-3 col-md-12 col-sm-12 mt-5">
                <ul class="navbar-nav">
                    <li class="nav-item" >
                        <a class="nav-link" href="student.php">
                            Student <i class="bi bi-person"></i>
                        </a>
                    </li>
                </ul>  
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 mt-5">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link "  href="fee.php">
                            Fee <i class="bi bi-cash"></i>
                        </a>
                    </li>
                </ul>    
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 mt-5"></div>
            <div class="col-lg-3 col-md-12 col-sm-12 mt-5">
                <a class="nav-link btn button-color" data-toggle="collapse" href="#addStudent" role="button" aria-expanded="false" aria-controls="addStudent">
                    Add Student <i class="bi bi-plus-circle"></i>
                </a> 
            </div>
        </div>
    </div>
    <div class="row m-0 panel-1">
            <div class="col-lg-12 col-sm-12 col-md-12">
            <?php 
                if(isset($_GET['error'])){
                    
                    switch($_GET['error']){
                        case 1:
                            if(isset($_GET['studid'])){?>
                                <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                    <p>Student <?php echo $_GET['studid'];?> Exists.</p>
                                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            <?php }
                            break;
                        case 2:?> 
                            <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                 <p>Adding Record Failed.</p>
                                 <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                            <?php break;
                         case 3: ?>
                            <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                 <p>Checking Record Failed.</p>
                                 <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                                <?php break;
                        case 0:
                            if(isset($_GET['studid'])){?>
                               <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                                    <p>Student <?php echo $_GET['studid']; ?> has been added.</p>
                                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                   </button>
                                </div>
                            <?php }
                            break;
                        default:?>
                            <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                 <h6 class='display-6'>Oops!</h6><br><?php echo $_GET['error'];?>
                                 <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                 </button>
                            </div>
                    <?php }
                    }
                    else if(isset($_GET['studupd'])){
                        if($_GET['studupd'] == "yes"){?>
                            <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                                <p>Student updated.</p>
                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                 <p>Student failed to update.</p>
                                 <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        <?php }
                    }
                    else if(isset($_GET['arcstud'])){
                        if($_GET['arcstud'] == "yes"){ ?>
                            <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                                <p>Student archive.</p>
                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                 <p>Student failed to archive.</p>
                                 <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                 </button>
                            </div>
                        <?php }  
                    } 
                ?>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
            <div class="col-lg-4 col-sm-12 col-md-12">
                <div id="addStudent" class="card collapse mb-2 shadow-sm" style="background:#DEF2F1; ">
                    <div class="card-header"><br>
                        <h3 class="display-6">Student Form</h3>
                    </div>
                    <form action="addstudent.php" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="mb-1">
                                <label for="stud_ID" class="form-label">Student No.</label>
                                <input type="text" name="stud_num" class="form-control" placeholder="20xx-xxxx-xxxx" required>
                            </div>
                            <div class="mb-1">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" name="fname" class="form-control" placeholder="JUAN" required>
                            </div>
                            <div class="mb-1">
                                <label for="mname" class="form-label">Middle Name</label>
                                <input type="text" name="mname" class="form-control" placeholder="GARCIA">
                            </div>
                            <div class="mb-1">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" name="lname" class="form-control" placeholder="DELA CRUZ"  required>
                            </div>
                            <div class="mb-1">
                                <label for="dept_ID" class="form-label">Department</label>
                                <select name="dept" id="" class="form-select mb-2" required>
                                    <?php
                                        $sql_dept = "SELECT *
                                                    FROM `tb_dept`
                                                    ORDER BY dept_ID asc;";
                                        $result = mysqli_query($conn, $sql_dept);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<option value='".$row['dept_ID']."'>".$row['dept_name']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="course_ID" class="form-label">Course</label>
                                <select name="course" id="" class="form-select mb-2" required>
                                    <?php
                                        $sql_course = "SELECT *
                                                    FROM `tb_course`
                                                    ORDER BY course_ID asc;";
                                        $result = mysqli_query($conn, $sql_course);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<option value='".$row['course_ID']."'>".$row['course_name']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="by_ID" class="form-label">Year &amp; Block</label>
                                <select name="by" id="" class="form-select mb-2" required>
                                    <?php
                                        $sql_by = "SELECT *
                                                    FROM `tb_blockyear` as s
                                                    ORDER BY by_ID asc;";
                                        $result = mysqli_query($conn, $sql_by);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<option value='".$row['by_ID']."'>".$row['by_name']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" class="form-control" placeholder="juangarcia.delacruz@bicol-u.edu.ph" required>
                            </div>
                            <div class="mb-1">
                                <label for="user_status" class="form-label">Status</label>
                                <select name="user_status" id="" class="form-select" required>
                                    <option value='A'>ACTIVE</option>
                                    <option value='D'>DISCONTINUED</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn w-100 button-color" name="addstudent_submit" type="submit"> 
                                <i class="bi bi-save"></i> Save 
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <h3 class="display-6 m-0 p-3 panel-1">Student List</h3>
        </div>
         <?php
        $dept_list = getDept($conn);
        $course_list = getCourse($conn);
        $sec_list = getSection($conn);
            if(!empty($dept_list) || $dept_list !== false){
                    foreach($dept_list as $dept_key => $dept){?>
                        <div class="row border border-bottom-0 border-light">
                           <div class="col-lg-12 col-md-12 col-sm-12 mb-0">
                                <h4><?php echo $dept['dept_name'];?></h4>
                             </div>
                        </div>           
           <?php
                if(!empty($course_list) || $course_list !== false){
                    foreach($course_list as $course_key => $course){?>
                        <div class="row border border-bottom-0 border-light">
                           <div class="col-lg-12 col-md-12 col-sm-12 mb-0">
                                <h5><?php echo $course['course_name']; ?></h5>
                             </div>
                        </div>
                                  
            <?php
           
                if(!empty($sec_list) || $sec_list !== false){
                    foreach($sec_list as $sec_key => $sec){?>
                        <div class="row border border-bottom-0 border-light">
                           <div class="col-lg-12 col-md-12 col-sm-12 mb-0" >
                                <h6><?php echo $sec['by_name']; ?></h6>
                             </div>
                        </div>
                        <div class="row border-top-0 border-bottom-0 border border-light ">
        <?php
            $stud_list = showStudent($conn, $dept['dept_ID'],$course['course_ID'],$sec['by_ID']);
                if(!empty($stud_list) || $stud_list !== false ){
                    foreach($stud_list as $key => $val){ ?>
                        <div class="col-lg-3 col-md-12 col-sm-12 m-3 float-left">
                            <div class="card border border-bg-gradient" style="background-color:#DEF2F1;">
                            <form action="includes/student.inc.php" method="POST">
                            <div class="card-body">
                                <input class="form-control mb-1" type="hidden" name="stud_ID" value="<?php echo $val['stud_ID']; ?>">
                            <div class="form-floating">
                                <input class="form-control form-control-sm" type="text" name="stud_num" value="<?php echo $val['stud_num']; ?>" readonly>
                                <label class="form-label" for="stud_ID">
                                Student No.</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control form-control-sm" type="text" name="name" value="<?php echo $val['lname'].",".$val['fname'].",".$val['mname']; ?>">
                                <label class="form-label" for="name">
                                Name</label>
                            </div>
                            <div class="form-floating">
                                <select name="dept" class="form-select mb-2" required>
                                    <option value="<?php echo $val['dept_ID'];?>" selected><?php echo $val['dept_name']; ?></option>
                                    <?php
                                        $sql_dept = "SELECT *
                                                    FROM `tb_dept`
                                                    ORDER BY dept_ID asc;";
                                        $result = mysqli_query($conn, $sql_dept);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<option value='".$row['dept_ID']."'>".$row['dept_name']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <label class="form-label" for="section_ID">
                                Department</label>
                            </div>
                                <div class="form-floating">
                                <select name="course" class="form-select mb-2" required>
                                    <option value="<?php echo $val['course_ID'];?>" selected><?php echo $val['course_name']; ?></option>
                                    <?php
                                        $sql_course = "SELECT *
                                                    FROM `tb_course`
                                                    ORDER BY course_ID asc;";
                                        $result = mysqli_query($conn, $sql_course);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<option value='".$row['course_ID']."'>".$row['course_name']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <label class="form-label" for="section_ID">
                                Course</label>
                            </div>
                                <div class="form-floating">
                                <select name="by" class="form-select mb-2" required>
                                    <option value="<?php echo $val['by_ID'];?>" selected><?php echo $val['by_name']; ?></option>
                                    <?php
                                        $sql_by = "SELECT *
                                                    FROM `tb_blockyear` as s
                                                    ORDER BY by_ID asc;";
                                        $result = mysqli_query($conn, $sql_by);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<option value='".$row['by_ID']."'>".$row['by_name']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <label class="form-label" for="section_ID">
                                Year &amp; Block</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control form-control-sm" type="text" name="email" value="<?php echo $val['email']; ?>">
                                <label class="form-label" for="email">
                                Email</label>
                            </div>
                            <button type="submit" class="btn btn-lg btn-success mt-3 ml-3" title="Update <?php echo $val['stud_num']; ?>" name="updatestudent_submit" > 
                                <i class="bi bi-arrow-counterclockwise"></i> 
                            </button>
                            <a href="student.php?archivestudent=<?php echo $val['stud_ID']; ?>" class="btn btn-danger btn-lg mt-3" title="Archive <?php echo $val['stud_num']; ?>"><i class="bi bi-trash"></i> </a>
                        </div>
                        </form>
                    </div>
                </div>
            <?php }
             }
             else{
                 echo "<h4> No Records Found.</h4>";
             }   ?>
                            </div>
        <?php }
                }
                                                                   }
                }
                                                             }
            } 
        ?>    

    </div>
</body>
<?php mysqli_close($conn); ?>
<?php include_once "footer.php"; ?>
<script src="js/bootstrap.min.js"></script>
</html>