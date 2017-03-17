<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("button").click(function(){
        $.post("ext_testjs2.php",
        {
          name: "Donald Duck",
          city: "Duckburg",
          dataType: 'json'
          },
          function(data, status)
	  {
	  if (status == "success"){
	  var data1 = $.parseJSON(data);
	    alert(data1.key2);
	    alert(status);
	    }
	    else{alert("toto");}
	  }
	);
    });
});
</script>






</head>
<body>

<button>Send an HTTP POST request to a page and get the result back</button>

</body>
</html>
