<?php  
	/**
	* Renvoie une chaîne de caractères contenant la vue
	* @param string $fileName nom du fichier
	* @param array $data tableau contenant les données à charger dans la vue
	* @return string 
	*/
	function generateView($fileName, $data){
		// Extraction des données du tableau '$data'
		extract($data);
		
		// On inclut le fichier '$fileName' dont le résultat est placé
		// dans le tampon de sortie
		ob_start();
		require_once $fileName;
		return ob_get_clean();
	}
