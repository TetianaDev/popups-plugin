<?php

use popups\classes\models\PopupItem;
use popups\App;

$popup_id       = get_option( 'proxima_popup_subscription_active' );
$popup_image_id = PopupItem::getPopupImageID( $popup_id );
$image_url      = wp_get_attachment_image_url( $popup_image_id, 'full' );
$popup_content = PopupItem::getPopupContent( $popup_id );

?>

<div class="popup-container" style="background-image: url('<?php echo $image_url; ?>');">
    <div class="popup-close_button subscription_close">
        <img src="<?php echo App::$pluginURL; ?>/assets/img/Clear.svg" alt="Close icon">
    </div>
    <div class="popup-content" style="color: <?php echo PopupItem::getTopTextColor( $popup_id ); ?>">
        <?php echo substr($popup_content, 0, 800); ?>
    </div>

    <div class="popup-form">
        <form action="" method="post" class="subscription_form">
            <div class="popup-form_input_wrapper">
                <span class="popup-form_icon popup-form_name_icon">
                    <img src="<?php echo App::$pluginURL; ?>/assets/img/user.svg" alt="Name icon">
                </span>
                <input class="popup-form_item popup-form_name" type="text" required
                       placeholder="<?php echo PopupItem::getSubscriptionNamePlaceholder( $popup_id ) ?: 'Name'; ?>">
            </div>

            <div class="popup-form_input_wrapper">
                <span class="popup-form_icon popup-form_email_icon">
                    <img src="<?php echo App::$pluginURL; ?>/assets/img/letter.svg" alt="Email icon">
                </span>
                <input class="popup-form_item popup-form_email" type="email" required
                       placeholder="<?php echo PopupItem::getSubscriptionEmailPlaceholder( $popup_id ) ?: 'Email'; ?>">

            </div>

            <div class="popup-form_input_wrapper">
                <span class="popup-form_icon popup-form_phone_icon">
                    <img src="<?php echo App::$pluginURL; ?>/assets/img/call-dropped-rounded.svg" alt="Phone icon">
                </span>
                <input class="popup-form_item popup-form_phone" type="number" min="0" max="999999999999"
                       placeholder="<?php echo PopupItem::getSubscriptionPhonePlaceholder( $popup_id ) ?: 'Phone'; ?>">

            </div>

            <button class="popup-form_item popup-form_submit"
                    type="submit" name="subscription_form_submit"><?php echo PopupItem::getButtonText( $popup_id ) ?: 'Submit'; ?></button>
        </form>
    </div>
</div>