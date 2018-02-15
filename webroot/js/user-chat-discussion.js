dataDiscJSON = {};

function createComponentChatDiscussion (userName, avatar, classCSS, message, time, id) {
	return '<div id="'+id+'" class="l-wrap-chat pointer js-discussion">' 
			+	'<div class="l-wrap-chat-avatar">'
			+		'<div class="avatar-mini '+classCSS+'" style="background-image: url('+avatar+');"></div>'
			+	'</div>'
			+	'<div class="chat-body">'
			+		'<div class="chat-main">'
			+			'<div class="chat-title">'+userName+'</div>'
			+			'<div class="chat-meta">'+time+'</div>'
			+		'</div>'
			+		'<div class="chat-msg-text">'+message+'</div>'
			+		'<div class="chat-notification is-hidden"></div>'
			+	'</div>'
			+ '</div>';
}

function componentErrorDiscussion () {
	return '<div class="chat-msg-error">Aucun résultat</div>';
}

function createAllChatDiscussion (input) {
	$.post('Discussion/getLatestMessages', {motif: input}, function (data) {
		dataDiscJSON = JSON.parse(data);
		// console.log(dataDiscJSON.notification);

		// Si dataDiscJSON est vide
		if (Object.keys(dataDiscJSON).length == 0)
		{
			$( '.js-discussion' ).unbind('click');
			$( '#chat-discussion' ).html(componentErrorDiscussion());
		}

		// Si dataDiscJSON est non vide
		else 
		{
			var currentDate = new Date();
			var userName = $( '#userAvatar' ).attr('name');
			$( '#chat-discussion' ).html("");

			for (var index in dataDiscJSON)
			{
				var userContact = (dataDiscJSON[index]['emitter'] == userName)?dataDiscJSON[index]['receiver']:dataDiscJSON[index]['emitter'];
				var msgDate = new Date();
				msgDate.setTime(dataDiscJSON[index]['date']*1000);

				$( '#chat-discussion' ).append(createComponentChatDiscussion(
					userContact,
					dataDiscJSON[index]['path'],
					dataDiscJSON[index]['class'], 
					dataDiscJSON[index]['message'], 
					getTime(currentDate, msgDate, true),
					index
					));
				setChatNotification(userContact, dataDiscJSON[index]['notification']);
			}

			$( '.js-discussion' ).bind('click', function () {
				var index = $(this).attr('id');
				var contact = (dataDiscJSON[index]['emitter'] == userName)?dataDiscJSON[index]['receiver']:dataDiscJSON[index]['emitter'];
				$( '#avatar-contact' ).html(createContactAvatar(dataDiscJSON[index]['class'], dataDiscJSON[index]['path']));
				$( '.input-msg' ).attr('placeholder', 'écrire à @' + contact);

				printDiscussion(contact);
			});
		}
	});
}

function updateChatDiscussion (data, userName, userContact) {
	var selector = '#chat-discussion .js-discussion:contains(' + userContact + ')';
	var msgDate = new Date();
	msgDate.setTime(data.date*1000);

	if($( selector ).length != 0)
	{
		$( selector ).find('.chat-meta').html(getTime(new Date(), msgDate, true));
		$( selector ).find('.chat-msg-text').html(data.message);
		var elmt = $( selector );
		$( selector ).remove();
		$( '#chat-discussion' ).prepend(elmt);
	}

	else
	{
		var index = Object.keys(dataDiscJSON).length;
		// On ajoute une nouvelle discussion au 'chat-discussion'
		$( '#chat-discussion' ).prepend(createComponentChatDiscussion(
			userContact,
			data.path,
			data.class,
			data.message,
			getTime(new Date(), msgDate, true),
			index
		));

		// On met à jour dataDiscJSON
		dataDiscJSON[index] = {
			emitter: 	data.emitter,
			receiver: 	data.receiver,
			path: 		data.path,
			class: 		data.class,
			message: 	data.message,
			date: 		data.date,
			status: 	data.status
		}
	}

	$( selector ).bind('click', function () {
		var index = $(this).attr('id');
		$( '#avatar-contact' ).html(createContactAvatar(dataDiscJSON[index]['class'], dataDiscJSON[index]['path']));
		$( '.input-msg' ).attr('placeholder', 'écrire à @' + userContact);
		printDiscussion(userContact);
	});
}

function setChatNotification (userContact,  nbrNotification) {
	var elmContact = $( '#chat-discussion .js-discussion:contains(' + userContact + ')' );
	var elmNotification = elmContact.find('.chat-notification');

	// S'il y a au moins une notification
	if (nbrNotification > 0)
	{
		// On affiche les notifications 
		elmNotification.html(nbrNotification);
		elmNotification.removeClass('is-hidden');
	}

	else 
	{
		// On masque les notifications
		elmNotification.html(0);
		if (!elmNotification.hasClass('is-hidden'))
			elmNotification.addClass('is-hidden');
	}
}

function incrementChatNotification (userContact) {
	var elmContact = $( '#chat-discussion .js-discussion:contains(' + userContact + ')' );
	var elmNotification = elmContact.find('.chat-notification');
	var nbrNotification = parseInt(elmNotification.html());

	// on incrémente le nombre de notification 
	elmNotification.html(nbrNotification + 1);

	// On affiche les notifications 
	elmNotification.removeClass('is-hidden');
}


$(function () {
	createAllChatDiscussion('');

	// EVENEMENT: keyup sur "input-discussion"
	$( '#input-discussion' ).keyup( function () {
		createAllChatDiscussion($(this).val());
	});

	// EVENEMENT: click sur le bouton recherche
	$( '#btn-search-discussion' ).click( function () {
		createAllChatDiscussion($( '#input-discussion' ).val());
	});

	// Réception d'un nouveau message
		var userName = $( '#userAvatar' ).attr('name');

		// Connection au serveur Node Js
		var socket = io('http://localhost:8080');

		// On met le 'chat-discussion' à jour
		socket.on(userName, function (data) {
			updateChatDiscussion(data, data.receiver, data.emitter);
		});
})