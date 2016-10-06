<?php

use inc\model\Film;

// Page par défaut => 1
$currentPage = 1;
$searchTerms = '';
$categorieId = 0;
$offsetPage = 0;
// Je récupère le paramètre d'URL "page" de type integer
if (isset($_GET['page'])) {
	$currentPage = intval($_GET['page']);
	$offsetPage = ($currentPage-1)*Film::$nbFilmsParPage;
}

// Je récupère le paramètre d'URL "q"
if (isset($_GET['q'])) {
	$searchTerms = strip_tags(trim($_GET['q']));
}
// Je récupère le paramètre d'URL "cat_id"
if (isset($_GET['cat_id'])) {
	$categorieId = intval(trim($_GET['cat_id']));
}
// On va appeler la méthode getAll
$filmList = Film::getAll($categorieId, $searchTerms, $offsetPage);
//print_pre($filmList);

$pageTitle = 'Catalogue';

// J'appelle la vue
require 'inc/view/html/header.php';
require 'inc/view/catalogue.php';
require 'inc/view/html/footer.php';