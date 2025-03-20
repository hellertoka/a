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
if(isAdmin()){
  $u = get_user_id();

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
    $profile_url = $row['profile_url'];
    if($profile_url == 'assets/images/avatar.png') {
      $profile_url = $siteurl.$profile_url;
    }
    $u_level = $row['u_level'];
    if($u_level == 1){
      $adm = 'Global Admin';
    } else if($u_level == 2){
      $adm = 'Local Admin';
    } else {
      header('Location:'.$siteurl.'index');
    }
  }
} else {
  header('Location:'.$siteurl.'index');
}
$site_title = 'Admin | '.$site_title;
$faqopt=" where ID in ('2','3') ";


?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_permission']) && isset($_POST['setup_permission'])){
  $level = encryptCode($_POST['user_permission']);
  $sql = "INSERT INTO site_info (id, site_name, site_title, site_desc, site_meta, date, level) VALUES
  ('$rowid', '$domain', '$site_title', '$site_desc', '$site_meta', '$now', '$level') ON DUPLICATE KEY UPDATE
  site_name = '$domain',
  site_title = '$site_title',
  site_desc = '$site_desc',
  site_meta = '$site_meta',
  level = '$level'";
  if (mysqli_query($localhost, $sql)) {
    $_SESSION['user_permission'] = $level;
    $_SESSION['success']='Login Successful';
    $_SESSION['notifys']='Login Successful';
    header('Location:'.$siteurl.'admin');
  } else {
    $_SESSION['error']='Incorrect Password';
    $_SESSION['notifye']='Incorrect Password';
  }

}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_login']) && isset($_POST['setup_login'])){
  $level = encryptCode($_POST['user_login']);
  $sql= mysqli_query($localhost,"SELECT * FROM site_info WHERE id = '$rowid' AND level = '$level' LIMIT 1");
  if (mysqli_num_rows($sql) > 0) {
    $_SESSION['user_permission'] = $level;
    $_SESSION['success']='Login Successful';
    $_SESSION['notifys']='Login Successful';
  } else {
    $_SESSION['error']='Incorrect Password';
    $_SESSION['notifye']='Incorrect Password';
  }
}
if(ulevelConfirm()){



  if(isset($_POST["replymessage"]) && isset($_POST["add_reply"]) && isset($_POST["caseref"])  ){

    $replymessage = test_input($_POST["replymessage"]);
    $caseownerid = test_input($_POST["caseownerid"]);
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
        header('Location: admin?n=cases&ref='.$caseref);
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
      $smessagetype ="message-in";
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
                    //insert_log($caseownerid, "Case Update", "Admin Replied to Case-".$caseref, "0");
                    //header('Location: admin?n=cases&ref='.$caseref);
                   //die();
                }else{
                   $_SESSION['error']="Unable to submit reply at the moment. Please try again.";
                  $_SESSION['notifye']="Unable to submit reply at the moment. Please try again.";    
                }
              }
            insert_log($caseownerid, "Case Update", "Admin Replied to Case-".$caseref, "0");
            insert_log_link($caseownerid, "Case Reply", $replymessage, $caseref);
             $_SESSION['success']="Message Sent!";
              $_SESSION['notifys']="Message Sent!";
              header('Location: admin?n=cases&ref='.$caseref);
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

  if(isset($_POST["name"]) && isset($_POST["assign_agent"]) && isset($_POST["email"])){


    $name = test_input($_POST["name"]);
    $caseref = test_input($_POST["caseref"]);
    $uid = test_input($_POST["caseownerid"]);
    $email = test_input($_POST["email"]);
    $experience = test_input($_POST["experience"]);
    $image = test_input($_POST["image"]);
    $active = test_input($_POST["active"]);
    $success = test_input($_POST["success"]);

    $sql="update cases set agent='$name;$email;$experience;$image;$active;$success' WHERE reference='$caseref'";
    if (mysqli_query($localhost, $sql)) {
      $msg="Agent $name assigned to Case Successfully.";
      $_SESSION['success']='Admin assigned Successfully.';
      $_SESSION['notifys']='Admin assigned Successfully.';
      if($userid!==$uid){
        $subject="Case Update";
        insert_log($uid, $subject, $msg, "0");
        $uemail=getemail($id);

        SendEmailBody($domain,$uemail,$subject,$msg);
      }
      header('Location:'.$siteurl.'admin?n=cases&ref='.$caseref);
      die();
        
    }else{
          $_SESSION['error']='Unable to assign agent';
          $_SESSION['notifye']='Unable to assign agent';
            echo "Error creating table: " . mysqli_error($localhost);
    }
    
  }

  if(isset($_GET["mref"]) && isset($_GET["del_message"]) && isset($_GET["n"])  && isset($_GET["ref"])&& isset($_GET["spid"])){
    $mref = test_input($_GET["mref"]);
    $caseref = test_input($_GET["ref"]);
    $uid = test_input($_GET["spid"]);
    $sql="update casemessages set status='1' WHERE reference='$mref'";
    if (mysqli_query($localhost, $sql)) {
      $msg="Admin Deleted Message Successfully.";
      $_SESSION['success']='Admin Deleted Message Successfully.';
      $_SESSION['notifys']='Admin Deleted Message Successfully.';
      if($userid!==$uid){
        insert_log($uid, "Case Update", $msg, "0");
      }
      header('Location:'.$siteurl.'admin?n=cases&ref='.$caseref);
      die();
        
    }else{
          $_SESSION['error']='Unable to delete message';
          $_SESSION['notifye']='Unable to delete message';
            echo "Error creating table: " . mysqli_error($localhost);
    }
    
  }

  if( isset($_GET["del_case"]) && isset($_GET["n"])  && isset($_GET["ref"])&& isset($_GET["spid"])){
    $del_case = test_input($_GET["del_case"]);
    $caseref = test_input($_GET["ref"]);
    $uid = test_input($_GET["spid"]);
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
        $msg="Admin $thesta Case Successfully.";
        $_SESSION['success']="Admin $thesta Case Successfully.";
        $_SESSION['notifys']="Admin $thesta Case Successfully.";
        insert_log($uid, "Case Update", $msg, "0");

        header('Location:'.$siteurl.'admin?n=cases');
        die();
          
      }else{
            $_SESSION['error']='Unable to update case';
            $_SESSION['notifye']='Unable to update case';
              echo "Error creating table: " . mysqli_error($localhost);
      }
      
  }

  if(isset($_POST["affliate"]) && isset($_POST["policy"]) && isset($_POST["terms"])){
    $myfile = fopen("texts/affliate.txt", "w") or die("Unable to open file!");
    $affliate = test_input($_POST["affliate"]);
    fwrite($myfile, $affliate);
    fclose($myfile);
    
    
    $myfile = fopen("texts/privacy.txt", "w") or die("Unable to open file!");
    $policy = test_input($_POST["policy"]);
    fwrite($myfile, $policy);
    fclose($myfile);
    
    $myfile = fopen("texts/terms.txt", "w") or die("Unable to open file!");
    $terms = test_input($_POST["terms"]);
    fwrite($myfile, $terms);
    fclose($myfile);
    $_SESSION['success']= "Request Processed Successfully!";
    header('Location:'.$siteurl.'admin?n=cms&alert=how_it_works&hash='.md5($terms));
    
  }

}

