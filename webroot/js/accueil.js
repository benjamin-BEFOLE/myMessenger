var body = '#body';
var menu = '#menu';
var button = '#menu-button';
var isHidden = true;

$(function()
{
	var height = $( menu ).height();
	var isMedium = ($( window ).width() < 768);

	// EVENEMENT: click sur le boutton menu
	$( button ).click(function()
	{
		if(isHidden)
		{
			// On affichhe le menu
			$( menu ).show();

			// On modifie la marge du corps de la page
			$( body ).css({
				'margin-top' : height + 'px'
			});

			isHidden = false;
		}
		else 
		{
			// On cache le menu
			$( menu ).hide();

			// On modifie la marge du corps de la page
			$( body ).css({
				'margin-top' : '0px'
			});

			isHidden = true;
		}
	});

	// EVENEMENT: resize de la fenêtre
	$( window ).resize(function()
	{
		if($( window ).width() < 768 && !isMedium)
			isMedium = true;

		if($( window ).width() >= 768 && isMedium)
		{
			isMedium = false;

			// On cache le menu
			if(!isHidden)
			{
				// On cache le menu
				$( menu ).hide();

				// On modifie la marge du corps de la page
				$( body ).css({
					'margin-top' : '0px'
				});

				isHidden = true;
			}
		}
	});
});
