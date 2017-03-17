

<!--SCRIPT AJAX POST COMMENT-->
<script>
    $(document).ready(function()
    {
      $('#form_comment').on('submit', function(e) 
	{
	  $("#btn-comment").html("<img src='img/loader-small.gif'>");
	  e.preventDefault();
	  var $this = $(this);
	  var comment = $('#comment').val();	  
	  var prodnum = <?php echo $_GET['id'];?>;
	  
	    $.post("ext_commentaires.php", 
	    {
	      comment:comment,
	      prodnum:prodnum
	      
	    },
	    function(data,status)
	    {
	      if(status == "success")
	      $("#comments").html(data);
	    });
	});
      });
</script>
<!--FIN SCRIPT AJAX POST COMMENT-->

<!--SCRIPT AJAX ADD OLD COMMENT-->
<script>
    $(document).ready(function()
    {
      $('#plusdecombtn').click(function(e) 
	{
	  $("#plusdecombtn").html("<img src='img/loader-small.gif'>");
	  var $this = $(this);
	  var nbcom = $('#nb_com_total').val();	  
	  var nbclick = $('#nbclick').val();	  
	  var prodnum = <?php echo $_GET['id'];?>;
	    $.post("ext_morecom.php", 
	    {
	      nbcom:nbcom,
	      nbclick:nbclick, 
	      prodnum:prodnum
	    },
	  function(data, status)
	  {
	    $("#morecom2").remove();
	    $("#morecom").append(data);
	    $("#plusdecombtn").html("Afficher plus de commentaires");
	  });
	});
      });
</script>
<!--FIN SCRIPT AJAX ADD OLD COMMENT-->


<div id="contenu_commentaires">
  <span id="comments">
    <?php
    $prodnum = $_GET['id'];
    $num_com = $pdo->query("SELECT * FROM commentaires_produits WHERE id_produit = $prodnum");
    
    $cnt = $num_com->rowCount();
    $req2 = $pdo->query("SELECT * FROM commentaires_produits WHERE id_produit = $prodnum ORDER BY id DESC LIMIT 5");
    $i=1;
    foreach ($req2 as $com)
    {
      $commentaire=$com->commentaire;
      $auteur=$com->auteur;
      $date=$com->date;
      $i++;
    ?>  
    <div class="bgcomment">
	Par <?php echo $auteur; ?> le <?php echo $date; ?> <br /><?php echo $commentaire; ?> 
    </div>
<br />
  
  <?php }
  echo "</span>";
  if ($cnt>$i)
  {
  ?>
  <span id="morecom2">
    <input type="hidden" value="<?php echo $cnt; ?>" id="nb_com_total">
    <input type="hidden" value="0" id="nbclick">
  </span>
  <span id="morecom">
  </span>
  <div class="text-center"><span class="btn btn-default plusdecom" id="plusdecombtn">Afficher plus de commentaires</span></div><br />
  
  <?php }
  ?>
</div>

<form id="form_comment" method="POST">
  <div class="form-group">
    <textarea rows="3" placeholder="Entrez votre commentaire" class="form-control" id="comment"></textarea>
    <?php if (isset($_SESSION['auth']->username)){
    ?><input type="submit" class="btn btn-primary btn-xs" id="btn-comment" value="Envoyer" name="envoyer">
    <?php 
    }
    else
    {
    echo "<span class=\"connexionbtn fakelink hover\">Connectez-vous pour écrire un commentaire</span> - <span class=\" fakelink hover inscriptionbtn\">Pas encore inscrit?</span>";
    }
    ?>
  </div>
</form>