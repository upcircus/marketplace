  <div class="windowcontent" id="followproduct">

  <div class="col-lg-12 text-center"><h2>Ce produit vous intéresse ?<h2></div>
     <div class="text-center grey-font-popup">
      <img src="img/ico/shop.png">
      <h4>Aujourd'hui, il n'est pas encore à vendre ! Peut-être plus tard ! </h4>
     </div>
    <form id="form_followproduct">
    <br />
      <div class="col-lg-12 text-center grey-font-popup" id="follow-area">
      <?php if (isset($_SESSION['auth']->username)): ?>
      En cliquant sur ce bouton, vous serez tenu au courant de la mise en vente de ce produit par un vendeur. <br />
      <span class="btn btn-danger btn-sm" id="followregisterbtn">Suivre ce produit</span><input type="hidden" id="emailuser" value="<?php echo $email_session;?>">
      <?php else: ?>
      <br />Inscrivez votre email et soyez tenu au courant du lancement de la plateforme de vente et de la mise en vente de ce produit !<br />
	<div class="form-group">
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-envelope"></span>
	    <input type="email" name ="email_follow" id ="email_follow" placeholder="Email" class = "form-control"/>
	  </div>
	</div>
	<div class="text-center">
	  <input type="submit" class="btn btn-primary" name="btn-followproduct" id="btn-followproduct" value="Suivre ce produit">
	</div>
      <?php endif ?>
	<br /><br />
      </div>
    </form>
  </div>