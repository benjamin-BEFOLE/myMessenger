var menuIsHidden = true;

$(function () {
	var height = $( '#menu' ).height();

	// EVENEMENT: click sur le boutton menu
	$( '#btn-menu').click(function () {
		if(menuIsHidden)
		{
			menuIsHidden = false;

			// On affichhe le menu
			$( '#menu' ).show();

			$( '.js-search' ).css({
				'margin-top' : height + 'px'
			});
			$( '.js-search-result' ).css({
				'height' : 'calc(100vh - ' + (height + 110) + 'px)'
			});
		}
		else
		{
			menuIsHidden = true;

			// On cache le menu
			$( '#menu' ).hide();

			$( '.js-search' ).css({
				'margin-top' : '0px'
			});
			$( '.js-search-result' ).css({
				'height' : 'calc(100vh - 110px)'
			});
		}
	});

	// EVENEMENT: click sur le boutton "new-contact"
	$( '#btn-new-contact' ).click(function () {
		// On actualise
		$( '#btn-search-new-contact' ).click();

		// On affichhe la partie "new-contact"
		$( '#new-contact' ).removeClass('is-hidden');

		// On masque la partie discussion et contact
		if(!$( '#discussion' ).hasClass('is-hidden'))
			$( '#discussion' ).addClass('is-hidden');
		if(!$( '#contact' ).hasClass('is-hidden'))
			$( '#contact' ).addClass('is-hidden');
	});

	// EVENEMENT: click sur le boutton contact
	$( '#btn-contact' ).click(function () {
		// On actualise
		$( '#btn-search-contact' ).click();

		// On affichhe la partie contact
		$( '#contact' ).removeClass('is-hidden');

		// On masque la partie discussion et "new-contact"
		if(!$( '#discussion' ).hasClass('is-hidden'))
			$( '#discussion' ).addClass('is-hidden');
		if(!$( '#new-contact' ).hasClass('is-hidden'))
			$( '#new-contact' ).addClass('is-hidden');
	});

	// EVENEMENT: click sur le boutton discussion
	$( '#btn-discussion' ).click(function () {
		// On actualise
		$( '#btn-search-discussion' ).click();
		
		// On affichhe la partie discussion
		$( '#discussion' ).removeClass('is-hidden');

		// On masque la partie contact et "new-contact"
		if(!$( '#contact' ).hasClass('is-hidden'))
			$( '#contact' ).addClass('is-hidden');
		if(!$( '#new-contact' ).hasClass('is-hidden'))
			$( '#new-contact' ).addClass('is-hidden');
	});
});