<?php
if(isset($_GET['send']))
{
  header('location:'.$_SERVER['PHP_SELF'].'&correct='.$_GET['cham']);
}
?>

<form method="get" action="">
<input type="text" value="ccouc" name="cham">
<input type="submit" value="envoyer" name="send">
</form>