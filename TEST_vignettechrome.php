<?php 
require 'inc/header_inc_new.php';
require 'app/Autoloader.php';

require 'inc/mystrtr.php';
\App\Autoloader::register();
require_once 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");

 $newimg = new App\blur_image("img/img_princ/6e8d89dcd1ffa4dbacaf781b6123e36d.jpg");
$div_arrondi="div_arrondi2_tuto";
?>
	<div class="<?php echo $div_arrondi; ?>" style="width:<?php echo($newimg->divwidth()); ?>px; background-image:url(<?php echo($newimg->url); ?>); background-size:  <?php echo($newimg->imgwidth().'px'); ?> <?php echo($newimg->imgheight().'px'); ?>;">
	  <span class="encadre_type">&nbsp;idee&nbsp;</span>
	  <div class="surcouche">
	  <coeur>
	    <span class="test-coeur">
	      <?php 
		$id=220;
		require 'inc/ccoeur_vignette.php';
	      ?>
	    </span>
	  </coeur>
	    <a href="toto"><ins>
	      <div class="surcouche-content-titre">
		

		
		<?php echo mb_strimwidth(ucfirst("bougeoire"),0,25,"..."); ?>
	      </div>
	      <div class="surcouche-content-mp">
		<br /><strong>Revalorisation :</strong> <?php echo ucfirst("bouchon"); ?>
		<br /><strong>Par: </strong><?php echo ucfirst("coco"); ?>
	      </div>
	      <div class="surcouche-content-rates">
		<mini>Difficulté :</mini>&nbsp;
		<?php 
		  for ($i=1;$i<=5;$i++){
		    echo('<span class="rating_full_sm">&starf;</span>');
		  }
		  for ($i=1;$i<=5-5;$i++){
		    echo('<span class="rating_empty_sm">&starf;</span>');
		  }
		
		?>
		<br />
		<mini>Notation :</mini>&nbsp;<span id="notemoyenne">
		<?php

		  for($i=1;$i<=round(4);$i++)
		      {
			echo('<span class="rating_full_sm">&starf;</span>');
		      }
		      for($i=5;$i>round(4);$i--)
		      {
			echo('<span class="rating_empty_sm">&starf;</span>');
		      }
		  echo '<mini>&nbsp;('.round(4).')</mini>'; 
		?>
		</span><br />
		
	      
	      </div>
	      <div class="surcouche-content-bottom">
		<div class="surcouche-bottomleft">
		</div>
		<div class="surcouche-voirtout">
		<?php

		echo '<a class="fancybox fancybox.iframe btn btn-default btn-xs" href="idee.php?id=220">';
		
		?>
		Voir</a>

		</div>
		
	      </div><!--surcouche-content-bottom-->
	    </ins></a>
	  </div><!--surcouche-->

	</div><!--$div_arrondi-->

	
	
	
	