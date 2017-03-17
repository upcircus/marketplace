
$(document).ready(function(){
    $("#5s").click(function(){
	$("#vote").html('<span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><input  id="difficulte" type="hidden" name="difficulte" value="5" onblur="verifdifficulte(this)">');
    });
    $("#4s").click(function(){
	$("#vote").html('<span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_empty">&starf;</span><input id="difficulte" type="hidden" name="difficulte" value="4" onblur="verifdifficulte(this)">');
    });
    $("#3s").click(function(){
	$("#vote").html('<span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><input id="difficulte" type="hidden" name="difficulte" value="3" onblur="verifdifficulte(this)">');
    });
    $("#2s").click(function(){
	$("#vote").html('<span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><input id="difficulte" type="hidden" name="difficulte" value="2" onblur="verifdifficulte(this)">');
    });
    $("#1s").click(function(){
	$("#vote").html('<span class="rating_full">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><input id="difficulte" type="hidden" name="difficulte" value="1" onblur="verifdifficulte(this)">');
    });
});

$(document).ready(function(){
    $("#5s2").click(function(){
	$("#vote2").html('<span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><input  id="difficulte2" type="hidden" name="difficulte2" value="5">');
    });
    $("#4s2").click(function(){
	$("#vote2").html('<span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_empty">&starf;</span><input id="difficulte2" type="hidden" name="difficulte2" value="4">');
    });
    $("#3s2").click(function(){
	$("#vote2").html('<span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><input id="difficulte2" type="hidden" name="difficulte2" value="3">');
    });
    $("#2s2").click(function(){
	$("#vote2").html('<span class="rating_full">&starf;</span><span class="rating_full">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><input id="difficulte2" type="hidden" name="difficulte2" value="2">');
    });
    $("#1s2").click(function(){
	$("#vote2").html('<span class="rating_full">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><span class="rating_empty">&starf;</span><input id="difficulte2" type="hidden" name="difficulte2" value="1">');
    });
});
