<?php

/*
    Plugin Name: اتصال وب سایت وردپرس به پلتفرم سامری
    Plugin URI : https://crm-support.ir
    Description: افزونه‌ای جهت اتصال وب سایت وردپرسی به پلتفرم سامری.
    Version    : x.x.x
    Author     : PTFCH
    Author URI : https://crm-support.ir
    License    : GPLv2 or later
*/

// If this file is called firectly, abort!
defined('ABSPATH') or die('Hey, you can not access this file, you silly human!');

// Require once the Composer autoload
if (file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// Define CONSTANTS
define( 'WP_SPlus_PLUGIN', plugin_basename( __FILE__ ) );
define( 'WP_SPlus_PLUGIN_URL', plugin_dir_url(__FILE__ ) );
define( 'WP_SPlus_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation
 */
function wp_splus_activation() {
    WP_SPlus_Inc\Base\Activate::run();
}

/**
 * The code that run during plugin deactivation
 */
function wp_splus_deactivation() {
    WP_SPlus_Inc\Base\Deactivate::run();
}

register_activation_hook( __FILE__, 'wp_splus_activation' );
register_deactivation_hook( __FILE__, 'wp_splus_deactivation' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'WP_SPlus_Inc\\Init' )) {
    WP_SPlus_Inc\Init::register_services();
}
