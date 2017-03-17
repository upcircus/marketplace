<?php

$user_id = $_GET['id'];
$token=$_GET['token'];
require 'inc/db.php';
$req = $pdo->prepare('SELECT * FROM users WHERE id= ? ');
$req->execute([$user_id]);
$user = $req->fetch();

$req2 = $pdo->prepare("INSERT INTO infos_contributeur (id_user, nom, email, photo_logo, photo_fond, activation) VALUES (?, ?, ?, ?, ?, ?)");
$req2->execute([$user_id, $user->username, $user->email, "[//VIDE]", "[//VIDE]", 'non']);

session_start();

if ($user && $user->confirmation_token == $token)
{

  $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id= ?')->execute([$user_id]);
  $_SESSION['auth'] = $user;
  $_SESSION['flash']['success']="Votre compte a bien été validé";
  header('Location:index.php');
}

else
{
  $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
  header('Location: index.php');
}

?>