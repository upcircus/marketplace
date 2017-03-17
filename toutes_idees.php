<?php
require 'inc/functions.php'; 
logged_only('toutes_idees.php');
require 'inc/header_inc_new.php';

if(isset($_GET['tri']) && $_GET['tri']=="categorie")
{
  $tri="id";
}
elseif(isset($_GET['tri']) && $_GET['tri']=="notation")
{
  $tri="note";
}
elseif(isset($_GET['tri']) && $_GET['tri']=="coupcoeur")
{
  $tri="nb_coupcoeur";
}
elseif(isset($_GET['tri']) && $_GET['tri']=="complexite")
{
  $tri="difficulte";
}
else
{
  $tri="nb_coupcoeur";
}
require_once 'inc/db.php';
$req=$pdo->prepare("SELECT * FROM contribution WHERE type = ? ORDER BY ".$tri."");
$req->execute(['idee']);
?> 
<section>
  <div class="container">
    <div class="row">
      <label class="control-label col-sm-2" for ="">Trier par :</label>
      <div class="col-sm-3">
	<select class="form-control" name="tri">
	  <option value="categorie" name="tri" <?php if($tri=="categorie"){echo("selected=\"selected\"");}?>>Catégories</option>
	  <option value="notation" name="tri" <?php if($tri=="notation"){echo("selected=\"selected\"");}?>>Notations</option>
	  <option value="nb_coupcoeur" name="tri" <?php if($tri=="nb_coupcoeur"){echo("selected=\"selected\"");}?>>Coup de coeurs</option>
	  <option value="complexite" name="tri" <?php if($tri=="complexite"){echo("selected=\"selected\"");}?>>Complexités</option>
	</select>
      </div>
    </div>
    <div class="row">
    
    </div>
  </div>
</section>
<?php require 'inc/pieddepage_inc_new.php'; ?>