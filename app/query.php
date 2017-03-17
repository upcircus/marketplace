<?php

Namespace App;

class query{
public $request;
public $fields = array();

  public function __construct($request,$fields){
    $this->request=$request;
    $this->fields=$fields;
  }
    

  public $data;

  public function sentrequest(){
  require_once 'inc/db.php';

  $req = $pdo->prepare($request);
  $req->execute($fields);

  return $this->req;
  }
}
?>