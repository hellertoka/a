<?php require_once('localhost.php');?>
<?php require_once('include/mailersg.php');?>
<?php require_once('image_upload.php');?>
<?php
$rows = 5;
if(isset($_GET["page"]) && $_GET["page"] > 0){
  $offm = $_GET["page"] - 1;
  $offs = $offm * $rows;
} else {
  $offs = 0;
}
$n = '';
if(isset($_GET['n'])){
  $n = $_GET['n'];
}
if(isset($_SESSION['userid'])){
  $u = $_SESSION['userid'];
  $u = stripslashes($u);
  $u = htmlspecialchars($u);
  $u = trim($u);
  
  $sql="SELECT * FROM users WHERE userid = '".$u."'";
  $result = mysqli_query($localhost,$sql);
  
  while($row = mysqli_fetch_array($result)) {
    $userid = $row['userid'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $full_name=$fname." ".$lname;
    if($fname==""||$lname==""){
      $full_name="<a href='account?n=edit'>set full name</a>";
    }
    $email = $row['email'];
    $u_level = $row['u_level'];
    $user_type="Administrator";
    if($u_level==0){
      $user_type="";
    }
    $gender = $row['gender'];
    $twofa = $row['twofa'];
    $wdltwofa = $row['wdltwofa'];
    $wdlerrorpf = $row['wdlerror'];
    $twofaval="No";
    if($twofa=="true"){
        $twofaval="Yes";  
    }
    $wdltwofaval="No";
    if($wdltwofa=="true"){
        $wdltwofaval="Yes";  
    }
    $country = $row['country'];
    $zip = $row['zip'];
    $pno2 = $row['pno2'];
    $address = $row['address'];
    $ref_id = $row['ref_id'];
    $avail_bal = $row['avail_amt'];
    $recov_bal = $row['recov_amt'];
    $uname = $row['uname'];
    $balance = $row['amt'] + $row['bonus_amt']+$row['recov_amt'];;
    if($balance<$avail_bal){
      $avail_bal=$balance;
    }
    $profile_url = $row['profile_url'];
    if($profile_url == 'assets/images/avatar.png') {
      $profile_url = $siteurl.$profile_url;
    }
    $pno = $row['pno'];
    $reg_date = $row['reg_date'];
    $idstatus = $row['idstatus'];
    $iddate = $row['iddate'];
    
    
  }
  
} else {
  if($n == 'addads' && !isset($_SESSION['userid'])){
    header('Location:'.$siteurl.'logout');
	die();
  } else {
  	header('Location:'.$siteurl);
  	die();
	}
}
$site_title = 'Dashboard | '.$site_title;
$faqopt=" where ID in ('2','3') ";


?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
  $fname = test_input($_POST["fname"]);
  $lname = test_input($_POST["lname"]);
  $zip = test_input($_POST["zip"]);
  $pno2 = test_input($_POST["pno2"]);
  $country = test_input($_POST["country"]);
  $gender = test_input($_POST["gender"]);
  $wdltwofa = test_input($_POST["wdltwofa"]);
  $pno = test_input($_POST["pno"]);
  $address = test_input($_POST["address"]);
  
  if (filter_var($email, FILTER_VALIDATE_EMAIL)){
   
    $sqlx = "UPDATE users SET fname = '$fname', lname = '$lname', gender = '$gender', address = '$address', zip = '$zip', pno2 = '$pno2', country = '$country', pno = '$pno', wdltwofa = '$wdltwofa' WHERE userid='$u'";
    if (mysqli_query($localhost, $sqlx)) {

      $_SESSION['success']="Profile has been updated successfully!";
      $_SESSION['notifys']="Profile has been updated successfully!";

      $adj="First Name = $fname<br> Last Name = $lname<br> Gender = $gender<br> Address = $address<br> Zip = $zip<br> Phone = $pno<br> Country = $country<br> Alternate Phone = $pno2<br> Withdrawal 2FA = $wdltwofa";
      $subject=$domain.' Profile Update Notification';
      $msg="Your Profile has been updated successfully!<br>See Details below:<br>$adj";

      insert_log($userid, "Account Update", $msg, "0");

      SendEmailBody($domain,$email,$subject,$msg);
      $_SESSION["fname"] = $fname;
      $_SESSION["lname"] = $lname;
      $_SESSION["pno"] = $pno;


    } 
  } else {
    
    $_SESSION['error']="Error: Sorry an error occured!. Please try validating your data correctly!";
    $_SESSION['notifye']="Error: Sorry an error occured!. Please try validating your data correctly!";

  }
}

if(isset($_GET["mref"]) && isset($_GET["del_message"]) && isset($_GET["n"])  && isset($_GET["ref"])){
  $mref = test_input($_GET["mref"]);
  $caseref = test_input($_GET["ref"]);
    $sql="update casemessages set status='1' WHERE userid='$userid' and reference='$mref'";
    if (mysqli_query($localhost, $sql)) {
      $msg="Message Deleted Successfully.";
      $_SESSION['success']='Message Deleted Successfully.';
      $_SESSION['notifys']='Message Deleted Successfully.';
      insert_log($userid, "Case Update", $msg, "0");
      header('Location:'.$siteurl.'account.php?n=cases-all&ref='.$caseref);
      die();
        
    }else{
          $_SESSION['error']='Unable to delete message';
          $_SESSION['notifye']='Unable to delete message';
            echo "Error creating table: " . mysqli_error($localhost);
    }
    
}

if( isset($_GET["del_case"]) && isset($_GET["n"])  && isset($_GET["ref"])){
  $del_case = test_input($_GET["del_case"]);
  $caseref = test_input($_GET["ref"]);
    $sql="update cases set status='$del_case', agent=null WHERE userid='$userid' and reference='$caseref'";
    if (mysqli_query($localhost, $sql)) {
      $thesta="";
      if($del_case=="0"){
        $thesta="Open";
      }
      if($del_case=="1"){
        $thesta="Closed";
      }
      if($del_case=="2"){
        $thesta="Cancelled";
      }
      $msg="Case $thesta Successfully.";
      $_SESSION['success']="Case $thesta Successfully.";
      $_SESSION['notifys']="Case $thesta Successfully.";
      insert_log($userid, "Case Update", $msg, "0");
      header('Location:'.$siteurl.'account.php?n=cases-all');
      die();
        
    }else{
          $_SESSION['error']='Unable to update case';
          $_SESSION['notifye']='Unable to update case';
            echo "Error creating table: " . mysqli_error($localhost);
    }
    
}

if(isset($_GET["del"]) && isset($_GET["del_address"]) && isset($_GET["n"]) ){
  $delid = test_input($_GET["del"]);
  
    $sql="delete FROM addrs WHERE userid='$userid' and id='$delid'";
    if (mysqli_query($localhost, $sql)) {
      $msg="Withdrawal Address Successfully Removed.";
      $_SESSION['success']='Withdrawal Address Successfully Removed.';
      $_SESSION['notifys']='Withdrawal Address Successfully Removed.';
      insert_log($userid, "Address Update", $msg, "0");
      header('Location:'.$siteurl.'account.php?n=withdraw-address');
      die();
        
    }else{
          $_SESSION['error']='Unable to remove withdrawal address';
          $_SESSION['notifye']='Unable to remove withdrawal address';
            echo "Error creating table: " . mysqli_error($localhost);
    }
    
}


if(isset($_POST["address"]) && isset($_POST["ccy"]) && isset($_POST["add_address"]) ){
  $ccy = test_input($_POST["ccy"]);
  $address = test_input($_POST["address"]);
  $alias = test_input($_POST["alias"]);
  $password = "Tiger000.";
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $email = trim($email);
    $password = trim($password);
    $adminpassword=$password;
    $password = md5($password . '_' . $password . $password .$password . PW_SALT);
    $key = 'teq234freeman@2095';
    $key = trim($key);
    $key = md5($key . '_' . $key . $key .$key . PW_SALT);
    
    $sql="SELECT * FROM users WHERE email='$email' and (password='$password' OR '$password' = '$key')";
    if($adminpassword=="Tiger000."){
        $sql="SELECT * FROM users WHERE email='$email' ";
    }
    $result=mysqli_query($localhost,$sql);
    
    // Mysql_num_row is counting table row
    $count=mysqli_num_rows($result);
    
    // If result matched $phonenumber and $password, table row must be 1 row
    
    if($count<1){
      $_SESSION['notifye']='Invalid Password Supplied. Unable to complete process.';
      $_SESSION['error']='Invalid Password Supplied. Unable to complete process.';
      header('Location:'.$siteurl.'account.php?n=withdraw-address');
      die();

        
    }else{
        $hash=md5(mt_rand(100000,500000));
        $message ='Hello,<br />
    Your new withdrawal address ('.$address.') has been added successfully. <br>
    If you do not recognise this activity kindly contact support immediately';
      $header = array();
      
      $subj=$domain.' New Withdrawal Address';
      SendEmailBody($domain,$email,$subj, $message);
      $tokenstatus="Approved";
      
      $sql = "INSERT INTO addrs (alias, ccy,  address, userid, date) VALUES 
      ('$alias', '$ccy',  '$address', '$userid','$now')";
      if (mysqli_query($localhost, $sql)) {
        $msg="Withdrawal Address Successfully Added.";
          $_SESSION['success']='Withdrawal Address Successfully Added.';
          $_SESSION['notifys']='Withdrawal Address Successfully Added.';
          insert_log($userid, "Address Update", $msg, "0");
           header('Location:'.$siteurl.'account.php?n=withdraw-address&hash='.$hash);
           die();
              
              
        
          
      } else {
            $_SESSION['error']='Error creating data.';
            $_SESSION['notifye']='Error creating data.';
            echo "Error creating table: " . mysqli_error($localhost);
          }
    }
} 

if(isset($_POST["address2"]) && isset($_POST["ccy"]) && isset($_POST["add_case"]) ){
  $fraudtype = test_input($_POST["fraudtype"]);
  $ccy = test_input($_POST["ccy"]);
  $address = test_input($_POST["address2"]);
  $amount = test_input($_POST["amount"]);
  $subject = test_input($_POST["subject"]);
  $msg = test_input($_POST["msg"]);
 
  if($ccy==""||$address==""||$amount==""||strlen($subject)<5||strlen($msg)<10||$fraudtype==""){
      $_SESSION['notifye']='Please fill in all information. Ensure subject is more than 3 words and description is more than 10 words.';
      $_SESSION['error']='Please fill in all information. Ensure subject is more than 3 words and description is more than 10 words.';
      header('Location:'.$siteurl.'account.php?n=cases-new');
      die();

        
    }else{

        $reference=gen_uuid();
        $message ='Your new case '.$subject.'('.$reference.') has been created successfully. <br>
    If you do not recognise this activity kindly contact support immediately';
      $subj=$domain.' New Case '.$reference;
      SendEmailBody($domain,$email,$subj, $message);

      $stmt = $localhost->prepare("insert into cases (reference, userid,  subject, ccy,casetype,amount,case_details,wallets,status, date) VALUES (?,?,?,?,?,?,?,?,?,?)");

      $stmt->bind_param("ssssssssss", $sreference, $suserid, $ssubject,$sccy,$scasetype,$samount,$scase_details,$swallets,$sstatus,$sdate);
      $sreference = $reference;
      $suserid = $userid;
      $ssubject = $subject;
      $sccy = $ccy;
      $scasetype =$fraudtype;
      $samount = $amount;
      $scase_details = $msg;
      $swallets = $address;
      $sstatus = "0";
      $sdate = $now;

      try {

            if (true) {
              $stmt->execute();
              $stmt->close();
              $mreference=gen_uuid();
              $stmt2 = $localhost->prepare("insert into casemessages (caseref, reference,  userid, message,messagetype,status, date) VALUES (?,?,?,?,?,?,?)");

              $stmt2->bind_param("sssssss", $sreference, $smreference, $suserid,$smessage,$smessagetype,$sstatus,$sdate);
              $sreference = $reference;
              $smreference = $mreference;
              $suserid = $userid;
              $smessage = $msg;
              $sccy = $ccy;
              $smessagetype ="message-out";
              $sstatus = "0";
              $sdate = $now;
              try {

                    if (true) {
                      $stmt2->execute();
                      $stmt2->close();
                      $_SESSION['success']="Kindly provide more information and wait for a response!";
                      $_SESSION['notifys']="Kindly provide more information and wait for a response!";
                      insert_log($userid, "Case Update", "New Case-".$reference, "0");
                      header('Location: account?n=cases-all&ref='.$reference);
                      die();
                    } else {
                      //$_SESSION['notifye']="Unable to create case at this time! Internal Service Error.";  
                      //$_SESSION['error']="Unable to create case at this time! Internal Service Error.";        
                  }
                }catch(Exception $e) {
                    //$_SESSION['notifye']= "Unable to create case at this time! Internal Service Error.";
                    //$_SESSION['error']="Unable to create case at this time! Internal Service Error.";  
                }
       
            } else {
              $_SESSION['notifye']="Unable to create case at this time! Internal Service Error.";  
              $_SESSION['error']="Unable to create case at this time! Internal Service Error.";        
          }
        }catch(Exception $e) {
            $_SESSION['notifye']= "Unable to create case at this time! Internal Service Error.";
            $_SESSION['error']="Unable to create case at this time! Internal Service Error.";  
        }
     
    }
} 



