<?php

require 'inc/functions.php'; 
logged_only('ext_moder_add_req_as_new.php');


require_once 'inc/db.php';


$nomdechet=$_POST['nomdechet'];
$motclef=$_POST['motclef'];
$method=$_POST['methode'];
$photo=$_POST['image'];
$categorie=$_POST['categorie'];

$req = $pdo->prepare("INSERT INTO dechets SET id = ?, nom_dechets = ?, dechetassocie = ?, methode = ?, photo = ?, recherche_associee = ?");
//$req->execute(['', $nomdechet, $categorie, $method, $photo, $motclef]);
$req->execute(['', $nomdechet, $categorie, $method, $photo, $motclef]);
 
$req2 = $pdo->prepare("DELETE FROM requetes WHERE id = ?");
$req2->execute([$_POST['id']]);    
      
?>  
