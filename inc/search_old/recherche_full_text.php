<?php

$val_search = $_GET['search'];
$cat_search = isset($_GET['cat']) ? $_GET['cat'] : false;

//enregistrement requete
$sql2=$pdo->prepare("INSERT INTO requetes SET id= ?, user = ?, date = NOW(), recherche = ?, nb_res = ?");
$sql2->execute(['',$user,$val_search, $i]);
$reponse_exact->closeCursor();
    
require_once 'inc/db.php';

$reponse_exact = $pdo->query("SELECT * FROM dechets WHERE MATCH(nom_dechets, dechetassocie) AGAINST ('".$val_search." IN BOOLEAN MODE')");
$reponse_nb_exact = $pdo->query("SELECT COUNT(*) AS nb FROM dechets WHERE MATCH(nom_dechets, dechetassocie) AGAINST ('".$val_search." IN BOOLEAN MODE')");
$columns_exact = $reponse_nb_exact->fetch();
$nb_exact = $columns_exact['nb'];
  

if(isset($_SESSION['auth']->username))
{
  $user=$_SESSION['auth']->username;
}
else
{
  $user=$_SERVER['REMOTE_ADDR'];
}

echo $nb_exact.' enregistrement(s) contiennent le mot "'.$val_search.'" : ';
$i=0;

while ($donnees = $reponse_exact->fetch())
    {    
      $req=$pdo->prepare('SELECT photo FROM categorie WHERE categorie = ?');
      $req->execute([$donnes['dechetassocie']]);
      echo '<strong><a href="#">'.$donnees['nom_dechets'].' ('.$donnees['dechetassocie'].')</a></strong>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;'; 
      $nom_recherche[$i]=$donnees['nom_dechets'].' ('.$donnees['dechetassocie'].')';
      $nb_enregistrement=$i;
      $i++;
    }


if ($nb_exact < 1)
{

  // LEVENSHTEIN : mot mal orthographié
  $input = $val_search;

  // tableau de mots à vérifier
  $sql_lev=$pdo->query("SELECT * FROM dechets");
  $arr = array();
  
  while ($words = $sql_lev->fetch())
  {
      $produit=strtr($words['nom_dechets'],'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝ', 'AAAAAACEEEEEIIIINOOOOOUUUUY');
      $produit=strtr($produit, 'áàâäãåçéèêëíìîïñóòôöõúùûüýÿ', 'aaaaaaceeeeiiiinooooouuuuyy');
      $arr[] = $produit;
  }

  // aucune distance de trouvée pour le moment
  $shortest = -1;

  // boucle sur les des mots pour trouver le plus près
  foreach ($arr as $word) 
  {
    // calcule la distance avec le mot mis en entrée, et le mot courant
    $lev = levenshtein($input, $word);
    // cherche une correspondance exacte
    if ($lev == 0) 
    {
	// le mot le plus près est celui-ci (correspondance exacte)
	$closest = $word;
	$shortest = 0;
	// on sort de la boucle ; nous avons trouvé une correspondance exacte
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
      echo "Vous voulez dire : <a href=\"moteur.php?search=".$closest."\">$closest</a>?";
  }
}

?>