?>
<?php include "headeropt.php";?>

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
if(ulevelConfirm()){


  switch ($n) {
    case 'cms' :
    $myfile = fopen("texts/terms.txt", "r") or die("Unable to open file!");
    // Output one line until end-of-file
    $terms = '';
    while(!feof($myfile)) {
      $terms .= fgets($myfile) . " ";
    }
      $myfile = fopen("texts/privacy.txt", "r") or die("Unable to open file!");
    // Output one line until end-of-file
    $policy = '';
    while(!feof($myfile)) {
      $policy .= fgets($myfile) . " ";
    }
      $myfile = fopen("texts/aml.txt", "r") or die("Unable to open file!");
    // Output one line until end-of-file
    $affliate = '';
    while(!feof($myfile)) {
      $aml .= fgets($myfile) . " ";
    }
    fclose($myfile);
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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Admin</a></li>
                <li class="breadcrumb-item" aria-current="page">CMS</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">CMS</h2>
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
            <h5 class="card-header">Edit Website Content </h5>
            <div class="card-body">
              <p class="card-text">
                Typically reflects instantly.
              </p>
              
              
              <div class="container-xxl flex-grow-1 container-p-y">
              
                <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=qvy1krf91qsknvh0cfzlguij6be8je9ubu5ou20ojryt9cpp"></script>
                <script>
                  tinymce.init({
                    selector: "textarea",
                  menubar: false,
                  toolbar: "undo redo | styleselect | bold italic emoticons | bullist, numlist | alignleft aligncenter alignright alignjustify | insert code",
                  plugins : [
                        "autolink link image lists emoticons media code",
                        "imagetools"
                    ],
                  code_dialog_height: 300,
                  code_dialog_width: 250,
                  height : 200,
                  relative_urls: false,
                  remove_script_host: false,
                  browser_spellcheck: true,
                  images_upload_url: "<?php echo $siteurl; ?>include/upload_to_media.php",
                  paste_data_images: true
                  });
                </script>
                <form method="POST">
                  <div class="row">
                    <div class="col-12">
                      <div class="card mb-4">
                        <h5 class="card-header">1. Terms</h5>
                        <div class="card-body">
                          <p class="card-text">
                            Edit Terms and Conditions for <?php echo $domain; ?>
                          </p>
                          <textarea name="terms" class="form-control"><?php echo $terms; ?></textarea>
                          
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="card mb-4">
                        <h5 class="card-header">2. Privacy Policy</h5>
                        <div class="card-body">
                          <p class="card-text">
                            Edit Privacy Policy for <?php echo $domain; ?>
                          </p>
                          <textarea name="policy" class="form-control"><?php echo $policy; ?></textarea>
                          
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="card mb-4">
                        <h5 class="card-header">3. Affliate</h5>
                        <div class="card-body">
                          <p class="card-text">
                            Edit Affliate Content for <?php echo $domain; ?>
                          </p>
                          <textarea name="affliate" class="form-control"><?php echo $aml; ?></textarea>
                          
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="card mb-4">
                        
                        <div class="card-body">
                          <p class="card-text">
                           
                          </p>
                          <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                          
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <?php
  break;
  case 'user-activity' :
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
                if(isset($_GET['usid'])){
                    $usid = $_GET['usid'];
                }
                $page_num = mysqli_query($localhost,"SELECT * FROM trac_log WHERE userid = '$usid'");
                $result = mysqli_query($localhost,"SELECT * FROM trac_log WHERE userid = '$usid' ORDER BY id DESC");
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
  case 'withdrawals' :
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
                <li class="breadcrumb-item"><a href="account">Admin</a></li>
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
                $page_num = mysqli_query($localhost,"SELECT a.*,b.email,b.fname,b.lname FROM redraws a, users b WHERE a.userid=b.userid");
                $result = mysqli_query($localhost,"SELECT a.*,b.email,b.fname,b.lname FROM redraws a, users b WHERE a.userid=b.userid ORDER BY a.id DESC");
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
                    $upload = '';
                    if($row['status'] == 0){
                       if(strtolower($row['tokenstatus']) == "approved"){ 
                      $upload = '<button id="upload" class="btn btn-success btn-xs" onClick="pay('.$row['id'].','.$row['userid'].',\''.$row['fname'].'\')">Pay</button><button class="btn btn-danger btn-xs" onClick="redel('.$row['id'].','.$row['userid'].',\''.$row['fname'].'\');">Del</button>';
                       }else{
                        $upload="Pending (".$row['token'].") <button class=\"btn btn-danger btn-xs\" onClick=\"redel('".$row['id']."','".$row['userid']."','".$row['fname']."');\">Del</button>";
                       }
                    } else {
                      $upload = 'Paid';
                    }
                    $idd = $row['ID'] ;
                    $apbtn=$thesta;
                    
                  $opt="
                  <tr>
                    <td>".$idd."</td>
                    <td>$met</td>
                    <td>$ccyvalue</td>
                    <td>$address</td>
                    <td>".date('jS M Y - h:i:A', strtotime($row['date']))."</td>
                    <td>$thesta</td>
                    <td>$upload</td>
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
  case 'deposits' :
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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Admin</a></li>
                <li class="breadcrumb-item" aria-current="page">Deposits</li>
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $page_num = mysqli_query($localhost,"SELECT a.*,b.email,b.fname,b.lname,''as btcaddress,'' as ethaddress,'' as usdtaddress FROM deposits a, users b  WHERE a.userid=b.userid ");
                $result = mysqli_query($localhost,"SELECT a.*,b.email,b.fname,b.lname,'' as btcaddress,'' as ethaddress,'' as usdtaddress FROM deposits a, users b WHERE a.userid=b.userid  ORDER BY a.id DESC LIMIT $offs, $rows");
                $i = 0;
                while($row = mysqli_fetch_array($result)) {
                  $i++;
                  $send = $row['amount'] ;
                  $ccyvalue = $row['amount'] ;
                  $met = $row['method'] ;
                  $hash = $row['hash'] ;
                  $idd = $row['ID'] ;
                  $upload = ' <button class="btn btn-danger btn-xs" onClick="deldep('.$row['id'].','.$row['userid'].',\''.$row['fname'].'\')">Delete</button>';
                  if($row['status'] == 0){
                      $link="";
                      $ethad=$row['ethaddress'];
                      $btcad=$row['btcaddress'];
                      $usdtad=$row['usdtaddress'];
                      if(strtoupper($row['method'])=="ETHEREUM"){
                         $link="https://blockchair.com/ethereum/address/0x$ethad";
                      }
                      if(strtoupper($row['method'])=="BITCOIN"){
                           $link="https://blockchair.com/bitcoin/address/$btcad";
                          
                      }
                      if(strtoupper($row['method'])=="USDT"){
                           $link="https://etherscan.io/address/$usdtad";
                          
                      }
                    $upload .= '<button id="upload" class="btn btn-info btn-xs" data-alt="'.$row['id'].'" onClick="details('.$row['userid'].','.$row['id'].',\''.$row['fname'].'\')">View prove</button><button id="upload" class="btn btn-success btn-xs" onClick="approve('.$row['id'].','.$row['amount'].','.$row['userid'].',\''.$row['method'].'\',\''.$link.'\',\''.$row['fname'].'\')">Approve</button>';
                  } else {
                    $upload = 'Confirmed and Credited';
                  }
                  $opt="
                  <tr>
                    <td>$idd</td>
                    <td>$met</td>
                    <td>$ccyvalue</td>
                    <td>$conf confirmation(s)</td>
                    <td>".date('jS M Y - h:i:A', strtotime($row['date']))."</td>
                    <td>$status</td>
                    <td>$upload</td>
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
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <!-- /Account -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div><?php
  break;
  case 'members' :
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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Admin</a></li>
                <li class="breadcrumb-item" aria-current="page">Members</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0"> List</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="card mb-4">
        <h5 class="card-header">Members</h5>
        <!-- Account -->
        
        <hr class="my-0" />
        <div class="card-body">
          <div class="dt-responsive table-responsive">
            <table id="dom-table" class="table table-striped table-bordered nowrap">
              <thead>
                <tr>
                  <th></th>
                  <th>User</th>
                  <th>Email</th>
                  <th>Full Name</th>
                  <th>Country</th>
                  <th>Phone</th>
                  <th>Balance</th>
                  <th>Avail Balance</th>
                  <th>Recov Balance</th>
                  <th>Address</th>
                  <th>Gender</th>
                  <th>Reg Date</th>
                  <th>State</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $all_members = mysqli_query($localhost,"SELECT * FROM users");
                $result = mysqli_query($localhost,"SELECT * FROM users");

                $i = 0;
                while($row = mysqli_fetch_array($result)) {
                  $i++;
                  $tuserid = $row['userid'] ;
                  $fullname = $row['fname'].' '.$row['lname'] ;
                  $uemail = $row['email'] ;
                  $country = $row['country'] ;
                  $pno = $row['pno'] ;
                  $address = $row['address'] ;
                  $gender = $row['gender'] ;
                  $reg_date = $row['reg_date'] ;
                  $state = $row['state'] ;
                  $idd = $row['ID'] ;
                  if($row['state'] == 'ON'){
                    $state = 'Online';
                  }else{
                    $state = '<time class="timeago" datetime="'.$row['timestamp'].'">'.date('jS M Y', strtotime($row['timestamp'])).' by '.date('H : ia', strtotime($row['timestamp'])).'</time>';
                  }
                  $block .= '<a id="myBtn" title="Bonus" class="btn btn-primary btn-sm"  onClick="bonus(\''.$row['userid'].'\',\''.$row['fname'].'\',\''.$row['bonus_amt'].'\')">+Profit</a> ';
                  $block .= '<a id="myBtn" title="USDT" class="btn btn-info btn-sm" onClick="setusdtwallet(\''.$row['userid'].'\',\''.$row['fname'].'\',\''.$row['usdtaddress'].'\',\''.$row['usdtwallet'].'\')">+USDT Wallet</a>';


                  if($row['u_level'] != 1 && get_user_level() != $row['u_level']){
                    if($row['active'] == 0){
                      $block .= '<a id="myBtn" title="Unblock" class="btn btn-dark btn-sm"  onClick="unblockmember(\''.$row['userid'].'\',\''.$row['fname'].'\')"><i class="fa fa-unlock"> Unblock</i></a>';
                    } else {
                      $block .= '<a id="myBtn" title="Block" class="btn btn-dark btn-sm"  onClick="blockuser(\''.$row['userid'].'\',\''.$row['fname'].'\')"><i class="fa fa-lock"> Block</i></a>';
                      if(get_user_level() == 1){
                        $block .= '<a onClick="request(\''.$row['userid'].'\',\''.$row['fname'].'\')" class="btn btn-success btn-sm" >Deposit</a>';
                        if($row['u_level'] == 0){
                          $block .= '<a id="myBtn" title="Make Admin" class="btn btn-danger btn-sm"  class="btn btn-danger btn-xs"  onClick="makeadmin(\''.$row['userid'].'\',\''.$row['fname'].'\')"><i class="fa fa-plus"> Make admin</i></a>';
                        } else {
                          $block .= '<a id="myBtn" title="Remove Admin" onClick="removeadmin(\''.$row['userid'].'\',\''.$row['fname'].'\')" class="btn btn-danger btn-sm" ><i class="fa fa-minus"> Remove admin</i></a>';
                        }
                      }
                    }
                    if($row['active'] == 2 || $row['active'] == 0){
                      $block .= '<a id="myBtn" onClick="unlock(\''.$row['userid'].'\',\''.$row['fname'].'\')" title="Unlock" class="btn btn-warning btn-sm" ><i class="fa fa-unlock"> Unlock</i></a>';
                    } else {

                    }
                    $block .= '<a title="Remove" id="myBtn" class="btn btn-danger btn-sm" onClick="deluser(\''.$row['userid'].'\',\''.$row['fname'].'\')"><i class="fa fa-trash"> Delete</i></a>';
                  }
                  $configurewall="";
                  if($row['btcwallet'] == ""){
                      $configurewall .= '<a id="myBtn" title="Configure Wallet" class="btn btn-secondary btn-sm" onClick="configwall(\''.$row['userid'].'\',\''.$row['fname'].'\')"><i class="fa fa-plus"> Set Wallet</i></a>';
                  }
                  $bal = number_format(round($row['amt'] + $row['bonus_amt'],2),2);
                  $av_bal = number_format(round($row['avail_amt'],2),2);
                  $rv_bal = number_format(round($row['recov_amt'],2),2);
                  $userimg='<img
                            src="'.$row['profile_url'].'"
                            alt="user-avatar"
                            class="d-block rounded"
                            height="100"
                            width="100"
                            id="uploadedAvatar0"
                          />';
                  $opt="
                  <tr>
                    <td>$idd</td>
                    <td>$userimg</td>
                    <td><a href='admin?n=user-activity&usid=$tuserid'>$uemail</a></td>
                    <td>$fullname</td>
                    <td>$country</td>
                    <td>$pno</td>
                    <td>$bal</td>
                    <td>$av_bal</td>
                    <td>$rv_bal</td>
                    <td>$address</td>
                    <td>$gender</td>
                    <td>".date('jS M Y - h:i:A', strtotime($row['reg_date']))."</td>
                    <td>$state</td>
                    <td>$block</td>
                    <td>$configurewall</td>
                  </tr>";
                  $dopt=$dopt.$opt;
                }
                echo $dopt;
                ?>
                
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>User</th>
                  <th>Email</th>
                  <th>Full Name</th>
                  <th>Country</th>
                  <th>Phone</th>
                  <th>Balance</th>
                  <th>Avail Balance</th>
                  <th>Recov Balance</th>
                  <th>Address</th>
                  <th>Gender</th>
                  <th>Reg Date</th>
                  <th>State</th>
                  <th>Status</th>
                  <th>Action</th>
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
  case 'cases' :
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
                $stmt2 = mysqli_query($localhost,("SELECT a.*,b.*, a.date as dte FROM cases a, casemessages b where  a.reference= b.caseref and a.reference='$caseref' $del"));
                            $act="";
                            if (mysqli_num_rows($stmt2) > 0) {
                                // output data of each row
                                $question= '';
                                $answer= '';
                                $faqid= '';
                                while($row2 = mysqli_fetch_assoc($stmt2)) {
                                $faqid = $row2['ID'];
                                $subject = $row2['subject'];
                                $caseownerid=$row2['userid'];
                                $status = $row2['status'];
                                $ref=$row2['reference'];
                                $wallets=$row2['wallets'];
                                $agent=$row2['agent'];
                                $agentname='';
                                $agentem='';
                                $agentex='';
                                $agentpro='assets/images/avatar.png';
                                $agentactive='';
                                $agentsucess='';
                                $agentstalabel="bg-danger";
                                if($agent != null){
                                  $agentar=explode(";", $agent);
                                  $agentname=$agentar[0];
                                  $agentem=$agentar[1];
                                  $agentex=$agentar[2];
                                  $agentpro=$agentar[3];
                                  $agentactive=$agentar[4];
                                  $agentsucess=$agentar[5];
                                  $agentstatus="available";
                                  $agentstalabel="bg-success";
                                }else{
                                  $agent="";
                                }
                                $reply = $row2['reply'];
                                $spid = $row2['spid'];
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
                                $dte = $row2['dte'];
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
                          <h5 class="mb-4">All Cases <span class="avtar avtar-xs bg-light-primary rounded-circle" id="caseholder"><?php echo total_case_ad('')?></span>
                          </h5>
                          <div class="form-search">
                            <a class="btn btn-primary" type="button" href="admin?n=cases-new">Create New Case</a>
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
                              $stmt2 = mysqli_query($localhost,("SELECT cases.id,cases.reference,cases.subject,cases.ccy,cases.casetype,cases.amount,cases.wallets,cases.status,cases.date,cases.agent, count(casemessages.userid) as reply FROM cases LEFT JOIN casemessages ON cases.reference = casemessages.caseref where casemessages.status='0'  $del group by cases.id,cases.reference,cases.subject,cases.ccy,cases.casetype,cases.amount,cases.wallets,cases.status,cases.date,cases.agent order by cases.id desc"));
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
                                  $spid = $row2['spid'];
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

                              <a href="admin?n=cases&ref=<?php echo $ref; ?><?php echo $dellnk; ?>" class="list-group-item list-group-item-action p-3 <?php echo $act; ?>">
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
                            <a href="admin?n=cases" class="list-group-item list-group-item-action">
                              <svg class="pc-icon">
                                <use xlink:href="#custom-presentation-chart"></use>
                              </svg>
                              <span>All Cases</span>
                            </a>
                            <a href="admin?n=cases&del=1" class="list-group-item list-group-item-action">
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
                              <h6 class="mb-0"> <?php echo $subject; ?></h6>
                              <span class="text-sm text-muted"> <?php echo date('jS M Y - h:i:A', strtotime($dte)); ?></span>
                              <span><small class="mb-0"> <br><?php echo $wallets; ?> </small></span>
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
                            <a class="dropdown-item" href="admin?n=cases&ref=<?php echo $caseref; ?>&del_case=1&spid=<?php echo $spid; ?>">Mark as Closed</a>
                            <a class="dropdown-item" href="admin?n=cases&ref=<?php echo $caseref; ?>&del_case=2&spid=<?php echo $spid; ?>">Delete</a>
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
                       
                      $stmt2 = mysqli_query($localhost,("SELECT casemessages.*,recordscase.* FROM casemessages LEFT JOIN recordscase on casemessages.id=recordscase.message_id and casemessages.status='0' and casemessages.caseref= '$caseref' order by casemessages.id"));
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
                          $spid = $row2['userid'];
                          $messagetype = $row2['messagetype'];
                          $ref=$row2['reference'];
                          $file = $row2['file'];
                          if($file !==null){
                             $message="<span href='javascript: void(0' onclick='showimage(\"$file\");'>$message</span>"; 
                          }
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
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="admin?n=cases&ref=<?php echo $caseref; ?>&mref=<?php echo $ref; ?>&del_message=1&spid=<?php echo $spid; ?>"><i class="ti ti-trash"></i> Delete</a>
                                        </div>
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
                                <i class="chat-badge bg-success"></i>
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
                                          <a class="dropdown-item" href="admin?n=cases&ref=<?php echo $caseref; ?>&mref=<?php echo $ref; ?>&del_message=1&spid=<?php echo $spid; ?>"><i class="ti ti-trash"></i> Delete</a>
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
                    <form action="<?php echo $siteurl; ?>admin?n=cases&ref=<?php echo $caseref; ?>"   method="POST" id="replyform"  autocomplete="off" enctype="multipart/form-data">
                      <input type="hidden" name="add_reply" value="1" required>
                      <input type="hidden" name="caseref" value="<?php echo $caseref; ?>" required>
                      <input type="hidden" name="caseownerid" value="<?php echo $caseownerid; ?>" required>
                      <textarea class="form-control border-0 shadow-none px-0" placeholder="Type a Message"
                        rows="2" name="replymessage" id="replymessage"></textarea>
                      <hr class="my-2">
                      <?php
                      if($del&&$agent!==""){
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
              <?php
                $stmt2 = mysqli_query($localhost,("SELECT * FROM users where userid='$caseownerid' "));
                $act="";
                if (mysqli_num_rows($stmt2) > 0) {
                    // output data of each row
                    $question= '';
                    $answer= '';
                    $faqid= '';
                    while($row2 = mysqli_fetch_assoc($stmt2)) {
                    $cfname = $row2['fname'];
                    $clname=$row2['clname'];
                    $cemail = $row2['email'];
                    $cgender = $row['gender'];
                    $ccountry = $row['country'];
                    $czip = $row2['zip'];
                    $cpno2 = $row2['pno2'];
                    $caddress = $row2['address'];
                    $cref_id = $row2['ref_id'];
                    $cavail_bal = $row2['avail_amt'];
                    $crecov_bal = $row2['avail_amt'];
                    $cuname = $row2['uname'];
                    $cbalance = $row2['amt'] + $row2['bonus_amt'];
                    if($cbalance<$cavail_bal){
                      $cavail_bal=$cbalance;
                    }
                    $cprofile_url = $row2['profile_url'];
                    if($cprofile_url == 'assets/images/avatar.png') {
                      $cprofile_url = $siteurl.$cprofile_url;
                    }
                    $cpno = $row2['pno'];
                    $creg_date = $row2['reg_date'];
                    if($row2['state'] == 'ON'){
                      $cstate = 'Online';
                    }else{
                      $cstate = '<time class="timeago" datetime="'.$row2['timestamp'].'">'.date('jS M Y', strtotime($row2['timestamp'])).' by '.date('H : ia', strtotime($row2['timestamp'])).'</time>';
                    }
                  }
                  
              ?>
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
                          <h5 class="text-start">Case Owner</h5>
                          <div class="position-absolute end-0 top-0 p-3 d-none d-xxl-inline-flex">
                            <a href="#" class="avtar avtar-xs btn-link-danger btn-pc-default" data-bs-toggle="collapse"
                              data-bs-target="#chat-user_info">
                              <i class="ti ti-x f-16"></i>
                            </a>
                          </div>
                          <div class="chat-avtar d-inline-flex mx-auto">
                            <img class="rounded-circle img-fluid wid-100" src="<?php echo $cprofile_url; ?>"
                              alt="User image">
                          </div>
                          <h5 class="mb-0"><?php echo $cfname.' '. $clname; ?></h5>
                         
                        </div>
                        <div class="scroll-block">
                          <div class="card-body">
                            <div class="row mb-3">
                              <div class="col-6">
                                <div class="p-3 rounded bg-light-primary">
                                  <p class="mb-1">Balance</p>
                                  <div class="d-flex align-items-center">
                                    <i class="ti ti-folder f-22 text-primary"></i>
                                    <h4 class="mb-0 ms-2"><?php echo number_format($cbalance); ?></h4>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="p-3 rounded bg-light-secondary">
                                  <p class="mb-1">Available</p>
                                  <div class="d-flex align-items-center">
                                    <i class="ti ti-link f-22 text-secondary"></i>
                                    <h4 class="mb-0 ms-2"><?php echo number_format($cavail_bal); ?></h4>
                                  </div>
                                </div>
                              </div>
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
                                  <p class="mb-0">Address</p>
                                  <p class="mb-0 text-muted"><?php echo $caddress; ?> <?php echo $ccountry; ?> <?php echo $czip; ?></p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                  <p class="mb-0">Email</p>
                                  <p class="mb-0 text-muted"> <?php echo $cemail; ?></p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                  <p class="mb-0">Phone</p>
                                  <p class="mb-0 text-muted"> <?php echo $cphone; ?></p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                  <p class="mb-0">Last visited</p>
                                  <p class="mb-0 text-muted"><?php echo $cstate; ?></p>
                                </div>
                              </div>
                            </div>
                            <hr class="my-3 border border-secondary-subtle">
                            <a class="btn border-0 p-0 text-start w-100" data-bs-toggle="collapse"
                              href="#filtercollapse3">
                              <div class="float-end"><i class="ti ti-chevron-down"></i></div>
                              <h5 class="mb-0">Agent</h5>
                            </a>
                            <div class="collapse show" id="filtercollapse3">
                              <div class="py-3">
                                <div class="media align-items-center mb-2">
                                    <form action="<?php echo $siteurl; ?>admin?n=cases&ref=<?php echo $caseref; ?>"   method="POST"  autocomplete="off">
                                    <input type="hidden" name="assign_agent" value="1" required>
                                    <input type="hidden" name="caseref" value="<?php echo $caseref; ?>" required>
                                    <input type="hidden" name="caseownerid" value="<?php echo $caseownerid; ?>" required>
                                    <div class="mb-3 col-md-12">
                                      <label for="Name" class="form-label">Name</label>
                                      <input class="form-control" id="name" type="text" value="<?php echo $agentname; ?>" type="text"  placeholder="Name " required name="name" />
                                    </div>
                                    <div class="mb-3 col-md-12">
                                      <label for="Name" class="form-label">Email</label>
                                      <input class="form-control" id="email" type="email" value="<?php echo $agentem; ?>"   placeholder="Email " required name="email" />
                                    </div>
                                    <div class="mb-3 col-md-12">
                                      <label for="Name" class="form-label">Experience</label>
                                      <input class="form-control" id="experience" type="text" value="<?php echo $agentex; ?>" type="text"  placeholder="Experience " required name="experience" />
                                    </div>
                                    <div class="mb-3 col-md-12">
                                      <label for="Name" class="form-label">Image</label>
                                      <input class="form-control" id="image" type="text" type="text" value="<?php echo $agentpro; ?>"  placeholder="Image " required name="image" />
                                    </div>
                                    <div class="mb-3 col-md-12">
                                      <label for="Name" class="form-label">Active Cases</label>
                                      <input class="form-control" id="active" type="text" type="text" value="<?php echo $agentactive; ?>"  placeholder="Active Cases " required name="active" />
                                    </div>
                                    <div class="mb-3 col-md-12">
                                      <label for="Name" class="form-label">Success Cases</label>
                                      <input class="form-control" id="success" type="text" type="text" value="<?php echo $agentsucess; ?>"  placeholder="Success Cases " required name="success" />
                                    </div>
                                    <hr class="my-2">
                                    <div class="mb-3 col-md-12">
                                      <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                                    </div>
                  
                                  </form>
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
                                  $stmt2 = mysqli_query($localhost,("SELECT a.*,b.* FROM casemessages a, recordscase b where a.caseref='$caseref' and a.id=b.message_id "));
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
                                  <a href="<?php echo $filee; ?>" target="_blank" download class="avtar avtar-xs btn-link-secondary">
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
                 }
              ?>
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
                          <h5 class="mb-4">All Cases <span class="avtar avtar-xs bg-light-primary rounded-circle" id="caseholder"><?php echo total_case_ad('')?></span>
                          </h5>
                          <div class="form-search">
                            <a class="btn btn-primary" type="button" href="admin?n=cases-new">Create New Case</a>
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
                                
                                
                              $stmt2 = mysqli_query($localhost,("SELECT cases.id,cases.reference,cases.subject,cases.ccy,cases.casetype,cases.amount,cases.wallets,cases.status,cases.date,cases.agent as agent, count(casemessages.userid) as reply FROM cases LEFT JOIN casemessages ON cases.reference = casemessages.caseref where casemessages.status='0'  $del group by cases.id,cases.reference,cases.subject,cases.ccy,cases.casetype,cases.amount,cases.wallets,cases.status,cases.date,cases.agent order by cases.id desc"));
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
                                  $agentt=$row2['agent'];
                                
                                  
                                  $agentstalabelopt="bg-danger";
                                  if($agentt != null){
                                    
                                    $agentstalabelopt="bg-success";
                                  }else{
                                  }
                                  $amount = $row2['amount'];
                                  $dte = $row2['date'];
                                  if($caseref==$ref){
                                    $act="active";
                                  }
                                  if($status !== null){
                                ?>

                              <a href="admin?n=cases&ref=<?php echo $ref; ?><?php echo $del; ?>" class="list-group-item list-group-item-action p-3 <?php echo $act; ?>" <?php echo $delcolor; ?>>
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
                            <a href="admin?n=cases" class="list-group-item list-group-item-action">
                              <svg class="pc-icon">
                                <use xlink:href="#custom-presentation-chart"></use>
                              </svg>
                              <span>All Cases</span>
                            </a>
                            <a href="admin?n=cases&del=1" class="list-group-item list-group-item-action">
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
                  <h6 class="mb-0">Users</h6>
                </div>
              </div>
              <div class="bg-body p-3 mt-3 rounded">
                <div class="mt-3 row align-items-center">
                  <div class="col-5">
                    <div id="all-earnings-graph"></div>
                  </div>
                  <div class="col-7">
                    <h5 class="mb-1"><?php echo total_users_ad(); ?></h5>
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
                  <h6 class="mb-0">Cases</h6>
                </div>
              </div>
              <div class="bg-body p-3 mt-3 rounded">
                <div class="mt-3 row align-items-center">
                  <div class="col-5">
                    <div id="page-views-graph"></div>
                  </div>
                  <div class="col-7">
                    <h5 class="mb-1"><?php echo total_cases_ad(); ?></h5>
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
                  <h6 class="mb-0">Deposits</h6>
                </div>
              </div>
              <div class="bg-body p-3 mt-3 rounded">
                <div class="mt-3 row align-items-center">
                  <div class="col-5">
                    <div id="total-task-graph"></div>
                  </div>
                  <div class="col-7">
                    <h5 class="mb-1">$<?php echo number_format(round(total_redraw_ad(),2),2)?></h5>
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
                  <h6 class="mb-0">Withdrawal</h6>
                </div>
              </div>
              <div class="bg-body p-3 mt-3 rounded">
                <div class="mt-3 row align-items-center">
                  <div class="col-5">
                    <div id="download-graph"></div>
                  </div>
                  <div class="col-7">
                    <h5 class="mb-1">$<?php echo number_format(round(total_deposit_ad(),2),2)?></h5>
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
                  $stmt2 = mysqli_query($localhost,("SELECT * FROM trac_log  where  log_type='Case Update' order by id desc limit 4"));
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
                            <p class="text-muted mb-0"><small><?php echo $dte; ?></small></p>
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
                $stmt2 = mysqli_query($localhost,("SELECT * FROM cases where  status='0' order by id desc limit 4 "));
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
                        <a href="admin?n=cases&ref=<?php echo $reference; ?>">
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
                    <a class="btn btn-outline-secondary d-grid" href="admin?n=cases" 
                      ><span class="text-truncate w-100">View all Cases</span></a
                    >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="d-grid">
                    <a class="btn btn-primary d-grid" href="admin?n=cases-new"><span class="text-truncate w-100">Create new Case</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <?php
    }
  }else{
    if(empty($level)){
  ?>
  <div class="pc-container">
    <div class="pc-content">
      <?php include "include/msg.php";?>
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Admin</h2>
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
            <h5 class="card-header">Login</h5>
            <div class="card-body">
              <p class="card-text">
                Please setup permission. Leave this page and immediately log out if you do not have perimission
              </p>
              
              
              <form action=""   method="POST"  autocomplete="off">
                    
                    <!-- Account -->
                  
                    <div class="col-md-8">
                                      
                      <div class="mb-3 form-password-toggle">
                      <label class="form-label" for="password">Password</label>
                      <div class="input-group input-group-merge">
                        <input
                          type="password"
                          id="pwd"
                          class="form-control"
                          name="user_permission"
                          oninput="passworda(this)" required pattern="(?=.*\d)(?=.*[A-Za-z]).{6,}" 
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password"
                        />
                        
                      </div>
                    </div>
                  
                    <hr class="my-0 mb-3" />
                    <div class="mb-3 col-md-12">
                      <button type="submit" class="btn btn-primary" name="setup_permission" id="submit">Submit</button>
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
    }else{
  ?>
    <div class="pc-container">
      <div class="pc-content">
        <?php include "include/msg.php";?>
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Admin</h2>
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
              <h5 class="card-header">Login</h5>
              <div class="card-body">
                <p class="card-text">
                  Leave this page and immediately log out if you do not have perimission
                </p>
                
                
                <form action=""   method="POST"  autocomplete="off">
                      
                      <!-- Account -->
                    
                      <div class="col-md-8">
                                        
                        <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="password"
                            id="pwd"
                            class="form-control"
                            name="user_login"
                            oninput="passworda(this)" required pattern="(?=.*\d)(?=.*[A-Za-z]).{6,}" 
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password"
                          />
                          
                        </div>
                      </div>
                    
                      <hr class="my-0 mb-3" />
                      <div class="mb-3 col-md-12">
                        <button type="submit" class="btn btn-primary" name="setup_login" id="submit">Submit</button>
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
    }
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
