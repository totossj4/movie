<?php

require 'inc/config.php';

// Je récupère le paramètre section
$section = isset($_GET['section']) ? trim($_GET['section']) : 'home';

// J'appelle les controllers en fonction de $section
if ($section == 'catalogue') {
	require 'inc/controller/catalogue.php';
}
else if ($section == 'details') {
	require 'inc/controller/details.php';
}
else if ($section == 'home') {
	require 'inc/controller/home.php';
}
else {
	header("HTTP/1.0 404 Not Found", true, 404);
	echo '404';
	exit;
}