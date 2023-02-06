<?php
/**
 * This example shows how to decode and verify a payment request that has been successful
 * This script should be run at the instant notification url set when making the acdeposit
 * request
 */

require './YoAPI.php';

if(isset($_POST)){
	//Set below variables to your Yo! Payments username and password accordingly
	$username = "";
	$password = "";
	$mode = "sandbox";//In production, set this to "production"
	$yoAPI = new YoAPI($username, $password, $mode);
	$response = $yoAPI->receive_payment_notification();
	if($response['is_verified']){
		// Notification is from Yo! Uganda Limited
		echo "Payment Details: \n";
		echo "MSISDN: ".$response['msisdn']."\n";
		echo "DATE: ".$response['date_time']."\n";
		echo "NARRATIVE: ".$response['narrative']."\n";
		echo "AMOUNT: ".$response['amount']."\n";
		echo "MOBILE NETWORK REFERENCE: ".$response['network_ref']."\n";
		echo "EXTERNAL REFERENCE: ".$response['external_ref']."\n";

		// Update your transaction status in the db where the external_ref = $response['external_ref']
	}
}