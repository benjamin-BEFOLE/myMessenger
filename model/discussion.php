<?php  
	
	/**
	* Insère dans la table DISCUSSION un nouveau message
	* @return void
	*/
	function insertMessage ($emitterID, $receiverID, $message, $date) {
		$bdd = getBdd();

		$req = $bdd->prepare('INSERT INTO DISCUSSION(EMITTER_ID, RECEIVER_ID, MESSAGE, DATE_MSG, STATUS)'
			. ' VALUES(:emitterID, :receiverID, :message, :date, :status)');

		$req->execute(array(
			'emitterID'		=> $emitterID,
			'receiverID' 	=> $receiverID,
			'message' 		=> $message,
			'date' 			=> $date,
			'status' 		=> 0
			));
	}

	/**
	* Retourne tous les messages d'un utilisateur 
	* @return ArrayObject
	*/
	function getAllMessages($userID) {
		$result = new ArrayObject();
		$bdd = getBdd();

		$req = $bdd->prepare('SELECT * FROM DISCUSSION WHERE EMITTER_ID = ? OR RECEIVER_ID = ? ORDER BY DATE_MSG DESC');

		$req->execute(array($userID, $userID));

		while($data = $req->fetch())
			$result->append($data);

		$req->closeCursor();

		return $result;
	}

	/**
	* Retourne tous les messages d'un utilisateur à partir d'un motif
	* @return ArrayObject
	*/
	function getAllMessagesFromPattern($userID, $motif) {
		$result = new ArrayObject();
		$bdd = getBdd();

		$req = $bdd->prepare(
			'SELECT D.* FROM DISCUSSION D ' .
			'JOIN USERS U1 ' .
			'ON U1.USER_ID = D.EMITTER_ID ' .
			'JOIN USERS U2 ' .
			'ON U2.USER_ID = D.RECEIVER_ID ' .
			'WHERE (D.EMITTER_ID = :userID AND U2.USER_NAME LIKE :pattern) OR ' .
			'(U1.USER_NAME LIKE :pattern AND D.RECEIVER_ID = :userID) ' .
			'ORDER BY DATE_MSG DESC'
		);

		$req->execute(array(
			'userID' 	=> $userID, 
			'pattern' 	=> $motif . '%'
		));

		while($data = $req->fetch())
			$result->append($data);

		$req->closeCursor();

		return $result;
	}

	/**
	* Retourne tous les messages d'un utilisateur à partir du nom d'un contact
	* @return ArrayObject
	*/
	function getAllMessagesFromContact($userID, $contact) {
		$result = new ArrayObject();
		$bdd = getBdd();

		$req = $bdd->prepare(
			'SELECT D.* FROM DISCUSSION D ' .
			'JOIN USERS U1 ' .
			'ON U1.USER_ID = D.EMITTER_ID ' .
			'JOIN USERS U2 ' .
			'ON U2.USER_ID = D.RECEIVER_ID ' .
			'WHERE (D.EMITTER_ID = :userID AND U2.USER_NAME = :contact) OR ' .
			'(U1.USER_NAME = :contact AND D.RECEIVER_ID = :userID)'
		);

		$req->execute(array(
			'userID' 	=> $userID, 
			'contact' 	=> $contact 
		));

		while($data = $req->fetch())
			$result->append($data);

		$req->closeCursor();

		return $result;
	}

	/**
	* Retourne tous les messages d'un utilisateur à partir du nom d'un contact
	* @return int
	*/
 	function getNotification ($userID, $contactID) {
		$bdd = getBdd();

		$req = $bdd->prepare(
			'SELECT COUNT(*) as notification FROM DISCUSSION ' .
			'WHERE (EMITTER_ID = :contactID AND RECEIVER_ID = :userID) ' .
			'AND STATUS = 0'
		);

		$req->execute(array(
			'userID' 	=> $userID, 
			'contactID' => $contactID 
		));

		$data = $req->fetch();

		return $data['notification'];
 	}

 	/**
	* Met à jour le statut des messages 
	* @return void
	*/
	function updateStatus($userID, $contactID, $date)
	{
		$bdd = getBdd();

		$req = $bdd->prepare(
			'UPDATE DISCUSSION ' .
			'SET STATUS = 1 ' .
			'WHERE (EMITTER_ID = :contactID AND RECEIVER_ID = :userID) AND DATE_MSG <= :date' 
		);

		$req->execute(array(
			'userID' 	=> $userID, 
			'contactID' => $contactID, 
			'date' 		=> $date 
		));
	}