  <?php 

$email=$_POST['email_forget'];
  
if(!empty($_POST) && !empty($email))
{

  require_once 'inc/db.php';
  require_once 'inc/functions.php';
  $req = $pdo->prepare('SELECT * FROM users WHERE (email = :email) AND confirmed_at IS NOT NULL');
  $req->execute(['email' => $email]);
  $user = $req->fetch();
  
  if($user)
  {
   
    $reset_token=str_random(60);
    $pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
    echo 'Les instructions du rappel de mot de passe vous ont été envoyé par email<br ><br /><a href="#" class="closepopup">Fermer cette fenêtre</a>';
    $sentfrom="no-reply@upcircus.fr";
    $headers = 'From: '.$sentfrom.''."\r\n" .
	'Reply-To: '.$sentfrom.'' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
    mail($email,'Réinitialisation de votre mot de passe',"Bonjour, \n Afin de réinitialiser votre votre mot de passe, merci de cliquer sur ce lien\n\nhttp://upcircus.fr/reset.php?id={$user->id}&token=$reset_token \n\nCordialement, \n\n L'equipe Upcircus.fr",$headers);
    exit();
  }
  else
  {
    echo 'Aucun compte ne correspond à cette adresse';
  }
}
?>