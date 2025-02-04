<?php
/**
 * Plugin Name: Xubix Plugin
 * Description: Auto embed any embbedable content from external URLs into Elementor.
 * Plugin URI:  https://google.com/
 * Version:     1.0.0
 * Author:      Xubix Developer
 * Author URI:  https://google.com/
 * Text Domain: elementor-title-widget
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register title Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_title_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/title-widget.php' );

	$widgets_manager->register( new \Elementor_title_Widget() );

}
add_action( 'elementor/widgets/register', 'register_title_widget' );