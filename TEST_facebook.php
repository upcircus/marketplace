<?php
use Facebook\FacebookRedirectLoginHelper;


require 'vendor/autoload.php';

$appId="544096645775357";
$appSecret="9b160fa09f82c98329a77167e6204989";

FacebookSession::setDefaultApplication($appId,$appSecret);

$helper = new FacebookRedirectLoginHelper('http://localhost/upcircus/moteur/TEST_facebook.php');

echo $helper->getLoginUrl();



