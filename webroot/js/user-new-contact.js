dataJSON = {};


function createComponentChatNewContact (userName, avatar, classCSS, id) {
	return '<div id="lwrch'+id+'" class="l-wrap-chat">' 
			+	'<div class="l-wrap-chat-avatar">'
			+		'<div class="avatar-mini '+classCSS+'" style="background-image: url('+avatar+');"></div>'
			+	'</div>'
			+	'<div class="chat-body">'
			+		'<div class="chat-main">'
			+			'<div class="chat-title">'+userName+'</div>'
			+		'</div>'
			+		'<div id="'+id+'" class="add-contact js-add-contact" title="ajouter contact"><span class="glyphicon glyphicon-plus-sign"></span></div>'
			+	'</div>'
			+ '</div>';
}


function componentErrorNewContact () {
	return '<div class="chat-msg-error">Aucun résultat</div>';
}

function createAllChatNewContact (input) {
	if (input == '')
	{
		$( '.js-add-contact' ).unbind('click');
		$( '#chat-new-contact' ).html(componentErrorNewContact());
	}

	else
	{
		$.post('Contact/findNewContact', {motif: input}, function (data) {
			dataJSON = JSON.parse(data);

			// Si dataJSON est vide
			if (Object.keys(dataJSON).length == 0)
			{
				$( '.js-add-contact' ).unbind('click');
				$( '#chat-new-contact' ).html(componentErrorNewContact());
			}

			// Si dataJSON est non vide
			else 
			{
				$( '#chat-new-contact' ).html("");

				for (var index in dataJSON)
				{
					$( '#chat-new-contact' ).append(createComponentChatNewContact(
						dataJSON[index]['userName'],
						dataJSON[index]['path'],
						dataJSON[index]['class'], 
						index
						));
				}

				$( '.js-add-contact' ).bind('click', function () {
					id = $(this).attr('id');
					$.post('Contact/addContact', {userName: dataJSON[id]['userName']}, function () {
						$( '#lwrch' + id ).hide('fast');
					});
				});
			}
		});
	}
}


$(function () {
	// EVENEMENT: keyup sur "input-new-contact"
	$( '#input-new-contact' ).keyup( function () {
		createAllChatNewContact($(this).val());
	});

	// EVENEMENT: click sur le bouton recherche
	$( '#btn-search-new-contact' ).click( function () {
		createAllChatNewContact($( '#input-new-contact' ).val());
	});
});