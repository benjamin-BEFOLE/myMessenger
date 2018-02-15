<header class="l-wrap-header-home">
	<div id="userAvatar" name="<?php echo $_SESSION['userName'] ?>" class="l-wrap-header-avatar"><a class="avatar-mini <?php echo $classAvatar ?>" href="Profil" title="profil utilisateur" style="background-image: url(<?php echo $pathAvatar ?>);"></a></div>
	<nav>
		<div id="btn-menu" class="l-right button-icon th-grey" title="menu">
			<i class="glyphicon glyphicon-menu-hamburger"></i>
		</div>
		<ul id="menu" class="l-user-list-menu">
			<li id="btn-new-contact" class="l-user-elm-menu"><a href="#" class="elm-menu th-link-grey">Nouveau Contact</a></li>
			<li id="btn-contact" class="l-user-elm-menu"><a href="#" class="elm-menu th-link-grey">Contact</a></li>
			<li id="btn-discussion" class="l-user-elm-menu"><a href="#" class="elm-menu th-link-grey">Message</a></li>
			<li class="l-user-elm-menu"><a href="Profil" class="elm-menu th-link-grey">Profil</a></li>
			<li class="l-user-elm-menu"><a href="Deconnexion" class="elm-menu th-link-grey">Déconnexion</a></li>
		</ul>
	</nav>
</header>