<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>UPCIRCUS.fr </title>
<!-- Bootstrap -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Fin bootstrap -->

<!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
<!-- Fin CSS -->
  </head>
  <body class="fond-kraft">


    <div class="container-fluid">
      <h3 class="text-center"><strong>Donnez votre avis !</strong></h3>
      <strong><div class="text-center">Upcircus est une structure qui se monte et qui cherche à progresser ! N'hésitez pas à nous donner votre avis, si vous avez des idées à nous faire part, que selon vous il manque quelque chose ! On lira vos commentaire avec attention pour répondre au mieux aux éxigences de tous les utilisateurs. Notre but est de rendre service de façon à limiter les déchets, alors tous les coups de pouce sont bienvenus !</strong></div><br />
      <div class="green-highlight text-center">
      Aussi vous pouvez nous écrire depuis votre messagerie préférée via notre e-mail : <a href="mailto:contact@upcircus.fr">contact@upcircus.fr</a>
      </div><br />
<?php
if(isset($_POST['submit']))
{
  $sentfrom=htmlentities($_POST['email']);
  $name=htmlentities($_POST['nom']);
  $com=htmlentities($_POST['message']);
  $headers = 'From: '.$sentfrom.''."\r\n" .
     'Reply-To: '.$sentfrom.'' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
  mail('contact@upcircus.fr','Avis sur Upcircus.fr',
	utf8_decode("Bonjour, \n ".$name." a écrit :  \n  \n ".$com),$headers);
	      
	      echo 'Le formulaire a bien été envoyé';
}
?>
      <div class="form-group">
	<form method="POST" action="contact.php">
	  <label>Votre nom : </label>
	  <input type="text" class="form-control" name="nom" placeholder="Jean Dupond">
	  <label>Votre email pour vous répondre : </label>
	  <input type="email" class="form-control" name="email" placeholder="monadresse@fournisseur">
	  <label>Votre message : </label>
	  <textarea class="form-control" name="message" placeholder="mon message..."></textarea>
	  <br />
	  <input type="submit" class="btn btn-primary" value="Envoyer !" name="submit">
	</form>
      </div>
    </div>
  <body>
  </html>