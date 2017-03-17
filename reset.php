<?php
if(isset($_GET['id']) && isset($_GET['token']))
  {
    require 'inc/db.php';
    $req=$pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(),INTERVAL 30 MINUTE)');
    $req->execute([$_GET['id'],$_GET['token']]);
    $user=$req->fetch();
    if($user)
    {
      if(!empty($_POST))
      {
	if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm'])
	{
	$password=password_hash($_POST['password'],PASSWORD_BCRYPT);
	$pdo->prepare('UPDATE users SET password = ? WHERE id = ?, reset_at = NULL, reset_toekn = NULL')->execute([$password,$user->id]);
	session_start();
	$_SESSION['flash']['success'] = "Votre mot de passe a bien été modifié";
	$_SESSION['auth']=$user;
	header('location:account.php');
	exit();
	}
      }
      
      require 'inc/functions.php';

    }
    else
    {
      session_start();
      $_SESSION['flash']['danger'] = "Ce token n'est pas valide";
  	header('Location: index.php');
      exit();
    }
  }
else
  {
    header('Location: index.php');
    exit();
  }


 ?>
 
<?php require 'inc/header_inc_new.php'; ?>


<h2 class="text-center">Réinitialiser mon mot de passe</h2>

<form action="" method="POST">
    <div class="form-group">
        <label for ="">Mot de passe</label>
        <input type="password" name ="password" class = "form-control"/>
    </div>

    <div class="form-group">
        <label for ="">Confirmation du mot de pase</label>
        <input type="password" name ="password_confirm"  class = "form-control"/>
    </div>


<button type="submit" class="btn btn-primary">Réinitialiser</button>

</form>

<?php require 'inc/pieddepage_inc_new.php'; ?>

