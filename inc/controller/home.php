<?php

use inc\model\Categorie;

// Je récupère les données du model
$categorieList = Categorie::getNbFilmsParCategorie();

// J'appelle les vues
require 'inc/view/html/header.php';
require 'inc/view/home.php';
require 'inc/view/html/footer.php';