<?php 
class Conf {

	static public $debug = 1;

	static public $databases = array(
		'default'	=> array(
			'host' 		=> 'localhost',
			'database'	=> 'projetTw',
			'login'		=> 'damien',
			'password'	=> 'mdp'
	));

	static public $file = "communes-infos.csv";
}

 ?>