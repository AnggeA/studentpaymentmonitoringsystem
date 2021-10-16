<?php
     function checkuserLogin($conn, $username,$password){
         
         $err;
         $sql = "SELECT * FROM `tb_login` WHERE  `username` = ? AND `password` = ? LIMIT 1;";
         $stmt = mysqli_stmt_init($conn);
         
         if(!mysqli_stmt_prepare($stmt, $sql)){
             header("location: index.php?error=stmtfailed");
             exit();
         }
            mysqli_stmt_bind_param($stmt, "ss", $username,$password);
            mysqli_stmt_execute($stmt);
         
            $resultData = mysqli_stmt_get_result($stmt);
            
            if($row = mysqli_fetch_assoc($resultData)){
                return $row;
            }
            else{
                return false;
            }
             
            mysqli_stmt_close($stmt);
     }
    //  function updateUserpass($conn, $cust_ID, $userPass, $new_userPass, $cnew_userPass){
    //      $err;
    //      $sql = "SELECT
    //                 `cust_userPass`
    //             FROM
    //                 `tb_customer`
    //             WHERE
    //                 `cust_ID` = ?;";
    //      $stmt = mysqli_stmt_init($conn);
         
    //      if(!mysqli_stmt_prepare($stmt, $sql)){
    //          return false;
    //          exit();
             
    //      }
    //         mysqli_stmt_bind_param($stmt, "s", $cust_ID);
    //         mysqli_stmt_execute($stmt);
            
    //         $resultData = mysqli_stmt_get_result($stmt);

    //         while($row = mysqli_fetch_assoc($resultData)){
    //           if(!empty($row)){
                    
    //                 $cust_userPass = $row['cust_userPass']; 
                    
    //                 if($cust_userPass == $userPass){
    //                     if($new_userPass == $cnew_userPass){
    //                         $sql1 = "UPDATE
    //                                     `tb_customer`
    //                                 SET
    //                                     `cust_userPass` = ?
    //                                 WHERE
    //                                     `cust_ID` = ?;";
    //                         $stmt1 = mysqli_stmt_init($conn);
         
    //                         if(!mysqli_stmt_prepare($stmt1, $sql1)){
    //                             return false;
    //                             exit();
             
    //                         }
    //                         mysqli_stmt_bind_param($stmt1, "ss", $new_userPass, $cust_ID);
    //                         mysqli_stmt_execute($stmt1); 
         
         
    //                         mysqli_stmt_close($stmt1);
    //                         return true;
    //                     }    
    //                     else{
    //                         $err = false;
                
    //                         return $err;
    //                 }
    //                 }
    //                 else{
    //                 $err = false;
                
    //                 return $err;
    //                 }
    //         }
            
    //             else{
    //                 $err = false;
                
    //                 return $err;
    //             } 
    //     }
                
    //         mysqli_stmt_close($stmt);
    //  }
    function getDept($conn){
        $sql = "SELECT  *
                FROM `tb_dept`
                WHERE dept_status = 'A'
                ORDER BY dept_ID asc;";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit;
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $resArr = array();
        if(!empty($resultData)){
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($resArr, $row);
            }
            return $resArr;  
        }
        else{
            return false;
      }
        mysql_stmt_close($stmt);
    }
    function getCourse($conn){
        $sql = "SELECT  *
                FROM `tb_course`
                WHERE course_status = 'A'
                ORDER BY course_ID asc;";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit;
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $resArr = array();
        if(!empty($resultData)){
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($resArr, $row);
            }
            return $resArr;  
        }
        else{
            return false;
        }
        mysql_stmt_close($stmt);
    }
    function getSection($conn){
        $sql = "SELECT *
                FROM 
                    `tb_blockyear`
                WHERE 
                    by_status = 'A' 
                ORDER BY 
                by_ID asc;";
            $stmt=mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                return false;
                exit;
            }
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
            $resArr = array();
            if(!empty($resultData)){
                while($row = mysqli_fetch_assoc($resultData)){
                    array_push($resArr, $row);
                }
                return $resArr;
            }
            else{
                return false;
            }
        mysql_stmt_close($stmt);
    }
    function getFees($conn){
        $sql = "SELECT *
                FROM `tb_fee`  
                WHERE fee_status = 'A';";
        $stmt=mysqli_stmt_init($conn); 
        if (!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit;
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $arr = array();
        if(!empty($resultData)){
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($arr, $row);
            }
            return $arr;
        }
        else{
            return false;
        }
        mysql_stmt_close($stmt);
    }
    function showStudent($conn, $dept = null, $course = null, $sec = null){
            if($dept === null AND $course === null AND $sec === null) {
                //declare the SQL
                $sql = "SELECT  *
                        FROM
                            `tb_student` as st
                            JOIN tb_dept as d
                            ON d.dept_ID = st.dept_ID
                            JOIN tb_course as c
                            ON c.course_ID = st.course_ID
                            JOIN tb_blockyear as b 
                            ON b.by_ID = st.by_ID;";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
            }
            else{  //check if $sec has value
                $sql = "SELECT  *
                        FROM
                            `tb_student` as st
                            JOIN tb_dept as d
                            ON d.dept_ID = st.dept_ID
                            JOIN tb_course as c
                            ON c.course_ID = st.course_ID
                            JOIN tb_blockyear as b 
                            ON b.by_ID = st.by_ID
                        WHERE
                            d.dept_ID = ?
                            AND c.course_ID = ?
                            AND b.by_ID = ? AND st.stud_status = 'A';";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "sss" , $dept, $course, $sec);
                }
            

        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if(!empty($resultData)){
            $arr = array();
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($arr,$row);
            }
            return $arr;
        }
        else{
            return false;
        }       
    }
    function showSection($conn, $sec = null, $searchkey = null){
        if($searchkey === null){
            if($sec === null) {
                //declare the SQL
                $sql = "SELECT  *
                        FROM
                            `tb_section` as s
                            JOIN tb_year as y 
                            ON s.year_ID = y.year_ID
                            JOIN tb_block as b 
                            ON s.block_ID = b.block_ID;";
        
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
            }
            else{  //check if $sec has value
                $sql = "SELECT  *
                        FROM
                            `tb_section` as s
                            JOIN tb_year as y 
                            ON s.year_ID = y.year_ID
                            JOIN tb_block as b 
                            ON s.block_ID = b.block_ID
                        WHERE
                            s.section_ID = ?;";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "s" , $sec);
                }
            }
        else{ //check if searchkey variable is not NULL
            $sql = "SELECT  *
                        FROM
                            `tb_section` as s
                            JOIN tb_year as y 
                            ON s.year_ID = y.year_ID
                            JOIN tb_block as b 
                            ON s.block_ID = b.block_ID
                    WHERE
                        y.year = ? 
                        OR b.block = ?
                        OR s.section_status = ?;";
            $stmt=mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "Something went wrong.";
                exit();
            } 
            mysqli_stmt_bind_param($stmt, "sss" , $searchkey, $searchkey, $searchkey);  
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if(!empty($resultData)){
            $arr = array();
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($arr,$row);
            }
            return $arr;
        }
        else{
            return false;
        }       
    }
    function showFee($conn, $fee = null, $searchkey = null){
        if($searchkey === null){
            if($fee === null) {
                //declare the SQL
                $sql = "SELECT  *
                        FROM
                            `tb_fees`;";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
            }
            else{  //check if $sec has value
                $sql = "SELECT  *
                        FROM
                            `tb_fees`
                        WHERE
                            fee_ID = ?;";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "s" , $fee);
                }
            }
        else{ //check if searchkey variable is not NULL
            $sql = "SELECT  *
                        FROM
                            `tb_fees`
                    WHERE
                        name like ? 
                        OR type = ?
                        OR status = ?;";
            $stmt=mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "Something went wrong.";
                exit();
            } 
            $fees="%{$searchkey}%";
            mysqli_stmt_bind_param($stmt, "sss" , $fees, $searchkey, $searchkey);  
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if(!empty($resultData)){
            $arr = array();
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($arr,$row);
            }
            return $arr;
        }
        else{
            return false;
        }       
    }
    function showStudentRecord($conn, $fee = null){
            if($fee === null ) {
                //declare the SQL
                $sql = "SELECT  *
                        FROM
                            `tb_payment` as p
                            JOIN tb_fee as f
                            ON f.fee_ID = p.fee_ID
                            JOIN tb_student as st
                            ON st.stud_ID = p.stud_ID
                            JOIN tb_dept as d
                            ON d.dept_ID = st.dept_ID
                            JOIN tb_course as c
                            ON c.course_ID = st.course_ID
                            JOIN tb_blockyear as b 
                            ON b.by_ID = st.by_ID;";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
            }
            else{  //check if $sec has value
                $sql = "SELECT  *
                        FROM
                            `tb_payment` as p
                            JOIN tb_fee as f
                            ON f.fee_ID = p.fee_ID
                            JOIN tb_student as st
                            ON st.stud_ID = p.stud_ID
                            JOIN tb_dept as d
                            ON d.dept_ID = st.dept_ID
                            JOIN tb_course as c
                            ON c.course_ID = st.course_ID
                            JOIN tb_blockyear as b 
                            ON b.by_ID = st.by_ID
                        WHERE
                            f.fee_ID = ?
                            AND st.stud_status = 'A';";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "s" , $fee);
                }
        
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if(!empty($resultData)){
            $arr = array();
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($arr,$row);
            }
            return $arr;
        }
        else{
            return false;
        }     
    }
    function showStudentPaidFee($conn, $fee = null, $stud_num = null, $searchkey = null){
        if($searchkey === null){
            if($stud_num === null AND $fee === null) {
                //declare the SQL
                $sql = "SELECT  *
                        FROM
                        `tb_payments` as p
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        JOIN tb_year as y 
                        ON y.year_ID = s.year_ID
                        JOIN tb_block as b 
                        ON b.block_ID = s.block_ID;";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
            }
            else{  //check if $fee and $stud_num has value
                $sql = "SELECT *
                        FROM
                            `tb_payments` as p
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        JOIN tb_year as y 
                        ON y.year_ID = s.year_ID
                        JOIN tb_block as b 
                        ON b.block_ID = s.block_ID
                        WHERE
                            f.fee_ID = ? AND st.stud_num = ?;";
        
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "ss" , $fee, $_SESSION['userlogged']);
            }
        }
        else{ //check if searchkey variable is not NULL
            $sql = "SELECT  *
                    FROM
                        `tb_payments` as p
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        JOIN tb_year as y 
                        ON y.year_ID = s.year_ID
                        JOIN tb_block as b 
                        ON b.block_ID = s.block_ID
                        WHERE
                            f.name like ? 
                            AND st.stud_num = ?;";
            $stmt=mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "Something went wrong.";
                exit();
            }
            $search="%{$searchkey}%"; 
            mysqli_stmt_bind_param($stmt, "ss" , $search, $_SESSION['userlogged']);
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if(!empty($resultData)){
            $arr = array();
            while($row = mysqli_fetch_assoc($resultData)){
                if($row['rmrks'] == 'PAID'){
                    array_push($arr,$row);
                }
            }
            if(!empty($arr)){ 
                return $arr;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }     
    }
    function showGenerateReport($conn, $sec = null, $fee = null, $searchkey = null){
        if($searchkey === null){
            if($sec === null AND $fee === null) {
                //declare the SQL
                $sql = "SELECT  *
                        FROM
                        `tb_payments` as p
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        JOIN tb_year as y 
                        ON y.year_ID = s.year_ID
                        JOIN tb_block as b 
                        ON b.block_ID = s.block_ID;";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
            }
            else{  //check if $sec and $fee has value
                $sql = "SELECT *
                        FROM
                            `tb_payments` as p
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        JOIN tb_year as y 
                        ON y.year_ID = s.year_ID
                        JOIN tb_block as b 
                        ON b.block_ID = s.block_ID
                        WHERE
                            s.section_ID = ? 
                            AND st.user_status = 'ACTIVE' 
                            AND f.fee_ID = ?;";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    return false;
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "ss" , $sec, $fee);
            }
        }
        else{ //check if searchkey variable is not NULL
            $sql = "SELECT  *
                    FROM
                        `tb_payments` as p
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        JOIN tb_year as y 
                        ON y.year_ID = s.year_ID
                        JOIN tb_block as b 
                        ON b.block_ID = s.block_ID
                        WHERE
                            s.section_ID = ?;";
            $stmt=mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "Something went wrong.";
                exit();
            }
            $search="%{$searchkey}%"; 
            mysqli_stmt_bind_param($stmt, "s");
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if(!empty($resultData)){
            $arr = array();
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($arr,$row);
            }
            return $arr;
        }
        else{
            return false;
        }     
    }
    function showReceiptDetails($conn, $studrecord_id = null){
        if($studrecord_id == null){
            $sql_payment = "SELECT  *
                        FROM
                            `tb_payments` as p
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        JOIN tb_year as y 
                        ON y.year_ID = s.year_ID
                        JOIN tb_block as b 
                        ON b.block_ID = s.block_ID;";
            $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql_payment)){
                    return false;
                    exit();
                }      
        }
        else{
           $sql_payment = "SELECT  *
                        FROM
                            `tb_payments` as p
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        JOIN tb_year as y 
                        ON y.year_ID = s.year_ID
                        JOIN tb_block as b 
                        ON b.block_ID = s.block_ID
                        WHERE 
                            transaction_ID = ? ;"; 
            $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql_payment)){
                    echo "Something went wrong!";
                    exit();
                }
            mysqli_stmt_bind_param($stmt, "s" , $studrecord_id);
            
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if(!empty($resultData)){
            $arr = array();
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($arr,$row);
            }
            return $arr;
        }
        else{
            return false;
        }     
    }
    function showReportByFee($conn, $fee_id = null){
        if($fee_id == null){
            $sql_payment = "SELECT  *
                        FROM
                            `tb_payments` as p
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        JOIN tb_year as y 
                        ON y.year_ID = s.year_ID
                        JOIN tb_block as b 
                        ON b.block_ID = s.block_ID;";
            $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql_payment)){
                    return false;
                    exit();
                }      
        }
        else{
           $sql_payment = "SELECT  *
                        FROM
                            `tb_payments` as p
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        JOIN tb_year as y 
                        ON y.year_ID = s.year_ID
                        JOIN tb_block as b 
                        ON b.block_ID = s.block_ID
                        WHERE 
                            f.fee_ID = ? ;"; 
            $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql_payment)){
                    echo "Something went wrong!";
                    exit();
                }
            mysqli_stmt_bind_param($stmt, "s" , $fee_id);
            
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if(!empty($resultData)){
            $arr = array();
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($arr,$row);
            }
            return $arr;
        }
        else{
            return false;
        }     
    }
    function showTotalSales($conn, $fee_id = null, $section_id = null){
        if($fee_id == null && $section_id == null){
            $sql_sum = "SELECT
                            SUM(total_amt)
                        FROM
                            tb_payments as p
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID;";
            $stmt_ins1 = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt_ins1, $sql_sum)){
                return false;
                exit();
            }
        }
        else if(!empty($fee_id)){
           $sql_sum = "SELECT
                            SUM(total_amt)
                        FROM
                            tb_payments as p
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        WHERE
                            f.fee_ID = ?;";
            $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql_sum)){
                    echo "Something went wrong!";
                    exit();
                }
            mysqli_stmt_bind_param($stmt,"s",$fee_id);
        }
        else if(!empty($fee_id) && !empty($section_id)){
            $sql_sum = "SELECT
                            SUM(total_amt)
                        FROM
                            tb_payments as p
                        JOIN tb_fees as f
                        ON f.fee_ID = p.fee_ID
                        JOIN tb_students as st
                        ON st.stud_num = p.stud_ID
                        JOIN tb_section as s
                        ON s.section_ID = st.section_ID
                        WHERE
                            f.fee_ID = ? 
                            AND s.section_ID = ?;";
            $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql_sum)){
                    return false;
                    exit();
                }
            mysqli_stmt_bind_param($stmt,"ss",$fee_id,$section_id);
        }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if(!empty($resultData)){
            $arr = array();
            while($row = mysqli_fetch_assoc($resultData)){
                array_push($arr,$row);
            }
            return $arr;
        }
        else{
            return false;
        }     
    }   
    function checkImage($img_file, $targetdir, $targetimagename){   
        $stat = array(
            'fileSizeOk' => '',
            'fileExists' => '',
            'fileType' => ''
        );
    
        $tmp_filename = $img_file['tmp_name'];
        $file_size = $img_file['size'];
        $img_size = getimagesize($img_file['tmp_name']);
        $img_mime = $img_size['mime'];
        $acceptable_files = array('image/jpeg','image/png','image/jpg');
    
        if(! in_array($img_mime, $acceptable_files)){
            $stat['fileType'] = "This file is not an Image .[jpg / png] only";
        }
        if($img_size === false || $file_size > 500000){
            $stat['fileSizeOk'] = "Image size is not acceptable [5MB below only]";
        }
        if(file_exists($targetdir."/".$targetimagename)){
            $stat['fileExists'] = "File Exists. Change the File Name";
        }  
        return $stat;   
    }
    function randomPassword() {
        $number = '1234567890';
        $pass = array(); //remember to declare $pass as an array
        $numLength = strlen($number) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $numLength);
            $pass[] = $number[$n];
        }
        return implode($pass); //turn the array into a string
    }
    function archiveSection($conn, $arc_sec){
        $err;
        $sql = "UPDATE
                    `tb_section`
                SET
                    `section_status` = 'DISCONTINUED'
                WHERE
                    `section_ID` = ?;";
        $stmt = mysqli_stmt_init($conn); 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit(); 
        }
        mysqli_stmt_bind_param($stmt, "s", $arc_sec);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }
    function archiveYear($conn, $arc_year){
        $err;
        $sql = "UPDATE
                    `tb_year`
                SET
                    `status` = 'DISCONTINUED'
                WHERE
                    `year_ID` = ?;";
        $stmt = mysqli_stmt_init($conn); 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit();     
        }
        mysqli_stmt_bind_param($stmt, "s", $arc_year);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }
    function archiveBlock($conn, $arc_block){
        $err;
        $sql = "UPDATE
                    `tb_block`
                SET
                    `status` = 'DISCONTINUED'
                WHERE
                    `block_ID` = ?;";
        $stmt = mysqli_stmt_init($conn); 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit(); 
        }
        mysqli_stmt_bind_param($stmt, "s", $arc_block);
        mysqli_stmt_execute($stmt);            
        mysqli_stmt_close($stmt);
        return true;
    }
    function updateStudent($conn, $stud_ID, $fname, $mname, $lname, $dept, $course, $by, $email ){
        $err;
        $sql = "UPDATE
                    `tb_student`
                SET
                    `fname` = ?, `mname` = ? , `lname` = ? , `dept_ID` = ? , `course_ID` = ? , `by_ID` = ?, `email` = ?
                WHERE
                    `stud_ID` = ?;";
        $stmt = mysqli_stmt_init($conn); 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit(); 
        }
        mysqli_stmt_bind_param($stmt, "ssssssss", $fname, $mname, $lname, $dept, $course, $by, $email, $stud_ID);
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_close($stmt);
        return true;
    }
    function archiveStudent($conn, $arc_stud){
        $err;
        $sql = "UPDATE
                    `tb_student`
                SET
                    `stud_status` = 'D'
                WHERE
                    `stud_ID` = ?;";
        $stmt = mysqli_stmt_init($conn); 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit(); 
        }
        mysqli_stmt_bind_param($stmt, "s", $arc_stud);
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_close($stmt);
        return true;
    }
    function updateFee($conn, $fee_ID, $fee_code, $name, $dscrptn, $due, $price){
        $err;
        $sql = "UPDATE
                    `tb_fee`
                SET
                    `fee_code` = ?, `fee_name` = ? , `fee_dscrptn` = ? , `fee_due` = ?, `fee_price` = ?
                WHERE
                    `fee_ID` = ?;";
        $stmt = mysqli_stmt_init($conn); 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit(); 
        }
        mysqli_stmt_bind_param($stmt, "ssssss", $fee_code, $name, $dscrptn, $due, $price, $fee_ID);
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_close($stmt);
        return true;
    }
    function archiveFee($conn, $arc_fee){
        $err;
        $sql = "UPDATE
                    `tb_fee`
                SET
                    `fee_status` = 'D'
                WHERE
                    `fee_ID` = ?;";
        $stmt = mysqli_stmt_init($conn); 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            return false;
            exit(); 
        }
        mysqli_stmt_bind_param($stmt, "s", $arc_fee);
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_close($stmt);
        return true;
    }
?>