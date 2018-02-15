function createContactAvatar($class, $path) {
	return '<div class="avatar-mini '+$class+'" title="profil utilisateur" style="background-image: url('+$path+');"></div>';
}


function createComponentChatContact (userName, avatar, classCSS, id) {
	return '<div id="'+id+'" class="l-wrap-chat pointer js-contact">' 
			+	'<div class="l-wrap-chat-avatar">'
			+		'<div class="avatar-mini '+classCSS+'" style="background-image: url('+avatar+');"></div>'
			+	'</div>'
			+	'<div class="chat-body">'
			+		'<div class="chat-main">'
			+			'<div class="chat-title">'+userName+'</div>'
			+		'</div>'
			+	'</div>'
			+ '</div>';
}


function componentErrorContact () {
	return '<div class="chat-msg-error">Aucun résultat</div>';
}


function createAllChatContact (input) {
	$.post('Contact/findContact', {motif: input}, function (data) {
		var dataJSON = JSON.parse(data);

		// Si dataJSON est vide
		if (Object.keys(dataJSON).length == 0)
		{
			$( '.js-contact' ).unbind('click');
			$( '#chat-contact' ).html(componentErrorContact());
		}

		// Si dataJSON est non vide
		else 
		{
			$( '#chat-contact' ).html("");

			for (var index in dataJSON)
			{
				$( '#chat-contact' ).append(createComponentChatContact(
					dataJSON[index]['userName'],
					dataJSON[index]['path'],
					dataJSON[index]['class'], 
					index
					));
			}

			$( '.js-contact' ).bind('click', function () {
				var index = $(this).attr('id')
				var contact = dataJSON[index]['userName'];
				$( '#avatar-contact' ).html(createContactAvatar(dataJSON[index]['class'], dataJSON[index]['path']));
				$( '.input-msg' ).attr('placeholder', 'écrire à @' + contact);
				
				printDiscussion(contact);
			});
		}
	});
}


$(function () {
	createAllChatContact('');

	// EVENEMENT: keyup sur "input-contact"
	$( '#input-contact' ).keyup( function () {
		createAllChatContact($(this).val());
	});

	// EVENEMENT: click sur le bouton recherche
	$( '#btn-search-contact' ).click( function () {
		createAllChatContact($( '#input-contact' ).val());
	});
});