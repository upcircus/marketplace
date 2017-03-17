<?php
require 'inc/functions.php'; 
logged_only("moderation_contribution.php");
require 'inc/header_inc_new.php';
require_once 'inc/db.php';
require 'app/Autoloader.php';
\App\Autoloader::register();
$pdo->query("SET NAMES 'utf8'");
$req_tutoriel = $pdo->prepare("SELECT * FROM contribution WHERE valide = ? AND publication='publier' ORDER BY id DESC");
$req_tutoriel->execute(["non"]);
$nb_tutoriel = $req_tutoriel->rowCount();
?>
<section>    
  <div class="container">
  
  <h1><?php echo $_SESSION['auth']->username;?>, voici les contributions à modérer : <span class="badge"><?php echo($nb_tutoriel); ?></h1>

	<?php
	$nb_resultats=0;
	while($user_tutoriel = $req_tutoriel->fetch())
	{
	  $nb_resultats=$nb_resultats+1;
	  $x=$nb_resultats%2;
	?>
	    <script>
	    $(document).ready(function(){
	    $("#refuser<?php echo($nb_resultats);?>").click(function(){    
 		$.post("moder_refuse.php",
		{
		  id:<?php echo($user_tutoriel->id);?>,
		  raison_send:$("#raison<?php echo($nb_resultats);?>").val()
		});
		$("#div<?php echo($nb_resultats);?>").remove();
	    });
	   
	    $("#valider<?php echo($nb_resultats);?>").click(function(){    
 		$.post("moder_valider.php",
		{
		  id:<?php echo($user_tutoriel->id);?>
		});
		$("#div<?php echo($nb_resultats);?>").remove();
	    });
	    });
	    </script>


	  <?php
	  if($x==0)
	  {
	    ?>
	    <div class="line-list-0" id="div<?php echo($nb_resultats);?>">
	    <?php
	  }
	  else
	  {  
	  ?>
	    <div class="line-list-1" id="div<?php echo($nb_resultats);?>">
	    <?php  
	    }
	  ?>
	  
	      <div class="line-trash">
	      <?php
	      if($user_tutoriel->cat_associe !== "nouveau")
		{
	      ?>
		<a href="#" title="valider" id="valider<?php echo($nb_resultats);?>"><img src="img/valider_moder.png"></a>
		
<!--		class="hidden-lg dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"-->
		
	      <?php
	      }
	      else
	      {
	      echo '<a href="moder_add_dechet.php?id='.$user_tutoriel->id.'" class="moderation" data-fancybox-type="iframe" title="ajouter '.$user_tutoriel->dechet.' comme nouveau dechet"><img src="img/adddechet.png"></a>';
	      }
	      ?>
		<a href="#" title="refuser" id="dropdownMenurefus<?php echo($nb_resultats);?>" class="dropdown-toggle dropdown" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="true"><img src="img/refuse_moder.png"></a>
		<span class="dropdown-menu form_refus" aria-labelledby="dropdownMenurefus<?php echo($nb_resultats);?>"><strong>Raison du refus : <br /></strong><textarea rows="5" cols="50" id="raison<?php echo($nb_resultats);?>"></textarea><br /><span class="btn btn-primary" id="refuser<?php echo($nb_resultats);?>"/>Refuser</span></span>
	      </div>
	
	      <div class="line-photo">
		<?php
		$video = new App\videorecognize($user_tutoriel->img_princ);
		if($user_tutoriel->type=="tutoriel")
		{
		echo('<img src="img/img_princ/'.$user_tutoriel->img_princ.'" class="img-responsive"/>');
		$page="tutoriel.pĥp";
		}
		elseif($user_tutoriel->type=="idee")
		{
		echo('<img src="img/img_princ/'.$user_tutoriel->img_princ.'" class="img-responsive"/>');
		$page="idee.php";
		}
		elseif($user_tutoriel->type=="tutovideo")
		{
		  echo('<img src="'.$video->img_vid().'" class="img-rounded" width="110px">');
		}
		?>
	      </div>
	      
	      <div class="line-comment">
		<strong><a <?php if($user_tutoriel->type=="tutoriel"){echo("href=\"tutoriel.php?id=".$user_tutoriel->id);}elseif($user_tutoriel->type=="idee"){echo("href=\"idee.php?id=".$user_tutoriel->id);}elseif($user_tutoriel->type=="tutovideo"){echo("href=\"tutoriel-video.php?id=".$user_tutoriel->id);}?>"><?php echo("$user_tutoriel->titre");?></a></strong><h5>
		
		<strong>Déchet utilisé : </strong>
		<?php
		  echo("$user_tutoriel->dechet");
		?>&nbsp;-
		
		<strong>Ajouté le : </strong><?php echo("$user_tutoriel->date");?> - &nbsp;<strong>Difficulté : </strong> - 
		<?php 
		for ($i=1;$i<=$user_tutoriel->difficulte;$i++){
		  echo('<span class="rating_full_sm">&starf;</span>');
		}
		for ($i=1;$i<=5-$user_tutoriel->difficulte;$i++){
		  echo('<span class="rating_empty_sm">&starf;</span>');
		}
		?> - <strong>Nb Etapes : </strong><?php echo("$user_tutoriel->nb_etapes");?></h5>
		<h5><?php echo(substr($user_tutoriel->intro, 0, 250));?>...</h5>
		<mini>Source : <?php echo("$user_tutoriel->source");?></mini>
		<mini>Auteur : <?php echo("$user_tutoriel->contributeur");?></mini>
	      </div>
	    </div>
	<?php
	};
	?>
	
	
	
    </div>    	
</section>


<?php require 'inc/pieddepage_inc_new.php'; ?>