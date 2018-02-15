<?php  
	
	/**
	* Insère dans la table USERS un nouveau utilisateur
	* @return void
	*/
	function insertDataUser($userName, $email, $password)
	{
		$bdd = getBdd();

		$req = $bdd->prepare('INSERT INTO USERS(USER_NAME, USER_EMAIL, USER_PASSWORD)'
			. ' VALUES(:userName, :email, :password)');

		$req->execute(array(
			'userName'	=> $userName,
			'email' 	=> $email,
			'password' 	=> $password
			));
	}

	function getUserIDWithUsername($userName)
	{
		$bdd = getBdd();

		$req = $bdd->prepare('SELECT USER_ID FROM USERS WHERE USER_NAME = ?');

		$req->execute(array($userName));

		if($data = $req->fetch())
			$id = $data['USER_ID'];
		else
			$id = NULL;

		$req->closeCursor();

		return $id;
	}

	function getUserIDWithEmail($email)
	{
		$bdd = getBdd();

		$req = $bdd->prepare('SELECT USER_ID FROM USERS WHERE USER_EMAIL = ?');

		$req->execute(array($email));

		if($data = $req->fetch())
			$id = $data['USER_ID'];
		else
			$id = NULL;

		$req->closeCursor();

		return $id;
	}

	function getUserName($id)
	{
		$bdd = getBdd();

		$req = $bdd->prepare('SELECT USER_NAME FROM USERS WHERE USER_ID = ?');

		$req->execute(array($id));

		if($data = $req->fetch())
			$userName = $data['USER_NAME'];
		else
			$userName = NULL;

		$req->closeCursor();

		return $userName;
	}

	function getUserPassword($id)
	{
		$bdd = getBdd();

		$req = $bdd->prepare('SELECT USER_PASSWORD FROM USERS WHERE USER_ID = ?');

		$req->execute(array($id));

		if($data = $req->fetch())
			$password = $data['USER_PASSWORD'];
		else
			$password = NULL;

		$req->closeCursor();

		return $password;
	}

	function getUserAvatar($id)
	{
		$bdd = getBdd();

		$req = $bdd->prepare('SELECT USER_AVATAR FROM USERS WHERE USER_ID = ?');

		$req->execute(array($id));

		if($data = $req->fetch())
			$avatar = $data['USER_AVATAR'];
		else
			$avatar = NULL;

		$req->closeCursor();

		return $avatar;
	}

	function getUserData($chain)
	{
		$result = new ArrayObject();
		$bdd = getBdd();

		$req = $bdd->prepare('SELECT * FROM USERS WHERE USER_NAME LIKE ? ORDER BY USER_NAME');

		$req->execute(array($chain . '%'));

		while($data = $req->fetch())
			$result->append($data);

		$req->closeCursor();

		return $result;
	}

	function setUserAvatar($id, $fileName)
	{
		$bdd = getBdd();

		$req = $bdd->prepare('UPDATE USERS SET USER_AVATAR = :name WHERE USER_ID = :id');

		$req->execute(array(
			'name' 	=> $fileName, 
			'id' 	=> $id
		));
	}

	function setUserName($id, $userName)
	{
		$bdd = getBdd();

		$req = $bdd->prepare('UPDATE USERS SET USER_NAME = :name WHERE USER_ID = :id');

		$req->execute(array(
			'name' 	=> $userName, 
			'id' 	=> $id
		));
	}

	function setEmail($id, $email)
	{
		$bdd = getBdd();

		$req = $bdd->prepare('UPDATE USERS SET USER_EMAIL = :email WHERE USER_ID = :id');

		$req->execute(array(
			'email' => $email, 
			'id' 	=> $id
		));
	}

	function setPassword($id, $password)
	{
		$bdd = getBdd();

		$req = $bdd->prepare('UPDATE USERS SET USER_PASSWORD = :password WHERE USER_ID = :id');

		$req->execute(array(
			'password' 	=> $password, 
			'id' 		=> $id
		));
	}