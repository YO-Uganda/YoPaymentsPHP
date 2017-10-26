<?php

/**
 * This example shows settings to use when obtaining the ministatement of your
 * your Yo! Payments Account
 */

require './YoAPI.php';

// Create a new YoAPI instance with Yo! Payments Username and Password
$yoAPI = new YoAPI($username, $password); 


/** 
 * This returns a statement for 26th October 2017 for all transactions of 
 * MTN mobile money that were successful
 */
$response = $yoAPI->ac_get_ministatement('2017-10-26 00:00:00', '2017-10-26 23:59:59', 'SUCCEEDED', 'UGX-MTNMM', 0, 'TRANSACTION');

if($response['Status']=='OK'){
	print_r($response['Transactions']);

	// This returns a PHP array of all the transactions in that period.
}else{
	echo "Yo Payments Error: ".$response['StatusMessage'];
}