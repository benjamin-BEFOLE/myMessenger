<?php  

	// Ouverture d'une session  
	session_start();


	/**
	* Affiche la vue de la page de connexion
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
			if(isset($_POST['email']) && isset($_POST['password']))
			{
				checkForm();
			}

			else
			{
				$data = array(
					'head'		=> VIEW . DS . 'head.php',
					'header' 	=> VIEW . DS . 'header-icon-home.php',
					'content' 	=> VIEW . DS . 'connexion.php',
					'footer' 	=> '',
					);
				$view = generateView(VIEW . DS . 'template.php', $data);

				// Affichage de la vue
				echo $view;
			}
		}
	}

	/**
	* Contrôle le formulaire de connexion
	* @return void
	*/
	function checkForm() {
		// Email valide
		if(!checkIsEmail($_POST['email']))
		{
			// Mot de passe valide
			if(!checkIsPassword($_POST['password']))
			{
				// Chargement du modèle
				require_once MODEL . DS . 'user.php';

				$id = getUserIDWithEmail($_POST['email']);
				
				// Email présent dans la BDD
				if($id != NULL)
				{
					$password = getUserPassword($id);

					// Mot de passe corect
					if(strcmp($password,$_POST['password']) == 0)
					{
						// Création des variables de session utilisateur
						$_SESSION['id'] 		= $id;
						$_SESSION['userName'] 	= getUserName($id);
						$_SESSION['email'] 		= $_POST['email'];
						$_SESSION['password']	= $password;
						$_SESSION['avatar'] 	= getUserAvatar($id);

						// Redirection vers le profil utilisateur
						header('Location: ' . DS . 'myMessenger' . DS . 'Home');
					}

					// Mot de passe incorect
					else
					{
						unset($_POST['password']);
						index();
					}
				}

				// Email non présent dans la BDD
				else
				{
					unset($_POST['email']);
					unset($_POST['password']);
					index();
				}
			}

			// Mot de passe inalide
			else
			{
				unset($_POST['password']);
				index();
			}
		}

		// Email invalide
		else
		{
			unset($_POST['email']);
			unset($_POST['password']);
			index();
		}
	}
