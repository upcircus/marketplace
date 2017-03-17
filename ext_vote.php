<?php
require 'inc/functions.php'; 
logged_only('ext_vote.php');

require_once 'inc/db.php';

$id_contrib=$_POST['id'];
//$id_contrib=209;

$req = $pdo->prepare("SELECT * FROM contribution WHERE id= ?");
$req->execute([$id_contrib]);

foreach ($req as $data):
  endforeach; 
 
 $nb_note=$data->nb_note;
 $note_moyenne=$data->note;
 
$note_user=$_POST['note'];
//$note_user=3;

 $nouvelle_note=($note_moyenne*$nb_note+$note_user)/($nb_note+1);
 $nouveau_nb=$nb_note+1;
 
 
 
 $req = $pdo->prepare("UPDATE contribution SET nb_note = ?, note = ? WHERE id= ?");
 $req->execute([$nouveau_nb, $nouvelle_note, $id_contrib]);
  
  
  
 $req2 = $pdo->prepare("SELECT * FROM up_usr_".$_SESSION['auth']->username." WHERE id_contrib= ?");
$req2->execute([$id_contrib]);

foreach ($req2 as $data2):
  endforeach;  

  $data2_existe=isset($data2)?$data2 : false;
  
  if($data2_existe == false)
  {
    $req = $pdo->prepare("INSERT INTO up_usr_".$_SESSION['auth']->username." SET id_contrib = ?, notes = ?");
    $req->execute([$id_contrib, $note_user]); 
  }
  else
  {
      $req = $pdo->prepare("UPDATE up_usr_".$_SESSION['auth']->username." SET notes = ? WHERE id_contrib = ?");
    $req->execute([$note_user, $id_contrib]); 
  }
  
  $note_moyenne_affiche='';
  for($i=1;$i<=$nouvelle_note;$i++)
    {
      $note_moyenne_affiche=$note_moyenne_affiche.'<span class="rating_full_sm">&starf; </span>';
    }
    for($i=5;$i>$nouvelle_note;$i--)
    {
      $note_moyenne_affiche=$note_moyenne_affiche.'<span class="rating_empty_sm">&starf; </span> ';
    }
     $note_moyenne_affiche=$note_moyenne_affiche.'<mini>&nbsp;('.round($nouvelle_note,1).')</mini>';

 //echo(json_encode(array("note_user" => $note_user,"note_moyenne" => $note_moyenne_affiche))); 
 $str = array("note_user" => $note_user,"note_moyenne" => $note_moyenne_affiche);
 //$str = array("note_user" => "3","note_moyenne" => "kiki");
 
echo json_encode($str);

?>