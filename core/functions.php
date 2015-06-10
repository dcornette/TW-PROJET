<?php 

	function debug($var) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
		die();
	}

	function sansDiacritiquesNiLigatures($s){
		$s1=str_replace("&","&amp;",$s);
		$entities=mb_convert_encoding($s1,"HTML-ENTITIES","UTF-8"); 
		$res = preg_replace(REG_CONV,'\1\2', $entities);
		return $res;
	} 

 ?>