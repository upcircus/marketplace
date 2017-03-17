<?php


$nom_cat[$i]="";
while ($donnees = $reponse_exact->fetch())
{ 
  $req = $pdo->prepare('SELECT * FROM categorie WHERE categorie = ?');
  $req->execute([$donnees->dechetassocie]);
  $cat=$req->fetch();
  $nom_recherche[$i]=$donnees->nom_dechets.' ('.$donnees->dechetassocie.')';
  if(in_array($donnees->dechetassocie, $nom_cat))
  {
  }
  else
  {
    $nom_cat[$i]=$donnees->dechetassocie;
?>  
<div class="col-lg-10">
    
    <br />
    <p><strong>MEMBRES DU RESEAU UPCIRCUS ASSOCIES A VOTRE RECHERCHE: </strong><mini><br />Les enregistrements issus de votre recherche sont leur matière première ! Découvrez ces entreprises de l'économie circulaire !</mini></p>

    <img src="img/logo_membres/971d8beb2fc668e0b212ab06a7aa0efe.png" class="img-thumbnail" width="110px">&nbsp;
    <img src="img/logo_membres/hopaal.png" class="img-thumbnail" width="110px">&nbsp;
    <img src="img/logo_membres/stonecycling.png" class="img-thumbnail" width="110px">
    <br /><br />
    <p><strong>REVALORISATION</strong> autour de : "<?php echo htmlentities(ucfirst($val_search)); ?>" </p>
    <div class="row">

<?php
require 'moteur-corps_vignette-reval.php';
?>

    </div><!--row-->
  </div>
    
    
    <?php  
  }
  $nb_enregistrement=$i;
  $i++;
}





//Enregistrement requete

require 'moteur-corps_enregistrement-requete.php';

