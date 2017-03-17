<!--SCRIPT AJAX CONTACT-->
<script>
    $(document).ready(function()
    {
      $('#form_signaler').on('submit', function(e) 
	{
	  e.preventDefault();
	  var $this = $(this);	
	  var message_signal = $('#text_signalement').val();	
	  var type=$('#type').val();
	  
	
	  $("#btn-signal").html("<img src='img/loader-small.gif'>");
	  $.post("ext_signalement.php", 
	    {
	      message_signalement:message_signal,
	      type:type,
	      produit_signal:"<?php echo $_GET['id']; ?>"
	    },
	    function(data,status)
	    {
	      if(status == "success")
	      $("#signal_content").html(data);
	      else
	      {
		$("#signal_content").html("marche pas :'-(");
	      }
	    });
	});
      });
</script>
<!--FIN SCRIPT AJAX CONTACT-->


<div class="windowcontent" id="signalproduct">
  <div class="col-lg-12 text-center"><h2>Signaler ce produit comme inapproprié<h2></div>
     <div class="text-center grey-font-popup">
      <img src="img/ico/bolt.png">
      <h4>Vous considérez que ce produit est inapproprié et ne doit plus figurer sur le site Upcircus.fr. <br />Merci de votre signalement. <br />N'hésitez pas à ajouter une justification via le formulaire ci-dessous. </h4>
      <div id="signal_content">
	<form id="form_signaler">
	  <textarea id="text_signalement" rows="3" cols="45" placeholder="Ce contenu ne doit plus figurer sur le site car..."></textarea><input type="hidden" id="type" value="<?php echo $data->type; ?>"><br /><span id="btn-signal"><input type="submit" class="btn btn-danger" value="Envoyer le signalement"></span>
	</form>
      </div>
    </div>
</div>