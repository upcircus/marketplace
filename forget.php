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
  <body class="fond-kraft" onload="document.getElementById('email').focus()">
    <div class="container-fluid">
  <?php 
session_start();

if(!empty($_POST) && !empty($_POST['email']))
{

  require_once 'inc/db.php';
  require_once 'inc/functions.php';
  $req = $pdo->prepare('SELECT * FROM users WHERE (email = :email) AND confirmed_at IS NOT NULL');
  $req->execute(['email' => $_POST['email']]);
  $user = $req->fetch();
  
  if($user)
  {
   
    $reset_token=str_random(60);
    $pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
    echo 'Les instructions du rappel de mot de passe vous ont été envoyé par email<br ><br /><a href="#"  onClick ="parent.$.fancybox.close();">Fermer cette fenêtre</a>';
    $sentfrom="no-reply@upcircus.fr";
    $headers = 'From: '.$sentfrom.''."\r\n" .
	'Reply-To: '.$sentfrom.'' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
    mail($_POST['email'],'Réinitialisation de votre mot de passe',"Bonjour, \n Afin de réinitialiser votre votre mot de passe, merci de cliquer sur ce lien\n\nhttp://upcircus.fr/reset.php?id={$user->id}&token=$reset_token \n\nCordialement, \n\n L'equipe Upcircus.fr",$headers);
    exit();
  }
  else
  {
    echo 'Aucun compte ne correspond à cette adresse';
  }
}


?>



      <h3 class="text-center"><strong>Mot de passe oublié</strong></h3>
      <strong><div class="text-center">Merci de remplir le formulaire pour recevoir un lien qui réinitialisera votre mot de passe. <br />
      <form action="" method="POST">
	<div class="form-group">
	    <label for ="">Email</label>
	    <input type="email" name ="email" id="email" class = "form-control"/>
	</div>
	<button type="submit" class="btn btn-primary">Réinitialiser mot de passe</button>
      </form>
    </div>
  <body>
  </html>