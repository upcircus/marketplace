<div id="toggle">
  <div class="separation">
  <?php if(isset($_SESSION['auth'])): ?>
    <span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo(ucfirst($_SESSION['auth']->username)); ?>
  <?php else: ?>
    <span class="glyphicon glyphicon-user"></span>&nbsp;<span class="itm-black"><a class="connexion_mob" id="connexion" data-fancybox-type="iframe" href="connexion_rapide.php">Connexion</a></span>
  </div>
  <div class="menu-itm">
   &nbsp;&nbsp;&nbsp;&nbsp;<a class="connexion_mob" id="connexion2" data-fancybox-type="iframe" href="connexion_rapide.php">Connectez-vous</a>
  <?php endif; ?>
  </div>
  <br />
  <div class="separation">
    <img src="img/menu-contribuer.png" height="20px">&nbsp;Contribuer</a>
  </div>
  <div class="menu-itm">
   &nbsp;&nbsp;&nbsp;&nbsp;<a href="ajouter-tutoriel.php">Ajouter un tutoriel</a>
  </div>
  <div class="menu-itm">
   &nbsp;&nbsp;&nbsp;&nbsp;<a href="ajouter-idee.php">Ajouter une idée</a>
  </div>
  <div class="menu-itm">
   &nbsp;&nbsp;&nbsp;&nbsp;<a href="mes-contributions.php">Mes contributions</a>
  </div>
  <br />
  <div class="separation">
    <img src="img/menu-reseau.png" height="20px">&nbsp;Réseau Upcircus</a>
  </div>
  <div class="menu-itm">
   &nbsp;&nbsp;&nbsp;&nbsp;<a href="reseau-upcircus.php">Renseignez-vous !</a>
  </div>
<?php if(isset($_SESSION['auth'])): ?>
  <div class="separation">
   <span class="glyphicon glyphicon-user"></span>&nbsp;Votre compte
  </div>
    <div class="menu-itm">
   &nbsp;&nbsp;&nbsp;&nbsp;<a href="account.php">Tableau de bord</a>
  </div>
    <div class="menu-itm">
   &nbsp;&nbsp;&nbsp;&nbsp;<a href="logout.php">Se déconnecter</a>
  </div>
<?php endif; ?>
</div>  