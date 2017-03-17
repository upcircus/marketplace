<?php

$pdo->query("SET NAMES 'utf8'");

?>

<style>
.default-note
{
cursor:pointer;
}
</style>

<?php

$req = $pdo->prepare("SELECT * FROM contribution WHERE id =?");
$req->execute([$_GET['id']]);

if(isset($_SESSION['auth']->username))
{
$req2 = $pdo->prepare("SELECT * FROM up_usr_".$_SESSION['auth']->username." WHERE id_contrib =?");
$req2->execute([$_GET['id']]);

$req3 = $pdo->prepare("SELECT COUNT(*) FROM up_usr_".$_SESSION['auth']->username." WHERE id_contrib =?");
$req3->execute([$_GET['id']]);

?>
  
<?php foreach ($req as $data):  ?>
<?php endforeach; ?>  

<?php foreach ($req2 as $data2):  ?>
<?php endforeach; ?>  

<?php
$count=$req3->fetchColumn()   
 ?>  
 
 
<script>

$(document).ready(function(){
    $("#note1").hover(function(){
      $("#note1").addClass("rating_full_sm");
      $("#note2").removeClass("rating_full_sm");
      $("#note3").removeClass("rating_full_sm");
      $("#note4").removeClass("rating_full_sm");
      $("#note5").removeClass("rating_full_sm");
    });
    $("#note1").click(function(){
    
    $.post("ext_vote.php",
        {
          id: <?php echo("$data->id")?>,
          note:"1",
          dataType: 'json'
	},
          function(data, status)
	  {
	    if(status=="success")
	    {
	      var data1= $.parseJSON(data);  
	      $("#votrenote").html('Votre note : ');
	      $("#notemoyenne").html(data1.note_moyenne);
	      $("#content").html("<span class='rating_full_sm'>&starf; </span><span class='rating_empty_sm'>&starf; </span><span class='rating_empty_sm'>&starf; </span><span class='rating_empty_sm'>&starf; </span><span class='rating_empty_sm'>&starf; </span>");
	      
	    }
	    else
	    {
	      alert("error");
	    }
	  }
	);
    });
    
    $("#note2").hover(function(){
      $("#note1").addClass("rating_full_sm");
      $("#note2").addClass("rating_full_sm");
      $("#note3").removeClass("rating_full_sm");
      $("#note4").removeClass("rating_full_sm");
      $("#note5").removeClass("rating_full_sm");
    });
    
    $("#note2").click(function(){
    $.post("ext_vote.php",
        {
          id: <?php echo("$data->id")?>,
          note:"2",
          dataType: 'json'
	},
          function(data, status)
	  {
	    if(status=="success")
	    {
	      var data1= $.parseJSON(data);  
	      $("#votrenote").html('Votre note : ');
	      $("#notemoyenne").html(data1.note_moyenne);
	      $("#content").html("<span class='rating_full_sm'>&starf; </span><span class='rating_full_sm'>&starf; </span><span class='rating_empty_sm'>&starf; </span><span class='rating_empty_sm'>&starf; </span><span class='rating_empty_sm'>&starf; </span>");
	      
	    }
	    else
	    {
	      alert("error");
	    }
	  }
	);
    });
    
    $("#note3").hover(function(){
      $("#note1").addClass("rating_full_sm");
      $("#note2").addClass("rating_full_sm");
      $("#note3").addClass("rating_full_sm");
      $("#note4").removeClass("rating_full_sm");
      $("#note5").removeClass("rating_full_sm");
    });
    
      $("#note3").click(function(){
    $.post("ext_vote.php",
        {
          id: <?php echo("$data->id")?>,
          note:"3",
          dataType: 'json'
	},
          function(data, status)
	  {
	    if(status=="success")
	    {
	      var data1= $.parseJSON(data);  
	      $("#votrenote").html('Votre note : ');
	      $("#notemoyenne").html(data1.note_moyenne);
	      $("#content").html("<span class='rating_full_sm'>&starf; </span><span class='rating_full_sm'>&starf; </span><span class='rating_full_sm'>&starf; </span><span class='rating_empty_sm'>&starf; </span><span class='rating_empty_sm'>&starf; </span>");
	      
	    }
	    else
	    {
	      alert("error");
	    }
	  }
	);
    });
    
    $("#note4").hover(function(){
      $("#note1").addClass("rating_full_sm");
      $("#note2").addClass("rating_full_sm");
      $("#note3").addClass("rating_full_sm");
      $("#note4").addClass("rating_full_sm");
      $("#note5").removeClass("rating_full_sm");
    });
    
      $("#note4").click(function(){
    $.post("ext_vote.php",
        {
          id: <?php echo("$data->id")?>,
          note:"4",
          dataType: 'json'
	},
          function(data, status)
	  {
	    if(status=="success")
	    {
	      var data1= $.parseJSON(data);  
	      $("#votrenote").html('Votre note : ');
	      $("#notemoyenne").html(data1.note_moyenne);
	      $("#content").html("<span class='rating_full_sm'>&starf; </span><span class='rating_full_sm'>&starf; </span><span class='rating_full_sm'>&starf; </span><span class='rating_full_sm'>&starf; </span><span class='rating_empty_sm'>&starf; </span>");
	      
	    }
	    else
	    {
	      alert("error");
	    }
	  }
	);
    });
    
    $("#note5").hover(function(){
      $("#note1").addClass("rating_full_sm");
      $("#note2").addClass("rating_full_sm");
      $("#note3").addClass("rating_full_sm");
      $("#note4").addClass("rating_full_sm");
      $("#note5").addClass("rating_full_sm");
    });
    
     $("#note5").click(function(){
    $.post("ext_vote.php",
        {
          id: <?php echo("$data->id")?>,
          note:"5",
          dataType: 'json'
	},
          function(data, status)
	  {
	    if(status=="success")
	    {
	      var data1= $.parseJSON(data);  
	      $("#votrenote").html('Votre note : ');
	      $("#notemoyenne").html(data1.note_moyenne);
	      $("#content").html("<span class='rating_full_sm'>&starf; </span><span class='rating_full_sm'>&starf; </span><span class='rating_full_sm'>&starf; </span><span class='rating_full_sm'>&starf; </span><span class='rating_full_sm'>&starf; </span>");
	      
	    }
	    else
	    {
	      alert("error");
	    }
	  }
	);
    });
    
    $("#notes").mouseout(function(){
      $("#note1").removeClass("rating_full_sm");
      $("#note2").removeClass("rating_full_sm");
      $("#note3").removeClass("rating_full_sm");
      $("#note4").removeClass("rating_full_sm");
      $("#note5").removeClass("rating_full_sm");
    });
    
    
});
</script>
</head>

<body>



<section>    

      <span id="votrenote">
      <?php
      $note_existe=isset($data2->notes) ? $data2->notes : false;
	if(($count!=="0")||($note_existe))
	{
      ?>
	  Votre note : 
	  <?php
	}
	else
	{
	  ?>
	  Notez ce produit : 
	  <?php 
	}
	?>
      </span>

      <span id="vote">
	<?php
	if((($count>0)&&($note_existe!=="0")))
	{
	  for($i=1;$i<=$data2->notes;$i++)
	  {
	    echo('<span class="rating_full_sm">&starf; </span>');
	  }
	  for($i=5;$i>$data2->notes;$i--)
	  {
	    echo('<span class="rating_empty_sm">&starf; </span>');
	  }
	}
	elseif((($count>0)&&($data2->notes=="0"))||($count<1))
	{
	  ?>
	  <span id="content">
	  <span id="notes" class="default-note">
	  <span id="note1">&starf;</span>
	  <span id="note2">&starf;</span>
	  <span id="note3">&starf;</span>
	  <span id="note4">&starf;</span>
	  <span id="note5">&starf;</span>
	  </span>
	  <?php
	}
	?>
      </span>

<?php
}
else{
$count=1;
echo("<section>");
}
?>     

      <br />Note moyenne :
      <span id="notemoyenne">
	<?php
	if(($count>0)||($data->note!=="0"))
	{
	  for($i=1;$i<=round($data->note);$i++)
	      {
		echo('<span class="rating_full_sm">&starf; </span>');
	      }
	      for($i=5;$i>round($data->note);$i--)
	      {
		echo('<span class="rating_empty_sm">&starf; </span>');
	      }
	  echo '<mini>&nbsp;('.round($data->note,1).')</mini>'; 
	}
	elseif((($count>0)&&($data2->notes=="0"))||($count<1))
	{
	  echo("<mini>Pas de notation</mini>");
	}
	?>
      </span>

</body>
</html>
