<?php
if ($_GET['research']=="large")
    {
    $val_search = $_GET['search'];
    }
else
    {
    $val_search = $_POST['search'];
    }

//si le terme recherche est vide
if (empty($val_search)==1)
  {
    //si la valeur de recherche est vide
    echo "Pas de r&eacute;sultats. ";
    $toto=0;
  }

//si le terme recherche correspond qu a une lettre
elseif (strlen($val_search)==1)
    {
    //si la valeur entree ne contient qu une seule lettre
    //on va donc chercher les produits qui commence par cette lettre
    echo "Terme recherch&eacute; : \" ".$val_search."\"<br />";
    echo "Une seule lettre a &eacute;t&eacute; entr&eacute;e, les r&eacute;sultats suivants sont ceux qui commencent par cette lettre : <br />";
    $toto=1;
    
    }
//tout les autres cas
else
{
$toto=1;
}

//cas ou on recherche le terme
if ($toto == 1)
{

//conexion base de donnees
    try
        {
        $bdd = new PDO('mysql:host=localhost;dbname=recherche;charset=utf8', 'root', 'root');
        }
    catch (Exception $e)
        {
        die('Erreur : ' . $e->getMessage());
        }

//requete pour le mot exacte
        $reponse_exact = $bdd->query("SELECT * FROM dechets where produit = '".$val_search."' ");
        $reponse_nb_exact = $bdd->query("SELECT COUNT(*) AS nb FROM dechets where produit = '".$val_search."' ");
        $columns_exact = $reponse_nb_exact->fetch();
        $nb_exact = $columns_exact['nb'];

//requete pour le mot commence par
        $reponse_commence = $bdd->query("SELECT * FROM dechets where produit like '".$val_search."%' ");
        $reponse_nb_commence = $bdd->query("SELECT COUNT(*) AS nb FROM dechets where produit like '".$val_search."%' ");
        $columns_commence = $reponse_nb_commence->fetch();
        $nb_commence = $columns_commence['nb'];

//requete pour recherche dans la description (recherche large)
    if ($_GET['research']=="large")
        {        
        $reponse_large = $bdd->query("SELECT * FROM dechets where produit like '% ".$val_search."%' OR methode like '% ".$val_search."%'");
        $reponse_nb_large = $bdd->query("SELECT COUNT(*) AS nb FROM dechets where produit like '% ".$val_search."%' OR methode like '% ".$val_search."%'");
        $columns_large = $reponse_nb_large->fetch();
        $nb_large = $columns_large['nb'];
        }


//si le nombre de resultats est egal a 0, on propose une recherche plus large
    if ($nb_exact == 0 AND $nb_commence==0 and $_GET['research']!="large")
        {
        echo "Pas de r&eacute;sultats exactes ou de produit commencant par ".$val_search."<br />";
        echo "<br /><a href=".$_SERVER['PHP_SELF']."?research=large&search=".$val_search.">Cliquez ici pour &eacute;largir la recherche aux descriptifs de produits.</a> ";
        }

//si le nombre de resultats est superieur a 0, on affiche les resultats    
    elseif ($_GET['research']!="large" AND $nb_exact == 0 AND $nb_commence!=0)
        {

            echo 'Pas de resultats exacts correspondants pour "'.$val_search.'"<br />';

            echo 'Cependant, il y a '.$nb_commence.' enregistrement(s) commencant par "'.$val_search.'" qui correspond. <br /><br />';
            while ($donnees = $reponse_commence->fetch())
                {
                    echo $donnees['produit']; ?>
                    <br />Recyclage : 
                    <?php echo $donnees['recyclage']; ?>
                    <br />Revalorisation : 
                    <?php echo $donnees['revalorisation']; ?>
                    <br />
                    <?php echo $donnees['methode']; ?>
                    <br />Par : 
                    <?php echo $donnees['updater']; ?>
                    <br />Date : 
                    <?php echo $donnees['date']; ?><br />
                    <?php
                }
                $reponse_commence->closeCursor();


        }

    elseif ($_GET['research']!="large" AND $nb_exact != 0)
        {
            echo 'Il y a '.$nb_exact.' enregistrement(s) exact correspondant a "'.$val_search.'". <br /><br />';
            while ($donnees = $reponse_exact->fetch())
                {
                    echo $donnees['produit']; ?>
                    <br />Recyclage : 
                    <?php echo $donnees['recyclage']; ?>
                    <br />Revalorisation : 
                    <?php echo $donnees['revalorisation']; ?>
                    <br />
                    <?php echo $donnees['methode']; ?>
                    <br />Par : 
                    <?php echo $donnees['updater']; ?>
                    <br />Date : 
                    <?php echo $donnees['date']; ?><br />
                    <?php
                }
                $reponse_exact->closeCursor();

            echo "<br />Autres r&eacute;sultats commencant par \"".$val_search."\"";
            if ($nb_exact = $nb_commence)
            {
            echo "<br />Pas d'autres resultats correspondant"; 
            }
            else
            {           
            echo '<br />Il y a '.$nb_commence.' enregistrement(s) commencant par "'.$val_search.'" correspondant. <br /><br />';
            while ($donnees = $reponse_commence->fetch())
                {
                    echo $donnees['produit']; ?>
                    <br />Recyclage : 
                    <?php echo $donnees['recyclage']; ?>
                    <br />Revalorisation : 
                    <?php echo $donnees['revalorisation']; ?>
                    <br />
                    <?php echo $donnees['methode']; ?>
                    <br />Par : 
                    <?php echo $donnees['updater']; ?>
                    <br />Date : 
                    <?php echo $donnees['date']; ?><br />
                    <?php
                }
                $reponse_commence->closeCursor();
            }
        }
elseif($_GET['research']=="large" AND $nb_large !=0)
{
echo "Resultats de recherche elargie : <br /><br />";
while ($donnees = $reponse_large->fetch())
                {
                    echo $donnees['produit']; ?>
                    <br />Recyclage : 
                    <?php echo $donnees['recyclage']; ?>
                    <br />Revalorisation : 
                    <?php echo $donnees['revalorisation']; ?>
                    <br />
                    <?php echo $donnees['methode']; ?>
                    <br />Par : 
                    <?php echo $donnees['updater']; ?>
                    <br />Date : 
                    <?php echo $donnees['date']; ?><br />
                    <?php
                }
                $reponse_large->closeCursor();
}

elseif($_GET['research']=="large" AND $nb_large ==0)
{
echo "Resultats de recherche elargie : <br /><br />";
echo "Pas de resultats";
}

    $toto=0;
}
?>

