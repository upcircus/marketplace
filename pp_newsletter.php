<?php 
if(!isset($_SESSION['auth']))
{
?>
<script>
$(document).ready(function(){

    var nbleave=1;
    $("body").mouseleave(function(){      
    if(nbleave==1)
      {
	  $( "#whiteback" ).fadeIn();
	  $( "#windownewsletter" ).fadeIn();
	  nbleave++;
      }
    });
});
</script>
<?php
}
?>

<script>
    $(document).ready(function()
    {
      $('#form_newsletter1').on('submit', function(e) 
	{
	  $("#btn-newsletter1").html("<img src='img/loader-small.gif'>");
	  e.preventDefault();
	  var $this = $(this);
	  var email_nl = $('#email_nl1').val();	  
	    $.post("ext_newsletter.php", 
	    {
	      email_nl:email_nl 
	    },
	    function(data,status)
	    {
	      if(status == "success")
	      $(".newsletter").html(data);
	    });
	});
      });
</script>


<script>
    $(document).ready(function()
    {
      $('#form_newsletter2').on('submit', function(e) 
	{
	  $("#btn-newsletter2").html("<img src='img/loader-small.gif'>");
	  e.preventDefault();
	  var $this = $(this);
	  var email_nl = $('#email_nl2').val();	  
	    $.post("ext_newsletter.php", 
	    {
	      email_nl:email_nl 
	    },
	    function(data,status)
	    {
	      if(status == "success")
	      $(".newsletter").html(data);
	    });
	});
      });
</script>


  <div class="windowcontent" id="windownewsletter">

  <div class="col-lg-12 text-center"><h2>Abonnez-vous à notre newsletter !<h2></div>
     <div class="text-center grey-font-popup">
      <img src="img/ico/mail.png">
      <h4>Et soyez un pionnier de l'upcycling et de la revalorisation !</h4>
      <br />Soyez informé des derniers ajouts de nos contributeurs, de l'évolution d'Upcircus, et bénéficiez de 5% de réduction au lancement de la plateforme de vente !<br />
     </div>
    <form id="form_newsletter2">
    <br />
      <div class="col-lg-12 text-center newsletter">
	<div class="form-group">
	  <div class="input-group">
	    <span class="input-group-addon glyphicon glyphicon-envelope"></span>
	    <input type="text" name ="email_nl" id="email_nl2" placeholder="Email" class = "form-control"/>
	  </div>
	</div>
	<div class="text-center"><input type="submit" class="btn btn-primary" id="btn-newsletter2" value="M'abonner"></div>
	<br /><br />
      </div>
    </form>
  </div>