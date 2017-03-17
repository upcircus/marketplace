<?php
require_once 'inc/db.php';
require_once 'inc/functions.php';
reconnect_from_cookie();
$pdo->query("SET NAMES 'utf8'");
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/fi/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/fi/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/fi/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/fi/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/fi/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/fi/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/fi/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/fi/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/fi/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/fi/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/fi/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="/fi/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/fi/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/fi/favicon-16x16.png" sizes="16x16">
    <link rel="shortcut icon" type="image/x-icon" href="fi/upico.ico" />
    <meta name="apple-mobile-web-app-title" content="Upcircus">
    <meta name="application-name" content="Upcircus">
    <meta name="theme-color" content="#359d02">
    <link rel="canonical" href="http://www.upcircus.fr">    <meta property="og:locale" content="fr_FR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Upcircus" />
    <meta property="og:description" content="Plateforme collaborative d'upcycling et d'économie circulaire" />
    <meta property="og:url" content="http://www.upcircus.fr" />
    <meta property="og:site_name" content="Upcircus" />
    <meta property="og:image" content="http://www.upcircus.fr/img/uplarge.jpg" />
    <meta property="og:image:width" content="1062" />
    <meta property="og:image:height" content="465" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="Plateforme collaborative d'upcycling et d'économie circulaire" />
    <meta name="twitter:title" content="Upcircus" />
    <meta name="twitter:image" content="http://www.upcircus.fr/img/uplarge.jpg" />

      <title>Plateforme collaborative d'upcycling et d'économie circulaire - UPCIRCUS.fr </title>
      
<!--Jquery and Jquery UI -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 	
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- Fin JQuery -->

<!-- Fancybox -->
  <!-- Add fancyBox main JS and CSS files -->
  <script type="text/javascript" src="fancyBox-master/source/jquery.fancybox.pack.js?v=2.1.5"></script>
  <link rel="stylesheet" type="text/css" href="fancyBox-master/source/jquery.fancybox.css?v=2.1.5" media="screen" />
  <!-- Add Media helper (this is optional) -->
  <script type="text/javascript" src="fancyBox-master/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
  <script src="js/script_fancybox.js"></script>
<!-- 	fin Fancybox -->

<!-- Bootstrap -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Fin bootstrap -->

<!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/owl.theme.css">  
  <link rel="stylesheet" href="css/owl.transition.css">  
<!-- Fin CSS -->

<!-- JS -->
<script src="js/script-layer.js"></script>
  <script src="js/script_menu_mobile.js"></script>
  <script src="js/script_autocomplete.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
<!-- Fin JS -->

<script>
    $(document).ready(function() {
     
      $("#owl-demo").owlCarousel({
        items : 10,
        lazyLoad : true,
        navigation : true
      }); 
     
    });
</script>
<script type="text/javascript">					

$(document).ready(function(){
	
    $("#t1").hide();
    // faire apparaitre #text1
    $(function () 
    {
        $(window).scroll(function () 
        {
            if ($(this).scrollTop() > 330 ) 
            {
                $('#t1').slideDown(300);
            } 
            else 
            {
                $('#t1').fadeOut(300);
            }
	});
     });
});

</script>
<style type="text/css">
    html {
      scroll-behavior: smooth;
    }
</style>
<style>
    #owl-demo .item{
      margin: 0 auto;
      height:170px;
      text-align: center;
      background-color:#ffffff;
      
    }
    #owl-demo .item img{
      display: block;
      margin:0 auto;
      max-height:160px;
      min-height:160px;
      width:auto;
      background-color:#ffffff;
      text-align:center;
     
    }
</style>

<script>
  $(document).ready(function(){
    $("#menutop").sticky({topSpacing:0});
  });
</script>

</head>
<body>

<style type="text/css">
html {
  scroll-behavior: smooth;
}
</style>

<!--SCRIPT AJAX NEWSLETTER-->
<?php

require 'pp_newsletter.php';

?>
<!--FIN SCRIPT AJAX NEWSLETTER-->


