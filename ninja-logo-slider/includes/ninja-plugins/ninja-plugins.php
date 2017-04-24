<?php

if( ! class_exists( 'NINJAPlugins' ) ){
    
    class NINJAPlugins{
        
        /**
         * Singleton Instance
         *
         * @access private static
         */
        private static $_instance;
        
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'ninja_main_menu' ) );
        }
        
        /**
         * Get class singleton instance
         *
         * @return Class Instance
         */
        public static function get_instance() {
            if ( ! self::$_instance instanceof NINJAPlugins ) {
                self::$_instance = new NINJAPlugins();
            }
            
            return self::$_instance;
        
}    
        public function ninja_main_menu() {

            add_submenu_page( 
                'edit.php?post_type=ninja-logo-slider', 
                'ninja Plugins', 
                'ninja Plugins', 
                'manage_options', 
                'ninja-add-ons', 
                array( $this, 'ninja_main_menu_cb' )
                );
        }
        
        public function ninja_main_menu_cb() {
            $protocol = is_ssl() ? 'https' : 'http';
            $promo_content = wp_remote_get( $protocol . '' );
            echo $promo_content['body'];
        }
        
    }
    
    $tmev = NINJAPlugins::get_instance();
    
}