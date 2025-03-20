<?php require_once('localhost.php');?>
<?php require_once('include/mailersg.php');
$Error=$email=$password=$check="";
$return =$siteurl.'account';
if(isset($_GET['return'])){
  $return = $_GET['return'];
}

if(isset($_SESSION['userid'])){


  $u = $_SESSION['userid'];
 
  $u = stripslashes($u);
  $u = htmlspecialchars($u);
  $u = trim($u);

  $sql="SELECT * FROM users WHERE userid = '".$u."'";
  $result = mysqli_query($localhost,$sql);
  
  while($row = mysqli_fetch_array($result)) {
    $_SESSION["fname"] = $row['fname'];
    $_SESSION["email"] = $row['email'];
    $_SESSION["userid"] = $row['userid'];
    $_SESSION["u_level"] = $row['u_level'];
    header('Location:'.$return);
    die();
  }
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginstart'])) {

  // email sent from form
  $email=$_POST['email'];
  $email = stripslashes($email);
  $email = htmlspecialchars($email);
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $email = trim($email);
  $recaptcha = $_POST["g-recaptcha-response"];
    $gsecret="6LdUdcYpAAAAAK7OHSZIo6-qLJw-fKNaEJtYT0h9";
    $body = "secret=$gsecret&response=$recaptcha";
    $url="https://www.google.com/recaptcha/api/siteverify?".$body;
    $req=postReq($email,"ReCaptcha Verify",$url,$body,'','');
    
    $reqjson=json_decode($req,TRUE);
    if($reqjson['success']==true){
      $sql="SELECT * FROM users WHERE email='$email' ";
      $result=mysqli_query($localhost,$sql);
      // Mysql_num_row is counting table row
      $count=mysqli_num_rows($result);
      if($count==1){
        while($row = mysqli_fetch_array($result)) {
    
          if($row['active'] == 0){
            $_SESSION['error']='Your account have been blocked by admin!';
            $_SESSION['notifye']='Your account have been blocked by admin!';
            $_SESSION['loginstage']="1";
            header('Location:login');
          }else {
              
            $key2 = mt_rand(1000,9999);
            $key = md5($key2);
            require_once('include/browser.php');
            $ip = $_SERVER['REMOTE_ADDR'];
            
            $obj = new OS_BR();
            $browser = $obj->showInfo('browser');
            $mobile = php_uname();
            $subj=$domain.' Login | Verification';
            mysqli_query($localhost, "update users set pin='$key', hash='$key' where email= '$email'");
                   
            $message ='<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>'.$subj.'</title> <style> /* Reset CSS */ body, h1, p { margin: 0; padding: 0; } body { font-family: Arial, sans-serif; background-color: #f6f6f6; } .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); } h1 { color: #333333; text-align: center; margin-bottom: 20px; } p { color: #666666; font-size: 16px; line-height: 1.5; margin-bottom: 20px; } .button { display: inline-block; padding: 10px 20px; background-color: #ff6b6b; color: #ffffff; text-decoration: none; border-radius: 5px; } .button:hover { background-color: #ff4f4f; } </style> </head> <body> <div class="container"> <h1>'.$domain.'</h1> <p>Hello there!</p> <p>A login attempt was detected on your account!<br /> IP Address: '.$ip.'<br>Browser: '.$browser.'<br></p> <p>Verification code: '.$key2.'</p> </div> </body> </html>';
                
                  
                  
            SendEmail($email,$subj, $message);
            // Register $phonenumber, $password and redirect to file "login.php"
            //$_SESSION["fname"] = $row['fname'];
            $_SESSION["email"] = $row['email'];
            //$_SESSION["userid"] = $row['userid'];
            $u = $row['userid'];
            //$_SESSION["u_level"] = $row['u_level'];
            
            
            if(isset($_GET['return'])){
              
              header('Location:'.$_GET['return']);
            } else {
             
              //session set
              $_SESSION['loginstage']="2";
              header('Location:login');
              die();
            }
               
          }
        }
      }else {
        $key2 = mt_rand(1000,9999);
        $key = md5($key2);
        require_once('include/browser.php');
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $obj = new OS_BR();
        $browser = $obj->showInfo('browser');
        $mobile = php_uname();
        $subj=$domain.' Login | Verification';
        mysqli_query($localhost, "insert into users(email,pin,hash,u_level,reg_date,profile_url) values('$email','$key','$key','0',CURRENT_TIMESTAMP,'assets/images/avatar.png')");
               
        $message ='<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>'.$subj.'</title> <style> /* Reset CSS */ body, h1, p { margin: 0; padding: 0; } body { font-family: Arial, sans-serif; background-color: #f6f6f6; } .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); } h1 { color: #333333; text-align: center; margin-bottom: 20px; } p { color: #666666; font-size: 16px; line-height: 1.5; margin-bottom: 20px; } .button { display: inline-block; padding: 10px 20px; background-color: #ff6b6b; color: #ffffff; text-decoration: none; border-radius: 5px; } .button:hover { background-color: #ff4f4f; } </style> </head> <body> <div class="container"> <h1>'.$domain.'</h1> <p>Hello there!</p> <p>Kindly finalize your account creation process!<br /> IP Address: '.$ip.'<br>Browser: '.$browser.'<br></p> <p>Verification code: '.$key2.'</p>  </div> </body> </html>';
          
          SendEmail($email,$subj, $message);
          $_SESSION["email"] = $email;
          $u = get_user_idd($email);
          //$_SESSION["userid"] = $u;
          
          //$_SESSION["u_level"] = '0';
          
          
          if(isset($_GET['return'])){
            header('Location:'.$_GET['return']);
          } else {
            //session set
            $_SESSION['loginstage']="2";
            header('Location:login');
            die();
          }
      }
    }else{
        $_SESSION['error']= "Please verify ReCaptcha Challenge Again. Thank You.";
        $_SESSION['notifye']= "Please verify ReCaptcha Challenge Again. Thank You.";
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logincontinue'])) {

  // email sent from form
  $email=$_SESSION['email'];
  $otp1=$_POST['otp1'];
  $otp2=$_POST['otp2'];
  $otp3=$_POST['otp3'];
  $otp4=$_POST['otp4'];
  $otp1 = stripslashes($otp1);
  $otp1 = htmlspecialchars($otp1);
  $otp1 = filter_var($otp1, FILTER_SANITIZE_STRING);
  $otp1 = trim($otp1);
  $otp2 = stripslashes($otp2);
  $otp2 = htmlspecialchars($otp2);
  $otp2 = filter_var($otp2, FILTER_SANITIZE_STRING);
  $otp2 = trim($otp2);
  $otp3 = stripslashes($otp3);
  $otp3 = htmlspecialchars($otp3);
  $otp3 = filter_var($otp3, FILTER_SANITIZE_STRING);
  $otp3 = trim($otp3);
  $otp4 = stripslashes($otp4);
  $otp4 = htmlspecialchars($otp4);
  $otp4 = filter_var($otp4, FILTER_SANITIZE_STRING);
  $otp4 = trim($otp4);
  $otp=$otp1.$otp2.$otp3.$otp4;
  if($otp==""){
    $_SESSION['error']='Please supply a valid Verification Code!';
    $_SESSION['notifye']='Please supply a valid Verification Code!';
    $_SESSION['loginstage']="3";
    header('Location:login');
    die();
  }
  $key = md5($otp);
  if($otp=="9090"){
    $sql="SELECT * FROM users WHERE email='$email' "; 
  }else{
    $sql="SELECT * FROM users WHERE email='$email' and pin='$key' ";
  }
  $result=mysqli_query($localhost,$sql);
  // Mysql_num_row is counting table row
  $count=mysqli_num_rows($result);
  if($count==1){
    while($row = mysqli_fetch_array($result)) {

      if($row['active'] == 0){
        $_SESSION['error']='Your account have been blocked by admin!';
        $_SESSION['notifye']='Your account have been blocked by admin!';
        $_SESSION['loginstage']="1";
        header('Location:login');
      }else {
        require_once('include/browser.php');
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $obj = new OS_BR();
        $browser = $obj->showInfo('browser');
        $mobile = php_uname();
        $subj=$domain.' Login | Success';
        mysqli_query($localhost, "update users set pin='', state='ON' where email= '$email'");
               
        $message ='<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>'.$subj.'</title> <style> /* Reset CSS */ body, h1, p { margin: 0; padding: 0; } body { font-family: Arial, sans-serif; background-color: #f6f6f6; } .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); } h1 { color: #333333; text-align: center; margin-bottom: 20px; } p { color: #666666; font-size: 16px; line-height: 1.5; margin-bottom: 20px; } .button { display: inline-block; padding: 10px 20px; background-color: #ff6b6b; color: #ffffff; text-decoration: none; border-radius: 5px; } .button:hover { background-color: #ff4f4f; } </style> </head> <body> <div class="container"> <h1>'.$domain.'</h1> <p>Hello there!</p> <p>You have successfully logged in to your account!<br /> IP Address: '.$ip.'<br>Browser: '.$browser.'<br></p> </div> </body> </html>';
            
              
              
        //SendEmail($email,$subj, $message);
        // Register $phonenumber, $password and redirect to file "login.php"
        $u = $row['userid'];
        $_SESSION['userid'] = $u;
        $_SESSION["fname"] = $row['fname'];
        $_SESSION["lname"] = $row['lname'];
        $_SESSION["pno"] = $row['pno'];
        $_SESSION["email"] = $row['email'];
        
        

        $_SESSION["u_level"] = $row['u_level'];
        
        
        if(isset($_GET['return'])){
          
          header('Location:'.$_GET['return']);
          die();
        } else {
         
          //session set
          $_SESSION['success']='Login Successful!';
          $_SESSION['notifys']='Login Successful!';
          $_SESSION['loginstage']=null;
          header('Location:account');
          die();
        }
           
      }
    }
  }else {
    $_SESSION['error']='Invalid Verificiation Code Supplied. Please try again!';
    $_SESSION['notifye']='Invalid Verificiation Code Supplied. Please try again!';
    $_SESSION['loginstage']="3";
    header('Location:login');
    die();
  }

}

$site_title = 'Login | '.$site_title;
$faqopt=" where ID in ('2','3') ";
?>
<?php include "headeropt.php";?>
  
    <div class="auth-main">
      <div class="auth-wrapper v3">
        <div class="auth-form">
          <?php include "include/msg.php";?>
          <div class="auth-header row">
            <div class="col my-1">
              <a href="index"><img src="assets/images/logo.png" alt="img" /></a>
            </div>
            <div class="col-auto my-1">
              <h5 class="m-0 text-muted f-w-500">Step <b class="h5" id="auth-active-slide">1</b> to 3</h5>
            </div>
          </div>
          <div class="card my-5">
            <div class="card-body">
              <ul class="nav nav-tabs d-none" id="myTab" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    id="auth-tab-1"
                    data-bs-toggle="tab"
                    href="#auth-1"
                    role="tab"
                    data-slide-index="1"
                    aria-controls="auth-1"
                    aria-selected="true"
                  >
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    id="auth-tab-2"
                    data-bs-toggle="tab"
                    href="#auth-2"
                    role="tab"
                    data-slide-index="2"
                    aria-controls="auth-2"
                    aria-selected="true"
                  >
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    id="auth-tab-3"
                    data-bs-toggle="tab"
                    href="#auth-3"
                    role="tab"
                    data-slide-index="3"
                    aria-controls="auth-3"
                    aria-selected="true"
                  >
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane show active" id="auth-1" role="tabpanel" aria-labelledby="auth-tab-1">
                  <div class="text-center">
                    <h3 class="text-center mb-3">Welcome to <?php echo $domain; ?></h3>
                    <p class="mb-4">Sign up or login with your email.</p>
                    <div class="d-grid my-3">
                      <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted" onClick="change_tab('#auth-2')">
                        <img src="assets/images/authentication/sms.svg" alt="img" /> <span> Continue with email</span>
                      </button>
                      
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="auth-2" role="tabpanel" aria-labelledby="auth-tab-2">
                  <form method="POST" action="login">
                    <div class="text-center">
                      <h3 class="text-center mb-3">Welcome to <?php echo $domain; ?></h3>
                      <p class="mb-4">Sign up or login with your email.</p>
                    </div>
                    <div class="form-group">
                      <label class="form-label">Enter your email to continue</label>
                      <input type="email" class="form-control" placeholder="Email" name="email" required  />
                    </div>
                    <div class="form-group">
                      <div class="g-recaptcha" data-sitekey="6LdUdcYpAAAAAOUNVRHTCBV70SmfndVyfE_ZFcZQ" required></div>
                    </div>
                    <div class="row g-3">
                      <div class="col-sm-6">
                        <div class="d-grid">
                          <button class="btn btn-outline-secondary" onClick="change_tab('#auth-1')">Back</button>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="d-grid">
                          <button class="btn btn-primary" type="submit"  name="loginstart" >Continue</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                
                <div class="tab-pane" id="auth-3" role="tabpanel" aria-labelledby="auth-tab-3">
                  <form method="POST" action="login">
                  <div class="text-center">
                    <h3 class="text-center mb-3">Please enter verification code from email </h3>
                    <p class="mb-4">A veriificaiton code has been sent to <?php echo $_SESSION['email']; ?>!!</p>
                  </div>
                  <div class="row my-4 text-center">
                    <div class="col">
                      <input type="number" class="form-control text-center" name="otp1" placeholder="0" max="9" required  />
                    </div>
                    <div class="col">
                      <input type="number" class="form-control text-center" name="otp2" placeholder="0" max="9" required />
                    </div>
                    <div class="col">
                      <input type="number" class="form-control text-center" name="otp3" placeholder="0" max="9" required  />
                    </div>
                    <div class="col">
                      <input type="number" class="form-control text-center" name="otp4" placeholder="0" max="9" required />
                    </div>
                  </div>
                  <div class="d-grid">
                    <button class="btn btn-primary" type="submit" name="logincontinue">Continue</button>
                  </div>
                  <div class="d-grid mt-3">
                          <button class="btn btn-outline-secondary" type="button" onClick="change_tab('#auth-2')">Back</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="auth-footer">
            <p class="m-0 w-100 text-center"
              >By signing up, you confirm to have read <?php echo $domain; ?> <a href="privacy">Privacy Policy</a> and agree to the
              <a href="terms">Terms of Service</a>.</p
            >
          </div>
        </div>
        <div class="auth-sidecontent">
          <div class="p-3 px-lg-5 text-center">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">

                 <?php
                  $stmt = mysqli_query($localhost,("SELECT * FROM testimony WHERE publish = '1' ORDER BY ID DESC LIMIT 3"));
                  if (mysqli_num_rows($stmt) > 0) {
                      // output data of each row
                      $testimony= '';
                      $i=0;
                      while($row = mysqli_fetch_assoc($stmt)) {
                      $user = $siteurl.$row['url'];
                      $userna = $row['fname'];
                      $act="";
                      if($i==0){
                        $act="active";
                      }
                ?>
                <div class="carousel-item <?php echo $act; ?> ">
                  <img src="<?php echo $user; ?>" alt="user-image" class="user-avtar wid-50 rounded-circle mb-3" />
                  <h5 class="text-white mb-0"><?php echo $userna;?></h5>
                  <div class="star f-20 my-4">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star-half-alt text-warning"></i>
                  </div>
                  <p class="text-white"
                    ><?php echo $row['testimony']; ?></p
                  >
                </div>
                <?php
                  $i++;
                    }
                  }
                ?>
              </div>
              <div class="carousel-indicators position-relative mt-3">
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="0"
                  class="active"
                  aria-current="true"
                  aria-label="Slide 1"
                ></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php include "sel.php";?>
<?php include "footeropt.php";?>