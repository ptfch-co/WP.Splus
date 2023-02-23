<?php

namespace WP_SPlus_Inc\Base;

class Enqueue {

    function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    /**
     * Enqueue all our scripts
     */
    function enqueue() {
        wp_enqueue_style( 'wp-splus.style',  WP_SPlus_PLUGIN_URL . 'assets/styles.css' ); 
        wp_enqueue_script( 'wp-splus.script', WP_SPlus_PLUGIN_URL . 'assets/scripts.js' ); 
    }
}