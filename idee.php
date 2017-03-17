<?php
require 'inc/header_inc_new.php';
require 'inc/functions.php';
if(isset($_SESSION['auth']))
{
  $email_session=$_SESSION['auth']->email;
}
?>


<!--SCRIPT AJAX FOLLOW PRODUCT-->
<script>
    $(document).ready(function()
    {
       $('#form_followproduct').on('submit', function(e) 
	{
	  $("#btn-followproduct").html("<img src='img/loader-small.gif'>");
	  e.preventDefault();
	  var $this = $(this);
	  var email_follow = $('#email_follow').val();	
	  
	    $.post("ext_followproduct.php", 
	    {
	      email_follow:email_follow, 
	      productid:<?php echo $_GET['id']; ?>
	    },
	    function(data,status)
	    {
	      if(status == "success")
	      $("#follow-area").html(data);
	    });
	});
      });
</script>
<!--FIN SCRIPT AJAX FOLLOW PRODUCT-->

<!--SCRIPT AJAX FOLLOW PRODUCT FOR REGISTERED USER-->
<script>
    $(document).ready(function()
    {
       $('#followregisterbtn').click(function(e) 
	{ 
	  $("#followregisterbtn").html("<img src='img/loader-small.gif'>");
	  var $this = $(this);
	  var email_follow = $('#emailuser').val();	
	  
	    $.post("ext_followproduct.php", 
	    {
	      email_follow:email_follow, 
	      productid:<?php echo $_GET['id']; ?>
	    },
	    function(data,status)
	    {
	      if(status == "success")
	      $("#follow-area").html(data);
	    });
	});
      });
</script>
<!--FIN SCRIPT AJAX FOLLOW PRODUCT FOR REGISTERED USER-->


<?php
  require_once 'inc/db.php';
  $pdo->query("SET NAMES 'utf8'");
  
  
  $req = $pdo->prepare("SELECT * FROM contribution WHERE id =?");
  $req->execute([$_GET['id']]);
  foreach ($req as $data):
  endforeach; 
  
  $prodassid=$data->prodassid;
  if(!empty($prodassid))
  {
    $prod = $pdo->prepare("SELECT * FROM produits_associes WHERE id =?");
    $prod->execute([$prodassid]);
    foreach ($prod as $produit_ids):
    endforeach; 
    $res_produitids=$produit_ids->produits;
    $produit_id=explode(";",$res_produitids); 
    $variable_for_sellers="prodass=".$prodassid;
  }
  else
  {
    $variable_for_sellers="prodass=notyet&produit=".$_GET['id'];
  }
  
  $contrib = $data->contributeur;
  $req_user = $pdo->prepare("SELECT * FROM infos_contributeur WHERE nom = ? AND activation = ?");
  $req_user->execute([$contrib,"oui"]);
  foreach ($req_user as $info_contrib):
    $id_contrib=$info_contrib->id_user;
    $informations_contrib=$info_contrib->paragraphe_info;
  endforeach; 
  
  
  
?>

    <!-- DIV POPUP FOLLOW PRODUCT -->
<?php
  require 'pp_followp.php';
?>
  <!-- FIN DIV POPUP FOLLOW PRODUCT -->

  
  <!-- DIV POPUP SELL PRODUCT -->
<?php
  require 'pp_sellp.php';
?>
  <!-- FIN DIV POPUP SELL PRODUCT -->
  
<!--   DIV POPUP SIGNALER PRODUIT -->
  <?php 
  require 'pp_signaler.php';
  ?>
<!--   FIN DIV POPUP SIGNALER PRODUIT -->

<script>
    $(document).ready(function() { 
    	$("a#img_princ").fancybox({
	  'type'				:'image',
	  'hideOnContentClick'			: true,
	  'transitionIn'			:'elastic',
	  'transitionOut'			:'elastic',
	  'speedIn'				:600, 
	  'speedOut'				:200, 
	  'overlayShow'				:false,
	  'titleShow'				:true,
	  'titlePosition'			:'over'
	});
    });
    </script> 
