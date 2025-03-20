<?php
require_once('localhost.php');
require_once('include/browser.php');
  
$ip = $_SERVER['REMOTE_ADDR'];
$obj = new OS_BR();
$browser = $obj->showInfo('browser');
$mobile = php_uname();
$apikey="a561ee0a-0db7-4e41-b77c-e2906f501dfe";
$baseurl="https://api.simpleswap.io/";


function getExchange($exid){
	global $baseurl;
	global $ip;
	global $apikey;
	$actiondone="get_exchange";
	$fullurl=$baseurl.$actiondone."?api_key=$apikey&id=$exid";
	$serviceresponseraw=getReq($ip,$actiondone,$fullurl);
	
	if(strpos($serviceresponseraw, "code") !== false){
		$serviceresponse=json_decode($serviceresponseraw,TRUE);
		$descp=isset($serviceresponse['error'])?$serviceresponse['error']:"Temporary Service Error, Kindly Retry. Consider switching exchange parameters.";
		$serviceresponseraw="1;$descp";

	}else{
		$amt=$serviceresponseraw;
		$serviceresponseraw="0;$amt";

	}
	return $serviceresponseraw;

}

function createExchange($address,$ccyfrom,$ccyto,$amount,$floatfixed,$refundaddress){
	global $baseurl;
	global $ip;
	global $apikey;
	global $browser;
	$address=$address;
	$actiondone="create_exchange";
	$fullurl=$baseurl.$actiondone."?api_key=$apikey&fixed=$floatfixed&currency_from=$ccyfrom&currency_to=$ccyto&amount=$amount";
	$body= array(
	  
	  "fixed"=> "$floatfixed",
	  "currency_from"=> "$ccyfrom",
	  "currency_to"=> "$ccyto",
	  "amount"=> "$amount",
	  "address_to"=> "$address",
	  "extra_id_to"=> "",
	  "user_refund_address"=> "$refundaddress",
	  "user_refund_extra_id"=> ""
	);
	$bodyjson=json_encode($body);
	$serviceresponseraw=postReq($ip,$actiondone,$fullurl,$bodyjson,$ip,$browser);

	if(strpos($serviceresponseraw, "code") !== false){
		$serviceresponse=json_decode($serviceresponseraw,TRUE);
		$descp=isset($serviceresponse['error'])?$serviceresponse['error']:"Temporary Service Error, Kindly Retry. Consider switching exchange parameters.";
		$serviceresponseraw="1;$descp";

	}else{
		$serviceresponseraw="0;$serviceresponseraw";

	}
	return $serviceresponseraw;

}

function validateExchange($ccyfrom,$ccyto,$amount,$floatfixed){
	global $baseurl;
	global $ip;
	global $apikey;
	$actiondone="check_exchanges";
	$fullurl=$baseurl.$actiondone."?api_key=$apikey&fixed=$floatfixed&currency_from=$ccyfrom&currency_to=$ccyto&amount=$amount";
	$serviceresponseraw=getReq($ip,$actiondone,$fullurl);

	if(strpos($serviceresponseraw, "code") !== false){
		$serviceresponse=json_decode($serviceresponseraw,TRUE);
		$descp=isset($serviceresponse['error'])?$serviceresponse['error']:"Temporary Service Error, Kindly Retry. Consider switching exchange parameters.";
		$serviceresponseraw="1;$descp";

	}else{
		$serviceresponseraw="0;$serviceresponseraw";

	}
	return $serviceresponseraw;

}


function getEstimate($ccyfrom,$ccyto,$amount,$floatfixed){
	global $baseurl;
	global $ip;
	global $apikey;
	$actiondone="get_estimated";
	$fullurl=$baseurl.$actiondone."?api_key=$apikey&fixed=$floatfixed&currency_from=$ccyfrom&currency_to=$ccyto&amount=$amount";
	$serviceresponseraw=getReq($ip,$actiondone,$fullurl);
	if(strpos($serviceresponseraw, "code") !== false){
		$serviceresponse=json_decode($serviceresponseraw,TRUE);
		$descp=isset($serviceresponse['error'])?$serviceresponse['error']:"Temporary Service Error, Kindly Retry. Consider switching exchange parameters.";
		$serviceresponseraw="1;$descp";

	}else{
		$amt=substr($serviceresponseraw,1,strlen($serviceresponseraw)-2);
		$serviceresponseraw="0;$amt";

	}
	return $serviceresponseraw;

}

