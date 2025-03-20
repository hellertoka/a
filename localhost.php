<?php
// Start the session
session_start();
$servername = "localhost";
$username = "u904633367_cb";
$password = "Tiger000."; 

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
define('PW_SALT','(+3%_');
$servername = $servername;
$username = $username;
$password = $password;
$dbname = "u904633367_cb";
$adminemail = "support@Chargebackbase.com";
$admintel = "";
$adminaddress = "";
$GLOBALS['domain'] = '';
$domain = "Chargebackbase.com - Your Premier Destination for Cryptocurrency Recovery and Financial Chargeback Services.";
$siteurl = '';
// Create connection
$localhost = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$localhost) {
    die("Connection failed: " . mysqli_connect_error());
}
 
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS users (
  userid int(11) NOT NULL,
  fname varchar(1000) DEFAULT NULL,
  lname varchar(1000) DEFAULT NULL,
  gender varchar(1000) DEFAULT NULL,
  uname varchar(1000) DEFAULT NULL,
  u_level int(6) DEFAULT NULL,
  tm varchar(32) DEFAULT NULL,
  sub int(6) DEFAULT NULL,
  state varchar(32) DEFAULT NULL,
  rstate varchar(32) DEFAULT NULL,
  active int(6) DEFAULT 1,
  block_reason varchar(2000) DEFAULT NULL,
  pno varchar(32) DEFAULT NULL,
  hash varchar(32) DEFAULT NULL,
  pin varchar(32) DEFAULT NULL,
  twofa varchar(20) DEFAULT NULL,
  wdltwofa varchar(20) DEFAULT NULL,
  wdlerror varchar(20) DEFAULT NULL,
  ref_id int(32) DEFAULT NULL,
  amt varchar(32) DEFAULT '0',
  bonus_amt varchar(920) DEFAULT '0',
  avail_amt varchar(920) DEFAULT '0',
  recov_amt varchar(920) DEFAULT '0',
  times int(11) DEFAULT 0,
  profile_url varchar(320) DEFAULT NULL,
  address varchar(320) DEFAULT NULL,
  zip varchar(320) DEFAULT NULL,
  pno2 varchar(320) DEFAULT NULL,
  country varchar(320) DEFAULT NULL,
  city varchar(320) DEFAULT NULL,
  email varchar(500) NOT NULL,
  password varchar(32) DEFAULT NULL,
  timestamp timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  reg_date datetime DEFAULT NULL,
  idtype varchar(50) DEFAULT NULL,
  idfront varchar(200) DEFAULT NULL,
  idback varchar(200) DEFAULT NULL,
  idstatus varchar(20) DEFAULT NULL,
  iddate timestamp NULL DEFAULT NULL
)";
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}


$sql = "CREATE TABLE IF NOT EXISTS site_info ( 
    id int unsigned NOT NULL auto_increment, 
    site_name varchar(550) NOT NULL,
    site_title varchar(550) NOT NULL,
    site_desc TEXT,
    site_meta TEXT,
    btc_address varchar(550),
    eth_address varchar(550),
    level VARCHAR(250),
    date DATETIME,
    timestamp TIMESTAMP,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}


$sql3 = "CREATE TABLE IF NOT EXISTS testimony (
    ID INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(320),
    userid INT,
    testimony TEXT,
    url  VARCHAR(220),
    publish INT,
    date DATETIME
)";
if (mysqli_query($localhost, $sql3)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}


