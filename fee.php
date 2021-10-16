<?php
    include_once "includes/db_conn.php";
    include_once "includes/functions.inc.php";

    if(isset($_GET['archivefee'])){
        $arc_fee = $_GET['archivefee'];
        if(archiveFee($conn, $arc_fee) !== false){
            header ("location: fee.php?arcfee=yes");
            exit();
        }
        else{
            header ("location: fee.php?arcfee=no");
            exit();
        }
    }
?>
<html>

<head>
    <title>Fees</title>
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
            <div class="col-lg-3 col-md-12 col-sm-12 mt-5 mb-3">
                <a class="nav-link btn button-color" data-toggle="collapse" href="#addFee" role="button" aria-expanded="false" aria-controls="addFee">
                    Add Fee <i class="bi bi-plus-circle"></i>
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
                            if(isset($_GET['feecode'])){ ?>
                                <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                    <p>Fee <?php echo $_GET['feecode'];?> Exists.</p>
                                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            <?php }
                            break;
                        case 2: ?> 
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
                            if(isset($_GET['feename'])){ ?>
                               <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                                    <p>Fee <?php echo $_GET['feename']; ?> has been added.</p>
                                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                   </button>
                                </div>
                            <?php }
                            break;
                        default: 
                            echo '<div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                 <h6 class="display-6">Oops!</h6>'.$_GET['error'].'<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                 </button>
                            </div>';
                     }
                    }
                    else if(isset($_GET['feeupd'])){
                        if($_GET['feeupd'] == "yes"){?>
                            <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                                <p>Fee updated.</p>
                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                 <p>Fee failed to update.</p>
                                 <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        <?php }
                    }
                    else if(isset($_GET['arcfee'])){
                        if($_GET['arcfee'] == "yes"){ ?>
                            <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                <p>Fee archive.</p>
                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="mt-3 alert alert-warning alert-dismissible fade show" role="alert">
                                 <p>Fee failed to archive.</p>
                                 <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                 </button>
                            </div>
                        <?php }  
                    }
                ?>      
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div id="addFee" class="card collapse mb-2 shadow-sm" style="background:#DEF2F1; ">
                    <div class="card-header"><br>
                        <h3 class="display-6">Fee Form</h3>
                    </div>
                    <form action="addfee.php" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="mb-1">
                                <label for="f_FeeCode" class="form-label">Fee Code</label>
                                <input name="fee_code" id="f_FeeCode " type="text" class="form-control" required>
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Name</label>
                                <input name="fee_name" id=" " type="text" class="form-control" required>
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Description</label>
                                <textarea name="fee_dscrptn" type="text" class="form-control" required></textarea>
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Price</label>
                                <input name="fee_price" id=" " type="number" class="form-control" required>
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Due Date</label>
                                <input name="fee_due" type="date" class="form-control" required>
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Status</label>
                                <select name="fee_status" id="" class="form-select" required>
                                    <option value='A'>ACTIVE</option>
                                    <option value='D'>DISCONTINUED</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn button-color w-100" name="addfee_submit" type="submit"> <i class="bi bi-save"></i> Save </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <h3 class="display-6 m-0 p-3">Fee List</h3>
            <div>
                <div class="col-lg-12 col-md-12 col-sm-12">
         <?php
            $fee_list = getFees($conn);
                if(!empty($fee_list)){
                    foreach($fee_list as $fee_key => $fee){
                    $fee_price = $fee['fee_price'];?>
                    <div class="col-lg-3 col-md-12 col-sm-12 m-1 p-1 float-left">
                        <div class="card border border-bg-gradient" >
                            <div class="card border border-bg-gradient" style="background-color:#DEF2F1;">
                            <div class="card-body">
                            <form action="includes/fee.inc.php" method="POST">
                                <input class="form-control mb-1" type="hidden" name="fee_ID" id="fee_ID" value="<?php echo $fee['fee_ID']; ?>">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="fee_code" id="fee<?php echo $fee['fee_ID']; ?>" value="<?php echo $fee['fee_code']; ?>" required>
                                    <label for="fee<?php echo $fee['fee_ID']; ?>" class="form-label">Fee Code</label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="fee_name" id="fee<?php echo $fee['fee_ID']; ?>" value="<?php echo $fee['fee_name']; ?>" required >
                                    <label for="fee<?php echo $fee['fee_ID']; ?>" class="form-label">Name</label>
                                </div>
                                <div class="form-floating">
                                    <textarea name="fee_dscrptn" type="text" class="form-control" required><?php echo $fee['fee_dscrptn']; ?></textarea>
                                <label for="fee<?php echo $fee['fee_ID']; ?>" class="form-label">Description</label>
                                </div>
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="fee_price" id="fee<?php echo $fee['fee_ID']; ?>" value="<?php echo sprintf("%.2f",$fee_price); ?>" required>
                                    <label for="fee<?php echo $fee['fee_ID']; ?>" class="form-label">Price</label>
                                </div>
                                <button class="btn btn-success mt-3 btn-lg" name="updatefee_submit"> <i class="bi bi-arrow-counterclockwise"></i> </button>
                                <a href="fee.php?archivefee=<?php echo $fee['fee_ID']; ?>" class="btn btn-danger mt-3 btn-lg" title="Archive <?php echo $fee['fee_name']; ?>"><i class="bi bi-trash"></i> </a>
                            </form>
                            </div>    
                            </div>
                        </div>
                    </div>
        <?php }
    }
    else{
        echo "<h4> No Records Found.</h4>";
    }   ?>
        </div>
    </div>        


    </div>
    </div>
</body>
<?php mysqli_close($conn);?>
<?php include_once "footer.php"; ?>
<script src="js/bootstrap.min.js"></script>
</html>