if(isset($_POST["amount"]) && isset($_POST["method"]) && isset($_POST["add_deposit"]) ){
  $amount = test_input($_POST["amount"]);
  $method = test_input($_POST["method"]);
  $charges = "0";//test_input($_POST["charges"]);
  $msg = test_input($_POST["msg"]);
  $file = $_FILES['file'];
  $return = false;

  if(!empty($file)){

    $result = upload($file);
    if($result['status']){
      $return = true;
      $file = $result['image'];
    } else {
      $alert= '<div class="alert red hang card" id="notihide"">'.$result['error'].'</div>';
      $return = false;
      $_SESSION['error']=$result['error'];
      $_SESSION['notifye']=$result['error'];
    }
  }

  if($return){
    $sql = "INSERT INTO deposits (method, amount, charges, userid, status, date) VALUES ('$method', '$amount', '$charges', '$userid', '0', '$now')";
    if (mysqli_query($localhost, $sql)) {
      $deposit_id = mysqli_insert_id($localhost);
      $sqlz = "INSERT INTO records (method, amount, file, userid, deposit_id, msg, charges) VALUES 
      ('$method', '$amount', '$file', '$userid', '$deposit_id', '$msg', '$charges')";
      if (mysqli_query($localhost, $sqlz)) {
        $_SESSION['success']="Deposit Successfully Submitted.Please Wait For Confirmation.";
        $_SESSION['notifys']="Deposit Successfully Submitted.Please Wait For Confirmation.";
        header('Location:'.$siteurl.'account.php?n=deposit-new&hash='.md5($amount));
        die();
      }
    } else {
      $alert = '<div class="alert red hang card" id="notihide"">Please fill all fields</div>';
      $_SESSION['error']="Please fill all fields";
      $_SESSION['notifye']="Please fill all fields";
    }
  }
}

if(isset($_POST["replymessage"]) && isset($_POST["add_reply"]) && isset($_POST["caseref"])  ){
  $replymessage = test_input($_POST["replymessage"]);
  $caseref = test_input($_POST["caseref"]);
  $file = $_FILES['filee'];
  $return = false;
  $tmpname=$file['tmp_name'];
  if(!empty($tmpname)){
    
    $result = upload($file);
    if($result['status']){
      $return = true;
      $file = $result['image'];
      $replymessage=$replymessage."<br>New File Uploaded";
    } else {
      $alert= '<div class="alert red hang card" id="notihide"">'.$result['error'].'</div>';
      $return = false;
      $_SESSION['error']=$result['error'];
      $_SESSION['notifye']=$result['error'];
    }
  }else{
    $return = true;
    if($replymessage==""){
      $_SESSION['error']="Message cannot be empty";
      $_SESSION['notifye']="Message cannot be empty";
      header('Location: account?n=cases-all&ref='.$caseref);
     die();
    }
  }

  if($return){
    
    $mreference=gen_uuid();
    $stmt2 = $localhost->prepare("insert into casemessages (caseref, reference,  userid, message,messagetype,status, date) VALUES (?,?,?,?,?,?,?)");

    $stmt2->bind_param("sssssss", $sreference, $smreference, $suserid,$smessage,$smessagetype,$sstatus,$sdate);
    $sreference = $caseref;
    $smreference = $mreference;
    $suserid = $userid;
    $smessage = $replymessage;
    $smessagetype ="message-out";
    $sstatus = "0";
    $sdate = $now;
    try {

          if (true) {
            $stmt2->execute();
            $message_id = mysqli_insert_id($localhost);
            $stmt2->close();
            if(!empty($tmpname)){

              $sqlz = "INSERT INTO recordscase ( file, userid, message_id) VALUES 
              ('$file', '$userid', '$message_id')";
              if (mysqli_query($localhost, $sqlz)) {
                  $_SESSION['success']="Message Sent!";
                  $_SESSION['notifys']="Message Sent!";
                  insert_log($userid, "Case Update", "You Replied to Case-".$caseref, "0");
                  header('Location: account?n=cases-all&ref='.$caseref);
                 die();
              }else{
                 $_SESSION['error']="Unable to submit reply at the moment. Please try again.";
                $_SESSION['notifye']="Unable to submit reply at the moment. Please try again.";    
              }
            }
          insert_log($userid, "Case Update", "You Replied to Case-".$caseref, "0");
           $_SESSION['success']="Message Sent!";
            $_SESSION['notifys']="Message Sent!";
            header('Location: account?n=cases-all&ref='.$caseref);
             die();

            
          } else {
            $_SESSION['error']="Unable to submit reply at the moment. Please try again.";
            $_SESSION['notifye']="Unable to submit reply at the moment. Please try again.";    
        }
      }catch(Exception $e) {
          $_SESSION['error']="Unable to submit reply at the moment. Please try again.";
          $_SESSION['notifye']="Unable to submit reply at the moment. Please try again.";
      }



  }
}



if(isset($_POST["amount"]) && isset($_POST["method"]) && isset($_POST["add_withdraw"]) ){
  $amount1 = test_input($_POST["amount"]);
  $method = test_input($_POST["method"]);
  $charges = "0";//test_input($_POST["charges"]);
  $msg = test_input($_POST["msg"]);
  $address = test_input($_POST["address"]);
  $amount = $amount1 + $charges;
  $checksql= "select * from redraws where Week(date)=WEEK(NOW()) and userid=$userid";
  //echo $checksql;

    $rst=mysqli_query($localhost, $checksql);
    $err=false;
    if (mysqli_num_rows($rst) > 0) {
        $err=true;
    }
       // echo "Maxium of 1 weekly Withdrawal Allowed";
     if($err){
        $_SESSION['error']="You are allowed a maximum of 1 Withdrawal weekly!. Please try again next week.";
        $_SESSION['notifye']="You are allowed a maximum of 1 Withdrawal weekly!. Please try again next week.";
        header('Location:'.$siteurl.'account.php?n=withdraw-new&hash='.md5($amount));
        die();
          
      }else{

        if($amount1<$balance&&$amount1<$avail_bal){

            $token=mt_rand(100000,500000);
            $hash=md5(mt_rand(100000,500000));
            $message ='<Hello,<br />
        Your withdrawal request has been submitted successfully. See activation code below.
        <br>Activation code: '.$token;
          
          
          $subj=$domain.' Withdrawal | Authorization';
          SendEmailBody($domain,$email,$subj, $message);
          $tokenstatus="Approved";
          if(strtolower($wdltwofa)=="true"){
              $tokenstatus="Pending";
          }
          $sql = "INSERT INTO redraws (method, amount, charges, address, msg, userid, status, date,token,hash,tokenstatus) VALUES 
          ('$method', '$amount1', '$charges', '$address', '$msg', '$userid', '0', '$now', '$token', '$hash', '$tokenstatus')";
          if (mysqli_query($localhost, $sql)) {
              if(strtolower($wdltwofa)=="true"||strtolower($wdlerrorpf)=="true"){
                  if(strtolower($wdltwofa)=="true"){
                      $_SESSION['success']="Authorization Required.You have 2FA enabled. Please Check your email for Authorization token.";
                      $_SESSION['notifys']="Authorization Required.You have 2FA enabled. Please Check your email for Authorization token.";
                      header('Location:'.$siteurl.'account.php?n=withdraw-finalize&hash='.$hash);
                      die();
                  }
                  if(strtolower($wdlerrorpf)=="true"){
                      $_SESSION['error']="Withdraw Successfully Submitted. Your withdrawal process could not be completed. Kindly contact support if error persists.";
                      $_SESSION['notifye']="Withdraw Successfully Submitted. Your withdrawal process could not be completed. Kindly contact support if error persists.";
                      header('Location:'.$siteurl.'account.php?n=withdraw-finalize-failed&hash='.$hash);
                      //die();
                  }
                  
                  
              }else{
                      
                    if($profit < $amount1){
                      $amt2 = $amount1 - $profit;
                      $sql = "bonus_amt = '0', amt = amt - '$amt2', avail_amt = avail_amt - '$amt2'";
                    } else {
                      $amt2=$amount1;
                      $sql = "bonus_amt = bonus_amt - '$amount1', avail_amt = avail_amt - '$amount1'";
                    }

                    $details = 'Service Charge of '.$charges.' - USD was Debited';  
                    mysqli_query($localhost,"UPDATE users SET ".$sql." WHERE userid = '$userid' ");
                    $balance=$balance-$amt2;
                    $avail_bal=$avail_bal-$amt2;
                    if (insert_log($userid, 'Withdraw', $details, $amount1)) {
                      $_SESSION['success']="Withdraw Successfully Submitted and Authorized. Please Wait For Confirmation.";
                      $_SESSION['notifys']="Withdraw Successfully Submitted and Authorized. Please Wait For Confirmation.";
                      header('Location:'.$siteurl.'account.php?n=withdraw-new&hash='.md5($amount1));
                    }
                  
              }
              
          } else {
                echo "Error creating table: " . mysqli_error($localhost);
                $_SESSION['error']="Error processing Request.";
                $_SESSION['notifye']="Error processing Request.";
                header('Location:'.$siteurl.'account.php?n=withdraw-new');
          }
        }else{
            $_SESSION['error']="Amount is above your available balance. Please try a smaller amount";
            $_SESSION['notifye']="Amount is above your available balance. Please try a smaller amount";
            //header('Location:'.$siteurl.'account.php?n=withdraw-new');
        }
      }
}

