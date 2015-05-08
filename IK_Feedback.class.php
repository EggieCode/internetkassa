<?php

require_once('IK_Object.class.php');

class IK_Feedback extends IK_Object {

	public $AAVADDRESS;
	public $AAVCHECK;
	public $AAVMAIL;
	public $AAVNAME;
	public $AAVPHONE;
	public $AAVZIP;
	public $ACCEPTANCE;
	public $ALIAS;
	public $AMOUNT;
	public $BIC;
	public $BIN;
	public $BRAND;
	public $CARDNO;
	public $CCCTY;
	public $CN;
	public $COLLECTOR_BIC;
	public $COLLECTOR_IBAN;
	public $COMPLUS;
	public $CREATION_STATUS;
	public $CREDITDEBIT;
	public $CURRENCY;
	public $CVCCHECK;
	public $DCC_COMMPERCENTAGE;
	public $DCC_CONVAMOUNT;
	public $DCC_CONVCCY;
	public $DCC_EXCHRATE;
	public $DCC_EXCHRATESOURCE;
	public $DCC_EXCHRATETS;
	public $DCC_INDICATOR;
	public $DCC_MARGINPERCENTAGE;
	public $DCC_VALIDHOURS;
	public $DEVICEID;
	public $DIGESTCARDNO;
	public $ECI;
	public $ED;
	public $EMAIL;
	public $ENCCARDNO;
	public $FXAMOUNT;
	public $FXCURRENCY;
	public $IP;
	public $IPCTY;
	public $MANDATEID;
	public $MOBILEMODE;
	public $NBREMAILUSAGE;
	public $NBRIPUSAGE;
	public $NBRIPUSAGE_ALLTX;
	public $NBRUSAGE;
	public $NCERROR;
	public $ORDERID;
	public $PAYID;
	public $PAYMENT_REFERENCE;
	public $PM;
	public $SCO_CATEGORY;
	public $SCORING;
	public $SEQUENCETYPE;
	public $SIGNDATE;
	public $STATUS;
	public $SUBBRAND;
	public $SUBSCRIPTION_ID;
	public $TRXDATE;
	public $VC;
	
	public $SHASIGN;

	public function bind($array) {
		$vars = $this->vars();
		foreach ($array as $key => $value) {
			$key = strtoupper($key);
			try {
				$this->$key = $value;
			} catch (Exception $e) {


				continue;
			}
		}

		if ($this->getSHASign() != $this->SHASIGN) {
			throw new Exception("SHASIGN Is niet gelijk. Check op hacks!");
		}
	}

	private function getSHASign() {
		$data = array();
		foreach ($this->vars() as $key => $value) {

			$key = strtoupper($key);
			if (in_array($key, array("SHASIGN", "STRICT")) || $value == "" || is_array($value))
				continue;
			$data[] = strtoupper($key) . "=" . $value . INTERNETKASSA_SECRET;
		}

		sort($data);
		return strtoupper(sha1(implode("", $data)));
	}

}
