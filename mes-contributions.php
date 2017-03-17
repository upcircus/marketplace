<?php

require 'inc/functions.php'; 
logged_only('mes-contributions.php');
require 'app/Autoloader.php';

\App\Autoloader::register();
require 'inc/header_inc_new.php';

require_once 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");
$req_toutes = $pdo->prepare("SELECT * FROM contribution WHERE contributeur = ? ORDER BY id DESC");
$req_toutes->execute([$_SESSION['auth']->username]);
$nb_toutes = $req_toutes->rowCount();

$req_recyclage = $pdo->prepare("SELECT * FROM contribution WHERE contributeur = ? AND type = 'recyclage' ORDER BY id DESC");
$req_recyclage->execute([$_SESSION['auth']->username]);
$nb_recyclage = $req_recyclage->rowCount();

$req_idee = $pdo->prepare("SELECT * FROM contribution WHERE contributeur = ? AND type = 'idee' ORDER BY id DESC");
$req_idee->execute([$_SESSION['auth']->username]);
$nb_idee = $req_idee->rowCount();

$req_tutoriel = $pdo->prepare("SELECT * FROM contribution WHERE contributeur = ? AND (type = 'tutoriel' OR type = 'tutovideo') ORDER BY id DESC");
$req_tutoriel->execute([$_SESSION['auth']->username]);
$nb_tutoriel = $req_tutoriel->rowCount();


?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});
</script>

<section>    
<ol class="breadcrumb" style="background-color:#fff;">


	  
  <li><a href="account.php">Tableau de bord</a></li>
  <li class="active">Mes contributions</li>
