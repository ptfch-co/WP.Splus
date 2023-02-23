<?php

namespace WP_SPlus_Inc\Api\Callbacks;

class AdminCallback {

    function __construct() {

    }

    function server_address_field() {

        echo '<input type="text"
                     placeholder="http(s)://server-address/api/v1/woocommerce/order/paymentcomplete"
                     name="wp-splus-server[server_address]" 
                     value="'. get_option( 'wp-splus-server' )["server_address"] .'" 
                     style="width: 27.7%; direction: ltr;" />';
    }

    function pass_data_to_server_by_user_register_field() {

        $value = '';
        $obj = get_option( 'wp-splus-settings' );
        
        if ( !empty( $obj ) )
        {
            $value = $obj["pass_data_to_server_by_user_register"] == 'on' ? 'checked' : '';
        }

        echo '<input type="checkbox"
                     name="wp-splus-settings[pass_data_to_server_by_user_register]" 
                     '. $value .' />';
    }

    function pass_data_to_server_by_update_profile_field() {

        $value = '';
        $obj = get_option( 'wp-splus-settings' );
        
        if ( !empty( $obj ) )
        {
            $value = $obj["pass_data_to_server_by_update_profile"] == 'on' ? 'checked' : '';
        }

        echo '<input type="checkbox"
                     name="wp-splus-settings[pass_data_to_server_by_update_profile]" 
                     '. $value .' />';
    }
}