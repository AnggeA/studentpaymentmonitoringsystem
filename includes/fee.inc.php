<?php
    include_once "db_conn.php";
    include_once "functions.inc.php"; 
    
    if(isset($_POST['updatefee_submit'])){
        $fee_ID = htmlentities($_POST['fee_ID']);
        $fee_code = htmlentities($_POST['fee_code']);
        $name   = htmlentities($_POST['fee_name']);
        $dscrptn   = htmlentities($_POST['fee_dscrptn']);
        $due = htmlentities($_POST['fee_due']);
        $price_b = htmlentities($_POST['fee_price']);
        $price = (double)$price_b;
    
        if(updateFee($conn, $fee_ID, $fee_code, $name, $dscrptn, $due, $price) !== false){
            header ("location: ../fee.php?feeupd=yes");
            exit();
        }
        else{
            header ("location: ../fee.php?feeupd=no");
            exit();
        }
    }
    else{
        header("location: ../index.php");
    }
