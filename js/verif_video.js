function verifvideo(champ)
{
  
  var test=champ.name;
  var num = test.substr(5);
  var str = champ.value;
  var reyt = 'youtu';
  var redm = 'dailymotion';
  var redmmmini = 'dai.ly';
  var revm = 'vimeo';
  var trouve = str.match(reyt) || str.match(redm) || str.match(redmmmini) || str.match(revm) ;

  if(trouve !== null)
  {
    document.getElementById("verifvideoid"+num).innerHTML = '<span class="alert alert-success">Format de video reconnu. </span>';
    return true;
  }
  else
  {
    document.getElementById("verifvideoid"+num).innerHTML = '<span class="alert alert-danger">Format de video non reconnu. </span>';
    return false;
  }

}

function verifvidetape(champ)
{
  
  var test=champ.name;
  var num = test.substr(11);
  var str = champ.value;
  var reyt = 'youtu';
  var redm = 'dailymotion';
  var redmmmini = 'dai.ly';
  var revm = 'vimeo';
  var trouve = str.match(reyt) || str.match(redm) || str.match(redmmmini) || str.match(revm) ;

  if(trouve !== null)
  {
    document.getElementById("verifvidetapeid"+num).innerHTML = '<span class="alert alert-success">Format de video reconnu. </span>';
    return true;
  }
  else
  {
    document.getElementById("verifvidetapeid"+num).innerHTML = '<span class="alert alert-danger">Format de video non reconnu. </span>';
    return false;
  }

}