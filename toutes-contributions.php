<?php
require 'inc/functions.php'; 
require 'inc/header_inc_new.php';
require 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");
require 'app/Autoloader.php';
\App\Autoloader::register();
?>
<div class="container-fluid text-center">
<h2 class="text-center">Sélectionnez une catégorie pour y découvrir les idées et tutoriels de revalorisation</h2>

<?php 

$req=$pdo->prepare('SELECT * FROM famille_contrib');
$req->execute();

foreach($req as $post){

$newimg = new App\blur_image("img/img_famille/".$post->img_famille);
$div_arrondi="div_arrondi2_tuto";
?>
<a href="moteur.php?searchfam=<?php echo $post->label; ?>">
<div class="col-lg-1 text-center"><h3><?php echo $post->nom_famille;?></h3>
  <img src="<?php echo($newimg->url); ?>" class="hover-round img-responsive">
<br />
<br />
</div></a>
<?php
}
?>


<?php require 'inc/pieddepage_inc_new.php'; ?>

