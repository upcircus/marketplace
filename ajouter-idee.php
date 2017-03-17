<?php
require 'inc/functions.php'; 
logged_only('ajouter-idee.php');
require 'inc/header_inc_new.php';
require 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");
$req_filtre=$pdo->query("SELECT * FROM famille_contrib");
?>

<script src="js/script-autocomplete_ajouter-xx.js"></script> 
<script src="js/ajouter-idee_verif-form.js"></script>
<script src="js/add_del_etape_idee.js"></script>
<script>
function alert_size() {
	var file = $("#img_princ1")[0];
	var size = file.files[0].size;
	var name = file.files[0].name;
	var extension = name.slice((Math.max(0, name.lastIndexOf(".")) || Infinity) + 1);
	
	if(size>1048576)
	{
	  document.getElementById("alertimg").innerHTML = '<div class="alert alert-danger">Votre fichier : ' + name + ' est trop volumineux (' + Math.round(size/1024, -1)+'Ko). Pour pouvoir valider le formulaire il doit être inférieur à 1024Ko. </div>';
	  return false;
	}
	else if(extension != 'JPG' && extension != 'jpg' && extension != 'gif' && extension != 'GIF' && extension != 'jpeg' && extension != 'JPEG' && extension != 'png' && extension != 'PNG')
	{
	  document.getElementById("alertimg").innerHTML = '<div class="alert alert-danger">Votre fichier : <strong>' + name + '</strong> n\'est pas considéré comme une image (extension : '+extension+'). Les extensions acceptées sont "jpg", "png" ou "gif". </div>';
	  return false;
	}
	else if(size<1048576)
	{
	  document.getElementById("alertimg").innerHTML = '<div class="alert alert-success">Votre fichier : ' + name + ' est conforme.</div>';
	  return true;
	}
};

</script>
<?php


