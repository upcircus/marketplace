<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */
require 'inc/functions.php'; 
require 'inc/header_inc_new.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w = $targ_h = 150;
	$jpeg_quality = 90;

	$src = 'pool.jpg';
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
	

	$nom_img_profil = md5(uniqid(rand(), true)).'.jpg';
	$upload_img_profil = upload($nom_img_profil,5120000, array('png','gif','jpg','jpeg','PNG','GIF','JPG','JPEG') ); 
	
// 	header('Content-type: image/jpeg');
	imagejpeg($dst_r,$nom_img_profil,$jpeg_quality);
echo "image uploadé";
// 	exit;
}

// If not a POST request, display page below:

?>

<script src="js/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />

<script type="text/javascript">

  $(function(){

    $('#cropbox').Jcrop({
//       aspectRatio: 1,
//       onSelect: updateCoords
    });

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Merci de selectionner une zone sur l\'image puis sur cliquer sur "recouper"');
    return false;
  };

</script>
<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }


</style>

</head>
<body>
		<!-- This is the image we're attaching Jcrop to -->
		<img src="pool.jpg" id="cropbox" />

		<!-- This is the form that our event handler fills -->
		<form action="crop.php" method="post" onsubmit="return checkCoords();">
			<input type="hidden" id="x" name="x" value="5"/>
			<input type="hidden" id="y" name="y" value="25"/>
			<input type="hidden" id="w" name="w" value="55"/>
			<input type="hidden" id="h" name="h" value="85"/>
			<input type="submit" value="Crop Image" class="btn btn-warning btn-xs" />
		</form>
	</body>

</html>
