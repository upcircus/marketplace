<script type="text/javascript">

  $(function(){

    $('#cropbox').Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords
    });

  });

  function updateCoords(c)
  {
    var file = $("#cropbox")[0];
    var heightfile = file.height;
    var ratio = file.height/300;
    var x1 = c.x*ratio; 
    var y1 = c.y*ratio; 
    var w1 = c.w*ratio; 
    var h1 = c.h*ratio; 
    $('#x').val(x1);
    $('#y').val(y1);
    $('#w').val(w1);
    $('#h').val(h1);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) 
    {
    return true;
    }
    else
    {
    alert('Merci de selectionner une zone sur l\'image puis sur cliquer sur "recouper"');
    return false;
    }
  };

</script>

<?php
  $image =  $_POST['profil']; 
?>
<img src="<?php echo $image; ?>" id="cropbox" style="max-height:300px;"/>

<!-- This is the form that our event handler fills -->
<form action="" method="post" onsubmit="return checkCoords();">
	<input type="hidden" id="x" name="x"/>
	<input type="hidden" id="y" name="y"/>
	<input type="hidden" id="w" name="w"/>
	<input type="hidden" id="h" name="h"/>
	<input type="submit" value="Crop Image" class="btn btn-warning btn-xs" name="crop" />
</form>