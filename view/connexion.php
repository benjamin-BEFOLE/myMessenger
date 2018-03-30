<div class="l-wrap-login">
	<div class="l-centered-login">
		<div class="l-login-wrap-logo">
			<div class="container-fluid">
				<img class="login-logo" src="/myMessenger/webroot/img/theme/paper-plane.png">
				<h1 class="login-title-logo">CONNEXION</h1>
			</div>
		</div>
		<div class="l-login-wrap-form">
			<div class="container-fluid l-login-form">
				<h2 class="title-form">BIENVENU!</h2> 
				<form method="post" cible="Connexion">
					<div class="champ-form">
						<label class="label-form">EMAIL</label>
						<input class="input-form" type="text" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:'' ?>">
					</div>
					<div class="champ-form">
						<label class="label-form">MOT DE PASSE</label>
						<input class="input-form" type="password" name="password" value="<?php echo isset($_POST['password'])?$_POST['password']:'' ?>">
					</div>
					<div class="l-wrap-submit-form">
						<button class="button button-lg th-button-blue">SE CONNECTER</button>
					</div>
					<div class="text-form">
						Vous n'êtes pas inscrit? <a class="th-link-white" href="Inscription">S'inscrire</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>