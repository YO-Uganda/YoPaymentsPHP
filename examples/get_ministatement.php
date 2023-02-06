<?php

/**
 * This example shows settings to use when obtaining the ministatement of your
 * your Yo! Payments Account
 */

require './YoAPI.php';

// Create a new YoAPI instance with Yo! Payments Username and Password
//Set below variables to your Yo! Payments username and password accordingly
$username = "";
$password = "";
$mode = "sandbox";//In production, set this to "production"
$yoAPI = new YoAPI($username, $password, $mode);


/** 
 * This returns a statement for 26th October 2017 for all transactions 
 * (excluding charges) of MTN mobile money that were successful
 */
$response = $yoAPI->ac_get_ministatement('2017-10-26 00:00:00', '2017-10-26 23:59:59', 'SUCCEEDED', 'UGX-MTNMM', 0, 'TRANSACTION');

if($response['Status']=='OK'){
	print_r($response['Transactions']);

	// This returns a PHP array of all the transactions in that period.
}else{
	echo "Yo Payments Error: ".$response['StatusMessage'];
}

/** 
 * This returns a statement for 26th October 2017 for all transactions 
 * (excluding charges) of Airtel money that were successful
 * Note the difference is currency code 'UGX-WARIDMM'
 */
$airtel_response = $yoAPI->ac_get_ministatement('2017-10-26 00:00:00', '2017-10-26 23:59:59', 'SUCCEEDED', 'UGX-WARIDMM', 0, 'TRANSACTION');

if($airtel_response['Status']=='OK'){
	print_r($airtel_response['Transactions']);

	// This returns a PHP array of all the transactions in that period.
}else{
	echo "Yo Payments Error: ".$airtel_response['StatusMessage'];
}

/** 
 * This returns a statement for the latest 5 transactions 
 * (including charges)
 */
$general_response = $yoAPI->ac_get_ministatement();

if($general_response['Status']=='OK'){
	print_r($general_response['Transactions']);

	// This returns a PHP array of all the transactions in that period.
}else{
	echo "Yo Payments Error: ".$general_response['StatusMessage'];
}