$sql3 = "CREATE TABLE IF NOT EXISTS newsletter (
     ID INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(320),
    date DATETIME,
    timestamp TIMESTAMP
)";
if (mysqli_query($localhost, $sql3)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql3 = "CREATE TABLE IF NOT EXISTS faqheader (
     ID INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    text VARCHAR(320),
    date DATETIME,
    timestamp TIMESTAMP
)";
if (mysqli_query($localhost, $sql3)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql3 = "CREATE TABLE IF NOT EXISTS faqs (
     ID INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subjectid VARCHAR(320),
    question VARCHAR(320),
    answer VARCHAR(8000),
    date DATETIME,
    timestamp TIMESTAMP
)";
if (mysqli_query($localhost, $sql3)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql33 = "CREATE TABLE IF NOT EXISTS apireq (
    ID INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(320),
    actiondone VARCHAR(320),
    req TEXT,
    res TEXT,
    date DATETIME DEFAULT current_timestamp()
)";
if (mysqli_query($localhost, $sql33)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql33 = "CREATE TABLE IF NOT EXISTS transactions (
    ID INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(320),
    actiondone VARCHAR(320),
    simpleid VARCHAR(320),
    floattype VARCHAR(320),
    currencyfrom VARCHAR(320),
    currencyto VARCHAR(320),
    amountfrom VARCHAR(320),
    amountto VARCHAR(320),
    addressfrom VARCHAR(320),
    addressto VARCHAR(320),
    refundaddress VARCHAR(320),
    userextraemail VARCHAR(320),
    simplestatus VARCHAR(320),
    tstatus VARCHAR(320),
    ccyfrom TEXT,
    ccyto TEXT,
    obj TEXT,
    apireq DATETIME,
    apires DATETIME,
    lastupdate DATETIME,
    date DATETIME DEFAULT current_timestamp(),
    reference VARCHAR(320)
)";
if (mysqli_query($localhost, $sql33)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql33 = "CREATE TABLE IF NOT EXISTS pagevisit (
    ID INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(320),
    browser VARCHAR(320),
    mobile VARCHAR(320),
    actiondone VARCHAR(320),
    req TEXT,
    res TEXT,
    day DATE DEFAULT current_date(),
    date DATETIME DEFAULT current_timestamp()
)";
if (mysqli_query($localhost, $sql33)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql = "CREATE TABLE IF NOT EXISTS photos ( 
    photo_id int unsigned NOT NULL auto_increment, 
    photo_name TEXT NOT NULL,
    photo_url TEXT NOT NULL,
    photo_large_url TEXT NOT NULL,
    userid INT,
    timestamp TIMESTAMP,
    PRIMARY KEY (photo_id), 
    KEY photo_id (photo_id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql = "CREATE TABLE IF NOT EXISTS deposits ( 
    id int unsigned NOT NULL auto_increment, 
    method varchar(250) NOT NULL,
    amount float,
    charges varchar(250),
    userid INT,
    status int(1) NOT NULL DEFAULT 0,
    confirmations int,
    hash varchar(250),
    ccyamount float,
    ccyvalue float,
    timestamp TIMESTAMP,
    date DATETIME,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}
$sql = "CREATE TABLE IF NOT EXISTS records ( 
    id int unsigned NOT NULL auto_increment, 
    method varchar(250) NOT NULL,
    amount float,
    charges varchar(250) NOT NULL,
    userid INT,
    deposit_id INT,
    msg TEXT,
    file varchar(250) NOT NULL,
    timestamp TIMESTAMP,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}
$sql = "CREATE TABLE IF NOT EXISTS redraws ( 
    id int unsigned NOT NULL auto_increment,
    method varchar(250) NOT NULL,
    amount INT,
    userid INT,
    address varchar(250),
    charges varchar(250),
    msg TEXT,
    status INT DEFAULT 0,
    token varchar(250),
    tokenstatus varchar(250),
    hash varchar(250),
    timestamp TIMESTAMP,
    date DATETIME,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}
$sql = "CREATE TABLE IF NOT EXISTS recoverys ( 
    id int unsigned NOT NULL auto_increment,
    plan INT,
    userid INT,
    amount varchar(250),
    rate varchar(250) DEFAULT 7,
    status INT DEFAULT 0,
    disallownew varchar(20) DEFAULT 'true',
    timestamp TIMESTAMP,
    date DATETIME,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}
