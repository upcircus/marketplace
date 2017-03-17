<?php
require 'inc/functions.php'; 
logged_only('ext_coeur.php');

require_once 'inc/db.php';

$id_contrib=$_POST['id'];
// $user=$_POST['user'];
$user=$_SESSION['auth']->username;
// $id_contrib='211';

$req1 = $pdo->prepare("SELECT * FROM contribution WHERE id= ?");
$req1->execute([$id_contrib]);

foreach ($req1 as $data1):
endforeach; 
$nb_coupcoeur=$data1->nb_coupcoeur;

$req2 = $pdo->prepare("SELECT * FROM up_usr_".$user." WHERE id_contrib= ?");
$req2->execute([$id_contrib]);

foreach ($req2 as $data2):
  endforeach;  
  
  if(!isset($data2))
  {
    $req = $pdo->prepare("INSERT INTO up_usr_".$user." SET id_contrib = ?, coupscoeur = ?");
    $req->execute([$id_contrib, "1"]); 
    $nouveau_nb=$nb_coupcoeur+1;
  }
  elseif($data2->coupscoeur=="1")
  {
    $req = $pdo->prepare("UPDATE up_usr_".$user." SET coupscoeur = ? WHERE id_contrib = ?");
    $req->execute(["0", $id_contrib]); 
    $nouveau_nb=$nb_coupcoeur-1;
  }
  elseif($data2->coupscoeur=="0")
  {
    $req = $pdo->prepare("UPDATE up_usr_".$user." SET coupscoeur = ? WHERE id_contrib = ?");
    $req->execute(["1", $id_contrib]); 
    $nouveau_nb=$nb_coupcoeur+1;
  }
  
  $req = $pdo->prepare("UPDATE contribution SET nb_coupcoeur = ? WHERE id= ?");
  $req->execute([$nouveau_nb, $id_contrib]);
  
?>
