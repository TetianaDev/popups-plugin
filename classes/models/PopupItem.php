<?php
namespace popups\classes\models;

class PopupItem extends Post {
    public const POST_TYPE = 'popup-item';
    protected static $postTypeOptions = [
        'label'           => 'Popups',
        'labels'          => [
            'name'               => 'Popups',
            'singular_name'      => 'Popup',
            'add_new'            => 'Add popup',
            'add_new_item'       => 'Add new popup',
            'edit_item'          => 'Edit popup',
            'new_item'           => 'New popup',
            'view_item'          => 'View popup',
            'search_items'       => 'Search popup',
            'not_found'          => 'Not found',
            'not_found_in_trash' => 'Not found in trash',
            'menu_name'          => 'Popups',
        ],
        'description'     => '',
        'public'          => true,
        'show_in_menu'    => null,
        'show_in_rest'    => true,
        'menu_position'   => null,
        'menu_icon'       => 'dashicons-pressthis',
        'capability_type' => 'post',
        'hierarchical'    => false,
        'supports'        => [ 'title', 'editor', 'page-attributes' ],
        'has_archive'     => false,
        'rewrite'         => true,
        'query_var'       => true,
    ];

    public static function getPopupContent( $post_id ) {
        return get_the_content( '', false, $post_id );
    }

    public static function getPopupImageID( $post_id ) {
        return get_post_meta( $post_id, 'popup_image_id', true );
    }

    public static function getPopupTypeID( $post_id ) {
        return get_post_meta( $post_id, 'popup_type', true );
    }

    public static function getTopTextColor( $post_id ) {
        return get_post_meta( $post_id, 'top_text_color', true );
    }

    public static function getButtonColor( $post_id ) {
        return get_post_meta( $post_id, 'button_color', true );
    }

    public static function getButtonTextColor( $post_id ) {
        return get_post_meta( $post_id, 'button_text_color', true );
    }

    public static function getButtonText( $post_id ) {
        return get_post_meta( $post_id, 'button_text', true );
    }

    public static function getShowDate( $post_id ) {
        return get_post_meta( $post_id, 'show_date', true );
    }

    public static function getEventButtonLink( $post_id ) {
        return get_post_meta( $post_id, 'event_button_link', true );
    }

    public static function getEventDate( $post_id ) {
        return get_post_meta( $post_id, 'event_date', true );
    }

    public static function getEventStartTime( $post_id ) {
        return get_post_meta( $post_id, 'event_start_time', true );
    }

    public static function getEventEndTime( $post_id ) {
        return get_post_meta( $post_id, 'event_end_time', true );
    }

    public static function getSubscriptionNamePlaceholder( $post_id ) {
        return get_post_meta( $post_id, 'subscription_placeholder_name', true );
    }

    public static function getSubscriptionEmailPlaceholder( $post_id ) {
        return get_post_meta( $post_id, 'subscription_placeholder_email', true );
    }

    public static function getSubscriptionPhonePlaceholder( $post_id ) {
        return get_post_meta( $post_id, 'subscription_placeholder_phone', true );
    }
}