<?php 
class Request {

	public $url; 			// URL appellé par l'utilisateur
	public $cPage = 1; 		// Contient la page courante pour la liste de communes
	public $data = false;	// Contient les données du formulaire de recherche sous forme d'objet

	public function __construct() {

		$is_not_index = substr_count($_SERVER['PHP_SELF'],BASE_URL.DS.'webroot'.DS.'index.php'.DS);

		// Obtention d'une url de la forme 'controller/action?p=numero'
		if($is_not_index)
			$req = str_replace(BASE_URL.DS.'webroot'.DS.'index.php'.DS, "", $_SERVER['PHP_SELF']);
		else
			$req = str_replace(BASE_URL.DS.'webroot'.DS.'index.php', "", $_SERVER['PHP_SELF']);

		// On supprime le '?p=numero' après l'action
		$expr = preg_replace('/([a-zA-Z]+)((\/[a-zA-Z0-9-àáâãäåçèéêëìíîïðòóôõöùúûüýÿÂÁÀÅÃœŒæÆÇÉÈÊËÎÏÔÙÚÛÜ\' ]+)*)?(.*)/',
		 '$1$2', $req); 

		// Equivalent à $_SERVER['PATH_INFO']
		$this->url = $expr; 

		// Teste si la variable 'p' dans l'url existe
		if(isset($_GET['p']) && is_numeric($_GET['p'])) {
			if($_GET['p'] > 0) $this->cPage = round($_GET['p']);
		}

		// Teste si on a reçu des données du formulaire
		if(!empty($_POST)) {
			$this->data = new stdClass();
			foreach ($_POST as $k => $v) {
				$this->data->$k = $v;
			}
		}
	}
}

 ?>