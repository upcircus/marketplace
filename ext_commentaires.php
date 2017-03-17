<?php 
  require 'inc/functions.php'; 
  logged_only('ext_commentaires.php');
  require_once 'inc/db.php';
//   $pdo->query("SET NAMES 'utf8'");
  
  $prodnum=$_POST['prodnum'];
  $comment=$_POST['comment'];
  $auteur=$_SESSION['auth']->username;

    $req = $pdo->prepare("INSERT INTO commentaires_produits SET auteur = ?, date = NOW(), commentaire = ?, id_produit = ?");
    $req->execute([$auteur, $comment, $prodnum]); 
    
 
  $req2 = $pdo->query("SELECT * FROM commentaires_produits WHERE id_produit = $prodnum ORDER BY id DESC LIMIT 5");
//   $req->execute(["prod_".$prodnum]);

  
  foreach ($req2 as $com)
  {
    $commentaire=$com->commentaire;
    $auteur=$com->auteur;
    $date=$com->date;
    
    echo '<div class="bgcomment">Par '.$auteur.' le '.$date.'<br />'.$commentaire.'</div><br />';
    }
  
  
  