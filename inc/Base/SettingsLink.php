<?php

namespace WP_SPlus_Inc\Base;

class SettingsLink {

    function register() {
        
        add_filter( "plugin_action_links_" . WP_SPlus_PLUGIN, array( $this, 'settings_link' ) );
    }

    function settings_link( $links ) {
        
        array_push( $links, '<a href="admin.php?page=wp-splus">تنظیمات</a>' );
        
        return $links;
    }
}