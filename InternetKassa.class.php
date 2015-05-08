<?php

require_once('IK_Object.class.php');

class InternetKassa extends IK_Object {

   #const omgevingen = array('test', 'prod');
    
    protected $_internetkassa_url = 'https://internetkassa.abnamro.nl/Ncol/%s/orderstandard.asp';
    protected $_accept_url;
    protected $_decline_url;
    protected $_exception_url;
    protected $_cancel_url;
    protected $_template_url;
    protected $_logo_url = 'http://www.dexonlineservices.nl/images/logo.gif';
    protected $_home_url;
    protected $_catalog_url;
    
    protected $_payment_method;
    protected $_creditcard_brand;
    protected $_secret = INTERNETKASSA_SECRET;
    
    protected $_pspid;
    protected $_order_id;
    protected $_order_description;
    protected $_order_amount;
    protected $_currency = 'EUR';
    protected $_language = 'nl_NL';
    
    protected $_customer_name;
    protected $_customer_email;
    protected $_customer_zipcode;
    protected $_customer_address;
    protected $_customer_country;
    protected $_customer_town;
    protected $_customer_telephonenumber;
    
    protected $_operation = 'SAL'; //RES of SAL
    
    public $strict = true;
    protected $_omgeving =INTERNETKASSA_ENVIROMENT ;

    public function  __construct($pspid) {
    	return $this->pspid = $pspid;
    }
    
    public function get_signature() {
    	return sha1($this->order_id . $this->order_amount . $this->currency . $this->pspid . $this->operation . $this->secret);
    }
    
    public function form() {
        require_once('IK_Form.class.php');
    	$form = new IK_Form($this);
    	$form->PSPID = $this->pspid;
    	
    	$form->orderID = $this->order_id;
    	$form->COM = $this->order_description;
    	
    	$form->amount = $this->order_amount;
    	$form->currency = $this->currency;
    	$form->language = $this->language;
    	
    	$form->CN = $this->customer_name;
    	$form->EMAIL = $this->customer_email;
    	$form->ownerZIP = $this->customer_zipcode;
    	$form->owneraddress = $this->customer_address;
    	$form->ownercty = $this->customer_country;
    	$form->ownertown = $this->customer_town;
    	$form->ownertelno = $this->customer_telephonenumber;
    	
    	$form->LOGO = $this->logo_url;
    	$form->TP = $this->template_url;
    	$form->PM = $this->payment_method;
    	$form->BRAND = $this->creditcard_brand;
    	$form->PMLIST = null;
    	$form->PMListType = null;
    	
    	$form->homeurl = $this->home_url;
    	$form->catalogurl = $this->catalog_url;
    	$form->accepturl = $this->accept_url;
    	$form->declineurl = $this->decline_url;
    	$form->exceptionurl = $this->exception_url;
    	$form->cancelurl = $this->cancel_url;
    	
    	$form->operation = $this->operation;
    	
    	return $form;
    }
    
    public function get_internetkassa_url() {
    	return sprintf($this->_internetkassa_url, $this->omgeving);
    }
    
    public function redirect() {
    	$parameters = $this->form()->as_get();
    	$url = $this->internetkassa_url . '?' . $parameters;
    	
    	if (!headers_sent()) {    //If headers not sent yet... then do php redirect
    		header("Location: $url");
    	} else {
    		echo '<script type="text/javascript">';
    		echo 'window.location.href="' . $url . '";';
    		echo '</script>';
    		echo '<noscript>';
    		echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
    		echo '</noscript>';
    	}
    }
}

?>
