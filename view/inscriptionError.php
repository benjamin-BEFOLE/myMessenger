<div class="l-wrap-login">
	<div class="l-centered-login">
		<div class="l-login-wrap-logo">
			<div class="container-fluid">
				<img class="login-logo" src="/myMessenger/webroot/img/paper-plane.png">
				<h1 class="login-title-logo">INSCRIPTION</h1>
			</div>
		</div>
		<div class="l-login-wrap-form">
			<div class="container-fluid l-login-form">
				<h2 class="title-form">CRÉER UN COMPTE</h2> 
				<form method="post" cible="Inscription">
					<div class="champ-form">
						<label class="label-form">EMAIL</label>
						<input class="input-form" type="text" name="email" value="<?php echo $_POST['email'] ?>">
						<?php echo $emailError ?>
					</div>
					<div class="champ-form">
						<label class="label-form">NOM D'UTILISATEUR</label>
						<input class="input-form" type="text" name="userName" value="<?php echo $_POST['userName'] ?>">
						<?php echo $userNameError ?>
					</div>
					<div class="champ-form">
						<label class="label-form">MOT DE PASSE</label>
						<input class="input-form" type="text" name="password" value="<?php echo $_POST['password'] ?>">
						<?php echo $passwordError ?>
					</div>
					<div class="l-wrap-submit-form">
						<input class="button button-lg th-button-blue" type="submit" value="CONTINUER"></input>
					</div>
					<div class="text-form">
						En vous inscrivant vous acceptez les <a class="th-link-white" href="#">Conditions d'Utilisation</a> et la <a class="th-link-white" href="#">Politique de Confidentialité</a> de ce site.
					</div>
					<div class="text-form">
						Vous avez déjè un compte? <a class="th-link-white" href="Connexion">Se connecter</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>