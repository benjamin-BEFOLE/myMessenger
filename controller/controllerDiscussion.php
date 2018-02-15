<?php 
	// Chargement bibliothèque PHP  
	require ROOT . DS . 'vendor' . DS . 'autoload.php';
	use ElephantIO\Client, ElephantIO\Engine\SocketIO\Version2X;

	// Ouverture d'une session  
	session_start();

	/**
	* Enregistre et envoie un message au serveur Node Js
	* @return void
	*/
	function sendMessage () {
		// Si les variables de session sont bien définies
		if(isset($_SESSION['id']) && isset($_SESSION['userName']) && isset($_SESSION['email'])
			&& isset($_SESSION['password']) && isset($_SESSION['avatar']))
		{
			if (isset($_POST['userName']))
			{
				$date = time();

				// Chargement des modèles
				require MODEL . DS . 'user.php';
				require MODEL . DS . 'discussion.php';

				// On stocke le message dans la BDD
				insertMessage($_SESSION['id'], getUserIDWithUsername($_POST['userName']), $_POST['message'], $date);

				$info = getimagesize(IMAGE . DS . 'avatar' . DS . $_SESSION['avatar']);
				$data = array(
					'emitter'	=> $_SESSION['userName'],
					'receiver'	=> $_POST['userName'],
					'path' 		=> CSS_AVATAR . $_SESSION['avatar'] . '?' . time(), 
					'class' 	=> ($info[0] < $info[1])?'mini-avatar-width':'mini-avatar-height',
					'message' 	=> $_POST['message'],
					'date' 		=> $date,
					'status' 	=> 0
				);

				// On envoie le message au serveur Node Js
				$client = new Client(new Version2X('http://localhost:8080'));
				$client ->initialize();
				$client ->emit('emitPHP', $data);
				$client ->close();

				echo json_encode($data);
			}
		}
	}

	/**
	* Envoie au client tous ses derniers messages
	* @return void
	*/
	function getLatestMessages () {
		// Si les variables de session sont bien définies
		if(isset($_SESSION['id']) && isset($_SESSION['userName']) && isset($_SESSION['email'])
			&& isset($_SESSION['password']) && isset($_SESSION['avatar']))
		{
			if (isset($_POST['motif']))
			{
				$tmp = array();
				$data = new ArrayObject();
				$result = new ArrayObject();

				// Chargement des modèles
				require MODEL . DS . 'user.php';
				require MODEL . DS . 'discussion.php';

				// Si $_POST['motif'] est vide
				if (strcmp($_POST['motif'], '') == 0)

					$data = getAllMessages($_SESSION['id']);

				// Si $_POST['motif'] est valide
				elseif (!checkIsMot($_POST['motif'])) 
					$data = getAllMessagesFromPattern($_SESSION['id'], $_POST['motif']);

				// On ne garde que les derniers messages reçus ou envoyé
				foreach ($data as $value)
				{
					if ($value['EMITTER_ID'] == $_SESSION['id'])
					{
						if (!in_array($value['RECEIVER_ID'], $tmp))
						{
							$userAvatar = getUserAvatar($value['RECEIVER_ID']);
							$info = getimagesize(IMAGE . DS . 'avatar' . DS . $userAvatar);
							array_push($tmp, $value['RECEIVER_ID']);
							$result->append(array(
												'emitter' 		=> $_SESSION['userName'], 
												'receiver' 		=> getUserName($value['RECEIVER_ID']), 
												'path' 			=> CSS_AVATAR . $userAvatar . '?' . time(), 
												'class' 		=> ($info[0] < $info[1])?'mini-avatar-width':'mini-avatar-height',
												'message' 		=> $value['MESSAGE'], 
												'date' 			=> $value['DATE_MSG'], 
												'status' 		=> $value['STATUS'], 
												'notification' 	=> getNotification($_SESSION['id'], $value['RECEIVER_ID'])
							));

							// var_dump(getNotification($_SESSION['id'], $value['RECEIVER_ID']));
							// echo $value['RECEIVER_ID'];
						}
					}

					else
					{
						if (!in_array($value['EMITTER_ID'], $tmp))
						{
							$userAvatar = getUserAvatar($value['EMITTER_ID']);
							$info = getimagesize(IMAGE . DS . 'avatar' . DS . $userAvatar);
							array_push($tmp, $value['EMITTER_ID']);
							$result->append(array(
												'emitter' 		=> getUserName($value['EMITTER_ID']), 
												'receiver' 		=> $_SESSION['userName'], 
												'path' 			=> CSS_AVATAR . $userAvatar . '?' . time(), 
												'class' 		=> ($info[0] < $info[1])?'mini-avatar-width':'mini-avatar-height',
												'message' 		=> $value['MESSAGE'], 
												'date' 			=> $value['DATE_MSG'], 
												'status' 		=> $value['STATUS'], 
												'notification' 	=> getNotification($_SESSION['id'], $value['EMITTER_ID'])
							));
						}
					}
				}

				echo json_encode($result);
			}
		}
	}


	/**
	* Envoie au client tous ses discussions avec un de ses contacts
	* @return void
	*/
	function getDiscussion () {
		// Si les variables de session sont bien définies
		if(isset($_SESSION['id']) && isset($_SESSION['userName']) && isset($_SESSION['email'])
			&& isset($_SESSION['password']) && isset($_SESSION['avatar']))
		{
			// Si $_POST['contact'] existe et est valide
			if (isset($_POST['contact']) && !checkIsMot($_POST['contact']))
			{
				$tmp = array();
				$data = new ArrayObject();
				$result = new ArrayObject();

				// Chargement des modèles
				require MODEL . DS . 'user.php';
				require MODEL . DS . 'discussion.php';

				$data = getAllMessagesFromContact($_SESSION['id'], $_POST['contact']);

				// On formate $data
				foreach ($data as $value)
				{
					$result->append(array(
										'emitter' 	=> getUserName($value['EMITTER_ID']), 
										'receiver' 	=> getUserName($value['RECEIVER_ID']), 
										'message' 	=> $value['MESSAGE'], 
										'date' 		=> $value['DATE_MSG'], 
										'status' 	=> $value['STATUS'], 
					));
				}

				echo json_encode($result);
			}
		}
	}

	/**
	* Met à jour le statut des messages reçus
	* @return void
	*/
	function updateMsgNonLu ()
	{
		// Si les variables de session sont bien définies
		if(isset($_SESSION['id']) && isset($_SESSION['userName']) && isset($_SESSION['email'])
			&& isset($_SESSION['password']) && isset($_SESSION['avatar']))
		{
			// Si $_POST['contact'] existe et est valide
			if (isset($_POST['contact']) && !checkIsMot($_POST['contact']))
			{
				// Chargement des modèles
				require MODEL . DS . 'user.php';
				require MODEL . DS . 'discussion.php';

				updateStatus($_SESSION['id'], getUserIDWithUsername($_POST['contact']), $_POST['date']);
			}
		}
	}