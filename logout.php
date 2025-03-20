<?php require_once('localhost.php'); 

$qaa="UPDATE users SET state='OFF' WHERE userid='". $_SESSION['userid'] ."'";

if (mysqli_query($localhost, $qaa)) {
    $logrep = "Logout Successful";
} else {
    $logrep = "Error logging out: " . mysqli_error($localhost);
}

// destroy the cookie
setcookie("email", "", time() - 3600, "/");
setcookie("password", "", time() - 3600, "/");

// remove all session variables
session_unset();
// destroy the session
session_destroy();

if(!isset($_SESSION["country"])){
	$ip = '197.210.24.97';
	//$ip = $_SERVER['REMOTE_ADDR'];
	$dataArray = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
	$_SESSION["country"] = $dataArray->geoplugin_countryName;
}
header("location:index");
?>
<?php include "header.php";?>
    
	<div class="bodycontainer2 center padding">
	<h2>Logout</h2>
	<hr />
	<p>System logining you out<br /> <?php echo $logrep; ?> </p>
	</div>

<?php include "footer.php"; ?>