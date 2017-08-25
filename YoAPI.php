<?php

class YoAPI {
    /**
     * The Yo! Payments API Username
     * Required.
     * You may obtain the API Username from the web interface of your Payment Account.
     * @var string
     */
	private $username;

    /**
     * The Yo! Payments API Password
     * Required.
     * You may obtain the API Password from the web interface of your Payment Account.
     * @var string
     */
	private $password;

    /**
     * The Non Blocking Request variable
     * Optional.
     * Whether the connection to the Yo! Payments Gateway is maintained until your request is 
     * fulfilled. "FALSE" maintains the connection till the request is complete.
     * Default: "FALSE"
     * Options: "FALSE", "TRUE".
     * @var string
     */
	private $NonBlocking = "FALSE";

    /**
     * The External Reference variable
     * Optional.
     * An External Reference is something which yourself and the beneficiary agree upon
     * e.g. an invoice number
     * Default: NULL
     * @var string
     */
	private $external_reference = NULL;

    /**
     * The Internal Reference variable
     * Optional.
     * An Internal Reference is a reference code related to another Yo! Payments system transaction
     * If you are unsure about the meaning of this field, leave it as NULL
     * Default: NULL
     * @var string
     */
	private $internal_reference = NULL;

    /**
     * The Provider Reference Text variable
     * Optional.
     * A text you wish to be present in any confirmation message which the mobile money provider
     * network sends to the subscriber upon successful completion of the transaction.
     * Some mobile money providers automatically send a confirmatory text message to the subscriber
     * upon completion of transactions. This parameter allows you to provide some text which will 
     * be appended to any such confirmatory message sent to the subscriber.
     * Default: NULL
     * @var string
     */
	private $provider_reference_text = NULL;

    /**
     * The Instant Notification URL variable
     * Optional.
     * A valid URL which is notified as soon as funds are successfully deposited into your account
     * A payment notification will be sent to this URL. 
     * It must be properly URL encoded.
     * e.g. http://ipnurl?key1=This+value+has+encoded+white+spaces&key2=value
     * Any special XML Characters must be escaped or your request will fail
     * e.g. http://ipnurl?key1=This+value+has+encoded+white+spaces&amp;key2=value
     * Default: NULL
     * @var string
     */
	private $instant_notification_url = NULL;

    /**
     * The Failure Notification URL variable
     * Optional.
     * A valid URL which is notified as soon as your deposit request fails
     * A failure notification will be sent to this URL. 
     * It must be properly URL encoded.
     * e.g. http://failureurl?key1=This+value+has+encoded+white+spaces&key2=value
     * Any special XML Characters must be escaped or your request will fail
     * e.g. http://failureurl?key1=This+value+has+encoded+white+spaces&amp;key2=value
     * Default: NULL
     * @var string
     */
	private $failure_notification_url = NULL;

    /**
     * The Authentication Signature Base64 variable
     * Optional.
     * It may be required to authenticate certain deposit requests.
     * Contact Yo! Payments support services for clarification on the cases where this parameter
     * is required. 
     * Default: NULL
     * @var string
     */
	private $authentication_signature_base64 = NULL;

    /**
     * The Deposit Transaction Type variable
     * Optional.
     * Set to "PUSH" if following up on the status of a push deposit funds transaction
     * Set to "PULL" if following up on the status of a pull deposit funds transaction 
     * Default: "PULL"
     * Options: "PULL", "PUSH"
     * @var string
     */
	private $deposit_transaction_type='PULL';

	/**
     * The Yo Payments API URL
     * Required.
     * Default: "https://paymentsapi1.yo.co.ug/ybs/task.php"
     * Options: 
     * * "https://paymentsapi1.yo.co.ug/ybs/task.php", 
     * * "https://paymentsapi2.yo.co.ug/ybs/task.php",
     * * "https://41.220.12.206/services/yopaymentsdev/task.php" For Sandbox tests
     * @var string
     */
    private $YOURL = "https://paymentsapi1.yo.co.ug/ybs/task.php";

    private $public_key_file = "Yo_Uganda_Public_Certificate.crt";

    /**
     * YoAPI constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
	* Set the API Username
	* @param string $username The Yo Payments API username to use
    * @return void
	*/
	public function set_username($username){
    	$this->username = $username;
    }

    /**
     * Returns the API Username
     * @return string 
     */
    public function get_username(){
    	return $this->username;
    }