$sql = "CREATE TABLE IF NOT EXISTS trac_log ( 
    id int unsigned NOT NULL auto_increment,
    log_type varchar(250) NOT NULL,
    amount varchar(250),
    link varchar(250) NULL,
    post_balance varchar(250),
    userid INT,
    log_details TEXT,
    timestamp TIMESTAMP,
    date DATETIME,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql = "CREATE TABLE IF NOT EXISTS cases ( 
    id int unsigned NOT NULL auto_increment,
    reference varchar(250) NOT NULL,
    userid varchar(250) NOT NULL,
    subject varchar(250) NOT NULL,
    ccy varchar(250) NOT NULL,
    casetype varchar(250),
    amount varchar(250),
    case_details TEXT,
    wallets TEXT,
    status varchar(250),
    agent TEXT,
    timestamp TIMESTAMP,
    date DATETIME,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql = "CREATE TABLE IF NOT EXISTS casemessages ( 
    id int unsigned NOT NULL auto_increment,
    caseref varchar(250) NOT NULL,
    reference varchar(250) NOT NULL,
    userid varchar(250) NOT NULL,
    message TEXT NOT NULL,
    messagetype varchar(250),
    status varchar(250),
    timestamp TIMESTAMP,
    date DATETIME,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql = "CREATE TABLE IF NOT EXISTS addrs ( 
    id int unsigned NOT NULL auto_increment, 
    address varchar(550) NOT NULL,
    alias varchar(250) NOT NULL,
    ccy varchar(250) NOT NULL,
    userid INT,
    date DATETIME,
    timestamp TIMESTAMP,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql = "CREATE TABLE IF NOT EXISTS recordscase ( 
    id int unsigned NOT NULL auto_increment, 
    userid INT,
    message_id INT,
    file varchar(250) NOT NULL,
    timestamp TIMESTAMP,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql = "CREATE TABLE IF NOT EXISTS site_info ( 
    id int unsigned NOT NULL auto_increment, 
    site_name varchar(550) NOT NULL,
    site_title varchar(550) NOT NULL,
    site_desc TEXT,
    site_meta TEXT,
    btc_address varchar(550),
    eth_address varchar(550),
    level VARCHAR(250),
    date DATETIME,
    timestamp TIMESTAMP,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$sql = "CREATE TABLE IF NOT EXISTS agents ( 
    id int unsigned NOT NULL auto_increment, 
    agent_name varchar(550) NOT NULL,
    agent_title varchar(550) NOT NULL,
    agent_desc TEXT,
    agent_gender varchar(550),
    agent_exp varchar(550),
    agent_url varchar(550),
    date DATETIME,
    timestamp TIMESTAMP,
    PRIMARY KEY (id), 
    KEY id (id) 
)"; 
if (mysqli_query($localhost, $sql)) {
} else {
    echo "Error creating table: " . mysqli_error($localhost);
}

$site_name = $domain;
$site_title = "Chargebackbase.com - Your Premier Destination for Cryptocurrency Recovery and Financial Chargeback Services.";
$site_desc = "Chargebackbase.com - Your Premier Destination for Cryptocurrency Recovery and Financial Chargeback Services.. Experience Seamless Transactions and Reliable Support. Contact Us Today!";
$site_meta = $domain.", 2024, recover stolen crypto, crypto scam recovery, report crypto scam, get crypto back from scammer, recover money from online trading scam, report online trading scam, get money back from online investment scam, forex scam recovery, stock scam recovery, cryptocurrency scams, is bitcoin mining legit, forex trading scam, pig butchering crypto scam, pump and dump scheme forex";
$version = '5.0';
$level = '';


$now = date("Y-m-d H:i:s");
$dayofweek=getDayOfWeek($now);
$rowid = 1;
$chartlabel="";
$chartlabelvalue="";
$currentamtvalue="";
$expectedamtvalue="";
$chartcounter=0;
$cval=0;
$eval=0;

$result=mysqli_query($localhost,"SELECT * FROM site_info WHERE id = '$rowid'");
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)) {
        $site_name = $row["site_name"];
        $site_title = $row["site_title"];
        $site_desc = $row["site_desc"];
        $site_meta = $row["site_meta"];
        $level = $row["level"];
    }
}


$logo = $siteurl.'images/logo2.png';

if(isLoggedin()){
    $tm=date("Y-m-d H:i:s");
    $u = get_user_id();
    mysqli_query($localhost,"UPDATE users SET state='ON', tm='$tm' WHERE userid= '$u'");
    
    $gap=5; // Gap value can be changed, this is in minutes.
    // let us find out the time before 5 minutes of present time. //
    $tm = date("Y-m-d H:i:s", mktime (date("H"),date("i")-$gap,date("s"),date("m"),date("d"),date("Y")));
    mysqli_query($localhost,"UPDATE users SET state = 'OFF' WHERE tm < '$tm'");
    
    $result = mysqli_query($localhost,"SELECT amt FROM users WHERE userid = '$u'");
    while($row = mysqli_fetch_array($result)) {
        mysqli_query($localhost,"UPDATE users SET state = 'ON', tm = '$tm' WHERE userid = '$u'");
    }   
}


$currency = '$'; //Currency Character or code
function amount($amount){
    global $currency;
    return $currency.''.number_format((float)$amount, 2, '.', '');
}

$meta = '';




//New Security

function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

function get_simpleref($ref){
    global $localhost;
    $simpleid = 0;
    $result = mysqli_query($localhost,"SELECT * FROM transactions WHERE reference = '$ref' LIMIT 1");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            $simpleid = $row['simpleid'];
        }
    }
    
    return $simpleid;
}
function encryptCode($key){
    $key = trim($key);
    $key = md5($key . '_' . $key . $key .$key . PW_SALT);
    return $key;
}

