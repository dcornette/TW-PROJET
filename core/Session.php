<?php 
class Session {

	public function __construct() {
		if(!isset($_SESSION)) {
			session_start();
		}
	}

	/**
	* Permet de sauvegarder les données du formulaire
	* dans une variable de session.
	* @param $data Les données à sauvegarder
	*/
	public function setData($data) {
		$_SESSION['data'] = $data;
	}

	/**
	* Permet la récupération des données
	* @return $_SESSION['data'] Les données du formulaire sauvegardées
	*/
	public function data() {
		if(isset($_SESSION['data'])) {
			return $_SESSION['data'];		
		}
	}

	/**
	* Permet l'ajout d'un favoris dans la liste
	* @param $favoris Le favoris à ajouter sous forme d'un objet
	*/
	public function addFavoris($favoris) {
		if(isset($_SESSION['favoris'])) {
			if(array_search($favoris, $_SESSION['favoris']) === false) {
				$i = count($_SESSION['favoris']);
				$_SESSION['favoris'][$i] = $favoris;
				$this->setFlash('La commune a bien été ajouté à vos favoris.');
			}
			else {
				$this->setFlash('La commune est déjà dans vos favoris.', 'info');
			}
		}else {
			$_SESSION['favoris'][0] = $favoris;
			$this->setFlash('La commune a bien été ajouté à vos favoris.');
		}
	}

	/**
	* Permet de supprimer un favoris de la liste
	* @param $id L'identifiant du favoris dans la liste
	*/
	public function deleteFavoris($id) {
		unset($_SESSION['favoris'][$id]);
		$_SESSION['favoris'] = array_merge($_SESSION['favoris']);
	}

	/**
	* Retourne la liste des favoris
	* @return $_SESSION['favoris']
	*/
	public function favoris() {
		if(isset($_SESSION['favoris'])) {
			return $_SESSION['favoris'];
		}
	}

	/**
	* Permet de définir un message d'alerte en précisant le type
	* du message
	* @param $message Le message à afficher
	* @param $type Le type du message que l'on souhaite afficher
	*/
	public function setFlash($message,$type='success') {
		$_SESSION['flash'] = array(
			'message' 	=> $message,
			'type'		=> $type
		);
	}

	/**
	* Permet d'avertir l'utilisateur d'une action effectué en 
	* affichant un message d'alerte.
	* @return alerte Le message d'alerte sous forme html
	*/
	public function flash() {
		if(isset($_SESSION['flash']['message'])) {
			$html = '<div class="alert alert-'.$_SESSION['flash']['type'].'">  
  						<a class="close" data-dismiss="alert">×</a>  
  						'.$_SESSION['flash']['message'].' 
					</div>';  
			$_SESSION['flash'] = array();
			return $html;
		}
	}
}

 ?>