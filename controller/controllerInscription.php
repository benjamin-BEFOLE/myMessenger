<?php  
	// Ouverture d'une session  
	session_start();


	/**
	* Affiche la vue de la page d'inscription
	* @return void
	*/
	function index() {
		if(isset($_SESSION['id']) && isset($_SESSION['userName']) && isset($_SESSION['email'])
			&& isset($_SESSION['password']) && isset($_SESSION['avatar']))
		{
			// Redirection vers l'espace utilisateur
			header('Location: ' . DS . 'myMessenger' . DS . 'Home');
		}

		else
		{
			// L'utilisateur a soumis un formulaire
			if(isset($_POST['email']) || isset($_POST['userName']) || isset($_POST['password']))
				checkForm();

			// L'utilisateur n'a soumis aucun formulaire
			else
			{
				$data = array(
					'head'		=> VIEW . DS . 'head.php',
					'header' 	=> VIEW . DS . 'header-icon-home.php',
					'content' 	=> VIEW . DS . 'inscription.php',
					'footer' 	=> VIEW . DS . 'footer.php'
					);
				$view = generateView(VIEW . DS . 'template.php', $data);

				// Affichage de la vue
				echo $view;
			}
		}
	}

	/**
	* Affiche la vue d'erreur de la page d'inscription
	* @return void
	*/
	function indexError($emailError, $userNameError, $passwordError) {
		// $head = file_get_contents(VIEW . DS . 'head.php');
		// $header = file_get_contents(VIEW . DS . 'header-icon-home.php');
		// $content = file_get_contents(VIEW . DS . 'inscriptionError.php');

		$data = array(
			'head'				=> VIEW . DS . 'head.php',
			'header' 			=> VIEW . DS . 'header-icon-home.php',
			'content' 			=> VIEW . DS . 'inscriptionError.php',
			'emailError' 		=> $emailError,
			'userNameError' 	=> $userNameError,
			'passwordError' 	=> $passwordError,
			'footer' 			=>  VIEW . DS . 'footer.php'
			);
		$view = generateView(VIEW . DS . 'template.php', $data);

		// Affichage de la vue
		echo $view;
	}

	/**
	* Contrôle le formulaire d'inscription
	* @return void
	*/
	function checkForm() {
		$fields = array(
			'email' 	=> 	array(
								'fct_test' 		=> 'checkIsEmail', 
								'emailError'	=> '',
							),
			'userName' 	=>	array(
								'fct_test' 		=> 'checkIsMot', 
								'userNameError' => '',
							), 
			'password' 	=> 	array(
								'fct_test' 		=> 'checkIsPassword', 
								'passwordError' => '',
							)
		);

		$formIsValid = TRUE;

		// On teste si les informations entrées par l'utilisateur sont correctes
		foreach ($fields as $key => $value) {
			$fields[ $key ][ $key . 'Error' ] = $value[ 'fct_test' ]($_POST[$key]);
			$formIsValid = ($formIsValid && !$fields[ $key ][ $key . 'Error' ]);
		}

		// Si toutes les informations entrées sont correctes, on redirige l'utilisateur 
		// vers son profil 

		// $formIsValid = TRUE;
		
		if($formIsValid){
			$userName 	= $_POST['userName'];
			$email 		= $_POST['email'];
			$password 	= $_POST['password'];
			$avatar 	= 'default.png';

			// Chargement du modèle
			require MODEL . DS . 'user.php';

			// Si $userName ou $email est déjà dans la BDD
			$idFromUsername = getUserIDWithUsername($userName);
			$idFromEmail = getUserIDWithEmail($email);
			if($idFromUsername != NULL || $idFromEmail != NULL)
			{
				$userNameError = ($idFromUsername == NULL)?'':'<span class="error-message th-warning">Ce nom est déjà utilisé</span>';
				$emailError = ($idFromEmail == NULL)?'':'<span class="error-message th-warning">Cet email est déjà utilisé</span>';
				indexError($emailError, $userNameError, '');
			}

			// Si $userName et $email ne sont pas dans la BDD
			else
			{
				// Insertion des données dans la BDD
				insertDataUser($userName, $email, $password);
				$id = getUserIDWithEmail($email);
				setUserAvatar($id, $avatar);

				// Ouverture d'une session utilisateur
				session_start();
				$_SESSION['id'] 		= $id;
				$_SESSION['userName'] 	= $userName;
				$_SESSION['email'] 		= $email;
				$_SESSION['password'] 	= $password;
				$_SESSION['avatar'] 	= $avatar;

				// Redirection vers le profil utilisateur
				header('Location: ' . DS . 'myMessenger' . DS . 'Profil');
			}
		}

		// S'il y a une information incorrecte, on affiche à l'utilisateur la 
		// page d'erreur
		else {
			indexError(
				$fields[ 'email' ][ 'emailError' ], 
				$fields[ 'userName' ][ 'userNameError' ], 
				$fields[ 'password' ][ 'passwordError' ]
			);
		}
	}  



