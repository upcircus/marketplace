<?php

try
{

  $bdd = new PDO('mysql:host=localhost;dbname=recherche;charset=utf8', 'root', 'root');

}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM dechets4 WHERE produit LIKE '.$_POST['search']%.'');

while ($donnees = $reponse->fetch())
{
?>

<?php
echo $donnees['produit']; ?><br />
Recyclage : 
<?php
echo $donnees['recyclage']; ?><br />
Revalorisation : 
<?php
echo $donnees['revalorisation']; ?><br />
<?php
echo $donnees['methode']; ?><br />
Par : 
<?php
echo $donnees['updater']; ?><br />
Date : 
<?php
echo $donnees['date']; ?><br />

<?php
}
$reponse->closeCursor();
?>
