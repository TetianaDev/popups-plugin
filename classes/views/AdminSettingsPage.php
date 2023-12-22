<?php

namespace popups\classes\views;

use popups\classes\models\PopupItem;
use WP_Query;

class AdminSettingsPage {
    public static function init() {
        add_submenu_page( 'edit.php?post_type=' . PopupItem::POST_TYPE, 'Popups settings', 'Popups settings', 'manage_options', 'proxima-popups-settings', [
            __CLASS__,
            'renderSettingsPage'
        ] );

        add_action( 'admin_init', [ __CLASS__, 'savePopupsOptions' ] );
    }

    public static function renderSettingsPage() {
        $popups              = static::getPopups();
        $popups_event        = $popups['event'];
        $popups_subscription = $popups['subscription'];

        $posts = static::getItemsForOptions( 'post' );
        $pages = static::getItemsForOptions( 'page' );

        include_once plugin_dir_path( __FILE__ ) . 'adminSettingsPageView.php';
    }

    public static function savePopupsOptions() {
        if ( isset( $_POST['action'] ) && $_POST['action'] === 'proxima_save_popups_options' ) {
            // Verify the nonce for security purposes
            if ( ! isset( $_POST['proxima_save_popups_options_nonce'] ) || ! wp_verify_nonce( $_POST['proxima_save_popups_options_nonce'], 'proxima_save_popups_options_nonce' ) ) {
                wp_die( 'Invalid nonce' );
            }

            // Get the input field values
            $popup_event_active         = sanitize_text_field( $_POST['popup_event_active'] );
            $popup_event_posts          = $_POST['popup_event_posts'];
            $popup_event_pages          = $_POST['popup_event_pages'];
            $popup_event_archive        = sanitize_text_field( $_POST['popup_event_archive'] );
            $popup_subscription_active  = sanitize_text_field( $_POST['popup_subscription_active'] );
            $popup_subscription_posts   = $_POST['popup_subscription_posts'];
            $popup_subscription_pages   = $_POST['popup_subscription_pages'];
            $popup_subscription_archive = sanitize_text_field( $_POST['popup_subscription_archive'] );
            $popup_offset_time          = sanitize_text_field( $_POST['popup_offset_time'] );
            $popup_emails               = sanitize_text_field( $_POST['popup_emails'] );

            // Save the values to WordPress options
            update_option( 'proxima_popup_event_active', $popup_event_active );
            update_option( 'proxima_popup_event_posts', $popup_event_posts );
            update_option( 'proxima_popup_event_pages', $popup_event_pages );
            update_option( 'proxima_popup_event_archive', $popup_event_archive );
            update_option( 'proxima_popup_subscription_active', $popup_subscription_active );
            update_option( 'proxima_popup_subscription_posts', $popup_subscription_posts );
            update_option( 'proxima_popup_subscription_pages', $popup_subscription_pages );
            update_option( 'proxima_popup_subscription_archive', $popup_subscription_archive );
            update_option( 'proxima_popup_offset_time', $popup_offset_time );
            update_option( 'proxima_popup_emails', $popup_emails );

            // Redirect the user back to the settings page
            wp_redirect( admin_url( 'edit.php?post_type=' . PopupItem::POST_TYPE . '&page=proxima-popups-settings' ) );
            exit;
        }
    }

    public static function getPopups() {
        $popup_args = [
            'post_type'      => PopupItem::POST_TYPE,
            'post_status'    => 'publish',
            'posts_per_page' => - 1
        ];

        $popup_query = new WP_Query( $popup_args );
        $popup_posts = $popup_query->get_posts();

        $popups_event        = [];
        $popups_subscription = [];
        foreach ( $popup_posts as $popup_post ) {
            $popup_type = get_post_meta( $popup_post->ID, 'popup_type', true );

            switch ( $popup_type ) {
                case 'event':
                    $popups_event[] = [
                        'popup_name' => $popup_post->post_title,
                        'popup_id'   => $popup_post->ID
                    ];
                    break;
                case 'subscription':
                    $popups_subscription[] = [
                        'popup_name' => $popup_post->post_title,
                        'popup_id'   => $popup_post->ID
                    ];
                    break;
                default:
                    break;
            }
        }

        return [
            'event'        => $popups_event,
            'subscription' => $popups_subscription
        ];
    }

    public static function getItemsForOptions( $type ) {
        $items_args = [
            'post_type'      => $type,
            'post_status'    => 'publish',
            'posts_per_page' => - 1
        ];

        $items_query = new WP_Query( $items_args );
        $items       = $items_query->get_posts();

        return array_map( function ( $item ) {
            return [
                'post_name' => $item->post_title,
                'post_id'   => $item->ID
            ];
        }, $items );
    }
}