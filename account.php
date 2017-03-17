<?php
require 'inc/functions.php'; 
logged_only('account.php');
require 'inc/header_inc_new.php';
?>

<section>    
  <div class="container" style="height:100%;">
  <h3 class="text-center">Bonjour <?= $_SESSION['auth']->username ?>, et bienvenue sur votre Tableau de Bord<br /><img src="img/ico/settings.png"></h3>
    <div class="row">
      &nbsp;
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
      <h3>Vos Infos</h3><br />
      <img src="img/ico/gear.png"><br /><br />
      <x2><a href="infos_createurs.php">Modifier son profil</a></x2><br /><br />
      <x2><a href="mes-infos.php?on=3">Changer de mot de passe</a></x2><br /><br /><br />
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
      <h3>Vos Contributions</h3><br /><img src="img/ico/image.png"><br /><br />
      <x2><a href="mes-contributions.php?on=2">Idées</a></x2><br /><br />
      <x2><a href="mes-contributions.php?on=1">Tutoriels</a></x2><br /><br />
      <x2><a href="mes-contributions.php?on=4">Toutes vos contributions</a></x2><br /><br />
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
      <h3>Vos Coups de Coeur</h3><br /><img src="img/ico/heart.png"><br /><br />
      <x2><a href="coup-de-coeurs.php?on=1">Idées</a></x2><br /><br />
      <x2><a href="coup-de-coeurs.php?on=2">Tutoriels</a></x2><br /><br />
      <x2><a href="coup-de-coeurs.php?on=4">Tous vos coups de coeur</a></x2><br /><br />
    </div>
  </div>
</section>

<?php require 'inc/pieddepage_inc_new.php'; ?>

