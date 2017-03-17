<?php
require 'inc/functions.php'; 
logged_only('infos_createurs.php');

require_once 'inc/db.php';

$req = $pdo->prepare("SELECT * FROM infos_contributeur WHERE id_user= ?");
$req->execute([$_POST['id_user']]);

while($data = $req->fetch())
  {
  if($data->email == $_SESSION['auth']->email)
    {
      unlink("img/img_fond/".$data->photo_fond);
      $req = $pdo->prepare("UPDATE infos_contributeur SET photo_fond = ? WHERE id_user = ?");
      $req->execute(["[//VIDE]", $_POST['id_user']]);
    }
}

?>