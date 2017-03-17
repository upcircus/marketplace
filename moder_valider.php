<?php
require 'inc/functions.php'; 
logged_only("moder_valider.php");

require_once 'inc/db.php';


$req = $pdo->prepare("SELECT * FROM contribution WHERE id= ?");
//$req->execute(['85']);
$req->execute([$_POST['id']]);


while($data = $req->fetch())
	{
	  $req2= $pdo->prepare("SELECT * FROM users WHERE username = ?");
	  $req2->execute([$data->contributeur]);	

	  while($data2 = $req2->fetch())
	      { 
		if($_SESSION['auth']->status == 'moderateur'){
		  $req3 = $pdo->prepare("UPDATE contribution SET valide='oui' WHERE id= ?");
		  $req3->execute([$_POST['id']]);
		
		  mail($data2->email,
		  'Acceptation de votre contribution sur Upcircus.fr',
		  utf8_decode("Bonjour,\nVotre contribution \"".$data->titre."\" a été validé par la modération du site. \nVous pouvez dès à présent la retrouver sur Upcircus.fr.\n 
		  \nSincères salutations. \nL'équipe Upcircus.fr"),'From: Modération Upcircus.fr <no-reply@upcircus.fr>'. "\r\n" .
     'Reply-To: no-reply@upcircus.fr');
		}
	      };
	};
	
	

?>