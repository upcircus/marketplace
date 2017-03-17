  <div class="windowcontent" id="sellproduct">

  <div class="col-lg-12 text-center"><h2>Vous souhaitez vendre ce produit ?<h2></div>
     <div class="text-center grey-font-popup">
      <img src="img/ico/cart.png">
      <h4>Upcircus n'a pas encore lancé sa plateforme de vente de produits de l'économie circulaire. Mais c'est pour bientôt !</h4>
      <?php if (isset($_SESSION['auth']->username)): ?>
      En tant qu'inscrit, ajoutez ce produit dans vos contributions en <a href="ajouter-idee.php?<?php echo $variable_for_sellers;?>">cliquant ici</a>. Il y sera directement associé.<br /><br /><a href="ajouter-idee.php?<?php echo $variable_for_sellers;?>" class="btn btn-danger btn-sm">Vendre mon produit similaire !</a> 
      <?php else: ?>
      <span class="fakelink hover selloutregisterin"> Inscrivez-vous et ajoutez ce produit à vos contributions</span>. Il sera prêt pour le lancement de la plateforme et vos futurs clients pourront "suivre votre produit" pour être tenu au courant ! <br /><br /><span class="btn btn-danger btn-sm selloutregisterin">S'inscrire ! </span>
      <?php endif ?>
     </div>
  </div>