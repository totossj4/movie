<?php

use inc\model\film;

$currentId = 0;
// Je récupère le paramètre d'URL "page" de type integer
if (isset($_GET['id'])) {
	$currentId = intval($_GET['id']);
}

// J'appelle ma méthode du modèle
$filmObject = Film::getById($currentId);

// Appels des vues
require 'inc/view/html/header.php';
if (is_object($filmObject)) {
	require 'inc/view/details.php';
}
else {
	echo 'ID non reconnu<br />';
}
require 'inc/view/html/footer.php';