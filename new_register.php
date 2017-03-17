<?php
$username=$_POST['username'];
$email=$_POST['email'];
$mdp=$_POST['mdp'];
$mdp2=$_POST['mdp2'];

?>



<?php 
require_once 'inc/functions.php';

session_start();

if(!empty($_POST))
{    
    $errors=array();
    require_once 'inc/db.php';

    if(empty($username) || !preg_match('/^[a-z0-9A-Z_]+$/',$username))
    {
	$success_value=0;
	$errors['username_reg']="Votre pseudo n'est pas valide (alphanumérique)";
    }
    else
    {
      $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
      $req->execute([$username]);
      $user=$req->fetch();
      if($user)
      {
	$success_value=0;
	$errors['username_reg']='Ce pseudo est déjà pris';
      }
    }   

    if(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL))
    {
	$success_value=0;
	$errors['email_reg']="Votre email n'est pas valide";
    }
    
    else
    {
      $req=$pdo->prepare("SELECT id FROM users WHERE email = ?");
      $req->execute([$email]);
      $user=$req->fetch();
      if($user)
	{
	  $success_value=0;
	  $errors['email_reg']='Cet email est déjà utilisé pour un autre compte';
	}
    }
    
    if(empty($mdp) || $mdp != $mdp2)
    {
	$success_value=0;
	$errors['password_reg']="Vos mots de passes ne concordent pas";
    }

	
    if(empty($errors))
    {
	$req = $pdo->prepare("INSERT INTO users SET username = ?, password = ? , email = ?, confirmation_token=?");
	$password = password_hash($mdp,PASSWORD_BCRYPT);
	$token=str_random(60);
	//debug($token);
	$req->execute([$username, $password, $email,$token ]);
	$user_id = $pdo->lastInsertId();
	
	$sentto=$password;
	$sentfrom='no-reply@upcircus.fr';
	$name=htmlentities($username);
	$headers = 'From: '.$sentfrom.''."\r\n" .
	'Reply-To: '.$sentfrom.'' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	mail($email,'Confirmation de votre compte',"Bonjour ".$username.", \n Afin de confirmer votre inscription sur le site Upcircus.fr, merci de cliquer sur ce lien\n\nhttp://www.upcircus.fr/confirm.php?id=$user_id&token=$token", $headers);
	$success_value=1;
	$success_text="Merci, votre inscription a bien été prise en compte et un message de confirmation vous a été envoyé";
	
    }

}

   

?>

<?php 
if($success_value==0)
  {
  echo '<span id="flash_register"><div class="alert alert-danger alert-dismissible" role="alert" id="flash_register">';
    foreach($errors as $error):
    echo "<li>".$error."</li>";
    endforeach;
    echo '</div></span>
      	<div class="form-group">
	<br />
	  <div class="input-group">
	      <span class="input-group-addon glyphicon glyphicon-user"></span>
	      <input type="text" name ="username_reg" id ="username_reg" placeholder ="Pseudo" class = "form-control"/>
	  </div>
	  <br />
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-envelope"></span>
	    <input type="text" name ="email_reg" id ="email_reg" placeholder="Email" class = "form-control"/>
	  </div>
	  <br />
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-file"></span>
	    <input type="password" name ="password_reg" id ="password_reg" placeholder="Mot de passe" class = "form-control"/>
	  </div>
	  <br />
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-duplicate"></span>
	    <input type="password" name ="password_confirm_reg"  id ="password_confirm_reg" placeholder="Confirmez votre mot de passe" class = "form-control"/>
	  </div>
	</div>
	<div class="text-center"><input type="submit" class="btn btn-primary" name="inscrire" id="inscription" value="S\'inscrire"></div>
	<br /><br />';
  }
elseif($success_value==1)
  {
    echo $success_text;
  }
else
  {
    echo "Une erreur est survenue";
  }
?>

