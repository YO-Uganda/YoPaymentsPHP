# Yo! Payments API PHP Library

Yo! Payments is a revolutionary mobile payments gateway service. Yo! Payments enables businesses to receive payments from their customers via mobile money, as well as make mobile money payments to any mobile money account holder. Yo! Payments also has the capability to send mobile calling credit (“airtime”) directly to users. 

Yo! Payments API PHP Library is a PHP library that can be included in your PHP project to enable seamless integration with websites and web systems.

## Getting Started

### Prerequisites

To use the API, you must, first of all, have a Yo! Payments Business Account. The API is not available for Personal Accounts

* Yo! Payments API Username
* Yo! Payments API Password

```
$yoAPI = new YoAPI($username, $password);
```

### Installing

Download the YoAPI.php file and include it in your PHP script.

```
require 'YoAPI.php';
```

Initialize the library

```
$yoAPI = new YoAPI($username, $password);
```

And that's it! You now have access to the library functions and can make mobile money payments programatically!


## A Simple Example

Start the Mobile Money User to Prompt for PIN to transfer funds

```
$yoAPI = new YoAPI($username, $password);
$yoAPI->set_nonblocking("TRUE");
$response = $yoAPI->ac_deposit_funds('256770000000', 10000, 'Reason for transfer of funds');
if($response['Status']=='OK'){
	// Transaction was successful and funds were deposited onto your account
	echo "Transaction Reference = ".$response['TransactionReference'];
}
```
Receive payment notification when payment completed.

```
$yoAPI = new YoAPI($username, $password);
if(isset($_POST)){
	$response = $yoAPI->receive_payment_notification();
	if($response['is_verified']){
		// Notification is from Yo! Uganda Limited
		echo "Payment from ".$response['msisdn']." on ".$response['date_time']." for ".$response['narrative']." with an amount of ".$response['amount'].". Mobile Network Reference = ".$response['network_ref']." and external reference of ".$response['external_ref'];
	}
}
```

Receive notification when payment has failed.

```
$yoAPI = new YoAPI($username, $password);
if(isset($_POST)){
	$response = $yoAPI->receive_payment_failure_notification();
	if($response['is_verified']){
		// Notification is from Yo! Uganda Limited
		echo "Payment on ".$response['transaction_init_date']." with a FAILED transaction status ".$response['failed_transaction_reference']." closed.";
	}
}
```

You'll find plenty more to play with in the [examples](https://github.com/YO-Uganda) folder.

That's it! You should now be ready to use YoAPI

## Built With

* [PHP](http://www.php.net/) - PHP Programming Language 

## Authors

* **Aziz Kirumira** - *Initial work* - [Yo (U) Ltd](https://github.com/YO-Uganda)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Gerald Begumisa
* Grace Kyeyune
* Joseph Tabajjwa