    /**
	* Set the API Password
	* @param string $password The Yo Payments API Password to use
    * @return void
	*/
    public function set_password($password){
    	$this->password = $password;
    }

    /**
     * Returns the API Password
     * @return string 
     */
    public function get_password(){
    	return $this->password;
    }

    /**
    * Set the YO URL
    * @param string $yoURL The URL to submit API requests to
    * @return void
    */
    public function set_URL($yoURL){
        $this->YOURL = $yoURL;
    }

    /**
     * Returns the YO URL
     * @return string 
     */
    public function get_URL(){
        return $this->YOURL;
    }

    /**
    * Set the NonBlocking Variable
    * @param string $nonblocking TRUE for nonblocking API requests
    * @return void
    */
    public function set_nonblocking($nonblocking){
    	$this->NonBlocking = $nonblocking;
    }

    /**
     * Returns the NonBlocking Variable
     * @return string 
     */
    public function get_nonblocking(){
    	return $this->NonBlocking;
    }

    /**
    * Set the External Reference
    * @param string $external_reference Used when submitting payment requests
    * @return void
    */
    public function set_external_reference($external_reference)
    {
    	$this->external_reference = $external_reference;
    }

    /**
     * Returns the external_reference Variable
     * @return string 
     */
    public function get_external_reference()
    {
    	return $this->external_reference;
    }

    /**
    * Set the Internal Reference
    * @param string $internal_reference Used when submitting payment requests
    * @return void
    */
    public function set_internal_reference($internal_reference)
    {
    	$this->internal_reference = $internal_reference;
    }

    /**
     * Returns the internal_reference Variable
     * @return string 
     */
    public function get_internal_reference()
    {
    	return $this->internal_reference;
    }

    /**
    * Set the Provider Reference
    * @param string $provider_reference_text Used when submitting payment requests
    * @return void
    */
    public function set_provider_reference_text($provider_reference_text)
    {
    	$this->provider_reference_text = $provider_reference_text;
    }

    /**
     * Returns the provider_reference_text Variable
     * @return string 
     */
    public function get_provider_reference_text()
    {
    	return $this->provider_reference_text;
    }

    /**
    * Set the Instant Notification URL
    * @param string $instant_notification_url Useful for nonblocking requests
    * @return void
    */
    public function set_instant_notification_url($instant_notification_url)
    {
    	$this->instant_notification_url = $instant_notification_url;
    }

    /**
     * Returns the instant_notification_url Variable
     * @return string 
     */
    public function get_instant_notification_url()
    {
    	return $this->instant_notification_url;
    }

    /**
    * Set the Failure Notification URL
    * @param string $failure_notification_url Useful for nonblocking requests
    * @return void
    */
    public function set_failure_notification_url($failure_notification_url)
    {
    	$this->failure_notification_url = $failure_notification_url;
    }

    /**
     * Returns the failure_notification_url Variable
     * @return string 
     */
    public function get_failure_notification_url()
    {
    	return $this->failure_notification_url;
    }

    /**
    * Set the Authentication Signature Base64
    * @param string $authentication_signature_base64 
    * @return void
    */
    public function set_authentication_signature_base64($authentication_signature_base64)
    {
    	$this->authentication_signature_base64 = $authentication_signature_base64;
    }

    /**
     * Returns the Authentication Signature Base64 Variable
     * @return string 
     */
    public function get_authentication_signature_base64()
    {
    	return $this->authentication_signature_base64;
    }

