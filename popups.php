<?php
/**
 * Plugin Name: Popups
 * Description: The plugin that allows you to create popups
 * Version:     1.0.0
 * Author:      TetianaDev
 */

namespace popups;

use popups\classes\controllers\FormController;
use popups\classes\controllers\PopupController;
use popups\classes\models\PopupItem;
use popups\classes\views\AdminSettingsPage;
use popups\classes\views\MetaBox;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

final class App {
    const TEXT_DOMAIN = 'proxima-popups';
    const PLUGIN_VERSION = '1.0.0';
    public static $pluginURL = null;
    public static $pluginDIR = __DIR__;

    public function __construct() {
        self::$pluginURL = plugin_dir_url( __FILE__ );

        $this->autoload();
        new PopupController();
        add_action( 'init', function () {
            PopupItem::init();

        } );

        add_action( 'add_meta_boxes', function () {
            MetaBox::init();
        } );

        add_action( 'wp_enqueue_scripts', [ $this, 'registerAssets' ] );
        add_action( 'admin_menu', [ $this, 'addSettingsPage' ] );

        // Need to do like that because if I try to call this hook from MetaBox class it wouldn't work
        add_action( 'save_post', [ $this, 'savePopupMetaBoxData' ], 20 );

        // Form ajax init
        add_action( 'wp_ajax_submit_form', [ $this, 'submitForm' ] );
        add_action( 'wp_ajax_nopriv_submit_form', [ $this, 'submitForm' ] );
    }

    public function savePopupMetaBoxData( $post_id ) {
        $metaBox = new MetaBox();
        $metaBox->savePopupMetaBoxData( $post_id );
    }

    public function registerAssets() {
        wp_enqueue_script( 'jquery' );

        wp_register_script( self::TEXT_DOMAIN . '-scripts', self::$pluginURL . 'assets/js/scripts.js', [ 'jquery' ], self::PLUGIN_VERSION, true );
        wp_localize_script( self::TEXT_DOMAIN . '-scripts', 'popupSettings', [
            'ajaxurl'         => admin_url( 'admin-ajax.php' ),
            'popupTimeOffset' => get_option( 'proxima_popup_offset_time' )
        ] );
        wp_enqueue_script( self::TEXT_DOMAIN . '-scripts' );

        wp_register_style( self::TEXT_DOMAIN . '-styles', self::$pluginURL . 'assets/css/style.css', '', self::PLUGIN_VERSION );
        wp_enqueue_style( self::TEXT_DOMAIN . '-styles' );
    }

    public function addSettingsPage() {
        wp_register_script( self::TEXT_DOMAIN . '-admin-scripts', self::$pluginURL . 'assets/js/admin-scripts.js', [ 'jquery' ], self::PLUGIN_VERSION, true );
        wp_localize_script( self::TEXT_DOMAIN . '-admin-scripts', 'adminPopupSettings', [
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ] );
        wp_enqueue_script( self::TEXT_DOMAIN . '-admin-scripts' );

        wp_register_style( self::TEXT_DOMAIN . '-admin-styles', self::$pluginURL . 'assets/css/admin-style.css', '', self::PLUGIN_VERSION );
        wp_enqueue_style( self::TEXT_DOMAIN . '-admin-styles' );

        AdminSettingsPage::init();
    }

    public function submitForm() {
        $name = $_POST['values']['name'];
        $email = $_POST['values']['email'];
        $phone = $_POST['values']['phone'];

        $form = new FormController($name, $email, $phone);

        $is_processed = $form->processForm(get_option('proxima_popup_emails'));

        if($is_processed) {
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }
    }

    private function autoload() {
        require_once self::$pluginDIR . '/Autoloader.php';
        $autoloader = new Autoloader( [
            'directory'        => self::$pluginDIR,
            'namespace_prefix' => 'popups',
            'classes_dir'      => [ '' ],
        ] );
        $autoloader->init();
    }
}

new App();