<?php
require 'inc/functions.php'; 
logged_only("moder_ajout_motclef.php");
require 'inc/header_inc_new.php';
require_once 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");
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
<script src="js/script-add-del-motclef_moder-ajout-motclef.js"></script>
<script src="js/script-autocomplete_ajouter-xx.js"></script>


<section>    
  <div class="container">
    <h1>Recherchez un déchet</h1>
    <form id="form" class="form-horizontal" role="form" action="<?php echo($_SERVER['PHP_SELF']);?>" method="GET">
      <div class="form-group">
	  <div class="col-sm-offset-1 col-sm-10">
	    <div class="input-group" id="box">
	     <input type="text" name ="search" id="searcht" class = "form-control" maxlength="255" placeholder="exemple : carton, bouteille..."/>
	      <input type="hidden" name = "cat" id="searcht-cat">
	      <span class="input-group-btn">
		<input type="submit" class="btn btn-default" type="button" value="Go !">
	      </span>
	    </div>
	  </div>
      </div>
    </form>
    <?php	

    if(isset($_GET['search']))
    {
      $req = $pdo->prepare("SELECT * FROM dechets WHERE nom_dechets = ?");
      $req->execute([$_GET['search']]);
      
      if(isset($_POST["envoyer"]))//mise a jour globale de tous les items
      {
	foreach ($req as $data): 
	  $req2 = $pdo->prepare("UPDATE dechets SET methode = , dechetassocie = , nom_dechets = ?, recherche_associee = ?, photo = ? WHERE id = ?");
	  $req2->execute([$_POST['methode'.$data->id],$_POST['categorie'.$data->id],$_POST['nomdech'.$data->id],$_POST['rechass'.$data->id],'photo.png', $data->id]);    
	endforeach;
      }
    ?>
    <input type="submit" value="Tout mettre à jour" name="envoyer" class="btn btn-primary">
    <form action="" method="POST">     
    
    <?php
    foreach ($req as $data): 
    ?>  
    
    
    <div class="form-group" id="div<?php echo $data->id ?>">
      <label class="control-label col-sm-2" for ="">Nom déchet :</label> 
	<div class="col-sm-10 ">
	  <input type="text" class = "form-control" id="nomdech<?php echo $data->id ?>" value="<?php echo $data->nom_dechets ?>">
	</div>
      <label class="control-label col-sm-2" for ="">Mots-clés associés :</label> 
	<div class="col-sm-10 ">
	  <textarea name="rechass<?php echo $data->id ?>" id="rechass<?php echo $data->id ?>" class = "form-control"><?php echo $data->recherche_associee ?></textarea>
	</div>
      <label class="control-label col-sm-2" for ="">Catégorie :</label> 
	<div class="col-sm-10 ">
	  <select id="ms" multiple="multiple" Value="Choisissez une catégorie" name="categorie" id="categorie<?php echo $data->id ?>">
	  <?php  
	  
	  foreach ($req_filtre as $post)
		{
		echo '<option value="'.$post->categorie.'"';
		if($data->dechetassocie == $post->categorie){echo "selected";}
		echo '>'.$post->categorie.'</option>';
		}
	  ?>
	  </select>
	</div>
	<label class="control-label col-sm-2" for ="">Methode de recyclage : </label> 
	<div class="col-sm-10 ">
	  <textarea name="methode<?php echo $data->id ?>" id="methode<?php echo $data->id ?>" class = "form-control"><?php echo $data->methode ?></textarea>
	</div>
	<?php if($data->photo=='')
	{
	  ?>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" id="MAX_FILE_SIZE<?php echo $data->id ?>" value="1048576" />
		<input type="hidden" name="modifimg" value="new" />
		<input type="file" name="img_princ<?php echo $data->id ?>" accept="image/*" id="img_princ<?php echo $data->id ?>">
		<p class="help-block">La taille de l'image doit être inférieure à 1Mo</p>
	    </div>
	</div>	
	<div class="form-group">
	    <div id="image_preview" class="col-lg-4 col-lg-offset-2">
		<div class="thumbnail hidden">
		    <img src="w" alt="" style="width; 250px;"/>
		    <div class="caption">
			<h4></h4>
			<p></p>
			<p><button type="button" class="btn btn-danger">Annuler</button></p>
		    </div>
		</div>
	    </div>
	</div>
	<?php
	}
	else
	{
	?>
	<div class="form-group">
	  <label class="control-label col-sm-2" for ="">Photo :</label>
	  <script>
	  $(document).ready(function()
	  {
	    $("#chg_img_btn<?php echo $data->id ?>").click(function()
	    {
	      $("#chg_img<?php echo $data->id ?>").html('<input type="hidden" name="MAX_FILE_SIZE" id="MAX_FILE_SIZE<?php echo $data->id ?>" value="1048576" /><input type="hidden" name="modifimgprinc" value="new" /><input type="file" id="img_princ<?php echo $data->id ?>" name="img_princ"><p class="help-block">La taille de l\'image doit être inférieure à 1Mo</p>');
	    });
	  });
	  </script>
	  <div class="col-sm-3"><span id="chg_img<?php echo $data->id ?>">
	    <a class="fancybox" href="img/dechets/<?php echo("$data->photo");?>" data-fancybox-group="gallery" title="<?php echo("$data->nom_dechets");?>"><img class="thumbnail" src="img/dechets/<?php echo("$data->photo");?>" alt="" width="200px"/><input type="hidden" name="modifimgprinc" value="old" /></a><span id="chg_img_btn<?php echo $data->id ?>" class="btn btn-danger btn-xs">Changer d'image</span></span>
	  </div>
	</div>	
	<?php
	}
	?>
	<div class="col-sm-10 ">
	  <input type="button" value="Mettre à jour" name="val<?php echo $data->id ?>" class="btn btn-primary" id="maj<?php echo $data->id ?>">
	  <input type="button" value="supprimer" name="del<?php echo $data->id ?>" class="btn btn-danger" id="del<?php echo $data->id ?>">
	  <span id="majico<?php echo $data->id ?>"></span><br /><br />
	</div>
      </div>
      <div class="row">
      &nbsp;
      </div>
      <?php
      endforeach;
      ?>
      <input type="submit" value="Tout mettre à jour" name="envoyer" class="btn btn-primary">
      <?php
      }
      ?>
    </form>
  </div>
</section>

<?php require 'inc/pieddepage_inc_new.php'; ?>