<div class="wrap-index">
  <?php if(isset($_SESSION['flash'])): ?>
  <?php foreach($_SESSION['flash'] as $type => $message): ?>
  <div class="alert alert-<?= $type ?> ">
    <?= $message ?>
  </div>
  <?php endforeach; ?>
  <?php unset($_SESSION['flash']); ?>
  <?php endif; ?>

  <div id="full"></div>
  <div id="whiteback" class="closepopup">
    <div id="fermer" class="closepopup">
      <span class="glyphicon glyphicon-remove-circle huge-glyphicon"></span><br /><span class="small-cap">Fermer</span>
    </div>
  </div>
  
  <!-- DIV POPUP REGISTER -->
  <?php
    require 'pp_register.php';
  ?>
  <!-- FIN DIV POPUP REGISTER -->
  
  <!-- DIV POPUP CONNEXION -->
  <?php
    require 'pp_connexion.php';
  ?>
  <!-- FIN DIV POPUP CONNEXION -->

    <!-- DIV POPUP MOT DE PASSE OUBLIE -->
<?php
  require 'pp_forgetpw.php';
?>
  <!-- FIN DIV POPUP MOT DE PASSE OUBLIE -->
  
  
<main>
<!-- MENU COMMUN AUX AUTRES PAGES -->
<?php
  require 'inc/header/menu_t1.php';
?>
<!-- FIN MENU COMMUN AUX AUTRES PAGES -->

<div class="container-fluid">
  <div class="row">
  <!--ENTETE-->
    <div class="entete row">
      <div class="top-inner-index">
	<div class="col-lg-9 text-center menu-itm">
	  <span class="padding20"><a href="#comment">Comment ça marche ?</a></span>
	  <span class="padding20"><a href="#revalorisation">Revalorisation</a></span>
	  <span class="padding20"><a href="#contribuez">Contribuez</a></span>
	  <span class="padding20"><a href="#contact">Contactez-Nous</a></span>
	</div>
	<div class="col-lg-3 menu-itm text-center nopadding-left-right">
	<?php if(isset($_SESSION['auth']))
	{ ?> 
	<a href="#" class="dropdown-toggle align-right fakelink hover padding20" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	<?php echo ucfirst($_SESSION['auth']->username) ?> 
	<span class="glyphicon glyphicon-menu-down small-chevron"></span>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
		  <li><a href="infos_createurs.php">Modifier mon profil</a></li>
		  <li><a href="coup-de-coeurs.php?on=4">Voir mes favoris</a></li>
		  <li><a href="mes-contributions.php?on=4">Voir mes contributions</a></li>
		  <li><a href="ajouter-idee.php">Ajouter un produit</a></li>
		  <li><a href="ajouter-tutoriel.php">Ajouter un tutoriel</a></li>
		  <li role="separator" class="divider"></li>
		  <li><a href="logout.php">Deconnexion</a></li>
		</ul>
	<?php
	; }
	else 
	{
	  ?>
	  <span class="btn-trpr-white inscriptionbtn hover fakelink">&nbsp;S'inscrire&nbsp;</span><span class="connexionbtn hover fakelink">Connexion</span>
	  <?php 
	} 
	?>
	</div>
      </div>
      <!--END ENTETE-->
      
      <div class="row"> 
	<div class="container-fluid recherche">
	  <div class="col-lg-12 text-center">
	    <div class="row">
	      <img src="img/logo-center.png">
	      <br /><br /><br />
	    </div>
	    <div class="row">
	      <?php if(!isset($_SESSION['auth'])): ?>
	      <span class="btn btn-success inscriptionbtn"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S'inscrire Gratuitement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
	      <?php endif; ?>
	      
	    </div>
	  </div><!--col-lg-12 text-center-->
	</div><!--Recherche-->
      </div><!--row-->
    </div><!--entete-->
  </div><!--row-->
</div><!--container-fluid-->

<div class="minus50 visible-lg">
  <div class="col-lg-12 nopadding bgcachelg"></div>	 
</div>

<div class="minus35 visible-md">
  <div class="col-lg-12 nopadding bgcachemd"></div>	 
