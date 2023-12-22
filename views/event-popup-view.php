<?php

use popups\App;
use popups\classes\models\PopupItem;

$popup_id = get_option('proxima_popup_event_active');
$popup_image_id = PopupItem::getPopupImageID($popup_id);
$image_url = wp_get_attachment_image_url($popup_image_id, 'full');
$popup_content = PopupItem::getPopupContent( $popup_id );
$show_date = PopupItem::getShowDate( $popup_id );
?>

<div class="popup-container" style="background-image: url('<?php echo $image_url; ?>');">
    <div class="popup-close_button event_close">
        <img src="<?php echo App::$pluginURL; ?>/assets/img/Clear.svg" alt="Close icon">
    </div>
    <div class="popup-content event-popup" style="color: <?php echo PopupItem::getTopTextColor( $popup_id ); ?>">
        <?php echo $popup_content; ?>
    </div>

    <div class="popup-info_container">
        <div class="popup-info <?php echo !empty($show_date) ? 'white_background' : ''; ?>">
            <div class="popup-info_datetime <?php echo empty($show_date) ? 'display_none' : ''; ?>">
                <img class="popup-info_datetime_icon" src="<?php echo App::$pluginURL; ?>/assets/img/calendar.svg"
                     alt="Event icon">
                <p>
                    <span class="popup-date"><?php echo PopupItem::getEventDate( $popup_id ); ?></span>
                    <?php echo PopupItem::getEventStartTime( $popup_id ) . ' - ' . PopupItem::getEventEndTime( $popup_id ); ?>
                </p>
            </div>

            <div class="popup-info_button">
                <a class="popup-info_button_link" href="<?php echo PopupItem::getEventButtonLink( $popup_id ); ?>" target="_blank" style="
                        background-color: <?php echo PopupItem::getButtonColor( $popup_id ); ?>;
                        color: <?php echo PopupItem::getButtonTextColor( $popup_id ); ?> ">
                    <?php echo PopupItem::getButtonText( $popup_id ) ?>
                </a>
            </div>
        </div>
    </div>
</div>
