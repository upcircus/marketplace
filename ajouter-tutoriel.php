<?php
require 'inc/functions.php'; 
logged_only('ajouter-tutoriel.php');
require 'inc/header_inc_new.php';
require 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");
$req_filtre=$pdo->query("SELECT * FROM famille_contrib");
?>

<script src="js/script-autocomplete_ajouter-xx.js"></script> 
<script src="js/verif_video.js"></script>
<script src="js/ajouter-tutoriel_verif-form.js"></script>
<script src="js/script-difficulte.js"></script>
<?php
if(isset($_POST["ajouter"])||isset($_POST["brouillon"]))
{

  if(isset($_POST["ajouter"]) && (empty($_POST["titre"]) || empty($_POST["dechet"]) || empty($_FILES["img_princ"]) || empty($_POST["difficulte"]) || empty($_POST["intro"]) || empty($_POST["materiel"]) || empty($_POST["titre_etape1"]) || empty($_FILES["img_etape1"]) || empty($_POST["tutoriel_etape1"]) || empty($_POST["categorie"]) || empty($_POST["motcle"]) || empty($_POST["source"])))
    {
      ?>
      <div class="col-sm-12 alert alert-danger">Tous les champs marqué d'une étoile * ne sont pas remplis. Merci de les remplir correctement pour soumettre le tutoriel.</div>
      <?php
    }
  else
    {
      require_once 'inc/functions.php';
      $nb_step=count($_POST['nb_step']);
      if(!empty($_FILES['img_princ']['name']))
      {
	$extension_img_princ = substr(strrchr($_FILES['img_princ']['name'],'.'),1);
	$nom_img_princ = md5(uniqid(rand(), true)).'.'.$extension_img_princ;
	$upload_img_princ = upload('img_princ','img/'.'img_princ'.'/'.$nom_img_princ,1048000, array('png','gif','jpg','jpeg','PNG','GIF','JPG','JPEG') );  
      }
      else
      {
         $nom_img_princ="[//VIDE]";  
      }
      
      if(!empty($_FILES['img_matos']['name']))
      {
	$extension_img_matos = substr(strrchr($_FILES['img_matos']['name'],'.'),1);  
	$nom_img_matos = md5(uniqid(rand(), true)).'.'.$extension_img_matos;
	$upload_img_matos = upload('img_matos','img/'.'img_matos'.'/'.$nom_img_matos,1048000, array('png','gif','jpg','jpeg','PNG','GIF','JPG','JPEG') );
      }
      else
      {
	$nom_img_matos="[//VIDE]";
      }

      //Creation des noms des images des etapes et upload dans img/tutoriel/nomimage.ext
      for ($i=1; $i<=$nb_step; $i++)
      {
	if(!empty($_FILES['img_etape'.$i.'']['name']))
	{
	  $extension_img = substr(strrchr($_FILES['img_etape'.$i.'']['name'],'.'),1);
	  $nom_img_step[$i] = md5(uniqid(rand(), true)).'.'.$extension_img;
	  $upload_img_step = upload('img_etape'.$i.'','img/'.'tutoriel'.'/'.$nom_img_step[$i],1048000, array('png','gif','jpg','jpeg','PNG','GIF','JPG','JPEG') );
	}
	else
	{
	  $nom_img_step[$i] = "[//VIDE]";
	}
      
	if(!empty($_FILES['fictech_etape'.$i.'']['name']))
	{
	  $extension_fictech_step = substr(strrchr($_FILES['fictech_etape'.$i.'']['name'],'.'),1);
	  $nom_fictech_step[$i] = md5(uniqid(rand(), true)).'.'.$extension_fictech_step;
	  $upload_fictech_step = upload('fictech_etape'.$i.'','img/'.'fictech'.'/'.$nom_fictech_step[$i],1048000, array('pdf','sketch','doc','png','gif','jpg','jpeg','ppt','pptx','xls','xlsx','odt','psd') );
	}
	else
	{
	  $nom_fictech_step[$i] = "[//VIDE]";
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
      
      
      if($_POST["cat"]!=="")
	{
	  $cat_associe=$_POST["cat"];
	}
	else
	{
	  $cat_associe="nouveau";
	}
      
      
      require_once 'inc/db.php';
      $pdo->query("SET NAMES 'utf8'");
      $req = $pdo->prepare("INSERT INTO contribution SET id = ?, titre = ?, type = ?, dechet = ?, cat_associe = ?, img_princ = ?, difficulte = ?, intro = ?, materiel = ?, img_matos = ?, titre_etape = ?, img_etape = ?, tutoriel_etape = ?, video_etape = ?, fictech_etape = ?, categorie = ?, motcle = ?, source = ?, contributeur = ?, nb_note = ?, nb_coupcoeur = ?, note = ?, date = ?, publication = ?, valide = ?, nb_etapes = ?");
      $req->execute(['',$_POST['titre'], 'tutoriel', $_POST['dechet'], $cat_associe, $nom_img_princ, $_POST['difficulte'], $_POST['intro'],$_POST['materiel'],$nom_img_matos, $titre_etapes, $nom_img_steps, $tutoriel_etape, $video_etapes, $nom_fictech_steps, $_POST['categorie'],$_POST['motcle'],$_POST['source'],$_SESSION['auth']->username,'0','0','0',date("y-m-d"),$publication,'non', $nb_step]);
      
	$lastId = $pdo->lastInsertId();
	$sql = "CREATE TABLE prod_".$lastId." (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `auteur` VARCHAR(256) NOT NULL,
	  `date` DATE NOT NULL,
	  `commentaire` TEXT NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;";
	$reqid = $pdo->exec($sql);
      
      $req2=$pdo->prepare('INSERT INTO requetes SET id = ?, user = ?, date = NOW(), recherche = ?, nb_res = ?');
      $req2->execute(['',$_SESSION['auth']->username,$_POST['dechet'],'']);
    }
    ?>


    <section>    
  <div class="container">
  <h2 class="text-center">Votre tutoriel a bien été soumis. </h2><br /><h5 class="text-center">Vous pouvez le retrouver sur votre page "Vos contributions" via votre tableau de bord pour le modifier (si vous avez cliqué sur "Publier ce tuto") ou le continuer (si vous avez cliqué sur "Continuer plus tard"). <br /><br />Avant publication sur le site, il sera soumis à notre équipe de modération qui le validera après vérification de la conformité des informations. </h5><a href="ajouter-tutoriel.php"><h4 class="text-center">Ajouter un autre tutoriel</h4><br /><br /></a>
  </div>
  </section>
    <?php
}

elseif(isset($_POST['ajouter2'])||isset($_POST['brouillon2']))
{
  if(isset($_POST['ajouter2'])&&(empty($_POST["titre"])||empty($_POST["dechet"])||empty($_POST["video1"])||empty($_POST["difficulte2"])))
  {
    ?>
    <div class="col-sm-12 alert alert-danger">Tous les champs marqué d'une étoile * ne sont pas remplis. Merci de les remplir correctement pour soumettre le tutoriel.</div>
    <?php
  }
  else
  {
      
      if(isset($_POST["ajouter2"]))
      {
	
	$publication="publier";

      }
      elseif(isset($_POST["brouillon2"]))
      {
	
	$publication="brouillon";
      }
      
      if(empty($_POST['source']))
	{
	  $source="0";
	}
	else
	{
	  $source=$_POST["source"];
	}
	
	if($_POST["cat"]!=="")
	{
	  $cat_associe=$_POST["cat"];
	}
	else
	{
	  $cat_associe="nouveau";
	}
      require_once 'inc/db.php';
      $pdo->query("SET NAMES 'utf8'");
      $req = $pdo->prepare("INSERT INTO contribution SET id = ?, titre = ?, type = ?, dechet = ?, cat_associe = ?, img_princ = ?, difficulte = ?, intro = ?, categorie = ?, motcle = ?, source = ?, contributeur = ?, nb_note = ?, nb_coupcoeur = ?, note = ?, date = ?, publication = ?, valide = ?, nb_etapes = ?");
      $req->execute(['',$_POST['titre'], 'tutovideo', $_POST['dechet'], $cat_associe, $_POST['video1'], $_POST['difficulte2'], $_POST['comadd'], $_POST['categorie'],$_POST['motcle'],$_POST['source'],$_SESSION['auth']->username,'0','0','0',date("y-m-d"),$publication,'non', 0]);
      
      	$lastId2 = $pdo->lastInsertId();
	$sql2 = "CREATE TABLE prod_".$lastId2." (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `auteur` VARCHAR(256) NOT NULL,
	  `date` DATE NOT NULL,
	  `commentaire` TEXT NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;";
	$reqid2 = $pdo->exec($sql2);
      
      $req2=$pdo->prepare('INSERT INTO requetes SET id = ?, user = ?, date = NOW(), recherche = ?, nb_res = ?');
      $req2->execute(['',$_SESSION['auth']->username,$_POST['dechet'],'']);
      
      
         ?>
         <section>    
  <div class="container">
  <h2 class="text-center">Votre tutoriel vidéo a bien été soumis. </h2><br />
  <h5 class="text-center">Vous pouvez le retrouver sur votre page "Vos contributions" via votre tableau de bord<br /><br />Avant publication sur le site, il sera soumis à notre équipe de modération qui le validera après vérification de la conformité des informations. </h5><a href="ajouter-tutoriel.php"><h4 class="text-center">Ajouter un autre tutoriel</h4><br /><br /></a>
  </div>
  </section>
<?php
  }
}   

else
{
?> 


<section>    
  <div class="container">
<h2 class="text-center">Contribuez au contenu</h2>
<h5 class="text-center">Partagez avec la communauté vos idées, tutoriels, ou methodes de recyclage d'un déchet en les ajoutant via le formulaire suivant : </h5><br /><br /> 
    
   <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#detail">Tutoriel détaillé</a></li>
    <li><a data-toggle="tab" href="#video">Tutoriel vidéo seule</a></li>
   </ul>
  
    
   <div class="tab-content">
      <div id="detail" class="tab-pane fade in active">
  
    <form id="form" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
    <h1>Tutoriel détaillé</h1><br /><br />
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Titre * :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="titre" class = "form-control" placeholder="Ex : Fauteuil de jardin en palette" maxlength="255" onblur="verifTitre(this)" id="coco"/>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Déchet/matière première * : </label>
	    <div class="col-sm-10">
	      <input type="text" name ="dechet" id="search_second" class = "form-control search" placeholder="Ex : Palettes" onblur="verifDechet(this)"/>
	      <input type="hidden" name = "cat" id="search_second-cat">
	    </div>
	</div>	
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo principale * :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="file" id="img_princ" name="img_princ" accept="image/*" onblur="verifimgPrinc(this)">
		<script>
		$('#img_princ').change(function(){
			var file = this.files[0];
			
			if(file.size>1048576)
			{
			document.getElementById("alert").innerHTML = '<div class="alert alert-danger">Votre fichier : ' + file.name + ' est trop volumineux (' + Math.round(file.size/1024, -1)+'Ko). Pour pouvoir valider le formulaire il doit être inférieur à 1024Ko. <input type="hidden" name="img_princ_taille" value="non" onblur="verifimgPrinctaille(this)" ></div>';
			}
			else if(file.size<1048576)
			{
			document.getElementById("alert").innerHTML = '<div class="alert alert-success">Votre fichier : ' + file.name + ' est conforme.<input type="hidden" name="img_princ_taille" value="oui" onblur="verifimgPrinctaille(this)"></div>';
			}
			
		});
		</script>
		<p class="help-block">La taille de l'image doit être inférieure à 1Mo</p>
		<div id="alert"><input type="hidden" name="img_princ_taille" value="oui" onblur="verifimgPrinctaille(this)"></div>
	    </div>
	</div>	
	
	<div class="form-group">
	  <label class="control-label col-sm-2" for =""><br />Difficulté * :</label> 
	    <div class="col-sm-10 ">
	      <div id="vote">
		<div class="rating" >
		  <span id="5s" class="x">&starf;</span><span id="4s" class="x">&starf;</span><span id="3s" class="x">&starf;</span><span id="2s" class="x">&starf;</span><span id="1s" class="x">&starf;</span>
		  <input type="hidden" name="difficulte" value="0" onblur="verifdifficulte(this)" id="difficulte"/>
		</div>
	      </div>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Introduction * :</label>
	    <div class="col-sm-10">
	      <textarea class="textarea form-control" rows="3" class = "form-control" name="intro" placeholder="Ex : Ce tutoriel permet de revaloriser..." onblur="verifintro(this)"/></textarea>
	    </div>
	</div>	
	<br /><br /><x1>Matériel : </x1><br /><br />
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Matériel nécessaire * :</label>
	    <div class="col-sm-10">
	      <textarea class="textarea form-control" rows="3" class = "form-control" name="materiel" placeholder="Ex : Voici la liste du matériel dont vous aurez besoin pour réaliser ce tuto :..." onblur="verifmateriel(this)"/></textarea>
	    </div>
	</div>	

	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo matériel :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="file" id="img_matos" name="img_matos" accept="image/*">
		<script>
		$('#img_matos').change(function(){
			var file = this.files[0];
			
			if(file.size>1048576)
			{
			document.getElementById("alert2").innerHTML = '<div class="alert alert-danger">Votre fichier : ' + file.name + ' est trop volumineux (' + Math.round(file.size/1024, -1)+'Ko). Pour pouvoir valider le formulaire il doit être inférieur à 1024Ko. <input type="hidden" name="img_matos_taille" value="non" onblur="verifimgmatostaille(this)" ></div>';
			}
			else if(file.size<1048576)
			{
			document.getElementById("alert2").innerHTML = '<div class="alert alert-success">Votre fichier : ' + file.name + ' est conforme.<input type="hidden" name="img_matos_taille" value="oui" onblur="verifimgmatostaille(this)"></div>';
			}
		});
		</script>
		<p class="help-block">La taille de l'image doit être inférieure à 1Mo</p>
		<div id="alert2"><input type="hidden" name="img_matos_taille" value="oui" onblur="verifimgmatostaille(this)"></div>
	    </div>
	</div>	
	<br /><br /><x1>Etapes : </x1><br /><br />
	<x2>Etape 1 : </x2><br /><br />
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Titre de l'étape * :</label>
	    <div class="col-sm-10">
	      <input type="hidden" name="nb_step[1]"/>
	      <input type="text" name ="titre_etape1" class = "form-control" placeholder="Ex : Fauteuil de jardin en palette" maxlength="255" onblur="veriftitre_etape1(this)"/>
	    </div>
	</div>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo de l'étape * :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="file" id="img_etape1" name="img_etape1" accept="image/*" onblur="verifimg_etape1(this)">
		<script>
		$('#img_etape1').change(function(){
			var file = this.files[0];
			
			if(file.size>1048576)
			{
			document.getElementById("alert3").innerHTML = '<div class="alert alert-danger">Votre fichier : ' + file.name + ' est trop volumineux (' + Math.round(file.size/1024, -1)+'Ko). Pour pouvoir valider le formulaire il doit être inférieur à 1024Ko. <input type="hidden" name="img_step1_taille" value="non" onblur="verifimgsteptaille(this)" ></div>';
			}
			else if(file.size<1048576)
			{
			document.getElementById("alert3").innerHTML = '<div class="alert alert-success">Votre fichier : ' + file.name + ' est conforme.<input type="hidden" name="img_step1_taille" value="oui" onblur="verifimgsteptaille(this)"></div>';
			}
		});
		</script>
		<p class="help-block">La taille de l'image doit être inférieure à 1Mo</p>
		<div id="alert3"><input type="hidden" name="img_step1_taille" value="oui" onblur="verifimgsteptaille(this)"></div>
	    </div>
	</div>	
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Description de l'étape * :</label>
	    <div class="col-sm-10">
	      <textarea class="textarea form-control" rows="3" class = "form-control" name="tutoriel_etape1" onblur="veriftutoriel_etape1(this)"/></textarea>
	    </div>
	</div>	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Video :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="video_etape1" class = "form-control" placeholder="Ex : https://youtu.be/6MQZRyjxprE" onblur="verifvidetape(this)"/>
	      <p class="help-block">Liens Youtube, dailymotion ou Vimeo uniquement</p><div id="verifvidetapeid1"></div>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Fichier technique (PDF, sketch... ) :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="file" id="InputFile" name="fictech_etape1"/>
		<p class="help-block">La taille du fichier doit être inférieure à 1Mo</p>
	    </div>
	</div>	

	<script type="text/javascript">
	  function create_champ(i) {
	    var i2 = i + 1;
	    
	    $("#img_etape"+i2+"").change(function(){
		    var file = this.files[0];
		    
		    if(file.size>1048576)
		    {
		    document.getElementById("alertstep"+i2+"").innerHTML = '<div class="alert alert-danger">Votre fichier : ' + file.name + ' est trop volumineux (' + Math.round(file.size/1024, -1)+'Ko). Pour pouvoir valider le formulaire il doit être inférieur à 1024Ko. </div>';
		    }
		    else if(file.size<1048576)
		    {
		    document.getElementById("alertstep"+i2+"").innerHTML = '<div class="alert alert-success">Votre fichier : ' + file.name + ' est conforme. </div>';
		    }
	    });
	    
	    document.getElementById('leschamps_'+i).innerHTML = 
	    '<x2>Etape '+i2+' : </x2><br /><br /><div class="form-group"><label class="control-label col-sm-2" for ="">Titre de l\'étape * :</label><div class="col-sm-10"><input type="hidden" name="nb_step['+i2+']"/><input type="text" name ="titre_etape'+i2+'" class = "form-control" placeholder="Ex : Fauteuil de jardin en palette" maxlength="255"/></div></div><div class="form-group"><label class="control-label col-sm-2" for ="">Photo de l\'étape * :</label><div class="col-sm-10"><input type="hidden" name="MAX_FILE_SIZE" value="1048576" /><input type="file" id="InputFile" name="img_etape'+i2+'"><p class="help-block">La taille de l\'image doit être inférieure à 1Mo</p><div id="alertstep'+i2+'"></div></div></div><div class="form-group"><label class="control-label col-sm-2" for ="">Description de l\'étape * :</label><div class="col-sm-10"><textarea class="textarea form-control" rows="3" class = "form-control" name="tutoriel_etape'+i2+'"/></textarea></div></div><div class="form-group"><label class="control-label col-sm-2" for ="">Video :</label><div class="col-sm-10"><input type="text" name ="video_etape'+i2+'" class = "form-control" placeholder="Ex : https://youtu.be/6MQZRyjxprE" onblur="verifvidetape(this)"/><p class="help-block">Liens youtube, dailymotion, vimeo uniquement</p><div id="verifvidetapeid'+i2+'"></div></div></div><div class="form-group"><label class="control-label col-sm-2" for ="">Fichier technique (PDF, sketch... ) :</label><div class="col-sm-10"><input type="hidden" name="MAX_FILE_SIZE_etape'+i+'" value="1048576" /><input type="file" id="InputFile" name="fictech_etape'+i2+'"><p class="help-block">La taille du fichier doit être inférieure à 1Mo</p></div></div>';
	    
	    document.getElementById('leschamps_'+i).innerHTML += (i <= 50) ? '<br /><span id="leschamps_'+i2+'"><a href="javascript:create_champ('+i2+') "  class="btn btn-default  col-sm-offset-2">Ajouter une étape</a></span>' : '';
	  }
	</script>
	<span id="leschamps_1"><a href="javascript:create_champ(1)" class="btn btn-default col-sm-offset-2">Ajouter une étape</a></span>

	<br /><br /><x1>Complément : </x1><br /><br />
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Catégorie * :</label>
	    <div class="col-sm-10">
	      <select class="form-control" name="categorie" onblur="verifcategorie(this)">
	      <option value="--choix--" name="categorie">--Choix--</option>
	      <?php
	      foreach ($req_filtre as $post)
	      {
	      echo '<option value="'.$post->nom_famille.'" name="categorie">'.$post->nom_famille.'</option>';
	      }
	      ?>	      
	      </select>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Mots-clefs * :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="motcle" class = "form-control" placeholder="ex : motclé1, motclé2..." onblur="verifmotcle(this)"/>
	      <p class="help-block">Veuillez à séparer les mots-clefs par des virgules</p>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Source * :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="source" class = "form-control" placeholder="http://www.sitesource.com"  onblur="verifsource(this)"/>
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

      <div id="video" class="tab-pane fade">
      <h1>Tutoriel Video</h1><br />

      <form id="form2" class="form-horizontal" role="form" action="" method="POST">
      <div class="form-group">
	    <label class="control-label col-sm-2" for ="">Titre * :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="titre" class = "form-control" placeholder="Ex : Fauteuil de jardin en palette" maxlength="255" onblur="verifTitre(this)" id="coco"/>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Déchet/matière première * : </label>
	    <div class="col-sm-10">
	      <input type="text" name ="dechet" id="searchvideo" class = "form-control" placeholder="Ex : Palettes" onblur="verifDechet(this)"/>
	      <input type="hidden" name = "cat" id="searchvideo-cat">
	    </div>
	</div>	
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Lien video * :</label>
	    <div class="col-sm-10">
		<input type="text" name ="video1" class = "form-control" placeholder="Ex : https://youtu.be/PdaAHMztNVE"  onblur="verifLienVideo(this); verifvideo(this);"/>
		<p class="help-block">Liens Youtube, dailymotion ou Vimeo uniquement</p><div id="verifvideoid1"></div>
	    </div>
	    
	</div>	

	<div class="form-group">
	  <label class="control-label col-sm-2" for =""><br />Difficulté * :</label> 
	    <div class="col-sm-10 ">
	      <div id="vote2">
		<div class="rating" >
		  <span id="5s2" class="x">&starf;</span><span id="4s2" class="x">&starf;</span><span id="3s2" class="x">&starf;</span><span id="2s2" class="x">&starf;</span><span id="1s2" class="x">&starf;</span><input type="hidden" name="difficulte2" value="0" onblur="verifdifficulte2(this)" id="difficulte2"/>
		</div>
	      </div>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Commentaires additionnels :</label>
	    <div class="col-sm-10">
	      <textarea class="textarea form-control" rows="3" class = "form-control" name="comadd" placeholder="Ex : Ce tutoriel permet de revaloriser..."/></textarea>
	    </div>
	</div>	
	<br /><x1>Complément : </x1><br /><br />
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Catégorie :</label>
	    <div class="col-sm-10">
	      <select class="form-control" name="categorie" onblur="verifcategorie(this)">
	    <?php
	    $list=$pdo->query("SELECT * from famille_contrib");
	    foreach($list as $option)
	    {
	    ?>
		<option value="<?php echo $option->nom_famille;?>" name="categorie"><?php echo $option->nom_famille;?></option>
	    <?php
	    }
	    ?>
	      </select>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Mots-clefs :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="motcle" class = "form-control" placeholder="ex : motclé1, motclé2..." onblur="verifmotcle(this)"/>
	      <p class="help-block">Veuillez à séparer les mots-clefs par des virgules</p>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Source :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="source" class = "form-control" placeholder="http://www.sitesource.com"  onblur="verifsource(this)"/>
	      <p class="help-block">Le site ou se trouve initialement ce tutoriel, ou votre site personnel.</p>
	    </div>
	</div>
	<div class="form-group">
	<div id="erreur2" class="col-sm-offset-2 col-sm-10"></div>
	</div>

	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10">
	    <button type="submit" class="btn btn-primary" name="ajouter2" onclick='return verifForm2(this.form)'>Publier ce tuto !</button>
	    <button type="submit" class="btn btn-default" name="brouillon2">Continuer plus tard</button>
	  
	  </div>
	</div>
	
      </form>

      
      </div>
</div>

  </div>
</section>
<?php 
}

require 'inc/pieddepage_inc_new.php'; ?>