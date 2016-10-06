<?php

namespace inc\model;

class Categorie {
	private $id;
	private $nom;
	private $nbFilms;

	public function __construct($id, $nom='', $nbFilms=0) {
		$this->id = $id;
		$this->nom = $nom;
		$this->nbFilms = $nbFilms;
	}

	public function getId() {
		return $this->id;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getNbFilms() {
		return $this->nbFilms;
	}

	public static function getById($id) {
		global $pdo;

		$sql = '
			SELECT cat_id, cat_nom
			FROM categorie
			WHERE cat_id = '.intval($id);
		$pdoStatement = $pdo->query($sql);

		if ($pdoStatement && $pdoStatement->rowCount() > 0) {
			$res = $pdoStatement->fetch();

			// Je crée l'objet
			$categorie = new Categorie($res['cat_id'], $res['cat_nom']);
			// Puis je le retourne
			return $categorie;
		}

		return false;
	}

	public static function getNbFilmsParCategorie() {
		global $pdo;

		$categorieList=array();
		$sql = '
			SELECT categorie.cat_id, cat_nom, count(*) as nb
			FROM categorie
			INNER JOIN film ON film.cat_id = categorie.cat_id
			GROUP BY categorie.cat_id, cat_nom
			ORDER BY nb DESC
			LIMIT 0,4
		';
		$pdoStatement = $pdo->query($sql);
		if ($pdoStatement && $pdoStatement->rowCount() > 0) {
			$categorieList = $pdoStatement->fetchAll();

			$returnList = array();
			foreach ($categorieList as $curCatInfos) {
				$curCategorie = new Categorie(
					$curCatInfos['cat_id'],
					$curCatInfos['cat_nom'],
					$curCatInfos['nb']
				);
				$returnList[] = $curCategorie;
			}
			return $returnList;
		}
		return false;
	}
}