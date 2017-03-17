<?php

$message=$_POST['message_signalement'];
$type=$_POST['type'];
$adresse=$_POST['produit_signal'];

if(!empty($_POST))
{
  $sentfrom=htmlentities("signalement@upcircus.fr");
  $name=htmlentities("Signlement Upcircus");
  $com=htmlentities($message);
  $headers = 'From: '.$sentfrom.''."\r\n" .
     'Reply-To: '.$sentfrom.'' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
  mail('contact@upcircus.fr','Signalement de produit sur Upcircus.fr',utf8_decode("Bonjour, le produit à l'adresse suivante http://www.upcircus.fr/".$type.".php?id=".$adresse." est signalé par un utilisateur. Message fourni :  \n  \n ".$com),$headers);
  echo 'La modération du site a été avertie de votre signalement. ';
}
?>