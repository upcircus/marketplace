<?php

$email=$_POST['email_nl'];

if(!empty($_POST))
{
  require_once 'inc/db.php';
  $req = $pdo->prepare('INSERT INTO newsletter SET id = ? , email = ? , date = NOW() , productid = ? ');
  $req->execute(['', $email,'']);
}

echo "L'adresse ".$email." a été prise en compte. ";
?>