function loadCurrency($ccy){
	global $baseurl;
	global $ip;
	global $apikey;
	$actiondone="get_currency";
	$fullurl=$baseurl.$actiondone."?api_key=$apikey&symbol=$ccy";
	$serviceresponseraw=getReq($ip,$actiondone,$fullurl);

	//file_put_contents("rsc/ccypairs.txt",$serviceresponseraw);
	return $serviceresponseraw;

}

function loadAllCurrencys(){
	$serviceresponseraw=getCurrencyPairs("false","");
	$serviceresponse=json_decode($serviceresponseraw,TRUE);
	
	$i=0;
	$opt="";
	foreach($serviceresponse as $key => $value) 
	{
		
		$serviceresponseraw2=loadCurrency($key);
		$opt.='"'.$key.'":'.$serviceresponseraw2.",";
		
			//echo 'Your key is: '.$key.' and the value of the key is:'.$value;
		if($i==2){
			// echo $opt;
			// die();
		}
		
		$i++;
	}
	file_put_contents("rsc/ccydetails.txt",$opt);
	return $opt;

}

function getAllCurrencys(){
	
	
	$serviceresponseraw=file_get_contents("rsc/ccydetails.txt");
	$serviceresponseraw='{'.substr($serviceresponseraw, 0,strlen($serviceresponseraw)-1).'}';
	return $serviceresponseraw;

}

function loadCurrencyPairs($floatfixed){
	global $baseurl;
	global $ip;
	global $apikey;
	$actiondone="get_all_pairs";
	$fullurl=$baseurl.$actiondone."?api_key=$apikey&fixed=$floatfixed";
	$serviceresponseraw=getReq($ip,$actiondone,$fullurl);

	file_put_contents("rsc/ccypairs.txt",$serviceresponseraw);
	return $serviceresponseraw;

}

function getCurrencyPairs($floatfixed){
	
	if($floatfixed=="true"){
		$serviceresponseraw=file_get_contents("rsc/ccypairs.txt");
	}else{
		$serviceresponseraw=file_get_contents("rsc/ccypairs.txt");
	}
	return $serviceresponseraw;

}




function getOneCurrencyObj($sel){

	$serviceresponseraw=getCurrencyPairsHtml('','','');
	$serviceresponse=json_decode($serviceresponseraw,TRUE);
	$i=0;
	$va="";
	while($i <count($serviceresponse)) 
	{
		$obj=$serviceresponse[$i];
		$val=$obj['value'];
		if($sel==$val){
			return json_encode($obj);
			$cp=$obj['customProperties'];
			$va=$cp['validation_address'];
		}

		$i++;
	}
	
	return json_encode($obj);


}

function validateAddress($val,$add){

	
	if(preg_match("/".$val."/", $add)){
		return "true";
		die();
	}
	return "false";
	


}

