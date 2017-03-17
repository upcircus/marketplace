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
      <h3 class="text-center"><strong>Contactez-Nous</strong></h3>
      <strong><div class="text-center">N'hésitez pas à nous écrire pour obtenir plus d'informations, pour remonter un bug sur le site ou simplement parce que vous avez besoin de parler ! <br />Nous nous ferons une joie de vous répondre ! </strong></div><br />
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
  mail('contact@upcircus.fr','Un message via le formulaire Upcircus.fr',
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