<script src="js/script-autocomplete_ajouter-xx.js"></script>    
<script>
  function fonction_fb()
  {
    window.open('http://www.facebook.com/sharer/sharer.php?u=http://upcircus.fr/idee.php?id=<?php echo $_GET['id'];?>','_blank');
  }
  function fonction_tt()
  {
    window.open('https://twitter.com/intent/tweet?url=http://upcircus.fr/idee.php?id=<?php echo $_GET['id'];?>','_blank');
  }
  function fonction_gp()
  {
    window.open('https://plus.google.com/share?url=http://upcircus.fr/idee.php?id=<?php echo $_GET['id'];?>','_blank');
  }
</script>
	     



<form method="get" action="moteur.php">
<div class="input-group search-in-product"> 
    <input type="hidden" name = "cat" id="search_second-cat">
    <input type="text" class="form-control search" placeholder="Qu'allez-vous revaloriser aujourd'hui ?" id="search_second" name="search">
    <span class="input-group-btn">
      <button type="submit" class="btn btn-danger">
	<span class="glyphicon glyphicon-search"></span>
      </button>
    </span>
</div>
</form>

	      
	      
	<div class="container-fluid"><br />


	  <ol class="breadcrumb" style="background-color:#fff;">
	    <li><a href="moteur.php?searchfam=<?php echo $data->categorie;?>"><?php echo ucfirst("$data->categorie");?></a></li>
	    <li><a href="moteur.php?search=<?php echo $data->dechet;?>&cat=<?php echo $data->cat_associe; ?>"><?php echo ucfirst($data->dechet);?> (<?php echo $data->cat_associe; ?>)</a></li>
	    <li class="active"><?php echo(ucfirst("$data->titre"));?></li>
	  </ol>
	  <div class="col-lg-offset-1 col-lg-9">
	  
	  
	    <div class="col-lg-3">
	      <a id="img_princ" href="img/img_princ/<?php echo("$data->img_princ");?>" data-toggle="lightbox" data-title="">
		<img src="img/img_princ/<?php echo($data->img_princ);?>" class="img-responsive center-block">
	      </a>
	      <div class="text-center">
		<br />
		<span class="glyphicon glyphicon-share"></span> Partager :  
		<span class="hover" onclick="fonction_fb()";><img src="img/soc1.png" height="20" alt="Partager sur Facebook !"></span>
		<span class="hover" onclick="fonction_tt()";><img src="img/soc2.png" height="20" alt="Partager sur Twitter !"></span>
		<span class="hover" onclick="fonction_gp()";><img src="img/soc3.png" height="20" alt="Partager sur Google+ !"></span>     
	      </div>
	      <div class="text-center"><br /><span class="btn btn-xs btn-default signalproduct" data-toggle="tooltip" data-placement="bottom" title="Signaler ce produit comme du contenu inapproprié"><span class="glyphicon glyphicon-bell"></span> Signaler</span></div>
	    </div>
	    <div class="col-lg-9">
	      <h4>
		<?php echo(ucfirst("$data->titre"));?> <span class="pull-right"><?php require('inc/coupcoeur.php'); ?></span><br />
		<small>
		  Déchet revalorisé : 

		  <a href="moteur.php?search=<?php echo $data->dechet;?>&cat=<?php echo $data->cat_associe; ?>" data-toggle="tooltip" data-placement="bottom" title="Cliquez pour rechercher toutes les revalorisations avec ce déchet"><?php echo ucfirst($data->dechet);?></a>
		  
		  <a href="moteur.php?search=<?php echo $data->cat_associe; ?>&cat=" data-toggle="tooltip" data-placement="bottom" title="Cliquez pour rechercher toutes les revalorisations avec ce groupement de déchets  déchet">(<?php echo ucfirst($data->cat_associe); ?>)</a>
		  
		  | Catégorie : <a href="#" data-toggle="tooltip" data-placement="bottom" title="Cliquez pour rechercher toutes les revalorisations avec cette catégorie"><a href="moteur.php?searchfam=<?php echo $data->categorie;?>"><?php echo ucfirst("$data->categorie");?></a></a><br />
	      </small>
	      </h4>
	      Ajouté par 
	      <?php 
		if (isset($id_contrib))
		{
		  ?>
		  <a href="http://www.upcircus.fr/<?php echo ucfirst("$data->contributeur");?>" data-toggle="tooltip" data-placement="bottom" title="Cliquez pour voir le profil de ce contributeur"><?php echo ucfirst("$data->contributeur");?></a>
		  <?php
		}
		else
		{
		?>
		  <span data-toggle="tooltip" data-placement="bottom" title="Ce contributeur n'a pas activé son profil"><?php echo ucfirst("$data->contributeur");?></span>
		<?php
		}
	      ?>
	      <hr />
	      
	      <div class="col-lg-12 no-padding">
		<h4>Détail du produit</h4>
		<h4>
		  <small>
		    Aucun détails sur le produit n'a été fourni par le contributeur
		  </small>
		</h4>
	      </div>
	      <?php
	      require('test_vote.php');
	      ?>
	      <br />
	      <?php
	      if($data->source!=="0")
	      {
		?>
		<small>Source : <?php
		if(stristr($data->source,'http://') == TRUE)
		{
		  echo('<a href="'.$data->source.'" target="_blank">'.$data->source.'</a>');
		}
		else
		{
		  echo($data->source);
		}
		?></small><br />
		<?php
	      }
	      ?>
	      <br />
	      <span class="btn btn-md btn-primary followproductbtn">Suivre ce produit</span> <span class="btn btn-default sellproductbtn">Vendre ce produit</span><br /><br />
	    </div>
	    <div class="col-lg-12">
	      <hr />
	      <h4>En savoir plus sur le contributeur <br />
	      <small>
		<?php 
		if (isset($info_contrib))
		{
		  echo $informations_contrib; 
		}
		else
		{
		  echo "Le contributeur n'a pas donné d'informations sur lui";
		}
		?>
		</small>
	      </h4>
	    </div>
	  <div class="col-lg-12">
	    <div>
	      <hr />
	      <h4>Ces idées peuvent vous intéresser</h4>
	    </div>
	    <div>
	      <?php
	      $pdo->query("SET NAMES 'utf8'");
	      $req2 = $pdo->prepare("SELECT * FROM contribution WHERE type = ? AND (dechet = ? OR cat_associe = ? OR categorie = ?) ORDER BY RAND() LIMIT 4");
	      $req2->execute(["idee", $data->dechet, $data->cat_associe, $data->categorie]);
	      foreach ($req2 as $data2):
	      ?>
	      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-center">
		<a href="idee.php?id=<?php echo $data2->id; ?>"><img src="img/img_princ/<?php echo $data2->img_princ; ?>" class="img-responsive center-block" style="max-height:100px;"><br />
		<?php echo ucfirst($data2->titre); ?></a>
	      </div>
	      <?php
	      endforeach; 
	      ?><br />
	    </div><br /><br />
	  </div><br /><br />
	</div><br /><br /><br /><br />
	  <br /><br />
  <div class="col-lg-2">	  
    <?php
    $nb_cat=$data->cat_associe;
    $req_cat = $pdo->prepare('SELECT * FROM categorie WHERE categorie = ?');
    $req_cat->execute([$nb_cat]);
    $cat_cat=$req_cat->fetch();
    ?>
    <div class="col-lg-12 col-md-12 hidden-sm info" id="toggle-sm1<?php echo $cat_cat->id; ?>">
      <strong><p class="text-center"><?php echo htmlentities(strtoupper($nb_cat)); ?></p></strong>	
      <p class="text-center"><img src="img/img_categories/<?php echo $cat_cat->photo ?>" class="img-thumbnail" width="150px"></p>
      <strong>Recyclage : </strong><br /><p class="text-justify"><?php echo $cat_cat->methode_recyclage ?></p>
      <br />
      <strong>Informations : </strong><br /><p class="text-justify"><?php echo $cat_cat->informations ?></p>
      <br />
    </div> 
  </div>
</div>
<br />

<div class="bgcommentsection row">
  <div class="col-lg-offset-1 col-lg-9">
    <h4>Commentaires</h4>
    <?php include 'commentaires.php'; ?>
  </div>
</div>

	
	<!--***************** COMMENTAIRES **********************-->
	
	
	
<?php require 'inc/pieddepage_inc_new.php'; ?>