function getCurrencyPairsHtml($floatfixed,$exclude,$select){
	$serviceresponseraw=getCurrencyPairs($floatfixed,$exclude);
	$serviceresponse=json_decode($serviceresponseraw,TRUE);
	$serviceresponseraw2=getAllCurrencys();
	$serviceresponse2=json_decode($serviceresponseraw2,TRUE);
	//echo $serviceresponseraw2;
	$onchange='onchange="loadCurrencyTwo();"';
	$opt='[';
	if($exclude!==""){
		$opt='[';
	}
	$i=0;
	foreach($serviceresponse as $key => $value) 
	{
		$sel="";
		
			$keyname=$key;
			$theopt="$key";
			if(isset($serviceresponse2[$key])){
				
				$keydet=$serviceresponse2[$key];
				$symbol=isset($keydet['symbol'])?strtoupper($keydet['symbol']):"";
				$name=isset($keydet['name'])?strtoupper($keydet['name']):"";
				$network=isset($keydet['network'])&&$keydet['network']!==""?strtoupper($keydet['network']):$symbol;
				$warnings_to=isset($keydet['warnings_to'][0])?strtoupper($keydet['warnings_to'][0]):"";
				$validation_address=isset($keydet['validation_address'])?$keydet['validation_address']:"";
				$address_explorer=isset($keydet['address_explorer'])?strtoupper(str_replace("{}", "", $keydet['address_explorer'])):"";
				//$address_explorer=str_replace("HTTPS:", "", $address_explorer);
				$tx_explorer=isset($keydet['tx_explorer'])?strtoupper(str_replace("{}", "", $keydet['tx_explorer'])):"";
				$theopt="$key;$warnings_to;$validation_address;$address_explorer;$tx_explorer";
				$keyname="$symbol - $name - $network <img alt='ccy' style='width:24px;'  src='https://static.simpleswap.io/images/currencies-logo/$key.svg' class='styles__StyledImage-sc-7mvgp0-0 dfoEXf'>";
				$sel='false';
				$validation_address=str_replace("\\", "\\\\", $validation_address);
				$address_explorer="0";
				if($key==$select){
					$sel='true';
				}
				if($symbol!==""){
					if($key!==$exclude){
						$opt.="{\"value\": \"$key\", \"label\": \"$keyname\", \"disabled\": false, \"selected\": $sel ,\"customProperties\": {\"warnings_to\": \"$warnings_to\",\"tx_explorer\": \"$tx_explorer\",\"validation_address\": \"$validation_address\",\"address_explorer\": \"$address_explorer\"}},";
					}else{
						$opt.="{\"value\": \"$key\", \"label\": \"$keyname\", \"disabled\": true, \"selected\": $sel ,\"customProperties\": {\"warnings_to\": \"$warnings_to\",\"tx_explorer\": \"$tx_explorer\",\"validation_address\": \"$validation_address\",\"address_explorer\": \"$address_explorer\"}},";
					}
					//echo 'Your key is: '.$key.' and the value of the key is:'.$value;
				//
				}
			}
			
		
		$i++;
	}
	$opt=substr($opt,0,strlen($opt)-1);
	$opt.=']';
	return $opt;

}

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){
	if (isset($_GET['action']) AND trim($_GET['action']) != ""  ) {
		$actiondone=isset($_GET['action'])?$_GET['action']:"";
		$exclude=isset($_GET['exclude'])?$_GET['exclude']:"";
		$floatfixed=isset($_GET['floatfixed'])?$_GET['floatfixed']:"";
		$ccyfrom=isset($_GET['ccyfrom'])?$_GET['ccyfrom']:"";
		$ccyto=isset($_GET['ccyto'])?$_GET['ccyto']:"";
		$amount=isset($_GET['amount'])?$_GET['amount']:"";
		$select=isset($_GET['select'])?$_GET['select']:"";
		$ccy=isset($_GET['ccy'])?$_GET['ccy']:"";
		$pat=isset($_GET['pat'])?$_GET['pat']:"";
		$addr=isset($_GET['addr'])?$_GET['addr']:"";
		
		if($actiondone=="getcurrpairs"){
			echo getCurrencyPairsHtml($floatfixed,$exclude,$select);
		}
		if($actiondone=="getestimate"){
			echo getEstimate($ccyfrom,$ccyto,$amount,$floatfixed);
		}
		if($actiondone=="getcurrobj"){
			echo getOneCurrencyObj($ccy);
		}
		if($actiondone=="valaddress"){
			echo validateAddress($pat,$addr);
		}
		
	return;
	}
}

//echo getCurrencyPairsHtml("","","");