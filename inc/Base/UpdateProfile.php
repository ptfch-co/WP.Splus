<?php

namespace WP_SPlus_Inc\Base;

class UpdateProfile
{
    function register()
    {
        if ( empty( get_option( 'wp-splus-server' )[ 'server_address' ] ) ) 
        {
            return;
        }
        
        $settings = get_option( 'wp-splus-settings' );
        
        if( !empty( $settings ) && $settings['pass_data_to_server_by_update_profile'] == 'on' )
        {
            add_action( 'profile_update', array($this, 'update_profile' ) );
        }
    }

    function update_profile( $user_id )
    {
        $result = array(
            'RequestFrom' => 'WordPress',
            'RequestType' => 'UpdateUserProfile'
        );

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

        $result['Request.Type'] = "Update";

        $args = array(
            'headers' => array('Content-Type' => 'application/json; charset=utf-8'),
            'body' => json_encode( $result ),
        );

        wp_remote_post( get_option( 'wp-splus-server' )[ 'server_address' ] . '/api/v1/workflows/body/submit', $args );
    }
}