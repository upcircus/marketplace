<?php

Namespace App;

class blur_image{

public $data;
public $styllarg;
private $styllong;


public function __construct($data){
    $this->url = $data;
  }

  public function divwidth(){
  $info_img=getimagesize($this->url);
  $larg_img=$info_img[0];
  $long_img=$info_img[1];
  $ratio=$larg_img/$long_img;
 
  $styllarg=250*$ratio;
  if ($styllarg <=160)
  {
    $styllarg = 160;
  }
  
  return $this->styllarg=round($styllarg);
  }
  
  public function divheight(){
  $info_img=getimagesize($this->url);
  $larg_img=$info_img[0];
  $long_img=$info_img[1];
  $ratio=$larg_img/$long_img;
  
  $styllong=250;
  
  
  return $this->styllong=round($styllong);

  }
  
  
  public function imgwidth(){
  $info_img=getimagesize($this->url);
  $larg_img=$info_img[0];
  $long_img=$info_img[1];
  $ratio=$larg_img/$long_img;

  $imglarg=250*$ratio;
  if ($imglarg <=160)
  {
    $imglarg = 160;
  }
  else
  {
    $imglarg=250*$ratio;
  }
  return $this->imgwidth=round($imglarg);

  }
  
  public function imgheight(){
  $info_img=getimagesize($this->url);
  $larg_img=$info_img[0];
  $long_img=$info_img[1];
  $ratio=$larg_img/$long_img;

  $imglarg=250*$ratio;
  $imghaut=250;
    if ($imglarg <=160)
  {
    $imghaut=160/$ratio;
  }

 
  
  return $this->imgheight=round($imghaut);

  }
  
}