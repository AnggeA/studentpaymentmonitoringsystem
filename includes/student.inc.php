<?php
    include_once "db_conn.php";
    include_once "functions.inc.php"; 
    
    if(isset($_POST['updatestudent_submit'])){
        $stud_ID =  htmlentities($_POST['stud_ID']);
        $name =  htmlentities($_POST['name']);
        $nameE = explode(",",$name);
        $lname = $nameE[0];
        $fname = $nameE[1];
        $mname = $nameE[2];
        $dept = htmlentities($_POST['dept']);
        $course = htmlentities($_POST['course']);
        $by = htmlentities($_POST['by']);
        $email = htmlentities($_POST['email']);
        
        if(updateStudent($conn, $stud_ID, $fname, $mname, $lname, $dept, $course, $by, $email ) !== false){
            header ("location: ../student.php?studupd=yes");
            exit();
        }
        else{
            header ("location: ../student.php?studupd=no");
            exit();
        }
    }
    else{
        header("location: ../index.php");
    }
