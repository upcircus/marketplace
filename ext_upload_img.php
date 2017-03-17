<?php
/*
Server-side PHP file upload code for HTML5 File Drag & Drop demonstration
Featured on SitePoint.com
Developed by Craig Buckler (@craigbuckler) of OptimalWorks.net
*/
$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);


if ($fn) {

	require 'inc/functions.php'; 
	$extension = substr(strrchr($fn,'.'),1);
	$nom_img = md5(uniqid(rand(), true)).'.'.$extension;
	//$uploadc = upload('img_princ','img/'.'img_princ'.'/'.$nom_img_princ,1048000, array('png','gif','jpg','jpeg') );  
	

	// AJAX call
	$path = 'img/dechets/';
	file_put_contents(
		$path. $nom_img,
		file_get_contents('php://input')
	);
	echo $nom_img;
	exit();
}
else {

	//form submit
	$files = $_FILES['fileselect'];

	foreach ($files['error'] as $id => $err) {
		if ($err == UPLOAD_ERR_OK) {
			$fn = $files['name'][$id];
			move_uploaded_file(
				$files['tmp_name'][$id],
				'uploads/' . $fn
			);
			echo "<p>File $fn uploaded.</p>";
		}
	}

}


