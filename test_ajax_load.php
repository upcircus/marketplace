
<?php
require 'inc/functions.php'; 
require 'inc/header_inc_new.php';
require_once 'inc/db.php';
?>

<script type="text/javascript">
function coucou(){
alert("toto");
}
</script>


<script type="text/javascript">



/*
$(function coucou(){
alert("fge");*/
        $("#div1").load("idee_createur.php", function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                alert("External content loaded successfully!");
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
});
jquery(function($) {
  $('#test')
    .bind('beforeShow', function() {
      alert('beforeShow');
    }) 
    .bind('afterShow', function() {
      alert('afterShow');
    })
    .show(1000, function() {
      alert('in show callback');
    })
    .show();
});

</script>


<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>

<div id="test"></div>

</body>
</html>