</ol>  
  <div class="container">

  <h2 class="text-center"><?php echo ucfirst($_SESSION['auth']->username);?>, voici vos contributions : </h2>

    <!--onglets-->
    <!--bootstrap tabs-->
    <ul class="nav nav-tabs">
      <li
	<?php 
	if(!empty($_GET["on"])&&$_GET["on"]==1){
	echo('class="active"');
	}
	elseif(empty($_GET["on"]))
	{
	echo('class="active"');  
	}
	?>><a data-toggle="tab" href="#tutoriel">Tutoriels &nbsp;<span class="badge"><?php echo($nb_tutoriel); ?></span></a>
      </li>
      <li   
	<?php 
	if(!empty($_GET["on"])&&$_GET["on"]==2){
	echo('class="active"');
	}
	?>><a data-toggle="tab" href="#idee">Idées &nbsp;<span class="badge"><?php echo($nb_idee); ?></span></a>
      </li>
      <li   
	<?php 
	if(!empty($_GET["on"])&&$_GET["on"]==4){
	echo('class="active"');
	}
	?>><a data-toggle="tab" href="#toutes">Toutes &nbsp;<span class="badge"><?php echo($nb_toutes); ?></span></a>
      </li>
    </ul>

    <div class="tab-content">
      <div id="tutoriel" class="tab-pane fade <?php if($_GET["on"]==1){echo('in active');}?>">
	<?php
	$nb_resultats=0;
	while($user_tutoriel = $req_tutoriel->fetch())
	{
	  $nb_resultats=$nb_resultats+1;
	  $x=$nb_resultats%2;
	?>
	    <script>
	    $(document).ready(function(){
	    $("#trash1<?php echo($nb_resultats);?>").click(function(){
	    var r = confirm("Cette contribution sera définitivement supprimé. \nÊtes-vous sûr de vouloir la supprimer ?");
	    if (r == true) {
		$.post("demo_remove.php",
		{
		    id:<?php echo($user_tutoriel->id);?>

		});
		$("#div1<?php echo($nb_resultats);?>").remove();
		}
		});
	    });
	    </script>


	  <?php
	  if($x==0)
	  {
	    ?>
	    <div class="line-list-0" id="div1<?php echo($nb_resultats);?>">
	    <?php
	  }
	  else
	  {  
	  ?>
	    <div class="line-list-1" id="div1<?php echo($nb_resultats);?>">
	    <?php  
	    }
	  ?>
	  
	      <div class="line-trash">
	      <script>
		$(document).ready(function(){
		$("#parttuto<?php echo($nb_resultats);?>").click(function(){
		$("#liensoctuto<?php echo($nb_resultats);?>").toggle();
		});

		});
		
	      </script>
	      <script>
	      function fonction_fb_tuto()
	      {
		window.open('http://www.facebook.com/sharer/sharer.php?u=http://upcircus.fr/idee.php?id=<?php echo($user_tutoriel->id);?>','_blank');
	      }
	      function fonction_tt_tuto()
	      {
		window.open('https://twitter.com/intent/tweet?url=http://upcircus.fr/idee.php?id=<?php echo($user_tutoriel->id);?>','_blank');
	      }
	      function fonction_gp_tuto()
	      {
		window.open('https://plus.google.com/share?url=http://upcircus.fr/idee.php?id=<?php echo($user_tutoriel->id);?>','_blank');
	      }
	      </script>
	     
		<span style = "cursor:  pointer;" id="parttuto<?php echo($nb_resultats);?>" title="Partager"><img src="css/img/node-link-black.png"></span>
		<div class="partage" id="liensoctuto<?php echo($nb_resultats);?>">
		<span style = "cursor:  pointer;" onclick="fonction_fb_tuto()";><img src="img/soc1.png" height="30" width="30"></span><br />
		<span style = "cursor:  pointer;" onclick="fonction_tt_tuto()";><img src="img/soc2.png" height="30" width="30"></span><br />
		<span style = "cursor:  pointer;" onclick="fonction_gp_tuto()";><img src="img/soc3.png" height="30" width="30"></span></div>
		<span style = "cursor:  pointer;" title="Supprimer" id="trash1<?php echo($nb_resultats);?>"><img src="css/img/trash-black.png"></span>
	      </div>

	      <div class="line-photo">
		<?php
		$video = new App\videorecognize($user_tutoriel->img_princ);
		
		if($user_tutoriel->type=="tutoriel")
		{
		echo('<img src="img/img_princ/'.$user_tutoriel->img_princ.'" class="img-rounded" width="110px"/>');
		}
		elseif($user_tutoriel->type=="tutovideo")
		{
		  echo('<img src="'.$video->img_vid().'" class="img-rounded" width="110px">');
		}
		?>
	      </div>
	      
	      <div class="line-comment">
	     
		<strong><a <?php if($user_tutoriel->type=="tutoriel"){echo("href=\"tutoriel.php?id=".$user_tutoriel->id);}elseif($user_tutoriel->type=="tutovideo"){echo("href=\"tutoriel-video.php?id=".$user_tutoriel->id);}?>"><?php echo("$user_tutoriel->titre");?></a></strong><h5><strong>Déchet utilisé : </strong><?php echo("$user_tutoriel->dechet");?>&nbsp;-
		<strong>Ajouté le : </strong><?php echo("$user_tutoriel->date");?> - 
		&nbsp;
		<strong>Difficulté : </strong>
		<?php 
		for ($i=1;$i<=$user_tutoriel->difficulte;$i++){
		  echo('<span class="rating_full_sm">&starf;</span>');
		}
		for ($i=1;$i<=5-$user_tutoriel->difficulte;$i++){
		  echo('<span class="rating_empty_sm">&starf;</span>');
		}
		?></h5>
		
		<h5><?php echo(substr($user_tutoriel->intro, 0, 250));?>...</h5>
		<mini><strong>Source : </strong><?php echo("$user_tutoriel->source");?></mini>
		<mini> - <strong>Status : </strong>
		<?php 
		if($user_tutoriel->publication == "brouillon")
		{
		  echo("Brouillon");
		}
		elseif($user_tutoriel->publication == "publier" && $user_tutoriel->valide=="non")
		{
		  echo("En cours de publication");
		}
		elseif($user_tutoriel->publication == "publier" && $user_tutoriel->valide=="oui")
		{
		  echo("Publié");
		}
		?>
		
		</mini>
	      </div>
	      
	    </div>
	<?php
	};
	?>
      </div>    	

      
      <div id="idee" class="tab-pane fade <?php if($_GET["on"]==2){echo('in active');}?>">
   
      <?php
	$nb_resultats=0;
	while($user_idee = $req_idee->fetch())
	{
	  $nb_resultats=$nb_resultats+1;
	  $x=$nb_resultats%2;

	    ?>
	   <script>
	    $(document).ready(function(){
	    $("#trash2<?php echo($nb_resultats);?>").click(function(){
	    var r = confirm("Cette contribution sera définitivement supprimé. \nÊtes-vous sûr de vouloir la supprimer ?");
	    if (r == true) {
		$.post("demo_remove.php",
		{
		    id:<?php echo($user_idee->id);?>

		});
		$("#div2<?php echo($nb_resultats);?>").remove();
		}
		});
	    });
	   
	    </script>


	  <?php
	  if($x==0)
	  {
	    ?>
	    <div class="line-list-0" id="div2<?php echo($nb_resultats);?>">
	    <?php
	  }
	  else
	  {  
	  ?>
	    <div class="line-list-1" id="div2<?php echo($nb_resultats);?>">
	    <?php  
	    }
	  ?>

	      <div class="line-trash">
	      <script>
		$(document).ready(function(){
		$("#partidee<?php echo($nb_resultats);?>").click(function(){
		$("#liensocidee<?php echo($nb_resultats);?>").toggle();
		});

		});
		
	      </script>
	      <script>
	      function fonction_fb_idee()
	      {
		window.open('http://www.facebook.com/sharer/sharer.php?u=http://upcircus.fr/idee.php?id=<?php echo($user_idee->id);?>','_blank');
	      }
	      function fonction_tt_idee()
	      {
		window.open('https://twitter.com/intent/tweet?url=http://upcircus.fr/idee.php?id=<?php echo($user_idee->id);?>','_blank');
	      }
	      function fonction_gp_idee()
	      {
		window.open('https://plus.google.com/share?url=http://upcircus.fr/idee.php?id=<?php echo($user_idee->id);?>','_blank');
	      }
	      </script>
	     
		<span style = "cursor:  pointer;" id="partidee<?php echo($nb_resultats);?>" title="Partager"><img src="css/img/node-link-black.png"></span>
		<div class="partage" id="liensocidee<?php echo($nb_resultats);?>">
		<span style = "cursor:  pointer;" onclick="fonction_fb_idee()";><img src="img/soc1.png" height="30" width="30"></span><br />
		<span style = "cursor:  pointer;" onclick="fonction_tt_idee()";><img src="img/soc2.png" height="30" width="30"></span><br />
		<span style = "cursor:  pointer;" onclick="fonction_gp_idee()";><img src="img/soc3.png" height="30" width="30"></span></div>
		<span style = "cursor:  pointer;" title="Supprimer" id="trash2<?php echo($nb_resultats);?>"><img src="css/img/trash-black.png"></span>
	      </div>
	
	      <div class="line-photo">
		<?php
		echo('<img src="img/img_princ/'.$user_idee->img_princ.'" class="img-rounded" width="110px"/>');
		?>
	      </div>
	      
	      <div class="line-comment">
		<strong><a href="idee.php?id=<?php echo("$user_idee->id");?>"><?php echo("$user_idee->titre");?></a></strong><h5><strong>Déchet utilisé : </strong><?php echo("$user_idee->dechet");?>&nbsp;-
		<strong>Ajouté le : </strong><?php echo("$user_idee->date");?> - 
		&nbsp;
		<strong>Difficulté : </strong>
		<?php 
		for ($i=1;$i<=$user_idee->difficulte;$i++){
		  echo('<span class="rating_full_sm">&starf;</span>');
		}
		for ($i=1;$i<=5-$user_idee->difficulte;$i++){
		  echo('<span class="rating_empty_sm">&starf;</span>');
		}
		?></h5>
		
		<h5><?php echo(substr($user_idee->intro, 0, 250));?>...</h5>
		<mini><strong>Source : </strong><?php echo("$user_idee->source");?></mini>
		<mini> - <strong>Status : </strong>
		<?php 
		if($user_idee->publication == "brouillon")
		{
		  echo("Brouillon");
		}
		elseif($user_idee->publication == "publier" && $user_idee->valide=="non")
		{
		  echo("En cours de publication");
		}
		elseif($user_idee->publication == "publier" && $user_idee->valide=="oui")
		{
		  echo("Publié");
		}
		?>
		
		</mini>
	      </div>
	      
	    </div>
	<?php
	};
	?>
      
       </div>
      
      <div id="toutes" class="tab-pane fade <?php if($_GET["on"]==4){echo('in active');}?>">
      <?php
	$nb_resultats=0;
	while($user_toutes = $req_toutes->fetch())
	{
	  $nb_resultats=$nb_resultats+1;
	  $x=$nb_resultats%2;

	    ?>
	  <script>
	    $(document).ready(function(){
	    $("#trash4<?php echo($nb_resultats);?>").click(function(){
	    var r = confirm("Cette contribution sera définitivement supprimé. \nÊtes-vous sûr de vouloir la supprimer ?");
	    if (r == true) {
		$.post("demo_remove.php",
		{
		    id:<?php echo($user_toutes->id);?>

		});
		$("#div4<?php echo($nb_resultats);?>").remove();
		}
		});
	    });
	   
	    </script>


	  <?php
	  if($x==0)
	  {
	    ?>
	    <div class="line-list-0" id="div4<?php echo($nb_resultats);?>">
	    <?php
	  }
	  else
	  {  
	  ?>
	    <div class="line-list-1" id="div4<?php echo($nb_resultats);?>">
	    <?php  
	    }
	  ?>

	
		<div class="line-photo">
		<?php
		$video = new App\videorecognize($user_toutes->img_princ);
		if($user_toutes->type=="tutoriel")
		{
		echo('<img src="img/img_princ/'.$user_toutes->img_princ.'" class="img-responsive"/>');
		$page="tutoriel.pĥp";
		}
		elseif($user_toutes->type=="idee")
		{
		echo('<img src="img/img_princ/'.$user_toutes->img_princ.'" class="img-responsive"/>');
		$page="idee.php";
		}
		elseif($user_toutes->type=="tutovideo")
		{
		  echo('<img src="'.$video->img_vid().'" class="img-rounded" width="110px">');
		}
		?>
	      </div>
	      
	      <div class="line-trash">
	      <script>
		$(document).ready(function(){
		$("#part<?php echo($nb_resultats);?>").click(function(){
		$("#liensoc<?php echo($nb_resultats);?>").toggle();
		var liens1="http://www.facebook.com/sharer/sharer.php?u=http://upcircus.fr/moteur/tutoriel?id=<?php echo($user_toutes->id);?>";

		});

		});
		
	      </script>
	      <script>
	      function fonction_fb()
	      {
		window.open('http://www.facebook.com/sharer/sharer.php?u=http://upcircus.fr/<?php echo $page; ?>?id=<?php echo($user_toutes->id);?>','_blank');
	      }
	      function fonction_tt()
	      {
		window.open('https://twitter.com/intent/tweet?url=http://upcircus.fr/<?php echo $page; ?>?id=<?php echo($user_toutes->id);?>','_blank');
	      }
	      function fonction_gp()
	      {
		window.open('https://plus.google.com/share?url=http://upcircus.fr/<?php echo $page; ?>?id=<?php echo($user_toutes->id);?>','_blank');
	      }
	      </script>
	     
		<span id="part<?php echo($nb_resultats);?>" title="Partager" style = "cursor:  pointer;"><img src="css/img/node-link-black.png"></span>
		<div class="partage" id="liensoc<?php echo($nb_resultats);?>">
		<span style = "cursor:  pointer;" onclick="fonction_fb()";><img src="img/soc1.png" height="30" width="30"></span><br />
		<span style = "cursor:  pointer;" onclick="fonction_tt()";><img src="img/soc2.png" height="30" width="30"></span><br />
		<span style = "cursor:  pointer;" onclick="fonction_gp()";><img src="img/soc3.png" height="30" width="30"></span></div>
		<?php
		if($user_toutes->publication=="brouillon")
		{
		?>
		<a href="modifier_tutoriel.php?id=<?php echo($user_toutes->id); ?>" title="Modifier"><img src="css/img/pencil-black.png"></a>
		<?php
		}
		?>
		<span style = "cursor:  pointer;" title="Supprimer" id="trash4<?php echo($nb_resultats);?>"><img src="css/img/trash-black.png"></span>
	      </div>
	      <div class="line-comment">
		<strong><a <?php if($user_toutes->type=="tutoriel"){echo("href=\"tutoriel.php?id=".$user_toutes->id);}elseif($user_toutes->type=="idee"){echo("href=\"idee.php?id=".$user_toutes->id);}elseif($user_toutes->type=="tutovideo"){echo("href=\"tutoriel-video.php?id=".$user_toutes->id);}?>"><?php echo("$user_toutes->titre");?></a></strong><h5><strong>Déchet utilisé : </strong><?php echo("$user_toutes->dechet");?>&nbsp;-
		<strong>Ajouté le : </strong><?php echo("$user_toutes->date");?> - 
		&nbsp;
		<strong>Difficulté : </strong>
		<?php 
		for ($i=1;$i<=$user_toutes->difficulte;$i++){
		  echo('<span class="rating_full_sm">&starf;</span>');
		}
		for ($i=1;$i<=5-$user_toutes->difficulte;$i++){
		  echo('<span class="rating_empty_sm">&starf;</span>');
		}
		?></h5>
		
		<h5><?php echo(substr($user_toutes->intro, 0, 250));?>...</h5>
		<mini><strong>Source : </strong><?php echo("$user_toutes->source");?></mini>
		<mini> - <strong>Status : </strong>
		<?php 
		if($user_toutes->publication == "brouillon")
		{
		  echo("Brouillon");
		}
		elseif($user_toutes->publication == "publier" && $user_toutes->valide=="non")
		{
		  echo("En cours de publication");
		}
		elseif($user_toutes->publication == "publier" && $user_toutes->valide=="oui")
		{
		  echo("Publié");
		}
		?>
		
		</mini>
	      </div>
	      
	    </div>
	<?php
	};
	?>
      
       </div>
	  
	  
	  
	  
	  
	  
	  
	  
	  
      </div>
    </div>
</section>

<?php require 'inc/pieddepage_inc_new.php'; ?>