    /**
    * Request Mobile Money User to deposit funds into your account
    * Shortly after you submit this request, the mobile money user receives an on-screen
    * notification on their mobile phone. The notification informs the mobile money user about
    * your request to transfer funds out of their account and requests them to authorize the
    * request to complete the transaction.
    * This request is not supported by all mobile money operator networks
    * @param string $msisdn the mobile money phone number in the format 256772123456
    * @param double $amount the amount of money to deposit into your account (floats are supported)
    * @param string $narrative the reason for the mobile money user to deposit funds 
    * @return array
    */
    public function ac_deposit_funds($msisdn, $amount, $narrative)
    {
    	$xml = '';
    	$xml .= '<?xml version="1.0" encoding="UTF-8"?>';
    	$xml .= '<AutoCreate>';
    	$xml .= '<Request>';
    	$xml .= '<APIUsername>'.$this->username.'</APIUsername>';
    	$xml .= '<APIPassword>'.$this->password.'</APIPassword>';
    	$xml .= '<Method>acdepositfunds</Method>';
    	$xml .= '<NonBlocking>'.$this->NonBlocking.'</NonBlocking>';
    	$xml .= '<Account>'.$msisdn.'</Account>';
    	$xml .= '<Amount>'.$amount.'</Amount>';
    	$xml .= '<Narrative>'.$narrative.'</Narrative>';
    	if( $this->external_reference != NULL ){ $xml .= '<ExternalReference>'.$this->external_reference.'</ExternalReference>'; }
    	if( $this->internal_reference != NULL ) { $xml .= '<InternalReference>'.$this->internal_reference.'</InternalReference'; }
    	if( $this->provider_reference_text != NULL ){ $xml .= '<ProviderReferenceText>'.$this->provider_reference_text.'</ProviderReferenceText>'; }
    	if( $this->instant_notification_url != NULL ){ $xml .= '<InstantNotificationUrl>'.$this->instant_notification_url.'</InstantNotificationUrl>'; }
    	if( $this->failure_notification_url != NULL ){ $xml .= '<FailureNotificationUrl>'.$this->failure_notification_url.'</FailureNotificationUrl>'; }
    	if( $this->authentication_signature_base64 != NULL ){ $xml .= '<AuthenticationSignatureBase64>'.$this->authentication_signature_base64.'</AuthenticationSignatureBase64>'; }
    	$xml .= '</Request>';
    	$xml .= '</AutoCreate>';

		$xml_response = $this->get_xml_response($xml);

		$simpleXMLObject =  new SimpleXMLElement($xml_response);
        $response = $simpleXMLObject->Response;

		$result = array();
		$result['Status'] = (string) $response->Status;
		$result['StatusCode'] = (string) $response->StatusCode;
		$result['StatusMessage'] = (string) $response->StatusMessage;
		$result['TransactionStatus'] = (string) $response->TransactionStatus;
		if (!empty($response->ErrorMessageCode)) {
			$result['ErrorMessageCode'] = (string) $response->ErrorMessageCode;
		}
		if (!empty($response->ErrorMessage)) {
			$result['ErrorMessage'] = (string) $response->ErrorMessage;
		}
		if (!empty($response->TransactionReference)) {
			$result['TransactionReference'] = (string) $response->TransactionReference;
		}
		if (!empty($response->MNOTransactionReferenceId)) {
			$result['MNOTransactionReferenceId'] = (string) $response->MNOTransactionReferenceId;
		}
		if (!empty($response->IssuedReceiptNumber)) {
			$result['IssuedReceiptNumber'] = (string) $response->IssuedReceiptNumber;
		}

		return $result;
    	
    }

    /**
    * Check the status of a transaction that was earlier submitted for processing.
    * Its particularly useful where the NonBlocking is set to TRUE.
    * It can also be used to check on any other transaction on the system.
    * @param string $transaction_reference the response from the Yo! Payments Gateway that uniquely identifies the transaction whose status you are checking
    * @param string $private_transaction_reference The External Reference that was used to carry out a transaction
    * @return array
    */
    public function ac_transaction_check_status($transaction_reference, $private_transaction_reference=NULL)
    {
    	$xml = '';
    	$xml .= '<?xml version="1.0" encoding="UTF-8"?>';
    	$xml .= '<AutoCreate>';
    	$xml .= '<Request>';
    	$xml .= '<APIUsername>'.$this->username.'</APIUsername>';
    	$xml .= '<APIPassword>'.$this->password.'</APIPassword>';
    	$xml .= '<Method>actransactioncheckstatus</Method>';
        if($transaction_reference!=NULL){ $xml .= '<TransactionReference>'.$transaction_reference.'</TransactionReference>'; }
    	if( $private_transaction_reference != NULL ) { $xml .= '<PrivateTransactionReference>'.$private_transaction_reference.'</PrivateTransactionReference>'; }
    	$xml .= '<DepositTransactionType>'.$this->deposit_transaction_type.'</DepositTransactionType>';
    	$xml .= '</Request>';
    	$xml .= '</AutoCreate>';

    	$xml_response = $this->get_xml_response($xml);

		$simpleXMLObject =  new SimpleXMLElement($xml_response);
        $response = $simpleXMLObject->Response;

		$result = array();
		$result['Status'] = (string) $response->Status;
		$result['StatusCode'] = (string) $response->StatusCode;
		$result['StatusMessage'] = (string) $response->StatusMessage;
		$result['TransactionStatus'] = (string) $response->TransactionStatus;
		if (!empty($response->ErrorMessageCode)) {
			$result['ErrorMessageCode'] = (string) $response->ErrorMessageCode;
		}
		if (!empty($response->ErrorMessage)) {
			$result['ErrorMessage'] = (string) $response->ErrorMessage;
		}
		if (!empty($response->TransactionReference)) {
			$result['TransactionReference'] = (string) $response->TransactionReference;
		}
		if (!empty($response->MNOTransactionReferenceId)) {
			$result['MNOTransactionReferenceId'] = (string) $response->MNOTransactionReferenceId;
		}
		if (!empty($response->Amount)) {
			$result['Amount'] = (string) $response->Amount;
		}
		if (!empty($response->AmountFormatted)) {
			$result['AmountFormatted'] = (string) $response->AmountFormatted;
		}
		if (!empty($response->CurrencyCode)) {
			$result['CurrencyCode'] = (string) $response->CurrencyCode;
		}
		if (!empty($response->TransactionInitiationDate)) {
			$result['TransactionInitiationDate'] = (string) $response->TransactionInitiationDate;
		}
		if (!empty($response->TransactionCompletionDate)) {
			$result['TransactionCompletionDate'] = (string) $response->TransactionCompletionDate;
		}
		if (!empty($response->IssuedReceiptNumber)) {
			$result['IssuedReceiptNumber'] = (string) $response->IssuedReceiptNumber;
		}

		return $result;
    }

