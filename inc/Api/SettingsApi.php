<?php

namespace WP_SPlus_Inc\Api;

class SettingsApi {

    public $admin_pages = array();
    public $admin_subpages = array();
    public $settings = array();
    public $sections = array();
    public $fields = array();

    function __construct() {

    }

    function register() {

        if ( ! empty( $this -> admin_pages ) ) {
            add_action( 'admin_menu' , array( $this, 'add_admin_menu' ) );
        }
        
        if ( ! empty( $this -> admin_subpages ) ) {
            add_action( 'admin_menu' , array( $this, 'add_admin_submenu' ) );
        }

        if ( ! empty( $this -> settings ) ) {
            add_action( 'admin_init', array( $this, 'registerCustomFields' ) );
        }
    }

    function add_admin_menu() {
        
        foreach ( $this -> admin_pages as $page ) {
            add_menu_page(
                $page["page_title"],
                $page["menu_title"],
                $page["capability"],
                $page["menu_slug"],
                $page["callback"],
                $page["icon_url"],
                $page["position"]
            );
        }
    }

    function add_admin_submenu() {
        
        foreach ( $this -> admin_subpages as $page ) {
            add_submenu_page(
                $page["parent_slug"],
                $page["page_title"],
                $page["menu_title"],
                $page["capability"],
                $page["menu_slug"],
                $page["callback"],
                $page["position"]
            );
        }
    }

    function addPages( array $pages ) {

        $this -> admin_pages = $pages;
        return $this;
    }

    function addSubPages( array $subPages ) {

        $this -> admin_subpages = $subPages;
        return $this; 
    }

    function registerCustomFields() {
        
        // Register setting
        foreach ( $this -> settings as $setting ) {

            register_setting( $setting["option_group"], $setting["option_name"], ( isset( $setting["callback"] ) ? 
                $setting["callback"] : "" ));
        }

        // Add settings section
        foreach ( $this -> sections as $section ) {
            add_settings_section( $section["id"], $section["title"], ( isset( $section["callback"] ) ?
                $section["callback"] : "" ), $section["page"] );
        }
            
        // Add settings fields 
        foreach ( $this -> fields as $field ) {
            add_settings_field( $field["id"], $field["title"], ( isset( $field["callback"] ) ?
                $field["callback"] : "" ), $field["page"], $field["section"], ( isset( $field["args"] ) ?
                    $field["args"] : "" ) );
        }
    }

    function setSettings( array $settings ) {

        $this -> settings = $settings;
        return $this;
    }

    function setSections( array $sections ) {

        $this -> sections = $sections;
        return $this;
    }

    function setFields( array $fields ) {

        $this -> fields = $fields;
        return $this;
    }
}