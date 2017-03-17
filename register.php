
<?php 
ini_set('display_errors',1);
require_once 'inc/functions.php';

session_start();

if(isset($_POST["inscrire"])&&!empty($_POST))
{    
    $errors=array();
    require_once 'inc/db.php';

    if(empty($_POST['username_reg']) || !preg_match('/^[a-z0-9A-Z_]+$/',$_POST['username_reg']))
    {
	$errors['username_reg']="Votre pseudo n'est pas valide (alphanumérique)";
    }
    else
      {
	$req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
	$req->execute([$_POST['username_reg']]);
	$user=$req->fetch();
	if($user)
	{
	  $errors['username_reg']='Ce pseudo est déjà pris';
	}
      }   

    if(empty($_POST['email_reg']) || !filter_var($_POST['email_reg'],FILTER_VALIDATE_EMAIL))
    {
	$errors['email_reg']="Votre email n'est pas valide";
    }
    
    else
    {
      $req=$pdo->prepare("SELECT id FROM users WHERE email = ?");
      $req->execute([$_POST['email_reg']]);
      $user=$req->fetch();
      if($user)
	{
	  $errors['email_reg']='Cet email est déjà utilisé pour un autre compte';
	}
    }
    
    if(empty($_POST['password_reg']) || $_POST['password_reg'] != $_POST['password_confirm_reg'])
    {
	$errors['password_reg']="Vous devez rentrer un mot de passe valide";
    }

	
    if(empty($errors))
    {
	
		$sql = "CREATE TABLE up_usr_".$_POST['username_reg']." (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`notes` int(11) NOT NULL,
			`coupscoeur` int(11) NOT NULL,
			`id_contrib` int(11) NOT NULL,
			PRIMARY KEY (`id`)
		      ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;";
	$req2 = $pdo->exec($sql);

	$req = $pdo->prepare("INSERT INTO users SET username = ?, password = ? , email = ?, confirmation_token=?");
	$password = password_hash($_POST['password_reg'],PASSWORD_BCRYPT);
	$token=str_random(60);
	debug($token);
	$req->execute([$_POST['username_reg'], $password, $_POST['email_reg'],$token ]);
	$user_id = $pdo->lastInsertId();
	
	$sentto=$_POST['email_reg'];
	$sentfrom='no-reply@upcircus.fr';
	$name=htmlentities($_POST['nom']);
	$headers = 'From: '.$sentfrom.''."\r\n" .
	'Reply-To: '.$sentfrom.'' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	mail($_POST['email_reg'],'Confirmation de votre compte',"Bonjour ".$_POST['username_reg'].", \n Afin de confirmer votre inscription sur le site Upcircus.fr, merci de cliquer sur ce lien\n\nhttp://www.upcircus.fr/confirm.php?id=$user_id&token=$token", $headers);
	$_SESSION['flash']['success']="Un message de confirmation vous a été envoyé";
	header('location:index.php');
	exit();
    }

}

   

?>

<?php require 'inc/header_inc_new.php'; ?>

<div class="container">
<h2 class="text-center"> S'inscrire</h1>

<?php if(!empty($errors)): ?>
<div class="alert alert-danger">
  <ul>
    <p>Vous n'avez pas rempli le formulaire correctement</p>
    <?php foreach($errors as $error): ?>
      <li><?= $error; ?></li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>

<form action="register.php" method="POST">
    <div class="form-group">
        <label for ="">Pseudo : </label>
        <input type="text" name ="username_reg" class = "form-control"/>
    </div>

    <div class="form-group">
        <label for ="">Email : </label>
        <input type="text" name ="email_reg" class = "form-control"/>
    </div>

    <div class="form-group">
        <label for ="">Mot de passe : </label>
        <input type="password" name ="password_reg"  class = "form-control"/>
    </div>

    <div class="form-group">
        <label for ="">Confirmez votre mot de passe : </label>
        <input type="password" name ="password_confirm_reg"  class = "form-control"/>
    </div>

<button type="submit" class="btn btn-primary" name="inscrire">S'inscrire</button>
<br /><br />
</form>

</section>
</div>

<?php require 'inc/pieddepage_inc_new.php'; ?>