if ($nb_exact < 1)
{

  // LEVENSHTEIN : mot mal orthographié
  $input = $val_search;
  $from = 'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝáàâäãåçéèêëíìîïñóòôöõúùûüýÿ'; // these chars are in UTF-8
  $to   = 'AAAAAACEEEEIIIINOOOOOUUUUYaaaaaaceeeeiiiinooooouuuuyy';
  $input_sansaccent=my_strtr( $input, $from, $to);
  // tableau de mots à vérifier
  $sql_lev=$pdo->query("SELECT * FROM dechets");
  $arr = array();
  
  while ($words = $sql_lev->fetch())
  {
    // input - in UTF-8
    $str  = $words->nom_dechets;
    $produit=my_strtr($str, $from, $to);	      
    $arr[] = $produit;
    /*test SI CORRESPONDANCE EXACTE*/
    $arr2[$produit] = $words->id;

    /*fin Test SI CORRESPONDANCE EXACTE */
  }

  // aucune distance de trouvée pour le moment
  $shortest = -1;

  // boucle sur les des mots pour trouver le plus près
  foreach ($arr as $word) 
  {
    // calcule la distance avec le mot mis en entrée, et le mot courant
    $lev = levenshtein($input_sansaccent, $word);
    // cherche une correspondance exacte
    if ($lev == 0) 
    {
	// le mot le plus près est celui-ci (correspondance exacte)
	$closest = $word;

	$shortest = 0;
	// on sort de la boucle ; nous avons trouvé une correspondance exacte
	//il faut donc faire un affichage avec cet item=> recuperer l'id de la requete, puis recuperer le mot correspondant pour selectionner avec ce mot. 
	$id=$arr2[$closest];
	$reponse_exact = $pdo->query("SELECT * FROM dechets WHERE id = ".$id."");
	$reponse_nb_exact = $pdo->query("SELECT COUNT(*) AS nb FROM dechets WHERE id = ".$id."");
	$columns_exact = $reponse_nb_exact->fetch();
	$nb_exact = $columns_exact->nb;
      
      
      
/**************************************************************************************************************/      
/******************Insertion de la recherche d'une requete si le levenstein trouve une correspondance**********/        
/******************exacte au terme (typiquement accent manquant etc...) ***************************************/        
/**************************************************************************************************************/        
/**************************************************************************************************************/        
/**************************************************************************************************************/        
/**************************************************************************************************************/        
      
      
      
      $nom_cat[$i]="";
while ($donnees = $reponse_exact->fetch())
{ 
  $req = $pdo->prepare('SELECT * FROM categorie WHERE categorie = ?');
  $req->execute([$donnees->dechetassocie]);
  $cat=$req->fetch();
  $nom_recherche[$i]=$donnees->nom_dechets.' ('.$donnees->dechetassocie.')';
  if(in_array($donnees->dechetassocie, $nom_cat))
  {
  
  }
  else
  {
    $nom_cat[$i]=$donnees->dechetassocie;
?>  

    <strong><br />Votre recherche se trouve dans la catégorie suivante : <?php echo htmlentities(strtoupper($donnees->dechetassocie)); ?></strong></div>
    <div class="col-lg-8 info">
      <div class="col-sm-1">
	<img src="img/img_categories/<?php echo $cat->photo ?>" class="img-thumbnail" width="150px">
      </div>
      <div class="col-sm-5">
	  <strong>Recyclage : </strong><br /><?php echo $cat->methode_recyclage ?>
      </div>
      <div class="col-sm-5">
	<strong>Informations : </strong><br /><?php echo $cat->informations ?>
      </div>
    </div>
    <br />
    
    <p><strong>MEMBRES DU RESEAU UPCIRCUS ASSOCIES A VOTRE RECHERCHE: </strong><mini><br />Les enregistrements issus de votre recherche sont leur matière première ! Découvrez ces entreprises de l'économie circulaire !</mini></p>

    <img src="img/logo_membres/971d8beb2fc668e0b212ab06a7aa0efe.png" class="img-thumbnail" width="110px">&nbsp;
    <img src="img/logo_membres/hopaal.png" class="img-thumbnail" width="110px">&nbsp;
    <img src="img/logo_membres/stonecycling.png" class="img-thumbnail" width="110px">
    <br /><br />
    <p><strong>REVALORISATION</strong> autour de : "<?php echo htmlentities(ucfirst($val_search)); ?>" </p>
    <div class="row">



      <div class="repartition">
      <?php

      $req = $pdo->prepare("SELECT * FROM contribution WHERE dechet = ? AND cat_associe = ? AND VALIDE = ?");
      $req->execute([$val_search, $nom_cat[$i], 'oui']);

      foreach ($req as $post)
      {
	$newimg = new App\blur_image("img/img_princ/".$post->img_princ);
	$div_arrondi="div_arrondi2_tuto";

      ?>
	  
	<div class="<?php echo $div_arrondi; ?>" style="width:<?php echo($newimg->divwidth()); ?>px; background-image:url(<?php echo($newimg->url); ?>); background-size:  <?php echo($newimg->imgwidth().'px'); ?> <?php echo($newimg->imgheight().'px'); ?>;">
	  <div class="surcouche">
	  <span class="encadre_type">&nbsp;<?php echo($post->type);?>&nbsp;</span>
	    <ins>
	      <div class="surcouche-content-titre">
		<?php echo mb_strimwidth(ucfirst($post->titre),0,20,"..."); ?>
	      </div>
	      <div class="surcouche-content-mp">
		<br /><strong>Revalorisation :</strong> <?php echo ucfirst($post->dechet); ?>
	      </div>
	      <div class="surcouche-content-rates">
		<mini>Difficulté :</mini>&nbsp;<span class="rating_full_sm">&starf;</span><span class="rating_full_sm">&starf;</span><span class="rating_full_sm">&starf;</span><span class="rating_full_sm">&starf;</span><span class="rating_full_sm">&starf;</span>
		<br />
		<mini>Notation :</mini>&nbsp;<span class="rating_full_sm">&starf;</span><span class="rating_full_sm">&starf;</span><span class="rating_full_sm">&starf;</span><span class="rating_full_sm">&starf;</span><span class="rating_full_sm">&starf;</span>
	      </div>
	      <div class="surcouche-content-bottom">
		<div class="surcouche-bottomleft">
		</div>
		<div class="surcouche-voirtout">
		  <a href="#" class="btn btn-default btn-xs btn-white">Voir</a>
		</div>
		<div class="surcouche-ccoeur">
		  <span id="ccoeur">
		    <a href="#" id="ccoeurout" class="glyphicon glyphicon-heart-empty" title="Sauvegarder"></a>
		  </span>
		</div><!--surcouche-content-ccoeur-->
	      </div><!--surcouche-content-bottom-->
	    </ins>
	  </div><!--surcouche-->
	</div><!--$div_arrondi-->
      <?php
      }
      ?>
      </div><!--repartition-->
    </div><!--row-->
  </div>
    
    
    <?php  
  }
  $nb_enregistrement=$i;
  $i++;
}

      
      
      
      
      
      
      /*********************************************/
      /*******************FIN Test *****************/
      /*********************************************/
      
      
      
      
      
      
      
      
	
	
	break;
    }
    // Si la distance est plus petite que la prochaine distance trouvée
    // OU, si le prochain mot le plus près n'a pas encore été trouvé
    if ($lev <= $shortest || $shortest < 0) 
    {
      $closest = $word;
      $shortest = $lev;
    }
  }

  if ($shortest == 0) 
  {
      echo "Correspondance exacte trouvée : $closest <br /> <br />";
  } 
  else 
  {
      echo "Vous voulez dire : <a href=\"moteur.php?search=".$closest."\">".$closest."</a>?";
  }
}



?>  