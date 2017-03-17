<?php require 'inc/header_inc_new.php'; ?>

<section>    
<div class="container">

<h2 class="text-center">Qu'est ce que le réseau Upcircus ?</h2>

De l'auto-entrepreneur à la PME en passant par l'association, vous êtes toujours plus nombreux à être acteurs de l'économie circulaire en revalorisant des déchets. Faire partie du réseau Upcircus c'est adhérer aux points suivants : 
<br />
<h3 class="text-center col-lg-4">Promouvoir les acteurs de l'économie circulaire pour des utilisateurs réceptifs à leurs démarches.</h3><br />
	
<span class="col-lg-8">Les utilisateurs soucieux de l'avenir de leurs déchets sont déjà dans une démarche de revalorisation : Être membre du réseau Upcircus pour une entreprise de l'économie circulaire, c'est apparaître dans notre moteur de recherche comme une alternative aux déchetteries et aux filières de recyclage classiques. Par notre intermédiaire, le réseau d'acteurs de l'économie circulaire permet à chaque utilisateur d'en savoir plus sur les processus de revalorisation et d'y contribuer en tant que fournisseur de matière première ou en tant que client. </span>

<h3 class="text-center col-lg-4"><br />Tisser le réseau d'une nouvelle économie éthique et écologique. </h3><br />

<span class="col-lg-12">Parce que chacun génère une multitude de déchets, il est important de montrer les techniques et les solutions de revalorisation pour chacun de ces déchets générés. Parce que chaque acteur de l'économie circulaire est dans une démarche éthique de réduction de déchets et d'énergie, nous devons être rassemblés autour de cette cause commune. <br /><br /></span>

<h3 class="text-center col-lg-4">Faciliter la circulation de matières revalorisables entre les acteurs et les utilisateurs</h3><br />

<span class="col-lg-8"><br />Upcircus s'engage à faciliter l'échange de matières revalorisables en développant les outils adaptés aux entreprises et aux particuliers pour que leurs déchets deviennent vos matières premières. Tous ensemble, nous contribuons ainsi à l'économie circulaire en limitant les ressources et en privilégiant les circuits courts. </span>

<h3 class="text-center col-lg-4"><br />Garantir un critère de qualité pour les membres du réseau et leurs clients. </h3><br />

<span class="col-lg-12">Faire partie du réseau Upcircus, c'est aussi s'engager sur des valeurs partagées par d'autres entreprises et leurs clients. L'économie circulaire existe parce qu'elle est nécessaire et indispensable  : C'est à chacun d'y contribuer mais c'est ensemble que nous construisons l'avenir. <br /><br /></span><br /><br />

<h3 class="text-center col-lg-4">Offrir aux utilisateurs un ensemble de solutions issues de la revalorisation</h3><br />

<span class="col-lg-8"><br />Un réseau d'entreprises, c'est aussi être soudés face à des filières plus faciles d'accès pour l'utilisateur. Proposer un maximum d'alternatives aux utilisateurs, c'est faciliter leur démarche responsable, et garantir de pérennisation de l'emploi en France.  </span>
<span class="col-lg-12 text-center"><h3>Intéressé pour être membre ? Laissez nous vos coordonnées et nous vous contacterons, ça ne vous engage à rien ! </h3></span>
<span class="col-lg-12">
<form class="form-horizontal" role="form" action="" method="POST">

<label class="control-label">Nom de l'entreprise : </label>
<input type="text" name="nom_entreprise" class = "form-control">

<label class="control-label">Numéro de téléphone (pour vous contacter) : </label>
<input type="text" name="telephone" class = "form-control">

<label class="control-label">E-mail (pour vous contacter) : </label>
<input type="text" name="email" class = "form-control">

<label class="control-label">Site internet : </label>
<input type="text" name="URL" class = "form-control">

<label class="control-label">Quels sont les critères qui vous intéressent ?</label>
<textarea  class = "form-control" name="criteres"></textarea>

<label class="control-label">Autres remarques : </label>
<textarea  class = "form-control" name="remarques"></textarea>

<input type="submit" class="btn btn-primary" value="Envoyer" name="envoyer">
<?php
if(isset($_POST['envoyer']))
{
  $sentfrom=htmlentities($_POST['email']);
  $name=htmlentities($_POST['nom_entreprise']);
  $headers = 'From: '.$sentfrom.''."\r\n" .
     'Reply-To: '.$sentfrom.'' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
  mail('contact@upcircus.fr','Reseau Upcircus',
	$_POST['nom_entreprise']."\n".$_POST['telephone']."\n".$_POST['email']."\n".$_POST['URL']."\n".$_POST['criteres']."\n".$_POST['remarques']."\n",$headers);
	      
	echo 'Le formulaire a bien été envoyé';
}
?>
</form>
</span>
</div>
</section>
<?php require 'inc/pieddepage_inc_new.php'; ?>