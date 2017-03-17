<?php
require 'inc/header_inc_new.php';
require 'app/Autoloader.php';
require 'inc/functions.php'; 
\App\Autoloader::register();
?>

<?php
  require_once 'inc/db.php';
  $pdo->query("SET NAMES 'utf8'");
  $req = $pdo->prepare("SELECT * FROM infos_contributeur WHERE id_user = ? and activation = ?");
  $req->execute([$_GET['id'], "oui"]);
  foreach ($req as $data): 
endforeach;
$nom_user=$data->nom;
?>
<style>
.nav-pills > .active > a,
.nav-pills > .active > a:hover,.nav-pills > li > a:hover {
text-decoration: none;

border-radius:0px;
border-bottom-width: 4px;
border-bottom-style: solid;
border-bottom-color: #359d02;
    color: #000000 !important;
  background-color: transparent !important;
}
.nav-pills > li > a{
    border-radius:0px;
}
</style>


<?php
$liste = $pdo->prepare("SELECT dechet FROM contribution WHERE contributeur = ?");
$liste->execute([$nom_user]);
$liste_dechets=array();
foreach ($liste as $dechet):
if(in_array($dechet->dechet, $liste_dechets))
{
  
}
else
{
  $liste_dechets[]=$dechet->dechet;
}
endforeach;

?>

<div class="container-fluid no-padding">
<?php
if($data->photo_fond != "[//VIDE]")
{
?>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height:200px; overflow:hidden; background-image:url('img/img_fond/<?php echo $data->photo_fond; ?>'); background-position:top center; opacity:0.6; background-size:1920px auto;" ></div>
<?php
}
else
{
?>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-image:url('img/defaultcreatorbg.png'); background-repeat:repeat; height:200px;"></div>
<?php
}

?>
  
</div><!--container fluid-->
<div class="row"></div>
<div class="container">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 minus70">
    <div class="row">
      <div class="col-lg-1 col-md-1 col-xs-12 col-sm-12 text-center">
      <?php
      if($data->photo_logo != "[//VIDE]")
      {
	?>
	<img src="img/img_profil/<?php echo $data->photo_logo; ?>" class="img-circle" style="height:auto; width:100px;">
	<?php
      }
      else
      {
	?>
	<img src="img/profil2.png" class="img-circle" style="height:auto; width:100px;">
	<?php
      }
      ?>
      </div>
      <div class="col-lg-offset-1 col-md-offset-1 col-lg-5 col-md-5 visible-lg visible-md hidden-sm hidden-xs">
	<h2><strong><?php echo ucfirst($data->nom); ?></strong></h2>
      </div>
      <div class="col-lg-offset-1 col-md-offset-1 col-lg-5 col-md-5 col-sm-12 col-xs-12 hidden-lg hidden-md visible-sm visible-xs text-center">
	<h2><strong><?php echo ucfirst($data->nom); ?></strong></h2>
      </div>
      <div class="col-lg-12">&nbsp;</div>
      <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-lg-11 col-md-11 col-sm-11 col-xs-11 minus30 "><!--onglets-->
	<!-- Nav tabs -->
	<ul class="nav nav-pills" role="tablist">
	  <li role="presentation" class="active"><a href="#infos" aria-controls="infos" role="tab" data-toggle="tab">Ses Infos</a></li>
	  <li role="presentation"><a href="#tutoriels" aria-controls="tutoriels" role="tab" data-toggle="tab">Ses Tutoriels</a></li>
	  <li role="presentation"><a href="#idees" aria-controls="idees" role="tab" data-toggle="tab">Ses Idées</a></li>
	  <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">Contact</a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
	  
	  <div role="tabpanel" class="tab-pane active" id="infos">
	  
	  <div class="row"><br /></div>
	  <div class="row">
	    <div class="col-lg-6">
	      <?php
	      if(!empty($data->url))
	      {
	      ?>
	      <span class="glyphicon glyphicon-globe"></span> <strong>URL : </strong><br />
	      <?php
		if(substr_count($data->url,'http://')==1 OR substr_count($data->url,'https://')==1)
		{
		  echo "<a href='".$data->url."' target='_blank'>".$data->url."</a>";
		}
		else
		{
		  echo "<a href='http://".$data->url."' target='_blank'>".$data->url."</a>";
		}
	      }
	      ?>
	      <br/><br/>
	      <?php
	      if(!empty($data->boutique))
	      {
	      ?>
	      <span class="glyphicon glyphicon-shopping-cart"></span> <strong>Boutique en ligne : </strong><br/>
	      <?php
	      if(substr_count($data->boutique,'http://')==1 OR substr_count($data->boutique,'https://')==1)
		{
		  echo "<a href='".$data->boutique."' target='_blank'>".$data->boutique."</a>";
		}
		else
		{
		  echo "<a href='http://".$data->boutique."' target='_blank'>".$data->boutique."</a>";
		}
	      }
	      ?>
	      <br/>
	      <br/>
	      <?php
	      if(!empty($data->facebook))
	      {
	      ?>
	       <img src="img/ico/fb_1.png" height="20px"> <strong>Facebook : </strong><br/>
	      <?php
	      if(substr_count($data->facebook,'http://')==1 OR substr_count($data->facebook,'https://')==1)
		{
		  echo "<a href='".$data->facebook."' target='_blank'>".$data->facebook."</a>";
		}
		else
		{
		  echo "<a href='http://".$data->facebook."' target='_blank'>".$data->facebook."</a>";
		}
	      }
	      ?>
	      <br/>
	      <br/>
	      <?php
	      if(!empty($data->adresse) and !empty($data->cp) and !empty($data->ville))
	      {
	      ?>
	      <span class="glyphicon glyphicon-map-marker"></span> <strong>Adresse boutique ou atelier : </strong><br />
	      <?php echo $data->adresse.'<br />'.$data->cp.' '. ucfirst($data->ville);?>
	      <br/>
	      <?php
	      }
	      ?>
	      </div>
	    <div class="col-lg-6 text-justify">
	      <?php
