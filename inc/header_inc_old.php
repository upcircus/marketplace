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
      <a href="#" class="header-logo">
	<img src="img/menu-logo-upcircus.png">
      </a>
	<nav class="menu">
	<div class="sep"><img src="img/separator_menu.png"></div> 
	  <div class= "menu-item"><a href="#"><div class="menu-bg"><div class="menu-item-height"><img src="img/menu-rechercher.png"/>&nbsp;Recherche</div></div></a></div>
	  <div class="sep"><img src="img/separator_menu.png"></div>
	  
	  <div id="un">
	  
	    <div class= "menu-item"><a href="#"><div class="menu-bg"><div class="menu-item-height"><img src="img/menu-contribuer.png"/>&nbsp;Contribuer</div></div></a></div>
	  
	  </div>
	  
	  <div id="deux">
	    <x2>TOTO1</x2><br />
	    <x2>TOTO2</x2>
	  </div>
	  
	  <div class="sep"><img src="img/separator_menu.png"></div>
	  <div class= "menu-item"><a href="#"><div class="menu-bg"><div class="menu-item-height"><img src="img/menu-reseau.png"/>&nbsp;Réseau upcircus</div></div></a></div>
	  <div class="sep"><img src="img/separator_menu.png"></div>
	  <div class="header-comptehome">
	    <div class="sep"><img src="img/separator_menu.png"></div>
	    <div class= "menu-item"><a href="#"><div class="menu-bg2"><div class="menu-item-height"><img src="img/menu-home.png"></div></div></a></div>
	    <div class="sep"><img src="img/separator_menu.png"></div>
	    
	      <?php if(isset($_SESSION['auth'])): ?>
	      <div class= "menu-item"><a href="logout.php"><div class="menu-bg2"><div class="menu-item-height"><img src="img/menu-compte.png"> Bonjour <?php echo($_SESSION['auth']->username); ?></div></div></a></div>
	      
	      <?php else: ?>
	      
	      <div class= "menu-item"><a href="connexion_rapide.php" data-toggle="lightbox" data-title="Connexion Rapide"><div class="menu-bg2"><div class="menu-item-height">Se connecter</div></div></a></div>
	      
	      
 <?php endif; ?>
	</nav>

	<nav class="sousmenu">
	  <a href="#" class="sousmenu-item"><img src="img/sousmenu-info.png" />Upcircus c'est quoi</a>
	  <a href="#" class="sousmenu-item"><img src="img/sousmenu-contacteznous.png"/>&nbsp;Contactez-nous</a>
	  <id class="sousmenu-item">Reseaux sociaux : &nbsp;<a href="#"><img src="img/sousmenu-fb.png"/></a>&nbsp;
	  <a href="#"><img src="img/sousmenu-twit.png"/></a>&nbsp;
	  <a href="#"><img src="img/sousmenu-pint.png"/></a>&nbsp;
	  <a href="#"><img src="img/sousmenu-gplus.png"/></a>&nbsp;
	  </id>
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