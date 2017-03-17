<!--SCRIPT AJAX CONNEXION-->
  <script>
    $(document).ready(function()
    {
      $('#form_connexion').on('submit', function(e) 
	{
	  e.preventDefault();
	  var $this = $(this);
	  var email = $('#email_cnx').val();
	  var mdp = $('#password_cnx').val();
	  var rememberme_cnx = $('#rememberme_cnx').val();
	  	  
	  if(email === '' || mdp === '') 
	  {
	    $("#flash_connexion").html('<div class="alert alert-danger alert-dismissible" role="alert" id="flash_register">Tous les champs doivent êtres remplis</div>');
	  } 
	  else 
	  { 
	    $.post("new_connexion.php", 
	    {
	      email:email,
	      mdp:mdp, 
	      rememberme_cnx:rememberme_cnx
	      
	    },
	    function(data,status)
	    {
	      if(status == "success")
	      $("#contenu_connexion").html(data);
	      else if(status == "error")
	      $("#contenu_connexion").html("<br /><br /><br />Une erreur  s\'est produite, et l\'inscription ne s\'est pas faite. Merci de rafraîchir la page.");
	      else
	      $("#contenu_connexion").html('<img src="img/loader-big.gif">');
	    });
	  }
	});
      });
</script>
<!--END SCRIPT AJAX CONNEXION-->


 <div class="windowcontent" id="windowconnect">

  <div class="col-lg-12 text-center"><h2>Connectez-vous !</h2><a href="#" id="cnxoutregisterin">Toujours pas inscrit ? Cliquez ici !</a></div>
  
    <div class="col-lg-6 grey-font-popup">
      <div class="text-center">
      
	<h4><img src="img/ico/brush-pencil.png" height="22px"> Créateurs</h4>
      </div>
      - Mettez vos <strong>produits en avant</strong>, <br />
      - Augmentez votre <strong>visibilité</strong>, <br />
      - Faites partie des pionniers de la <strong>plateforme de vetne</strong> (prévue pour l'été 2017). <br />
      <div class="text-center"> 
	<h4><img src="img/ico/profle.png" height="22px"> Utilisateurs</h4>
      </div>
      - Enregistrez les idées dans votre profil<br />
      - Soyez averti des nouveaux produits<br />
      - Disposez de 5% de réduction au lancement de la plateforme !
    </div> 
    <form id="form_connexion">
    <div class="col-lg-6">
      <div class="col-lg-12" id="contenu_connexion">
      <span id="flash_connexion">
      <br /><br />
      </span>
      
	<div class="form-group">
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-envelope"></span>
	    <input type="email" name ="email_cnx" id ="email_cnx" placeholder="Email" class = "form-control"/>
	  </div>
	  <br />
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-file"></span>
	    <input type="password" name ="password_cnx" id ="password_cnx" placeholder="Mot de passe" class = "form-control"/>
	  </div>
	    
	  <div class="input-group text-center">
	  <label><input type="checkbox" name="rememberme_cnx" id="rememberme_cnx" value="true"> Se rappeller de moi</label>
	  </div>
	</div>
	<div class="text-center"><input type="submit" class="btn btn-primary" name="connecter" id="connexion" value="Se connecter"><br /></div>
      </div>
      <div class="text-center"><small><a href="#" class="forgetbtn">J'ai oublié mon mot de passe</a></small></div>
    </div>
    </form>
  
  </div>