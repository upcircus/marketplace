<section>
<?php
if(isset($_GET['search']))
{
  require 'inc/search/recherche_full_text.php';

  for($j=0; $j<=$nb_enregistrement; $j++)
  {
?>  
    <strong><?php echo ucfirst($nom_recherche[$j]); ?></strong>

    <h3>"<?php echo ucfirst($nom_recherche[$j]); ?>" est utilisé comme matière première par les membres du réseau Upcircus ! Découvrez leurs talents !</h3>
    <p>Liste des membres upcircus qui utilisent <?php echo ucfirst($nom_recherche[$j]); ?></p>
    <br /><br />
    <h3>Revalorisation autour de votre recherche : "<?php echo ucfirst($nom_recherche[$j]); ?>" </h3>
  </div>
  <div>
    <?php require_once('test_carre.php');?>
  </div>
</section>
    <?php
      }
    }
     

      ?>
      
      
      
      
      
      
            <form id="form" class="form-horizontal" role="form" method="get" action="<?php echo($_SERVER['PHP_SELF']);?>">
	<div class="input-group">
	  <input type="text" class="form-control" placeholder="exemple : carton, bouteille..." name="search">
	  <span class="input-group-btn">
	    <input type="submit" class="btn btn-default" type="button" value="Go !">
	  </span>
	</div>
      </form>