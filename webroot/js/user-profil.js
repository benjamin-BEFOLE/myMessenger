var edit = '#button-edit';
var cancel = '#button-cancel';
var avatar = '#image-profil';
var inputs = '.input-form';
var modify = '#modify-form';
var modified = false;
var userNameField = '#userName';
var emailField = '#email';

$(function(){
	var userName = "";
	var email = "";

	// EVENEMENT: click sur le boutton edit
	$( edit ).click(function(){
		modified 	= true;
		userName 	= $( userNameField ).val();
		email 		= $( emailField ).val();
		$( avatar ).css({
			'cursor': 'pointer'
		});
		$( edit ).hide();
		$( modify ).removeClass('is-hidden');
		$( '#delete-avatar' ).removeClass('is-hidden');
		$( inputs ).removeAttr('disabled');
	});

	// EVENEMENT: click sur le boutton cancel
	$( cancel ).click(function(){
		modified = false;
		$( avatar ).css({
			'cursor': 'default'
		});
		$( userNameField ).val(userName);
		$( emailField ).val(email);
		$( '.password' ).val("");
		$( '.msgError' ).html("");
		$( edit ).show();
		$( modify ).addClass('is-hidden');
		$( '#delete-avatar' ).addClass('is-hidden');
		$( inputs ).attr('disabled', 'disabled');
	});

	// EVENEMENT: click sur la photo de profil
	$( avatar ).click(function(){
		if(modified)
			document.getElementById('input-file').click();
	});

	// EVENEMENT: changement de la photo de profil
	$( '#input-file' ).change(function(){
		if($(this).val() != '')
		{
			var formData = new FormData();
			formData.append('image', $(this)[0].files[0]);

			// Envoi de la photo de profil au serveur 
			$.ajax({
				type: 		'POST',
				url: 		'Profil/avatar',
				dataType :  'html',
				data: 		formData,
				contentType: false,
				processData: false,
				success: 	function(data) {
					// console.log(data);
					var dataJSON = JSON.parse(data);
					var path = dataJSON['path'];		// chemin de la photo de profil
					var width = dataJSON['width'];		// largeur de la photo de profil
					var heigth = dataJSON['heigth'];	// hauteur de la photo de profil
					
					$( avatar ).css({
						'background-image' : 'url(' + path + ')'
					});
					$( '#avatarError' ).html("");

					if(width < heigth)
					{
						$( avatar ).removeClass('profil-img-height');
						$( avatar ).removeClass('profil-img-width');
						$( avatar ).addClass('profil-img-width');
					}
					else
					{
						$( avatar ).removeClass('profil-img-height');
						$( avatar ).removeClass('profil-img-width');
						$( avatar ).addClass('profil-img-height');
					}
				},
				error : function(result){
					$( '#avatarError' ).html(result['responseText']);
				}
			});
		}
	});

	// EVENEMENT: click sur le bouton "delete-avatar"
	$( '#delete-avatar' ).click(function () {
		$.get('Profil/delete', function (data) {
			if(data != '')
			{
				$( avatar ).css({
					'background-image' : 'url(' + data + ')'
				});
				$( '#avatarError' ).html("");

				$( avatar ).removeClass('profil-img-height');
				$( avatar ).removeClass('profil-img-width');
				$( avatar ).addClass('profil-img-width');
			}
		});
	});

	// EVENEMENT: click sur le bouton enregistrer
	$( '#submit' ).click(function(){
		var password1 = $( '#password1' ).val();
		var password2 = $( '#password2' ).val();
		var formData = new FormData();

		formData.append('userName', $( userNameField ).val());
		formData.append('email', $( emailField ).val());

		if(password1 || password2)
		{
			formData.append('password1', password1);
			formData.append('password2', password2);
		}

		$.ajax({
			type : 		'POST',
			url : 		'Profil/checkForm',
	        dataType : 	'html',
	        data: 		formData,
			contentType: false,
			processData: false,
	        success : function(data){
	        	modified = false;
				$( avatar ).css({
					'cursor': 'default'
				});
				$( userNameField ).val($( userNameField ).val());
				$( emailField ).val($( emailField ).val());
				$( '.password' ).val("");
				$( '.msgError' ).html("");
				$( edit ).show();
				$( modify ).addClass('is-hidden');
				$( '#delete-avatar' ).addClass('is-hidden');
				$( inputs ).attr('disabled', 'disabled');
	        },
	        error : function(response){
	        	var dataJSON = JSON.parse(response['responseText']);
		        $( '#userNameError' ).html(dataJSON['userNameError']);
		        $( '#emailError' ).html(dataJSON['emailError']);
		        $( '.passwordError' ).html(dataJSON['passwordError']);
			}
        });
	});
});