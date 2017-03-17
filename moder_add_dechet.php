<?php

require 'inc/functions.php'; 
logged_only('moder_add_dechet.php');

if($_SESSION['auth']->status!=='moderateur')
{
header('index.php');
}
require 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");
$id=$_GET['id'];
$req=$pdo->query("SELECT * FROM contribution WHERE id = $id");

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>UPCIRCUS.fr </title>
<!-- Bootstrap -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Fin bootstrap -->
<!-- CSS -->
  <link rel="stylesheet" href="app.css">
  <link rel="stylesheet" href="css/style.css">
<!-- Fin CSS -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 	
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="js/script-autocomplete_ajouter-xx.js"></script> 

<script>
function test(){
  var div = document.getElementById("autres")
  var div2 = document.getElementById("selection")
  if(document.getElementById("cpcp").value=="autre")
  {
    div.style.display = "block";
    div2.style.display = "none";
  }
  else if(document.getElementById("cpcp").value=="choix")
  {
  }
  else
  {
    div2.style.display = "block";
    div.style.display = "none";
    var x = document.getElementById("cpcp").value;
    document.getElementById("hiddenname").value = x;
  }
};
</script>
<script type="text/javascript">
    function closeFunction(){
    parent.$.fancybox.close();
    }
    </script>

  </head>
  <body>
  
  <div class="container text-center">
  <?php   
  if(isset($_POST['ajouter_asso']))
  {
      $req1=$pdo->query("SELECT * FROM dechets WHERE id = ".$_POST['hiddenname']);
      $res_dech=$req1->fetch();
      $req2=$pdo->query("UPDATE contribution SET dechet = '".$res_dech->nom_dechets."', cat_associe='".$res_dech->dechetassocie."' WHERE id=".$id);

  }
  elseif(isset($_POST['ajouter_manual']) && !empty($_POST['dechet']) && !empty($_POST['cat']))
  {
      $req1=$pdo->prepare("SELECT * FROM dechets WHERE nom_dechets = ? AND dechetassocie = ?");
      $req1->execute([$_POST['dechet'],$_POST['cat']]);
      $res_dech=$req1->fetch();
      $id_dech=$res_dech->id;
      $new_recherche_associe=$res_dech->recherche_associee.', '.$_POST['dechet_entre'];
      $req2=$pdo->prepare("UPDATE dechets SET recherche_associee = ? WHERE id = ?");
      $req2->execute([$new_recherche_associe, $id_dech]);
      $req3=$pdo->prepare("UPDATE contribution SET dechet = ? , cat_associe = ? WHERE id= ? ");
      $req3->execute([$_POST['dechet'], $_POST['cat'], $id]);
  }
  elseif(isset($_POST['ajouter_newentry']) && !empty($_POST['nouvelle_entree']) && !empty($_POST['chosen_cat']))
  {
  $req1=$pdo->prepare("INSERT INTO dechets VALUES (?,?,?,?,?,?)");
  $req1->execute(['','',$_POST['chosen_cat'],$_POST['nouvelle_entree'],$_POST['recherche_associe'],'photo.png']);
  $req2=$pdo->prepare('UPDATE contribution SET dechet = ?, cat_associe= ? where id= ? ');
  $req2->execute([$_POST['nouvelle_entree'], $_POST['chosen_cat'], $id]);
  }
  
  ?>
  <div>
  <form id="form" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
  <?php
  foreach($req as $donnee)
  {
    $req_rech = $pdo->prepare("SELECT * FROM dechets WHERE MATCH(nom_dechets, dechetassocie, recherche_associee) AGAINST ('".$donnee->dechet."' IN BOOLEAN MODE)");
    $req_rech->execute();

  ?>
    <h3><input type="hidden" name="dechet_entre" value="<?php echo $donnee->dechet; ?>"><?php 
    echo $donnee->dechet; 
    ?></h3>
    Le déchet <strong><?php echo $donnee->dechet;?></strong> a été ajouté pour la contribution <?php echo $id;?>. <br />
    <img src="img/img_princ/<?php echo $donnee->img_princ;?>" style="max-width:500px; max-height:500px;"><br />
    <br />Résultats de recherche pour ce déchet dans la base de donnée : <br />

    
    <select class = "form-control" name="select_waste" id="cpcp" onchange="test();">
    <option value="choix">--Choix--</option>
    
    <?php
    foreach($req_rech as $dechets)
    {
    ?>
      <option value="<?php echo $dechets->id; ?>"><?php echo $dechets->nom_dechets.'('.$dechets->dechetassocie.')';?></option>
      
    <?php
    }
  }
  ?>
      <option value="autre">Autre</option>
      </select>
      
      <input type="hidden" id="hiddenname" name="hiddenname">
	<div id="autres" style="display:none;">
	  <br />
	  <strong>Recherche manuelle : </strong><br />
	  <input type="text" name ="dechet" id="search_second" class = "form-control" placeholder="Ex : Palettes"/>
	  <input type="hidden" name = "cat" id="search_second-cat"/><input type="submit" class="btn btn-primary" value="Ajouter déchet" name="ajouter_manual" onClick ="closeFunction();"><br /><br />
	  <strong>OU</strong>
	  <br />
	  <br />
	  <strong>Nouvelle entrée : </strong>
	  <br />
	  <input type="text" name="nouvelle_entree" id="nouvelle_entree" class="form-control" placeholder="nouvelle entrée" />
	  <select class = "form-control" name="chosen_cat">
	    <?php
	    $list=$pdo->query("SELECT * FROM categorie");
	    foreach($list as $option)
	    {
	      echo '<option value="'.$option->categorie.'">'.$option->categorie.'</option>';
	    }
	    ?>
	  </select>
	  
	  <input type="text" name="recherche_associe" id="recherche_associe" class="form-control" placeholder="recherche associées" />
	  <input type="submit" class="btn btn-primary" value="Ajouter déchet" name="ajouter_newentry" onClick ="closeFunction();">
	</div>
	
	<div id="selection" style="display:none;">
	  Ajouter <?php echo $donnee->dechet;?> comme associé au déchet sélectionné 
	  <input type="submit" class="btn btn-primary" value="Ajouter" name="ajouter_asso" onClick ="closeFunction();">
	  </form>
	</div>
	</div>
	  </form>
    </div>
    

  </body>
</html>