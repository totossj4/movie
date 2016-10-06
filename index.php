<?php

require 'inc/config.php';

// Je récupère le paramètre section
$path = isset($_GET['path']) ? trim($_GET['path']) : 'home';

// Je supprime le / à la fin
if (substr($path, -1) == '/') {
	$path = substr($path, 0, strlen($path)-1);
}

// J'appelle les controllers en fonction de $path
if ($path == 'catalogue') {
	require 'inc/controller/catalogue.php';
}
else if (substr($path, 0, strlen('catalogue/')) == 'catalogue/')  {
	// On récupère l'ID
	$id = substr($path, strlen('catalogue/'));
	if (is_numeric($id)) {
		$_GET['id'] = $id;
	}

	require 'inc/controller/details.php';
}
else if ($path == 'home') {
	require 'inc/controller/home.php';
}
else {
	header("HTTP/1.0 404 Not Found", true, 404);
	echo '404 - '.$path. ' - '.substr($path, 0, strlen('catalogue/'));
	exit;
}