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

elseif(isset($_GET['searchfam']))
{
$searchfam=$_GET['searchfam'];
$cat_famille=$_GET['searchfam'];
}
else
{
  $val_search = isset($_GET['search']) ? $_GET['search'] : false;
  $cat_search = isset($_GET['cat']) ? $_GET['cat'] : false;
}

if(isset($_GET['cat-famille']))
{
  $cat_famille=$_GET['cat-famille'];
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
elseif(isset($_GET['searchfam']) && $searchfam!=="")
{
$prems = $pdo->prepare("SELECT dechet FROM contribution WHERE categorie = ?");
$prems->execute([$searchfam]);
$res_dech="'";
foreach($prems as $donnees)
{
  $res_dech=$donnees->dechet.'\', \''.$res_dech;
}
$res_dech = substr($res_dech, 0, -4);
$res_dech = "'".$res_dech;
$reponse_exact = $pdo->query("SELECT * FROM dechets WHERE nom_dechets IN (".$res_dech.")");
$reponse_nb_exact = $pdo->query("SELECT COUNT(*) AS nb FROM dechets");
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
 <span id="btn-filtre-recherche" style="cursor:pointer;"><div class="btn-menu-filtre hidden-lg hidden-md text-center"><h2><span class="glyphicon glyphicon-filter"></span></h2><mini>Filtre recherche</mini></div></span>
<?php
require 'inc/search/menu_filtre_mob.php';
?>

<div class="container-fluid">
  <?php 
  if(isset($_GET['search'])||isset($_GET['searcht'])||isset($_GET['searchfam']))
  {
  ?>
  <div class="row">
    <?php 
    require 'inc/search/moteur-corps_nb-enregistrement.php';
    ?>
  </div>
  <div class="col-lg-2 col-md-2 hidden-sm hidden-xs" name="filtre">
    <?php 
    require 'inc/search/moteur-corps_filtre_recherche.php';
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
    elseif(isset($_GET['searchfam']) && $searchfam!=="")
    {
	$prems = $pdo->prepare("SELECT dechet FROM contribution WHERE categorie = ?");
	$prems->execute([$searchfam]);
	$res_dech="'";
	foreach($prems as $donnees)
	{
	$res_dech=$donnees->dechet.'\', \''.$res_dech;
	}
	$res_dech = substr($res_dech, 0, -4);
	$res_dech = "'".$res_dech;
	$reponse_exact = $pdo->query("SELECT * FROM dechets WHERE nom_dechets IN (".$res_dech.")");
	$reponse_nb_exact = $pdo->query("SELECT COUNT(*) AS nb FROM dechets");
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
	$nom_dech[]=$donnees->nom_dechets;
	$nom_cat2[]=$donnees->dechetassocie;
      }
      else
      {
	$nom_dech[$i]=$donnees->nom_dechets;
	$nom_cat[$i]=$donnees->dechetassocie;
	$nom_cat2[$i]=$donnees->dechetassocie;
      }

      $i++;
    }
      ?>
  <?php
if($nom_cat[0]!=="")
{$j=0;
  foreach($nom_cat as &$nb_cat)
  {


  ?>
  <div class="row">

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
    <?php
      require 'inc/search/moteur-corps_details-categories.php';
    ?>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <strong><br />REVALORISATION</strong> autour de : "<?php if(isset($_GET['searchfam'])){echo $_GET['searchfam'];} else{echo htmlentities(ucfirst($val_search)); echo " (".htmlentities($nb_cat).")";} ?>"
      <div class="row">
      <div class="repartition">
      <?php
         for($k=0;$k<=count($nom_dech);$k++)
    {
      if(isset($nom_cat2[$k]) && $nom_cat2[$k] == $nb_cat)
      {

	require 'inc/search/moteur-corps_vignette-reval.php';
	if(isset($_GET['searchfam']))
	{
	  break;
	}
      }
    }
    
	?>
</div><!--repartition-->	
      </div><!--row-->
    </div>
    
    </div>

    <?php
    require 'inc/search/moteur-corps_enregistrement-requete.php';
    ?>
    </div>
    
    <?php

     $j++;
   } 
   }
    require 'inc/search/moteur-corps_levenshtein.php';
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
	      <input type="text" name ="search" id="search_second" class = "form-control" maxlength="255" placeholder="exemple : carton, bouteille..."/>
	      <input type="hidden" name = "cat" id="search_second-cat">
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