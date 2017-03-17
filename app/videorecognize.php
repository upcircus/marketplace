<?php

Namespace App;

class videorecognize{

public $lien_vid;
public $img_vid;
public $reco;

public function __construct($data){
    $this->link = $data;
  }
 
public function reco(){ 
  $img_princ=$this->link;
  $lien_video=strtolower($img_princ);
  
  $video_dm=preg_match('/dailymotion/',$lien_video);
  $video_dm_mini=preg_match('/dai.ly/',$lien_video);
  $posvid=strpos($lien_video,'video');
  $codepos=$posvid+6;
  $code_dm=substr($lien_video,$codepos);
  $length_apcode=strlen(substr($code_dm,7));
  $code_dm=substr($code_dm,0,-$length_apcode);
  if($video_dm_mini)
  {
    $code_dm=substr($img_princ,-7);
  }
  $img_dm="http://www.dailymotion.com//thumbnail/640x480/video/".$code_dm;
  $lien_dm="http://www.dailymotion.com/video/".$code_dm;
  
  $video_yt=preg_match('/youtu/',$lien_video);
  $code_yt=substr($img_princ,-11);
  $img_yt="http://img.youtube.com/vi/".$code_yt."/0.jpg";
  $lien_yt="https://www.youtube.com/watch?v=".$code_yt;
  
  $video_vm=preg_match('/vimeo/',$lien_video);
  $code_vm=substr($lien_video,-9);
  $img_location = unserialize(file_get_contents("http://vimeo.com/api/v2/video/163509935.php"));
  $img_vm=$img_location[0]['thumbnail_large'];
  $lien_vm="https://vimeo.com/".$code_vm;
   
  if($video_dm OR $video_dm_mini) 
  {
    $this->lien_vid=$lien_dm;
    $this->img_vid=$img_dm;
  }
  elseif($video_yt) 
  {
    $this->lien_vid=$lien_yt;
    $this->img_vid=$img_yt;
  }
  elseif($video_vm) 
  {
    $this->lien_vid=$lien_vm;
    $this->img_vid=$img_vm;
  }

  return $this->lien_vid;  
  return $this->img_vid;
}

public function lien_vid()
{
 $reco=$this->reco();reco();
 return $this->lien_vid;
}

public function img_vid()
{
$reco=$this->reco();

 return $this->img_vid;
}
}