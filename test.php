<?php

require_once('internetkassa.php');

$ik = new InternetKassa('silverpower');
//$ik->accept_url = 'http://www.tweakers.net';
//$ik->accept_url = 'http://localhost/~leon/internetkassa/test.php';
$ik->order_id = 1 . '::' . date('Ymd::His');
$ik->order_description = 'Gewoon een test van Tim_online';
$ik->order_amount = 100;

$ik->customer_name = 'Leon Bogaert';
$ik->customer_email = 'leon@tim-online.nl';
$ik->customer_zipcode = '4824AT';
$ik->customer_address = 'Weidehek 121';
$ik->customer_town = 'Breda';
$ik->customer_country = 'NL'; //iso code
$ik->customer_telephonenumber = '076-502 32 22';

//$ik->redirect();
$ik->form()->show();

?>