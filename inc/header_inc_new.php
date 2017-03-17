
<?php
if(session_status() == PHP_SESSION_NONE)
{
  session_start();
}
ini_set('display_errors',1);


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1">
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
      

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Fin bootstrap -->

<!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="app.css">
<!-- Fin CSS -->

<!-- JS -->
<script src="js/script-layer.js"></script>
 <script src="js/script_menu_mobile.js"></script>
 <script src="js/script_autocomplete.js"></script>
<!-- Fin JS -->



  </head>
  <body>
<div class="wrap">
  <?php if(isset($_SESSION['flash'])): ?>
  <?php foreach($_SESSION['flash'] as $type => $message): ?>
  <div class="alert alert-<?= $type ?> " style="margin-bottom=0px;">
    <?= $message ?>
  </div>
  <?php endforeach; ?>
  <?php unset($_SESSION['flash']); ?>
  <?php endif; ?>



<!--SCRIPT AJAX CONTACT-->
<script>
    $(document).ready(function()
    {
      $('#form_contact').on('submit', function(e) 
	{
	  e.preventDefault();
	  var $this = $(this);
	  var name_contact = $('#nom_contact').val();	  
	  var email_contact = $('#email_contact').val();	
	  var message_contact = $('#message_contact').val();	
	  if(name_contact === '' || email_contact === '' || message_contact === '') 
	  {
	    $("#flash_contact").html('<div class="alert alert-danger alert-dismissible" role="alert">Tous les champs doivent êtres remplis</div>');
	  } 
	  else 
	  { 
	    $("#btn-contact").html("<img src='img/loader-small.gif'>");
	    $.post("contact_new.php", 
	      {
		name_contact:name_contact,
		email_contact:email_contact,
		message_contact:message_contact
	      },
	      function(data,status)
	      {
		if(status == "success")
		$("#contact_content").html(data);
	      });
	  }
	});
      });
</script>
<!--FIN SCRIPT AJAX CONTACT-->


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
<?php
  require 'header/menu_t1.php';
?>

    <div id="full"></div>
  <div id="whiteback" class="closepopup">
    <div id="fermer" class="closepopup">
      <span class="glyphicon glyphicon-remove-circle huge-glyphicon"></span><br /><span class="small-cap">Fermer</span>
    </div>
  </div>
<div class="container-fluid">
  <div class="row">


  </div><!--row-->
</div><!--container-fluid-->
<div class="container-fluid col-xs-11 visible-xs col-sm-11 visible-sm text-center">
  <div class="input-group"> 
    <span class="input-group-btn"><button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button></span>
    <input type="text" class="form-control search" placeholder="Qu'allez-vous revaloriser aujourd'hui ?" id="search" name="search">
    <input type="hidden" name = "cat" id="search-cat">
  </div>
</div>
