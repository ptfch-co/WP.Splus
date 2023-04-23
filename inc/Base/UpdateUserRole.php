<?php

namespace WP_SPlus_Inc\Base;

class UpdateUserRole {

    function register() {
        add_action( 'rest_api_init' , array( $this, 'update_user_role' ) );
    }

    function update_user_role() {
        register_rest_route( 'wp/v1/user/(?P<id>[a-zA-Z0-9+!*(),;?&=\$_.-]+)', '/role/to/(?P<value>[a-zA-Z0-9+!*(),;?&=\$_.-]+)', array(
            'methods'               => 'GET',
            'callback'              => array( $this, 'update' ),
            'permission_callback'   => function() { return __return_true(); }
        ));
    }

    function update($parameters) {
        // Retrieve the user with ID
        $user = get_user_by( 'ID', $parameters['id'] );
        // Retrieve the user with Login name if the $user variable is false
        if ( !$user ) {
            // Retrieve the user with Login name
            $user = get_user_by( 'login', $parameters['id'] );
        }
        // When the $user variable is null then return nothing
        if ( !$user ) return;
        // Update user role with user ID
        $user -> set_role( $parameters['value'] );       
    }
}