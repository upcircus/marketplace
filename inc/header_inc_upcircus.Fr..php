<?php

if(session_status() == PHP_SESSION_NONE)
{
  session_start();
}

require_once 'inc/functions.php';
if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password']))
{
  require_once 'inc/db.php';
  $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
  $req->execute(['username' => $_POST['username']]);
  $user = $req->fetch();
  
  if(password_verify($_POST['password'],$user->password))
  {
    $_SESSION['auth']=$user;
    $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté au site';
    if($_POST['remember'])
    {
      $remember_token = str_random(250);
      $pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
      setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id .'ratonlaveurs'), time()+60*60*24*7);
    }
 
header('Location: '.$_SERVER['PHP_SELF']);
    exit();
  }
  else
  {
    $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
  }
}
?>




<!DOCTYPE html>
<html xmlns="http;..www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>UPCIRCUS.fr </title>
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="app.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src ="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.css"></script>
        <script src ="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.js"></script>
	<link href="css/bootstrap-lightbox.min.css" rel="stylesheet" media="screen">
	<script src="js/bootstrap-lightbox.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function ($) {

				// delegate calls to data-toggle="lightbox"
				$(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
					event.preventDefault();
					return $(this).ekkoLightbox();

				});


				});
				
				
		</script>



      <!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html.js"></script>
      <![endif]-->

      <style>
	.carousel-inner > .item > img,
	.carousel-inner > .item > a > img {
	width: 70%;
	margin: auto;
	}
      </style>
    </head>
    <body>
    <header class="header">
    
    <div class="l-container">

    
    
     <nav class="menu">

    <div class="navbar-header">
      <a class="header-logo" href="index.php">
	<img src="img/menu-logo-upcircus.png">
      </a>
    </div>
    <ul class="nav navbar-nav">
      <div class="sep"><img src="img/separator_menu.png"></div> 
      <li class="active"><a href="#"><img src="img/menu-rechercher.png"/>&nbsp;Rechercher</a></li>
      <div class="sep"><img src="img/separator_menu.png"></div> 
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="img/menu-contribuer.png"/>&nbsp;Contribuer
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Ajouter un tutoriel</a></li>
          <li><a href="#">Ajouter une idée</a></li>
          <li><a href="#">Ajouter un recyclage</a></li>
          <li><a href="#">Vos contributions</a></li>
        </ul>
      </li>
      <div class="sep"><img src="img/separator_menu.png"></div>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="img/menu-reseau.png"/>&nbsp;Réseau upcircus
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Qu'est ce que le réseau Upcircus</a></li>
          <li><a href="#">Devenir Membre</a></li>
          <li><a href="#">Tous les membres</a></li>
        </ul>
      </li>
      
      <div class="sep"><img src="img/separator_menu.png"></div> 
    </ul>
        <ul class="nav navbar-nav navbar-right">
        <div class="sep"><img src="img/separator_menu.png"></div> 
      <li><a href="#"><img src="img/menu-home.png"></a></li>
      <div class="sep"><img src="img/separator_menu.png"></div> 
      <li>
       <?php if(isset($_SESSION['auth'])): ?>
       <li class="dropdown">
	  <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Bonjour <?php echo($_SESSION['auth']->username); ?>        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="account.php">Tableau de bord</a></li>
          <li><a href="logout.php">Se déconnecter</a></li>
        </ul></a>
	  <?php else: ?>
	  <li class="dropdown">
	  <a href="connexion_rapide.php" data-toggle="lightbox" data-title="Connexion Rapide">Se connecter <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="toto.php">S'inscrire</a></li>
        </ul>
        </li>
	  <?php endif; ?>
      </li>
      <div class="sep"><img src="img/separator_menu.png"></div> </ul>

</nav>

	<nav class="sousmenu">
	<div class="sousmenu-contain">
	  <a href="#" class="sousmenu-item"><img src="img/sousmenu-info.png" />Upcircus c'est quoi</a>
	  <a href="#" class="sousmenu-item"><img src="img/sousmenu-contacteznous.png"/>&nbsp;Contactez-nous</a>
	  <id class="sousmenu-item">Reseaux sociaux : &nbsp;<a href="#"><img src="img/sousmenu-fb.png"/></a>&nbsp;
	  <a href="#"><img src="img/sousmenu-twit.png"/></a>&nbsp;
	  <a href="#"><img src="img/sousmenu-pint.png"/></a>&nbsp;
	  <a href="#"><img src="img/sousmenu-gplus.png"/></a>&nbsp;
	  </id>
	  </div>
	</nav>    
	<div class="cb"></div>
    
    
    

    </header>

        <?php if(isset($_SESSION['flash'])): ?>
    <?php foreach($_SESSION['flash'] as $type => $message): ?>
    <div class="alert alert-<?= $type ?> ">
      <?= $message ?>
    </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>






