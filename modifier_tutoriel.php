
<?php

require 'inc/functions.php'; 
logged_only('modifier_tutoriel.php');

require 'inc/header_inc_new.php';
?>
<script src="js/ajouter-tutoriel_verif-form.js"></script>
<script src="js/script-difficulte.js"></script>
<script src="js/script-autocomplete_ajouter-xx.js"></script> 
<?php

  require_once 'inc/db.php';
  $pdo->query("SET NAMES 'utf8'");
  $req = $pdo->prepare("SELECT * FROM contribution WHERE id =?");
  $req->execute([$_GET['id']]);
  foreach ($req as $data): 
  endforeach;
if(($data->contributeur!==$_SESSION['auth']->username)||($data->type!=="tutoriel"))
{
echo("Cette page ne peut pas être affichée<br /><br /><br /><br /><br /><br /><br /><br /><br />");
}
else{
if(isset($_POST["ajouter"])||isset($_POST["brouillon"]))
{
  if(empty($_FILES['img_princ']['name'])&&($_POST['modifimgprinc']=="new"))
  {
    $img_princ=1;
  }
  elseif(empty($_FILES['img_princ']['name'])&&($_POST['modifimgprinc']=="old"))
  {
    $img_princ=1;
  }
  elseif(!empty($_FILES['img_princ']['name'])&&($_POST['modifimgprinc']=="old"))
  {
    $img_princ=0;
  }

  if(empty($_FILES['img_etape1']['name'])&&($_POST['modifimgetape1']=="new"))
  {
    $img_step1=1;
  }
  elseif(empty($_FILES['img_etape1']['name'])&&$_POST['modifimgetape1']=="old")
  {
    $img_step1=1;
  }
  elseif(!empty($_FILES['img_etape1']['name'])&&$_POST['modifimgetape1']=="old")
  {
    $img_step1=0;
  }
  
  if(isset($_POST["ajouter"]) && (empty($_POST["titre"]) || empty($_POST["dechet"]) || $img_princ || empty($_POST["difficulte"]) || empty($_POST["intro"]) || empty($_POST["materiel"]) || empty($_POST["titre_etape1"]) || $img_step1 || empty($_POST["tutoriel_etape1"]) || empty($_POST["categorie"]) || empty($_POST["motcle"]) || empty($_POST["source"])))
    {
      ?>
      
      <div class="col-sm-12 alert alert-danger">Tous les champs marqué d'une étoile * ne sont pas remplis. Merci de les remplir correctement pour soumettre le tutoriel.</div>
      <?php
    }
  else
    {
    
      $req = $pdo->prepare("SELECT * FROM contribution WHERE id= ?");
      //$req->execute(['85']);
      $req->execute([$_GET['id']]);
    
      require_once 'inc/functions.php';
      $nb_step=count($_POST['nb_step']);
      
      
      
       if(!empty($_FILES['img_princ']['name'])&&($_POST['modifimgprinc']=="new"))
      {
	if($data->img_princ!=="[//VIDE]")
         {
	  unlink("img/img_princ/".$data->img_princ);
         }
	$extension_img_princ = substr(strrchr($_FILES['img_princ']['name'],'.'),1);
	$nom_img_princ = md5(uniqid(rand(), true)).'.'.$extension_img_princ;
	$upload_img_princ = upload('img_princ','img/'.'img_princ'.'/'.$nom_img_princ,1048000, array('png','gif','jpg','jpeg','PNG','GIF','JPEG','JPG') );  
      }
      elseif(empty($_FILES['img_princ']['name'])&&$_POST['modifimgprinc']=="new")
      {
         if($data->img_princ!=="[//VIDE]")
         {
	  unlink("img/img_princ/".$data->img_princ);
         }
         $nom_img_princ="[//VIDE]";  
         
      }
      elseif($_POST['modifimgprinc']=="old")
      {
	 $nom_img_princ=$data->img_princ;
	 
      }
      
      if(!empty($_FILES['img_matos']['name'])&&($_POST['modifimgmatos']=="new"))
      {
	if($data->img_matos!=="[//VIDE]")
	{
	  unlink("img/img_matos/".$data->img_matos);
	}
	$extension_img_matos = substr(strrchr($_FILES['img_matos']['name'],'.'),1);  
	$nom_img_matos = md5(uniqid(rand(), true)).'.'.$extension_img_matos;
	$upload_img_matos = upload('img_matos','img/'.'img_matos'.'/'.$nom_img_matos,1048000, array('png','gif','jpg','jpeg','PNG','GIF','JPEG','JPG') );
      }
      elseif(empty($_FILES['img_matos']['name'])&&($_POST['modifimgmatos']=="new"))
      {
	if($data->img_matos!=="[//VIDE]")
	{
	  unlink("img/img_matos/".$data->img_matos);
	}
	$nom_img_matos="[//VIDE]";
      }
      elseif($_POST['modifimgmatos']=="old")
      {
	$nom_img_matos=$data->img_matos;
      }

      //Creation des noms des images des etapes et upload dans img/tutoriel/nomimage.ext
      for ($i=1; $i<=$nb_step; $i++)
      {
	if(!empty($_FILES['img_etape'.$i.'']['name'])&&$_POST['modifimgetape'.$i.'']=="new")
	{
	  $img_etape=explode("[//ETAPE]",$data->img_etape);
	  if($img_etape[$i]!=="[//VIDE]")
	  {
	    unlink("img/tutoriel/".$img_etape[$i]);
	  }
	  $extension_img = substr(strrchr($_FILES['img_etape'.$i.'']['name'],'.'),1);
	  $nom_img_step[$i] = md5(uniqid(rand(), true)).'.'.$extension_img;
	  $upload_img_step = upload('img_etape'.$i.'','img/'.'tutoriel'.'/'.$nom_img_step[$i],1048000, array('png','gif','jpg','jpeg','PNG','GIF','JPEG','JPG') );
	}
	elseif(empty($_FILES['img_etape'.$i.'']['name'])&&$_POST['modifimgetape'.$i.'']=="new")
	{
	  $img_etape=explode("[//ETAPE]",$data->img_etape);
	  if($img_etape[$i]!=="[//VIDE]")
	  {
	    unlink("img/tutoriel/".$img_etape[$i]);
	  }
	  $nom_img_step[$i] = "[//VIDE]";
	}
	elseif($_POST['modifimgetape'.$i.'']=="old")
	{
	  $img_etape=explode("[//ETAPE]",$data->img_etape); 
	  $nom_img_step[$i]=$img_etape[$i];
	}
      
	if(!empty($_FILES['fictech_etape'.$i.'']['name'])&&$_POST['modiffictechetape'.$i.'']=="new")
	{
	  $fictech_etape=explode("[//ETAPE]",$data->fictech_etape);
	  if($fictech_etape[$i]!=="[//VIDE]")
	  {
	    unlink("img/fictech/".$fictech[$i]);
	  }
	  $extension_fictech_step = substr(strrchr($_FILES['fictech_etape'.$i.'']['name'],'.'),1);
	  $nom_fictech_step[$i] = md5(uniqid(rand(), true)).'.'.$extension_fictech_step;
	  $upload_fictech_step = upload('fictech_etape'.$i.'','img/'.'fictech'.'/'.$nom_fictech_step[$i],1048000, array('pdf','sketch','doc','png','gif','jpg','jpeg','ppt','pptx','xls','xlsx','odt','psd') );
	}
	elseif(empty($_FILES['fictech_etape'.$i.'']['name'])&&$_POST['modiffictechetape'.$i.'']=="new")
	{
	  $fictech_etape=explode("[//ETAPE]",$data->fictech_etape);
	  if($fictech_etape[$i]!=="[//VIDE]")
	  {
	    unlink("img/fictech/".$fictech[$i]);
	  }
	  $nom_fictech_step[$i] = "[//VIDE]";
	}
	elseif($_POST['modiffictechetape'.$i.'']=="old")
	{
	  $fictech_etape=explode("[//ETAPE]",$data->fictech_etape); 
	  $nom_fictech_step[$i]= $fictech_etape[$i];
	}
	
	
	if(!empty($_POST['video_etape'.$i.'']))
	{
	$video_etape[$i]=$_POST['video_etape'.$i.''];
	}
	else
	{
	$video_etape[$i]="[//VIDE]";
	}
	
	
	
	}

	$exec_sql_step='';
	$titre_etapes='';
	$nom_img_steps='';
	$tutoriel_etape='';
	$video_etapes='';
	$nom_fictech_steps='';

    //Creation des contenus des etapes pour les inserer dans la BDD
      for ($i=1; $i<=$nb_step; $i++)
      {
	$titre_etapes=$titre_etapes.'[//ETAPE]'.$_POST['titre_etape'.$i.''];
	$nom_img_steps=$nom_img_steps.'[//ETAPE]'.$nom_img_step[$i];
	$tutoriel_etape=$tutoriel_etape.'[//ETAPE]'.$_POST['tutoriel_etape'.$i.''];
	$video_etapes=$video_etapes.'[//ETAPE]'.$video_etape[$i];
	$nom_fictech_steps=$nom_fictech_steps.'[//ETAPE]'.$nom_fictech_step[$i];
      }

      if(isset($_POST["ajouter"]))
      {
	$publication="publier";
      }
      else
      {
	$publication="brouillon";
      }
      require_once 'inc/db.php';
      $pdo->query("SET NAMES 'utf8'");
      $req = $pdo->prepare("UPDATE contribution SET titre = ?, type = ?, dechet = ?, img_princ = ?, difficulte = ?, intro = ?, materiel = ?, img_matos = ?, titre_etape = ?, img_etape = ?, tutoriel_etape = ?, video_etape = ?, fictech_etape = ?, categorie = ?, motcle = ?, source = ?,  date = ?, publication = ?, valide = ?, nb_etapes = ? WHERE id = ?");
      $req->execute([$_POST['titre'], 'tutoriel', $_POST['dechet'], $nom_img_princ, $_POST['difficulte'], $_POST['intro'],$_POST['materiel'],$nom_img_matos, $titre_etapes, $nom_img_steps, $tutoriel_etape, $video_etapes, $nom_fictech_steps, $_POST['categorie'],$_POST['motcle'],$_POST['source'],date("y-m-d"),$publication,'non', $nb_step, $data->id]);
      
    }
    ?>
    <section>    
  <div class="container">
  <h2 class="text-center">Votre tutoriel a bien été soumis. </h2><br /><h5 class="text-center">Vous pouvez le retrouver sur votre page "Vos contributions" via votre tableau de bord pour le modifier (si vous avez cliqué sur "Publier ce tuto") ou le continuer (si vous avez cliqué sur "Continuer plus tard"). <br /><br />Avant publication sur le site, il sera soumis à notre équipe de modération qui le validera après vérification de la conformité des informations. </h5><br /><a href="ajouter-tutoriel.php"><h4 class="text-center">Ajouter un autre tutoriel</h4><br /><br /></a>
  </div>
  </section>
    <?php
}
else
{



?> 


  
    <script>
  
                     $(function () {
                // A change sélection de fichier
                $('#form').find('input[name="img_princ"]'||'input[name="img_matos"]').on('change', function (e) {
                    var files = $(this)[0].files;yer true ou false lorsque le formulaire est envoyé :

                    if (files.length > 0) {
                        // On part du principe qu'il n'y qu'un seul fichier
                        // étant donné que l'on a pas renseigné l'attribut "multiple"
                        var file = files[0],
                            $image_preview = $('#image_preview');

                        // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
                        $image_preview.find('.thumbnail').removeClass('hidden');
                        $image_preview.find('img').attr('src', window.URL.createObjectURL(file));
                        $image_preview.find('h4').html(file.name);
                        $image_preview.find('.caption p:first').html(file.size +' bytes');
                    }
                });

                // Bouton "Annuler"
                $('#image_preview').find('button[type="button"]').on('click', function (e) {
                    e.preventDefault();

                    $('#form').find('input[name="img_princ"]').val('');
                    $('#image_preview').find('.thumbnail').addClass('hidden');
                });
            });
  </script>
  


<section>    
  <div class="container">
<h2 class="text-center">Contribuez au contenu</h2>
<h5 class="text-center">Partagez avec la communauté vos idées, tutoriels, ou methodes de recyclage d'un déchet en les ajoutant via le formulaire suivant : </h5><br /><br /> 
    
    
    <form id="form" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
    <x1>Tutoriel :</x1><br />
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Titre * :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="titre" class = "form-control" <?php if (empty($data->titre)){echo("placeholder=\"Ex : Fauteuil de jardin en palette\"");}else{echo("value=\"$data->titre\"");}?> maxlength="255" onblur="verifTitre(this)" id="coco"/>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Déchet/matière première * : </label>
	    <div class="col-sm-10">
	      <input type="text" name ="dechet" id="search_second" class = "form-control search" <?php if (empty($data->dechet)){echo("placeholder=\"Ex : Palettes\"");}else{echo("value=\"$data->dechet\"");}?> onblur="verifDechet(this)"/>
	      <input type="hidden" name = "cat" id="search_second-cat" <?php if (empty($data->cat_associe)){echo("value=\"\"");}else{echo("value=\"$data->cat_associee\"");}?>>
	    </div>
	</div>	
	
	
	<?php if($data->img_princ=="[//VIDE]")
	{
	  ?>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo principale * :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="hidden" name="modifimgprinc" value="new" />
		<input type="file" id="InputFile" name="img_princ" accept="image/*" onblur="verifimgPrinc(this)">
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
	{?>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo principale * :</label>
	    
	    
	    
<script>
$(document).ready(function(){
	$("#chg_img_btn").click(function(){
        $("#chg_img").html('<input type="hidden" name="MAX_FILE_SIZE" value="1048576" /><input type="hidden" name="modifimgprinc" value="new" /><input type="file" id="InputFile" name="img_princ"><p class="help-block">La taille de l\'image doit être inférieure à 1Mo</p>');
    });
});
</script>


	    
	    <div class="col-sm-3"><span id="chg_img">
	    <a class="fancybox" href="img/img_princ/<?php echo("$data->img_princ");?>" data-fancybox-group="gallery" title="<?php echo("$data->titre");?>"><img class="thumbnail" src="img/img_princ/<?php echo("$data->img_princ");?>" alt="" width="200px"/><input type="hidden" name="modifimgprinc" value="old" /></a><input type="hidden" name="img_princ" value="rempli"><span id="chg_img_btn" class="btn btn-danger btn-xs">Changer d'image</span></span>

	    </div>
	</div>	
	<?php
	}
	?>
	
	
	<div class="form-group">
	  <label class="control-label col-sm-2" for =""><br />Difficulté * :</label> 
	  
	  <script>
	  $(document).ready(function(){
	      $("#chg_diff_btn").click(function(){
		  $("#chg_diff").remove(),
		  $("#votex").html("<span id=\"vote\"><div class=\"rating\"><span id=\"5s\" class=\"x\">&starf;</span><span id=\"4s\" class=\"x\">&starf;</span><span id=\"3s\" class=\"x\">&starf;</span><span id=\"2s\" class=\"x\">&starf;</span><span id=\"1s\" class=\"x\">&starf;</span><input type=\"hidden\" name=\"difficulte\" value=\"0\" onblur=\"verifdifficulte(this)\" id=\"difficulte\"/></div><input type=\"hidden\" name=\"modifdiff\" value=\"new\" /></span>");
	      });
	  });
	  </script>
	  
	  
	<div class="col-sm-10 ">
	  <div id="votex">
	    <span id="chg_diff">
		  <?php
		  if($data->difficulte==0)
		  {
		  ?>
		    <span id="vote" name="votex">
		      <div class="rating">
			<span id="5s" class="x">&starf;</span><span id="4s" class="x">&starf;</span><span id="3s" class="x">&starf;</span><span id="2s" class="x">&starf;</span><span id="1s" class="x">&starf;</span><input type="hidden" name="difficulte" value="0" onblur="verifdifficulte(this)" id="difficulte"/>
		      </div>
		      <input type="hidden" name="modifdiff" value="new"/>
		    </span>
		  <?php
		  }
		  else
		  {
		    for ($i=1;$i<=$data->difficulte;$i++)
		      {
			echo('<span class="rating_full">&starf;</span>');
		      }
		      
		      for ($i=1;$i<=5-$data->difficulte;$i++)
		      {
			echo('<span class="rating_empty">&starf;</span>');
		      }
		    echo("<input type='hidden' id='difficulte' name='difficulte' value='".$data->difficulte."'><br /><span id=\"chg_diff_btn\" class=\"btn btn-danger btn-xs\">Changer la difficulté</span><input type=\"hidden\" name=\"modifdiff\" value=\"old\" />");
		  }
		  ?>
	    </span>
	  </div>      
	</div>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Introduction * :</label>
	    <div class="col-sm-10">
	      <textarea class="textarea form-control" rows="3" class = "form-control" name="intro" onblur="verifintro(this)" <?php if (empty($data->intro)){echo("placeholder=\"Ex : Ce tutoriel permet de revaloriser...\"/>");}else{echo("/>$data->intro");}?></textarea>
	    </div>
	</div>	
	<br /><br /><x1>Matériel : </x1><br /><br />
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Matériel nécessaire * :</label>
	    <div class="col-sm-10">
	      <textarea class="textarea form-control" rows="3" class = "form-control" name="materiel" onblur="verifmateriel(this)" <?php if (empty($data->materiel)){echo("placeholder=\"Ex : Voici la liste du matériel dont vous aurez besoin pour réaliser ce tuto :..\"/>");}else{echo("/>$data->materiel");}?></textarea>
	    </div>
	</div>	

	
	<?php if($data->img_matos=="[//VIDE]")
	{
	  ?>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo matériel :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="hidden" name="modifimgmatos" value="new" />
		<input type="file" id="InputFile" name="img_matos" accept="image/*" onblur="verifimgPrinc(this)">
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
	{?>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo matériel :</label>
	
	<script>
	$(document).ready(function(){
	    $("#chg_matos_btn").click(function(){
		$("#chg_matos").html('<input type="hidden" name="MAX_FILE_SIZE" value="1048576" /><input type="hidden" name="modifimgmatos" value="new" /><input type="file" id="InputFile" name="img_princ"><p class="help-block">La taille de l\'image doit être inférieure à 1Mo</p>');
	    });
	});
	</script>
	    
	    <div class="col-sm-3"><span id="chg_matos">
	    <a class="fancybox" href="img/img_matos/<?php echo("$data->img_matos");?>" data-fancybox-group="gallery" title="Materiel"><img class="thumbnail" src="img/img_matos/<?php echo("$data->img_matos");?>" alt="" width="200px"/><input type="hidden" name="modifimgmatos" value="new" /></a><span id="chg_matos_btn" class="btn btn-danger btn-xs">Changer d'image</span></span>

	    </div>
	</div>	
	<?php
	}
	?>
	
	
	
	
	
<br /><br /><x1>Etapes : </x1><br /><br />


	<?php 
	$titre_etapes=explode("[//ETAPE]",$data->titre_etape);
	$img_etape=explode("[//ETAPE]",$data->img_etape); 
	$video_etape=explode("[//ETAPE]",$data->video_etape);
	$description_etape=explode("[//ETAPE]",$data->tutoriel_etape);
	$fictech_etape=explode("[//ETAPE]",$data->fictech_etape); 
	for($i=1; $i<=$data->nb_etapes;$i++)
	{
	?>
	

	<x2>Etape <?php echo($i); ?> : </x2><br /><br />
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Titre de l'étape * :</label>
	    <div class="col-sm-10">
	      <input type="hidden" name="nb_step[<?php echo($i); ?>]"/>
	      <input type="text" name ="titre_etape<?php echo($i); ?>" class = "form-control" <?php echo("value=\"$titre_etapes[$i]\"");?> maxlength="255" onblur="veriftitre_etape1(this)"/>
	    </div>
	</div>

	<?php if($img_etape[$i]=="[//VIDE]")
	{
	  ?>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo de l'étape * :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="hidden" name="modifimgetape<?php echo($i); ?>" value="new" />
		<input type="file" id="InputFile" name="img_etape<?php echo($i); ?>" accept="image/*" onblur="verifimg_etape1(this)">
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
	{?>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo de l'étape * :</label>
	
	<script>
	$(document).ready(function(){
	    $("#chg_etape_btn<?php echo($i); ?>").click(function(){
		$("#chg_img_etape<?php echo($i); ?>").html('<input type="hidden" name="MAX_FILE_SIZE" value="1048576" /><input type="hidden" name="modifimgetape<?php echo($i); ?>" value="new" /><input type="file" id="InputFile" name="img_etape<?php echo($i); ?>"><p class="help-block">La taille de l\'image doit être inférieure à 1Mo</p>');
	    });
	});
	</script>
	    
	    <div class="col-sm-3"><span id="chg_img_etape<?php echo($i); ?>">
	    <a class="fancybox" href="img/tutoriel/<?php echo $img_etape[$i]; ?>" data-fancybox-group="gallery" title="Etape <?php echo($i); ?>"><img class="thumbnail" src="img/tutoriel/<?php echo $img_etape[$i]; ?>" alt="" width="200px"/><input type="hidden" name="modifimgetape<?php echo($i); ?>" value="old" /><input type="hidden" name="img_etape<?php echo($i); ?>" value="nonvide"></a><span id="chg_etape_btn<?php echo($i); ?>" class="btn btn-danger btn-xs">Changer d'image</span></span>

	    </div>
	</div>	
	<?php
	}
	?>
	
	
	
	
	
	
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Description de l'étape * :</label>
	    <div class="col-sm-10">
	      <textarea class="textarea form-control" rows="3" class = "form-control" name="tutoriel_etape<?php echo($i); ?>" onblur="veriftutoriel_etape1(this)"/><?php echo("$description_etape[$i]");?></textarea>
	    </div>
	</div>	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Video :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="video_etape<?php echo($i); ?>" class = "form-control" <?php if ($video_etape[$i]=="[//VIDE]"){echo("placeholder=\"Ex : https://youtu.be/6MQZRyjxprE\"");}else{echo("value=\"$video_etape[$i]\"");}?>/>
	      <p class="help-block">Lien youtube, dailymotion, vimeo...</p>
	    </div>
	</div>
	
	
	<?php if($fictech_etape[$i]=="[//VIDE]")
	{
	  ?>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Fichier technique (PDF, sketch... ) :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="hidden" name="modiffictechetape<?php echo($i); ?>" value="new" />
		<input type="file" id="InputFile" name="fictech_etape<?php echo($i); ?>">
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
	{?>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Fichier technique (PDF, sketch... ) :</label>
	
	<script>
	$(document).ready(function(){
	    $("#chg_fictech_btn<?php echo($i); ?>").click(function(){
		$("#chg_fictech_etape<?php echo($i); ?>").html('<input type="hidden" name="MAX_FILE_SIZE" value="1048576" /><input type="hidden" name="modiffictechetape<?php echo($i); ?>" value="new" /><input type="file" id="InputFile" name="fictech_etape<?php echo($i); ?>"><p class="help-block">La taille de l\'image doit être inférieure à 1Mo</p>');
	    });
	});
	</script>
	    
	    <div class="col-sm-3"><span id="chg_fictech_etape<?php echo($i); ?>">
	    <a href="img/fictech/<?php echo $img_fictech[$i]; ?>"><img class="thumbnail" src="img/img_fic_tech.png"/><input type="hidden" name="modiffictechetape<?php echo($i); ?>" value="old" /></a><span id="chg_fictech_btn<?php echo($i); ?>" class="btn btn-danger btn-xs">Changer de fichier</span></span>

	    </div>
	</div>	
	<?php
	}
	?>
	
	
	<?php
	}
	?>
	
	<script type="text/javascript">
	  function create_champ(i) {

	    var i2 =  i+1;
	    
	    document.getElementById('leschamps_'+i).innerHTML = 
	    '<x2>Etape '+i2+' : </x2><br /><br /><div class="form-group"><label class="control-label col-sm-2" for ="">Titre de l\'étape * :</label><div class="col-sm-10"><input type="hidden" name="nb_step['+i2+']"/><input type="text" name ="titre_etape'+i2+'" class = "form-control" placeholder="Ex : Fauteuil de jardin en palette" maxlength="255"/></div></div><div class="form-group"><label class="control-label col-sm-2" for ="">Photo de l\'étape * :</label><div class="col-sm-10"><input type="hidden" name="MAX_FILE_SIZE" value="1048576" /><input type="hidden" name="modifimgetape'+i2+'" value="new" /><input type="file" id="InputFile" name="img_etape'+i2+'"><p class="help-block">La taille de l\'image doit être inférieure à 1Mo</p></div></div><div class="form-group"><label class="control-label col-sm-2" for ="">Description de l\'étape * :</label><div class="col-sm-10"><textarea class="textarea form-control" rows="3" class = "form-control" name="tutoriel_etape'+i2+'"/></textarea></div></div><div class="form-group"><label class="control-label col-sm-2" for ="">Video :</label><div class="col-sm-10"><input type="text" name ="video_etape'+i2+'" class = "form-control" placeholder="Ex : https://youtu.be/6MQZRyjxprE"/><p class="help-block">Lien youtube, dailymotion, vimeo...</p></div></div><div class="form-group"><label class="control-label col-sm-2" for ="">Fichier technique (PDF, sketch... ) :</label><div class="col-sm-10"><input type="hidden" name="MAX_FILE_SIZE_etape'+i+'" value="1048576" /><input type="file" id="InputFile" name="fictech_etape'+i2+'"><input type="hidden" name="modiffictechetape'+i2+'" value="new" /><p class="help-block">La taille du fichier doit être inférieure à 1Mo</p></div></div>';
	    
	    document.getElementById('leschamps_'+i).innerHTML += (i <= 50) ? '<br /><span id="leschamps_'+i2+'"><a href="javascript:create_champ('+i2+') "  class="btn btn-default  col-sm-offset-2">Ajouter une étape</a></span>' : '';
	  }
	</script>
	<span id="leschamps_<?php echo($data->nb_etapes);?>"><a href="javascript:create_champ(<?php echo($data->nb_etapes);?>)" class="btn btn-default col-sm-offset-2">Ajouter une étape</a></span>

	
	<br /><br /><x1>Complément : </x1><br /><br />
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Catégorie * :</label>
	    <div class="col-sm-10">
	      <select class="form-control" name="categorie" onblur="verifcategorie(this)">
		<option value="decoration" name="categorie" <?php if($data->categorie=="decoration"){echo("selected=\"selected\"");}?> >Décoration</option>
		<option value="pratique" name="categorie"<?php if($data->categorie=="pratique"){echo("selected=\"selected\"");}?>>Pratique</option>
		<option value="meubles" name="categorie" <?php if($data->categorie=="meubles"){echo("selected=\"selected\"");}?>>Meubles</option>
		<option value="technologie" name="categorie" <?php if($data->categorie=="technologie"){echo("selected=\"selected\"");}?>>Technologie</option>
		<option value="jardin" name="categorie" <?php if($data->categorie=="jardin"){echo("selected=\"selected\"");}?>>Jardin</option>
		<option value="lampes" name="categorie" <?php if($data->categorie=="lampes"){echo("selected=\"selected\"");}?>>Lampes</option>
		<option value="maison" name="categorie" <?php if($data->categorie=="maison"){echo("selected=\"selected\"");}?>>Maison</option>
		<option value="autre" name="categorie" <?php if($data->categorie=="autre"){echo("selected=\"selected\"");}?>>Autre</option>
	      </select>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Mots-clefs *:</label>
	    <div class="col-sm-10">
	      <input type="text" name ="motcle" class = "form-control" <?php if(empty($data->motcle)){echo("placeholder=\"Ex : motclé1, motclé2...\"");}else{echo("value=\"$data->motcle\"");}?> />
	      <p class="help-block">Veuillez à séparer les mots-clefs par des virgules</p>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Source * :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="source" class = "form-control" <?php if(empty($data->source)){echo("placeholder=\"http://www.sitesource.com\"");}else{echo("value=\"$data->source\"");}?> onblur="verifsource(this)"/>
	      <p class="help-block">Le site ou se trouve initialement ce tutoriel, ou votre site personnel.</p>
	    </div>
	</div>
	<div class="form-group">
	<div id="erreur" class="col-sm-offset-2 col-sm-10"></div>
	</div>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10">
	    <button type="submit" class="btn btn-primary" name="ajouter" onclick='return verifForm(this.form)'>Publier ce tuto !</button>
	    <button type="submit" class="btn btn-default" name="brouillon">Continuer plus tard</button>
	  
	  </div>
	</div>
	
    </form>



  </div>
</section>
<?php 
}
}

require 'inc/pieddepage_inc_new.php'; ?>