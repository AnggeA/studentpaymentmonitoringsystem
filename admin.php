<?php
    include_once "includes/db_conn.php";
    include_once "includes/functions.inc.php";
?>
<html>
    
<head>
    <title>Admin Dashboard</title>
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
                <a class="nav-link btn btn-border button-color" data-toggle="collapse" href="#addPayment" role="button" aria-expanded="false" aria-controls="addPayment">
                    New Payment <i class="bi bi-plus-circle"></i>
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
                                    <p>Student <?php echo $_GET['studid'];?> Does not exists.</p>
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
                                    <p>Payment of <?php echo $_GET['studid']; ?> student has been added.</p>
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
                ?>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-12"></div>
        <div class="col-lg-3 col-sm-12 col-md-12"></div>
        <div class="col-lg-3 col-sm-12 col-md-12"></div>
        <div class="col-lg-3 col-sm-12 col-md-12">
            <div id="addPayment" class="card collapse mb-2 shadow-sm" style="background:#DEF2F1; ">
                <div class="card-header"><br>
                    <h2>Payment Form</h2>
                </div>
                    <form action="addpayment.php" method="POST">
                        <div class="card-body">
                            <div class="mb-1">
                                <label for="stud_num" class="form-label">Student No.</label>
                                <input name="stud_num" type="text" class="form-control" placeholder="20xx-xxxx-xxxxxx" required>
                            </div>
                            <div class="mb-1">
                                <label for="fee" class="form-label">Fee Name</label>
                                <select name="fee" class="form-select" required>
                                    <?php
                                        $sql_fee = "SELECT * FROM `tb_fee` WHERE fee_status='A';";
                                        $result_fee = mysqli_query($conn, $sql_fee);
                                        if(mysqli_num_rows($result_fee) > 0){
                                            while($row_fee = mysqli_fetch_assoc($result_fee)){
                                                echo "<option value='".$row_fee['fee_ID'].",".$row_fee['fee_price']."'>".$row_fee['fee_name']."</option>";
                                            }
                                        }
                                    ?>
                               </select>
                            </div>
                            <div class="mb-1">
                                <label for="qty" class="form-label">Qty</label>
                                <input name="qty" type="number" min="1" class="form-control" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn w-100 button-color" name="addpayment_submit" type="submit"> <i class="bi bi-save"></i> Save </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <div class="row border border-bottom-0 border-light">
        <?php
        $sec_list = getSection($conn);
        $fee_list = getFees($conn);
            if(!empty($fee_list) || $fee_list !== false){
                foreach($fee_list as $fee_key => $fee){ ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-0">
                        <div class="form-floating">
                            <h6 class="p-2 pb-0" style="color:darkslategray;">Fee Name:</h6>
                            <h3 class="p-3 pt-1"><?php echo $fee['fee_name'];?></h3>
                        </div>
                    </div>
                    <div>
                        <?php
                            $stud_record = showStudentRecord($conn, $fee['fee_ID']);
                            if(!empty($stud_record) || $stud_record !== false ){
                                foreach($stud_record as $key => $val){ ?>
                                    <div class="col-lg-3 col-md-12 col-sm-12 m-2 p-0 float-left"  >
                                        <div class="card border border-bg-gradient" style="background-color:#DEF2F1;">               
                            <div class="card-body">
                            <input class="form-control mb-1" type="hidden" name="transaction_id" id="transaction_id" value="<?php echo $val['transaction_ID']; ?>">
                            <input class="form-control mb-1" type="hidden" name="stud_ID" id="stud_ID" value="<?php echo $val['stud_ID']; ?>">
                            <input class="form-control mb-1" type="hidden" name="fee_ID" id="fee_ID" value="<?php echo $val['fee_ID']; ?>">
                            <div class="form-floating" >
                                <input id="studid<?php echo $val['transaction_ID']; ?>" class="form-control form1" type="text" name="stud_num" value="<?php echo $val['stud_num']; ?>" readonly>
                                <label class="form-label" for="studid<?php echo $val['transaction_ID']; ?>">Student No.</label>
                            </div>
                            <div class="form-floating">
                                <input id="stud_name<?php echo $val['transaction_ID']; ?>" class="form-control form1" type="text" name="stud_name" value="<?php echo $val['lname'].",".$val['fname']." ".$val['mname']; ?>" readonly>
                                <label class="form-label" for="stud_name<?php echo $val['transaction_ID']; ?>">Name</label>
                            </div>
                            <div class="form-floating">
                                <input id="fee_name<?php echo $val['transaction_ID']; ?>" class="form-control form1" type="text" name="fee_name" value="<?php echo $val['fee_name']; ?>" readonly>
                                <label class="form-label" for="fee_name<?php echo $val['transaction_ID']; ?>">Fee Name</label>
                            </div>
                            <div class="form-floating">
                                <input id="fee_price<?php echo $val['transaction_ID']; ?>" class="form-control form1" type="number" name="fee_price" value="<?php echo sprintf("%.2f",$val['fee_price']); ?>" readonly>
                                <label class="form-label" for="fee_price<?php echo $val['transaction_ID']; ?>">Price</label>
                            </div>
                            <div class="form-floating">
                                <input id="qty<?php echo $val['transaction_ID']; ?>" class="form-control form1" type="number" name="qty" value="<?php echo $val['qty']; ?>" readonly>
                                <label class="form-label" for="qty<?php echo $val['transaction_ID']; ?>">Qty: </label>
                            </div>
                            <div class="form-floating">
                                <input id="total_amt<?php echo $val['transaction_ID']; ?>" class="form-control form1" type="number" name="total_amt" value="<?php echo sprintf("%.2f",$val['total_amt']); ?>" readonly>
                                <label class="form-label" for="total_amt<?php echo $val['transaction_ID']; ?>">Total Amt: </label>
                            </div>
                            <div class="form-floating">
                                <input id="rmrks<?php echo $val['transaction_ID']; ?>" class="form-control text-danger form1" type="text" name="rmrks" value="<?php echo $val['rmrks']; ?>" readonly>
                                <label class="form-label" for="rmrks<?php echo $val['transaction_ID']; ?>">Remarks</label>
                            </div>
                            <div class="form-floating">
                                <input id="datetime<?php echo $val['transaction_ID']; ?>" class="form-control form1" type="text" name="datetime" value="<?php echo $val['date_time']; ?>" readonly>
                                <label class="form-label" for="datetime<?php echo $val['transaction_ID']; ?>">Date &amp; Time</label>
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
        <?php   
                                                              }
    }
                                                     ?>
        </div>
    </div>
</body>
<?php mysqli_close($conn);?>
<?php include_once "footer.php"; ?>
<script src="js/bootstrap.min.js"></script>
</html>