function get_user_idd($email){
    global $localhost;
    $level = "";
    
        $result = mysqli_query($localhost,"SELECT * FROM users WHERE email = '$email' LIMIT 1");
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)) {
                $level = $row['userid'];
            }
        }
    
    return $level;
}

function get_user_lvl($email){
    global $localhost;
    $level = 0;
    
        $result = mysqli_query($localhost,"SELECT * FROM users WHERE email = '$email' LIMIT 1");
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)) {
                $level = $row['u_level'];
            }
        }
    
    return $level;
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = filter_var($data, FILTER_SANITIZE_STRING);
   return $data;
}

function get_user_level(){
    global $localhost;
    $level = 0;
    if( isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
        $result = mysqli_query($localhost,"SELECT * FROM users WHERE userid = '$userid' LIMIT 1");
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)) {
                $level = $row['u_level'];
            }
        }
    }
    return $level;
}
function balance($id){
    global $localhost, $siteurl, $domain;
    $name = '0';
    $result = mysqli_query($localhost,"SELECT amt, bonus_amt FROM users WHERE userid = '$id' LIMIT 1");
    while($row = mysqli_fetch_array($result)) {
        $name = $row['amt']+$row['bonus_amt'];
    }
    return $name;
}
function getemail($id){
    global $localhost, $siteurl, $domain;
    $name = '0';
    $result = mysqli_query($localhost,"SELECT email FROM users WHERE userid = '$id' LIMIT 1");
    while($row = mysqli_fetch_array($result)) {
        $name = $row['email'];
    }
    return $name;
}
function insert_log($userid, $log_type, $details, $amount){
    global $localhost, $now;
    $post_balance = balance($userid);

    $sql = "INSERT INTO trac_log (date, amount, log_type, userid, post_balance, log_details) VALUES ('$now', '$amount', '$log_type', '$userid', '$post_balance', '$details')";
   

    if (mysqli_query($localhost, $sql)) {
        return true;
    } else {
        return false;
    }
}
function insert_log_link($userid, $log_type, $details, $link){
    global $localhost, $now;
    
    $sql = "INSERT INTO trac_log (date, amount, log_type, userid, link, log_details) VALUES ('$now', '0', '$log_type', '$userid', '$link', '$details')";
   

    if (mysqli_query($localhost, $sql)) {
        return true;
    } else {
        return false;
    }
}

function total_deposit($id){
    global $localhost;
    $count = 0;
    $result = mysqli_query($localhost,"SELECT SUM(amount) AS amt FROM deposits WHERE userid = '$id' AND status > 0");
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $count = $row['amt'];
    }
    if(empty($count)){ $count = 0; }
    return $count;
}

function total_deposit_ad(){
    global $localhost;
    $count = 0;
    $result = mysqli_query($localhost,"SELECT SUM(amount) AS amt FROM deposits WHERE  status > 0");
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $count = $row['amt'];
    }
    if(empty($count)){ $count = 0; }
    return $count;
}

function total_redraw($id){
    global $localhost;
    $count = 0;
    $result = mysqli_query($localhost,"SELECT SUM(amount) AS amt FROM redraws WHERE userid = '$id' AND status > 0 LIMIT 1");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            $count = $row['amt'];
        }
    }
    if(empty($count)){ $count = 0; }
    return $count;
}

function total_redraw_ad(){
    global $localhost;
    $count = 0;
    $result = mysqli_query($localhost,"SELECT SUM(amount) AS amt FROM redraws WHERE  status > 0 LIMIT 1");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            $count = $row['amt'];
        }
    }
    if(empty($count)){ $count = 0; }
    return $count;
}

function total_recov($id){
    global $localhost;
    $count = 0;
    $result = mysqli_query($localhost,"SELECT SUM(amount) AS amt FROM recoverys WHERE userid = '$id' AND status > 0 LIMIT 1");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            $count = $row['amt'];
        }
    }
    if(empty($count)){ $count = 0; }
    return $count;
}

function total_case($id,$status){
    global $localhost;
    $count = 0;
    if($status==""){
        $result = mysqli_query($localhost,"SELECT count(userid) AS amt FROM cases WHERE userid = '$id' LIMIT 1");

    }else{
        $result = mysqli_query($localhost,"SELECT count(userid) AS amt FROM cases WHERE userid = '$id' AND status = '$status' LIMIT 1");
    }
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            $count = $row['amt'];
        }
    }
    if(empty($count)){ $count = 0; }
    return $count;
}

