<?php
$pdo->query("SET NAMES 'utf8'");
$req = $pdo->prepare("SELECT * FROM contribution WHERE contributeur=? and (type = ? OR type = ?)");
$req->execute([$data->nom,'tutoriel','tutovideo']);
foreach ($req as $post)
{

if($post->type=="tutovideo")
{
  if((substr_count($post->img_princ,'https://youtu.be/')==1)||(substr_count($post->img_princ, 'youtu.be/')==1)||(substr_count($post->img_princ,'https://www.youtube.com/watch?v=')==1))
  {
    $code_youtube=substr($post->img_princ,-11);
    $newimg = new App\blur_image("http://img.youtube.com/vi/".$code_youtube."/0.jpg");
  }
  else
  {
    $newimg = new App\blur_image("img/dechets/poubelle.png");
  }
}
else
{
  $newimg = new App\blur_image("img/img_princ/".$post->img_princ);
}

$div_arrondi="div_arrondi2_tuto";
?>
	<div class="<?php echo $div_arrondi; ?>" style="width:<?php echo($newimg->divwidth()); ?>px; background-image:url(<?php echo($newimg->url); ?>); background-size:  <?php echo($newimg->imgwidth().'px'); ?> <?php echo($newimg->imgheight().'px'); ?>;">
	  <span class="encadre_type">&nbsp;<?php echo($post->type);?>&nbsp;</span>
	  <div class="surcouche">
	  <coeur>
	    <span class="div-coeur">
	      <?php 
	       $id=$post->id;
		require 'inc/ccoeur_vignette.php';
	      ?>
	    </span>
	  </coeur>
	  <?php
		if($post->type == "idee")
		{
		echo '<a href="idee.php?id='.$post->id.'">';
		}
		elseif($post->type == "tutoriel")
		{
		echo '<a href="tutoriel.php?id='.$post->id.'">';
		}
		elseif($post->type == "tutovideo")
		{
		echo '<a href="tutoriel-video.php?id='.$post->id.'">';
		}
		?>
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
		?><br />

		  
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
		<div class="surcouche-ccoeur">
		  
		</div><!--surcouche-content-ccoeur-->
		</div>
		
	      </div><!--surcouche-content-bottom-->
	    </ins></a>
	  </div><!--surcouche-->
	</div><!--$div_arrondi-->
	<?php
}
?>