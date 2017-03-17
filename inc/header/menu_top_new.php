<?php if(isset($_SESSION['auth'])&&$_SESSION['auth']->status=="moderateur"):?>
	    <div class="col-lg-offset-2 col-lg-7 col-md-offset-4 col-md-5 col-sm-offset-4 col-sm-5 submenu hidden-xs hidden-sm">
	    <div class="col-lg-offset-2 col-lg-2 col-md-2 col-sm-2">
		<a href="#" class="visible-lg dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;Modération <h6 class="glyphicon glyphicon-menu-down"></h6></a>
		<a href="#" class="hidden-lg dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><h3 class="marge-neg-0"><span class="glyphicon glyphicon-asterisk"></h3></a>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		  <li><a href="moderation_contribution.php?on=4">Modération de contributions</a></li>
		  <li><a href="moder_requetes.php">Modération requêtes moteur</a></li>
		  <li><a href="moder_ajout_motclef.php">Voir et modifier déchets</a></li>
		  <li><a href="ajouter-dechet.php">Ajouter déchets</a></li>
		  <li><a href="moder_ajout_membre.php">Ajouter membre reseau</a></li>
		</ul>
	      </div>
	    <?php else:?>
	    <div class="col-lg-10 col-md-10 col-sm-10 submenu hidden-xs hidden-sm">
	      <div class="col-lg-4 col-md-4 col-sm-4">
	    <?php 
	    if(isset($index)&&$index=="yes")
	    {
	      ?>
	      		&nbsp;</div>
	      
	      <?php
	    }
	    else
	      {
	    ?>
	    
		<form method="get" action="moteur.php">
		  <div class="input-group"> 
		    <span class="input-group-btn"><button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button></span>
		    <input type="text" class="form-control search" placeholder="Qu'allez-vous revaloriser aujourd'hui ?" id="search" name="search">
		      <input type="hidden" name = "cat" id="search-cat">
		  </div>
		</form>
	      </div>
	    <?php
	    }
	    ?>
	    <?php endif;?>
	      <div class="col-lg-1 col-md-1 col-sm-1">
		&nbsp;
	      </div>
	      <div class="col-lg-2 col-md-2 col-sm-2">
		<a href="#" class="visible-lg dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="img/menu-contribuer_white.png" height="20px">&nbsp;Contribuer <h6 class="glyphicon glyphicon-menu-down"></h6></a>
		<a href="#" class="hidden-lg dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="img/menu-contribuer_white.png" height="30px"></a>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
		  <li><a href="ajouter-idee.php">Ajouter une idée</a></li>
		  <li><a href="ajouter-tutoriel.php">Ajouter un tutoriel</a></li>
		  <li role="separator" class="divider"></li>
		  <li><a href="mes-contributions.php?on=4">Mes contributions</a></li>
		</ul>
	      </div>
	      <div class="col-lg-3 col-md-3 col-sm-3">
		<div class="col-lg-offset-1 col-md-offset-1">
		<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
		<a href="reseau-upcircus.php" data-toggle="tooltip" title="Faites partie du réseau d'entreprises qui optimisent leurs déchets." data-placement="bottom" class="visible-lg dropdown-toggle marge-plus-10" ><img src="img/menu-reseau_white.png" height="20px">&nbsp;Réseau Upcircus </a>

<!--		  <a href="#" class="visible-lg dropdown-toggle" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="img/menu-reseau_white.png" height="20px">&nbsp;Réseau Upcircus <h6 class="glyphicon glyphicon-menu-down"></h6></a>
		  <a href="#" class="hidden-lg dropdown-toggle" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="img/menu-reseau_white.png" height="30px"></a>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
		    <li><a href="reseau-upcircus.php">Qu'est ce que le réseau Upcircus ?</a></li>
		  </ul>-->
		</div>
	      </div>
	      <div class="col-lg-2 col-md-2 col-sm-2">
	      <?php if(isset($_SESSION['auth'])): ?>
		<a href="#" class="visible-lg dropdown-toggle" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo(ucfirst($_SESSION['auth']->username)); ?> <h6 class="glyphicon glyphicon-menu-down"></h6></a>
		<a href="#" class="hidden-lg dropdown-toggle" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><h3 class="marge-neg-0"><span class="glyphicon glyphicon-user"></h3></a>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
		  <li><a href="account.php">Tableau de bord</a></li>
		  <li><a href="logout.php">Se deconnecter</a></li>
		</ul>
	      <?php else: ?>
		<a href="#" class="visible-lg dropdown-toggle" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="glyphicon glyphicon-user"></span>&nbsp;Connexion <h6 class="glyphicon glyphicon-menu-down"></h6></a>
		<a href="#" class="hidden-lg dropdown-toggle" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><h3 class="marge-neg-0"><span class="glyphicon glyphicon-user"></h3></a>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
		  <li><a class="connexion" data-fancybox-type="iframe" href="connexion_rapide.php">Se connecter</a></li>
		  <li><a href="register.php">S'inscrire</a></li>
		</ul>
	      <?php endif; ?>
	      </div>
	    </div>