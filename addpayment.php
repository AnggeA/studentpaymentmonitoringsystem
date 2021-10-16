<?php
include_once "includes/db_conn.php";

if(isset($_POST['addpayment_submit'])){
    $stud_num = htmlentities($_POST['stud_num']);
    $fee   = htmlentities($_POST['fee']);
    $fees = explode(",",$fee);
    $fee_ID = (int)$fees[0];
    $price = floatval($fees[1]);
    $qty   = htmlentities($_POST['qty']);
    $total_amt = $qty * $price;
    $rmrks = "PAID";
    
   
    //file upload initialization------------------
    $sql_check = "SELECT stud_ID,stud_num 
                    FROM tb_student
                   WHERE stud_num = ?;";
    $stmt_chk = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt_chk, $sql_check)){
        header("location: admin.php?error=3"); //statement failed
        exit();
    }
    mysqli_stmt_bind_param($stmt_chk,"s",$stud_num);
    mysqli_stmt_execute($stmt_chk);
    $chk_result=mysqli_stmt_get_result($stmt_chk);
    $arr=array();
    while($row = mysqli_fetch_assoc($chk_result)){
        array_push($arr,$row);
        $stud_ID = $row['stud_ID'];
    }
    
    if(empty($arr)){
        header("location: admin.php?error=1&studid={$stud_num}"); //item does not exist
        exit();
    }
    else{
        $sql_ins = "INSERT INTO `tb_payment`
                  (`stud_ID`, `fee_ID`, `price`, `qty`, `total_amt`, `rmrks`) 
                   VALUES (?,?,?,?,?,?);";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
        header("location: admin.php?error=2"); //insert failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_ins,"ssssss",$stud_ID, $fee_ID, $price, $qty, $total_amt, $rmrks);
        mysqli_stmt_execute($stmt_ins);
        header("location: admin.php?error=0&studid={$stud_num}"); 
        exit();
    }
}