</div>
<h1 class="text-center minus35"><strong><span id="comment" class="anchor"></span>Comment ca marche ?</strong><br /><small>En savoir plus sur nos services</small></h1>
<div class="container minus35">
  <div class="col-lg-3 text-justify">
  <div class="text-center"><img src="img/ico/globe.png"></div>
  <div class="text-center"><h4>Consommez de façon éthique</h4></div><br />
  Accedez à un catalogue de produits issus de la <strong>revalorisation de déchets</strong> :  Il vous est maintenant possible de consommer en favorisant la <strong>revalorisation</strong> des déchets, <strong>l'emploi local</strong> et les <strong>circuits courts.</strong><br /><br /><br /><div class="text-center"><?php if(!isset($_SESSION['auth'])): ?><span class="btn btn-default btn-xs inscriptionbtn">Inscrivez-vous ! </span><?php endif; ?></div>
  </div>
  <div class="col-lg-3 text-justify">
    <div class="text-center">
      <img src="img/ico/magicwand.png">
    </div>
    <div class="text-center">
      <h4>Revaloriser est votre métier ? </h4>
    </div>
    <br />Entreprises, recycleries, créateurs, <strong>disposez d'une boutique en ligne gratuite</strong> pour vous mettre en  valeur avec votre page de profil et <strong>proposez une selection de vos produits</strong> !<br />Soyez au courant du succès de vos produits grâce à des statistiques personalisées. <br /><div class="text-center"><?php if(!isset($_SESSION['auth'])): ?><span class="btn btn-default btn-xs inscriptionbtn">Inscrivez-vous ! </span><?php endif; ?></div>
  </div>
  <div class="col-lg-3 text-justify">
    <div class="text-center">
      <img src="img/ico/recycle.png">
    </div>
    <div class="text-center">
      <h4>Déchet 2.0 </h4>
    </div>
    <br />Entreprises ou particuliers : Débarrassez-vous de tous type de <strong>déchets</strong> en permettant à d'autres de s'en servir comme <strong>matière premières</strong> : Créez un <strong>gisement</strong>, favorisez les échanges de <strong>matières</strong> et <strong>limitez la consommations de ressources.</strong>
  </div>
  <div class="col-lg-3 text-justify">
    <div class="text-center">
      <img src="img/ico/brightness.png">
    </div>
    <div class="text-center">
      <h4>Revalorisations </h4>
    </div>
    <br />Découvrez les possibilités de <strong>revalorisation</strong> avec notre moteur de recherche mettant en avant les produits issus de la <strong>revalorisation de déchets</strong> et des <strong>tutoriels</strong> pour le faire vous meme !<br /><br /><br /><div class="text-center"><a href="#revalorisation" class="btn btn-default btn-xs">Découvrir ! </a></div>
  </div>
</div>

<div class="container minus35">
  <div class="col-lg-offset-3 col-lg-6">
    <h2>
      <small>
	<div class="col-lg-offset-1 col-lg-10 text-center">
	  Soyez informé du lancement de la plateforme<br /><br />
	</div>
      </small>
    </h2><br />
    <div class="newsletter">
      <form id="form_newsletter1">
	<div class="col-lg-12 input-group text-center">
	  <input type="email" class="form-control" id="email_nl1" placeholder="Entrez votre email">
	  <span class="input-group-btn" id="btn-newsletter1"><input type="submit" class="btn btn-primary" value="Être informé"></span>
	</div><!--input-group col-lg-9-->
      </form>
      </div><!--fin div id=newsltter-->
  </div><!--col-lg-offset-3 col-lg-6-->
</div><!--container-->
<span class="btn btn-primary" id="balancetanews">click</span>


