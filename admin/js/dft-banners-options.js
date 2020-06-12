jQuery(function($) {

    var customMediaLibrary = wp.media({
		title: 'Escolha uma imagem',
		library : {
			type : 'image'
		},
		button: {
			text: 'Usar esta imagem' 
		},
		multiple: false
	});

    var exclude_input = document.querySelector("#option-exclude");
    if( exclude_input ) {

        exclude_input.addEventListener('change', function(e) {
            console.log("Hello");
            this.checked ? enablePageCheckboxes() : disablePageCheckboxes();
        })

    } 

    var media_upload = document.querySelector(".wp-media-upload");
    if( media_upload ) {
        media_upload.addEventListener('click', function(e) {
            e.preventDefault();
            customMediaLibrary.on('select', function() { // it also has "open" and "close" events 
                var attachment = customMediaLibrary.state().get('selection').first().toJSON();

                jQuery(media_upload)
                    .removeClass('button')
                    .addClass("image")
                    .html('<div class="icon-wrapper"><img class="true_pre_image" src="' + attachment.url + '" /></div>')
                    .next()
                    .val(attachment.id)
                    .next()
                    .show();


            })
            .open()
        })
    }

    $('.dots-color').wpColorPicker();

    function disablePageCheckboxes() {
        var checkbox_items = document.querySelectorAll("#page-checkbox-group li .checkbox");
        checkbox_items.forEach(function(item) {
            $(item).prop("disabled", true);
        });
    }

    function enablePageCheckboxes() {
        var checkbox_items = document.querySelectorAll("#page-checkbox-group li .checkbox");
        checkbox_items.forEach(function(item) {
            $(item).prop("disabled", false);
        });
    }

});