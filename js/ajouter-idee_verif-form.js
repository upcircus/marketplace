function verifDechet(champ)
{
   if(champ.value.length < 2)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function verifimgPrinc(champ)
{
   if(champ.value.length < 2)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function affichemesserr(champ)
{
document.getElementById('erreur').innerHTML = '<span class="alert alert-danger">Merci de remplir tous les champs marqué d\'une étoile *. </span>';
}

function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "";
}


  function verifForm(f)
{

   var dechetOk = verifDechet(f.dechet);
   var img_princOk = verifimgPrinc(f.img_princ1);

   if(dechetOk && img_princOk)
   {
      return true;
   }
   else
   {
    affichemesserr();
      return false;
   }
}