      
<script>
    $(document).ready(function()
    {
      $("#ccoeur<?php echo $id; ?>").click(function()
      {
	$.post("ext_ccoeur.php", 
	{
	  id:<?php echo $id; ?>
	},
	function(data,status)
	  {
	    if(status == "success")
	      $("#coeur<?php echo $id; ?>").toggle();
	      $("#coeurplein<?php echo $id; ?>").toggle();
	  }); 
      }); 
      $('surcouche-coeur').click(function(event){
	event.preventDefault();
      });
      
    });
</script>
<?php
if(isset($_SESSION['auth']))
{
$user=$_SESSION['auth']->username;
$req_cc=$pdo->prepare('SELECT * from up_usr_'.$_SESSION['auth']->username.' WHERE id_contrib = ?');
$req_cc->execute([$id]);
foreach ($req_cc as $data_cc):  
endforeach; 

if(!isset($data_cc))
{
$val_cc="0";
echo "&nbsp;";
}
else{
$val_cc=$data_cc->coupscoeur;
}

?>

<button id="ccoeur<?php echo $id; ?>" class="btn btn-danger btn-xs">
  <span id="coeur<?php echo $id; ?>" style="<?php if($val_cc == '1'){echo 'display:none';}?>">
    <span class='glyphicon glyphicon-heart-empty text-center'></span>&nbsp;Enregistrer
  </span>
  <span id="coeurplein<?php echo $id; ?>" style="<?php if($val_cc == '0'){echo 'display:none';}?>" class="text-center">
    <span class='glyphicon glyphicon-heart'></span>&nbsp;Enregistré
  </span>
</button>
<?php
}

?>
