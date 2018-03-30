<?php

	// Ouverture d'une session  
	session_start();

	/**
	* Affiche la vue de la page "fonctionnalités"
	* @return void
	*/
	function index () {

		// Si les variables de session sont bien définies
		if(isset($_SESSION['id']) && isset($_SESSION['userName']) && isset($_SESSION['email'])
			&& isset($_SESSION['password']) && isset($_SESSION['avatar']))
		{
			// Redirection vers l'espace utilisateur
			header('Location: ' . DS . 'myMessenger' . DS . 'Home');
		}
		
		else 
		{
			$data = array(
				'head'		=> VIEW . DS . 'head-accueil.php',
				'header' 	=> VIEW . DS . 'header.php',
				'content' 	=> VIEW . DS . 'functionality.php',
				'footer' 	=> VIEW . DS . 'footer.php',
				);
			$view = generateView(VIEW . DS . 'template.php', $data);

			// Affichage de la vue
			echo $view;
		}
	}