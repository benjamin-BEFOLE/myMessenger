<div class="l-wrap-login">
	<div class="l-centered-login">
		<div class="l-wrap-grey">
			<form id="form" method="post" enctype="multipart/form-data">
				<div class="l-profil-wrap-img">
					<div class="container-fluid l-profil-content-img">
						<div id="image-profil" class="profil-img <?php echo $class ?>" title="avatar"style="background-image: url(<?php echo $path ?>);">
							<input id="input-file" name="fileName" type="file">
						</div>
						<a id="delete-avatar" href="#" class="l-top-right th-link-grey is-hidden" title="supprimer"><i class="glyphicon glyphicon-trash"></i></a>
						<div id="avatarError" class="msgError"></div>
					</div>
				</div>
				<div class="l-profil-wrap-form">
					<div class="container-fluid l-profil-form">
						<div class="champ-form">
							<label class="label-form">NOM D'UTILISATEUR</label>
							<input id ="userName" class="input-form" type="text" value="<?php echo $_SESSION['userName'] ?>" disabled="disabled">
							<div id="userNameError" class="msgError"></div>
						</div>
						<div class="champ-form">
							<label class="label-form">EMAIL</label>
							<input id ="email" class="input-form" type="text" value="<?php echo $_SESSION['email'] ?>" disabled="disabled">
							<div id="emailError" class="msgError"></div>
						</div>
						<div class="champ-form">
							<label class="label-form">MOT DE PASSE ACTUEL</label>
							<input id="password1" class="input-form password" type="text" disabled="disabled">
							<div class="passwordError msgError"></div>
						</div>
						<div class="champ-form">
							<label class="label-form">NOUVEAU MOT DE PASSE</label>
							<input id="password2" class="input-form password" type="text" disabled="disabled">
							<div class="passwordError msgError"></div>
						</div>
						<div id="button-edit" class="l-wrap-submit-form">
							<div class="button button-lg th-button-blue">EDITER</div>
						</div>
						<div id="modify-form" class="l-wrap-submit-form is-hidden">
							<div class="l-left">
								<div id="button-cancel" class="button th-button-red">ANNULER</div>
							</div>
							<div class="l-right">
								<div id="submit" class="button th-button-green">ENREGISTRER</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>