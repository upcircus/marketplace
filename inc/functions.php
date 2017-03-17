<?php

function debug($variable){
    echo '<pre>'.print_r($variable, true).'</pre>';

}


function str_random($length)
{
  $alphabet = "01213456789azertyuiopqsssssdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
  return substr(str_shuffle(str_repeat($alphabet,$length)),0,$length);

}

function logged_only($file)
{
  if(session_status() == PHP_SESSION_NONE)
  {
    session_start();
  }

  if(!isset($_SESSION['auth']))
    {
      $_SESSION['flash']['danger'] = "Cette page est à accès limité ou nécéssite d'être inscrit au site. N'hésitez pas, c'est gratuit !";
      
      header('Location:login.php?file='.$file);
      exit();
    }
}

function reconnect_from_cookie()
{
 if(session_status() == PHP_SESSION_NONE)
  {
    session_start();
  }
  if(isset($_COOKIE['remember']) && !isset($_SESSION['auth']))
  {
    require_once 'db.php';
    if(!isset($pdo))
    {
      global $pdo;
    }
    $remember_token=$_COOKIE['remember'];
    $parts = explode('==',$remember_token);
    $user_id=$parts[0];
    $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $req->execute([$user_id]);
    $user = $req->fetch();
    if($user)
    {
      $expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'ratonlaveurs');
      if($expected == $remember_token)
      {
	$_SESSION['auth']= $user;
	setcookie('remember',$remember_token, time() + 60*60*24*7);
      }
    else
      {
	setcookie('remember',null,-1);
      }
    }
    else
    {
      setcookie('remember',null,-1);
    }
  }
}

function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)

{

   //Test1: fichier correctement uploadé

     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;

   //Test2: taille limite

     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;

   //Test3: extension

     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);

     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;

   //Déplacement

     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);

}

function upsize($maxdim,$path,$filename,$i=0)
{
  $fileext[$i] = substr(strrchr($_FILES[$filename]['name'],'.'),1);
  $nom_img_profil[$i] = md5(uniqid(rand(), true)).'.'.$fileext[$i];
  $upload_img_profil[$i] = upload($filename,$path.$nom_img_profil[$i],10000000,['jpg','JPG','png','PNG','gif','GIF','jpeg','JPEG']); 
 //$upload_img_profil[$i] = move_uploaded_file($_FILES[$filename]['name'],$path.$nom_img_profil[$i]);
  

  $size_img[$i]=getimagesize($path.$nom_img_profil[$i]);
  $height_img[$i]=$size_img[$i][1];
  $width_img[$i]=$size_img[$i][0];

  $ratio[$i]=$height_img[$i]/$width_img[$i];

  if($height_img[$i]>=$maxdim[$i] or $width_img[$i]>=$maxdim[$i])
  {
    if($ratio[$i]>=1)
    {
      $height_img_dest[$i] = $maxdim;
      $width_img_dest[$i] = $maxdim/$ratio[$i];
    }
    elseif($ratio[$i]<1)
    {
      $height_img_dest[$i] = $maxdim*$ratio[$i];
      $width_img_dest[$i] = $maxdim;
    }
  }

  $src[$i]=$path.$nom_img_profil[$i];

  $jpeg_quality = 90;
  $png_quality = 1;

  if($fileext[$i]=="gif" OR  $fileext[$i]=="GIF")
  {
    $img_r[$i] = imagecreatefromgif($src[$i]);
  }
  elseif($fileext[$i]=="jpg" OR  $fileext[$i]=="JPG" OR $fileext[$i]=="jpeg" or $fileext[$i]=="JPEG")
  {
    $img_r[$i] = imagecreatefromjpeg($src[$i]);
  }
  elseif($fileext[$i]=="png" OR  $fileext[$i]=="PNG")
  {
      $img_r[$i] = imagecreatefrompng($src[$i]);
  }

  $dst_r[$i] = ImageCreateTrueColor($width_img_dest[$i], $height_img_dest[$i]);

  imagecopyresampled($dst_r[$i], $img_r[$i], 0, 0, 0, 0, $width_img_dest[$i], $height_img_dest[$i], $width_img[$i], $height_img[$i]);

  $nom_img_profil_fin[$i] = md5(uniqid(rand(), true)).'.'.$fileext[$i];
  if($fileext[$i]="gif" OR "GIF")
  {
    imagegif($dst_r[$i],$path.$nom_img_profil_fin[$i]);
  }
  elseif($fileext[$i]="jpg" OR "JPG" OR "jpeg" or "JPEG")
  {
    imagejpeg($dst_r[$i],$path.$nom_img_profil_fin[$i],$jpeg_quality);
  }
  elseif($fileext[$i]="png" OR "PNG")
  {
    imagejpeg($dst_r[$i],$path.$nom_img_profil_fin[$i],$png_quality);
  }

  unlink($path.$nom_img_profil[$i]); 
  return $nom_img_profil_fin[$i];
}

