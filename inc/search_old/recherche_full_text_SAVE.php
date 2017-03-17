
<?php


$valeur_formulaire = htmlentities($_GET['search']);

$val_search = strtr(utf8_decode($_GET['search']), utf8_decode('ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝ'), utf8_decode('AAAAAACEEEEEIIIINOOOOOUUUUY'));

$val_search = strtr($val_search, utf8_decode('áàâäãåçéèêëíìîïñóòôöõúùûüýÿ'), utf8_decode('aaaaaaceeeeiiiinooooouuuuyy'));

$val_search = htmlentities($val_search);

//faire une recherche sur les plurielles si le mot est au singulier et sur les singulier s'il est pluriel

//detection pluriel => rechercher aussi le singulier:
/*si val_search fini par s ou x sauf : 
rechercher sans s ou x
si aux => rechercher al
si aux poru differents cas : corail bail email soupirail travail vantail vitrail

//detection singulier => rechercher pluriel
si val search ne fini pas par s ou x
si al => aux sauf ... sinon s
si ail => aux pour ... sinon ails
su au/eau/eu/oeu => x sauf ...
si ou => s sauf...
*/











//Ici on identifie le pluriel des mots. 


if ($val_search{strlen($val_search)-1} == 's')
{
echo "le mot \"".$val_search."\" est au pluriel <br />";
echo "son singulier est ".substr($val_search, 0, -1)."<br />";
$val_search_singulier = substr($val_search, 0, -1);
}
elseif($val_search == 'bleu' || 'pneu' || 'émeu' || 'lieu' || 'landau' || 'sarrau')
{

}
elseif($val_search{strlen($val_search)-3}=='aux')
{

}
//fin pluriel



try
    {
    $bdd = new PDO('mysql:host=localhost;dbname=recherche', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
    die('Erreur : ' . $e->getMessage());
    }

    $reponse_exact = $bdd->query("SELECT * FROM dechets4 WHERE MATCH (produit) AGAINST ('".$val_search." ".$val_search_singulier."')");
    $reponse_nb_exact = $bdd->query("SELECT COUNT(*) AS nb FROM dechets4 WHERE MATCH (produit) AGAINST ('".$val_search."')");
    $columns_exact = $reponse_nb_exact->fetch();
    $nb_exact = $columns_exact['nb'];

    echo ''.$nb_exact.' enregistrement(s) contiennent le mot "'.$valeur_formulaire.'". <br /><br />';
        while ($donnees = $reponse_exact->fetch())
            {
                echo $donnees['produit']."<br />"; 
                $text=$donnees['methode'];
                $text=str_replace($val_search, '<b>'.$val_search.'</b>',$text);
                echo $text."<br /><br />"; 
            }
            $reponse_exact->closeCursor();


if ($nb_exact < 1)
{

//test LEVENSHTEIN
// mot mal orthographié
$input = $val_search;

// tableau de mots à vérifier
$sql_lev=$bdd->query("SELECT * FROM dechets4");
$arr = array();
while ($words = $sql_lev->fetch())
            {
                $produit=strtr($words['produit'],'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝ', 'AAAAAACEEEEEIIIINOOOOOUUUUY');
                $produit=strtr($produit, 'áàâäãåçéèêëíìîïñóòôöõúùûüýÿ', 'aaaaaaceeeeiiiinooooouuuuyy');
                $arr[] = $produit;
            }
            $reponse_exact->closeCursor();
//print_r ($arr);
// aucune distance de trouvée pour le moment
$shortest = -1;

// boucle sur les des mots pour trouver le plus près
foreach ($arr as $word) {

    // calcule la distance avec le mot mis en entrée,
    // et le mot courant
    $lev = levenshtein($input, $word);
//echo $lev."<br />";
    // cherche une correspondance exacte
    if ($lev == 0) {

        // le mot le plus près est celui-ci (correspondance exacte)
        $closest = $word;
        $shortest = 0;

        // on sort de la boucle ; nous avons trouvé une correspondance exacte
        break;
    }

    // Si la distance est plus petite que la prochaine distance trouvée
    // OU, si le prochain mot le plus près n'a pas encore été trouvé
    if ($lev <= $shortest || $shortest < 0) {
        // définition du mot le plus près ainsi que la distance
        $closest  = $word;
        $shortest = $lev;
    }
}

echo "Mot entré : $input\n";
if ($shortest == 0) {
    echo "Correspondance exacte trouvée : $closest\n";
} else {
    echo "Vous voulez dire : $closest ?\n";
}

//faire un script qui constate que les difference observe avec leveshtein sont a cause des accents. 

$table_car_spec=array('é','è','à','ç','ù','ê','ï','ë','ö','î','û');
$test_add=0;
//echo "<br /> closest : ".$closest;
for ($i=0;$i<strlen($val_search);$i++)
{
//echo utf8_decode($table_car_spec[$i]);
//echo "<br />";
$test = mb_substr_count(htmlentities($closest), utf8_decode($table_car_spec[$i]));
$test_add = $test_add + $test;
//echo "<br />";
}

//echo "test_add : ".$test_add."<br />";
//echo "shortest : ".$shortest."<br />";

//if ($test_add == $shortest)
//    {
//    echo "les mots sont les memes";
//    }
//else
//{
//echo "vous voulez dire ".$closest;
//}
//si shortest est egal au nombre mb... alors normal donc on est sur une correspondance exacte. (car accents)

}

?>







