  <?php 

$email=$_POST['email_follow'];
$productid=$_POST['productid'];
  
if(!empty($_POST) && !empty($email))
{

  require_once 'inc/db.php';
  require_once 'inc/functions.php';

  $req = $pdo->prepare("INSERT INTO newsletter SET id = ?, email = ? , date = NOW(), productid=?");
  $req->execute(['', $email, $productid]);
  echo "Merci. L'email ".$email." a été enregistré pour être tenu au courant de la mise en vente de ce produit. ";

}
else
{
  echo 'Votre email n\'est pas valide. <br /><a href="javascript:history.go(0)">Fermer cette fenêtre et recharger la page.</a>';
}
?>