<div class="row nomargin nopadding" style="background-color:#e0e0d1">
  <div class="col-lg-12 text-center">
    <img src="img/cache-white.png">
  </div>
  <h1 class="text-center"><br />
    <strong>
      <span id="revalorisation" class="anchor"></span>
	Revalorisations<br />
	<small>Quelques revalorisations</small>
    </strong>
  </h1>
  <div class="container-fluid">
    <div id="owl-demo" class="owl-carousel">
    
    <?php

    $req = $pdo->query("SELECT * FROM contribution WHERE type='idee' ORDER BY RAND() LIMIT 20");
    
    foreach ($req as $img)
  {
    ?> 
      <div class="item large text-center"><a href="idee.php?id=<?php echo $img->id;?>" class=""><div class="background"><div class="x"><strong><?php echo ucfirst($img->titre);?></strong><br /><br />Revalorisation : <?php echo $img->dechet;?><br /><br /><span class="btn btn-trpr-white2 btn-xs">&nbsp;Voir&nbsp;</span> </div></div></a><img class="lazyOwl center-block" data-src="img/img_princ/<?php echo $img->img_princ;?>" alt="<?php echo $img->titre;?>"></div>
  <?php
  }
  ?>
    </div>
  </div><br />
  <div class="container" style="background-color:#efefef; border:solid 1px black;">
    <h1 class="text-center"><small>Cherchez un déchet et découvrez comment il se revalorise !</small></h1>
    <div class="container">
      <form method="GET" action="moteur.php">
	<div class="col-lg-offset-3 col-md-offset-2 col-sm-offset-1 col-xs-offset-1 col-lg-6 col-md-8 col-sm-9 col-xs-9 input-group moteur">
	  <input type="text" class="form-control search" placeholder="Entrez un déchet (bouteille, bois, palette...) " id="search" name="search">
	  <input type="hidden" name = "cat" id="search-cat">
	  <span class="input-group-btn hidden-sm hidden-xs"><input class="btn btn-danger" type="submit" value="Rechercher"></span>
	  <span class="input-group-btn visible-sm visible-xs"><button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-search"></span></button></span>
	</div>
      </form><br />
    </div>
    <br />
  </div>
  <br />
  <div class="container">
    <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
      <input type="button" class="btn btn-default form-control" value="Voir toutes les revalorisations"  onclick="javascript:location.href='toutes-contributions.php'">
    </div>
  </div>
  <div class="container reval">
    <h1 class="text-center"><small>Quelques revalorisateurs</small></h1>
    
    <?php
    $req2 = $pdo->query("SELECT * FROM infos_contributeur ORDER BY RAND() LIMIT 4");
    
    foreach ($req2 as $contributor)
  {
    ?> 
    <div class="col-lg-3 text-center "><a href="./<?php echo $contributor->nom;?>">
    <?php if($contributor->photo_logo =="[//VIDE]"): ?>
      <img src="img/ico/profle128.png" class="img-circle" style="height:120px; width:120px; border:solid 1px black;"><br />
    <?php else: ?>
      <img src="img/img_profil/<?php echo $contributor->photo_logo;?>" class="img-circle" style="height:120px; width:120px; border:solid 1px black;"><br />
    <?php endif; ?>
      <strong><?php echo ucfirst($contributor->nom);?></Strong><br />
      <small>Voir son profil</small></a>
    </div>
    
    <?php
    }
    ?>
  </div>
</div><br /><br /><br />
<div class="col-lg-12 bgcachelg visible-lg"></div>
<div class="col-lg-12 bgcachemd visible-md"></div>

