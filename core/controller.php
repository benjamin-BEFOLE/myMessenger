<?php  
	// Définition des constantes  
	define("SIZE_MAX", 2097152);
	define("WIDTH_MAX", 200);
	define("HEIGHT_MAX", 200);


	/**
	* retourne un message non vide en cas d'erreur
	* @param string $chaine information à analyser
	* @return void
	*/
	function checkIsMot($chaine) {
		$pattern = '/^[a-zA-Z]+[a-zA-Z ]*$/';
		if (strlen($chaine) == 0)
			return '<span class="error-message th-warning">Veuillez bien renseigner ce champ</span>';

		if (!preg_match($pattern, $chaine))
			return '<span class="error-message th-warning">Ce champ ne doit contenir que des lettres</span>';
		
		return '';
	}

	/**
	* retourne un message non vide en cas d'erreur
	* @param string $chaine information à analyser
	* @return void
	*/
	function checkIsPassword($chaine) {
		$pattern = '/^[a-zA-z0-9]+$/';
		
		if (strlen($chaine) == 0)
			return '<span class="error-message th-warning">Veuillez bien renseigner ce champ</span>';

		if (strlen($chaine) < 6)
			return '<span class="error-message th-warning">Niveau de sécurité insuffisant</span>';

		if (!preg_match($pattern, $chaine))
			return '<span class="error-message th-warning">Ce champ ne doit contenir que des caractères alphanumériques</span>';
		
		return '';
	}

	/**
	* retourne un message non vide en cas d'erreur
	* @param string $chaine1 information à analyser
	* @param string $chaine2 information à analyser
	* @return void
	*/
	function checkNewPassword($chaine1, $chaine2) {
		if(strcmp($chaine1, $chaine2) != 0)
			return '<span class="error-message th-warning">Les mots de passe ne sont identiques</span>';
		else
			return checkIsPassword($chaine1);
	}

	/**
	* retourne un message non vide en cas d'erreur
	* @param string $chaine information à analyser
	* @return void
	*/
	function checkIsEmail($chaine) {
		$pattern = '/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/';

		if (strlen($chaine) == 0)
			return '<span class="error-message th-warning">Veuillez bien renseigner ce champ</span>';

		if (!preg_match($pattern, $chaine))
			return '<span class="error-message th-warning">Ce mail n\'est pas valide</span>';
		
		return '';
	}

	/**
	* retourne un message non vide en cas d'erreur
	* @param $info informations sur le fichier à analyser
	* @return void
	*/
	function checkAvatar($info) {
		$extensionsvalid = array('jpg', 'jpeg', 'png');
		if(in_array($info['extension'], $extensionsvalid))
		{
			if($info['size'] <= SIZE_MAX)
			{
				if($info['width'] >= WIDTH_MAX && $info['heigth'] >= HEIGHT_MAX) 
				{
					return '';
				}
				else
					return '<span class="error-message th-warning">taille min ' . WIDTH_MAX . '*' . HEIGHT_MAX . 'px</span>';
			}
			else
				return '<span class="error-message th-warning">poids max 2Mo</span>';
		}
		else
			return '<span class="error-message th-warning">mauvaise extension</span>';
	}
