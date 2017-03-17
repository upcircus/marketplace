<?php
require 'inc/functions.php'; 
logged_only("moder_ajout_membre.php");
require 'inc/header_inc_new.php';
?> 

<?php
if(isset($_POST['soumettre']))
{


  if(!empty($_FILES['logo']['name']))
  {
    require_once 'inc/functions.php';
    $extension_logo = substr(strrchr($_FILES['logo']['name'],'.'),1);
    
    $nom_logo = md5(uniqid(rand(), true)).'.'.$extension_logo;
    $upload_logo = upload('logo','img/'.'logo_membres'.'/'.$nom_logo,1048000, array('png','gif','jpg','jpeg') );  
  }


  $date=date('y-m-d');
  require_once 'inc/db.php';
  $req=$pdo->prepare('INSERT INTO reseau SET id = ?, nom_membre = ?, date_inscription = ?, motclefs = ?, contact = ?, url = ?, infos = ?, coupcoeur = ?, dechets = ?, vues = ?, adresse = ?, logo = ?, email_contact = ?, telephone_contact = ?');
  $req->execute(['', $_POST['nom'], $date, $_POST['motclefs'], $_POST['nom_contact'], $_POST['url'], $_POST['infos'], '0', $_POST['dechets'], '0', $_POST['adresse_postale'], $nom_logo, $_POST['email_contact'], $_POST['tel_contact']]);
  
  echo "<div class=\"col-sm-12 alert alert-success\">Le membre <strong>".htmlentities($_POST['nom'])."</strong> a été ajouté à la liste</div>";
}

?>


<section>
  <div class="container">
    <h2 class="text-center">Ajouter un membre au réseau Upcircus<br /><br /></h2>
    <form id="form" class="form-horizontal" role="form" action="<?php echo($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
      <div class="form-group">
	<label class="control-label col-sm-3" for ="">Nom du membre : </label>
	<div class="col-sm-9">
	  <input type="text" id="nom" name="nom" placeholder="Toto SA" class = "form-control">
	</div>
      </div>
      <div class="form-group">
	<label class="control-label col-sm-3" for ="">Logo du membre : </label>
	<div class="col-sm-9">
	<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
	  <input type="file" id="InputFile" name="logo" accept="image/*">
	</div>
      </div>
      <div class="form-group">
	<label class="control-label col-sm-3" for ="">Site internet : </label>
	<div class="col-sm-9">
	  <input type="text" id="url" name="url" placeholder="www.monadresse.com" class = "form-control">
	</div>
      </div>
      <div class="form-group">
	<label class="control-label col-sm-3" for ="">Adresse postale : </label>
	<div class="col-sm-9">
	  <textarea id="adresse_postale" name="adresse_postale" placeholder="12 rue du louvre 13000 Marseilles" class = "form-control"></textarea>
	</div>
      </div>
      <div class="form-group">
	<label class="control-label col-sm-3" for ="">Nom contact : </label>
	<div class="col-sm-9">
	  <input type="text" id="nom_contact" name="nom_contact" placeholder="Jean Dupont" class = "form-control">
	</div>
      </div>
      <div class="form-group">
	<label class="control-label col-sm-3" for ="">Email contact : </label>
	<div class="col-sm-9">
	  <input type="text" id="email_contact" name="email_contact" placeholder="contact@masociete.com" class = "form-control">
	</div>
      </div>
      <div class="form-group">
	<label class="control-label col-sm-3" for ="">Téléphone contact : </label>
	<div class="col-sm-9">
	  <input type="text" id="tel_contact" name="tel_contact" placeholder="0612345678" class = "form-control">
	</div>
      </div>
      <div class="form-group">
	<label class="control-label col-sm-3" for ="">Déchet(s) revalorisé(s) : </label>
	<div class="col-sm-9">
	  <input type="text" id="dechets" name="dechets" placeholder="bouchons de liège, pneus, jantes aluminium" class = "form-control">
	</div>
      </div>
      <div class="form-group">
	<label class="control-label col-sm-3" for ="">Mots-clefs associés: </label>
	<div class="col-sm-9">
	  <input type="text" id="motclefs" name="motclefs" placeholder="Bouteille, vêtements" class = "form-control">
	  <p class="help-block">Chaque mot clé doit etre séparé par une virgule</p>
	</div>
      </div>
      <div class="form-group">
	<label class="control-label col-sm-3" for ="">Information sur l'entreprise : </label>
	<div class="col-sm-9">
	  <textarea id="infos" name="infos" placeholder="Entreprise TotoSA est spécialisé dans..." class = "form-control"></textarea>
	</div>
      </div>
      <input type="submit" name="soumettre" id="soumettre" value="Ajouter" class="col-sm-offset-3 btn btn-primary">
    </form>
  </div>
</section>
<?php require 'inc/pieddepage_inc_new.php'; ?>