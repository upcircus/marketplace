<?php
require 'inc/functions.php';
logged_only('coup-de-coeur.php');
require 'inc/header_inc_new.php';
require 'app/Autoloader.php';
\App\Autoloader::register();
require_once 'inc/db.php';

$req = $pdo->prepare("SELECT * FROM up_usr_".$_SESSION['auth']->username." WHERE coupscoeur = ?");
$req->execute(['1']);

$id_contrib="";
foreach ($req as $donnee)
{
$id_contrib=$id_contrib.",".$donnee->id_contrib;
}
$coma_position=strlen($id_contrib)-1;
$id_contrib=substr($id_contrib,-$coma_position,$coma_position);

if($id_contrib!==FALSE)
{
$req_idee = $pdo->query("SELECT * FROM contribution WHERE id IN (".$id_contrib.") AND type = 'idee'");
$req_tuto = $pdo->query("SELECT * FROM contribution WHERE id IN (".$id_contrib.") AND (type = 'tutoriel' or type = 'tutovideo')");
$req_tous = $pdo->query("SELECT * FROM contribution WHERE id IN (".$id_contrib.")");

?>
<ol class="breadcrumb" style="background-color:#fff;">
  <li><a href="account.php">Tableau de bord</a></li>
  <li class="active">Mes coups-de-coeur</li>
</ol>  
<h2 class="text-center">Vos coups de coeur</h2>
<div class="container">

<!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" <?php 
	if(!empty($_GET["on"])&&$_GET["on"]==1){
	echo('class="active"');
	}
	?>><a href="#idee" aria-controls="idee" role="tab" data-toggle="tab">Idées</a></li>
    <li role="presentation" <?php 
	if(!empty($_GET["on"])&&$_GET["on"]==2){
	echo('class="active"');
	}
	?>><a href="#tutoriels" aria-controls="tutoriels" role="tab" data-toggle="tab">Tutoriels</a></li>
    <li role="presentation" <?php 
	if(!empty($_GET["on"])&&$_GET["on"]==4){
	echo('class="active"');
	}
	elseif(empty($_GET["on"]))
	{
	echo('class="active"');  
	}
	?>><a href="#tous" aria-controls="tous" role="tab" data-toggle="tab">Tous</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade <?php if($_GET["on"]==1){echo('in active');}?>" id="idee">
      <div class="repartition">
<?php      
foreach ($req_idee as $post)
{
		$video = new App\videorecognize($post->img_princ);
		if($post->type=="tutoriel" OR $post->type=="idee")
		{
		  $newimg = new App\blur_image("img/img_princ/".$post->img_princ);
		}
		elseif($post->type=="tutovideo")
		{
		  $newimg = new App\blur_image($video->img_vid());
		}


$div_arrondi="div_arrondi2_tuto";
?>
	<div class="<?php echo $div_arrondi; ?>" style="width:<?php echo($newimg->divwidth()); ?>px; background-image:url(<?php echo($newimg->url); ?>); background-size:  <?php echo($newimg->imgwidth().'px'); ?> <?php echo($newimg->imgheight().'px'); ?>;">
	  <div class="surcouche">
	  <span class="encadre_type">&nbsp;<?php echo($post->type);?>&nbsp;</span>
	    <ins>
	      <div class="surcouche-content-titre">
		

		
		<?php echo mb_strimwidth(ucfirst($post->titre),0,25,"..."); ?>
	      </div>
	      <div class="surcouche-content-mp">
		<br /><strong>Revalorisation :</strong> <?php echo ucfirst($post->dechet); ?>
		<br /><strong>Par: </strong><?php echo ucfirst($post->contributeur); ?>
	      </div>
	      <div class="surcouche-content-rates">
	      <?php if($post->type=="tutoriel" || $post->type=="tutovideo")
	      {
	      ?>
		<mini>Difficulté :</mini>&nbsp;
		<?php 
		  for ($i=1;$i<=$post->difficulte;$i++){
		    echo('<span class="rating_full_sm">&starf;</span>');
		  }
		  for ($i=1;$i<=5-$post->difficulte;$i++){
		    echo('<span class="rating_empty_sm">&starf;</span>');
		  }
		}
		?>
		<br />
		<mini>Notation :</mini>&nbsp;<span id="notemoyenne">
		<?php
		if($post->note!=="0")
		{
		  for($i=1;$i<=round($post->note);$i++)
		      {
			echo('<span class="rating_full_sm">&starf;</span>');
		      }
		      for($i=5;$i>round($post->note);$i--)
		      {
			echo('<span class="rating_empty_sm">&starf;</span>');
		      }
		  echo '<mini>&nbsp;('.round($post->note,1).')</mini>'; 
		}
		elseif($post->note=="0")
		{
		  echo("<mini>Pas de notation</mini>");
		}
		?>
	      </span>
	      </div>
	      <div class="surcouche-content-bottom">
		<div class="surcouche-bottomleft">
		</div>
		<div class="surcouche-voirtout">
		<?php
		if($post->type == "idee")
		{
		echo '<a class="btn btn-default btn-xs" href="idee.php?id='.$post->id.'">';
		}
		elseif($post->type == "tutoriel")
		{
		echo '<a class="btn btn-default btn-xs" href="tutoriel.php?id='.$post->id.'">';
		}
		elseif($post->type == "tutovideo")
		{
		echo '<a class="btn btn-default btn-xs" href="tutoriel-video.php?id='.$post->id.'">';
		}
		?>
		Voir</a>
		</div>
		<div class="surcouche-ccoeur">
		  <?php 
		  $id=$post->id;
		  require 'inc/ccoeur_vignette.php';?>
		</div><!--surcouche-content-ccoeur-->
	      </div><!--surcouche-content-bottom-->
	    </ins>
	  </div><!--surcouche-->
	</div><!--$div_arrondi-->
	<?php
}
?>
      </div><!--repartition-->
    </div><!--idee-->
    
    <div role="tabpanel" class="tab-pane fade <?php if($_GET["on"]==2){echo('in active');}?>" id="tutoriels">
      <div class="repartition">
<?php      
      foreach ($req_tuto as $post)
{
		$video = new App\videorecognize($post->img_princ);
		if($post->type=="tutoriel" OR $post->type=="idee")
		{
		  $newimg = new App\blur_image("img/img_princ/".$post->img_princ);
		}
		elseif($post->type=="tutovideo")
		{
		  $newimg = new App\blur_image($video->img_vid());
		}


$div_arrondi="div_arrondi2_tuto";
?>
	<div class="<?php echo $div_arrondi; ?>" style="width:<?php echo($newimg->divwidth()); ?>px; background-image:url(<?php echo($newimg->url); ?>); background-size:  <?php echo($newimg->imgwidth().'px'); ?> <?php echo($newimg->imgheight().'px'); ?>;">
	  <div class="surcouche">
	  <span class="encadre_type">&nbsp;<?php echo($post->type);?>&nbsp;</span>
	    <ins>
	      <div class="surcouche-content-titre">
		

		
		<?php echo mb_strimwidth(ucfirst($post->titre),0,25,"..."); ?>
	      </div>
	      <div class="surcouche-content-mp">
		<br /><strong>Revalorisation :</strong> <?php echo ucfirst($post->dechet); ?>
		<br /><strong>Par: </strong><?php echo ucfirst($post->contributeur); ?>
	      </div>
	      <div class="surcouche-content-rates">
	      <?php if($post->type=="tutoriel" || $post->type=="tutovideo")
	      {
	      ?>
		<mini>Difficulté :</mini>&nbsp;
		<?php 
		  for ($i=1;$i<=$post->difficulte;$i++){
		    echo('<span class="rating_full_sm">&starf;</span>');
		  }
		  for ($i=1;$i<=5-$post->difficulte;$i++){
		    echo('<span class="rating_empty_sm">&starf;</span>');
		  }
		}
		?>
		<br />
		<mini>Notation :</mini>&nbsp;<span id="notemoyenne">
		<?php
		if($post->note!=="0")
		{
		  for($i=1;$i<=round($post->note);$i++)
		      {
			echo('<span class="rating_full_sm">&starf;</span>');
		      }
		      for($i=5;$i>round($post->note);$i--)
		      {
			echo('<span class="rating_empty_sm">&starf;</span>');
		      }
		  echo '<mini>&nbsp;('.round($post->note,1).')</mini>'; 
		}
		elseif($post->note=="0")
		{
		  echo("<mini>Pas de notation</mini>");
		}
		?>
	      </span>
	      </div>
	      <div class="surcouche-content-bottom">
		<div class="surcouche-bottomleft">
		</div>
		<div class="surcouche-voirtout">
		<?php
		if($post->type == "idee")
		{
		echo '<a class="btn btn-default btn-xs" href="idee.php?id='.$post->id.'">';
		}
		elseif($post->type == "tutoriel")
		{
		echo '<a class="btn btn-default btn-xs" href="tutoriel.php?id='.$post->id.'">';
		}
		elseif($post->type == "tutovideo")
		{
		echo '<a class="btn btn-default btn-xs" href="tutoriel-video.php?id='.$post->id.'">';
		}
		?>
		Voir</a>
		</div>
		<div class="surcouche-ccoeur">
		  <?php 
		  $id=$post->id;
		  require 'inc/ccoeur_vignette.php';?>
		</div><!--surcouche-content-ccoeur-->
	      </div><!--surcouche-content-bottom-->
	    </ins>
	  </div><!--surcouche-->
	</div><!--$div_arrondi-->
	<?php
}
?>
      </div><!--repartition-->
    </div><!--tutoriels-->
    
    <div role="tabpanel" class="tab-pane fade <?php if($_GET["on"]==4){echo('in active');}?>" id="tous">
      <div class="repartition">
<?php      
      foreach ($req_tous as $post)
{
		$video = new App\videorecognize($post->img_princ);
		if($post->type=="tutoriel" OR $post->type=="idee")
		{
		  $newimg = new App\blur_image("img/img_princ/".$post->img_princ);
		}
		elseif($post->type=="tutovideo")
		{
		  $newimg = new App\blur_image($video->img_vid());
		}


$div_arrondi="div_arrondi2_tuto";
?>
	<div class="<?php echo $div_arrondi; ?>" style="width:<?php echo($newimg->divwidth()); ?>px; background-image:url(<?php echo($newimg->url); ?>); background-size:  <?php echo($newimg->imgwidth().'px'); ?> <?php echo($newimg->imgheight().'px'); ?>;">
	  <div class="surcouche">
	  <span class="encadre_type">&nbsp;<?php echo($post->type);?>&nbsp;</span>
	    <ins>
	      <div class="surcouche-content-titre">
		

		
		<?php echo mb_strimwidth(ucfirst($post->titre),0,25,"..."); ?>
	      </div>
	      <div class="surcouche-content-mp">
		<br /><strong>Revalorisation :</strong> <?php echo ucfirst($post->dechet); ?>
		<br /><strong>Par: </strong><?php echo ucfirst($post->contributeur); ?>
	      </div>
	      <div class="surcouche-content-rates">
	      <?php if($post->type=="tutoriel" || $post->type=="tutovideo")
	      {
	      ?>
		<mini>Difficulté :</mini>&nbsp;
		<?php 
		  for ($i=1;$i<=$post->difficulte;$i++){
		    echo('<span class="rating_full_sm">&starf;</span>');
		  }
		  for ($i=1;$i<=5-$post->difficulte;$i++){
		    echo('<span class="rating_empty_sm">&starf;</span>');
		  }
		}
		?>
		<br />
		<mini>Notation :</mini>&nbsp;<span id="notemoyenne">
		<?php
		if($post->note!=="0")
		{
		  for($i=1;$i<=round($post->note);$i++)
		      {
			echo('<span class="rating_full_sm">&starf;</span>');
		      }
		      for($i=5;$i>round($post->note);$i--)
		      {
			echo('<span class="rating_empty_sm">&starf;</span>');
		      }
		  echo '<mini>&nbsp;('.round($post->note,1).')</mini>'; 
		}
		elseif($post->note=="0")
		{
		  echo("<mini>Pas de notation</mini>");
		}
		?>
	      </span>
	      </div>
	      <div class="surcouche-content-bottom">
		<div class="surcouche-bottomleft">
		</div>
		<div class="surcouche-voirtout">
		<?php
		if($post->type == "idee")
		{
		echo '<a class="btn btn-default btn-xs" href="idee.php?id='.$post->id.'">';
		}
		elseif($post->type == "tutoriel")
		{
		echo '<a class="btn btn-default btn-xs" href="tutoriel.php?id='.$post->id.'">';
		}
		elseif($post->type == "tutovideo")
		{
		echo '<a class="btn btn-default btn-xs" href="tutoriel-video.php?id='.$post->id.'">';
		}
		?>
		Voir</a>
		</div>
		<div class="surcouche-ccoeur">
		  <?php 
		  $id=$post->id;
		  require 'inc/ccoeur_vignette.php';?>
		</div><!--surcouche-content-ccoeur-->
	      </div><!--surcouche-content-bottom-->
	    </ins>
	  </div><!--surcouche-->
	</div><!--$div_arrondi-->
	<?php
}
?>
      </div><!--repartition-->
    </div><!--tous-->
    
  </div><!--tab-content-->
  <?php
  }
else
{
echo "<br />Vous n'avez pas encore de coup-de-coeurs. Parcourez le site et sauvegardez des idées et des tutoriels ! Ils apparaitront sur cette page. <br /><br /><br /><br /><br />";
}
?>
</div><!--container-->

<?php require 'inc/pieddepage_inc_new.php'; ?>