<div id="t1" class="container-fluid top-container ">
  <div class="top-inner">
    <div class="row">
	  <div class="col-lg-2 menu-itm text-center nopadding-left-right padding-left-10"><a href="#comment">Comment ça marche ?</a></div>
	  <div class="col-lg-2 menu-itm text-center nopadding-left-right"><a href="#revalorisation">Revalorisation</a></div>
	  <div class="col-lg-1 menu-itm text-center nopadding-left-right"><a href="#contribuez">Contribuez</a></div>
	  <div class="col-lg-2 text-center nopadding-left-right">
	    <a href="index.php"><img src="img/logo.png"></a>
	  </div>

	  <div class="col-lg-1 menu-itm text-center nopadding-left-right">
	    <a href="#contact">Contactez-Nous</a>
	  </div>
	  <div class="col-lg-1 menu-itm text-center nopadding-left-right">

	  </div>
	  <div class="col-lg-3 menu-itm text-center nopadding-left-right">
	  <?php if(isset($_SESSION['auth']))
	  { ?> 
	  <a href="#" class="dropdown-toggle align-right fakelink hover padding20" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	  <?php echo ucfirst($_SESSION['auth']->username) ?>
	  <span class="glyphicon glyphicon-menu-down small-chevron"></span></a>
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
  </div>
</div>