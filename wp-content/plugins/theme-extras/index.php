<?php

/*
Plugin Name: TommusRhodus Extra Features
Plugin URI: http://www.madeinebor.com
Description: Adds Custom Widgets & Post Types to your WordPress install, specifically for themes by TommusRhodus.
Version: 1.0.0
Author: TommusRhodus
Author URI: http://www.madeinebor.com
*/	

/**
 * Require post type and widget files.
 */
require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'widgets.php' );
require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'cpt.php' );

function ebor_register_extras(){
	
	( current_theme_supports('tommusrhodus-theme') ) ? $register = 1 : $register = 0;
	
	/**
	 * Hook CPT registers to init
	 * Check that we're using a TommusRhodus theme and register functions accordingly.
	 * If this isn't a tommusrhodus theme (register is 0) then we'll just enable everything.
	 */
	if( current_theme_supports('tommusrhodus-portfolio') || $register == 0 ){
		add_action( 'init', 'register_portfolio' );
		add_action( 'init', 'create_portfolio_taxonomies' );
	}
	if( current_theme_supports('tommusrhodus-team') || $register == 0 ){
		add_action( 'init', 'register_team' );
		add_action( 'init', 'create_team_taxonomies' );
	}
	if( current_theme_supports('tommusrhodus-client') || $register == 0 ){
		add_action( 'init', 'register_client' );
		add_action( 'init', 'create_client_taxonomies' );
	}
	if( current_theme_supports('tommusrhodus-testimonial') || $register == 0 ){
		add_action( 'init', 'register_testimonial' );
		add_action( 'init', 'create_testimonial_taxonomies' );
	}
	
	/**
	 * Widgets
	 */
	if( current_theme_supports('tommusrhodus-popular-widget') || $register == 0 )
		add_action('widgets_init', 'ebor_popular_load_widgets');
	
	if( current_theme_supports('tommusrhodus-contact-widget') || $register == 0 )
		add_action('widgets_init', 'ebor_contact_load_widgets');
	
	/**
	 * Shortcodes
	 */
	if( current_theme_supports('tommusrhodus-elemis-shortcodes') || $register == 0 )
		require_once( plugin_dir_path( __FILE__ ) . 'shortcodes.php' );
		
}
add_action('after_setup_theme', 'ebor_register_extras', 15);