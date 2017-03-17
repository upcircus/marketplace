<?php
require 'inc/header_inc_new.php';
require 'app/Autoloader.php';

require 'inc/mystrtr.php';
\App\Autoloader::register();
require_once 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");


//Recherche filtré
if(isset($_GET['rech_filter']) && isset($_GET['searcht']))
{
  $val_search=isset($_GET['searcht']) ? $_GET['searcht'] : false;
  $cat_search = isset($_GET['cat']) ? $_GET['cat'] : false;
  $tuto_switch=isset($_GET['tutoswitch']) ? $_GET['tutoswitch']:false;
  $idee_switch=isset($_GET['ideeswitch']) ? $_GET['ideeswitch']:false;
  //$categorie=$_GET['categorie'];
  $nothigh=isset($_GET['notations-high']) ? $_GET['notations-high']:false;
  $notlow=isset($_GET['notations-low']) ? $_GET['notations-low']:false;
  if(isset($_GET['non-note']) && $_GET['non-note']=="oui")
  {
    $nonnote="0";
  }
  else
  {
    $nonnote=$notlow;
  }
  $diffhigh=isset($_GET['difficulte-high']) ? $_GET['difficulte-high']:false;
  $difflow=isset($_GET['difficulte-low']) ? $_GET['difficulte-low']:false;
}

else
{

  $val_search = isset($_GET['search']) ? $_GET['search'] : false;
  $cat_search = isset($_GET['cat']) ? $_GET['cat'] : false;
}


if(isset($_GET['cat']) && $cat_search!=="")
{
  $reponse_exact = $pdo->prepare("SELECT * FROM dechets WHERE nom_dechets = ? AND dechetassocie = ?");
  $reponse_exact->execute([$val_search,$cat_search]);
  $reponse_nb_exact = $pdo->prepare("SELECT COUNT(*) AS nb FROM dechets WHERE nom_dechets = ? AND dechetassocie = ?");
  $reponse_nb_exact->execute([$val_search,$cat_search]);
  $columns_exact = $reponse_nb_exact->fetch();
  $nb_exact = $columns_exact->nb;
}
else
{
  $reponse_exact = $pdo->prepare("SELECT * FROM dechets WHERE MATCH(nom_dechets, dechetassocie, recherche_associee) AGAINST ('".$val_search."' IN BOOLEAN MODE)");
  $reponse_exact->execute();
  $reponse_nb_exact = $pdo->query("SELECT COUNT(*) AS nb FROM dechets WHERE MATCH(nom_dechets, dechetassocie, recherche_associee) AGAINST ('".$val_search."' IN BOOLEAN MODE)");
  $columns_exact = $reponse_nb_exact->fetch();
  $nb_exact = $columns_exact->nb;
}


?>
<script src="js/script_filtre_recherche_mobile.js"></script>
 <a href="#" id="btn-filtre-recherche"><div class="btn-menu-filtre hidden-lg hidden-md text-center"><h2><span class="glyphicon glyphicon-filter"></span></h2><mini>Filtre recherche</mini></div></a>
<?php
require 'inc/search/menu_filtre_mob.php';
?>

