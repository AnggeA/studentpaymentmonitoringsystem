<?php
include_once "includes/db_conn.php";

if(isset($_POST['addfee_submit'])){
    $fee_code = htmlentities($_POST['fee_code']);
    $name   = htmlentities($_POST['fee_name']);
    $dscrptn   = htmlentities($_POST['fee_dscrptn']);
    $price = htmlentities($_POST['fee_price']);
    $due = htmlentities($_POST['fee_due']);
    $status = htmlentities($_POST['fee_status']);
    
    //file upload initialization------------------
    $sql_check = "SELECT fee_ID
                    FROM tb_fee
                   WHERE fee_code  = ?;";
    $stmt_chk = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_chk, $sql_check)){
        header("location: fee.php?error=3"); //statement failed
        exit();
    }
    mysqli_stmt_bind_param($stmt_chk,"s",$fee_code);
    mysqli_stmt_execute($stmt_chk);
    $chk_result=mysqli_stmt_get_result($stmt_chk);
    $arr=array();
    while($row = mysqli_fetch_assoc($chk_result)){
        array_push($arr,$row);
    }
    if(!empty($arr)){
        header("location: fee.php?error=1&feecode={$fee_code}"); //item exist
        exit();
    }
    else{
        $sql_ins = "INSERT INTO `tb_fee`
                  (`fee_code`, `fee_name`, `fee_dscrptn`, `fee_due`, `fee_price`, `fee_status`) 
                   VALUES (?,?,?,?,?,?);";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
        header("location: fee.php?error=2"); //insert failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_ins,"ssssss",$fee_code, $name, $dscrptn, $due, $price, $status);
        mysqli_stmt_execute($stmt_ins);
                
        header("location: fee.php?error=0&feename={$name}"); 
        
        exit();
    }
}