<?php
      $req_cat = $pdo->prepare('SELECT * FROM categorie WHERE categorie = ?');
      $req_cat->execute([$nb_cat]);
      $cat_cat=$req_cat->fetch();
?>
<script>
$(document).ready(function(){
    $("#toggle-btn-sm<?php echo $cat_cat->id; ?>").click(function(){
        $("#toggle-sm1<?php echo $cat_cat->id; ?>").fadeToggle();
	$("#toggle-sm2<?php echo $cat_cat->id; ?>").fadeToggle();
    });
});
</script>
<strong>Votre recherche se trouve dans la catégorie suivante : <?php echo htmlentities(strtoupper($nb_cat)); ?></strong><br /><mini><a href=#" id="toggle-btn-sm<?php echo $cat_cat->id; ?>"> Afficher/cacher</a></mini>

    <div class="col-lg-12 col-md-12 hidden-sm info" id="toggle-sm1<?php echo $cat_cat->id; ?>">
	<div class="col-lg-2 col-md-2 col-sm-4">
	  <img src="img/img_categories/<?php echo $cat_cat->photo ?>" class="img-thumbnail" width="150px">
	</div>
	<div class="col-lg-5 col-md-5 col-sm-4">
	    <strong>Recyclage : </strong><br /><?php echo $cat_cat->methode_recyclage ?>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-4">
	  <strong>Informations : </strong><br /><?php echo $cat_cat->informations ?>
	</div>
    </div>

    <div class="col-sm-12 hidden-lg hidden-md info" style="display:none" id="toggle-sm2<?php echo $cat_cat->id; ?>">
	<div class="col-lg-2 col-md-2 col-sm-4">
	  <img src="img/img_categories/<?php echo $cat_cat->photo ?>" class="img-thumbnail" width="150px">
	</div>
	<div class="col-lg-5 col-md-5 col-sm-4">
	    <strong>Recyclage : </strong><br /><?php echo $cat_cat->methode_recyclage ?>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-4">
	  <strong>Informations : </strong><br /><?php echo $cat_cat->informations ?>
	</div>
    </div>
