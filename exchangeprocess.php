<?php
require_once('simple.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_ex'])) {
   $ccyfrom = test_input($_POST["ccyfrom"]);
   $ccyto = test_input($_POST["ccyto"]);
   $fromamount = test_input($_POST["fromamount"]);
   $address = test_input($_POST["address"]);
   $refundaddress = test_input($_POST["refundaddress"]);
   $ccyfrom = test_input($_POST["ccyfrom"]);
   $email = test_input($_POST["email"]);
   $ratetype = test_input($_POST["ratetype"]);
   $ret="create_ex=&ccyfrom=$ccyfrom&ccyto=$ccyto&ratetype=$ratetype&fromamount=$fromamount&address=$address&refundaddress=$refundaddress&refundemail=$email";

   if($ccyfrom==""||$ccyto==""||$ratetype==""||$address==""||$fromamount==""){
      $_SESSION['notifye']="Please fill in all exchange parameters";
      header('Location: exchange?'.$ret);
   }else{

	   	if($ratetype=="float"){
			$ratetype="false";
		}
		if($ratetype=="fixed"){
			$ratetype="true";
		}
		//check address
		$toobj=getOneCurrencyObj($ccyto);
		$toobj=json_decode($toobj,TRUE);
		
		$valipat=$toobj['customProperties']['validation_address'];
		$fromobj=getOneCurrencyObj($ccyfrom);
		$fromobj=json_decode($fromobj,TRUE);
		$valipatref=$fromobj['customProperties']['validation_address'];

		if(preg_match("/".$valipat."/", $address)){
			
			if($refundaddress==""||$refundaddress!==""&&preg_match("/".$valipatref."/", $refundaddress)){
				$exval=validateExchange($ccyfrom,$ccyto,$fromamount,$ratetype);

				$excalarry=explode(";", $exval);
			   	if($excalarry[0]=="0"){
			   		//createexchange

			   		$apreqtime=date('Y-m-d H:i:s');
			   		$creex=createExchange($address,$ccyfrom,$ccyto,$fromamount,$ratetype,$refundaddress);
			   		$aprestime=date('Y-m-d H:i:s');
			   		$creexarry=explode(";", $creex);
				   	if($creexarry[0]=="0"){
				   		$resp=json_decode($creexarry[1],TRUE);
				   		$exid=$resp['id'];
				   		$ref=gen_uuid();
				   		$conn2 = new mysqli($servername, $username, $password, $dbname);
			   			$stmt = $conn2->prepare("insert into transactions (email,actiondone,simpleid,floattype,currencyfrom,currencyto,amountfrom,amountto,addressfrom,addressto,refundaddress,userextraemail,simplestatus,tstatus,ccyfrom,ccyto,obj,apireq,apires,reference) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

						$stmt->bind_param("ssssssssssssssssssss", $semail, $sactiondone, $ssimpleid,$stype,$scurrencyfrom,$scurrencyto,$samountfrom,$samountto,$saddressfrom,$saddressto,$srefundaddress,$suserextraemail,$ssimplestatus,$sstatus,$sccyfrom,$sccyto,$sobj,$sapireqtime,$sapiresptime,$sreference);
						$semail = $ip;
						$sactiondone = "createExchange";
						$ssimpleid = isset($resp['id'])?$resp['id']:"";
						$stype = isset($resp['type'])?$resp['type']:"";
						$scurrencyfrom = isset($resp['currency_from'])?$resp['currency_from']:"";
						$scurrencyto = isset($resp['currency_to'])?$resp['currency_to']:"";
						$samountfrom = isset($resp['amount_from'])?$resp['amount_from']:"";
						$samountto = isset($resp['amount_to'])?$resp['amount_to']:"";
						$saddressfrom = isset($resp['address_from'])?$resp['address_from']:"";
						$saddressto = isset($resp['address_to'])?$resp['address_to']:"";
						$srefundaddress = isset($resp['user_refund_address'])?$resp['user_refund_address']:"";
						$suserextraemail = $email;
						$ssimplestatus = isset($resp['status'])?$resp['status']:"";
						$sstatus = "Created";
						$sccyfrom = isset($resp['currencies'][$scurrencyfrom])?json_encode($resp['currencies'][$scurrencyfrom]):"";
						$sccyto = isset($resp['currencies'][$scurrencyto])?json_encode($resp['currencies'][$scurrencyto]):"";
						$sobj = json_encode($resp);
						$sapireqtime = $apreqtime;
						$sapiresptime = $aprestime;
						$sreference = $ref;
							
			            try {

			                if (true) {
			                	$stmt->execute();
								$stmt->close();
			                  	$_SESSION['notifys']="Kindly complete your exchange!";
						   		header('Location: exchange?exchange_id='.$ref);
						   		die();
			                } else {
			                  $_SESSION['notifye']="Unable to create Exchange at this time! Internal Service Error.";        
			              }
			            }catch(Exception $e) {
			                $_SESSION['notifye']= "Unable to create Exchange at this time! Internal Service Error.";
			            }
				   		
				   	}else{
				   		//$_SESSION['notifye']="Cannot Process Exchange. Consider Changing parameters!";
				   		$_SESSION['notifye']=$creexarry[1];
				   	}
			   	}else{
		   			
		   			$_SESSION['notifye']=$excalarry[1];
		   		}	



			}else{
				$_SESSION['notifye']="Refund Address Format Incorrect. Please adjust!";
			}
	   	
	   	}else{
	   		$_SESSION['notifye']="Receipient Address Format Incorrect. Please adjust!";
	      	
	   	}
	   	
	   	header('Location: exchange?'.$ret);
	   	die();
	}

   echo $ret;
   die();


    
   



}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = filter_var($data, FILTER_SANITIZE_STRING);
   return $data;
}

?>