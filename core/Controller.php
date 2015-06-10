<?php 
class Controller {

	public $request;			// Objet Request
	public $layout = 'default';	// Layout à utiliser pour rendre la vue
	private $vars = array();	// Variables à passer à la vue
	private $rendered = false;	// Si le rendu a été fait ou pas ?

	public function __construct($request) {
		$this->request = $request;
	}

	/**
	* Permet de rendre une vue
	* @param $view Fichier à rendre (chemin depuis view ou nom de la vue)
	*/
	public function render($view) {
		if($this->rendered) return false;
		
		extract($this->vars);
		if(strpos($view, '/') === 0) {
			$view = ROOT.DS.'view'.$view.'.php';
		}
		else {
			$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
		}
		ob_start();
		require($view);
		$content_for_layout = ob_get_clean();
		require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
		$this->rendered = true;
	}

	/**
	* Permet de passer une ou plusieurs variables à la vue
	* @param $key nom de la variable OU le tableau de variables
	* @param $value Valeur de la variable
	*/
	public function setVars($key, $value=null) {
		if(is_array($key)) {
			$this->vars += $key;
		}
		else $this->vars[$key] = $value;
	}

	/**
	* Permet de charger un Model
	* @param $name Le nom du Model à charger
	*/
	public function loadModel($name) {
		$file = ROOT.DS.'model'.DS.$name.'.php';
		require_once($file);
		if(!isset($this->$name)) $this->$name = new $name();
	}

	/**
	* Permet de gérer les erreurs 404
	*/
	public function e404($message) {
		header("HTTP/1.0 404 Not Found");
		$this->setVars('message', $message);
		$this->render('/errors/404');
		die();
	}
}

 ?>