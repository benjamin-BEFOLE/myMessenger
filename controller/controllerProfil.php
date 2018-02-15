<?php  

	// Ouverture d'une session  
	session_start();
	
	/**
	* Affiche la vue de la page d'inscription
	* @return void
	*/
	function index() {
		// Si les variables de session sont bien définies
		if(isset($_SESSION['id']) && isset($_SESSION['userName']) && isset($_SESSION['email'])
			&& isset($_SESSION['password']) && isset($_SESSION['avatar']))
		{
			$userName = $_SESSION['userName'];
			
			// Info avatar
			$name = $_SESSION['avatar'];							
			$path = CSS_AVATAR . $name; 
			$info = getimagesize(IMAGE . DS . 'avatar' . DS . $name);
			
			$data = array(
				'head'		=> VIEW . DS . 'user' . DS . 'head-profil.php',
				'header' 	=> VIEW . DS . 'user' . DS . 'header.php',
				'content' 	=> VIEW . DS . 'user' . DS . 'profil.php',
				'path' 		=> $path,
				'class' 	=> ($info[0] < $info[1])?'profil-img-width':'profil-img-height',
				'footer' 	=> ''
				);

			$view = generateView(VIEW . DS . 'template.php', $data);

			// Affichage de la vue
			echo $view;
		}

		else
		{
			// Redirection vers la page de connexion
			header('Location: ' . DS . 'myMessenger' . DS . 'Connexion');
		}
	}


	/**
	* Supprime et remplace la photo de profil par celle par défaut
	* @return void
	*/
	function delete () {
		$name = 'default.png';

		if(strcmp($_SESSION['avatar'], $name) != 0)
		{
			$path = CSS_AVATAR . DS . $name . '?' . time();		// chemin du fichier par défaut
			$pathWithoutExtension = IMAGE . DS . 'avatar' . DS . $_SESSION['id'] . '.';	

			// Suppression des fichiers existants
			@unlink($pathWithoutExtension . 'jpg');
			@unlink($pathWithoutExtension . 'jpeg');
			@unlink($pathWithoutExtension . 'png');

			// Modification session  
			$_SESSION['avatar'] = $name;

			// Chargement du modèle
			require MODEL . DS . 'user.php';
				// On stocke l'image dans la BDD
				setUserAvatar($_SESSION['id'], $name);

			// Envoi du chemin
			echo $path;
		}

		else
			echo '';
	}


	/**
	* Vérifie et modifie la photo de profil 
	* @return void
	*/
	function avatar() {
		$widthAndHeight = getimagesize($_FILES['image']['tmp_name']);

		$info = array(
			'extension' => strtolower(substr(strrchr($_FILES['image']['name'], '.'),1)), 
			'size' 		=> $_FILES['image']['size'], 
			'width' 	=> $widthAndHeight[0], 
			'heigth' 	=> $widthAndHeight[1]
		);

		$avatarIsValid = checkAvatar($info);

		// L'image reçue est valide
		if(!$avatarIsValid)
		{
			$newName = $_SESSION['id'] . '.' . $info['extension'];		// fichier temporaire
			$path = IMAGE . DS . 'avatar' . DS . $newName;				// chemin associé à $newName
			$pathWithoutExtension = IMAGE . DS . 'avatar' . DS . $_SESSION['id'] . '.';	

			// Suppression des fichiers existants
			@unlink($pathWithoutExtension . 'jpg');
			@unlink($pathWithoutExtension . 'jpeg');
			@unlink($pathWithoutExtension . 'png');

			// On déplace le fichier
			move_uploaded_file($_FILES['image']['tmp_name'], $path);

			// Chargement du modèle
			require MODEL . DS . 'user.php';
				// On stocke l'image dans la BDD
				setUserAvatar($_SESSION['id'], $newName);

			// Modification variable de session
			$_SESSION['avatar'] = $newName;


			// Informations concernant le fichier temporaire
			$data = array(
				'path' 		=> CSS_AVATAR . DS . $newName . '?' . time(),
				'width' 	=> $widthAndHeight[0],
				'heigth'	=> $widthAndHeight[1]
			);

			// "Envoi" de $dataJSON au navigateur
			echo json_encode($data, JSON_FORCE_OBJECT);	
		}
		// L'image reçue n'est pas valide
		else
		{
			http_response_code(500);
			echo $avatarIsValid;
		}
	}


	/**
	* Contrôle le formulaire des données utilisateur
	* @return void
	*/
	function checkForm() {
		$userNameError 	= checkIsMot($_POST['userName']);
		$emailError 	= checkIsEmail($_POST['email']);

		if(isset($_POST['password1']) && isset($_POST['password2']))
			$passwordError = checkNewPassword($_POST['password1'], $_POST['password2']);
		else
			$passwordError = '';

		// Si $userName ou $email est déjà dans la BDD
		if(!$userNameError && !$emailError)
		{
			// Chargement du modèle
			require_once MODEL . DS . 'user.php';

			if(strcmp($_POST['userName'], $_SESSION['userName']) != 0)
			{
				$idFromUsername = getUserIDWithUsername($_POST['userName']);
				$userNameError = ($idFromUsername == NULL)?'':'<span class="error-message th-warning">Ce nom est déjà utilisé</span>';
			}

			if(strcmp($_POST['email'], $_SESSION['email']) != 0)
			{
				$idFromEmail = getUserIDWithEmail($_POST['email']);
				$emailError = ($idFromEmail == NULL)?'':'<span class="error-message th-warning">Cet email est déjà utilisé</span>';
			}
		}

		if(!$userNameError && !$emailError && !$passwordError)
		{
			// Chargement du modèle
			require_once MODEL . DS . 'user.php';

			// Mise à jour de la BDD
			setUserName($_SESSION['id'], $_POST['userName']);
			setEmail($_SESSION['id'], $_POST['email']);

			// Mise à jour des variables de session
			$_SESSION['userName'] 	= $_POST['userName'];
			$_SESSION['email'] 		= $_POST['email'];

			// Mise à jour du mot de passe s'il a été changé
			if(isset($_POST['password1']) && isset($_POST['password2']))
			{
				setPassword($_SESSION['id'], $_POST['password1']);
				$_SESSION['password'] = $_POST['password1'];
			}
		}
		else
		{
			http_response_code(500);
			// Informations concernant les erreurs
			$data = array(
				'userNameError' => $userNameError,
				'emailError' 	=> $emailError,
				'passwordError'	=> $passwordError
			);

			// Envoi de $dataJSON au navigateur
			echo json_encode($data, JSON_FORCE_OBJECT);	
		}
	}		
