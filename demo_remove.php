<?php
require 'inc/functions.php'; 
logged_only('demo_remove.php');

require_once 'inc/db.php';

$req = $pdo->prepare("SELECT * FROM contribution WHERE id= ?");
$req->execute([$_POST['id']]);

while($data = $req->fetch())
  {
  if($data->contributeur == $_SESSION['auth']->username)
    {
      unlink("img/img_princ/".$data->img_princ);
      if($data->img_matos!=="[//VIDE]")
      {
	unlink("img/img_matos/".$data->img_matos);
      }
      $img_etape=explode("[//ETAPE]",$data->img_etape);
      $fictech=explode("[//ETAPE]",$data->fictech_etape);
      
      for($i=1;$i<=$data->nb_etapes;$i++)
      {
      if($img_etape[$i]!=="[//VIDE]")
	{
	  unlink("img/tutoriel/".$img_etape[$i]);
	}
	
      if($fictech_etape[$i]!=="[//VIDE]")
	{
	  unlink("img/fictech/".$fictech[$i]);
	}
      }
      $req = $pdo->prepare("DELETE FROM contribution WHERE id=?");
      $req->execute([$_POST['id']]);
    }
};

?>