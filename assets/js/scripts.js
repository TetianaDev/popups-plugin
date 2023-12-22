(function ($) {
    $(document).ready(function () {
        $('footer').append('<div id="proxima_popup"></div>');
        let popup = $('#proxima_popup');
        // Need this to make smooth animation
        $(popup).fadeOut();

        let isShowEventPopup = localStorage.getItem('isShowEventPopup');
        let isShowSubscriptionPopup = localStorage.getItem('isShowSubscriptionPopup');

        if (isShowEventPopup == null) {
            localStorage.setItem('isShowEventPopup', 'true');
        }

        if (isShowSubscriptionPopup == null) {
            localStorage.setItem('isShowSubscriptionPopup', 'true');
        }

        let pageType = getPageType();
        let pageId = getPageId();

        $.ajax({
            url: popupSettings.ajaxurl,
            method: 'POST',
            data: {
                action: 'get_popup',
                currentPageType: pageType,
                currentPageId: pageId
            },
            success: function (response) {
                popup.append(response.data.popup_html);
                let isShowEventPopup = localStorage.getItem('isShowEventPopup');
                let isShowSubscriptionPopup = localStorage.getItem('isShowSubscriptionPopup');

                // Check if needed to show the popup
                if ((response.data.popup_type === 'event' && isShowEventPopup === 'true') || (response.data.popup_type === 'subscription' && isShowSubscriptionPopup === 'true')) {
                    setTimeout(() => {
                        $(popup).fadeIn();

                        // Add listener to close popup on button click because
                        $('.popup-close_button').on('click', function () {
                            $(popup).fadeOut();

                            if ($(this).hasClass('event_close')) {
                                localStorage.setItem('isShowEventPopup', 'false');
                            } else if ($(this).hasClass('subscription_close')) {
                                localStorage.setItem('isShowSubscriptionPopup', 'false');
                            }
                        });

                        // Form validation
                        $('.subscription_form').on('submit', function (event) {
                            event.preventDefault();

                            let values = {
                                name: $('.popup-form_name').val(),
                                email: $('.popup-form_email').val(),
                                phone: $('.popup-form_phone').val()
                            }

                            submitForm(values);
                        });

                        // Don't show event popup after clicking registration button
                        $('.popup-info_button_link').on('click', function () {
                            $(popup).fadeOut();
                            localStorage.setItem('isShowEventPopup', 'false');
                        })

                    }, (popupSettings.popupTimeOffset * 1000));
                }
            }
        });
    });

    function submitForm(values) {
        $.ajax({
            url: popupSettings.ajaxurl,
            method: 'POST',
            data: {
                action: 'submit_form',
                values: values
            },
            success: function (response) {
                if (response.success === true) {
                    $('#proxima_popup').fadeOut();
                    localStorage.setItem('isShowSubscriptionPopup', 'false');
                } else {
                    // Shake the button
                    let numShakes = 3;     // Number of shakes
                    let initialDuration = 30; // Initial animation duration in milliseconds
                    let distance = 10;     // Distance to shake in pixels

                    for (let i = 0; i < numShakes; i++) {
                        // Calculate the current duration based on the iteration
                        let duration = initialDuration * (i + 1);

                        // Animate the button to the right
                        $('.popup-form_submit').animate({marginLeft: "+=" + distance}, duration / 2)
                            // Animate the button to the left
                            .animate({marginLeft: "-=" + (distance * 2)}, duration)
                            // Animate the button back to its original position
                            .animate({marginLeft: "+=" + distance}, duration / 2);
                    }
                }
            }
        });
    }

    function getPageType() {
        let bodyClasses = $('body').attr('class').split(/\s+/);

        let classWithId = bodyClasses.find(className => className.startsWith('page-id-') || className.startsWith('postid-') || className.startsWith('archive'));
        if (classWithId) {
            if (classWithId.startsWith('page-id-')) {
                return 'page';
            } else if (classWithId.startsWith('archive')) {
                return 'archive';
            } else {
                return 'post';
            }
        }

        return null;
    }

    function getPageId() {
        let bodyClasses = $('body').attr('class').split(/\s+/);

        let classWithId = bodyClasses.find(className => className.startsWith('page-id-') || className.startsWith('postid-'));
        if (classWithId) {
            if (classWithId.startsWith('page-id-')) {
                return classWithId.replace('page-id-', '');
            } else if (classWithId.startsWith('postid-')) {
                return classWithId.replace('postid-', '');
            } else {
                return null;
            }
        }

        return false;
    }
})(jQuery);