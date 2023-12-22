<?php
namespace popups\classes\views;

use popups\classes\models\PopupItem;

class MetaBox {

    public static function init() {
        add_meta_box( 'proxima-popups', 'Popup Settings', [
            __CLASS__,
            'renderMetaBox'
        ], PopupItem::POST_TYPE, 'normal', 'high' );
    }

    public static function renderMetaBox() {
        include_once plugin_dir_path( __FILE__ ) . 'metaBoxView.php';
    }

    public function savePopupMetaBoxData( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        $possible_meta_keys = [
            'popup_image_id',
            'popup_type',
            'top_text_color',
            'button_color',
            'button_text_color',
            'button_text',
            'show_date',
            'event_button_link',
            'event_date',
            'event_start_time',
            'event_end_time',
            'subscription_placeholder_name',
            'subscription_placeholder_email',
            'subscription_placeholder_phone',
        ];

        if(!isset($_POST['show_date'])) {
            $_POST['show_date'] = false;
        }

        foreach ( $possible_meta_keys as $meta_key ) {
            if ( isset( $_POST[ $meta_key ] ) ) {
                update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $meta_key ] ) );
            }
        }
    }
}