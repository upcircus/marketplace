<?php

require 'inc/functions.php'; 
logged_only();
require 'inc/header_inc.php';

require_once 'inc/db.php';
$id=$_POST['id'];

      $req2 = $pdo->prepare("DELETE FROM dechets  WHERE id = ?");
      $req2->execute([$id]);    

?>  