    /**
    * Transfer funds from your Payment Account to another Yo! Payments Account
    * @param string $currency_code 
    * Options
    * * "UGX-MTNMM" -> Uganda Shillings - MTN Mobile Money
    * * "UGX-MTNAT" -> Uganda Shillings - MTN Airtime
    * * "UGX-WTLAT" -> Uganda Shillings - Warid Airtime
    * * "UGX-OULAT" -> Uganda Shillings - Orange Airtime
    * * "UGX-AIRAT" -> Uganda Shillings - Airtel Airtime
    * @param double $amount  The amount to be transferred
    * @param int $beneficiary_account Account number of Yo! Payments User
    * @param string $beneficiary_email Email Address of the recipient of funds
    * @param string $narrative Textual narrative about the transaction
    * @return array
    */
    public function ac_internal_transfer($currency_code, $amount, $beneficiary_account, $beneficiary_email, $narrative)
    {
        $xml = '';
    	$xml .= '<?xml version="1.0" encoding="UTF-8"?>';
    	$xml .= '<AutoCreate>';
    	$xml .= '<Request>';
    	$xml .= '<APIUsername>'.$this->username.'</APIUsername>';
    	$xml .= '<APIPassword>'.$this->password.'</APIPassword>';
    	$xml .= '<Method>acinternaltransfer</Method>';
    	$xml .= '<CurrencyCode>'.$currency_code.'</CurrencyCode>';
    	$xml .= '<Amount>'.$amount.'</Amount>';
    	$xml .= '<BeneficiaryAccount>'.$beneficiary_account.'</BeneficiaryAccount>';
    	$xml .= '<BeneficiaryEmail>'.$beneficiary_email.'</BeneficiaryEmail>';
    	$xml .= '<Narrative>'.$narrative.'</Narrative>';
    	if($this->internal_reference != NULL) { 
    		$xml .= '<InternalReference>'.$this->internal_reference.'</InternalReference'; 
    	}
    	if($this->external_reference != NULL) { 
    		$xml .= '<ExternalReference>'.$this->external_reference.'</ExternalReference'; 
    	}
    	$xml .= '</Request>';
    	$xml .= '</AutoCreate>';

    	$xml_response = $this->get_xml_response($xml);

		$simpleXMLObject =  new SimpleXMLElement($xml_response);
        $response = $simpleXMLObject->Response;

		$result = array();
		$result['Status'] = (string) $response->Status;
		$result['StatusCode'] = (string) $response->StatusCode;
		$result['StatusMessage'] = (string) $response->StatusMessage;
		$result['TransactionStatus'] = (string) $response->TransactionStatus;
		if (!empty($response->ErrorMessageCode)) {
			$result['ErrorMessageCode'] = (string) $response->ErrorMessageCode;
		}
		if (!empty($response->ErrorMessage)) {
			$result['ErrorMessage'] = (string) $response->ErrorMessage;
		}
		if (!empty($response->TransactionReference)) {
			$result['TransactionReference'] = (string) $response->TransactionReference;
		}
		if (!empty($response->MNOTransactionReferenceId)) {
			$result['MNOTransactionReferenceId'] = (string) $response->MNOTransactionReferenceId;
		}
		if (!empty($response->IssuedReceiptNumber)) {
			$result['IssuedReceiptNumber'] = (string) $response->IssuedReceiptNumber;
		}

		return $result;
    }

