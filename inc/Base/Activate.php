<?php

namespace WP_SPlus_Inc\Base;

/**
 * Trigger this file on Plugin activate
 */
class Activate {
    /**
    * Activate plugin method
    */
    public static function run() {
       
        if ( ! get_option( 'wp-splus-server' ) ) 
        {
            update_option( 'wp-splus-server', array(
                'server_address' => '',
                'default_financial_transactions_type_code' => ''
            ));
        }

        if ( ! get_option( 'wp-splus-settings' ) ) 
        {
            update_option( 'wp-splus-settings', array(
                'pass_data_to_server_by_user_register' => '',
                'pass_data_to_server_by_update_profile' => '',
                'Key_4_Webserice' => ''
            ));
        }
    }
}