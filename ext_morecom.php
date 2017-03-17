 <?php
 require 'inc/functions.php'; 
  require_once 'inc/db.php';
//   $pdo->query("SET NAMES 'utf8'");

  $nbcom=$_POST['nbcom'];
  $nbclick=$_POST['nbclick'];
  $prodnum=$_POST['prodnum'];
  
  $limithigh=$nbcom-($nbcom-5*($nbclick+1)); //36-(36-5*2)=10
  $limitnext=$limithigh+5;
  
  $req2 = $pdo->query("SELECT * FROM commentaires_produits WHERE id_produit = $prodnum ORDER BY id DESC LIMIT ".$limithigh." , 5");

  $nbclick=$nbclick+1;
  $i=1;
  echo '<span id="morecom2"><input type="hidden" value="'.$nbcom.'" id="nb_com_total"><input type="hidden" value="'.$nbclick.'" id="nbclick"></span>';
  foreach ($req2 as $com)
  {	
    $commentaire=$com->commentaire;
    $auteur=$com->auteur;
    $date=$com->date;
    $i++;
    
    echo '<div class="bgcomment">Par '.$auteur.' le '.$date.'<br />'.$commentaire.'</div><br />';
  }
  
?>