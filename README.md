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


## Examples

The library can be used to:

* Request Mobile Money User to deposit funds into your account
* Check the status of a mobile money transaction.
* Transfer funds from your Payment Account to another Yo! Payments Account
* Get the current balance of your Yo! Payments Account
* Get a ministatement of activity on your Yo! Payments Account
* Send airtime to a mobile phone user
* Send airtime from your Yo! Payments account to another Yo! Payments user account

### Deposit Funds

Request Mobile Money User to deposit funds into your account. This will return a PHP array with keys:

* Status
* StatusCode
* StatusMessage
* TransactionStatus

```
$yoAPI = new YoAPI($this->username, $this->password);
$response = $yoAPI->ac_deposit_funds('256770000000', 10000, 'Reason for transfer of funds');
if($response['Status']=='OK'){
	// Transaction was successful and funds were deposited onto your account
}
```

## Deployment

Add additional notes about how to deploy this on a live system

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