    /**
    * Get the current balance of your Yo! Payments Account
    * Returned array contains an array of balances (including airtime)
    * @return array
    */
    public function ac_acct_balance()
    {
    	$xml = '';
    	$xml .= '<?xml version="1.0" encoding="UTF-8"?>';
    	$xml .= '<AutoCreate>';
    	$xml .= '<Request>';
    	$xml .= '<APIUsername>'.$this->username.'</APIUsername>';
    	$xml .= '<APIPassword>'.$this->password.'</APIPassword>';
    	$xml .= '<Method>acacctbalance</Method>';
    	$xml .= '</Request>';
    	$xml .= '</AutoCreate>';

    	$xml_response = $this->get_xml_response($xml);

		$simpleXMLObject =  new SimpleXMLElement($xml_response);
        $response = $simpleXMLObject->Response;

		$result = array();
		$result['Status'] = (string) $response->Status;
		$result['StatusCode'] = (string) $response->StatusCode;
		$balances = array();
		foreach($response->Balance->Currency as $currency){
			$balances[] = array('code'=>(string) $currency->Code, 'balance'=>(string) $currency->Balance); 
		}
		$result['balance'] = $balances;
		if (!empty($response->ErrorMessageCode)) {
			$result['ErrorMessageCode'] = (string) $response->ErrorMessageCode;
		}
		if (!empty($response->ErrorMessage)) {
			$result['ErrorMessage'] = (string) $response->ErrorMessage;
		}

		return $result;
    }

