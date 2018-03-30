ENTER = 13;

// Fonction inspirée de :
// https://stackoverflow.com/questions/19170083/automatically-resize-text-area-based-on-content
function autoheight(a) {
    if (!$(a).prop('scrollTop')) {
        do {
            var b = $(a).prop('scrollHeight');
            var h = $(a).height();
            $(a).height(h - 5);
        }
        while (b && (b != $(a).prop('scrollHeight')));
    };

    $(a).height($(a).prop('scrollHeight') - 14);
    var height = $(a).height()
    $( '.l-msg' ).height(height + 14);
    $( '.l-wrap-send-msg' ).height(height + 34);
    
}


$(function () {
	// EVENEMENT: saisi clavier dans le champ message
	$( '.input-msg' ).keyup(function (event) {
		if (event.keyCode == ENTER && !event.shiftKey)
		{
			var input = $( '.input-msg' ).val();
			var test = input.replace(/\n/g, '');

			if (test != '') 
			{
				var msg = input.replace(/\n/g, '<br>');
				var placeholder = $( '.input-msg' ).attr('placeholder');
				var userName = placeholder.substring(placeholder.indexOf('@') + 1);

				// On envoie le message au serveur 
				$.post('Discussion/sendMessage', 
					{userName: userName, message: msg}, 
					function (data) {
						var resp = JSON.parse(data);
						var msgDate = new Date();
						msgDate.setTime(resp.date * 1000);
						
						// On affiche le message
						printMsgTime(msgDate);
						$( '.l-wrap-msg' ).append(componentMsgEmitted(resp.message, getHours(msgDate)));
						
						var scroll = $( '.l-wrap-msg' ).prop('scrollHeight') - $( '.l-wrap-msg-screen' ).height();
						if (scroll > 0)
							$( '.l-wrap-msg' ).scrollTop(scroll);

						// On met à jour le 'chat-discussion'
						updateChatDiscussion(resp, resp.emitter, resp.receiver);
				});
			}

			$( '.input-msg' ).val("");
		}

		autoheight(this);
	});


});