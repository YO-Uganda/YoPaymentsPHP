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

Yo! Payments API PHP Library is available via [Composer/Packagist](https://packagist.org/packages/yo-uganda/yopaymentsphp) (using semantic versioning), so just add this line to your ```composer.json``` file

```
"yo-uganda/yopaymentsphp": "^1.0" 
```
or

```
composer require yo-uganda/yopaymentsphp
```
Then inside your PHP script, add the line

```
require 'vendor/autoload.php';
```
And voila! The Yo! Payments PHP API is now available for use.

Alternatively, copy the contents of the YoPaymentsPHP folder into one of the ```include_path``` directories specified in your PHP configuration.

If you don't use git, click the 'zip' button at the top of the page in GitHub.

### Minimal Installation

While installing the entire package manually or with composer is simple, convenient and reliable, you may want to include only vital files in your project. At the very least you'll need [YoAPI.php](YoAPI.php). If you are doing Instant Payment Notifications, then you'll also require [Yo_Uganda_Public_Certificate.crt](Yo_Uganda_Public_Certificate.crt) for production and [Yo_Uganda_Public_Sandbox_Certificate.crt](Yo_Uganda_Public_Certificate.crt) for the Sandbox.

You can then load the library by just ```require '/path/to/YoAPI.php';``` and everything should work.


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
