<?php 
/*
	Projet réalisé par Damien Cornette
*/
class CommunesController extends Controller {

/*
	Chaque méthode de ce fichier est directement liée à une vue (dossier view)
	portant le même nom.
	On initialise dans ces méthodes toutes les variables utile pour la vue.
*/

	/**
	 * Cette méthode est vide mais est quand même indispensable 
	 * pour instancier la vue 'index.php'
	 */
	public function index() {

	}

	public function recherche() {
		$this->loadModel('Commune');
		$vars['regions'] = $this->Commune->findsRegions();
		$vars['departements'] = $this->Commune->findsDepartements();
		$this->setVars($vars);
	}

	public function liste() {
		$perPage = 15;

		// Chargement du modèle 'Commune'
		$this->loadModel('Commune');

		// Enregistrement des donnés du formulaire dans une variable de session
		if($this->request->data) {
			$this->session->setData($this->request->data);
		} 

		// Récupération des donnés du formulaire
		$data = $this->session->data();

		//debug($data);

		// Affectation des conditions (si il y en a)
		if (!empty($data)) {
			if(!empty($data->dept) || !empty($data->region) || !empty($data->min)
				|| !empty($data->max) || is_numeric($data->min) || is_numeric($data->max)) {
				$cond = array( 
					'dept' 				=> $data->dept,
					'population'		=> array('min' => $data->min, 
												'max'  => $data->max),
					'region'			=> $data->region );
			}
		}
		else {
			$cond = false;
		}

		// Liste des communes (maximum 15)
		$vars['communes'] = $this->Commune->find(array(
			'conditions' 	=> $cond,
			'joins'			=> true
		), $this->request->cPage, $perPage);

		// Nombre de communes trouvées
		$vars['nbCommunes'] = current($this->Commune->find(array(
			'count'			=> true,
			'conditions' 	=> $cond,
			'joins'			=> true
		)))->count;


		$vars['debut'] = ($this->request->cPage-1)*$perPage;
		if($vars['nbCommunes'] - $vars['debut'] >= $perPage) {
			$vars['fin'] = $vars['debut'] + $perPage;
		}
		else {
			$vars['fin'] = $vars['debut'] + ($vars['nbCommunes'] - $vars['debut']);
		}
		$vars['nbPages'] = ceil($vars['nbCommunes']/$perPage);
		$this->setVars($vars);
	}

	public function detail($name="", $action="") {
		if($this->request->data) {
			$name = mb_strtoupper(sansDiacritiquesNiLigatures($this->request->data->nom));
		}
		else {
			$name = mb_strtoupper(sansDiacritiquesNiLigatures($name));
		}
		$this->loadModel('Commune');
		$vars['detail'] = $this->Commune->findByName($name);
		if(empty($vars['detail'])) {
			$this->e404("La commune $name n'existe pas");
		}else {
			if($action == 'add') {
				$this->session->addFavoris($vars['detail']);
			}			
		}
		$this->setVars($vars);
	}

	/**
	 * Pour les favoris on ne va pas chercher des informations dans la bdd
	 * mais dans les variables de SESSION.
	 * Pour se faire, on s'aide de méthodes dans le fichier 'core/Session.php'
	 */
	public function favoris($action="", $id=null) {
		if($action == 'delete' && isset($id) && is_numeric($id)) {
			$this->session->deleteFavoris($id);
			$this->session->setFlash('Le favoris a bien été supprimé');
		}
		$perPage = 15;
		$vars['favoris'] = $this->session->favoris();
		$vars['nbFavoris'] = count($vars['favoris']);
		$vars['debut'] = ($this->request->cPage-1)*$perPage;
		if($vars['nbFavoris'] - $vars['debut'] >= $perPage) {
			$vars['fin'] = $vars['debut'] + $perPage;
		}
		else {
			$vars['fin'] = $vars['debut'] + ($vars['nbFavoris'] - $vars['debut']);
		}
		$vars['nbPages'] = ceil($vars['nbFavoris']/$perPage);
		$this->setVars($vars);
	}
}

 ?>