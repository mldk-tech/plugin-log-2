<?php

/**
 * Plugin Name:       Log-2
 * Plugin URI:        http://localhost/log-testing/
 * Description:       A simple plugin for creating custom post types and get post types content.
 * Version:           1.0.0
 * Author:            David Kohav     
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       logs-2
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Require
 */
require_once __DIR__ . '/post-types/register.php';


class Log2 {
    /**
     * Define Plugin Version
     */
    const VERSION = '1.0.0';


    /**
     * Construct Function
     */
    public function __construct() {
        $this->plugin_constants();
        add_action('init', 'log2_register');
        add_action( 'save_post', [$this, 'get_post_type_content']); 
    }


    /**
     * Plugin Constants
     * @since 1.0.0
     */
    public function plugin_constants() {
        define( 'LOG2_VERSION', self::VERSION );
        define( 'LOG2_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
        define( 'LOG2_PLUGIN_URL', plugins_url( '', __FILE__ ) );
    }

    /**
     * Singletone Instance
     * @since 1.0.0
     */
    public static function init() {
        static $instance = false;

        if( !$instance ) {
            $instance = new self();
        }

        return $instance;
    }

    private function create_log2($post_type_content) {

        $content = __('A new page of type '. $post_type_content->post_type . 
                ' is created and is name ' . html_entity_decode($post_type_content->post_title) .
                ' by user ' . $post_type_content->post_author);
         
    
         // Create post object
        $my_post = array(
            'post_title'    => $post_type_content->post_modified,
            'post_content'  => $content,
            'post_status'   => 'publish',
            'post_author'   => $post_type_content->post_author,
            'post_type'     => 'log2'
        );
        
        // Insert the post into the database
        
         $post_id = wp_insert_post( $my_post );
         if(!is_wp_error($post_id)){
            //the post is valid
          }else{
            //there was an error in the post insertion, 
            echo $post_id->get_error_message();
          }
    
    
    }

    public function get_post_type_content($post_id) {
        $post_type_content = get_post($post_id);
        $post_type = $post_type_content->post_type;
        if (($post_type == 'post') || ($post_type == 'page')) {
            $this->create_log2($post_type_content);
        }
    
    }
}

/**
 * Initialize Main Plugin
 * @since 1.0.0
 */
function logs2_kickstart() {
    return Log2::init();
}

// Run the Plugin
logs2_kickstart();