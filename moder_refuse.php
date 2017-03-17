<!DOCTYPE html>
<html xmlns="http;..www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <body>
<?php
require 'inc/functions.php'; 
logged_only("moder_refuse.php");

require_once 'inc/db.php';

$req = $pdo->prepare("SELECT * FROM contribution WHERE id= ?");
$req->execute([$_POST['id']]);


if($_SESSION['auth']->status == 'moderateur'){
while($data = $req->fetch())
	{
	  $req2= $pdo->prepare("SELECT * FROM users WHERE username = ?");
	  $req2->execute([$data->contributeur]);	

	  
	    $req = $pdo->prepare("DELETE FROM contribution WHERE id=?");
	    $req->execute([$_POST['id']]);
	    
	  while($data2 = $req2->fetch())
	  {
	    mail($data2->email,
	    'Refus de votre contribution sur Upcircus.fr',
	     utf8_decode("Bonjour, \n Votre contribution \"".$data->titre."\" n'a pas été validé par la modération du site. \n Les raisons du refus sont les suivantes : \n\"".$_POST['raison_send']."\".\n 
	    \nAfin de vous assurer de la publication de votre contribution, merci de respecter les conditions générales d'utilisations. \n
	    Sincères salutations. \n L'équipe Upcircus.fr"));
	  };
	};
}	
	

?>