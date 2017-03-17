      
<script>
    $(document).ready(function()
    {
      $("#ccoeur").click(function()
      {
	$.post("ext_ccoeur.php", 
	{
	  id:<?php echo $_GET['id']; ?>
	},
	function(data,status)
	  {
	    if(status == "success")
	      $("#coeur").toggle();
	      $("#coeurplein").toggle();
	  });
      }); 
    });
</script>
<?php
if(isset($_SESSION['auth']))
{
  $user=$_SESSION['auth']->username;
  $req_cc=$pdo->prepare('SELECT * from up_usr_'.$_SESSION['auth']->username.' WHERE id_contrib = ?');
  $req_cc->execute([$_GET['id']]);
  foreach ($req_cc as $data_cc):  
  endforeach; 

  if(!isset($data_cc))
  {
    $val_cc="0";
  }
  else
  {
    $val_cc=$data_cc->coupscoeur;
  }

  ?>
  <button id="ccoeur" class="btn btn-danger btn-xs"><span id="coeur" style="<?php if($val_cc == '1'){echo 'display:none';}?>"><span class='glyphicon glyphicon-heart-empty'></span> Ajouter aux coups de coeur</span><span id="coeurplein" style="<?php if($val_cc == '0'){echo 'display:none';}?>"><span class='glyphicon glyphicon-heart'></span> Enregistré</span></button>
  <?php
}

?>