    /**
    * Return an array of transactions which were carried out on your account for a certain period of time
    * @param string $start_date format YYYY-MM-DD HH:MM:SS
    * @param string $end_date  format YYYY-MM-DD HH:MM:SS
    * @param string $transaction_status 
    * Options
    * * "FAILED"
    * * "PENDING"
    * * "INDETERMINATE"
    * * "SUCCEEDED"
    * * "FAILED,SUCCEEDED" (comma separated)
    * @param string $currency_code
    * Options
    * * "UGX-MTNMM" -> Uganda Shillings - MTN Mobile Money
    * * "UGX-WARIDMM" -> Uganda Shillings - Airtel Money
    * * "UGX-MTNAT" -> Uganda Shillings - MTN Airtime
    * * "UGX-WTLAT" -> Uganda Shillings - Warid Airtime
    * * "UGX-OULAT" -> Uganda Shillings - Orange Airtime
    * * "UGX-AIRAT" -> Uganda Shillings - Airtel Airtime
    * @param int $result_set_limit A value of 0 returns all. Default limit = 15 
    * @param string $transaction_entry_designation
    * Options
    * * "TRANSACTION"
    * * "CHARGES"
    * * "ANY"
    * @param string $external_reference Filter using this external_reference
    * @return array
    */
    public function ac_get_ministatement($start_date=NULL, $end_date=NULL, $transaction_status=NULL, $currency_code=NULL, $result_set_limit=NULL, $transaction_entry_designation='ANY', $external_reference=NULL)
    {
    	// Do a string to time formatting to get the date format required
    	$xml = '';
    	$xml .= '<?xml version="1.0" encoding="UTF-8"?>';
    	$xml .= '<AutoCreate>';
    	$xml .= '<Request>';
    	$xml .= '<APIUsername>'.$this->username.'</APIUsername>';
    	$xml .= '<APIPassword>'.$this->password.'</APIPassword>';
    	$xml .= '<Method>acgetministatement</Method>';
    	if($start_date != NULL){
    		$xml .= '<StartDate>'.$start_date.'</StartDate>';
    	}
    	if($end_date != NULL){
    		$xml .= '<EndDate>'.$end_date.'</EndDate>';
    	}
    	if($transaction_status != NULL){
    		$xml .= '<TransactionStatus>'.$transaction_status.'</TransactionStatus>';
    	}
    	if($currency_code != NULL){
    		$xml .= '<CurrencyCode>'.$currency_code.'</CurrencyCode>';
    	}
    	if($result_set_limit != NULL){
    		$xml .= '<ResultSetLimit>'.$result_set_limit.'</ResultSetLimit>';
    	}
    	$xml .= '<TransactionEntryDesignation>'.$transaction_entry_designation.'</TransactionEntryDesignation>';
    	if($external_reference != NULL){
    		$xml .= '<ExternalReference>'.$external_reference.'</ExternalReference>';
    	}
    	$xml .= '</Request>';
    	$xml .= '</AutoCreate>';

		$xml_response = $this->get_xml_response($xml);

		$simpleXMLObject =  new SimpleXMLElement($xml_response);
        $response = $simpleXMLObject->Response;

		$result = array();
		$result['Status'] = (string) $response->Status;
		$result['StatusCode'] = (string) $response->StatusCode;
		$result['TotalTransactions'] = (string) $response->TotalTransactions;
		$result['ReturnedTransactions'] = (string) $response->ReturnedTransactions;
		
		$transactions = array();
        if($response->Transactions->Transaction != null){
            foreach($response->Transactions->Transaction as $transaction){
                $transaction_detail = array();
                $transaction_detail['TransactionSystemId'] = (string) $transaction->TransactionSystemId;
                $transaction_detail['TransactionReference'] = (string) $transaction->TransactionReference;
                $transaction_detail['TransactionStatus'] = (string) $transaction->TransactionStatus;
                $transaction_detail['InitiationDate'] = (string) $transaction->InitiationDate;
                $transaction_detail['CompletionDate'] = (string) $transaction->CompletionDate;
                $transaction_detail['NarrativeBase64'] = (string) $transaction->NarrativeBase64[0];
                $transaction_detail['Currency'] = (string) $transaction->Currency;
                $transaction_detail['Amount'] = (string) $transaction->Amount;
                $transaction_detail['Balance'] = (string) $transaction->Balance;
                $transaction_detail['GeneralType'] = (string) $transaction->GeneralType;
                $transaction_detail['DetailedType'] = (string) $transaction->DetailedType;
                if(!empty($transaction->BeneficiaryMsisdn)){
                    $transaction_detail['BeneficiaryMsisdn'] = (string) $transaction->BeneficiaryMsisdn;
                }
                $transaction_detail['BeneficiaryBase64'] = (string) $transaction->BeneficiaryBase64;
                if(!empty($transaction->SenderMsisdn)){
                    $transaction_detail['SenderMsisdn'] = (string) $transaction->SenderMsisdn;
                }
                $transaction_detail['SenderBase64'] = (string) $transaction->SenderBase64;
                if(!empty($transaction->Base64TransactionExternalReference)){
                    $transaction_detail['Base64TransactionExternalReference'] = (string) $transaction->Base64TransactionExternalReference;
                }
                $transaction_detail['TransactionEntryDesignation'] = (string) $transaction->TransactionEntryDesignation;
                
                $transactions[] = $transaction_detail;
            }
        }
		$result['Transactions'] = $transactions;

		if (!empty($response->ErrorMessageCode)) {
			$result['ErrorMessageCode'] = (string) $response->ErrorMessageCode;
		}
		if (!empty($response->ErrorMessage)) {
			$result['ErrorMessage'] = (string) $response->ErrorMessage;
		}

		return $result;
    }

