<?php
require 'inc/db.php';
$pdo->query("SET NAMES 'utf8'");
$options=$pdo->query("SELECT * FROM famille_contrib");
$list="";
foreach($options as $option)
{
$list=$list.'<option value="'.$option->nom_famille.'">'.$option->nom_famille.'</option>';
}

echo $list;
?>