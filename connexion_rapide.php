<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>UPCIRCUS.fr </title>
<!-- Bootstrap -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Fin bootstrap -->

<!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
<!-- Fin CSS -->

<script type="text/javascript">
function closeFunction(){
parent.$.fancybox.close();
}
</script>

<script type="text/javascript">
function redirectFunction(){
self.parent.location.href='register.php';
}
</script>


<script type="text/javascript">
function timeout(){
  setTimeout(function() {parent.$.fancybox.close(); },3000);
  setTimeout(function() {parent.location.reload(true); },2999);
}
</script>


<script type="text/javascript">
function closereload(){
parent.location.reload(true);
}
</script>
    
    
    
  </head>
  <body class="fond-kraft" onload="document.getElementById('username').focus()">
    <div class="container-fluid">
      <h3 class="text-center"><strong>Connexion</strong></h3>
      <strong><div class="text-center">
<?php
ini_set('display_errors',1);
if(isset($_POST['sub_login']))
{  
  if(session_status() == PHP_SESSION_NONE)
  {
    session_start();
  }
  require_once 'inc/functions.php';
  if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password']))
  {

    require_once 'inc/db.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    
    if(!empty($user))
    {
      if(password_verify($_POST['password'],$user->password))
      {
	$_SESSION['auth']=$user;
	echo '<img src="img/pixel.png" onload="timeout();">';
	echo 'Vous êtes maintenant connecté comme <strong>'.$_SESSION['auth']->username.'</strong>';
	echo '<br />Cette fenêtre va se fermer dans 3secondes, sinon <a href="#"  onClick ="closereload();">cliquer pour fermer cette fenêtre</a>';
	$remember=isset($_POST['remember']) ? $_POST['remember'] : false;
	if($remember)
	{
	  $remember_token = str_random(250);
	  $pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
	  setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id .'ratonlaveurs'), time()+60*60*24*7);
	}
    
	exit();
      }
      else
      {
	echo 'Identifiant ou mot de passe incorrect<br /><a href="connexion_rapide.php">Recommencer</a>';
      }
    }
    else
    {
      echo 'Identifiant ou mot de passe incorrect<br /><a href="connexion_rapide.php">Recommencer</a>';
    }
  }
}
else{
?>

      <strong><div class="text-center">Merci de vous identifier pour ouvrir une session<br /></strong></strong>
      <mini><a href="#" onClick="redirectFunction();closeFunction();">Pas encore inscrit ?</a></mini><br/>
     <br />
      <form action="connexion_rapide.php" method="POST">
	  <div class="form-group">
	      <strong><label for ="">Pseudo ou email</label>
	      <input type="text" name ="username" class = "form-control" id="username"/>
	  </div>

	  <div class="form-group">
	      <label for ="">Mot de passe <a href="forget.php"><small>J'ai oublié mon mot de passe</small></a></label>
	      <input type="password" name ="password"  class = "form-control"/>
	  </div>
	
	  <div class="form-group">
	    <label>
	      <input type="checkbox" name="remember" value="1"/>Se souvenir de moi
	    </label>
	  </div>
	  
	  <button type="submit" class="btn btn-primary" name="sub_login">Se connecter</button>
	  
      </form>
    </div>
    <?php
    }
    ?>
  </body>
  </html>