    /**
    * Send airtime to a mobile phone user
    * @param string $msisdn the mobile phone number in the format 256772123456
    * @param int $amount the amount of airtime to be sent to the mobile user
    * @param string $narrative textual narrative about the transfer
    * @return array
    */
    public function ac_send_airtime_mobile($msisdn, $amount, $narrative)
    {
    	$xml = '';
    	$xml .= '<?xml version="1.0" encoding="UTF-8"?>';
    	$xml .= '<AutoCreate>';
    	$xml .= '<Request>';
    	$xml .= '<APIUsername>'.$this->username.'</APIUsername>';
    	$xml .= '<APIPassword>'.$this->password.'</APIPassword>';
    	$xml .= '<Method>acsendairtimemobile</Method>';
    	$xml .= '<NonBlocking>'.$this->NonBlocking.'</NonBlocking>';
    	$xml .= '<Account>'.$msisdn.'</Account>';
    	$xml .= '<Amount>'.$amount.'</Amount>';
    	$xml .= '<Narrative>'.$narrative.'</Narrative>';
    	if( $this->external_reference != NULL ){ $xml .= '<ExternalReference>'.$this->externalReference.'</ExternalReference>'; }
    	if( $this->internal_reference != NULL ) { $xml .= '<InternalReference>'.$this->internal_reference.'</InternalReference'; }
    	if( $this->provider_reference_text != NULL ){ $xml .= '<ProviderReferenceText>'.$this->provider_reference_text.'</ProviderReferenceText>'; }
    	$xml .= '</Request>';
    	$xml .= '</AutoCreate>';

		$xml_response = $this->get_xml_response($xml);

		$simpleXMLObject =  new SimpleXMLElement($xml_response);
        $response = $simpleXMLObject->Response;

		$result = array();
		$result['Status'] = (string) $response->Status;
		$result['StatusCode'] = (string) $response->StatusCode;
		$result['StatusMessage'] = (string) $response->StatusMessage;
		$result['TransactionStatus'] = (string) $response->TransactionStatus;
		if ($response->ErrorMessageCode != null) {
			$result['ErrorMessageCode'] = (string) $response->ErrorMessageCode;
		}
		if ($response->ErrorMessage != null) {
			$result['ErrorMessage'] = (string) $response->ErrorMessage;
		}
		if ($response->TransactionReference != null) {
			$result['TransactionReference'] = (string) $response->TransactionReference;
		}
		if ($response->MNOTransactionReferenceId != null) {
			$result['MNOTransactionReferenceId'] = (string) $response->MNOTransactionReferenceId;
		}
		if ($response->IssuedReceiptNumber != null) {
			$result['IssuedReceiptNumber'] = (string) $response->IssuedReceiptNumber;
		}

		return $result;
    }

    /**
    * Send airtime from your Yo! Payments account to another Yo! Payments user account
    * @param string $currency_code
    * Options
    * * "UGX-MTNAT" -> Uganda Shillings - MTN Airtime
    * * "UGX-WTLAT" -> Uganda Shillings - Warid Airtime
    * * "UGX-OULAT" -> Uganda Shillings - Orange Airtime
    * * "UGX-AIRAT" -> Uganda Shillings - Airtel Airtime
    * @param int $amount the amount of airtime to be sent to the beneficiary Yo! Payments User
    * @param int $beneficiary_account
    * @param string $beneficiary_email 
    * @param string $narrative textual narrative about the transfer
    * @return array
    */
    public function ac_send_airtime_internal($currency_code, $amount, $beneficiary_account, $beneficiary_email, $narrative)
    {
    	$xml = '';
    	$xml .= '<?xml version="1.0" encoding="UTF-8"?>';
    	$xml .= '<AutoCreate>';
    	$xml .= '<Request>';
    	$xml .= '<APIUsername>'.$this->username.'</APIUsername>';
    	$xml .= '<APIPassword>'.$this->password.'</APIPassword>';
    	$xml .= '<Method>acsendairtimeinternal</Method>';
    	$xml .= '<CurrencyCode>'.$currency_code.'</CurrencyCode>';
    	$xml .= '<Amount>'.$amount.'</Amount>';
    	$xml .= '<BeneficiaryAccount>'.$beneficiary_account.'</BeneficiaryAccount>';
    	$xml .= '<BeneficiaryEmail>'.$beneficiary_email.'</BeneficiaryEmail>';
    	$xml .= '<Narrative>'.$narrative.'</Narrative>';
    	if($this->internal_reference != NULL) { 
    		$xml .= '<InternalReference>'.$this->internal_reference.'</InternalReference'; 
    	}
    	if($this->external_reference != NULL) { 
    		$xml .= '<ExternalReference>'.$this->external_reference.'</ExternalReference'; 
    	}
    	$xml .= '</Request>';
    	$xml .= '</AutoCreate>';

    	$xml_response = $this->get_xml_response($xml);

		$simpleXMLObject =  new SimpleXMLElement($xml_response);
        $response = $simpleXMLObject->Response;

		$result = array();
		$result['Status'] = (string) $response->Status;
		$result['StatusCode'] = (string) $response->StatusCode;
		$result['StatusMessage'] = (string) $response->StatusMessage;
		$result['TransactionStatus'] = (string) $response->TransactionStatus;
		if ($response->ErrorMessageCode != null) {
			$result['ErrorMessageCode'] = (string) $response->ErrorMessageCode;
		}
		if ($response->ErrorMessage != null) {
			$result['ErrorMessage'] = (string) $response->ErrorMessage;
		}
		if ($response->TransactionReference != null) {
			$result['TransactionReference'] = (string) $response->TransactionReference;
		}
		if ($response->MNOTransactionReferenceId != null) {
			$result['MNOTransactionReferenceId'] = (string) $response->MNOTransactionReferenceId;
		}
		if ($response->IssuedReceiptNumber != null) {
			$result['IssuedReceiptNumber'] = (string) $response->IssuedReceiptNumber;
		}

		return $result;
    }

