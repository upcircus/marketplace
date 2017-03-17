<?php

require 'inc/functions.php'; 
logged_only('ext_moder_remove_req');
require 'inc/header_inc.php';

require_once 'inc/db.php';

 
      $req2 = $pdo->prepare("DELETE FROM requetes WHERE id = ?");
      $req2->execute([$_POST['id']]);    

?>  