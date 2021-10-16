<?php
    include_once "includes/db_conn.php";

    if(isset($_POST['addstudent_submit'])){
        $stud_num = htmlentities($_POST['stud_num']);
        $fname   = htmlentities($_POST['fname']);
        $mname   = htmlentities($_POST['mname']);
        $lname   = htmlentities($_POST['lname']);
        $dept = htmlentities($_POST['dept']);
        $course = htmlentities($_POST['course']);
        $by = htmlentities($_POST['by']);
        $email = htmlentities($_POST['email']);
        $user_status = htmlentities($_POST['user_status']);
    
        //file upload initialization------------------
        $sql_check = "SELECT stud_ID 
                        FROM tb_student
                        WHERE stud_num = ?;";
        $stmt_chk = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_chk, $sql_check)){
            header("location: student.php?error=3"); //statement failed
            exit();
        }
        mysqli_stmt_bind_param($stmt_chk,"s",$stud_num);
        mysqli_stmt_execute($stmt_chk);
        $chk_result=mysqli_stmt_get_result($stmt_chk);
        $arr=array();
        while($row = mysqli_fetch_assoc($chk_result)){
            array_push($arr,$row);
        }
        if(!empty($arr)){
            header("location: student.php?error=1&studid={$stud_num}"); //student exist
            exit();
        }
        else{
            $sql_ins = "INSERT INTO `tb_student`
                  (`stud_num`, `fname`, `mname`, `lname`, `dept_ID`, `course_ID`, `by_ID`, `email`, `stud_status`) 
                   VALUES (?,?,?,?,?,?,?,?,?);";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
            header("location: student.php?error=2"); //insert failed
            exit();
        }
        mysqli_stmt_bind_param($stmt_ins,"sssssssss",$stud_num, $fname, $mname, $lname, $dept, $course, $by, $email, $user_status);
        mysqli_stmt_execute($stmt_ins);
                
        
        header("location: student.php?error=0&studid={$stud_num}"); 
        exit();
    }
}