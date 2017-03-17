<?php 

$user=isset($_SESSION['auth']->username) ? $_SESSION['auth']->username : false;
if($user)
{
  if($_SESSION['auth']->status!=="moderateur")
    {
      header('location:index.php');
      exit();
    }
}