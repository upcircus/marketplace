<?php

require 'inc/functions.php'; 
logged_only("moder_requetes.php");
require 'inc/header_inc_new.php';

require_once 'inc/db.php';
  $req = $pdo->query("SELECT * FROM requetes");
  $nb_tutoriel = $req->rowCount();
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<section>    
  <div class="container">
  <?php
    $nb_resultats=0;
    
    while($data = $req->fetch())
    {
      $nb_resultats=$nb_resultats+1;
      $x=$nb_resultats%2;
      
      $req2 = $pdo->query("SELECT * FROM dechets WHERE nom_dechets = '".$data->recherche."'");
      $nb_match = $req2->rowCount();
      if($nb_match>0)
      {
	foreach ($req2 as $data2): 
	  $methode = (isset($data2->methode) ? $data2->methode : false);
	  $recherche_associee = (isset($data2->recherche_associee) ? $data2->recherche_associee : false);
	  $dechetassocie = (isset($data2->dechetassocie) ? $data2->dechetassocie : false);
	  $photo = (isset($data2->photo) ? $data2->photo : false);
	endforeach;
      }
      else
      {
      $methode='';
      $recherche_associee = (isset($data2->recherche_associee) ? $data2->recherche_associee : false);
      $dechetassocie = (isset($data2->dechetassocie) ? $data2->dechetassocie : false);
      $photo='';
      }
  ?>
  <script>
  
    $(document).ready(function(){
    
    $("#refuser<?php echo($nb_resultats);?>").click(function(){    

	$.post("ext_moder_remove_req.php",
	{
	  id:<?php echo($data->id);?>
	});
	$("#div<?php echo($nb_resultats);?>").remove();
    });
    
    $("#valider<?php echo($nb_resultats);?>").click(function(){    
	$.post("ext_moder_remove_req.php",
	{
	  id:<?php echo($data->id);?>
	});
	$("#div<?php echo($nb_resultats);?>").remove();
    });
    
    $("#ajouter<?php echo $data->id ?>").click(function(){   
      
      var elem = document.getElementById("img_princ<?php echo $data->id ?>");
      var oldnew = document.getElementById("modifimg<?php echo $data->id ?>");
      var result = oldnew.value === "old";
      var result2 = oldnew.value === "new";
      
      if (result2)
      {
	var result3 = ((elem.value === "") || (elem.value=== null));
      }
	  if (result || result3) { 

	    $.post("ext_moder_add_req_as_new.php",
	    {
		      id:<?php echo $data->id ?>,
		      motclef:$("#rechass<?php echo $data->id ?>").val(),
		      nomdechet:$("#nomdech<?php echo $data->id ?>").val(),
		      categorie:$("#categorie<?php echo $data->id ?>").val(),
		      methode:$("#remarque<?php echo $data->id ?>").val()
	    },
	    function(data,status)
	    {
	      if(status == "success")
		$("#div<?php echo($nb_resultats);?>").remove();
	    });
	  }
	  else if (result2) {
	    update();
	  }
	  
	  function update()
	  {
	      var xhr = new XMLHttpRequest();
	      xhr.open("POST", "ext_upload_img.php", true);
	      var file = $("#img_princ<?php echo $data->id ?>")[0].files[0];
	      xhr.setRequestHeader("X-FILENAME", file.name);
	      xhr.send(file); 
		xhr.onreadystatechange = function() 
		{
		  if (xhr.readyState == 4 && xhr.status == 200) 
		  {

		    $.post("ext_moder_add_req_as_new.php",
		    {
		      id:<?php echo $data->id ?>,
		      motclef:$("#rechass<?php echo $data->id ?>").val(),
		      nomdechet:$("#nomdech<?php echo $data->id ?>").val(),
		      categorie:$("#categorie<?php echo $data->id ?>").val(),
		      methode:$("#remarque<?php echo $data->id ?>").val(),
		      image:xhr.responseText

		    },
		    function(data,status)
		    {
		      if(status == "success")
			$("#div<?php echo($nb_resultats);?>").remove();
		    });

		  }
		};
	      
	  };

    });

    
    $("#associer<?php echo $data->id ?>").click(function(){    
	$.post("ext_moder_associate_req_to.php",
	{
	  id:<?php echo($data->id);?>, 
	  dechet_princ:document.getElementById("search<?php echo $data->id ?>").value,
	  recherche:'<?php echo $data->recherche ?>'
	});
	$("#div<?php echo($nb_resultats);?>").remove();
    });
    
    });

    $(function() {
      $( "#search<?php echo($data->id);?>" ).autocomplete({
	  source: "requete_autocompletion.php",
	  minLength: 2,
	  autoFocus:true
      });
    });
  </script> 
	   

	  <?php
	  if($x==0)
	  {
	    ?>
	    <div class="line-list-0" id="div<?php echo($nb_resultats);?>">
	    <?php
	  }
	  else
	  {  
	  ?>
	    <div class="line-list-1" id="div<?php echo($nb_resultats);?>">
	    <?php  
	  }
	  ?>

	      <div class="line-trash"><br />
		<input type="button" class="btn btn-primary" value="RAS" id="valider<?php echo($nb_resultats);?>"><br /><br />
		<input type="button" class="btn btn-danger" value="Supprimer" id="refuser<?php echo($nb_resultats);?>">&nbsp;
	      </div>
	      
	      <div class="line-comment">

		<strong>
		  <?php echo $data->recherche; ?>
		</strong>
		<mini>&nbsp;Recherche du <?php echo $data->date; ?> par <?php echo $data->user; ?></mini><br />
		<strong>Nombre de résultats : </strong><?php echo $data->nb_res; ?><br />
		<strong><span id="btnajouter<?php echo $data->id ?>">Ajouter comme nouveau déchet</span></strong><br />
		<div id="divajouter<?php echo $data->id ?>" class="col-sm-offset-1">
		  <form name="form<?php echo $data->id ?>">
		    <input type="text" class = "form-control" id="nomdech<?php echo $data->id ?>" value="<?php echo $data->recherche ?>">	    
		    <label class="control-label" for ="">Mots-clés associés :</label> 
		    <textarea name="rechass<?php echo $data->id ?>" id="rechass<?php echo $data->id ?>" class = "form-control"><?php echo $recherche_associee ?></textarea>
		    <label class="control-label" for ="">Catégorie :</label> 
		    <select name="categorie" class = "form-control" id="categorie<?php echo $data->id ?>">
		      <option value="métal" <?php if($dechetassocie=="métal"){echo("selected=\"selected\"");}?>>métal</option>
		      <option value="bois traité" <?php if($dechetassocie=="bois traité"){echo("selected=\"selected\"");}?>>bois traité</option>
		      <option value="bois non-traité" <?php if($dechetassocie=="bois non-traité"){echo("selected=\"selected\"");}?>>bois non-traité</option>
		      <option value="carton" <?php if($dechetassocie=="carton"){echo("selected=\"selected\"");}?>>carton</option>
		      <option value="déchet dangereux/chimique" <?php if($dechetassocie=="déchet dangereux/chimique"){echo("selected=\"selected\"");}?>>déchet dangereux/chimique</option>
		      <option value="déchet spécifique" <?php if($dechetassocie=="déchet spécifique"){echo("selected=\"selected\"");}?>>déchet spécifique</option>
		      <option value="DEEE" <?php if($dechetassocie=="DEEE"){echo("selected=\"selected\"");}?>>DEEE</option>
		      <option value="gros électroménager" <?php if($dechetassocie=="gros électroménager"){echo("selected=\"selected\"");}?>>gros électroménager</option>
		      <option value="mobilier" <?php if($dechetassocie=="mobilier"){echo("selected=\"selected\"");}?>>mobilier</option>
		      <option value="organique" <?php if($dechetassocie=="organique"){echo("selected=\"selected\"");}?>>organique</option>
		      <option value="papier" <?php if($dechetassocie=="papier"){echo("selected=\"selected\"");}?>>papier</option>
		      <option value="plastique" <?php if($dechetassocie=="plastique"){echo("selected=\"selected\"");}?>>plastique</option>
		      <option value="tissus/vêtement" <?php if($dechetassocie=="tissus/vêtement"){echo("selected=\"selected\"");}?>>tissus/vêtement</option>
		      <option value="vaisselle faience porcelaines terre cuite céramique" <?php if($dechetassocie=="vaisselle faience porcelaines terre cuite céramique"){echo("selected=\"selected\"");}?>>vaisselle faience porcelaines terre cuite céramique</option>
		      <option value="verre" <?php if($dechetassocie=="verre"){echo("selected=\"selected\"");}?>>verre</option>
		      <option value="caoutchouc" <?php if($dechetassocie=="caoutchouc"){echo("selected=\"selected\"");}?>>caoutchouc</option>
		      <option value="cuir" <?php if($dechetassocie=="cuir"){echo("selected=\"selected\"");}?>>cuir</option>
		      <option value="autre" <?php if($dechetassocie=="autre"){echo("selected=\"selected\"");}?>>autre</option>
		    </select>
		    <label class="control-label" for ="">Remarques :</label> 
		     <textarea name="remarque<?php echo $data->id ?>" id="remarque<?php echo $data->id ?>" class = "form-control"><?php echo $methode ?></textarea>
		 
		 <?php if($photo=='')
	{
	  ?>

	    <label class="control-label" for ="">Photo :</label>

		<input type="hidden" name="MAX_FILE_SIZE" id="MAX_FILE_SIZE<?php echo $data->id ?>" value="1048576" />
		<input type="hidden" id="modifimg<?php echo $data->id ?>" value="new" />
		<input type="file" name="img_princ<?php echo $data->id ?>" accept="image/*" id="img_princ<?php echo $data->id ?>">
		<p class="help-block">La taille de l'image doit être inférieure à 1Mo</p>
	    <div id="image_preview">
		<div class="thumbnail hidden">
		    <img src="w" alt="" style="width; 250px;"/>
		    <div class="caption">
			<h4></h4>
			<p></p>
			<p><button type="button" class="btn btn-danger">Annuler</button></p>
		    </div>
		</div>
	    </div>

	<?php
	}
	else
	{
	?>

	  <label class="control-label" for ="">Photo :</label>
	  <script>
	  $(document).ready(function()
	  {
	    $("#chg_img_btn<?php echo $data->id ?>").click(function()
	    {
	      $("#chg_img<?php echo $data->id ?>").html('<input type="hidden" name="MAX_FILE_SIZE" id="MAX_FILE_SIZE<?php echo $data->id ?>" value="1048576" /><input type="hidden" id="modifimg<?php echo $data->id ?>" value="new" /><input type="file" id="img_princ<?php echo $data->id ?>" name="img_princ"><p class="help-block">La taille de l\'image doit être inférieure à 1Mo</p>');
	    });
	  });
	  </script>
	  <div><span id="chg_img<?php echo $data->id ?>">
	    <a class="fancybox" href="img/dechets/<?php echo("$photo");?>" data-fancybox-group="gallery" title="<?php echo("$data2->nom_dechets");?>"><img class="thumbnail" src="img/dechets/<?php echo("$photo");?>" alt="" width="200px"/><input type="hidden" id="modifimg<?php echo $data->id ?>" value="old" /></a><span id="chg_img_btn<?php echo $data->id ?>" class="btn btn-danger btn-xs">Changer d'image</span></span>
	  </div>

	<?php
	}
	?>
		 </form><br />
		  <input type="button" class="btn btn-primary" value="Ajouter" id="ajouter<?php echo $data->id ?>"><br/><br/>
		</div><!--fin-->
		
		<a href="#" id="btnassocier<?php echo $data->id ?>"><strong>Associer à</strong></a><br />
		<div id="divassocier<?php echo $data->id ?>" class="col-sm-offset-1">
		  <form>
		    <input type="text" class = "form-control" name="research<?php echo $data->id ?>" id="search<?php echo $data->id ?>">
		  </form>
		<input type="button" class="btn btn-primary" value="Associer" id="associer<?php echo $data->id ?>"><br /><br />
		</div>
	      </div>
	    </div>
	    
	<?php
	};
	?>
    </div>

</section>
<?php require 'inc/pieddepage_inc_new.php'; ?>
