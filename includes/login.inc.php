<?php
    include_once "db_conn.php";
    include_once "functions.inc.php";  

    if(isset($_POST['login_submit'])){
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);   
        
        $stud_info = checkuserLogin($conn, $username, $password);
        var_dump($stud_info);
        
        if ($stud_info !== false){
              
            $_SESSION['userlogged'] = $stud_info['username'];    
            
            header ("location: ../login.php?login=yes");
            exit(); 
        }
        else{
            header("location: ../login.php?login=no");
            exit();
        }
    }
?>