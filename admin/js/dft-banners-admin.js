jQuery(function($) {

	var image_groups = document.querySelectorAll("#conteudo_banner .image-group");
	if( image_groups ) {
		image_groups.forEach(function(group) {

			var add_button = group.querySelector(".wp-media-upload");
			var edit_button = group.querySelector(".edit-upload");
			var delete_button = group.querySelector(".delete-upload");

			add_button.addEventListener('click', function(e) {

				e.preventDefault();

				var media_upload = wp.media({
					title: 'Escolha uma imagem',
					library : {
						type : 'image'
					},
					button: {
						text: 'Usar esta imagem' 
					},
					multiple: false
				}).on('select', function() { // it also has "open" and "close" events 
					var attachment = media_upload.state().get('selection').first().toJSON();

					$(add_button)
						.removeClass('button')
						.addClass("image")
						.html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />')
						.next()
						.val(attachment.id)
						.next()
						.show();

					group.classList.add('uploaded');
		
				})
				.open();

			})


			delete_button.addEventListener('click', function(e) {

				group.classList.remove('uploaded');

				$(add_button)
					.removeClass('image')
					.addClass("button")
					.html('Adicionar imagem')
					.next()
					.val("");

			})


			edit_button.addEventListener('click', function(e) {

				var media_upload = wp.media({
					title: 'Escolha uma imagem',
					library : {
						type : 'image'
					},
					button: {
						text: 'Usar esta imagem' 
					},
					multiple: false
				}).on('select', function() { // it also has "open" and "close" events 
					var attachment = media_upload.state().get('selection').first().toJSON();

					$(add_button)
						.removeClass('button')
						.addClass("image")
						.html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />')
						.next()
						.val(attachment.id)
						.next()
						.show();

					group.classList.add('uploaded');
		
				})
				.open();

			})


		});
	}

	var toggle_value = false;

	var toggle_checkbox = document.querySelector('#conteudo_banner input#target_blank');
	if( toggle_checkbox ) {
		toggle_value = $(toggle_checkbox).prop('checked');
		toggle_checkbox.addEventListener('change', function() {
			toggle_value = $(this).prop('checked');
		});
	}

	var input_url = document.querySelector("#conteudo_banner input#link_banner");
	if( input_url ) {
		input_url.addEventListener("input", function(e) {
			if( this.value == '') {
				disableToggle();
			} else {
				enableToggle();
			}
		})
	}


	function disableToggle() {
		if( toggle_checkbox ) {
			$(toggle_checkbox).prop('checked', false).parent().addClass('disabled');
		}
	}

	function enableToggle() {
		if( toggle_checkbox ) {
			$(toggle_checkbox).prop('checked', toggle_value).parent().removeClass('disabled');
		}
	}






})