<?php

class IK_form extends IK_object {
	
	protected $_internetkassa;
	
	//General parameters: see chapter 5.2
	public $PSPID;
	public $orderID;
	public $amount;
	public $currency = 'EUR';
	public $language = 'nl_NL';
	
	//Optional customer details, highly recommended for fraud prevention:
	//see chapter 5.2
	public $CN;
	public $EMAIL;
	public $ownerZIP;
	public $owneraddress;
	public $ownercty;
	public $ownertown;
	public $ownertelno;
	public $COM; //order description
	
	//check before payment: see chapter 6.2
	public $SHASign;
	
	//Layout information: see chapter 7.1
	public $LOGO;
	
	//Dynamic template page: see chapter 7.2
	public $TP;
	
	//Payment methods/page specifics: see chapter 9.1
	public $PM;
	public $BRAND;
	public $WIN3DS;
	public $PMLIST;
	public $PMListType;
	
	//Link to your website: see chapter 8.1
	public $homeurl;
	public $catalogurl;
	
	//Post payment parameters: see chapter 8.2
	public $COMPLUS;
	public $PARAMPLUS;
	
	//Post payment paramters: see chapter 8.3
	public $PARAMVAR;
	
	//Post payment redirection: see chapter 8.2
	public $accepturl;
	public $declineurl;
	public $exceptionurl;
	public $cancelurl;
	
	//Optional operation field: see chapter 9.2
	public $operation;
	
	//Optional extra login detail field: see chapter 9.3
	public $USERID;
	
	public function __construct($internetkassa) {
		$this->_internetkassa = $internetkassa;
	}
	
	public function as_get() {
		$params = '';
		
		foreach ($this->public_vars() as $key => $value) {
			$key = urlencode($key);
			$value = urlencode($value);
			$params[] = "$key=$value";
		}
		
		return implode('&', $params);
	}
	
    public function show() { ?>
    
		<form method="POST" action="<?= $this->_internetkassa->internetkassa_url; ?>" id="idealForm" name="idealForm">
			
			<?php foreach ($this->public_vars() as $name => $value) { ?>
				<?php if ($name == 'strict') { ?>
					<?php continue; ?>
				<?php } ?>
				
				<input type="hidden" name="<?= $name; ?>" value="<?= $value; ?>" />
			<?php } ?>
			
			<input type="submit" class="button" id="idealSubmit" name="idealSubmit" value="Akkoord" />
		
		</form>
		
		<?php if ($autosubmit) { ?>
		<script type="text/javascript" language="javascript">
			form = document.getElementById('idealForm');
			form.submit();
		</script>
    
    	<?php
		}
    }
}

?>