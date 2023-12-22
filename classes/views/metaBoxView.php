<?php global $post;
$popup_image_id                 = get_post_meta( $post->ID, 'popup_image_id', true );
$image_url                      = wp_get_attachment_image_url( $popup_image_id, 'small' );
$popup_type                     = get_post_meta( $post->ID, 'popup_type', true );
$top_text_color                 = get_post_meta( $post->ID, 'top_text_color', true );
$button_color                   = get_post_meta( $post->ID, 'button_color', true );
$button_text_color              = get_post_meta( $post->ID, 'button_text_color', true );
$button_text                    = get_post_meta( $post->ID, 'button_text', true );
$show_date                      = get_post_meta( $post->ID, 'show_date', true );
$event_button_link              = get_post_meta( $post->ID, 'event_button_link', true );
$event_date                     = get_post_meta( $post->ID, 'event_date', true );
$event_start_time               = get_post_meta( $post->ID, 'event_start_time', true );
$event_end_time                 = get_post_meta( $post->ID, 'event_end_time', true );
$subscription_placeholder_name  = get_post_meta( $post->ID, 'subscription_placeholder_name', true );
$subscription_placeholder_email = get_post_meta( $post->ID, 'subscription_placeholder_email', true );
$subscription_placeholder_phone = get_post_meta( $post->ID, 'subscription_placeholder_phone', true );

?>
<p class="settings-heading">Base settings</p>
<div class="base-settings settings-block">
    <h3>Popup type</h3>
    <div class="base-settings_type">
        <div class="base-settings_type-item">
            <input type="radio" id="popup_type_event" name="popup_type"
                   value="event" <?php echo $popup_type === 'event' ? 'checked' : ''; ?>>
            <label for="popup_type_event">Event informing</label>
        </div>
        <div class="base-settings_type-item">
            <input type="radio" id="popup_type_subscription" name="popup_type"
                   value="subscription" <?php echo $popup_type === 'subscription' ? 'checked' : ''; ?>>
            <label for="popup_type_subscription">Subscription</label>
        </div>
    </div>

    <h3>Background image</h3>
    <!--  Insert image from Media  -->
    <div>
        <input type="hidden" id="popup-image-id" name="popup_image_id"
               value="<?php echo esc_attr( $popup_image_id ); ?>">
        <div id="popup-image-preview">
            <?php if ( $image_url ) : ?>
                <img src="<?php echo esc_url( $image_url ); ?>" alt="Custom Image">
            <?php endif; ?>
        </div>
        <button id="popup-image-upload-button" class="button">Upload Image</button>
        <button id="popup-image-remove-button" class="button">Remove Image</button>
    </div>

    <h3>Colors</h3>
    <div>
        <label for="top_text_color">Top text color: </label>
        <input type="color" id="top_text_color" name="top_text_color" value="<?php echo $top_text_color; ?>">

        <label for="button_color">Button color: </label>
        <input type="color" id="button_color" name="button_color" value="<?php echo $button_color; ?>">

        <label for="button_text_color">Button text color: </label>
        <input type="color" id="button_text_color" name="button_text_color" value="<?php echo $button_text_color; ?>">
    </div>

    <h3>Button text</h3>
    <input type="text" id="button_text" name="button_text" value="<?php echo $button_text; ?>">
</div>

<div class="event-settings settings-block">
    <p class="settings-heading">Event informing type settings</p>
    <h3>Link to event registration</h3>
    <input class="event_button_link" type="text" id="event_button_link" name="event_button_link"
           value="<?php echo $event_button_link; ?>">

    <div class="settings-show_date">
        <label for="show_date">Show date block? </label>
        <input type="checkbox" id="show_date" name="show_date" <?php echo $show_date == 'on' ? 'checked' : ''; ?>>
    </div>

    <div class="hide_event_date">
        <h3>Event date</h3>
        <input type="text" id="event_date" name="event_date" value="<?php echo $event_date; ?>">

        <h3>Event time</h3>
        <div>
            <label for="event_start_time">Start: </label>
            <input type="time" id="event_start_time" name="event_start_time" value="<?php echo $event_start_time; ?>">

            <label for="event_end_time">End: </label>
            <input type="time" id="event_end_time" name="event_end_time" value="<?php echo $event_end_time; ?>">
        </div>
    </div>
</div>

<div class="subscription-settings settings-block">
    <p class="settings-heading">Subscription type settings</p>
    <h3>Placeholders</h3>
    <div>
        <label for="subscription_placeholder_name">Name: </label>
        <input type="text" id="subscription_placeholder_name" name="subscription_placeholder_name"
               value="<?php echo $subscription_placeholder_name; ?>">

        <label for="subscription_placeholder_email">Email: </label>
        <input type="text" id="subscription_placeholder_email" name="subscription_placeholder_email"
               value="<?php echo $subscription_placeholder_email; ?>">

        <label for="subscription_placeholder_phone">Phone: </label>
        <input type="text" id="subscription_placeholder_phone" name="subscription_placeholder_phone"
               value="<?php echo $subscription_placeholder_phone; ?>">
    </div>
</div>