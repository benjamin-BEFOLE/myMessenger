tabTime = new Array();

function componentMsgTime (time) {
	return 	'<div class="l-msg-time">' +
				'<div class="msg-time-separator">' + time + '</div>' +
			'</div>';		
}

function componentMsgNonLu () {
	return 	'<div class="l-msg-non-lu">' +
				'<div class="msg-non-lu">MESSAGE NON LU</div>' +
			'</div>';		
}

function componentMsgReceived (msg, hour) {
	return 	'<div class="l-print-msg-received">' +
				'<div class="msg msg-received">' + msg + '</div>' +
				'<div class="msg-meta msg-meta-received">' + hour + '</div>' +
			'</div>';	
}

function componentMsgEmitted (msg, hour) {
	return 	'<div class="l-print-msg-emitted">' +
				'<div class="msg msg-emitted">' + msg + '</div>' +
				'<div class="msg-meta msg-meta-emitted">' + hour + '</div>' +
			'</div>';	
}

function printMsgTime (msgDate) {
	var tmp = getTime(new Date(), msgDate, false);

	if (tabTime.indexOf(tmp) == -1)
	{
		$( '.l-wrap-msg' ).append(componentMsgTime(tmp.toUpperCase()));
		tabTime.push(tmp);
	}
}

function printDiscussion (contact) {
	$.post('Discussion/getDiscussion', {contact: contact}, function (data) {
		var discussionJSON = JSON.parse(data);
		// console.log(discussionJSON);

		$( '.l-wrap-msg' ).html("");		
		// Si discussionJSON est non vide
		if (Object.keys(discussionJSON).length != 0)
		{
			var currentDate = new Date();
			var userName = $( '#userAvatar' ).attr('name');
			var msgDate = new Date();
			msgDate.setTime(discussionJSON[0]['date']*1000);
			
			tabTime = new Array();
			var msgNonLu = false;
			var indexMsgNonLu = 0;

			for (var index in discussionJSON)
			{
				msgDate.setTime(discussionJSON[index]['date']*1000);
				printMsgTime (msgDate);

				if (discussionJSON[index]['receiver'] == userName && discussionJSON[index]['status'] == '0')
				{
					indexMsgNonLu = index;

					if (!msgNonLu)
					{
						// On modifie les notifications
						setChatNotification(contact, 0);

						// On affiche un 'MESSAGE NON LU'
						$( '.l-wrap-msg' ).append(componentMsgNonLu());
						msgNonLu = true;
					}
				}

				if (userName == discussionJSON[index]['emitter'])
					$( '.l-wrap-msg' ).append(componentMsgEmitted(discussionJSON[index]['message'], getHours(msgDate)));
				else
					$( '.l-wrap-msg' ).append(componentMsgReceived(discussionJSON[index]['message'], getHours(msgDate)));
			}

			if (msgNonLu)
			{
				// On modifie le statut des messages en BDD
				$.post('Discussion/updateMsgNonLu', {
						contact : contact,
						date 	: discussionJSON[indexMsgNonLu]['date']
				});
			}

			var scroll = $( '.l-wrap-msg' ).prop('scrollHeight') - $( '.l-wrap-msg-screen' ).height();
			if (scroll > 0)
				$( '.l-wrap-msg' ).scrollTop(scroll);
		}

		// On affiche le 'footer'
		$( 'footer' ).removeClass('is-hidden');
	});
}

$(function () {
	var userName = $( '#userAvatar' ).attr('name');

	// Connection au serveur Node Js
	var socket = io('http://localhost:8080');

	socket.on(userName, function (data) {
		var tmp = $( '.input-msg' ).attr('placeholder');
		var i = tmp.indexOf('@');
		var userContact = tmp.substring(i + 1);	// Contact avec qui l'utilisaateur discute

		if (userContact == data.emitter)
		{
			var msgDate = new Date();
			msgDate.setTime(data.date * 1000);

			// On affiche le message
			printMsgTime(msgDate);
			$( '.l-wrap-msg' ).append(componentMsgReceived(data.message, getHours(msgDate)));
			
			var scroll = $( '.l-wrap-msg' ).prop('scrollHeight') - $( '.l-wrap-msg-screen' ).height();
			if (scroll > 0)
				$( '.l-wrap-msg' ).scrollTop(scroll);

			// On modifie le statut des messages en BDD
			$.post('Discussion/updateMsgNonLu', {
					contact : userContact,
					date 	: data.date
			});
		}

		else 
		{
			incrementChatNotification(data.emitter);
			// var audio = new Audio('http://www.soundjay.com/button/button-5.mp3');
			// audio.play();
		}
	});
});