function verifTitre(champ)
{
   if(champ.value.length < 2 || champ.value.length > 75)
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

function verifDechet(champ)
{
   if(champ.value.length < 2 || champ.value.length > 75)
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

function verifimgPrinctaille(champ)
{
   if(champ.value == "non")
   {
      surligne(champ, true);
      return false;
   }
   else if(champ.value == "oui")
   {
      surligne(champ, false);
      return true;
   }
}

function verifimgmatostaille(champ)
{
   if(champ.value == "non")
   {
      surligne(champ, true);
      return false;
   }
   else if(champ.value == "oui")
   {
      surligne(champ, false);
      return true;
   }
}

function verifimgsteptaille(champ)
{
   if(champ.value == "non")
   {
      surligne(champ, true);
      return false;
   }
   else if(champ.value == "oui")
   {
      surligne(champ, false);
      return true;
   }
}

function verifdifficulte(champ)
{
    if(champ.value==0)
    {
     document.getElementById("vote").style.backgroundColor="#fba";
      return false;
    }
          
   else if(champ.value!=0)
   {
     document.getElementById("vote").style.backgroundColor="#fff";
     return true
   }
    
   else
   {
      return true;
   }
}

function verifdifficulte2(champ)
{
    if(champ.value==0)
    {
    document.getElementById("vote2").style.backgroundColor="#fba";
      return false;
    }

   else
   {
      return true;
   }
}



function verifintro(champ)
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

function verifmateriel(champ)
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

function veriftitre_etape1(champ)
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

function verifimg_etape1(champ)
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

function veriftutoriel_etape1(champ)
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

function verifcategorie(champ)
{
   if(champ.value == "--Choix--")
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

function verifmotcle(champ)
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

function verifLienVideo(champ)
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

function verifcomadd(champ)
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

function affichemesserr2(champ)
{
document.getElementById('erreur2').innerHTML = '<span class="alert alert-danger">Merci de remplir tous les champs marqué d\'une étoile *. </span>';
}

function verifsource(champ)
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




function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "";
}

function verifForm(f)
{
   var titreOk = verifTitre(f.titre);
   var dechetOk = verifDechet(f.dechet);
   var img_princOk = verifimgPrinc(f.img_princ);
   var img_princtailleOk = verifimgPrinctaille(f.img_princ_taille);
   var img_matostailleOk = verifimgmatostaille(f.img_matos_taille);
   var img_steptailleOk = verifimgsteptaille(f.img_step1_taille);
   var difficulteOK = verifdifficulte(f.difficulte);
   var introOK = verifintro(f.intro);
   var materielOK = verifmateriel(f.materiel);
   var titre_etape1OK = veriftitre_etape1(f.titre_etape1);
   var img_etape1OK = verifimg_etape1(f.img_etape1);
   var tutoriel_etape1OK = veriftutoriel_etape1(f.tutoriel_etape1);
   var categorieOK = verifcategorie(f.categorie);
   var motcleOK = verifmotcle(f.motcle);
   var sourceOK = verifsource(f.source);
   
   if(titreOk && dechetOk && img_princOk && img_princtailleOk & img_matostailleOk && img_steptailleOk && difficulteOK && introOK && materielOK && titre_etape1OK && img_etape1OK && tutoriel_etape1OK && categorieOK && motcleOK && sourceOK)
   {
     return true;

   }
   else
   {
    affichemesserr();
      return false;
   }
}


function verifForm2(f)
{

   var titreOk = verifTitre(f.titre);
   var dechetOk = verifDechet(f.dechet);
   var lienvideoOk=verifLienVideo(f.video1);
   var difficulte2OK = verifdifficulte2(f.difficulte);

   if(titreOk && dechetOk && lienvideoOk && difficulte2OK)
   {
      return true;

   }
   else
   {
    affichemesserr2();
      return false;
   }
}



