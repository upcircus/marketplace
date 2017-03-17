<?php

$nom=$_POST['name_contact'];
$email=$_POST['email_contact'];
$message=$_POST['message_contact'];

if(!empty($_POST))
{
  $sentfrom=htmlentities($email);
  $name=htmlentities($nom);
  $com=htmlentities($message);
  $headers = 'From: '.$sentfrom.''."\r\n" .
     'Reply-To: '.$sentfrom.'' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
  mail('contact@upcircus.fr','Message via le formulaire Upcircus.fr',utf8_decode("Bonjour, \n ".$name." a écrit :  \n  \n ".$com),$headers);
  echo 'Le formulaire a bien été envoyé';
}
?>