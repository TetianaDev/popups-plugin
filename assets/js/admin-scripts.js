(function ($) {
    $(document).ready(function () {

        /* ------------ Media Uploader ------------ */
        let mediaUploader;
        $('#popup-image-upload-button').click(function (e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
            } else {
                mediaUploader = wp.media({
                    title: 'Select Image',
                    button: {
                        text: 'Select Image'
                    },
                    multiple: false
                });

                mediaUploader.open();
            }

            mediaUploader.on('select', function () {
                let attachment = mediaUploader.state().get('selection').first().toJSON();
                let previewBlock = $('#popup-image-preview');

                $('#popup-image-id').val(attachment.id);

                if ($('#popup-image-preview img').length === 0) {
                    previewBlock.html('<img src="/" alt="Popup image">');
                }

                let previewImage = $(previewBlock).find('img');
                previewImage.attr('src', attachment.url);
            });
        });

        $('#popup-image-remove-button').click(function (e) {
            e.preventDefault();
            $('#popup-image-id').val('');
            $('#popup-image-preview img').remove();
        });


        /* ------------ Settings visibility based on popup type ------------ */
        let radioInput = $('input[name="popup_type"]')
        let selectedValue = $('input[name="popup_type"]:checked').val();

        changeSettingsVisibility(selectedValue);

        radioInput.on('change', function () {
            let selectedValue = $('input[name="popup_type"]:checked').val();
            changeSettingsVisibility(selectedValue);
        })

        /* ------------ Event date settings visibility based on option ------------ */
        let showDateOption = $('input[name="show_date"]');
        let showDateOptionValue = $('input[name="show_date"]:checked').val();

        changeDateSettingsVisibility(showDateOptionValue);

        showDateOption.on('change', function() {
            let showDateOptionValue = $('input[name="show_date"]:checked').val();
            changeDateSettingsVisibility(showDateOptionValue);
        });
    });

    function changeSettingsVisibility(currentType) {
        let eventSettings = $('.event-settings');
        let subscriptionSettings = $('.subscription-settings');

        if (currentType === 'event') {
            $(eventSettings).fadeIn();
            $(subscriptionSettings).fadeOut();
        } else if (currentType === 'subscription') {
            $(eventSettings).fadeOut();
            $(subscriptionSettings).fadeIn();
        } else {
            $(eventSettings).fadeOut();
            $(subscriptionSettings).fadeOut();
        }
    }

    function changeDateSettingsVisibility(currentOption) {
        if(currentOption === 'on') {
            $('.hide_event_date').fadeIn();
        } else {
            $('.hide_event_date').fadeOut();
        }
    }

})(jQuery);