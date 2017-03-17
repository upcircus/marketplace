
<?php


// Ne pas oublier d'inclure la libraire Form

include 'form.php';


// Création d'un objet Form.  // L'identifiant est obligatoire !

$mon_form = new Form('identifiant_unique');
$formfield = new Form_Text('titi',$mon_form);
echo $formfield;

$mon_form->add('text','toto')
	 ->placeholder('toto');
$mon_form->add('submit','valider')
	 ->add_class('btn btn-primary')
	 ->value('Go !');
echo $mon_form;
// Affichage du formulaire

