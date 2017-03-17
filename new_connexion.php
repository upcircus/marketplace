
<?php

$email=$_POST['email'];
$mdp=$_POST['mdp'];
$remember_tick=$_POST['rememberme_cnx'];


if(!empty($_POST))
{  
  if(session_status() == PHP_SESSION_NONE)
  {
    session_start();
  }
  require_once 'inc/functions.php';
  if(!empty($_POST) && !empty($email) && !empty($mdp))
  {
    require_once 'inc/db.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
    $req->execute(['username' => $email]);
    $user = $req->fetch();
    if(!empty($user))
    {
      if(password_verify($mdp,$user->password))
      {
	$_SESSION['auth']=$user;
	$remember=isset($remember_tick) ? $remember_tick : false;
	if($remember)
	{
	  $remember_token = str_random(250);
	  $pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
	  setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id .'ratonlaveurs'), time()+60*60*24*7);
	}
	
	$success_status=1;
	
      }
      else
      {
	$success_status=0;
	$error= 'Identifiant ou mot de passe incorrect';
      }
    }
    else
    {
      $success_status=0;
      $error= 'Identifiant ou mot de passe incorrect';
    }
  }
}

if($success_status==0)
{
  echo '<span id="flash_connexion"><div class="alert alert-danger alert-dismissible" role="alert" id="flash_connexion">';
  echo $error;
  echo '</div></span><br />';
  echo '<div class="form-group">
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-envelope"></span>
	    <input type="email" name ="email_cnx" id ="email_cnx" placeholder="Email" class = "form-control"/>
	  </div>
	  <br />
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-file"></span>
	    <input type="password" name ="password_cnx" id ="password_cnx" placeholder="Mot de passe" class = "form-control"/>
	  </div>
	    
	  <div class="input-group text-center">
	  <label><input type="checkbox" name="rememberme_cnx" id="rememberme_cnx" value="true"> Se rappeller de moi</label>
	  </div>
	</div>
	<div class="text-center"><input type="submit" class="btn btn-primary" name="connecter" id="connexion" value="Se connecter"></div>
	';
	
	
}
elseif($success_status==1)
{
  echo 'Vous êtes maintenant connectés. <br />Vous allez être redirigé vers la page d\'accueil, <a href="javascript:history.go(0)">sinon, cliquez ici.</a>. ';
}
else
{
echo 'Un problème est survenu.';
}
exit();
?>