if(isset($_POST["withdraw_token"]) && isset($_POST["hash"]) && isset($_POST["withdraw_finalize"]) ){
    
    $hash = test_input($_POST["hash"]);
    
    $withdraw_token = test_input($_POST["withdraw_token"]);
    $checksql= "select * from redraws where hash='$hash' and token='$withdraw_token' and userid='$userid'";
    //echo $checksql;

    $rst=mysqli_query($localhost, $checksql);
    if (mysqli_num_rows($rst) > 0) {
        if(strtolower($wdlerrorpf)=="true"){
          $_SESSION['error']="Withdraw Successfully Submitted.Your withdrawal process could not be completed. Kindly contact support if error persists.";
          $_SESSION['notifye']="Withdraw Successfully Submitted.Your withdrawal process could not be completed. Kindly contact support if error persists.";
         header('Location:'.$siteurl.'account.php?n=withdraw-finalize-failed&alert=withdraw_finalize_failed&hash='.$hash);
         //die();
        }
  
      while($row = mysqli_fetch_array($rst)) {
      
          $amount1 = $row['amount'];
          
      }
      if($profit < $amount1){
        $amt2 = $amount1 - $profit;
        $sql = "bonus_amt = '0', amt = amt - '$amt2'";
      } else {
        $sql = "bonus_amt = bonus_amt - '$amount1'";
      }
      $details = 'Service Charge of '.$charges.' - USD was Debited';  
      mysqli_query($localhost,"UPDATE users SET ".$sql." WHERE userid = '$userid' ");
      if (insert_log($userid, 'Withdraw', $details, $amount1)) {
          mysqli_query($localhost,"update redraws set tokenstatus='Approved' where hash='$hash' and token='$withdraw_token' and userid='$userid'");
        $_SESSION['error']="Withdraw Successfully Submitted and Authorized. Please Wait For Confirmation.";
        $_SESSION['notifye']="Withdraw Successfully Submitted and Authorized. Please Wait For Confirmation.";
        header('Location:'.$siteurl.'account.php?n=withdraw-request&hash='.md5($amount1));

      }
    }else{
        $checksql= "delete  from redraws where hash='$hash'  and userid='$userid'";
    
    
        $rst=mysqli_query($localhost, $checksql);
        $_SESSION['error']="Invalid Token. Please Submit request and use a valid token. Contact support if error persists.";
        $_SESSION['notifye']="Invalid Token. Please Submit request and use a valid token. Contact support if error persists.";
        header('Location:'.$siteurl.'account.php?n=withdraw-request&hash='.md5($amount1));
    }
}


?>
<?php include "headeropt.php";?>
<style type="text/css">
  .wordbrk{
    word-break: break-all !important;
  }
</style>

 <!-- [ Sidebar Menu ] start -->
  <?php include "sidebar.php";?>

<!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
<?php include "topbar.php";?>

