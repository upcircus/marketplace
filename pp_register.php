<!--SCRIPT AJAX REGISTER-->
  <script>
    $(document).ready(function()
    {
      $('#form_register').on('submit', function(e) 
	{
	  e.preventDefault();
	  var $this = $(this);
	  var username = $('#username_reg').val();
	  var email = $('#email_reg').val();
	  var mdp = $('#password_reg').val();
	  var mdp2 = $('#password_confirm_reg').val();
	  
	  if(username === '' || email === '' || mdp === '' || mdp2 === '') 
	  {
	    $("#flash_register").html('<div class="alert alert-danger alert-dismissible" role="alert" id="flash_register">Tous les champs doivent êtres remplis</div>');
	  } 
	  else 
	  { 
	  $("#btn-register").html("<img src='img/loader-small.gif'>");
	    $.post("new_register.php", 
	    {
	      username:username, 
	      email:email,
	      mdp:mdp,
	      mdp2:mdp2
	    },
	    function(data,status)
	    {
	      if(status == "success")
	      $("#contenu").html(data);
	      else if(status == "error")
	      $("#contenu").html('<br /><br /><br />Une erreur  s\'est produite, et l\'inscription ne s\'est pas faite. Merci de rafraîchir la page.');
	      else
	      $("#contenu").html('<img src="img/loader-big.gif">');
	    });
	  }
	});
      });
</script>
<!--END SCRIPT AJAX REGISTER-->

<div class="windowcontent" id="windowregister">
    <div class="col-lg-12 text-center">
      <h2>Inscrivez-vous et créez votre profil !<h2>
    </div>
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
    <form id="form_register">
    <div class="col-lg-6">
      <div class="col-lg-12" id="contenu">
      <span id="flash_register"></span>
      
	<div class="form-group">
	<br />
	  <div class="input-group">
	      <span class="input-group-addon glyphicon glyphicon-user"></span>
	      <input type="text" name ="username_reg" id ="username_reg" placeholder ="Pseudo" class = "form-control"/>
	  </div>
	  <br />
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-envelope"></span>
	    <input type="email" name ="email_reg" id ="email_reg" placeholder="Email" class = "form-control"/>
	  </div>
	  <br />
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-file"></span>
	    <input type="password" name ="password_reg" id ="password_reg" placeholder="Mot de passe" class = "form-control"/>
	  </div>
	  <br />
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-duplicate"></span>
	    <input type="password" name ="password_confirm_reg"  id ="password_confirm_reg" placeholder="Confirmez votre mot de passe" class = "form-control"/>
	  </div>
	</div>
	<div class="text-center" id="btn-register"><input type="submit" class="btn btn-primary" name="inscrire" id="inscription" value="S'inscrire"></div>
	<br /><br />
      </div>
    </div>
    </form>
  </div>