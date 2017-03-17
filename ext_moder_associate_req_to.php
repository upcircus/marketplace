<?php

require 'inc/functions.php'; 
logged_only('ext_moder_associate_req_to.php');
require 'inc/header_inc.php';

require_once 'inc/db.php';

$dechet_princ=$_POST['dechet_princ'];
$recherche=$_POST['recherche'];

$req = $pdo->prepare("SELECT * FROM dechets WHERE nom_dechets = ?");
$req->execute([$dechet_princ]);



while($data = $req->fetch())
    {
      $motclefs=explode(",",$data->recherche_associee);
      $nb_motclefs=count($motclefs);
      for($i=0;$i<$nb_motclefs;$i++)
      {
	$motclefs_update[]=$motclefs[$i];
      }
      $motclefs_update[]=$recherche;
      $recherche_associee=implode(",",$motclefs_update);
    }

     $req1=$pdo->prepare("UPDATE dechets SET recherche_associee = ? WHERE nom_dechets = ? ");
     $req1->execute([$recherche_associee,$dechet_princ]);
    
      $req2 = $pdo->prepare("DELETE FROM requetes WHERE id = ?");
      $req2->execute([$_POST['id']]);    
?>  