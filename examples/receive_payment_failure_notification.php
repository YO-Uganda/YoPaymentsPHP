<?php
/**
 * This example shows how to decode and verify a payment request that has failed.
 * This script should be run at the failure notification url set when making the acdeposit
 * request
 */

require './YoAPI.php';

if(isset($_POST)){
	//Set below variables to your Yo! Payments username and password accordingly
	$username = "";
	$password = "";
	$mode = "sandbox";//In production, set this to "production"
	$yoAPI = new YoAPI($username, $password, $mode);
	$response = $yoAPI->receive_payment_failure_notification();
	if($response['is_verified']){
		// Notification is from Yo! Uganda Limited
		echo "Failed Transaction Details: \n";
		echo "FAILED TRANSACTION REFERENCE: ".$response['failed_transaction_reference']."\n";
		echo "TRANSACTION INITIATION DATE: ".$response['transaction_init_date']."\n";

		// Update your transaction status in the db where the external_ref = $response['failed_transaction_reference']
	}
}