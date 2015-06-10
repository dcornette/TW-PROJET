<?php 
/*
	Projet réalisé par Damien Cornette
*/
class Commune extends Model {

	/**
	 * Permet de récupérer les communes ainsi que le nombre de communes trouvé.
	 * Le résultat retourné est un tableau d'objets
	 * @param $req Variable contenant toutes les informations nécéssaires
	 * à la construction de la requète SQL
	 * @param $cPage Définit la page courante dans la pagination
	 * @param $perPage Définit le nombre maximal de communes à retourner
	 * @return $pre->fetchAll(PDO::FETCH_OBJ) Un tableau d'objets
	 */
	public function find($req, $cPage=1, $perPage=15) {

		// Construction des champs
		if(isset($req['count'])) {
			$sql = 'SELECT COUNT(COM.nom) as count FROM communes AS COM';
		}
		else {
			$sql = 'SELECT COM.nom as nom_com, DEPT.nom as nom_dept, REG.nom as nom_reg,
			COM.population, COM.dept, COM.comm FROM communes AS COM';
		}

		// Construction des jointures
		if(isset($req['joins'])) {
			$sql .= " INNER JOIN regions AS REG ON COM.region = REG.code";
			$sql .= " INNER JOIN departements AS DEPT ON COM.dept = DEPT.code";	
		}

		// Construction de la condition
		if(isset($req['conditions']) && $req['conditions'] != false) {
			$sql .= ' WHERE ';
			if(!is_array($req['conditions'])) {
				$sql .= $req['conditions'];
			}
			else {
				$cond = array();
				foreach ($req['conditions'] as $k => $v) {
					if($k == 'population') {
						if(is_numeric($v['min'])) $cond[] = "COM.$k >= '".pg_escape_string($v['min'])."'";
						if(is_numeric($v['max'])) $cond[] = "COM.$k <= '".pg_escape_string($v['max'])."'";
					}
					elseif($k == 'region') {
						if(!empty($v)) $cond[] = "REG.code='".pg_escape_string($v)."'";
					}
					elseif($k == 'dept') {
						if(!empty($v)) $cond[] = "DEPT.code='".pg_escape_string($v)."'";
					}
					else {
						if(!empty($v)) $cond[] = "COM.$k='".pg_escape_string($v)."'";
					}
				}
				$sql .= implode(' AND ', $cond);
			}
		}

		// Limitation du nombre de communes à 'perPage' (ici 15)
		$sql .= " LIMIT $perPage OFFSET ".(($cPage-1)*$perPage);

		$pre = $this->db->prepare($sql);
		$pre->execute();
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Fonction utilisé pour la page 'détail'.
	 * Retourne un objet contenant les informations de la commune recherchée
	 * @param $name Le nom de la commune à rechercher
	 * @return $pre->fetch(PDO::FETCH_OBJ) La commune recherchée sous forme d'un objet
	 */
	public function findByName($name) {
		$sql = "SELECT COM.nom as nom_com, DEPT.nom as nom_dept, REG.nom as nom_reg,
		COM.dept, COM.population, COM.latitude, COM.longitude, COM.comm, COM.tncc, 
		COM.compl FROM communes AS COM";
		$sql .= " INNER JOIN departements AS DEPT ON COM.dept = DEPT.code";
		$sql .= " INNER JOIN regions AS REG ON COM.region = REG.code";
		$sql .= ' WHERE nom_ascii_maj=\''.pg_escape_string($name).'\'';
		$pre = $this->db->prepare($sql);
		$pre->execute();
		return $pre->fetch(PDO::FETCH_OBJ);
	}

	/**
	 * Retourne la liste des régions provenant de la table 'regions'
	 */
	public function findsRegions() {
		$sql = "SELECT * FROM regions ORDER BY code";
		$pre = $this->db->prepare($sql);
		$pre->execute();
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Retourne la liste des départements provenant de la table 'departements'
	 */
	public function findsDepartements() {
		$sql = "SELECT * FROM departements ORDER BY code";
		$pre = $this->db->prepare($sql);
		$pre->execute();
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}
}

 ?>