<?php

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "db_spms";

    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname); 
    
    // Check connection
    if (!$conn){
        die("Conncetion failed" . mysqli_connect_error());
    }
    else{
        echo "";
    }

    session_start();

?>