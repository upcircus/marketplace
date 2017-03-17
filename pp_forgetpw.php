<!--SCRIPT AJAX FORGET-->
<script>
    $(document).ready(function()
    {
      $('#form_forget').on('submit', function(e) 
	{
	  $("#btn-forget").html("<img src='img/loader-small.gif'>");
	  e.preventDefault();
	  var $this = $(this);
	  var email_forget = $('#email_forget').val();	  
	    $.post("ext_forget.php", 
	    {
	      email_forget:email_forget 
	    },
	    function(data,status)
	    {
	      if(status == "success")
	      $("#contenu_forget").html(data);
	    });
	});
      });
</script>
<!--FIN SCRIPT AJAX FORGET-->

  <div class="windowcontent" id="windowforget">

  <div class="col-lg-12 text-center"><h2>Réinitialiser votre mot de passe<h2></div>
     <div class="text-center grey-font-popup">
      <img src="img/ico/support.png">
      <h4>Pas facile de garder en mémoire tous ces mots de passe ! </h4>
      <br />Rentrez votre adresse email, et vous recevrez un lien pour le réinitialiser. <br />Pensez à vérifier vos spams si l'email tarde trop à arriver :-)
     </div>
    <form id="form_forget">
    <br />
      <div class="col-lg-12 text-center" id="contenu_forget">
	<div class="form-group">
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-envelope"></span>
	    <input type="text" name ="email_forget" id ="email_forget" placeholder="Email" class = "form-control"/>
	  </div>
	</div>
	<div class="text-center"><input type="submit" class="btn btn-primary" name="btn-forget" id="btn-forget" value="Reinitialiser votre mot de passe"></div>
	<br /><br />
      </div>
    </form>
  </div>