
<?php

require 'inc/functions.php'; 
logged_only("ajouter-dechet.php");
require 'inc/log_moderateur.php';
require 'inc/header_inc_new.php';
require_once 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");
if(isset($_POST["ajouter"]))
{

      $extension_img = substr(strrchr($_FILES['img_asso']['name'],'.'),1);
	$nom_img = md5(uniqid(rand(), true)).'.'.$extension_img;
	$upload_img = upload('img_asso','img/'.'img_dechets'.'/'.$nom_img,1048000, array('png','gif','jpg','jpeg') ); 

      $req = $pdo->prepare("INSERT INTO dechets SET id = ?, nom_dechets = ?, dechetassocie = ?, methode = ?, photo = ?, recherche_associee = ?");
      $req->execute(['',$_POST['nom_dechet'], $_POST['categorie'], $_POST['methode'], $nom_img, $_POST['motcle']]);
      echo "<div class='alert alert-success'>Le déchet ".$_POST['nom_dechet']." a bien été ajouté</div>";
}

      $req_filtre=$pdo->query("SELECT * FROM categorie");

?>
 <link rel="stylesheet" href="css/module_filtre_recherche.css">
 <script src="js/multiple-select.js"></script>
 <script>
    $(function() {
        $('#ms').change(function() {
            console.log($(this).val());
        }).multipleSelect({
            width: '100%'
        });
    });
</script>
<section>    
  <div class="container">
<form id="form" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
    <h2 class="text-center">Ajouter Déchet</h2><br /><br />
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Nom :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="nom_dechet" class ="form-control" placeholder="Ex : palette en bois" maxlength="255"/>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Catégorie :</label>
	    <div class="col-sm-10">
	    <label>Catégories : </label>
		  <select id="ms" multiple="multiple" Value="Choisissez une catégorie" name="categorie">
		  <?php  
		  
		  foreach ($req_filtre as $post)
			{
			echo '<option value="'.$post->categorie.'" name="categorie">'.$post->categorie.'</option>';
			}
		  ?>
		  </select>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Mots-clés associés :</label>
	    <div class="col-sm-10">
	      <textarea class="textarea form-control" rows="3" name="motcle" placeholder="Ex : "/></textarea>
	    </div>
	</div>	
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Méthode recyclage :</label>
	    <div class="col-sm-10">
	      <textarea class="textarea form-control" rows="3" name="methode" placeholder="Ex : "/></textarea>
	    </div>
	</div>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo associée :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="file" id="InputFile" name="img_asso" accept="image/*" onblur="verifimgPrinc(this)">
		<p class="help-block">La taille de l'image doit être inférieure à 1Mo</p>
	    </div>
	</div>
	
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10">
	    <button type="submit" class="btn btn-primary" name="ajouter">Ajouter déchet !</button>

	  </div>
	</div>
</form>
</div>
</section>

<?php 

require 'inc/pieddepage_inc_new.php'; ?>