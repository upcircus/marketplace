<?php
require 'inc/functions.php'; 
logged_only('infos_createurs.php');
require 'inc/header_inc_new.php';
require 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");

$email_user=$_SESSION['auth']->email;
$req = $pdo->prepare("SELECT * FROM infos_contributeur WHERE email = ?");
$req->execute([$email_user]);
foreach ($req as $data): 
endforeach;

if(isset($data))
{
  $user_id=$data->id_user;
  $email_user=$data->email;
  $nom_user=$data->nom;
  $photo_logo = $data->photo_logo;
  $photo_fond = $data->photo_fond;
}
else
{
  $email_user=null;
}

if($_SESSION['auth']->email != $email_user)
{
echo "Vous n'avez pas le droit d'accéder à cette page.";
}
else
{

?>
<script src="js/ajouter-idee_verif-form.js"></script>
<script src="js/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />

<?php
ini_set('display_errors',1);
if(isset($_POST['ajouter']))
{

  if(!empty($_FILES['img_profil']['name']) AND $_POST['hidden_photo_logo'] == "new")
  {
    $extension_img_profil = substr(strrchr($_FILES['img_profil']['name'],'.'),1);
    if($_FILES["img_profil"]["size"] > 0)
    {
      $size_profil = $_FILES['img_profil']['size'];
    }
    else
    {
      $size_profil = 2000000;
    }
    if($extension_img_profil != 'jpg' AND $extension_img_profil != 'JPG' AND $extension_img_profil != 'gif' AND $extension_img_profil != 'GIF' AND $extension_img_profil != 'jpeg' AND $extension_img_profil != 'JPEG' AND $extension_img_profil != 'png' AND $extension_img_profil != 'PNG' OR $size_profil > 512000)
    {
      $nom_img_profil="[//VIDE]";  
    }
    else
    {
      $nom_img_profil = md5(uniqid(rand(), true)).'.'.$extension_img_profil;
      $upload_img_profil = upload('img_profil','img/'.'img_profil'.'/'.$nom_img_profil,512000, array('png','gif','jpg','jpeg','PNG','GIF','JPG','JPEG') );  
    }
  }
  elseif(empty($_FILES['img_profil']['name']) AND $_POST['hidden_photo_logo'] == "new")
  {
    $nom_img_profil="[//VIDE]";  
  }
  elseif($_POST['hidden_photo_logo'] == "old")
  {
    $nom_img_profil=$photo_logo;
  }
  else
  {
      $nom_img_profil="[//VIDE]";  
  }
    
  if(!empty($_FILES['img_fond']['name']) AND $_POST['hidden_photo_fond'] == "new")
  {
    $extension_img_fond = substr(strrchr($_FILES['img_fond']['name'],'.'),1);
//     if($_FILES["img_fond"]["size"] > 0)
//     {
//       $size_fond = $_FILES['img_fond']['size'];
//     }
//     else
//     {
//       $size_fond = 2000000;
//     }
    if($extension_img_fond != 'jpg' AND $extension_img_fond != 'JPG' AND $extension_img_fond != 'gif' AND $extension_img_fond != 'GIF' AND $extension_img_fond != 'jpeg' AND $extension_img_fond != 'JPEG' AND $extension_img_fond != 'png' AND $extension_img_fond != 'PNG')
    {
      $nom_img_fond="[//VIDE]";  
    }
    else
    {
//      $toto=upsize(1200,'img/img_fond/','img_fond');
//       $nom_img_fond=$toto[0];
//       $titi=$toto[1];
//       
//       echo "coucou";
//       echo ' titi : '.$titi;
//       echo 'nom_img_fond : '.$nom_img_fond;
//       echo 'nom field : '.$_FILES['img_fond']['name'];
       $nom_img_fond = md5(uniqid(rand(), true)).'.'.$extension_img_fond;
       $upload_img_fond = upload('img_fond','img/'.'img_fond'.'/'.$nom_img_fond,10000000, array('png','gif','jpg','jpeg','PNG','GIF','JPG','JPEG') );  
    }
  }
  elseif(empty($_FILES['img_fond']['name']) AND $_POST['hidden_photo_fond'] == "new")
  {
    $nom_img_fond="[//VIDE]";  
  }
  elseif($_POST['hidden_photo_fond'] == "old")
  {
    $nom_img_fond=$photo_fond;
  }
  else
  {
    $nom_img_fond="[//VIDE]";  
  }

  $photo_logo = $nom_img_profil;
  $photo_fond = $nom_img_fond;
  $url = htmlentities($_POST['url']);
  $facebook = htmlentities($_POST['facebook']);
  $adresse = htmlentities($_POST['adresse']);
  $cp = htmlentities($_POST['cp']);
  $ville = htmlentities($_POST['ville']);
  $boutique = htmlentities($_POST['boutique']);
  $paragraphe_info = htmlentities($_POST['paragraphe']);
  $activation = htmlentities($_POST['affichage']);

  if($activation == "oui")
  {
    $filename='.htaccess';
    $aFileContent = file('.htaccess');//lit le fichier et met les lignes dans un tableau
    if(in_array('RewriteRule ^'.$nom_user.'$ createur.php?id='.$user_id.' [L,NC]',$aFileContent)==0)
    {
      $iFileLines = count($aFileContent);// nb ligne total
      $aNewFileContent = array_merge(
      array_slice($aFileContent, 0),
      array("\n"),
      array('RewriteRule ^'.$nom_user.'$ createur.php?id='.$user_id.' [L,NC]'));
      implode(PHP_EOL, $aNewFileContent);
      file_put_contents($filename,$aNewFileContent);
    }
  }
  elseif($activation == "non")
  {
    
    $filename='.htaccess';
    $aFileContent = file('.htaccess');//lit le fichier et met les lignes dans un tableau
    if(in_array('RewriteRule ^'.$nom_user.'$ createur.php?id='.$user_id.' [L,NC]',$aFileContent)||in_array('RewriteRule ^'.$nom_user.'$ createur.php?id='.$user_id.' [L,NC]'."\n",$aFileContent))
    {
      $key=array_search('RewriteRule ^'.$nom_user.'$ createur.php?id='.$user_id.' [L,NC]',$aFileContent);
      if ($key==false)
      {
	$key=array_search('RewriteRule ^'.$nom_user.'$ createur.php?id='.$user_id.' [L,NC]'."\n",$aFileContent);
      }
      $iFileLines = count($aFileContent);// nb ligne total
      $aNewFileContent = array_merge(
      array_slice($aFileContent, 0, $key),
      array_slice($aFileContent, $key+1));
      implode(PHP_EOL, $aNewFileContent);
      file_put_contents($filename,$aNewFileContent);
    }
  }
  
  $req=$pdo->prepare("UPDATE infos_contributeur SET photo_logo = ?, photo_fond = ?, url = ?, facebook = ?, adresse = ?, cp = ?, ville = ?, boutique = ?, paragraphe_info = ?, activation = ? WHERE id_user = ?");
  $req->execute([$photo_logo,$photo_fond, $url, $facebook, $adresse, $cp, $ville, $boutique, $paragraphe_info, $activation, $user_id]);
  $validation = "Votre profil a été mis à jour avec succès.";
  
  $req = $pdo->prepare("SELECT * FROM infos_contributeur WHERE id_user = ?");
  $req->execute([$user_id]);
}
else
{
  $validation="";
}

foreach ($req as $data): 
endforeach;

$user_id=$data->id_user;
$email_user=$data->email;
$nom_user=$data->nom;
$photo_logo_form = $data->photo_logo;
$photo_fond_form = $data->photo_fond;
$url_form = $data->url;
$facebook_form = $data->facebook;
$adresse_form = $data->adresse;
$cp_form = $data->cp;
$ville_form = $data->ville;
$boutique_form = $data->boutique;
$paragraphe_info_form = $data->paragraphe_info;
$activation_form = $data->activation;

if(isset($_POST['crop']))
{
	$targ_w = $targ_h = 150;
	$jpeg_quality = 90;
	$png_quality = 1;
	
	
	$src = "img/img_profil/".$photo_logo_form;
	$extension = new SplFileInfo($src);
	$fileext = $extension->getextension();
	if($fileext=="gif" OR  $fileext=="GIF")
	{
	  $img_r = imagecreatefromgif($src);
	}
	elseif($fileext=="jpg" OR  $fileext=="JPG" OR $fileext=="jpeg" or $fileext=="JPEG")
	{
	  $img_r = imagecreatefromjpeg($src);
	}
	elseif($fileext=="png" OR  $fileext=="PNG")
	{
	   $img_r = imagecreatefrompng($src);
	}
	
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
	

	$nom_img_profil = md5(uniqid(rand(), true)).'.'.$fileext;
	$upload_img_profil = upload('img/'.'img_profil'.'/'.$nom_img_profil,5120000, array('png','gif','jpg','jpeg','PNG','GIF','JPG','JPEG')); 
	
	if($fileext="gif" OR  "GIF")
	{
	  imagegif($dst_r,"img/img_profil/".$nom_img_profil);
	}
	elseif($fileext="jpg" OR  "JPG" OR "jpeg" or "JPEG")
	{
	  imagejpeg($dst_r,"img/img_profil/".$nom_img_profil,$jpeg_quality);
	}
	elseif($fileext="png" OR  "PNG")
	{
	   imagejpeg($dst_r,"img/img_profil/".$nom_img_profil,$png_quality);
	}

	$req=$pdo->prepare("UPDATE infos_contributeur SET photo_logo = ? WHERE id_user = ?");
	$req->execute([$nom_img_profil,$user_id]);
	unlink("img/img_profil/".$photo_logo_form);
	$photo_logo_form=$nom_img_profil;
}

?>


<script>

function remove_img_fond(){
	$.post("remove_img_fond.php",
	{
	  id_user:<?php echo $user_id;?>
	}),
	$("#photo_fond").html('<input type="hidden" value="new" name="hidden_photo_fond"/><input type="file" id="img_fond" name="img_fond" accept="image/*" onchange=alert_size()><p class="help-block">La taille de l\'image doit être inférieure à 1Mo</p>');
    };  
    
    
function remove_img_profil(){
    $.post("remove_img_logo.php",
    {
      id_user:<?php echo $user_id;?>
    }),
    $("#photo_profil").html('<input type="hidden" value="new" name="hidden_photo_logo"/><input type="file" id="img_profil" name="img_profil" accept="image/*" onchange=alert_size_profil()><p class="help-block">La taille de l\'image doit être inférieure à 1Mo</p>');
};

function alert_size() {
	var file = $("#img_fond")[0];
	var size = file.files[0].size;
	var name = file.files[0].name;
	var extension = name.slice((Math.max(0, name.lastIndexOf(".")) || Infinity) + 1);
	
	if(extension != 'JPG' && extension != 'jpg' && extension != 'gif' && extension != 'GIF' && extension != 'jpeg' && extension != 'JPEG' && extension != 'png' && extension != 'PNG')
	{
	  document.getElementById("alertfond").innerHTML = '<div class="alert alert-danger">Votre fichier : <strong>' + name + '</strong> n\'est pas considéré comme une image (extension : '+extension+'). Les extensions acceptées sont "jpg", "png" ou "gif". </div>';
	  return false;
	}
	else
	{
	  document.getElementById("alertfond").innerHTML = '<div class="alert alert-success">Votre fichier : ' + name + ' est conforme.</div>';
	  return true;
	}
};

function alert_size_profil() {
	var file = $("#img_profil")[0];
	var size = file.files[0].size;
	var name = file.files[0].name;
	var extension = name.slice((Math.max(0, name.lastIndexOf(".")) || Infinity) + 1);
	
	if(extension != 'JPG' && extension != 'jpg' && extension != 'gif' && extension != 'GIF' && extension != 'jpeg' && extension != 'JPEG' && extension != 'png' && extension != 'PNG')
	{
	  document.getElementById("alertprofil").innerHTML = '<div class="alert alert-danger">Votre fichier : <strong>' + name + '</strong> n\'est pas considéré comme une image (extension : '+extension+'). Les extensions acceptées sont "jpg", "png" ou "gif". </div>';
	  return false;
	}
	else
	{
	  document.getElementById("alertprofil").innerHTML = '<div class="alert alert-success">Votre fichier : ' + name + ' est conforme.</div>';
	  return true;
	}
};




function recoupe() {
var profil = $("#path_profil").val();

  document.getElementById("photo_profil").innerHTML = '<img src="'+profil+'" style="max-height:300px;" id="cropbox"/>';
};

function charge_distance() {

$("#photo_profil").load("cropping.php", {
    profil : $("#path_profil").val()
});
};

</script>
<?php
  if($photo_logo_form!="[//VIDE]")
  {
    $info_img=getimagesize('img/img_profil/'.$photo_logo_form);
    $larg_img=$info_img[0];
    $long_img=$info_img[1];
  }
  ?>
<style type="text/css">
  #target {
    background-color: #ccc;
    width: 1200px;
    height: 1800px;
    font-size: 24px;
    display: block;
  }