// 		    require('inc/coupcoeur.php');
	      ?><br /><br />
		<strong>Déchets revalorisés : </strong><br />
		<?php
		foreach($liste_dechets as $dechet_unique)
		{
		  echo "<a href='moteur.php?search=".$dechet_unique."'>".ucfirst($dechet_unique).";</a> ";
		}
		?>
		<br /><br />
		
		<strong>En savoir plus sur <?php echo ucfirst($data->nom);?> : </strong><br />
		<?php echo ucfirst(nl2br($data->paragraphe_info));?>
	    </div>
	  </div>
	  
	  </div>
	  
	  <div role="tabpanel" class="tab-pane" id="tutoriels">
	    <div class="repartition">
	      <?php
		require 'tuto_createur.php';
	      ?>
	    </div>
	  </div>
	  <div role="tabpanel" class="tab-pane" id="idees">
	    <div class="repartition">
	      <?php
		require 'idee_createur.php';
	      ?>
	    </div>
	  </div>
	  <div role="tabpanel" class="tab-pane" id="contact">
	      <?php
		require 'contact_createur.php';
	      ?>
	  </div>
	</div>
	<div class="row"></div><br /><br />
	<div class="col-lg-offset-1 col-lg-11"><h3>Quelques-unes de ses contributions... </h3><br />
	</div></div>
	<div class="">	
	<div class="row repartition" style="min-height:200px; background-color:#ececec;">
	<br />
	<!-- DEBUT VIGNETTES -->
<?php	
$req2 = $pdo->prepare("SELECT * FROM contribution WHERE contributeur = ? ORDER BY RAND() LIMIT 4");
$req2->execute([$nom_user]);
foreach ($req2 as $post)
{
  echo '<div class="col-lg-3 text-center">';
  if($post->type=="tutoriel")
  {
    echo '<a href="tutoriel.php?id='.$post->id.'">';
  }
  elseif($post->type=="idee")
  {
    echo '<a href="idee.php?id='.$post->id.'">';
  }
  elseif($post->type=="tutovideo")
  {
    echo '<a href="tutoriel-video.php?id='.$post->id.'">';
  }
  
  if($post->type=="tutovideo")
  {
    if((substr_count($post->img_princ,'https://youtu.be/')==1)||(substr_count($post->img_princ, 'youtu.be/')==1)||(substr_count($post->img_princ,'https://www.youtube.com/watch?v=')==1))
    {
      $code_youtube=substr($post->img_princ,-11);
    }
    echo '<img src="http://img.youtube.com/vi/'.$code_youtube.'/0.jpg" height="150px"><br />';
  }
  else
  {
    echo '<img src="img/img_princ/'.$post->img_princ.'" height="150px"><br />';
  }
  echo ucfirst($post->titre);  
  echo "</a>";
  echo "</div>";
}
?>


      </div><!--fin onglets-->

    </div><!--row-->
  </div><!--col-lg-12 minus70-->
  
</div>

<?php require 'inc/pieddepage_inc_new.php'; ?>





