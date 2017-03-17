<?php

Namespace App;

class blur_image{

public $data;


public function __construct($data){
    $this->url = $data;
  }
  

  
  public function newwidth(){
  $info_img=getimagesize($this->url);
  $larg_img=$info_img[0];
  $long_img=$info_img[1];
  $ratio=$larg_img/$long_img;
  if($ratio>=0.66)
  {
    $styllong=300;
    $styllarg=300*$ratio;
  }
  elseif($ratio<0.66)
  {
    $styllarg=200;
    $styllong=200/$ratio;
  }
  return $this->styllarg=round($styllarg);
  }
  
  public function newheight(){
  $info_img=getimagesize($this->url);
  $larg_img=$info_img[0];
  $long_img=$info_img[1];
  $ratio=$larg_img/$long_img;
  if($ratio>=0.66)
  {
    $styllong=300;
    $styllarg=300*$ratio;
  }
  elseif($ratio<0.66)
  {
    $styllarg=200;
    $styllong=200/$ratio;
  }
  return $this->styllong=round($styllong);

  }
  
  
}