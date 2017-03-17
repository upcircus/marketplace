<?php
header( 'content-type: text/html; charset=utf-8' );
require_once 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");
$term = $_GET['term'];

$reponse = $pdo->prepare('SELECT * FROM dechets WHERE nom_dechets LIKE :nom_dechets');
$reponse->execute(array(':nom_dechets' => $term.'%'));
    
$a_json = array();
$a_json_row = array();


while($donnees = $reponse->fetch()) 
{
  //$table[]= $donnees->nom_dechets." (".$donnees->dechetassocie.")";
  //$table[]= "value" => $donnees->nom_dechets, "label" => $donnees->nom_dechets, "desc" => $donnees->dechetassocie;
  
  $a_json_row["value"] = $donnees->nom_dechets;
  $a_json_row["label"] = $donnees->nom_dechets;
  $a_json_row["desc"] =  $donnees->dechetassocie;
  array_push($a_json, $a_json_row);
	  




}

echo json_encode($a_json);
    
    //echo json_encode(array("value" => "toto", "label" => "Toto", "desc" => "la blague de toto"));    
    //echo json_encode(array("value" => array("toto","kiki","coco")), array("label"=>array("Toto","Kiki", "Coco"), array("desc"=>array("la blague de toto","kiri kiri kiri !!", "chocopops")));   
?>
