<?php

require_once('config.php');
require_once('object.php');

class IK_feedback extends IK_object {
	
	protected $_order_id;
	protected $_amount;
	protected $_currency;
	protected $_payment_method;
	protected $_acceptance_code;
	protected $_status;
	protected $_card_number;
	protected $_payment_id;
	protected $_error_code;
	protected $_card_brand;
	protected $_expiry_date;
	protected $_transaction_date;
	protected $_customer_name;
	protected $_signature;
	protected $_customer_country;
	protected $_ip_address;
	
	protected $_secret = InternetkassaConfig::secret_out;
	
	public function bind($array) {
		$vars = $this->vars();
		
		foreach ($array as $key => $value) {
			try {
				$this->$key = $value;
			} catch (Exception $e) {
				continue;
			}
		}
		
		if ($this->wanted_signature() != $this->signature) {
			throw new Exception('De signatures kloppen niet!', 2);
		}
	}
	
	public function wanted_signature() {
		return strtoupper(sha1($this->order_id . $this->currency . $this->amount . $this->payment_method
		. $this->acceptance_code . $this->status . $this->card_number . $this->payment_id
		. $this->error_code . $this->card_brand . $this->secret));
	}
	
	public function set_orderID($orderID) {
		$this->order_id = $orderID;
	}
	
	public function set_PM($PM) {
		$this->payment_method = $PM;
	}

	public function set_ACCEPTANCE($ACCEPTANCE) {
		$this->acceptance_code = $ACCEPTANCE;
	}
	
	public function set_STATUS($STATUS) {
		$this->status = $STATUS;
	}
	
	public function set_CARDNO($CARDNO) {
		$this->card_number = $CARDNO;
	}
	
	public function set_PAYID($PAYID) {
		$this->payment_id = $PAYID;
	}
	
	public function set_NCERROR($NCERROR) {
		$this->error_code = $NCERROR;
	}
	
	public function set_BRAND($BRAND) {
		$this->card_brand = $BRAND;
	}
	
	public function set_ED($ED) {
		$this->expiry_date = $ED;
	}
	
	public function set_TRXDATE($TRXDATE) {
		$this->transaction_date = $TRXDATE;
	}
	
	public function set_CN($CN) {
		$this->customer_name = $CN;
	}
	
	public function set_SHASIGN($SHASIGN) {
		$this->signature = $SHASIGN;
	}
	
	public function set_CCCTY($CCCTY) {
		$this->customer_country = $CCCTY;
	}
	
	public function set_IP($IP) {
		$this->ip_address = $IP;
	}
}

?>