<?php
    include_once "includes/db_conn.php";
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once "header.php";?>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <link rel="stylesheet" href="style/styles.css"> 
    <title>Log in</title>
</head>

<body class="panel-1">
    <?php
        if(isset($_GET['login'])){
            $login = "";
            $login = $_GET['login'];
            if($login == "yes"){
                header("location: admin.php");
                exit();
            }
            else{?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p>Error Log in</p>
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                    </button>
                </div>
    <?php   } 
        }?>  
    <div class="container">
        <div class="row position-absolute top-50 start-50 translate-middle mx-auto">
            <div class="col-lg-12 p-4 border border-light " style="background-color:#2b7a78;">
                <center><h4 style="color:#FEFFFF;">Log in</h4></center>
                    <form action="includes/login.inc.php" method="POST">
                        <div class="row p-0">
                            <input class="form-control form-control-sm mb-3" type="text" name="username" placeholder="Username">
                        
                            <input class="form-control form-control-sm mb-3" type="password" name="password" placeholder="Password">
                        </div>
                       
                        <input class="btn btn-sm button-color w-100" type="submit" name="login_submit" value="Submit">
                    </form> 
            </div>
        </div>
    </div>
</body>
</html>