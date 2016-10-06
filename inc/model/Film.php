<?php

namespace inc\model;

class Film {
	private $id;
	private $support;
	private $categorie;
	private $titre;
	private $filename;
	private $annee;
	private $affiche;
	private $synopsis;
	private $acteurs;
	private $description;
	public static $nbFilmsParPage = 4;

	public function __construct($id, $support, $categorie, $titre, $filename, $annee, $affiche, $synopsis, $acteurs, $description) {
		$this->id = $id;
		$this->support = $support;
		$this->categorie = $categorie;
		$this->titre = $titre;
		$this->filename = $filename;
		$this->annee = $annee;
		$this->affiche = $affiche;
		$this->synopsis = $synopsis;
		$this->acteurs = $acteurs;
		$this->description = $description;
	}

	public function getId() {
		return $this->id;
	}

	public function getSupport() {
		return $this->support;
	}

	public function getCategorie() {
		return $this->categorie;
	}

	public function getTitre() {
		return $this->titre;
	}

	public function getFilename() {
		return $this->filename;
	}

	public function getAnnee() {
		return $this->annee;
	}

	public function getAffiche() {
		return $this->affiche;
	}

	public function getSynopsis() {
		return $this->synopsis;
	}

	public function getActeurs() {
		return $this->acteurs;
	}

	public function getDescription() {
		return $this->description;
	}

	public static function getAll($categorieId=0, $searchTerms='', $offsetPage=0) {
		global $pdo;

		// J'écris ma requête dans une variable
		$sql = '
			SELECT fil_id, sup_id, cat_id, fil_titre, fil_filename,
			fil_affiche, fil_annee, fil_synopsis, fil_acteurs, fil_description
			FROM film
		';
		// Je teste que la query (q) n'est pas vide
		$rechercheEnCours = false;
		if (!empty($searchTerms)) {
			$rechercheEnCours = true;
			$sql .= '
				WHERE fil_titre LIKE :terms
				OR fil_synopsis LIKE :terms
				OR fil_acteurs LIKE :terms
			';
		}
		// Je teste que la catégorie est renseignée
		if ($categorieId > 0) {
			$sql .= '
				WHERE cat_id = '.intval($categorieId).'
			';
		}

		$sql .= '
			ORDER BY fil_id DESC
			LIMIT '.$offsetPage.', '.self::$nbFilmsParPage.'
		';
		// Je prépare ma requête à MySQL et je récupère le Statement
		$pdoStatement = $pdo->prepare($sql);
		if ($rechercheEnCours) {
			$pdoStatement->bindValue(':terms', '%'.$searchTerms.'%');
		}

		// Si la requête a fonctionnée
		if ($pdoStatement->execute()) {
			$filmList = $pdoStatement->fetchAll();

			$returnList = array();

			if (sizeof($filmList) > 0) {
				foreach ($filmList as $curFilmInfos) {
					// J'instancie le film
					$curFilm = new Film(
						$curFilmInfos['fil_id'],
						Support::getById($curFilmInfos['sup_id']),
						Categorie::getById($curFilmInfos['cat_id']),
						$curFilmInfos['fil_titre'],
						$curFilmInfos['fil_filename'],
						$curFilmInfos['fil_annee'],
						$curFilmInfos['fil_affiche'],
						$curFilmInfos['fil_synopsis'],
						$curFilmInfos['fil_acteurs'],
						$curFilmInfos['fil_description']
					);
					$returnList[] = $curFilm;
				}
			}

			return $returnList;
		}
	}

	public static function getById($id) {
		global $pdo;
		$sql = '
			SELECT fil_id, sup_id, cat_id, fil_titre, fil_filename, fil_affiche, fil_annee, fil_synopsis, fil_acteurs, fil_description
			FROM film
			WHERE fil_id = :filId';
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':filId', $id);

		if ($pdoStatement->execute()) {
			$filmInfos = $pdoStatement->fetch();

			if ($filmInfos !== false) {
				return new Film(
					$filmInfos['fil_id'],
					Support::getById($filmInfos['sup_id']),
					Categorie::getById($filmInfos['cat_id']),
					$filmInfos['fil_titre'],
					$filmInfos['fil_filename'],
					$filmInfos['fil_annee'],
					$filmInfos['fil_affiche'],
					$filmInfos['fil_synopsis'],
					$filmInfos['fil_acteurs'],
					$filmInfos['fil_description']
				);
			}
		}
		return false;
	}
}