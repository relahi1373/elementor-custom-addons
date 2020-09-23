<?php
/*
Plugin Name: Elementor custom addons
Plugin URI: github
Description: Add two custom elements. ImageList and Posts.
Version: 1.0.0
Author: RezaElahi
Author URI: relahi1373@gmail.com
Text Domain: elementor-custom-adddons
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

///
/// Include Autoloader
///
require_once __DIR__.'/vendor/autoload.php';

///
/// Define Constants
///
define('ECA_PATH' , plugin_dir_path(__FILE__));
define('ECA_URL' , plugin_dir_url(__FILE__));

add_action('plugins_loaded' , 'eca_fire_up');
/**
 * Initialize ElementorCustomAddons module.
 * @hooked 'plugins_loaded'
 *
 * @since 1.0.0
 */
function eca_fire_up(){

	\ECA\Setup::setup();
}

add_action('after_setup_theme' , 'after_setup_theme_callback');

/**
 * @hooked 'after_setup_theme'
 *
 * @since 1.0.0
 */
function after_setup_theme_callback(){

	add_image_size('posts-size' , 300 , 300 , true);
}