    /**
    * Verify the validity of a given mobile money account
    * @param string $msisdn the mobile phone number in the format 256772123456
    * @return boolean true if valid
    */
    public function ac_verify_account_validity($msisdn)
    {
    	$xml = '';
    	$xml .= '<?xml version="1.0" encoding="UTF-8"?>';
    	$xml .= '<AutoCreate>';
    	$xml .= '<Request>';
    	$xml .= '<APIUsername>'.$this->username.'</APIUsername>';
    	$xml .= '<APIPassword>'.$this->password.'</APIPassword>';
    	$xml .= '<Method>acverifyaccountvalidity</Method>';
    	$xml .= '<Account>'.$msisdn.'</Account>';
    	$xml .= '</Request>';
    	$xml .= '</AutoCreate>';

    	$xml_response = $this->get_xml_response($xml);

		$simpleXMLObject =  new SimpleXMLElement($xml_response);
        $response = $simpleXMLObject->Response;

		$isValid = false;

		if($response->Status == 'OK'){
			if($response->Valid == 'TRUE'){
				$isValid = true;
			}else {
				$isValid = false;
			}
		}

		return $isValid;
    }

    public function ac_get_msisdn_kyc_info()
    {
        // To be done later
    }

    public function ac_get_msisdn_mm_balance()
    {
        // To be done later
    }

    public function receive_payment_notification()
    {
        $verification_status = false;
        
        if($this->verify_payment_notification()){
            $verification_status = true;
        }

        return array(
            'is_verified' => $verification_status,
            'date_time' => $_POST['date_time'],
            'amount' => $_POST['amount'],
            'narrative' => $_POST['narrative'],
            'network_ref' => $_POST['network_ref'],
            'external_ref' => $_POST['external_ref'],
            'msisdn' => $_POST['msisdn']
        );
    }

    public function receive_payment_failure_notification()
    {
        $verification_status = false;
        
        if($this->verify_payment_failure_notification()){
            $verification_status = true;
        }
        
        return array(
            'is_verified' => $verification_status,
            'failed_transaction_reference' => $_POST['failed_transaction_reference'],
            'transaction_init_date' => $_POST['transaction_init_date']
        );
    }

    protected function get_xml_response($xml)
    {
        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $this->YOURL);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 120);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($soap_do, CURLOPT_VERBOSE, false);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, array('Content-Type: text/xml','Content-transfer-encoding: text','Content-Length: '.strlen($xml)));

        $xml_response = curl_exec($soap_do);
        curl_close($soap_do);

        return $xml_response;
    }

    protected function verify_payment_notification()
    {
        $post_data = file_get_contents('php://input');
        $data = $_POST['date_time'].$_POST['amount'].$_POST['narrative'].$_POST['network_ref'].$_POST['external_ref'].$_POST['msisdn'];

        $signature = base64_decode($_POST['signature']);
        $fh = fopen($this->public_key_file, 'r');
        if($fh === FALSE) {
            return false;
        }

        $key = fread($fh, 8192);
        fclose($fh);
        $key_id = openssl_pkey_get_public($key);
        $verified = openssl_verify($data, $signature, $key_id);
        openssl_free_key($key_id);

        if($verified == 1){
            return true;
        }

        return false;
    }

    protected function verify_payment_failure_notification()
    {
       $post_data = file_get_contents('php://input');
        $data = $_POST['failed_transaction_reference'].$_POST['transaction_init_date'];

        $signature = base64_decode($_POST['verification']);
        $fh = fopen($this->public_key_file, 'r');
        if($fh === FALSE) {
            return false;
        }

        $key = fread($fh, 8192);
        fclose($fh);
        $key_id = openssl_pkey_get_public($key);
        $verified = openssl_verify($data, $signature, $key_id);
        openssl_free_key($key_id);

        if($verified == 1){
            return true;
        }

        return false; 
    }
}
