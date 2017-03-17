<?php
require 'inc/functions.php'; 
logged_only("mes-infos.php");
require 'inc/db.php';
?>

<?php
$req=$pdo->prepare('SELECT * FROM users WHERE username = ?');
$req->execute([$_SESSION['auth']->username]);
$user=$req->fetch();
if(isset($_POST['reinit']) && password_verify($_POST['old_password'],$user->password))
{
    if($user)
    {
    
      if(!empty($_POST))
      {
	if(!empty($_POST['new_password']) && $_POST['new_password'] == $_POST['new_password_confirm'])
	{
	$new_password=password_hash($_POST['new_password'],PASSWORD_BCRYPT);
	$pdo->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([$new_password,$user->id]);
	session_start();
	$_SESSION['flash']['success'] = "Votre mot de passe a bien été modifié";
	$_SESSION['auth']=$user;
	header('location:account.php');
	exit();
	}
	else
	{
	  $_SESSION['flash']['danger'] = "Le nouveau mot de passe n'est pas cohérant avec sa confirmation.";
	}
      }
      

    }
}
elseif(isset($_POST['reinit']) && !password_verify($_POST['old_password'],$user->password))
{
  $_SESSION['flash']['danger'] = "Votre ancien mot de passe n'est pas correct.";
}

?>

<?php require 'inc/header_inc_new.php'; ?>
<script>
var checkMdp;//on déclare
window.onload = function() {
    var mdp_el = document.getElementById("new_password"),
    mdp_el2 = document.getElementById("new_password_confirm");
    checkMdp = function checkMdp() {//redonner un nom est optionnel. C'est juste que je préfère
        if (mdp_el.value !== mdp_el2.value) {
            var msg = document.createTextNode("Les deux mots de passe ne correspondent pas");
            document.getElementById("mdperror").appendChild(msg);
        }
    }
};
</script>
<ol class="breadcrumb" style="background-color:#fff;">
  <li><a href="account.php">Tableau de bord</a></li>
  <li class="active">Changer de mot de passe</li>
</ol>  
<h2 class="text-center">Changer votre mot de passe</h2>

<div class="container">

<form action="" method="POST">
    <div class="form-group">
        <label for ="">Ancien mot de passe</label>
        <input type="password" name ="old_password" class = "form-control"/>
    </div>

    <div class="form-group">
        <label for ="">Nouveau mot de passe</label>
        <input type="password" name ="new_password" id="new_password" class = "form-control"/>
    </div>

    <div class="form-group">
        <label for ="">Confirmation du nouveau mot de passe</label>
        <span id="mdperror" style="color:#cc0000;background-color:#fb9292"></span>
        <input type="password" name ="new_password_confirm" id ="new_password_confirm" class = "form-control" onblur="checkMdp()"/>
    </div>


<button type="submit" class="btn btn-primary" name="reinit">Réinitialiser</button>

</form>
</div>


<?php require 'inc/pieddepage_inc_new.php'; ?>