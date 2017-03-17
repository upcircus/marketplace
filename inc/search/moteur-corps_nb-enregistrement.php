      <mini><?php echo $nb_exact; ?> enregistrement(s) pour le mot "<?php if(isset($_GET['searchfam'])){echo $_GET['searchfam'];} else{echo $val_search;} ?>" : 
      <?php 
      $i=0;
      foreach($reponse_exact as $data)
      {    
      ?>
	<strong><a href="moteur.php?search=<?php echo $data->nom_dechets;?>&cat=<?php echo $data->dechetassocie; ?>"><?php echo $data->nom_dechets." (". $data->dechetassocie; ?>)</a></strong>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; 
      <?php
	$nb_enregistrement=$i;
	$i++;
      }
      ?></mini>