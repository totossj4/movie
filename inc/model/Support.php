<?php

namespace inc\model;

class Support {
	private $id;
	private $nom;

	public function __construct($id, $nom) {
		$this->id = $id;
		$this->nom = $nom;
	}

	public function getId() {
		return $this->id;
	}

	public function getNom() {
		return $this->nom;
	}

	public static function getById($id) {
		global $pdo;

		$sql = '
			SELECT sup_id, sup_nom
			FROM support
			WHERE sup_id = '.intval($id);
		$pdoStatement = $pdo->query($sql);

		if ($pdoStatement && $pdoStatement->rowCount() > 0) {
			$res = $pdoStatement->fetch();

			// Je crée l'objet
			$categorie = new Support($res['sup_id'], $res['sup_nom']);
			// Puis je le retourne
			return $categorie;
		}

		return false;
	}
}