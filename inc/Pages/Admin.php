<?php

namespace WP_SPlus_Inc\Pages;

use \WP_SPlus_Inc\Api\SettingsApi;
use \WP_SPlus_Inc\Api\Callbacks\AdminCallback;

class Admin {

    public $settings;
    public $callback;

    function __construct() {

    }

    public function register() {
        
        $subPages = array(
            array(
                'parent_slug' => 'options-general.php',
                'page_title'  => 'اتصال وب سایت وردپرس به پلتفرم سامری',
                'menu_title'  => 'اتصال به سامری',
                'capability'  => 'administrator',
                'menu_slug'   => 'wp-splus',
                'callback'    => array( $this, 'viewIndex' ),
                'position'    => 1
            )
        );

        $this -> settings = new SettingsApi();
        $this -> callback = new AdminCallback();

        $this -> setSettings();
        $this -> setSections();
        $this -> setFields(); 

        $this -> settings -> addSubPages( $subPages ) -> register();
    }

    function viewIndex() {
        require_once WP_SPlus_PLUGIN_PATH . '/templates/index.php';
    }

    function setSettings() {

        $this -> settings -> setSettings( array(
            array(
                'option_group' => 'wp-splus-server-group',
                'option_name'  => 'wp-splus-server'
            ),
            array(
                'option_group' => 'wp-splus-settings-group',
                'option_name'  => 'wp-splus-settings'
            ),
        ));
    }

    function setSections() {

        $this -> settings -> setSections( array(
            array(
                'id'       => 'wp-splus-server-section',
                'title'    => '',
                'page'     => 'wp-splus-server'
            ),
            array(
                'id'       => 'wp-splus-settings-section',
                'title'    => '',
                'page'     => 'wp-splus-settings'
            ),
        ));
    }

    function setFields() {

        $this -> settings -> setFields( array(
            array(
                'id'       => 'server_address',
                'title'    => 'آدرس سرور',
                'callback' => array( $this -> callback, 'server_address_field' ),
                'page'     => 'wp-splus-server',
                'section'  => 'wp-splus-server-section',
                'args'     => array()
            ),
            array(
                'id'       => 'pass_data_to_server_by_user_register',
                'title'    => 'وب هوک ایجاد کاربر جدید',
                'callback' => array( $this -> callback, 'pass_data_to_server_by_user_register_field' ),
                'page'     => 'wp-splus-settings',
                'section'  => 'wp-splus-settings-section',
                'args'     => array()
            ),
            array(
                'id'       => 'pass_data_to_server_by_update_profile',
                'title'    => 'وب هوک ویرایش کاربر',
                'callback' => array( $this -> callback, 'pass_data_to_server_by_update_profile_field' ),
                'page'     => 'wp-splus-settings',
                'section'  => 'wp-splus-settings-section',
                'args'     => array()
            ),
            array(
                'id'       => 'default_financial_transactions_type_code',
                'title'    => 'کلید تراکنش‌های مالی',
                'callback' => array( $this -> callback, 'default_financial_transactions_type_code' ),
                'page'     => 'wp-splus-settings',
                'section'  => 'wp-splus-settings-section',
                'args'     => array()
            )
        ));
    }
}
