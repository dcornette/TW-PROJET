<?php 
class Dispatcher {

	private $request;

	/**
	* Récupère les informations de l'url gràce à l'objet Request.
	* Parse cette url gràce au Router.
	* Charge le controller avec l'action voulu et rend la vue souhaitée automatiquement.
	*/
	public function __construct() {
		$this->request = new Request();
		Router::parse($this->request->url, $this->request);
		$controller = $this->loadController();
		if(!in_array($this->request->action, array_diff(get_class_methods($controller), 
			get_class_methods('Controller')))) {
			$this->error('Le controller '.$this->request->controller.' n\'a pas de méthode '.$this->request->action);
		}
		call_user_func_array(array($controller, $this->request->action), $this->request->params);
		$controller->render($this->request->action);
	}

	/**
	* Permet de gérer les pages introuvables
	*/
	public function error($message="Erreur 404") {
		$controller = new Controller($this->request);
		$controller->e404($message);
	}

	/**
	* Charge un controller et l'instancie
	* @return Controller() L'objet controller qui est chargé
	*/
	public function loadController() {
		$name = ucfirst($this->request->controller).'Controller';
		$file = ROOT.DS.'controller'.DS.$name.'.php';
		if(file_exists($file)) {
			require $file;
			$controller = new $name($this->request);	
			$controller->session = new Session();
			return $controller;
		}
		else {
			$this->request->controller = 'communes';
			require ROOT.DS.'controller'.DS.'CommunesController.php';
			return new CommunesController($this->request);			
		}

	}
}

 ?>