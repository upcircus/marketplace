<?php
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
    $cat_asso[]=$words->dechetassocie;
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
    $k=0;
    $key=array_search($closest,$arr);
    $nom_dech[$k]=$closest;
    $nb_cat=$cat_asso[$key];
      echo "Aucun enregistrement n'a été trouvé pour votre requête \"<strong>".htmlentities($val_search)."</strong>\". Souhaitez-vous rajouter un produit issus de \"<strong>".htmlentities($val_search)."</strong>\" ? 
      .";
      if (!isset($_SESSION['auth']))
      {
	echo "<span class=\"inscriptionbtn btn btn-default btn-xs\">Ajouter produit</span>";
      }
      else
      {
	echo "<a href=\"ajouter-produit.php\" class=\"btn btn-default btn-xs\">Ajouter un produit</a>";
      } 
      echo "<br />Le résultat le plus proche que nous trouvons est : <a href=\"moteur.php?search=".$closest."&cat=".$nb_cat."\">".$closest."</a> (".$nb_cat.")<br /><br />";
  

  require 'inc/search/moteur-corps_vignette-reval.php';
  
  
  
  
  }
}
