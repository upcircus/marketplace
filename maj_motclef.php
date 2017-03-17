<?php

require 'inc/functions.php'; 
logged_only('maj_motclef.php');
require 'inc/header_inc.php';

require_once 'inc/db.php';

// $req_deleteimg = $pdo->prepare("SELECT * FROM dechets WHERE id = ?");
// $req_deleteimg->execute([$_POST['id']]);
// 
// 	foreach ($req_deleteimg as $data): 
// 	  if(isset($_POST['image']) && $data->photo !== "poubelle.png" || $data->photo !== "")
// 	  {
// 	    unlink('img/dechets/'.$data->photo);
// 	  }
// 	endforeach;
 
      $req2 = $pdo->prepare("UPDATE dechets SET nom_dechets = ?, dechetassocie = ?, methode = ?, photo = ?, recherche_associee = ? WHERE id = ?");
      $req2->execute([$_POST['nomdechet'],$_POST['categorie'], $_POST['methode'], $_POST['image'], $_POST['motclef'], $_POST['id']]);    

?>  