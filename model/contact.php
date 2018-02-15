<?php  
	
	/**
	* Insère dans la table LIST_CONTACTS un nouveau contact
	* @return void
	*/
	function insertContact ($userID, $contactID) {
		$bdd = getBdd();

		$req = $bdd->prepare('INSERT INTO LIST_CONTACTS(USER_ID, CONTACT_ID)'
			. ' VALUES(:userID, :contactID)');

		$req->execute(array(
			'userID'	=> $userID,
			'contactID' => $contactID
			));
	}


	/**
	* Teste si un contact est déjà dans la table LIST_CONTACTS
	* @return boolean
	*/
	function testContact ($userID, $contactID) {
		$bdd = getBdd();

		$req = $bdd->prepare('SELECT * FROM LIST_CONTACTS WHERE USER_ID = ? AND CONTACT_ID = ?');

		$req->execute(array($userID, $contactID));

		if($data = $req->fetch())
			$answer = TRUE;
		else
			$answer = FALSE;

		$req->closeCursor();

		return $answer;
	}


	/**
	* Retourne tous les contacts d'un utilisateur
	* @return ArrayObject
	*/
	function getAllContact($userID)
	{
		$result = new ArrayObject();
		$bdd = getBdd();

		$req = $bdd->prepare(
			'SELECT U.* FROM USERS U ' .
			'JOIN LIST_CONTACTS L ' .
			'ON U.USER_ID = L.CONTACT_ID ' .
			'WHERE L.USER_ID = ?' .
			'ORDER BY U.USER_NAME'
		);

		$req->execute(array($userID));

		while($data = $req->fetch())
			$result->append($data);

		$req->closeCursor();

		return $result;
	}


	/**
	* Retourne les contacts d'un utilisateur ayant un certain motif
	* @return ArrayObject
	*/
	function getContact($userID, $motif)
	{
		$result = new ArrayObject();
		$bdd = getBdd();

		$req = $bdd->prepare(
			'SELECT U.* FROM USERS U ' .
			'JOIN LIST_CONTACTS L ' .
			'ON U.USER_ID = L.CONTACT_ID ' .
			'WHERE L.USER_ID = ? AND U.USER_NAME LIKE ? ' .
			'ORDER BY U.USER_NAME'
		);

		$req->execute(array($userID, $motif . '%'));

		while($data = $req->fetch())
			$result->append($data);

		$req->closeCursor();

		return $result;
	}