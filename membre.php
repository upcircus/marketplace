<?php
require 'inc/header_inc_new.php';
require 'inc/functions.php';
?>
<?php
require_once 'inc/db.php';
$req = $pdo->prepare("SELECT * FROM reseau WHERE id = ?");
$req->execute([$_GET['val']]);
foreach ($req as $data):
endforeach;
?>
<div class="container">
  <h2 class="text-center">Information sur <?php echo $data->nom_membre; ?></h2>
  <div class="col-lg-2">
    <img src="" class="img-responsive">
  </div>
  <div class="col-lg-6">
    Nom : 
    <br />Actif depuis : 
    <br />Contact : 
    <br />Email : 
    <br />Site internet : 
    <br />Déchet(s) revalorisé(s) : 
    
    
</div>