if(isset($_POST['ajouter']))
{


$nb_step=count($_POST['nb_step']);
if(isset($_POST["ajouter"]) && (empty($_POST["dechet"]) || empty($_FILES["img_princ".$nb_step])))
    {
      ?>
       <div class="col-sm-12 alert alert-danger">Tous les champs marqué d'une étoile * ne sont pas remplis. Merci de les remplir correctement pour soumettre le formulaire.</div>
       <?php
    }
  else
    {
      require_once 'inc/db.php';

      for($i=1;$i<=$nb_step;$i++)
      {
	if(empty($_POST['titre'.$i]))
	{
	  $titre="";
	}
	else
	{
	$titre=$_POST['titre'.$i];
	}
	if(empty($_POST['source'.$i]))
	{
	  $source="0";
	}
	else
	{
	  $source=$_POST["source".$i];
	}
	
	if($_POST["cat"]!=="")
	{
	  $cat_associe=$_POST["cat"];
	}
	else
	{
	  $cat_associe="nouveau";
	}
	
//       $extension_img_princ[$i] = substr(strrchr($_FILES['img_princ'.$i]['name'],'.'),1);
//       $nom_img_princ[$i] = md5(uniqid(rand(), true)).'.'.$extension_img_princ[$i];
//       $upload_img_princ[$i] = upload('img_princ'.$i,'img/'.'img_princ'.'/'.$nom_img_princ[$i],1048000, array('png','gif','jpg','jpeg','PNG','GIF','JPG','JPEG') );
//       
      $nom_img_princ[$i] = upsize(1200,'img/img_princ/','img_princ'.$i,$i);
      
      

      
      
      $req = $pdo->prepare("INSERT INTO contribution SET id = ?, titre = ?, type = ?, dechet = ?, cat_associe = ?, img_princ = ?, categorie = ?, source = ?, contributeur = ?, nb_note = ?, nb_coupcoeur = ?, note = ?, date = ?, publication = ?, valide = ?, nb_etapes = ?, avendre = ?, prodassid = ?");


      $req->execute(['',$titre, 'idee', $_POST['dechet'], $cat_associe, $nom_img_princ[$i], $_POST['categorie'.$i],$source,$_SESSION['auth']->username,'0','0','0',date("y-m-d"),'publier','non', '1', '', '']);
      
      $lastId = $pdo->lastInsertId();
      
      
        if(isset($_GET['prodass']) && $_GET['prodass']!=="notyet")
	{
	  $idprodass=$_GET['prodass'];
	  $req=$pdo->prepare("SELECT * FROM produits_associes where id = ?");
	  $req->execute([$idprodass]);
	  foreach ($req as $col):
	  endforeach; 
	  $listproduits=explode(";",$col->produits);
	  $listproduits[]=$lastId;
	  $stringprod=implode(";",$listproduits);
	  $req2=$pdo->prepare("UPDATE contribution SET prodassid = ? WHERE id = ?");
	  $req2->execute([$idprodass,$lastId]);
	  $req3=$pdo->prepare("UPDATE produits_associes SET produits = ? WHERE id = ?");
	  $req3->execute([$stringprod,$idprodass]);

	}
	elseif(isset($_GET['prodass']) && $_GET['prodass']=="notyet")
	{
	  $idcontrib=$_GET['produit'];
	  $newidcontrib=$lastId;
	  $stringidcontrib=$idcontrib.";".$newidcontrib;
	  $req=$pdo->prepare("INSERT INTO produits_associes SET id= ?, produits = ?");
	  $req->execute(['', $stringidcontrib]);
	  $lastidprodass=$pdo->lastInsertId();
	  $req2=$pdo->prepare("UPDATE contribution SET prodassid = ? WHERE id = ?");
	  $req2->execute([$lastidprodass,$newidcontrib]);
	  $req3=$pdo->prepare("UPDATE contribution SET prodassid = ? WHERE id = ?");
	  $req3->execute([$lastidprodass,$idcontrib]);
	}
      }
    
      echo('
	    <section>    
	      <div class="pagesimple_container text-center">
		<h1>Ajoutez vos idées de revalorisation !</h1>
		<br class="text-center" /><br />
		Merci pour votre contribution. Celle-ci va être analysée par notre équipe de modération afin de la valider. Vous pouvez retrouver vos contributions via votre <a href="account.php">tableau de bord</a>. <br /><br /><br /><br />
		D\'autres contributions à apporter ? <a href="ajouter-idee.php">Ajouter d\'autres idées !</a> - <a href="ajouter-tutoriel.php">Ajouter un tutoriel !</a><br /><br /><br /><br />
	      </div>
	    </section>
	    ');
    }
    }
    else
    {
    ?>
    
<section>    
  <div class="container">

<h2 class="text-center">Ajoutez un produit issus de la revalorisation !</h2>

<div class="col-lg-offset-1 col-lg-10 "><h5 class="text-center grey-font-popup text-justify">Partagez vos produits avec le public, obtenez de la visibilité pour votre profil, montrer que le changement est possible, et faites partie des premiers contributeurs à être présent sur la future plateforme de vente ! </h5><p class="text-justify"><strong>ASTUCE ! </strong>Vous pouvez ajoutez plusieurs produits créés à partir du même déchet/matière première en cliquant "Ajouter un autre produit pour ce déchet".</p></div>
<div class="col-lg-12 text-center"><img src="img/ico/magicwand.png" height="60px"></div>
<div class="col-lg-12">
    <form id="form" id="toto" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
    <x1>Produit 1 :</x1><br />
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Déchet/matière première * : </label>
	    <div class="col-sm-10">
	      <input type="text" name ="dechet" id="search_second" class = "form-control" placeholder="Ex : Palettes" onblur="verifDechet(this)" />
	      <input type="hidden" name = "cat" id="search_second-cat">
	    </div>
	</div>	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Nom du produit :</label>
	    <div class="col-sm-10">
	    <input type="hidden" name="nb_step[1]"/>
	      <input type="text" name ="titre1" class = "form-control" placeholder="Ex : Fauteuil de jardin en palette" maxlength="255"/>
	    </div>
	</div>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo * :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="file" id="InputFile" name="img_princ1" id="img_princ1" accept="image/*" onblur="verifimgPrinc(this)">
		<p class="help-block">La taille de l'image doit être inférieure à 1Mo</p>
	    </div>
	</div>	
	<span id="alertimg"></span>	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Catégorie :</label>
	    <div class="col-sm-3">
	      <select class="form-control" name="categorie1">
	      <option value="--choix--" name="categorie1">--Choix--</option>
	    <?php
	    foreach ($req_filtre as $post)
	    {
	    echo '<option value="'.$post->nom_famille.'" name="categorie1">'.$post->nom_famille.'</option>';
	    }
	    ?>
	      </select>
	    </div>
	    <label class="control-label col-sm-2" for ="">Source :</label>
	    <div class="col-sm-5">
	      <input type="text" name ="source1" class = "form-control" placeholder="http://www.sitesource.com"/>
	      <p class="help-block">Le site ou se trouve initialement ce tutoriel, ou votre site personnel.</p>
	    </div>
	    <label class="control-label col-lg-12 align-left"><input type="checkbox"> En cochant cette case, vous souhaitez mettre en vente ce produit au lancement de la plateforme de vente. <span class="fakelink hover" id="conditionmktplc">Voir conditions</label>
	  </div>  
	    
	<span id="newstep"></span>
	<span id="leschamps_1" class="col-sm-offset-2"><span id="addstep" class="btn btn-default btn-xs">Ajouter un autre produit<br /> pour ce déchet</span> <span id="delstep" class="btn btn-danger btn-xs">Supprimer <br />dernier produit</span></span>
	<div class="form-group">
	<div class="row"> </div>
	</div>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-2">
	    <button type="submit" id="submit" class="btn btn-primary" name="ajouter" onclick='return verifForm(this.form)'><strong>Publier !</strong></button>
	  </div>
	  <div id="erreur" class="col-sm-8"></div>
	</div>
    </form>
  </div>
</div>
</section>
<?php 
}
?>
  
<?php 
require 'inc/pieddepage_inc_new.php'; 
?>