</style>
<section>    
<div class="container">
<h2 class="text-center">Modifiez votre profil !</h2>
<h5 class="text-center">Ces informations seront disponible sur votre page de contributeur à disposition du public à l'adresse suivante : <a href="http://www.upcircus.fr/<?php echo $_SESSION['auth']->username; ?>">http://www.upcircus.fr/<?php echo $_SESSION['auth']->username; ?></a> </h5><br /><br />

    <?php 
     if ($validation!="")
     { 
	echo('<div class="alert alert-success fade in">'.$validation.'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
     }
    ?>
    <br />
    <form id="form" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Activation de votre profil Créateur : </label>
	     <div class="col-sm-3">
	      <select class="form-control" name="affichage">
		<option value="oui" name="affichage" <?php if($activation_form=="oui"){echo "selected";} ?>>Activé</option>
		<option value="non" name="affichage" <?php if($activation_form=="non" OR $activation_form==""){echo "selected";} ?>>Désactivé</option>
	      </select>
	</div>
	</div>
	    
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Votre email : </label>
	    <div class="col-sm-10">
	      <?php echo $email_user; ?>
	    </div>
	</div>	
	<h3> Apparence de votre page </h3>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo de profil :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<div id="photo_profil">
		  <?php 
		  if($photo_logo_form!="[//VIDE]")
		  {
		    ?>
		    <img src='img/img_profil/<?php echo $photo_logo_form; ?>' height="150px">
		    <input type="hidden" value="old" name="hidden_photo_logo">
		    <?php
		      $info_img=getimagesize('img/img_profil/'.$photo_logo_form);
		      $larg_img=$info_img[0];
		      $long_img=$info_img[1];
		    if($larg_img!=$long_img)
		    {
		      ?>
		      <div class="alert alert-danger">Votre photo nécessite d'être recoupée pour que l'affichage soit optimal. <span class="btn btn-danger btn-xs" onclick="charge_distance()">Recouper</span><input type="hidden" id="path_profil" name="path_profil" value="img/img_profil/<?php echo $photo_logo_form; ?>"></div>
		      <?php
		    }
		    ?>
		    <br />
		    <span class="btn btn-danger btn-xs" id="chg_img_profil_btn" onclick="remove_img_profil()">Supprimer la photo</span>		
		    <?php 
		  }
		  
		  else
		  {
		    ?>
		    <input type="file" id="img_profil" name="img_profil" accept="image/*" onchange="alert_size_profil()">
		    <input type="hidden" value="new" name="hidden_photo_logo">
		    <p class="help-block">La taille de l'image doit être inférieure à 500Ko</p>
		    <?php 
		  } 
		  ?>
		</div>
		<div id="alertprofil"></div>
	    </div>
	</div>	
		
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Photo de fond :</label>
	    <div class="col-sm-10">
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<div id="photo_fond">
		<?php 
		  if($photo_fond_form!="[//VIDE]"){
		?>
		  <img src='img/img_fond/<?php echo $photo_fond_form; ?>' height="150px">
		  <input type="hidden" value="old" name="hidden_photo_fond">
		<br />
		<span class="btn btn-danger btn-xs" id="chg_img_fond_btn" onclick="remove_img_fond()">Supprimer la photo</span>
	
		
		<?php 
		}
		else
		{
		  ?>
		  <input type="file" id="img_fond" name="img_fond" accept="image/*" onchange="alert_size()">
		  <input type="hidden" value="new" name="hidden_photo_fond">
		  <p class="help-block">La taille de l'image doit être inférieure à 1Mo et idéalement sa dimension doit être au moins de 200px x 1920px</p>
		  <?php 
		} 
		?>
		</div>
	      <div id="alertfond"></div>
	    </div>
	</div>	
	
	<h3>Votre présence sur internet : </h3>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Site internet : </label>
	    <div class="col-sm-10">
	      <input type="text" name ="url" class = "form-control" placeholder="Ex : www.monsite.com" value="<?php if($url_form!=""){echo $url_form;} ?>"/>
	    </div>
	</div>	
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Boutique en ligne : </label>
	    <div class="col-sm-10">
	      <input type="text" name ="boutique" class = "form-control" placeholder="Ex : www.monsite.com/boutique"  value="<?php if($boutique_form!=""){echo $boutique_form;} ?>"/>
	    </div>
	</div>	
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Facebook :</label>
	    <div class="col-sm-10">
	      <input type="text" name ="facebook" class = "form-control" placeholder="Ex : www.facebook.com/monnom" value="<?php if($facebook_form!=""){echo $facebook_form;} ?>"/>
	    </div>
	</div>
	<br />
	    <h3>Adresse de votre boutique ou de votre atelier :</h3>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Numéro et rue : </label>
	    <div class="col-sm-10">
	      <Textarea name ="adresse" class = "form-control" placeholder="12 avenue de toulouse"><?php if($adresse_form!=""){echo $adresse_form;} ?></textarea>
	    </div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Code postal :</label>
	    <div class="col-sm-4">
	      <input type="text" name ="cp" class = "form-control" placeholder="Ex : 31000" value="<?php if($cp_form!=""){echo $cp_form;} ?>"/>
	    </div>
	    <label class="control-label col-sm-1" for ="">Ville :</label>
	    <div class="col-sm-5">
	      <input type="text" name ="ville" class = "form-control" placeholder="Ex : Toulouse" value="<?php if($ville_form!=""){echo $ville_form;} ?>"/>
	    </div>
	</div>
	<br /><br />
	<h3>Pour en savoir plus sur vous...</h3>
	<div class="form-group">
	    <label class="control-label col-sm-2" for ="">Paragraphe de présentation :</label>
	    <div class="col-sm-10">
	      <textarea name ="paragraphe" class = "form-control" placeholder="Vos passions, pourquoi vous créez, qu'est ce qu'il vous plait dans la revalorisation... " rows="6"><?php if($paragraphe_info_form!=""){echo $paragraphe_info_form;} ?></textarea>
	    </div>
	</div>
	

	    
	<div class="row"><br /></div>    
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-2">
	    <button type="submit" id="submit" class="btn btn-primary" name="ajouter" onclick='return verif()'>Valider</button>
	  </div>
	  <div id="erreur" class="col-sm-8"></div>
	</div>
    </form>
  </div>
</section>
<?php
}//fin du else si session != user id
?>
  
<?php 
require 'inc/pieddepage_inc_new.php'; 
?>