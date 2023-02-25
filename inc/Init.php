<?php

namespace WP_SPlus_Inc;

final class Init {

    /**
     * Store all classes inside an array
     * @return array Full list of classes
     */
    public static function get_services() {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLink::class,
            Base\RegisterNewUser::class,
            Base\UpdateProfile::class,
            Base\FinancialTransaction::class
        ];
    }

    /**
     * Loop through the classes, initialize theme,
     * and call the register() method if it exists
     * @return 
     */
    public static function register_services() {
        foreach ( self::get_services() as $class ) {
            $service = self::instantiate( $class );
            if ( method_exists( $service, 'register' ) ) {
                $service -> register();
            }
        }
    }

    /**
     * Initialize the class
     * @param class $class The class from the services array
     * @return class New instance of the class
     */
    private static function instantiate( $class ) {
        return new $class();
    }
}
