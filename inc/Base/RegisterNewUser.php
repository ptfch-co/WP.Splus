<?php

namespace WP_SPlus_Inc\Base;

class RegisterNewUser {

    function __construct() {
        
    }

    function register() {

        $settings = get_option( 'wp-splus-settings' );

        if (!empty($settings) && $settings['pass_data_to_server_by_user_register'] == 'on')
        {
            add_action( 'user_register', array($this, 'user_register'));
        }
    }

    function user_register($user_id) {

        $server_address = get_option( 'wp-splus-server' )[ 'server_address' ];

        if ( empty( $server_address) ) return;

        $result = array();

        foreach( get_user_by('id', $user_id)  as $key => $details)
        {
            if ( is_object( $details ))
            {
                foreach ($details as $sub_key => $info)
                {
                    $result['User.Details.' . $sub_key] = $info;
                }
            }
            else if ( !is_array( $details ))
            {
                $result['User.' . $key] = $details;
            }
        }

        foreach( get_user_meta( $user_id)  as $key => $val)
        {
            $result['User.Extended.' . $key] = $val[0];
        }

        $result['Request.Type'] = "New";

        wp_remote_post( $server_address, array(
            'headers' => array('Content-Type' => 'application/json; charset=utf-8'),
            'body' => json_encode( $result )
        ));
    }
}