<div style="background-color:#ffffff">
  <h1 class="text-center">
    <strong>
      <span id="contribuez">Contribuez</span>
    </strong><br />
    <small>Créez votre profil et mettez votre travail de revalorisation de déchets en avant</small>
  </h1>
  <div class="container">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 large2" style="background-image:url('img/gallery/contribuer-user.jpg'); height:250px;">&nbsp;</div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 large2 text-center">
      <h3 class="text-center"><strong></strong></h3><p class="text-justify">
      Inscrivez-vous gratuitement et mettez en avant vos <strong> produits & créations</strong>, créez <strong>votre catalogue</strong> et <strong>partagez-le</strong> avec votre public en disposant d'une adresse en http://www.upcircus.fr/votrepseudo <br />
      <div class="text-center">
	<span class="btn btn-success inscriptionbtn">
	  <strong>S'inscrire</strong>
	</span>
      </div><br />
      <p class="text-justify"> Vous souhaitez <strong>montrer vos étapes de créations </strong> et le travail derrière vos créations ?<strong>  Ajoutez un tutoriel et inspirez d'autres personnes</strong> pour réutiliser des déchets !</p>
      <input type="button" value="Ajouter un tutoriel" class="btn btn-primary" onclick="javascript:location.href='ajouter-tutoriel.php'">
    </div>
  </div><br /><br /><br />
  <div  style="background-color:#efefef">
  <div class="col-lg-12 text-center">
    <img src="img/cache-white.png">
  </div>
  <div class="container">
    <h1 class="text-center">
      <strong>
	<span id="contact">Contactez nous</span>
      </strong><br />
      <small>Pour tous renseignements, n'hésitez pas à remplir ce formulaire</small>
    </h1>
    <div id="contact_content">
    <span id="flash_contact"></span>
      <form id="form_contact">
	<div class="form-group">
	  <div class="col-lg-6">
	    <input type="text" name="nom_contact" id="nom_contact" placeholder="Nom" class="form-control"><br />
	  </div>
	  <div class="col-lg-6">
	    <input type="email" name="email_contact" id="email_contact" placeholder="Email" class="form-control"><br />
	  </div>
	  <div class="col-lg-12">
	    <textarea class="form-control" name="message_contact" id="message_contact" placeholder="Votre message" rows="6"></textarea>
	  </div>
	  <div class="col-lg-12 text-right">
	    <span id="btn-contact"><input type="submit" class="btn btn-danger" value="Envoyer"></span>
	  </div>
	</div><!-- fin div class="form-group"-->
      </form>
    </div><!-- fin div id="contact"-->
  </div>
  
  <section id="quisommesnous" class="whitebg">
  <div class="container ">
    <h1 class="text-center">
      <strong>
	<span id="contact">Qui sommes-nous</span>
      </strong><br />
    </h1>
    <div id="equipe_content">
      <div class="col-lg-4 text-center">
	<img src="img/equipe/profil_daniela.png"><br /><strong>Daniela</strong><br />Communicante du groupe, apporte le soleil Colombien dans l'équipe et le raffinement féminin. 
      </div>
      <div class="col-lg-4 text-center">
	<img src="img/equipe/profil_aymeric.png"><br /><strong>Aymeric</strong><br />Commercial du projet, aimerai passer sa vie dans une déchetterie pour y trouver des trésors. 
      </div>
      <div class="col-lg-4 text-center">
	<img src="img/equipe/profil_jeremy.png"><br /><strong>Jérémy</strong><br />Developpeur-web et menuisier-ébeniste, la liaison tenon-mortaise du projet ! 
      </div>
    </div>
  </div>
  <br />
  </section>
</div>

<div class="container-fluid text-center"  style="background-color:#555555; color:#ffffff">
  <div class="col-lg-offset-2 col-lg-8">
    <br />Mentions légales | Découvrez les revalorisations | Créez votre profil et mettez vos produits en avant | Contactez-nous<br /><br />
  </div>
  <div class="col-lg-offset-4 col-lg-4">
    <a href="http://www.facebook.com/upcircus" target="_blank"><img src="img/sousmenu-fb.png"></a>
    <a href="http://twitter.com/upcircus_fr" target="_blank"><img src="img/sousmenu-twit.png"></a>
    <a href="http://fr.pinterest.com/upcircus" target="_blank"><img src="img/sousmenu-pint.png"></a>
    <a href="https://plus.google.com/u/0/106910236908905653371" target="_blank"><img src="img/sousmenu-gplus.png"></a>
  </div>
  <div class="col-lg-offset-2 col-lg-8">
    <br />Tous droits réservés &copy; Upcircus - 2016
  </div>
  <div class="col-lg-offset-4 col-lg-4">
    <img src="img/logo.png" height="30px"><br /><img src="img/partenaires/catalis.png" height="50px"><img src="img/partenaires/scop.png" height="50px"><br />
  </div>
</div>
  <script src="js/cookiechoices.js"></script><script>document.addEventListener('DOMContentLoaded', function(event){cookieChoices.showCookieConsentBar('Ce site utilise des cookies pour vous offrir le meilleur service. En poursuivant votre navigation, vous acceptez l’utilisation des cookies.', 'J’accepte', 'En savoir plus', 'cookies.php');});</script>
  <!-- Piwik -->
  <script type="text/javascript">
    var _paq = _paq || [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
      var u="//upcircus.fr/analytics/";
      _paq.push(['setTrackerUrl', u+'piwik.php']);
      _paq.push(['setSiteId', 1]);
      var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
      g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
  </script>
  <noscript><p><img src="//upcircus.fr/analytics/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
  <!-- End Piwik Code -->