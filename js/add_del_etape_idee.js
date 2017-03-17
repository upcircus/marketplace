$(document).ready(function(){
var i=2;
    $("#addstep").click(function(){
      	$.get("ext_get_list_famille.php", function(data, status){
        $("#newstep").append('<div id="idiv'+i+'"><x1>Produit '+i+' : </x1><div class="form-group"><label class="control-label col-sm-2" for ="">Nom du produit :</label><div class="col-sm-10"><input type="hidden" name="nb_step['+i+']"/><input type="text" name ="titre'+i+'" class = "form-control" placeholder="Ex : Fauteuil de jardin en palette" maxlength="255"/></div></div><div class="form-group"><label class="control-label col-sm-2" for ="">Photo * :</label><div class="col-sm-10"><input type="hidden" name="MAX_FILE_SIZE" value="1048576" /><input type="file" id="InputFile" name="img_princ'+i+'" accept="image/*" onblur="verifimgPrinc(this)"><p class="help-block">La taille de l\'image doit être inférieure à 1Mo</p></div></div><div class="form-group"><div id="image_preview" class="col-lg-4 col-lg-offset-2"><div class="thumbnail hidden"><img src="w" alt="" style="width; 250px;"/><div class="caption"><h4></h4><p></p><p><button type="button" class="btn btn-danger">Annuler</button></p></div></div></div></div><div class="form-group"><label class="control-label col-sm-2" for ="">Catégorie :</label>    <div class="col-sm-3"><select class="form-control" name="categorie'+i+'"><option value="--choix--" name="categorie'+i+'">--Choix--</option>	'+data+'</select></div><label class="control-label col-sm-2" for ="">Source :</label><div class="col-sm-5"><input type="text" name ="source'+i+'" class = "form-control" placeholder="http://www.sitesource.com"/><p class="help-block">Le site ou se trouve initialement ce tutoriel, ou votre site personnel.</p></div></div></div>');
        i=i+1;
	});
    });

    $("#delstep").click(function(){
      if(i>=3)
	{i=i-1;}
      else
	{i=2;}
        $("#idiv"+i).remove();
    });
});