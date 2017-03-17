<?php
require 'inc/functions.php'; 
logged_only('settings.php');
require 'inc/header_inc_new.php';
?>


 <link rel="stylesheet" href="css/module_filtre_recherche.css">

<section>    
  <div class="container" style="height:100%;">
  <h3 class="text-center">Modifiez vos options<br /><img src="img/ico/gear.png"></h3>
    <div class="row">
      &nbsp;
    </div>
    <label>J'accepte de recevoir un email à chaque commentaire posté sur une de mes contributions :&nbsp;
    <div class="onoffswitch">
	<input type="checkbox" name="email_comment" class="onoffswitch-checkbox" id="email_comment" checked>
	<label class="onoffswitch-label" for="email_comment">
	    <span class="onoffswitch-inner"></span>
	    <span class="onoffswitch-switch"></span>
	</label>
	</label>
    </div>
    
    <label>Activer mon profil :&nbsp;
    <div class="onoffswitch">
	<input type="checkbox" name="activer_profil" class="onoffswitch-checkbox" id="activer_profil" checked>
	<label class="onoffswitch-label" for="activer_profil">
	    <span class="onoffswitch-inner"></span>
	    <span class="onoffswitch-switch"></span>
	</label>
	</label>
    </div>
<br /><br />
    Besoins de plus d'options ? <a href="contact.php">contactez-nous</a> ! 
    
  </div>
</section>

<?php require 'inc/pieddepage_inc_new.php'; ?>

