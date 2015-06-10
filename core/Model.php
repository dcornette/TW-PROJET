<?php 

class Model {
	
	static $connections = array(); 	// Vérifie si la connection a déjà été faite
	public $conf = 'default';		// BDD par défault
	public $table = false;			// Contient le nom de la table
	public $file;					// Contient l'id du fichier
	public $db;						// Contient l'objet pdo (connection à la bdd)

	/**
	* Ouvre le fichier 'communes-infos.csv'
	*/
	/*public function __construct() {
		$conf = Conf::$file;
		if(isset(Model::$connections[$conf])) {
			$this->file = Model::$connections[$conf];
			return true;
		}
		$f = fopen($conf,"r") or die("Impossible d'ouvrir le fichier ".$conf." !");
		Model::$connections[$conf] = $f;
		$this->file = $f;
	}*/

	/**
	* Se connecte à la base de données PostgreSql
	*/
	public function __construct() {
		$conf = Conf::$databases[$this->conf];
		if(isset(Model::$connections[$this->conf])) {
			$this->db = Model::$connections[$this->conf];
			return true;
		}
		try {
			$pdo = new PDO('pgsql:host='.$conf['host'].';dbname='.$conf['database'].';',
				$conf['login'],$conf['password']);
			Model::$connections[$this->conf] = $pdo;
			$this->db = $pdo;
		}
		catch (PDOException $e) {
			if(Conf::$debug >= 1) {
				die($e->getMessage());
			}
			else {
				die('Impossible de se connecter à la base de données');
			}
		}
	}
}

 ?>