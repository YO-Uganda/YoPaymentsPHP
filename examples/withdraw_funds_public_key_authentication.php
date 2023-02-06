<?php

require '../YoAPI.php';

$username = '';
$password = '';
$msisdn = '2567......';
$amount = '1000';
$narrative = 'ac_withdraw_funds payments test with public key authentication signature';
$private_key_file_location = 'path/to/private/key';

try{
	//Set below variables to your Yo! Payments username and password accordingly
	$username = "";
	$password = "";
	$mode = "sandbox";//In production, set this to "production"
	$yoAPI = new YoAPI($username, $password, $mode); 

	$yoAPI->set_external_reference(date("YmdHis").rand(1,100));
	$yoAPI->set_private_key_file_location($private_key_file_location);
	$yoAPI->set_public_key_authentication_nonce(date("YmdHis").rand(1,100));
	$yoAPI->generate_public_key_authentication_signature($msisdn, $amount, $narrative);
	$response = $yoAPI->ac_withdraw_funds($msisdn, $amount, $narrative);

	if($response['TransactionStatus']=='SUCCEEDED'){
		echo "Payment made! Funds have been deposited onto your account. Transaction Reference = ".$response['TransactionReference'].". Thank you for using Yo! Payments";
		// Save this transaction for future reference
	}else{
		echo "Yo Payments Error: ".$response['StatusMessage'];
	}
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}