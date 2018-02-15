<?php 

	// Ouverture d'une session  
	session_start();

	/**
	* Affiche la vue de l'espace utilisateur
	* @return void
	*/
	function index() {
		// Si les variables de session sont bien définies
		if(isset($_SESSION['id']) && isset($_SESSION['userName']) && isset($_SESSION['email'])
			&& isset($_SESSION['password']) && isset($_SESSION['avatar']))
		{
			// Info avatar
			$nameAvatar = $_SESSION['avatar'];							
			$pathAvatar = CSS_AVATAR . $nameAvatar; 
			$infoAvatar = getimagesize(IMAGE . DS . 'avatar' . DS . $nameAvatar);

			$data = array(
				'head'				=> VIEW . DS . 'user' . DS . 'head-home.php',
				'header'			=> VIEW . DS . 'user' . DS . 'header-home.php',
				'pathAvatar' 		=> $pathAvatar,
				'classAvatar' 		=> ($infoAvatar[0] < $infoAvatar[1])?'mini-avatar-width':'mini-avatar-height',
				'discussion' 		=> VIEW . DS . 'user' . DS . 'discussion.php',
				'contact' 			=> VIEW . DS . 'user' . DS . 'contact.php',
				'newContact' 		=> VIEW . DS . 'user' . DS . 'new-contact.php',
				'discussionScreen' 	=> VIEW . DS . 'user' . DS . 'discussion-screen.php',
				'footer' 			=> VIEW . DS . 'user' . DS . 'footer-home.php',
				);
			$view = generateView(VIEW . DS . 'user' . DS . 'template.php', $data);

			// Affichage de la vue
			echo $view;
		}

		else
		{
			// Redirection vers la page de connexion
			header('Location: ' . DS . 'myMessenger' . DS . 'Connexion');
		}
	}