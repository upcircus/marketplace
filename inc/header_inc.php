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
  
  if(!empty($user))
  {
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
  else
  {
    $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
  }
}
?>




<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>UPCIRCUS.fr </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

	
	<!-- Add jQuery library -->
	<script type="text/javascript" src="fancyBox-master/lib/jquery-1.10.2.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="fancyBox-master/lib/jquery.mousewheel.pack.js?v=3.1.3"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="fancyBox-master/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="fancyBox-master/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancyBox-master/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="fancyBox-master/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancyBox-master/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="fancyBox-master/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="fancyBox-master/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
      <link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src ="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.css"></script>
        <script src ="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.js"></script>

      <link rel="stylesheet" href="app.css">

	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	
	<script>
	$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
	event.preventDefault();
	$(this).ekkoLightbox();
    });

</script>

    </head>
    <body>
    <?php if(isset($_SESSION['flash'])): ?>
    <?php foreach($_SESSION['flash'] as $type => $message): ?>
    <div class="alert alert-<?= $type ?> ">
      <?= $message ?>
    </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

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
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="moteur.php"><img src="img/menu-rechercher.png"/>&nbsp;Rechercher
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Voir toutes les idées</a></li>
          <li><a href="#">Voir tous les tutoriels</a></li>
          <li><a href="moteur.php">Rechercher autour d'un déchet</a></li>
        </ul>
      </li>
      <div class="sep"><img src="img/separator_menu.png"></div> 
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="img/menu-contribuer.png"/>&nbsp;Contribuer
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="ajouter-tutoriel.php">Ajouter un tutoriel</a></li>
          <li><a href="ajouter-idee.php">Ajouter une idée</a></li>
          <li><a href="ajouter-recyclage.php">Ajouter un recyclage</a></li>
          <li><a href="mes-contributions.php?on=4">Vos contributions</a></li>
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
      <?php if(isset($_SESSION['auth'])&&$_SESSION['auth']->status=="moderateur"){?>
      <div class="sep"><img src="img/separator_menu.png"></div>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">&nbsp;Modération
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="moderation_contribution.php?on=4">Modération de contributions</a></li>
          <li><a href="moder_requetes.php">Modération requête moteur</a></li>
          <li><a href="moder_ajout_motclef.php">Voir et modifier déchets</a></li>
          <li><a href="ajouter-dechet.php">Ajouter dechet</a></li>
        </ul>
      </li>
      <?php } ?>
      
      
      
      
      
      <div class="sep"><img src="img/separator_menu.png"></div> 
    </ul>
    
          
        <ul class="nav navbar-nav navbar-right">
        <div class="sep"><img src="img/separator_menu.png"></div> 
      <li><a href="index.php"><img src="img/menu-home.png"></a></li>
      <div class="sep"><img src="img/separator_menu.png"></div> 
      <li>
       <?php if(isset($_SESSION['auth'])): ?>
       <li class="dropdown">

	  <a class="dropdown-toggle " data-toggle="dropdown" href="#"> Bonjour <?php echo($_SESSION['auth']->username); ?>        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="account.php">Tableau de bord</a></li>
          <li><a href="logout.php">Se déconnecter</a></li>
        </ul></a>
	  <?php else: ?>
	  <li class="dropdown">
	  <a href="connexion_rapide.php" data-toggle="lightbox" data-title="Connexion Rapide">Se connecter <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="register.php">S'inscrire</a></li>
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
	  <id class="sousmenu-item">Reseaux sociaux : &nbsp;<a href="http://facebook.com/upcircus" target="_blank"><img src="img/sousmenu-fb.png"/></a>&nbsp;
	  <a href="https://twitter.com/upcircus_fr" target="_blank"><img src="img/sousmenu-twit.png"/></a>&nbsp;
	  <a href="https://fr.pinterest.com/upcircus/" target="_blank"><img src="img/sousmenu-pint.png"/></a>&nbsp;
	  <a href="https://plus.google.com/u/0/106910236908905653371" target="_blank"><img src="img/sousmenu-gplus.png"/></a>&nbsp;
	  </id>
	  </div>
	</nav>    
	<div class="cb"></div>
    
    
    

    </header>

        





