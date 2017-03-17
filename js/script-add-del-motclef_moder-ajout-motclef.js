    $(document).ready(function()
    {
      $("#del<?php echo $data->id ?>").click(function()
      {    
	$.post("del_motclef.php",
	{
	  id:<?php echo $data->id ?>      
	});
	$("#div<?php echo $data->id ?>").remove();
      });

      $("#maj<?php echo $data->id ?>").click(function()
      { 
      var elem = document.getElementById("img_princ<?php echo $data->id ?>");

 	if (elem.value !== '')
	{
	  update();
	}
	else
	{ 
	  $.post("maj_motclef.php",
	  {
	    id:<?php echo $data->id ?>,
	    motclef:$("#rechass<?php echo $data->id ?>").val(),
	    nomdechet:$("#nomdech<?php echo $data->id ?>").val(),
	    categorie:$("#categorie<?php echo $data->id ?>").val(),
	    methode:$("#methode<?php echo $data->id ?>").val()
	  },
	  function(data,status)
	  {
	    if(status == "success")
	      $("#majico<?php echo $data->id ?>").html('Mis à jour');
	  });
	}
	
	function update()
	{
	    var xhr = new XMLHttpRequest();
	    xhr.open("POST", "ext_upload_img.php", true);
	    var file = $("#img_princ<?php echo $data->id ?>")[0].files[0];
	    xhr.setRequestHeader("X-FILENAME", file.name);
	    xhr.send(file); 
	      xhr.onreadystatechange = function() 
	      {
		if (xhr.readyState == 4 && xhr.status == 200) 
		{

		  $.post("maj_motclef.php",
		  {
		    id:<?php echo $data->id ?>,
		    motclef:$("#rechass<?php echo $data->id ?>").val(),
		    nomdechet:$("#nomdech<?php echo $data->id ?>").val(),
		    categorie:$("#categorie<?php echo $data->id ?>").val(),
		    image:xhr.responseText,
		    methode:$("#methode<?php echo $data->id ?>").val()
		  },
		  function(data,status)
		  {
		    if(status == "success")
		      $("#majico<?php echo $data->id ?>").html('Mis à jour');
		  });
		
		}
	      };
	    
	};
      });
    });