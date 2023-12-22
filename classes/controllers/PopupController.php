<?php

namespace popups\classes\controllers;

use popups\App;

class PopupController {
    public function __construct() {
        add_action( 'wp_ajax_get_popup', [ $this, 'getPopup' ] );
        add_action( 'wp_ajax_nopriv_get_popup', [ $this, 'getPopup' ] );
    }

    public function getPopup() {
        $page_id   = $_POST['currentPageId'];
        $page_type = $_POST['currentPageType'];

        if ( $this->isShowEventOnPage( $page_id ) || $this->isShowEventOnPost( $page_id ) || $this->isShowEventOnArchive( $page_type ) ) {
            // Show event type popup
            wp_send_json_success( [
                'popup_type' => 'event',
                'popup_html' => $this->showEvent()
            ] );

            wp_die();
        }

        if ( $this->isShowSubscriptionOnPage( $page_id ) || $this->isShowSubscriptionOnPost( $page_id ) || ( $page_type === 'archive' && $this->isShowSubscriptionOnArchive() ) ) {

            // Show subscription type popup
            wp_send_json_success( [
                'popup_type' => 'subscription',
                'popup_html' => $this->showSubscription()
            ] );

            wp_die();
        }

        wp_die();
    }

    public function showEvent() {
        ob_start();
        include( App::$pluginDIR . '/views/event-popup-view.php' );

        return ob_get_clean();
    }

    public function showSubscription() {
        ob_start();
        include( App::$pluginDIR . '/views/subscription-popup-view.php' );

        return ob_get_clean();
    }

    public function isShowEventOnPage( $page_id ) {
        $pages_where_show = get_option( 'proxima_popup_event_pages' );

        if ( is_array( $pages_where_show ) ) {
            return in_array( (int) $page_id, $pages_where_show ) || in_array( 'all', $pages_where_show );
        } else {
            return false;
        }
    }

    public function isShowSubscriptionOnPage( $page_id ) {
        $pages_where_show = get_option( 'proxima_popup_subscription_pages' );

        if ( is_array( $pages_where_show ) ) {
            return in_array( (int) $page_id, $pages_where_show ) || in_array( 'all', $pages_where_show );
        } else {
            return false;
        }
    }

    public function isShowEventOnPost( $post_id ) {
        $posts_where_show = get_option( 'proxima_popup_event_posts' );

        if ( is_array( $posts_where_show ) ) {
            return in_array( (int) $post_id, $posts_where_show ) || in_array( 'all', $posts_where_show );
        } else {
            return false;
        }
    }

    public function isShowSubscriptionOnPost( $post_id ) {
        $posts_where_show = get_option( 'proxima_popup_subscription_posts' );

        if ( is_array( $posts_where_show ) ) {
            return in_array( (int) $post_id, $posts_where_show ) || in_array( 'all', $posts_where_show );
        } else {
            return false;
        }
    }

    public function isShowEventOnArchive( $page_type ) {
        $checkbox_value = get_option( 'proxima_popup_event_archive' );

        return $checkbox_value === 'on' && $page_type == 'archive';
    }

    public function isShowSubscriptionOnArchive() {
        $checkbox_value = get_option( 'proxima_popup_subscription_archive' );

        return $checkbox_value === 'on';
    }

}