<div class="container-fluid">
  <?php 
  if(isset($_GET['search']) || isset($_GET['searcht']))
  {
  ?>
  <div class="row">
    <?php 
    require 'tests/moteur-corps_nb-enregistrement.php';
    ?>
  </div>
  <div class="col-lg-2 col-md-2 hidden-sm hidden-xs" name="filtre">
    <?php 
    require 'tests/test_slider_range.php';
    ?>
  </div><!--fin filtre-->
  <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" name="corps">
    
    <?php
    if(isset($_GET['cat']) && $cat_search!=="")
    {
      $reponse_exact = $pdo->prepare("SELECT * FROM dechets WHERE nom_dechets = ? AND dechetassocie = ?");
      $reponse_exact->execute([$val_search,$cat_search]);
      $reponse_nb_exact = $pdo->prepare("SELECT COUNT(*) AS nb FROM dechets WHERE nom_dechets = ? AND dechetassocie = ?");
      $reponse_nb_exact->execute([$val_search,$cat_search]);
      $columns_exact = $reponse_nb_exact->fetch();
      $nb_exact = $columns_exact->nb;
    }
    else
    {
      $reponse_exact = $pdo->prepare("SELECT * FROM dechets WHERE MATCH(nom_dechets, dechetassocie, recherche_associee) AGAINST ('".$val_search."' IN BOOLEAN MODE)");
      $reponse_exact->execute();
      $reponse_nb_exact = $pdo->query("SELECT COUNT(*) AS nb FROM dechets WHERE MATCH(nom_dechets, dechetassocie, recherche_associee) AGAINST ('".$val_search."' IN BOOLEAN MODE)");
      $columns_exact = $reponse_nb_exact->fetch();
      $nb_exact = $columns_exact->nb;
    }
    $i=0;    
    $nom_cat[$i]="";
    foreach($reponse_exact as $donnees)
    { 
      $req = $pdo->prepare('SELECT * FROM categorie WHERE categorie = ?');
      $req->execute([$donnees->dechetassocie]);
      $cat=$req->fetch();
      if(in_array($donnees->dechetassocie, $nom_cat))
      {
      }
      else
      {
      $nom_cat[$i]=$donnees->dechetassocie;
      ?>
  <div class="row">
        <div class="col-lg-3 col-lg-push-9 col-md-3 col-md-push-9 col-sm-12 col-xs-12" name="membres">
      <strong>DECOUVREZ LES ENTREPRISES DU RESEAU QUI REVALORISENT <?php echo htmlentities(ucfirst($val_search)); ?> (<?php echo htmlentities($donnees->dechetassocie); ?>) : </strong>
      <br />
      <img src="img/logo_membres/971d8beb2fc668e0b212ab06a7aa0efe.png" class="img-thumbnail" width="110px">&nbsp;
      <img src="img/logo_membres/hopaal.png" class="img-thumbnail" width="110px">&nbsp;
      <img src="img/logo_membres/stonecycling.png" class="img-thumbnail" width="110px">
            <img src="img/logo_membres/971d8beb2fc668e0b212ab06a7aa0efe.png" class="img-thumbnail" width="110px">&nbsp;
      <img src="img/logo_membres/hopaal.png" class="img-thumbnail" width="110px">&nbsp;
      <img src="img/logo_membres/stonecycling.png" class="img-thumbnail" width="110px">
            <img src="img/logo_membres/971d8beb2fc668e0b212ab06a7aa0efe.png" class="img-thumbnail" width="110px">&nbsp;
      <img src="img/logo_membres/hopaal.png" class="img-thumbnail" width="110px">&nbsp;
      <img src="img/logo_membres/stonecycling.png" class="img-thumbnail" width="110px">
      <br /><br />
	<div class="text-center"><mini><strong>Vous revalorisez <?php echo htmlentities(ucfirst($val_search)); ?> (<?php echo htmlentities($donnees->dechetassocie); ?>) ? </strong><br />Faites parti du réseau Upcircus et bénéficiez de nombreux avantages dont la visibilité sur notre site ! Contactez-nous !</mini></div>
    </div><!--fin membres-->
  <div class="col-lg-9 col-lg-pull-3 col-md-9 col-md-pull-3 col-sm-12 col-xs-12">
  <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
    <?php
      require 'tests/moteur-corps_details-categories.php';
    ?>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <strong><br />REVALORISATION</strong> autour de : "<?php echo htmlentities(ucfirst($val_search)); ?> (<?php echo htmlentities($donnees->dechetassocie); ?>)"
      <div class="row">
	<?php
	require 'tests/moteur-corps_vignette-reval.php';
	?>
      </div><!--row-->
    </div>
    
    </div>

    <?php
    require 'tests/moteur-corps_enregistrement-requete.php';
    ?>
    </div>
    <?php
      }
    }
    require 'tests/moteur-corps_levenshtein.php';
    ?>
    
  </div><!--fin corps-->

  
  <div class="row">&nbsp;</div>
  <div class="row">&nbsp;</div>


  
<!-- Si pas de recherche effectuee (search n'existe pas)-->
<?php
}
else
{ 
?>
<script src="js/script-autocomplete_ajouter-xx.js"></script>    
  <h2 class="text-center">Recherchez un déchet</h2>

    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
      <form id="form" class="form-horizontal" role="form" action="<?php echo($_SERVER['PHP_SELF']);?>" method="GET">
	<div class="form-group">
	    <div class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10">
	      <div class="input-group" id="box">
	      <input type="text" name ="search" id="searcht" class = "form-control" maxlength="255" placeholder="exemple : carton, bouteille..."/>
	      <input type="hidden" name = "cat" id="searcht-cat">
		<span class="input-group-btn">
		  <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		</span>
	      </div>
	    </div>
	</div>
      </form>
    </div>
 <?php 

} 
?>

</div><!--fin container-fluid-->

<?php
require 'inc/pieddepage_inc_new.php';
?>