function total_case_ad($status){
    global $localhost;
    $count = 0;
    if($status==""){
        $result = mysqli_query($localhost,"SELECT count(userid) AS amt FROM cases  LIMIT 1");

    }else{
        $result = mysqli_query($localhost,"SELECT count(userid) AS amt FROM cases WHERE status = '$status' LIMIT 1");
    }
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            $count = $row['amt'];
        }
    }
    if(empty($count)){ $count = 0; }
    return $count;
}

function total_users_ad(){
    global $localhost;
    $count = 0;
    $result = mysqli_query($localhost,"SELECT count(*) AS amt FROM users  LIMIT 1");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            $count = $row['amt'];
        }
    }
    if(empty($count)){ $count = 0; }
    return $count;
}

function total_cases_ad(){
    global $localhost;
    $count = 0;
    $result = mysqli_query($localhost,"SELECT count(*) AS amt FROM cases  LIMIT 1");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            $count = $row['amt'];
        }
    }
    if(empty($count)){ $count = 0; }
    return $count;
}


function isLoggedin(){
    global $localhost;
    if(isset($_SESSION['userid'])){
        $password = $_SESSION['password'];
        $userid = $_SESSION['userid'];
        $result = mysqli_query($localhost,"SELECT * FROM users WHERE userid = '$userid' LIMIT 1");
        if(mysqli_num_rows($result) > 0){
            return true;
        }
    } else {
        return false;
    }
}
function get_user_id(){
    if(isset($_SESSION['userid'])){
        $u = stripslashes($_SESSION['userid']);
        $u = htmlspecialchars($u);
        $u = trim($u);
        return $u;
    } else {
        return 0;
    }
}
function isAdmin(){
    $level = get_user_level();
    if($level == 1 || $level == 2){
        return true;
    } else {
        return false;
    }
}
function runLogin($password, $u){
    $_SESSION["password"] = $password;
    $_SESSION["userid"] = $u;
}

function ulevelConfirm(){
    global $level;
    if(isset($_SESSION['user_permission'])){
        $ulevel = $_SESSION['user_permission'];
        if($ulevel == $level) {
            return true;
        }
    }
}

function getDayOfWeek($dte){
    $unixTimestamp = strtotime($dte);
    
    //Get the day of the week using PHP's date function.
    $dayOfWeek = date("l", $unixTimestamp);
    return $dayOfWeek;
}



function logPostReq($emailaddress,$actiondone,$req,$res){
    global $localhost;
    $status="";
    $sqlx="insert into apireq(email,actiondone,req,res) values('$emailaddress','$actiondone','$req','$res')";
    if (!mysqli_query($localhost, $sqlx)) {
        $status='{"responsecode":"11","responsemessage":"'.htmlspecialchars($localhost->error).'"}';
        

    }else{
        $status='{"responsecode":"00","responsemessage":"Request Submitted Successfully"}';
        
    }

    return $status;
}

function doPageView($emailaddress,$browser,$mobile,$actiondone,$req,$res){
    global $localhost;
    $status="";
    $sqlx="insert into pagevisit(email,browser,mobile,actiondone,req,res) values('$emailaddress','$browser','$mobile','$actiondone','$req','$res')";
    if (!mysqli_query($localhost, $sqlx)) {
        $status='{"responsecode":"11","responsemessage":"'.htmlspecialchars($localhost->error).'"}';
        

    }else{
        $status='{"responsecode":"00","responsemessage":"Request Submitted Successfully"}';
        
    }

    return $status;
}



function postReq($user,$actiondone,$url,$body,$remoteip,$useragent){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json","x-forwarded-for: $remoteip","x-user-agent: $useragent"]);
    $serviceresponseraw=curl_exec($ch);
    logPostReq($user,$actiondone,$body,$serviceresponseraw);
    return $serviceresponseraw;
}

function getReq($user,$actiondone,$url){
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $serviceresponseraw=curl_exec($ch);
    logPostReq($user,$actiondone,$url,$serviceresponseraw);
    return $serviceresponseraw;
}

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
  $url = "https://";   
else  
  $url = "http://";   
  // Append the host(domain name, ip) to the URL.   
  $url.= $_SERVER['HTTP_HOST'];   
  // Append the requested resource location to the URL   
  $url.= $_SERVER['REQUEST_URI'];    

$urlsplt=explode("/", $url); 
$currpage= str_replace(".php","",$urlsplt[3]);
