<?php

$user=isset($_SESSION['auth']->username) ? $_SESSION['auth']->username : $_SERVER['REMOTE_ADDR'];
if(isset($val_search))
{
$sql2=$pdo->prepare("INSERT INTO requetes SET id= ?, user = ?, date = NOW(), recherche = ?, nb_res = ?");
$sql2->execute(['',$user,$val_search, $i]);
}

?>