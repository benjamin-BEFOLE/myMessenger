<?php

	// Ouverture d'une session  
	session_start();

	/**
	* Déconnecte l'utilisateur
	* @return void
	*/
	function index () {
		// Suppresion des variables de session
		unset($_SESSION['id']);
		unset($_SESSION['userName']);
		unset($_SESSION['email']);
		unset($_SESSION['password']);
		unset($_SESSION['avatar']);

		// Redirection vers la page de connexion
		header('Location: ' . DS . 'myMessenger' . DS . 'Connexion');
	}