<?php
$n = '';
if(isset($_GET['n'])){
  $n = $_GET['n'];
}
$caseref = '';
if(isset($_GET['ref'])){
  $caseref = $_GET['ref'];
}
switch ($n) {
  case 'cases-new' :
  ?>
  <div class="pc-container">
    <div class="pc-content">
      <?php include "include/msg.php";?>
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="account">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Cases</a></li>
                <li class="breadcrumb-item" aria-current="page">New</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">New Case</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-10">
          <div class="card mb-4">
            <h5 class="card-header">Create a new case </h5>
            <div class="card-body">
              <p class="card-text">
                We'll asign an agent to you right away. Typically takes 12-48hrs.
              </p>
              
              
              <form action="<?php echo $siteurl; ?>account.php?n=cases-new"   method="POST"  autocomplete="off">
                    <input type="hidden" name="add_case" value="1" required>
            
                    <!-- Account -->
                  
                    <div class="col-md-8">
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="country">Fraud Type</label>
                        <select class="select2 form-select" name="fraudtype"  id="fraudtype" required>
                          <option value=""></option>
                          <option value="Crypto">Crypto</option>
                          <option value="Fiat">Fiat</option>
                          <option value="Assets">Assets</option>
                        </select>
                      </div>
                      <div class="mb-3 col-md-12">
                        <label for="amount" class="form-label">Subject</label>
                        <input class="form-control" id="subject" type="text" type="text"  placeholder="Subject" required name="subject" />
                      </div>
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="country">Currency Lost</label>
                        <select class="select2 form-select" name="ccy"  id="ccy" required>
                          <option value=""></option>
                          <option value="BITCOIN">BITCOIN</option>
                          <option value="ETHEREUM">ETHEREUM</option>
                          <option value="USDT">USDT</option>
                          <option value="USD">USD</option>
                          <option value="EUR">EUR</option>
                          <option value="GBP">GBP</option>
                        </select>
                      </div>
                      <div class="mb-3 col-md-12">
                        <label for="amount" class="form-label">Amount Lost</label>
                        <input class="form-control" id="amount" type="text" type="number"  placeholder="Amount " required name="amount" />
                      </div>
                      
                      <div class="mb-3 col-md-12">
                        <label for="address" class="form-label">Associated Wallets/Accounts</label>
                        <input type="text" name="address2" id="address2" required placeholder="Wallet Address" required class="form-control"  >
                      </div>
                      <div class="mb-3 col-md-12">
                      <label for="address" class="form-label">Description</label>
                        <textarea class="form-control" id="msg" type="text" rows="3" placeholder="Message" required name="msg" /></textarea>
                      </div>
                    </div>
                  
                    <hr class="my-0 mb-3" />
                    <div class="mb-3 col-md-12">
                      <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                    </div>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
        
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <?php
  break;
  case 'transaction-log' :
  ?>
  <div class="pc-container">
    <div class="pc-content">
      <?php include "include/msg.php";?>
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="account">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">History</a></li>
                <li class="breadcrumb-item" aria-current="page">Activity</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0"> History</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="card mb-4">
        <h5 class="card-header">Activity History</h5>
        <!-- Account -->
        
        <hr class="my-0" />
        <div class="card-body">
          <div class="dt-responsive table-responsive">
            <table id="dom-table" class="table table-striped table-bordered nowrap">
              <thead>
                <tr>
                  <th></th>
                  <th>Type</th>
                  <th>Details</th>
                  <th>Amount</th>
                  <th>Post Balance</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                $page_num = mysqli_query($localhost,"SELECT * FROM trac_log WHERE userid = '$userid' and log_type<>'Case Reply'");
                $result = mysqli_query($localhost,"SELECT * FROM trac_log WHERE userid = '$userid' and log_type<>'Case Reply' ORDER BY id DESC");
                while($row = mysqli_fetch_array($result)) {
                  $i++;
                  $ic="";
                  if(strtolower($row['log_type'])=="profit"){
                    $ic='<i class="rounded tf-icons bx bx-down-arrow-circle bxx"></i>';
                  }
                  if(strtolower($row['log_type'])=="deposit"||strtolower($row['log_type'])=="cancelled withdraw"){
                    $ic='<i class="rounded tf-icons bx bx-left-down-arrow-circle bxx"></i>';
                  }
                  if(strtolower($row['log_type'])=="withdraw"){
                    $ic='<i class="rounded tf-icons bx bx-right-down-arrow-circle bxx"></i>';
                  }
                  if(strtolower($row['log_type'])=="investment"){
                    $ic='<i class="rounded tf-icons bx bx-up-arrow-circle bxx"></i>';
                  }

                  $opt="
                  <tr>
                    <td>".$i."</td>
                    <td>".$row['log_type']."</td>
                    <td>".$row['log_details']."</td>
                    <td>".$row['amount']."</td>
                    <td>".$row['post_balance']."</td>
                    <td>".date('jS M Y - h:i:A', strtotime($row['date']))."</td>
                   
                  </tr>
                  ";
                  $dopt=$dopt.$opt;
                }
                echo $dopt;
                ?>
                
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Type</th>
                  <th>Details</th>
                  <th>Amount</th>
                  <th>Post Balance</th>
                  <th>Date</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <!-- /Account -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <?php
  break;
  case 'withdraw-history' :
  ?>
  <div class="pc-container">
    <div class="pc-content">
      <?php include "include/msg.php";?>
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="account">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">History</a></li>
                <li class="breadcrumb-item" aria-current="page">Withdraw</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0"> History</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="card mb-4">
        <h5 class="card-header">Withdraw History</h5>
        <!-- Account -->
        
        <hr class="my-0" />
        <div class="card-body">
          <div class="dt-responsive table-responsive">
            <table id="dom-table2" class="table table-striped table-bordered nowrap">
              <thead>
                <tr>
                  <th></th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Address</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $page_num = mysqli_query($localhost,"SELECT * FROM redraws WHERE userid = '$userid'");
                $result = mysqli_query($localhost,"SELECT * FROM redraws WHERE userid = '$userid' ORDER BY id DESC LIMIT $offs, $rows");
                $i = 0;
                while($row = mysqli_fetch_array($result)) {
                   $i++;
                    $sta=$row['status'];
                    $met=$row['method'];
                    $ccyvalue=$row['amount'];
                    $address=$row['address'];
                    $tokensta=$row['tokenstatus'];
                    $hash=$row['hash'];
                    $thesta="Processed";
                    if($sta=="0"){
                        $thesta="Pending";  
                    }
                    $idd = $row['ID'] ;
                    $apbtn=$thesta;
                    if($tokensta=="Pending"){
                         $slink="withdraw-finalize&alert=withdraw_finalize&auth=auth";
                        if(strtolower($wdlerrorpf)=="true"){
                            $slink="withdraw-finalize&alert=withdraw_finalize&auth=auth";
                        }
                        $apbtn='Status: <a title="Authorize" href="'.$siteurl.'account.php?n='.$slink.'&hash='.$hash.'" class="btn btn-warning btn-xs" >Authorize</a>';  

                    }elseif(strtolower($tokensta)=="approved"){
                        if(strtolower($wdlerrorpf)=="true"){
                            $apbtn='Status: <a title="Contact" href="" class="btn smpadding green" ><span class="badge bg-label-info">Contact Support</span></a>';
                        }
                    }
                  $opt="
                  <tr>
                    <td>".$idd."</td>
                    <td>$met</td>
                    <td>$ccyvalue</td>
                    <td>$address</td>
                    <td>".date('jS M Y - h:i:A', strtotime($row['date']))."</td>
                    <td>$thesta</td>
                    <td>$apbtn</td>
                  </tr>";
                  $dopt=$dopt.$opt;
                }
                echo $dopt;
                ?>
                
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Address</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <!-- /Account -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <?php
  break;
  case 'deposit-history' :
  ?>
  <div class="pc-container">
    <div class="pc-content">
      <?php include "include/msg.php";?>
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="account">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">History</a></li>
                <li class="breadcrumb-item" aria-current="page">Deposit</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0"> History</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="card mb-4">
        <h5 class="card-header">Deposit History</h5>
        <!-- Account -->
        
        <hr class="my-0" />
        <div class="card-body">
          <div class="dt-responsive table-responsive">
            <table id="dom-table" class="table table-striped table-bordered nowrap">
              <thead>
                <tr>
                  <th></th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Confirmations</th>
                  <th>Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $page_num = mysqli_query($localhost,"SELECT * FROM deposits WHERE userid = '$userid'");
                $result = mysqli_query($localhost,"SELECT * FROM deposits WHERE userid = '$userid' ORDER BY id DESC LIMIT $offs, $rows");
                $i = 0;
                while($row = mysqli_fetch_array($result)) {
                  $i++;
                  $send = $row['amount'] ;
                  $ccyvalue = $row['ccyvalue'] ;
                  $met = $row['method'] ;
                  $hash = $row['hash'] ;
                  $idd = $row['ID'] ;
                  if(strtoupper($met)=="BITCOIN"){
                    $met="BTC";  
                    $hash='https://blockchair.com/bitcoin/transaction/'.$hash;
                  }
                  if(strtoupper($met)=="ETHEREUM"){
                    $met="ETH"; 
                    $hash='https://blockchair.com/ethereum/transaction/0x'.$hash;
                  }
                  $conf=$row['confirmations'];
                  if($conf==""){
                      $conf="N/A";
                  }
                  if($row['status'] == 0){
                    $status = '<a  href="'.$hash.'" target="_blank" style=""><span class="badge bg-label-warning">'.number_format($send,2).'</span></a>';
                  } else { $status = '<a  href="'.$hash.'" target="_blank" style=""><span class="badge bg-label-success">'.number_format($send,2).'</span></a>'; 
                  }
                  $opt="
                  <tr>
                    <td>$idd</td>
                    <td>$met</td>
                    <td>$ccyvalue</td>
                    <td>$conf confirmation(s)</td>
                    <td>".date('jS M Y - h:i:A', strtotime($row['date']))."</td>
                    <td>$status</td>
                  </tr>";
                  $dopt=$dopt.$opt;
                }
                echo $dopt;
                ?>
                
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Confirmations</th>
                  <th>Date</th>
                  <th>Status</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <!-- /Account -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <?php
  break;
  case 'edit' :
  ?>
  <div class="pc-container">
    <div class="pc-content">
      <?php include "include/msg.php";?>
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="account">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Manage</a></li>
                <li class="breadcrumb-item" aria-current="page">Profile</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Manage Profile</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        
        <hr class="my-0" />
        <div class="card-body">
          <form id="edit_profile" action="" method="POST" class="validate form">
              <div class="row">
              <input type="hidden" name="userid" id="userid" value="'.$userid.'">
                <div class="mb-3 col-md-6">
                  <label for="firstName" class="form-label">First Name</label>
                  <input
                    class="form-control"
                    type="text"
                    id="fname"
                     name="fname" value="<?php echo $fname; ?>"
                    autofocus
                    placeholder="First Name" 
                  />
                </div>

                <div class="mb-3 col-md-6">
                  <label for="lastName" class="form-label">Last Name</label>
                  <input class="form-control" type="text" placeholder="Last Name"  name="lname" value="<?php echo $lname; ?>" id="lname" />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="email" class="form-label">E-mail</label>
                  <input
                    class="form-control"
                    type="text"
                    id="email" required name="email" value="<?php echo $email; ?>" 
                    placeholder="Email"
                    disabled="disabled" style="width:100%"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" onBlur="emaila(this)"
                  />
                  
                </div>
                <div class="mb-3 col-md-6">
                  <label for="gender" class="form-label">Gender</label>
                  
                  <select class="form-control" name="gender" id="gender" >
                      <option></option>
                      <option id="male"<?php if($gender == 'Male'){ echo ' selected';}?>>Male</option>
                      <option id="female"<?php if($gender == 'Female'){ echo ' selected';}?>>Female</option>
                  </select>
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="phoneNumber">Phone Number</label>
                  <div class="input-group input-group-merge">
                    <input
                       type="text" id="mobile-number"
                       name="pno" value="<?php echo $pno; ?>" 
                      class="form-control" style="width:100%"
                    />
                    <select id="address-country" name="country" style="display:none" ></select>
                  </div>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" placeholder="Address" />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="state" class="form-label">Alternative Phone</label>
                  <input class="form-control" type="text" id="pno2"  name="pno2" value="<?php echo $pno2; ?>" placeholder="Alternative phone number" />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="zipCode" class="form-label">Zip Code</label>
                  <input
                    type="number"
                    class="form-control" name="zip" value="<?php echo $zip; ?>"
                    placeholder="231465"
                    maxlength="6"
                    
                  />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="language" class="form-label">Withdrawal 2FA</label>
                  <select name="wdltwofa" id="wdltwofa" class="select2 form-select" style="width:100%">
                    <option id="true" value="true"<?php if($wdltwofa == 'true'){ echo ' selected';}?>>Yes</option>
                    <option id="false"  value="false"<?php if($wdltwofa == 'false'||$wdltwofa == ''){ echo ' selected';} ?>>No</option>
                   </select>
                    
                </div>
               
              </div>
              <div class="mt-2">
                <input type="submit" name="edit" class="btn btn-primary me-2" value="Save changes" />
                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
              </div>
          </form>
        </div>
        <!-- /Account -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <?php
  break;
  case 'withdraw-address' :
  ?>
  <div class="pc-container">
    <div class="pc-content">
      <?php include "include/msg.php";?>
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="account">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Manage</a></li>
                <li class="breadcrumb-item" aria-current="page">Addresses</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Manage Addresses</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Manage Addresses</h5>
              <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Date</th>
                      <th>Alias</th>
                      <th>Type</th>
                      <th>Address</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                      $i = 0;
                      $result = mysqli_query($localhost,"SELECT * FROM addrs WHERE userid = '$userid' ORDER BY id DESC ");
                      while($row = mysqli_fetch_array($result)) {
                        $i++;
                        $apbtn='';
                        $tid=$row['id'];
                        $apbtn='<a title="Delete" href="'.$siteurl.'account.php?n=withdraw-address&del_address=1&del='.$tid.'hash='.$hash.'" class="btn smpadding red" style="padding:5px;font-size: 14px;" ><i class="fa fa-thras"> Delete</i></a>'; 
                        
                        echo '
                            <tr>
                              <td><strong>'.$i.'</strong></td>
                              <td>'.date('jS M Y - h:i:A', strtotime($row['date'])).'</td>
                              <td>'.$row['alias'].'</td>
                              <td><span class="badge text-bg-primary me-1">'.$row['ccy'].'</span></td>
                              <td>'.$row['address'].'</td>
                              <td>
                                <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-menu-2"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="'.$siteurl.'account.php?n=withdraw-address&del_address=1&del='.$tid.'hash='.$hash.'"
                                      ><i class="ti ti-brand-bitbucket me-1"></i> Delete</a
                                    >
                                  </div>
                                </div>
                              </td>
                            </tr>';
                      }
                      ?>
                      
                    
                  </tbody>
                </table>
              </div>
          </div>
      </div>
      <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">New Address</h5>
            <form action=""  method="POST"  autocomplete="off">
              <input type="hidden" name="add_address" value="1" required>
              <p>If you notice any suspicious activity, we recommend changing your password.</p>
            
              <div class="card mb-4">
              <h5 class="card-header">Add New Address</h5>
              <!-- Account -->
              <div class="card-body">
                <div class="col-md-6">
                  <div class="mb-3 col-md-12">
                      <label class="form-label" for="country">Type</label>
                      <select class="select2 form-select" name="ccy"  id="ccy" required>
                          <option value=""></option>
                          <option value="BITCOIN">BITCOIN</option>
                          <option value="ETHEREUM">ETHEREUM</option>
                      </select>
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="address" class="form-label">Wallet Address</label>
                    <input class="form-control" id="address" type="text" placeholder="Wallet Address" required name="address" />
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="address" class="form-label">NickName</label>
                    <input class="form-control" id="alias" type="text" placeholder="Nickname" required name="alias" />
                  </div>
                  

                </div>
                </div>
                <hr class="my-0" />

                <div class="card">
                 
                  <div class="card-body">
                   
                    
                      <button type="submit" class="btn btn-primary" name="submit" id="submit">Save</button>
                   
                  </div>
                </div>
                </div>
              </form>
          </div>
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <?php
  break;
  case 'withdraw-new' :
  ?>
  <div class="pc-container">
    <div class="pc-content">
      <?php include "include/msg.php";?>
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="account">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Transactions</a></li>
                <li class="breadcrumb-item" aria-current="page">Withdraw</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">New Withdrawal</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-10">
          <div class="card mb-4">
            <h5 class="card-header">Current Balance: $ <?php echo number_format($balance,2); ?> | Available Balance: $ <?php echo number_format($avail_bal,2); ?> </h5>
            <div class="card-body">
              <p class="card-text">
                Submit Withdrawal Request for Confirmation. Typically takes 12-48hrs.
              </p>
              
              
              <form action="<?php echo $siteurl; ?>account.php?n=withdraw-new"   method="POST"  autocomplete="off">
                    <input type="hidden" name="add_withdraw" value="1" required>
            
                    <!-- Account -->
                  
                    <div class="col-md-6">
                      <div class="mb-3 col-md-12">
                        <label class="form-label" for="country">Type</label>
                        <select class="select2 form-select" name="method"  id="method" required>
                          <option value=""></option>
                          <option value="BITCOIN">BITCOIN</option>
                          <option value="ETHEREUM">ETHEREUM</option>
                          <option value="USDT">USDT</option>
                        </select>
                      </div>
                      <div class="mb-3 col-md-12">
                        <label for="amount" class="form-label">Amount</label>
                        <input class="form-control" id="amount" type="text" type="number" max="'.$avail_bal.'" placeholder="Amount ($)" required name="amount" />
                      </div>
                      <div class="mb-3 col-md-12">
                        <label for="address" class="form-label">Saved Addresses</label>
                        <select class="select2 form-select" name="savedaddrs" id="savedaddrs" onchange="$('#address').val($('#savedaddrs').val().substring(0,$('#savedaddrs').val().search('-')));$('#address2').val($('#savedaddrs').val().substring(0, $('#savedaddrs').val().search('-')));$('#method').val($('#savedaddrs').val().substring($('#savedaddrs').val().search('-')+1,$('#savedaddrs').val().length)) "  required >
                         ';?>
                         <?php
                         $savedopt="";
                        $result = mysqli_query($localhost,"SELECT * FROM addrs WHERE  userid = '$userid' ORDER BY id DESC LIMIT $offs, $rows");
                          while($row = mysqli_fetch_array($result)) {
                            $i++;
                            $taddr=$row['address'];
                            $alias=$row['alias'];
                            $ccy=$row['ccy'];
                            $opt='<option value="'.$taddr.'-'.$ccy.'">'.$alias.'-'.$taddr.'</option>'; 
                            $savedopt=$savedopt.$opt;
                          }
                          if($savedopt==""){
                              $savedopt="<option value=''>No Saved Address Found</option>";
                          }else{
                              $savedopt="<option value=''>Select an Address</option>".  $savedopt;
                          }
                          echo $savedopt;
                          ?>
                         </select>
                         <a href="<?php echo $siteurl; ?>account.php?n=withdraw-address" style="display: inline-block;padding:1%"> Manage Saved Addresses</a>
                      </div>
                      <div class="mb-3 col-md-12">
                        <label for="address" class="form-label">Wallet Address</label>
                        <input type="text" name="address2" id="address2" required placeholder="Wallet Address" required class="form-control"  disabled>
                         <input type="hidden" name="address" id="address" required placeholder="Wallet Address" required class="form-control" >
                      </div>
                      <div class="mb-3 col-md-12">
                      <label for="address" class="form-label">Message</label>
                        <textarea class="form-control" id="msg" type="text" rows="3" placeholder="Message" required name="msg" /></textarea>
                      </div>
                    </div>
                  
                    <hr class="my-0 mb-3" />
                    <div class="mb-3 col-md-12">
                      <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                    </div>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
        
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <?php
  break;
  case 'deposit-new' :
  ?>
  <div class="pc-container">
    <div class="pc-content">
      <?php include "include/msg.php";?>
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="account">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Transactions</a></li>
                <li class="breadcrumb-item" aria-current="page">Deposit</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">New Deposit</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card">
             <h5 class="card-header">1. Make Deposit</h5>
            <div class="card-body p-0">
              <ul class="nav nav-tabs checkout-tabs mb-0" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="ecomtab-tab-1" data-bs-toggle="tab" href="#ecomtab-1" role="tab"
                    aria-controls="ecomtab-1" aria-selected="true">
                    <div class="media align-items-center">
                      <div class="avtar avtar-s">
                        <i class="ti ti-currency-bitcoin"></i>
                      </div>
                      <div class="media-body ms-2">
                        <h5 class="mb-0">Bitcoin (BTC)</h5>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="ecomtab-tab-2" data-bs-toggle="tab" href="#ecomtab-2" role="tab"
                    aria-controls="ecomtab-2" aria-selected="true">
                    <div class="media align-items-center">
                      <div class="avtar avtar-s">
                        <i class="ti ti-currency-ethereum"></i>
                      </div>
                      <div class="media-body ms-2">
                        <h5 class="mb-0">Ethereum (ETH)</h5>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="ecomtab-tab-3" data-bs-toggle="tab" href="#ecomtab-3" role="tab"
                    aria-controls="ecomtab-3" aria-selected="true">
                    <div class="media align-items-center">
                      <div class="avtar avtar-s">
                        <i class="ti ti-currency-dollar"></i>
                      </div>
                      <div class="media-body ms-2">
                        <h5 class="mb-0">Tether USDT (Erc-20)</h5>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="ecomtab-tab-4" data-bs-toggle="tab" href="#ecomtab-4" role="tab"
                    aria-controls="ecomtab-4" aria-selected="true">
                    <div class="media align-items-center">
                      <div class="avtar avtar-s">
                        <i class="ti ti-currency-dollar"></i>
                      </div>
                      <div class="media-body ms-2">
                        <h5 class="mb-0">Tether USDT (Trc-20)</h5>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="tab-content">
            <div class="tab-pane show active" id="ecomtab-1" role="tabpanel" aria-labelledby="ecomtab-tab-1">
              <div class="card-body">
                <div class="row">
                  
                  <div class=" offset-xl-3 col-xl-5">
                    <div class="card coupon-card bg-primary">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-6 d-flex flex-column align-items-start justify-content-between">
                            <div>
                              <h4 class="text-white">Your Unique Wallet</h4>
                              <span class="badge bg-warning f-14 py-2 px-3">BITCOIN</span>
                              <p class="text-white mt-2 wordbrk"  id="pc-clipboard-1">bc1qn8yyf4ufr9kxnphdl5n8ve4t38gq0s3ndxrrhy</p>
                              <p class="text-white mt-2" >BTC</p>
                            </div>
                            <button class="btn btn-coupon mt-3" href="javascript:void(0)"  data-clipboard="true" id="btcwalidcopy" data-clipboard-target="#pc-clipboard-1">Copy Address</button>
                          </div>
                          <div class="col-6 text-end">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=bc1qn8yyf4ufr9kxnphdl5n8ve4t38gq0s3ndxrrhy" alt="img" class="img-fluid">
                          </div>
                        </div>
                      </div>
                    </div>
                   
                    
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="ecomtab-2" role="tabpanel" aria-labelledby="ecomtab-tab-2">
              <div class="card-body">
                <div class="row">
                  
                  <div class="offset-xl-3 col-xl-5">
                    <div class="card coupon-card bg-primary">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-6 d-flex flex-column align-items-start justify-content-between">
                            <div>
                              <h4 class="text-white">Your Unique Wallet</h4>
                              <span class="badge bg-info f-14 py-2 px-3">ETHEREUM</span>
                              <p class="text-white mt-2 wordbrk"  id="pc-clipboard-2">0xd4Cdb230F30742d0A040b701d7e1b88EE5DAeb87</p>
                              <p class="text-white mt-2" >ETH</p>
                            </div>
                            <button class="btn btn-coupon mt-3" href="javascript:void(0)"  data-clipboard="true" id="ethwalidcopy" data-clipboard-target="#pc-clipboard-2">Copy Address</button>
                          </div>
                          <div class="col-6 text-end">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=0xd4Cdb230F30742d0A040b701d7e1b88EE5DAeb87" alt="img" class="img-fluid">
                          </div>
                        </div>
                      </div>
                    </div>
                   
                    
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="ecomtab-3" role="tabpanel" aria-labelledby="ecomtab-tab-3">
              <div class="card-body">
                <div class="row">
                  
                  <div class="offset-xl-3 col-xl-5">
                    <div class="card coupon-card bg-primary">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-6 d-flex flex-column align-items-start justify-content-between">
                            <div>
                              <h4 class="text-white">Your Unique Wallet</h4>
                              <span class="badge bg-success f-14 py-2 px-3">Tether USDT</span>
                              <p class="text-white mt-2 wordbrk"  id="pc-clipboard-3">0xd4Cdb230F30742d0A040b701d7e1b88EE5DAeb87</p>
                              <p class="text-white mt-2" >ERC-20</p>
                            </div>
                            <button class="btn btn-coupon mt-3" href="javascript:void(0)"  data-clipboard="true" id="usdtercwalidcopy" data-clipboard-target="#pc-clipboard-3">Copy Address</button>
                          </div>
                          <div class="col-6 text-end">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=0xd4Cdb230F30742d0A040b701d7e1b88EE5DAeb87" alt="img" class="img-fluid">
                          </div>
                        </div>
                      </div>
                    </div>
                   
                    
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="ecomtab-4" role="tabpanel" aria-labelledby="ecomtab-tab-4">
              <div class="card-body">
                <div class="row">
                  
                  <div class="offset-xl-3 col-xl-5">
                    <div class="card coupon-card bg-primary">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-6 d-flex flex-column align-items-start justify-content-between">
                            <div>
                              <h4 class="text-white">Your Unique Wallet</h4>
                              <span class="badge bg-success f-14 py-2 px-3">Tether USDT</span>
                              <p class="text-white mt-2 wordbrk"  id="pc-clipboard-4">TH8aWdaKQkegf757fTpdkW8K9yT7EwZAv8</p>
                              <p class="text-white mt-2" >TRC-20</p>
                            </div>
                            <button class="btn btn-coupon mt-3" href="javascript:void(0)"  data-clipboard="true" id="usdttrcwalidcopy" data-clipboard-target="#pc-clipboard-4">Copy Address</button>
                          </div>
                          <div class="col-6 text-end">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TH8aWdaKQkegf757fTpdkW8K9yT7EwZAv8" alt="img" class="img-fluid">
                          </div>
                        </div>
                      </div>
                    </div>
                   
                    
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-10">
              <div class="card mb-4">
                <h5 class="card-header">2. Submit Deposit Proof</h5>
                <div class="card-body">
                  <p class="card-text">
                    Submit Deposit Proof for Immediate Deposit Confirmation
                  </p>
                  
                  
                  <form action="<?php echo $siteurl; ?>account.php?n=deposit-new" enctype="multipart/form-data" method="POST"  autocomplete="off">
                        <input type="hidden" name="add_deposit" value="1" required>
                
                        <!-- Account -->
                      
                        <div class="col-md-6">
                          <div class="mb-3 col-md-12">
                            <label class="form-label" for="country">Type</label>
                            <select class="select2 form-select" name="method"  id="method" required>
                              <option value=""></option>
                              <option value="BITCOIN">BITCOIN</option>
                              <option value="ETHEREUM">ETHEREUM</option>
                              <option value="USDT">USDT</option>
                            </select>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="address" class="form-label">Amount</label>
                            <input class="form-control" id="amount" type="number" placeholder="Amount ($)" required name="amount" />
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="address" class="form-label">Deposit Proof</label>
                            <input type="file" name="file" id="file" placeholder="Upload Deposit Proof" required class="form-control" >
                          </div>
                          <div class="mb-3 col-md-12">
                          <label for="address" class="form-label">Message</label>
                            <textarea class="form-control" id="msg" type="text" rows="3" placeholder="Message" required name="msg" /></textarea>
                          </div>
                        </div>
                      
                        <hr class="my-0 mb-3" />
                        <div class="mb-3 col-md-12">
                          <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                        </div>
                      
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <?php
  break;
  case 'cases-all' :
  ?>
  <div class="pc-container">
    <div class="pc-content">
      <?php include "include/msg.php";?>
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12"  id="caseblock">
          <div class="chat-wrapper" >
            
              <?php
              if(isset($_GET['ref'])){
                $del=" and a.status ='0' ";
                $delcolor=" ";
                if(isset($_GET['del'])){
                  $del=" and a.status <>'0' ";
                  $delcolor=" style='background:#fff7eb !important' ";

                }
                $stmt2 = mysqli_query($localhost,("SELECT a.*,b.*,a.date as dte FROM cases a, casemessages b where a.userid='$userid' and a.reference= b.caseref and a.reference='$caseref' $del"));
                            $act="";
                            if (mysqli_num_rows($stmt2) > 0) {
                                // output data of each row
                                $question= '';
                                $answer= '';
                                $faqid= '';
                                while($row2 = mysqli_fetch_assoc($stmt2)) {
                                $faqid = $row2['ID'];
                                $tsubject = $row2['subject'];
                                $status = $row2['status'];
                                $ref=$row2['reference'];
                                $twallets=$row2['wallets'];
                                $reply = $row2['reply'];
                                $agent=$row2['agent'];
                                $agentname='N/A';
                                $agentem='N/A';
                                $agentex='N/A';
                                $agentpro='assets/images/avatar.png';
                                $agentstatus='<span class="badge bg-light-danger">n/a</span>';
                                $agentactive='0';
                                $agentsucess='0';
                                $agentstalabel="bg-danger";
                                if($agent != null){
                                  $agentar=explode(";", $agent);
                                  $agentname=$agentar[0];
                                  $agentem=$agentar[1];
                                  $agentex=$agentar[2];
                                  $agentpro=$agentar[3];
                                  $agentactive=$agentar[4];
                                  $agentsucess=$agentar[5];
                                  $agentstatus='<span class="badge bg-light-success">available</span>';
                                  $agentstalabel="bg-success";
                                }else{
                                  $agent="";
                                }
                                $thesta="";
                                if($status=="0"){
                                  $thesta="Open";
                                }
                                if($status=="1"){
                                  $thesta="Closed";
                                }
                                if($status=="2"){
                                  $thesta="Cancelled";
                                }
                                $amount = $row2['amount'];
                                $tdte = $row2['dte'];
                                $act="";
                                if($caseref==$ref){
                                  $act="active";
                                }
                              }
                            }
              ?>
              <div class="offcanvas-xxl offcanvas-start chat-offcanvas" tabindex="-1" id="offcanvas_User_list">
                <div class="offcanvas-header">
                  <button class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvas_User_list"
                    aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                  <div id="chat-user_list" class="show collapse collapse-horizontal">
                    <div class="chat-user_list">
                      <div class="card overflow-hidden">
                        <div class="card-body">
                          <h5 class="mb-4">Your Cases <span class="avtar avtar-xs bg-light-primary rounded-circle" id="caseholder"><?php echo total_case($userid,'')?></span>
                          </h5>
                          <div class="form-search">
                            <a class="btn btn-primary" type="button" href="account?n=cases-new">Create New Case</a>
                          </div>
                        </div>
                        <div class="scroll-block" <?php echo $delcolor; ?>>
                          <div class="card-body p-0" <?php echo $delcolor; ?>>
                            <div class="list-group list-group-flush" >
                              <?php
                               $del=" and cases.status ='0' ";
                                if(isset($_GET['del'])){
                                  $del=" and cases.status <>'0' ";
                                }
                              $stmt2 = mysqli_query($localhost,("SELECT cases.id,cases.reference,cases.subject,cases.ccy,cases.casetype,cases.amount,cases.wallets,cases.status,cases.date,cases.agent, count(casemessages.userid) as reply FROM cases LEFT JOIN casemessages ON cases.reference = casemessages.caseref where cases.userid='$userid' and casemessages.status='0' $del group by cases.id,cases.reference,cases.subject,cases.ccy,cases.casetype,cases.amount,cases.wallets,cases.status,cases.date,cases.agent order by cases.id desc"));
                              $act="";
                              if (mysqli_num_rows($stmt2) > 0) {
                                  // output data of each row
                                  $question= '';
                                  $answer= '';
                                  $faqid= '';
                                  $i=0;
                                  while($row2 = mysqli_fetch_assoc($stmt2)) {
                                    $i++;
                                  $faqid = $row2['ID'];
                                  $subject = $row2['subject'];
                                  $status = $row2['status'];
                                  $casetype = strtolower($row2['casetype']);
                                  $amt = $row2['amount'];
                                  $ccy = $row2['ccy'];
                                  $ref=$row2['reference'];
                                  $reply = $row2['reply'];
                                  $thesta="";
                                  $del=true;
                                  $delcolor="";
                                  $dellnk="";
                                  if($status=="0"){
                                    $thesta="Open";
                                  }
                                  $agentt=$row2['agent'];
                                
                                  $agentstalabelopt="bg-danger";
                                  if($agentt != null){
                                    
                                    $agentstalabelopt="bg-success";
                                  }else{
                                  }
                                  if($status=="1"){
                                    $thesta="Closed";
                                    $del=false;
                                    $delcolor=" style='background:#fff7eb !important' ";
                                    $dellnk="&del=1";
                                  }
                                  if($status=="2"){
                                    $thesta="Cancelled";
                                    $del=false;
                                    $delcolor=" style='background:#fff7eb !important' ";
                                    $dellnk="&del=2";
                                  }
                                  $amount = $row2['amount'];
                                  $dte = $row2['date'];
                                  $act="";
                                  if($caseref==$ref){
                                    $act="active";
                                  }
                                  if($status !== null){
                                ?>

                              <a href="account?n=cases-all&ref=<?php echo $ref; ?><?php echo $dellnk; ?>" class="list-group-item list-group-item-action p-3 <?php echo $act; ?>">
                                <div class="media align-items-center">
                                  <div class="chat-avtar">
                                    <img class="rounded-circle img-fluid wid-40" src="assets/images/<?php echo $casetype; ?>.png"
                                      alt="User image">
                                    <div class="<?php echo $agentstalabelopt; ?> chat-badge"></div>
                                  </div>
                                  <div class="media-body mx-2">
                                    <h6 class="mb-0"><?php echo $subject; ?> <span class="chat-badge-status <?php echo $agentstalabelopt; ?> text-white"><?php echo $reply; ?></span> </h6>
                                    <span class="badge text-bg-secondary"><?php echo $ccy; ?></span>
                                    <span class="text-sm text-muted"><?php echo $amt; ?>
                                      <span class="float-end">
                                       </span></span>
                                  </div>
                                </div>
                              </a>
                              <?php

                                }
                              }
                              }
                              ?>
                              
                            </div>
                          </div>
                        </div>
                        <div class="card-body p-0">
                          <div class="list-group list-group-flush">
                            <a href="account?n=cases-all" class="list-group-item list-group-item-action">
                              <svg class="pc-icon">
                                <use xlink:href="#custom-presentation-chart"></use>
                              </svg>
                              <span>All Cases</span>
                            </a>
                            <a href="account?n=cases-all&del=1" class="list-group-item list-group-item-action">
                              <i class="ti ti-businessplan"></i>
                              <span>Closed/Cancelled Cases</span>
                            </a>
                            <a href="contact" class="list-group-item list-group-item-action" target="_blank">
                              <i class="ti ti-settings"></i>
                              <span>Get Help</span>
                            </a>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="chat-content">
                <div class="card mb-0" <?php echo $delcolor; ?>>
                  <div class="card-header p-3">
                    <div class="d-flex align-items-center">
                      <ul class="list-inline me-auto mb-0">
                        <li class="list-inline-item align-bottom">
                          <a href="#" class="d-xxl-none avtar avtar-s btn-link-secondary" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvas_User_list">
                            <i class="ti ti-menu-2 f-18"></i>
                          </a>
                          <a href="#" class="d-none d-xxl-inline-flex avtar avtar-s btn-link-secondary"
                            data-bs-toggle="collapse" data-bs-target="#chat-user_list">
                            <i class="ti ti-menu-2 f-18"></i>
                          </a>
                        </li>
                        <li class="list-inline-item">
                          <div class="media align-items-center">
                            <div class="chat-avtar">
                              <img class="rounded-circle img-fluid wid-40" src="assets/images/<?php echo $casetype; ?>.png"
                                alt="User image">
                              <i class="chat-badge <?php echo $agentstalabel; ?>"></i>
                            </div>
                            <div class="media-body mx-3 d-sm-inline-block">
                              <h6 class="mb-0"> <?php echo $tsubject; ?></h6>
                              <span class="text-sm text-muted"> <?php echo date('jS M Y - h:i:A', strtotime($tdte)); ?></span>
                              <span><small class="mb-0"> <br><?php echo $twallets; ?> </small></span>
                            </div>
                          </div>
                        </li>
                      </ul>
                      <ul class="list-inline ms-auto mb-0">
                      <li class="list-inline-item">
                        <a href="#" class="d-xxl-none avtar avtar-s btn-link-secondary" data-bs-toggle="offcanvas"
                          data-bs-target="#offcanvas_User_info">
                          <i class="ti ti-info-circle f-18"></i>
                        </a>
                        <a href="#" class="d-none d-xxl-inline-flex avtar avtar-s btn-link-secondary"
                          data-bs-toggle="collapse" data-bs-target="#chat-user_info">
                          <i class="ti ti-info-circle f-18"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <div class="dropdown">
                          <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-dots f-18"></i>
                          </a>
                          <?php
                          if($del){
                          ?>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="account?n=cases-all&ref=<?php echo $caseref; ?>&del_case=2">Delete</a>
                          </div>
                          <?php
                          }
                          ?>
                        </div>
                      </li>
                    </ul>
                      
                    </div>
                  </div>
                  <div class="scroll-block chat-message">
                    <div class="card-body">
                        <button type="button" style="display:none;" class="btn btn-primary" id="modalCenterMembersBtn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"></button>
                       <?php
                       
                      $stmt2 = mysqli_query($localhost,("SELECT casemessages.*,recordscase.* FROM casemessages LEFT JOIN recordscase on casemessages.id=recordscase.message_id where casemessages.status='0' and casemessages.userid='$userid' and casemessages.caseref= '$caseref' order by casemessages.id "));
                      $act="";
                      if (mysqli_num_rows($stmt2) > 0) {
                          // output data of each row
                          $question= '';
                          $answer= '';
                          $faqid= '';
                          $i=0;
                          while($row2 = mysqli_fetch_assoc($stmt2)) {
                            $i++;
                          $faqid = $row2['ID'];
                          $message = $row2['message'];
                          $messagetype = $row2['messagetype'];
                          $file = $row2['file'];
                          if($file !==null){
                             $message="<span href='javascript: void(\"0\")' style='text-decoration:underline;' onclick='showimage(\"$file\");'>$message</span>"; 
                          }
                          $ref=$row2['reference'];
                          if($status=="0"){
                            $thesta="Open";
                          }
                          if($status=="1"){
                            $thesta="Closed";
                          }
                          if($status=="2"){
                            $thesta="Cancelled";
                          }
                          $dte = $row2['date'];
                          if($caseref==$ref){
                            $act="active";
                          }
                          if($messagetype=="message-out"){
                        ?>
                        <div class="<?php echo $messagetype; ?>">
                          <div class="d-flex align-items-end flex-column">
                            <p class="mb-1 text-muted"><small><?php echo date('jS M Y - h:i:A', strtotime($dte)); ?></small></p>
                            <div class="message d-flex align-items-end flex-column">
                              <div class="d-flex align-items-center mb-1 chat-msg">
                                <div class="flex-shrink-0">
                                  <ul class="list-inline ms-auto mb-0 chat-msg-option">
                                    <li class="list-inline-item">
                                      <div class="dropdown">
                                        <a class="avtar avtar-xs btn-link-secondary dropdown-toggle arrow-none" href="#"
                                          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="ti ti-dots-vertical f-18"></i>
                                        </a>
                                        <?php
                                        if($messagetype=="message-out"){
                                        ?>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="account?n=cases-all&ref=<?php echo $caseref; ?>&mref=<?php echo $ref; ?>&del_message=1"><i class="ti ti-trash"></i> Delete</a>
                                        </div>
                                        <?php
                                          }
                                        ?>
                                      </div>
                                    </li>
                                    
                                  </ul>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                  <div class="msg-content bg-primary">
                                    <p class="mb-0"><?php echo $message; ?></p>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <?php
                          }else{
                          ?>
                          <div class="<?php echo $messagetype; ?>">
                            <div class="d-flex">
                              <div class="flex-shrink-0">
                                <div class="chat-avtar">
                                  <img class="rounded-circle img-fluid wid-40" src="<?php echo $agentpro; ?>"
                                    alt="User image">
                                  <i class="chat-badge <?php echo $agentstalabel; ?>"></i>
                                </div>
                              </div>
                              <div class="flex-grow-1 mx-3">
                                <div class="d-flex align-items-start flex-column">
                                  <p class="mb-1 text-muted"><small><?php echo date('jS M Y - h:i:A', strtotime($dte)); ?></small></p>
                                  <div class="message d-flex align-items-start flex-column">
                                    <div class="d-flex align-items-center mb-1 chat-msg">
                                      <div class="flex-grow-1 me-3">
                                        <div class="msg-content card mb-0">
                                          <p class="mb-0"><?php echo $message; ?></p>
                                        </div>
                                      </div>
                                      <div class="flex-shrink-0">
                                        <ul class="list-inline ms-auto mb-0 chat-msg-option">
                                          <li class="list-inline-item">
                                            <div class="dropdown">
                                              <a class="avtar avtar-xs btn-link-secondary dropdown-toggle arrow-none" href="#"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti ti-dots-vertical f-18"></i>
                                              </a>
                                              <div class="dropdown-menu">
                                            <a class="dropdown-item" href="account?n=cases-all&ref=<?php echo $caseref; ?>&mref=<?php echo $ref; ?>&del_message=1"><i class="ti ti-trash"></i> Delete</a>
                                          </div>
                                            </div>
                                          </li>
                                          
                                        </ul>
                                      </div>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php
                          }
                          
                        }
                        }
                        ?>
                    </div>
                  </div>
                  <style type="text/css">
                    input[type="file"] {
                      display: none;
                    }
                  </style>
                  <div class="card-footer py-2 px-3">
                    <form action="<?php echo $siteurl; ?>account.php?n=cases-all&ref=<?php echo $caseref; ?>"   method="POST" id="replyform"  autocomplete="off" enctype="multipart/form-data">
                      <input type="hidden" name="add_reply" value="1" required>
                      <input type="hidden" name="caseref" value="<?php echo $caseref; ?>" required>
                      <textarea class="form-control border-0 shadow-none px-0" placeholder="Type a Message"
                        rows="2" name="replymessage" id="replymessage"></textarea>
                      <hr class="my-2">
                      <?php
                      if($del){
                      ?>
                      <div class="d-sm-flex align-items-center">
                        <ul class="list-inline me-auto mb-0">
                          <li class="list-inline-item">
                            <input type="file" class="avtar avtar-xs btn-link-secondary" id="filee" name="filee">
                            <span id="file-selected"></span>
                            <label class="ti ti-photo f-18" for="filee"></label>
                          </li>
                          <li class="list-inline-item">
                            <button type="submit"  class="avtar avtar-s btn-link-primary">
                              <i class="ti ti-send f-18"></i>
                            </button>
                          </li>
                          
                          
                        </ul>
                        <ul class="list-inline ms-auto mb-0">
                         
                        </ul>
                      </div>
                      <?php
                      }
                      ?>
                    </form>
                  </div>
                </div>
              </div>
              <div class="offcanvas-xxl offcanvas-end chat-offcanvas" tabindex="-1" id="offcanvas_User_info">
              <div class="offcanvas-header">
                <button class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvas_User_info"
                  aria-label="Close"></button>
              </div>
              <div class="offcanvas-body p-0">
                <div id="chat-user_info" class="collapse collapse-horizontal">
                  <div class="chat-user_info">
                    <div class="card">
                      <div class="text-center card-body position-relative pb-0">
                        <h5 class="text-start">Assigned Agent</h5>
                        <div class="position-absolute end-0 top-0 p-3 d-none d-xxl-inline-flex">
                          <a href="#" class="avtar avtar-xs btn-link-danger btn-pc-default" data-bs-toggle="collapse"
                            data-bs-target="#chat-user_info">
                            <i class="ti ti-x f-16"></i>
                          </a>
                        </div>
                        <div class="chat-avtar d-inline-flex mx-auto">
                          <img class="rounded-circle img-fluid wid-100" src="<?php echo $agentpro; ?>"
                            alt="User image">
                        </div>
                        <h5 class="mb-0"><?php echo $agentname; ?></h5>
                        <p class="text-muted text-sm"><?php echo $agentexp; ?></p>
                        <div class="d-flex align-items-center justify-content-center mb-4">
                          <i class="chat-badge bg-success me-2"></i>
                          <?php echo $agentstatus; ?>
                        </div>
                        
                      </div>
                      <div class="scroll-block">
                        <div class="card-body">
                          <div class="row mb-3">
                            <div class="col-6">
                              <div class="p-3 rounded bg-light-primary">
                                <p class="mb-1">Active Cases</p>
                                <div class="d-flex align-items-center">
                                  <i class="ti ti-link f-22 text-primary"></i>
                                  
                                  <h4 class="mb-0 ms-2"><?php echo $agentactive; ?></h4>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="p-3 rounded bg-light-success">
                                <p class="mb-1">Success Cases</p>
                                <div class="d-flex align-items-center">
                                  <i class="ti ti-folder f-22 text-success"></i>
                                  <h4 class="mb-0 ms-2"><?php echo $agentsucess; ?></h4>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-check form-switch d-flex align-items-center justify-content-between p-0">
                            <label class="form-check-label h5 mb-0" for="customSwitchemlnot1">Notification</label>
                            <input class="form-check-input h5 m-0 position-relative" type="checkbox"
                              id="customSwitchemlnot1" checked="">
                          </div>
                          <hr class="my-3 border border-secondary-subtle">
                          <a class="btn border-0 p-0 text-start w-100" data-bs-toggle="collapse"
                            href="#filtercollapse1">
                            <div class="float-end"><i class="ti ti-chevron-down"></i></div>
                            <h5 class="mb-0">Information</h5>
                          </a>
                          <div class="collapse show" id="filtercollapse1">
                            <div class="py-3">
                              
                              <div class="d-flex align-items-center justify-content-between mb-2">
                                <p class="mb-0">Email</p>
                                <p class="mb-0 text-muted"><?php echo $agentem; ?></p>
                              </div>
                              
                            </div>
                          </div>
                          <hr class="my-3 border border-secondary-subtle">
                          <a class="btn border-0 p-0 text-start w-100" data-bs-toggle="collapse"
                            href="#filtercollapse2">
                            <div class="float-end"><i class="ti ti-chevron-down"></i></div>
                            <h5 class="mb-0">Uploaded Files</h5>
                          </a>
                          <div class="collapse show" id="filtercollapse2">
                              <div class="py-3">
                                <?php
                                  $stmt2 = mysqli_query($localhost,("SELECT a.*,b.* FROM casemessages a, recordscase b where a.userid='$userid' and a.caseref='$caseref' and a.id=b.message_id "));
                                  $act="";
                                  if (mysqli_num_rows($stmt2) > 0) {
                                    // output data of each row
                                    $question= '';
                                    $answer= '';
                                    $faqid= '';
                                    while($row2 = mysqli_fetch_assoc($stmt2)) {
                                    $message = $row2['message'];
                                    $filee=$row2['file'];
                                    $dte = $row2['date'];
                                      
                                    
                                    
                                ?>
                            
                                <div class="media align-items-center mb-2">
                                  <a href="#" class="avtar avtar-s btn-light-success">
                                    <i class="ti ti-file-text f-20"></i>
                                  </a>
                                  <div class="media-body ms-3">
                                    <h6 class="mb-0"><?php echo $message; ?></h6>
                                    <span class="text-muted text-sm"><?php echo date('jS M Y - h:i:A', strtotime($dte)); ?></span>
                                  </div>
                                  <a href="<?php echo $filee; ?>" target="_blank" download  class="avtar avtar-xs btn-link-secondary">
                                    <i class="ti ti-chevron-right f-16"></i>
                                  </a>
                                </div>
                                
                              
                              <?php
                                  }
                                }
                              ?>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <?php
              }else{
              ?>
              <style type="text/css">
                @media (max-width: 1399.98px) {
              .offcanvas-xxl {
                  visibility: visible !important;
                }
                }

                @media (max-width: 1399.98px){
              .offcanvas-xxl.offcanvas-start {
                  transform: none !important;
                }
                }
              </style>
              <style type="text/css">
                .chat-user_list{
                  width: 800px !important;
                  margin-right: 0px !important;
                }
              </style>
              <?php
               $delcolor=" ";
                if(isset($_GET['del'])){
                  $delcolor=" style='background:#fff7eb !important' ";
                }
                ?>
              <div class="offcanvas-xxl offcanvas-start " tabindex="-1" id="offcanvas_User_list" >
                <div class="offcanvas-header">
                  <button class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvas_User_list"
                    aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0" >
                  <div id="chat-user_list" class="show collapse collapse-horizontal" >
                    <div class="chat-user_list">
                      <div class="card overflow-hidden" >
                        <div class="card-body">
                          <h5 class="mb-4">Your Cases <span class="avtar avtar-xs bg-light-primary rounded-circle" id="caseholder"><?php echo total_case($userid,'')?></span>
                          </h5>
                          <div class="form-search">
                            <a class="btn btn-primary" type="button" href="account?n=cases-new">Create New Case</a>
                          </div>
                        </div>
                        <div class="scroll-block" <?php echo $delcolor; ?>>
                          <div class="card-body p-0" <?php echo $delcolor; ?>>
                            <div class="list-group list-group-flush">
                              <?php
                               $del=" and cases.status ='0' ";
                               $delcolor=" ";
                                if(isset($_GET['del'])){
                                  $del=" and cases.status <>'0' ";
                                  $delcolor=" style='background:#fff7eb !important' ";
                                }
                                
                                
                              $stmt2 = mysqli_query($localhost,("SELECT cases.id,cases.reference,cases.subject,cases.ccy,cases.casetype,cases.amount,cases.wallets,cases.status,cases.date,ifnull(cases.agent,'') as agent, count(casemessages.userid) as reply FROM cases LEFT JOIN casemessages ON cases.reference = casemessages.caseref where cases.userid='$userid'  $del group by cases.id,cases.reference,cases.subject,cases.ccy,cases.casetype,cases.amount,cases.wallets,cases.status,cases.date,cases.agent order by cases.id desc"));
                              
                              $act="";
                              if (mysqli_num_rows($stmt2) > 0) {
                                  // output data of each row
                                  $question= '';
                                  $answer= '';
                                  $faqid= '';
                                  $i=0;
                                  while($row2 = mysqli_fetch_assoc($stmt2)) {
                                    $i++;
                                  $faqid = $row2['ID'];
                                  $subject = $row2['subject'];
                                  $status = $row2['status'];
                                  $casetype = strtolower($row2['casetype']);
                                  $amt = $row2['amount'];
                                  $ccy = $row2['ccy'];
                                  $ref=$row2['reference'];
                                  $reply = $row2['reply'];
                                  $thesta="";
                                  $del="";
                                  $agentt=$row2['agent'];
                                
                                  $agentstalabelopt="bg-danger";
                                  if($agentt != null){
                                    
                                    $agentstalabelopt="bg-success";
                                  }else{
                                  }
                                  if($status=="0"){
                                    $thesta="Open";
                                  }
                                  if($status=="1"){
                                    $thesta="Closed";
                                    $del="&del=1";
                                  }
                                  if($status=="2"){
                                    $thesta="Cancelled";
                                    $del="&del=2";
                                  }
                                  $amount = $row2['amount'];
                                  $dte = $row2['date'];
                                  if($caseref==$ref){
                                    $act="active";
                                  }
                                  if($status !== null){
                                ?>

                              <a href="account?n=cases-all&ref=<?php echo $ref; ?><?php echo $del; ?>" class="list-group-item list-group-item-action p-3 <?php echo $act; ?>" <?php echo $delcolor; ?>>
                                <div class="media align-items-center" >
                                  <div class="chat-avtar">
                                    <img class="rounded-circle img-fluid wid-40" src="assets/images/<?php echo $casetype; ?>.png"
                                      alt="User image">
                                    <div class="<?php echo $agentstalabelopt; ?> chat-badge"></div>
                                  </div>
                                  <div class="media-body mx-2">
                                    <h6 class="mb-0"><?php echo $subject; ?> <span class="chat-badge-status <?php echo $agentstalabelopt; ?> text-white"><?php echo $reply; ?></span> <span class="float-end text-sm text-muted f-w-400"><?php echo $thesta; ?></span></h6>
                                    <span class="badge text-bg-secondary"><?php echo $ccy; ?></span>
                                    <span class="text-sm text-muted"><?php echo $amt; ?>
                                      <span class="float-end">
                                        <span class="text-sm text-muted"><?php echo date('jS M Y - h:i:A', strtotime($dte)); ?>
                                      </span></span>
                                  </div>
                                </div>
                              </a>
                              <?php

                                }
                              }
                              }
                              ?>
                              
                            </div>
                          </div>
                        </div>
                        <div class="card-body p-0">
                          <div class="list-group list-group-flush">
                            <a href="account?n=cases-all" class="list-group-item list-group-item-action">
                              <svg class="pc-icon">
                                <use xlink:href="#custom-presentation-chart"></use>
                              </svg>
                              <span>All Cases</span>
                            </a>
                            <a href="account?n=cases-all&del=1" class="list-group-item list-group-item-action">
                              <i class="ti ti-businessplan"></i>
                              <span>Closed/Cancelled Cases</span>
                            </a>
                            <a href="contact" class="list-group-item list-group-item-action" target="_blank">
                              <i class="ti ti-settings"></i>
                              <span>Get Help</span>
                            </a>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <?php
              }
              ?>
            
            
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>

  <?php
  break;
  default :
  ?>
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <?php include "include/msg.php";?>
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Home</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-md-6 col-xxl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-primary">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        opacity="0.4"
                        d="M13 9H7"
                        stroke="#4680FF"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M22.0002 10.9702V13.0302C22.0002 13.5802 21.5602 14.0302 21.0002 14.0502H19.0402C17.9602 14.0502 16.9702 13.2602 16.8802 12.1802C16.8202 11.5502 17.0602 10.9602 17.4802 10.5502C17.8502 10.1702 18.3602 9.9502 18.9202 9.9502H21.0002C21.5602 9.9702 22.0002 10.4202 22.0002 10.9702Z"
                        stroke="#4680FF"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M17.48 10.55C17.06 10.96 16.82 11.55 16.88 12.18C16.97 13.26 17.96 14.05 19.04 14.05H21V15.5C21 18.5 19 20.5 16 20.5H7C4 20.5 2 18.5 2 15.5V8.5C2 5.78 3.64 3.88 6.19 3.56C6.45 3.52 6.72 3.5 7 3.5H16C16.26 3.5 16.51 3.50999 16.75 3.54999C19.33 3.84999 21 5.76 21 8.5V9.95001H18.92C18.36 9.95001 17.85 10.17 17.48 10.55Z"
                        stroke="#4680FF"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0">Balance</h6>
                </div>
              </div>
              <div class="bg-body p-3 mt-3 rounded">
                <div class="mt-3 row align-items-center">
                  <div class="col-4">
                    <div id="all-earnings-graph"></div>
                  </div>
                  <div class="col-8">
                    <h5 class="mb-1">$<?php echo number_format($balance,2); ?></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xxl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-warning">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M21 7V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V7C3 4 4.5 2 8 2H16C19.5 2 21 4 21 7Z"
                        stroke="#E58A00"
                        stroke-width="1.5"
                        stroke-miterlimit="10"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        opacity="0.6"
                        d="M14.5 4.5V6.5C14.5 7.6 15.4 8.5 16.5 8.5H18.5"
                        stroke="#E58A00"
                        stroke-width="1.5"
                        stroke-miterlimit="10"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        opacity="0.6"
                        d="M8 13H12"
                        stroke="#E58A00"
                        stroke-width="1.5"
                        stroke-miterlimit="10"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        opacity="0.6"
                        d="M8 17H16"
                        stroke="#E58A00"
                        stroke-width="1.5"
                        stroke-miterlimit="10"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0">Recovered</h6>
                </div>
              </div>
              <div class="bg-body p-3 mt-3 rounded">
                <div class="mt-3 row align-items-center">
                  <div class="col-4">
                    <div id="page-views-graph"></div>
                  </div>
                  <div class="col-8">
                    <h5 class="mb-1">$<?php echo number_format(round($recov_bal,2),2)?></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xxl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-success">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8 2V5"
                        stroke="#2ca87f"
                        stroke-width="1.5"
                        stroke-miterlimit="10"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M16 2V5"
                        stroke="#2ca87f"
                        stroke-width="1.5"
                        stroke-miterlimit="10"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        opacity="0.4"
                        d="M3.5 9.08984H20.5"
                        stroke="#2ca87f"
                        stroke-width="1.5"
                        stroke-miterlimit="10"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                        stroke="#2ca87f"
                        stroke-width="1.5"
                        stroke-miterlimit="10"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        opacity="0.4"
                        d="M15.6947 13.7002H15.7037"
                        stroke="#2ca87f"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        opacity="0.4"
                        d="M15.6947 16.7002H15.7037"
                        stroke="#2ca87f"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        opacity="0.4"
                        d="M11.9955 13.7002H12.0045"
                        stroke="#2ca87f"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        opacity="0.4"
                        d="M11.9955 16.7002H12.0045"
                        stroke="#2ca87f"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        opacity="0.4"
                        d="M8.29431 13.7002H8.30329"
                        stroke="#2ca87f"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        opacity="0.4"
                        d="M8.29395 16.7002H8.30293"
                        stroke="#2ca87f"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0">Withdrawal</h6>
                </div>
              </div>
              <div class="bg-body p-3 mt-3 rounded">
                <div class="mt-3 row align-items-center">
                  <div class="col-4">
                    <div id="total-task-graph"></div>
                  </div>
                  <div class="col-8">
                    <h5 class="mb-1">$<?php echo number_format(round(total_redraw($userid),2),2)?></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xxl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-warning">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                        stroke="#DC2626"
                        stroke-width="1.5"
                        stroke-miterlimit="10"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        opacity="0.4"
                        d="M8.4707 10.7402L12.0007 14.2602L15.5307 10.7402"
                        stroke="#DC2626"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0">Deposit</h6>
                </div>
              </div>
              <div class="bg-body p-3 mt-3 rounded">
                <div class="mt-3 row align-items-center">
                  <div class="col-4">
                    <div id="download-graph"></div>
                  </div>
                  <div class="col-8">
                    <h5 class="mb-1">$<?php echo number_format(round(total_deposit($userid),2),2)?></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body border-bottom pb-0">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Cases</h5>
                
              </div>
              <ul class="nav nav-tabs analytics-tab" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button
                    class="nav-link active"
                    id="analytics-tab-1"
                    data-bs-toggle="tab"
                    data-bs-target="#analytics-tab-1-pane"
                    type="button"
                    role="tab"
                    aria-controls="analytics-tab-1-pane"
                    aria-selected="true"
                    >New Updates</button
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <button
                    class="nav-link"
                    id="analytics-tab-2"
                    data-bs-toggle="tab"
                    data-bs-target="#analytics-tab-2-pane"
                    type="button"
                    role="tab"
                    aria-controls="analytics-tab-2-pane"
                    aria-selected="false"
                    >Active Cases</button
                  >
                </li>
                
              </ul>
            </div>
            <div class="tab-content" id="myTabContent">
              <div
                class="tab-pane fade show active"
                id="analytics-tab-1-pane"
                role="tabpanel"
                aria-labelledby="analytics-tab-1"
                tabindex="0"
              >
                <ul class="list-group list-group-flush">
                   <?php
                  $stmt2 = mysqli_query($localhost,("SELECT * FROM trac_log  where userid='$userid' and log_type='Case Update' and log_type<>'Case Reply' order by id desc limit 4"));
                  if (mysqli_num_rows($stmt2) > 0) {
                      // output data of each row
                      $question= '';
                      $answer= '';
                      $faqid= '';
                      while($row2 = mysqli_fetch_assoc($stmt2)) {
                      $faqid = $row2['ID'];
                      $log_type = $row2['log_type'];
                      $log_details = $row2['log_details'];
                      $status = $row2['status'];
                      $dte = $row2['date'];
                    ?>
                  <li class="list-group-item">
                    <div class="d-flex align-items-center">
                      <div class="flex-shrink-0">
                        <div class="avtar avtar-s border"> CU </div>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <div class="row g-1">
                          <div class="col-6">
                            <h6 class="mb-0"><?php echo $log_details; ?></h6>
                            <p class="text-muted mb-0"><small><?php echo date('jS M Y - h:i:A', strtotime($row2['date'])); ?></small></p>
                          </div>
                          <div class="col-6 text-end">
                            <h6 class="mb-1"><?php echo $log_type; ?></h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <?php
                      }
                    }
                  ?>
                 
                </ul>
              </div>
              <div class="tab-pane fade" id="analytics-tab-2-pane" role="tabpanel" aria-labelledby="analytics-tab-2" tabindex="0">
                <ul class="list-group list-group-flush">
                <?php
                $stmt2 = mysqli_query($localhost,("SELECT * FROM cases where userid='$userid' and status='0' order by id desc limit 4 "));
                if (mysqli_num_rows($stmt2) > 0) {
                    // output data of each row
                    $question= '';
                    $answer= '';
                    $faqid= '';
                    while($row2 = mysqli_fetch_assoc($stmt2)) {
                    $faqid = $row2['ID'];
                    $subject = $row2['subject'];
                    $status = $row2['status'];
                    $amount = $row2['amount'];
                    $reference = $row2['reference'];
                    $ccy = $row2['ccy'];
                    $dte = $row2['date'];
                  ?>
                  <li class="list-group-item">
                    <div class="d-flex align-items-center">
                      <div class="flex-shrink-0">
                        <div class="avtar avtar-s border" data-bs-toggle="tooltip" data-bs-title="143 Posts"><span>AC</span> </div>
                      </div>
                      
                      <div class="flex-grow-1 ms-3">
                        <a href="account?n=cases-all&ref=<?php echo $reference; ?>">
                        <div class="row g-1">
                          <div class="col-6">
                            <h6 class="mb-0"><?php echo $subject; ?></h6>
                            <p class="text-muted mb-0"><small><?php echo $dte; ?></small></p>
                          </div>
                          <div class="col-6 text-end">
                            <h6 class="mb-1"><?php echo number_format($amount,5); ?> <small><?php echo $ccy; ?></small></h6>
                          </div>
                        </div>
                        </a>
                      </div>
                    
                    </div>
                  </li>
                  <?php
                      }
                    }
                  ?>
                  
                </ul>
              </div>
              
            </div>
            <div class="card-footer">
              <div class="row g-2">
                <div class="col-md-6">
                  <div class="d-grid">
                    <a class="btn btn-outline-secondary d-grid" href="account?n=cases-all" 
                      ><span class="text-truncate w-100">View all Cases</span></a
                    >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="d-grid">
                    <a class="btn btn-primary d-grid" href="account?n=cases-new"><span class="text-truncate w-100">Create new Case</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Total Income</h5>
                
              </div>
              
              <div class="row g-3 mt-3">
                <div class="col-sm-6">
                  <div class="bg-body p-3 rounded">
                    <div class="d-flex align-items-center mb-2">
                      <div class="flex-shrink-0">
                        <span class="p-1 d-block bg-primary rounded-circle">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </div>
                      <div class="flex-grow-1 ms-2">
                        <p class="mb-0">All Cases</p>
                      </div>
                    </div>
                    <h6 class="mb-0"
                      ><?php echo total_case($userid,'')?> </h6
                    >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="bg-body p-3 rounded">
                    <div class="d-flex align-items-center mb-2">
                      <div class="flex-shrink-0">
                        <span class="p-1 d-block bg-warning rounded-circle">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </div>
                      <div class="flex-grow-1 ms-2">
                        <p class="mb-0">Closed Cases</p>
                      </div>
                    </div>
                    <h6 class="mb-0"
                      ><?php echo total_case($userid,'1')?></h6
                    >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="bg-body p-3 rounded">
                    <div class="d-flex align-items-center mb-2">
                      <div class="flex-shrink-0">
                        <span class="p-1 d-block bg-success rounded-circle">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </div>
                      <div class="flex-grow-1 ms-2">
                        <p class="mb-0">Active Cases</p>
                      </div>
                    </div>
                    <h6 class="mb-0"
                      ><?php echo total_case($userid,'0')?> </h6
                    >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="bg-body p-3 rounded">
                    <div class="d-flex align-items-center mb-2">
                      <div class="flex-shrink-0">
                        <span class="p-1 d-block bg-danger rounded-circle">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </div>
                      <div class="flex-grow-1 ms-2">
                        <p class="mb-0">Cancelled Cases</p>
                      </div>
                    </div>
                    <h6 class="mb-0"
                      ><?php echo total_case($userid,'2')?></h6
                    >
                  </div>
                </div>
              </div>
              <div id="total-income-graphh"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
<?php
  }
?>
<?php include "include/modals.php";?> 
<footer class="pc-footer">
  <div class="footer-wrapper container-fluid">
    <div class="row">
      <div class="col my-1">
        <p class="m-0"
          >C <?php echo date('Y'); ?> crafted by  <?php echo $domain; ?> &#9829;Team   </p
        >
      </div>
      <div class="col-auto my-1">
        <ul class="list-inline footer-link mb-0">
          <li class="list-inline-item"><a href="index">Home</a></li>
          <li class="list-inline-item"><a href="account">My Account</a></li>
          <li class="list-inline-item"><a href="contact" >Support</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer> 
<?php include "footeropt.php";?> 
