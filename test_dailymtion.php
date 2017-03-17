
<?php
require 'inc/functions.php'; 
require 'inc/header_inc_new.php';
?> 

<a class="fancybox-media" href="http://www.dailymotion.com/video/xp4tef_bande-annonce-du-film-avengers_shortfilms">coucouc</a>
<?php
$video="http://www.dailymotion.com/video/xp4tef_bande-annonce-du-film-avengers_shortfilms";

?>
<a class="fancybox-media" href="https://vimeo.com/channels/staffpicks/169035643"> vimeo</a>
<img src="http://www.dailymotion.com//thumbnail/640x480/video/xp4tef">
<?php $toto = unserialize(file_get_contents("http://vimeo.com/api/v2/video/163509935.php"));
$img_vimo_thumbnail=$toto[0]['thumbnail_large'];
echo "<img src=\"".$img_vimo_thumbnail."\">";
?>

<?php
require 'inc/pieddepage_inc_new.php';
?>