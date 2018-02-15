<?php 

	// Ouverture d'une session  
	session_start();


	/**
	* Trouve un nouveau contact
	* @return void
	*/
	function findNewContact () {
		// Si $_POST['motif'] est valide
		if (!checkIsMot($_POST['motif']))
		{
			// Chargement des modèles
			require MODEL . DS . 'user.php';
			require MODEL . DS . 'contact.php';

			$result = new ArrayObject();
			$data = getUserData($_POST['motif']);

			foreach ($data as $value) {
				$info = getimagesize(IMAGE . DS . 'avatar' . DS . $value['USER_AVATAR']);
				
				if ($value['USER_ID'] != $_SESSION['id'] &&
					!testContact($_SESSION['id'], $value['USER_ID'])) 
				{
					$result->append(array(
										'userName' 	=> $value['USER_NAME'],
										'path' 		=> CSS_AVATAR . $value['USER_AVATAR'] . '?' . time(),
										'class' 	=> ($info[0] < $info[1])?'mini-avatar-width':'mini-avatar-height',
					));
				}
			}

			echo json_encode($result);
		}

		// $_POST['motif'] est invalide
		else
			echo json_encode(array());
	}


	/**
	* Trouve un nouveau contact
	* @return void
	*/
	function findContact () {
		$result = new ArrayObject();
		$data = new ArrayObject();
		// Chargement des modèles
		// require MODEL . DS . 'user.php';
		require MODEL . DS . 'contact.php';

		// Si $_POST['motif'] est vide
		if (strcmp($_POST['motif'], '') == 0)
			$data = getAllContact($_SESSION['id']);

		// Si $_POST['motif'] est valide
		elseif (!checkIsMot($_POST['motif'])) 
			$data = getContact($_SESSION['id'], $_POST['motif']);

		// On formate $data
		foreach ($data as $value) {
			$info = getimagesize(IMAGE . DS . 'avatar' . DS . $value['USER_AVATAR']);
			
			$result->append(array(
								'userName' 	=> $value['USER_NAME'],
								'path' 		=> CSS_AVATAR . $value['USER_AVATAR'] . '?' . time(),
								'class' 	=> ($info[0] < $info[1])?'mini-avatar-width':'mini-avatar-height',
			));
		}

		echo json_encode($result);
	}


	/**
	* Ajoute un nouveau contact
	* @return void
	*/
	function addContact () {
		// $_POST['motif'] est valide
		if (!checkIsMot($_POST['userName']))
		{
			// Chargement des modèles
			require MODEL . DS . 'user.php';
			require MODEL . DS . 'contact.php';
			
			$idContact = getUserIDWithUsername($_POST['userName']);

			// Insertion d'un nouveau contact
			insertContact($_SESSION['id'], $idContact);
		}
	}