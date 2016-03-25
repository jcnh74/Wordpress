<?php
/*
Plugin Name: Universal Post Manager
Plugin URI: http://profprojects.com/universal-post-manager/
Description: Adds Print, Save as PDF, MS Document, HTML, Text and XML buttons on single post page. Allows your visitors to Print your posts content and download as PDF, Doc, TXT, HTML, XML files.
Version: 1.4.1
Author: gVectors Team
Author URI: http://www.gvectors.com
*/

/*  Copyright 2009  Artyom Chakhoyan by ProfProjects.com (email : tom.webdever@gmail.com , support@gvectors.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GPL General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, send mail via Support@ProfProjects.com
*/
if ( ! defined( 'WP_CONTENT_URL' ) )
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/' . basename (WP_CONTENT_URL) );
if ( ! defined( 'WP_CONTENT_DIR' ) )
      define( 'WP_CONTENT_DIR', ABSPATH . basename (WP_CONTENT_URL) );
if ( ! defined( 'WP_PLUGIN_URL' ) )
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
      define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

define('PPPM_FOLDER', dirname(__FILE__) .'/' );
define('PPPM_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('PPPM', 'main'); 
define('PLUGIN_PREFIX', 'pppm');
define('TRANS_DOMAIN','pppm');

////////////////////////////////////////////////////////////////////////////////////////
require( PPPM_FOLDER . 'additional_tags.php' );
require( PPPM_FOLDER . 'functions.php' );


	add_filter( "the_content", "pppm_saving_buttons", 1 );
	
	if( $_GET[ 'upm_export' ] ) {
		add_action('wp', 'pppm_export', 2000);
	}


#################################################################################################################
################################# INSTALLATION ##################################################################
$pppm_db_version = "1.0.7";

function pppm_install () {

   global $wpdb;
   global $pppm_db_version;
   define( 'PPPM_PREFIX' , $wpdb->prefix);
   
   $pppm_options_in = array( 'pppm_onoff_html_manager','pppm_onoff_html_manager_post',
							 'pppm_onoff_html_manager_page','pppm_onoff_html_manager_comment',
							 'pppm_phrase_filter_post','pppm_phrase_filter_page','pppm_phrase_filter_comment',
							 'pppm_onoff_filter_manager','pppm_onoff_saving_manager','pppm_onoff_cs_manager',
							 
							 'pppm_onoff_saving_txt',
							 'pppm_onoff_saving_html',
							 'pppm_onoff_saving_doc',
							 'pppm_onoff_saving_pdf',
							 'pppm_onoff_saving_xml',
							 'pppm_onoff_saving_print',
							 
							 'pppm_filter_longphrase_maxlength', 'pppm_filter_longphrase_after',
							 
							 'pppm_save_txt_icon_url',
							 'pppm_save_html_icon_url',
							 'pppm_save_doc_icon_url',
							 'pppm_save_pdf_icon_url',
							 'pppm_save_xml_icon_url',
							 'pppm_save_print_icon_url',
							 
							 'pppm_onoff_phrase_filter','pppm_onoff_text_modifier','pppm_onoff_long_phrase',
							 
							 'pppm_save_txt_button_url', 
							 'pppm_save_txt_button_text',
							 'pppm_save_txt_button_location',
							 
							 'pppm_save_html_button_url', 
							 'pppm_save_html_button_text',
							 'pppm_save_html_button_location',
							 
							 'pppm_save_doc_template',
							 'pppm_save_doc_button_url', 
							 'pppm_save_doc_button_text',
							 'pppm_save_doc_button_location', 
							 
							 'pppm_save_pdf_button_url', 
							 'pppm_save_pdf_button_text',
							 'pppm_save_pdf_button_location', 
							 
							 'pppm_save_xml_button_url', 
							 'pppm_save_xml_button_text',
							 'pppm_save_xml_button_location', 
							 
							 'pppm_save_print_button_url', 
							 'pppm_save_print_button_text',
							 'pppm_save_print_button_location', 
							 
							 'pppm_saving_align', 'pppm_saving_type',
							 'pppm_saving_position', 'pppm_saving_location_postend', 'pppm_saving_location_custom',
							 
							 'pppm_save_txt_button_type', 
							 'pppm_save_html_button_type', 
							 'pppm_save_doc_button_type',
							 'pppm_save_pdf_button_type', 
							 'pppm_save_xml_button_type', 
							 'pppm_save_print_button_type', 
							 
							 'pppm_onoff_print_manager',
							 'pppm_print_location_postend',
							 'pppm_print_location_custom',
							 'pppm_print_type',
							 'pppm_print_in_post',
							 'pppm_print_in_page',
							 'pppm_print_app',
							 'pppm_pt_title',
							 'pppm_pt_image',
							 'pppm_pt_excerpt',
							 'pppm_pt_date',
							 'pppm_pt_md',
							 'pppm_pt_links',
							 'pppm_pt_header',
							 'pppm_pt_head_date',
							 'pppm_pt_head_site',
							 'pppm_pt_head_url',
							 
							 'pppm_saving_in_post', 'pppm_saving_in_page',
							 
							 'pppm_html_manager_executing','pppm_phrase_filter_executing',
							 'pppm_onoff_share_manager',
							 'pppm_onoff_bookmarks',
							 'pppm_onoff_email',
							 'pppm_onoff_subscribe' );
   
   global $wp_roles;
   $pppm_roles = $wp_roles->role_names;
   foreach( $pppm_roles as $pppm_key => $pppm_val ) {
		$pppm_role_options[] = 'pppm_html_role_'. $pppm_key;
		$pppm_role_options[] = 'pppm_filter_role_'. $pppm_key;
   }
   $pppm_options = array_merge ( $pppm_options_in, $pppm_role_options);
   
   //------------- Adding Options ----------------------------//
	
	if( get_option('pppm_save_txt_button_url') == '' ){  // Change this to get_option('pppm_installed') != '1.0.6'
	
		update_option( "pppm_db_version", $pppm_db_version );
		foreach ( $pppm_options as $pppm_ ) {
			add_option( $pppm_ , 1 );
		}
		update_option( 'pppm_saving_position', 0 );
		update_option( 'pppm_onoff_long_phrase', 0 );
		update_option( 'pppm_filter_longphrase_maxlength', 255 );
		update_option( 'pppm_filter_longphrase_after', 'divide' );
		update_option( 'pppm_save_txt_button_url', 'upm-save-as-txt-1.2.0-small.png' );
		update_option( 'pppm_save_txt_icon_url', 'icon_txt_103.gif' );
		update_option( 'pppm_save_txt_button_text', 'Save as Text' );
		update_option( 'pppm_save_html_button_url', 'upm-save-as-html-1.2.0-small.png' );
		update_option( 'pppm_save_html_icon_url', 'icon_html_103.gif' );
		update_option( 'pppm_save_html_button_text', 'Save as HTML' );
		update_option( 'pppm_save_doc_button_url', 'upm-save-as-doc-1.2.0-small.png' );
		update_option( 'pppm_save_doc_icon_url', 'icon_doc_103.gif' );
		update_option( 'pppm_save_doc_button_text', 'Save as Word Document' );
		update_option( 'pppm_save_pdf_button_url', 'upm-save-as-pdf-1.2.0-small.png' );
		update_option( 'pppm_save_pdf_icon_url', 'icon_pdf_103.gif' );
		update_option( 'pppm_save_pdf_button_text', 'Save as PDF' );
		update_option( 'pppm_save_xml_button_url', 'upm-save-as-xml-1.2.0-small.png' );
		update_option( 'pppm_save_xml_icon_url', 'icon_xml_103.gif' );
		update_option( 'pppm_save_xml_button_text', 'Save as XML' );
		update_option( 'pppm_save_print_button_url', 'upm-print-1.2.0-small.png' );
		update_option( 'pppm_save_print_icon_url', 'icon_print_103.gif' );
		update_option( 'pppm_save_print_button_text', 'Print this Post' );
	}
	
	if( get_option('pppm_installed') != '1.0.4' && get_option('pppm_installed') != '1.0.5b' &&  get_option('pppm_installed') !='1.0.6' ){
		
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.0.4' );  //
		///////////////////////////////////////////////
	}
	
	if( get_option('pppm_installed') != '1.0.5b'  &&  get_option('pppm_installed') !='1.0.6' ){
			
		$pppm_options_in105b = array('pppm_html_t_title',
							 'pppm_html_t_image',
							 'pppm_html_t_excerpt',
							 'pppm_html_t_date',
							 'pppm_html_t_md',
							 'pppm_doc_t_title',
							 'pppm_doc_t_image',
							 'pppm_doc_t_excerpt',
							 'pppm_doc_t_date',
							 'pppm_doc_t_md');
		
		foreach ( $pppm_options_in105b as $pppm_ ) {
			add_option( $pppm_ , 1 );
		}
		
							 
		update_option( 'pppm_sb_size', 32 );
		update_option( 'pppm_sb_ShowBookmarksNumber', 6 );
		update_option( 'pppm_rss_icon', 2 ); 
		update_option( 'pppm_onoff_save_follow', 1 ); 
		update_option( 'pppm_save_text_align', 'left' ); 
		update_option( 'pppm_save_pdf_img_show', 1 ); 
		update_option( 'pppm_save_pdf_rus', 0 ); 
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.0.5b' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.0.6' ){
		
		
	}
	if( get_option('pppm_installed') !='1.0.7' ){
		///////////////////////////////////////////////
		update_option('pppm_global_jquery_load', 1);
		//update_option( 'pppm_installed', '1.0.7' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.0.8b' ){
		///////////////////////////////////////////////
		update_option('pppm_global_jquery_load', 1);
		//update_option( 'pppm_installed', '1.0.8b' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.0.9' ){
		///////////////////////////////////////////////
		//update_option( 'pppm_installed', '1.0.9' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.1.1' ){
		///////////////////////////////////////////////
		update_option('pppm_pt_head_date', 1);
		update_option('pppm_pt_head_site', 1);
		update_option('pppm_pt_head_url', 1);
		update_option('pppm_email_screen_type', 2);
		update_option( 'pppm_installed', '1.1.1' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.1.2' ){
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.1.2' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.2.0' ){
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.2.0' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.2.1' ){
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.2.1' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.2.2' ){
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.2.2' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.3.0' ){
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.3.0' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.3.1' ){
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.3.1' ); //
		update_option( 'pppm_save_pdf_img_max_width', '500' ); //
		update_option( 'pppm_save_doc_img_max_width', '500' ); //
		update_option( 'pppm_save_html_img_max_width', '500' ); //
		update_option( 'pppm_save_print_img_max_width', '500' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.3.2' ){
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.3.2' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.3.3' ){
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.3.3' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.4.0' ){
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.4.0' ); //
		///////////////////////////////////////////////
	}
	if( get_option('pppm_installed') !='1.4.1' ){
		///////////////////////////////////////////////
		update_option( 'pppm_installed', '1.4.1' ); //
		///////////////////////////////////////////////
	}
	//-------------------------------------------------------//
				
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////
function pppm_uninstall () {

   global $wpdb;
   define( 'PPPM_PREFIX' , $wpdb->prefix);
   
   $pppm_options_un = array( 'pppm_onoff_html_manager','pppm_onoff_html_manager_post',
							 'pppm_onoff_html_manager_page','pppm_onoff_html_manager_comment',
							 'pppm_phrase_filter_post','pppm_phrase_filter_page','pppm_phrase_filter_comment',
							 'pppm_onoff_filter_manager','pppm_onoff_saving_manager','pppm_onoff_cs_manager',
							 
							 'pppm_onoff_saving_txt',
							 'pppm_onoff_saving_html',
							 'pppm_onoff_saving_doc',
							 'pppm_onoff_saving_pdf',
							 'pppm_onoff_saving_xml',
							 'pppm_onoff_saving_print',
							 
							 'pppm_filter_longphrase_maxlength', 'pppm_filter_longphrase_after',
							 
							 'pppm_save_txt_icon_url',
							 'pppm_save_html_icon_url',
							 'pppm_save_doc_icon_url',
							 'pppm_save_pdf_icon_url',
							 'pppm_save_xml_icon_url',
							 'pppm_save_print_icon_url',
							 
							 'pppm_onoff_phrase_filter','pppm_onoff_text_modifier','pppm_onoff_long_phrase',
							 
							 'pppm_save_txt_button_url', 
							 'pppm_save_txt_button_text',
							 'pppm_save_txt_button_location',
							 
							 'pppm_html_t_title',
							 'pppm_html_t_image',
							 'pppm_html_t_excerpt',
							 'pppm_html_t_date',
							 'pppm_html_t_md',
							 'pppm_save_html_button_url', 
							 'pppm_save_html_button_text',
							 'pppm_save_html_button_location',
							 
							 'pppm_doc_t_title',
							 'pppm_doc_t_image',
							 'pppm_doc_t_excerpt',
							 'pppm_doc_t_date',
							 'pppm_doc_t_md',
							 'pppm_save_doc_template',
							 'pppm_save_doc_button_url', 
							 'pppm_save_doc_button_text',
							 'pppm_save_doc_button_location', 
							 
							 'pppm_save_text_align',
							 'pppm_save_pdf_img_show', 
							 'pppm_save_pdf_rus', 
							 
							 'pppm_save_pdf_button_url', 
							 'pppm_save_pdf_button_text',
							 'pppm_save_pdf_button_location', 
							 
							 'pppm_save_xml_button_url', 
							 'pppm_save_xml_button_text',
							 'pppm_save_xml_button_location', 
							 
							 'pppm_save_print_button_url', 
							 'pppm_save_print_button_text',
							 'pppm_save_print_button_location', 
							 
							 'pppm_saving_align', 'pppm_saving_type',
							 'pppm_saving_position', 'pppm_saving_location_postend', 'pppm_saving_location_custom',
							 
							 'pppm_save_txt_button_type', 
							 'pppm_save_html_button_type', 
							 'pppm_save_doc_button_type',
							 'pppm_save_pdf_button_type', 
							 'pppm_save_xml_button_type', 
							 'pppm_save_print_button_type', 
							 
							 'pppm_saving_in_post', 'pppm_saving_in_page',
							 
							 'pppm_onoff_print_manager',
							 'pppm_print_location_postend',
							 'pppm_print_location_custom',
							 'pppm_print_type',
							 'pppm_print_in_post',
							 'pppm_print_in_page',
							 'pppm_print_app',
							 'pppm_pt_title',
							 'pppm_pt_image',
							 'pppm_pt_excerpt',
							 'pppm_pt_date',
							 'pppm_pt_md',
							 'pppm_pt_links',
							 'pppm_pt_header',
							 
							 'pppm_html_manager_executing','pppm_phrase_filter_executing',
							 'pppm_onoff_share_manager',
							 'pppm_onoff_bookmarks',
							 'pppm_onoff_email',
							 'pppm_onoff_subscribe',
							 
							 'pppm_sb_size',
							'pppm_sb_ShowBookmarksNumber',
							'pppm_sb_StartBookmarks',
							'pppm_sb_ExcludeBookmarks',
							'pppm_sb_BackgroundColor',
							'pppm_bookmark_icon',
							'pppm_bookmark_link_type',
							'pppm_bookmark_text_1',
							'pppm_bookmark_text_2',
							'pppm_bookmark_text_3',
							'pppm_bookmark_text_4',
							'pppm_bookmark_text_5',
							'pppm_bookmark_text_6',
							'pppm_bookmark_text_7',
							'pppm_bookmark_text_8',
							'pppm_bookmark_text_9',
							'pppm_bookmark_text_10',
							'pppm_bookmark_text_11',
							'pppm_bookmark_text_12',
							'pppm_bookmark_text_13',
							'pppm_bookmark_text_14',
							'pppm_bookmark_text_15',
							'pppm_bookmark_text_16',
							'pppm_bookmark_text_17',
							'pppm_bookmark_text_18',
							'pppm_bookmark_text_19',
							'pppm_bookmark_text_20',
							'pppm_bookmark_text_21',
							'pppm_bookmark_text_22',
							'pppm_bookmark_text_23',
							'pppm_bookmark_text_24',
							'pppm_bookmark_text_25',
							'pppm_bookmark_text_26',
							'pppm_bookmark_text_27',
							'pppm_bookmark_text_28',
							'pppm_bookmark_text_29',
							'pppm_bookmark_text_30',
							'pppm_bookmarks',
							'pppm_email_this_text',
							'pppm_email_this_img',
							'pppm_email_link_type',
							'pppm_email_this_mark',
							'pppm_email_content',
							'pppm_email_screen_type',
							'pppm_rss1',
							'pppm_rss_092',
							'pppm_rss2',
							'pppm_atom',
							'pppm_rss_icon',
							'pppm_atom_icon',
							'pppm_rss_icon_custom',
							'pppm_atom_icon_custom', 
							'pppm_subscribe_link_type',
							'pppm_onoff_save_follow',
							'pppm_html_manager_executing',
							'pppm_phrase_filter_executing',
							 
							 'pppm_db_version',
							 'pppm_installed',
							 
							 'pppm_poll_form_template',
							 'pppm_poll_results_template',
							 'pppm_onoff_poll_manager',
							 'pppm_poll_bg_url',
							 'pppm_poll_bg_color',
							 'pppm_poll_bgtype',
							 'pppm_poll_height',
							 'pppm_poll_voters',
							 'pppm_poll_logging',
							 'pppm_poll_logging_exdatenum',
							 'pppm_poll_logging_exdatetype',
							 'pppm_poll_first_poll',
							 'pppm_poll_onoff_next',
							 
							 'pppm_link_to_blank' );
   
   global $wp_roles;
   $pppm_roles = $wp_roles->role_names;
   foreach( $pppm_roles as $pppm_key => $pppm_val ) {
		$pppm_role_options[] = 'pppm_html_role_'. $pppm_key;
		$pppm_role_options[] = 'pppm_filter_role_'. $pppm_key;
   }
   $pppm_options = array_merge ( $pppm_options_un , $pppm_role_options);
   $sql_un = array();
   $table_name = array( 'pppm_html', 'pppm_protocol', 'pppm_filter', 'pppm_shortcut', 'pppm_polls', 'pppm_polls_items', 'pppm_polls_votes' );
   require( PPPM_FOLDER . 'db/db.php' );
   include( ABSPATH . 'wp-admin/includes/upgrade.php' );
   foreach ( $table_name as $table ) 
   {
   		$tname = PPPM_PREFIX . $table;
   		if( $wpdb->get_var( "show tables like '$tname'" ) == $tname ) 
		{
			$wpdb->query( $sql_un[ $table ] );
		}
   	}
	
	update_option( "pppm_db_version", '' );
	foreach ( $pppm_options as $pppm_ ) {
	
		delete_option( $pppm_ );
	}
}

register_activation_hook( __FILE__, 'pppm_install' );

################################################################################################################
################################# Ajax Functions ###############################################################
function pppm_css() {
 echo "<link rel='stylesheet' href='".PPPM_PATH ."css/pppm.css' type='text/css' />";
}

add_action('admin_head','pppm_css');

if(!is_admin() && get_option('pppm_global_jquery_load')){
	wp_enqueue_script( 'upm_poll_jquery', PPPM_PATH .'js/jquery-1.4.2.min.js');
}
#####################################################################################################################
################################### ADMIN OPTIONS  ##################################################################
//- Top Level Menu -//
$pppm_menu_array [0]['parent_file'] ='main';
$pppm_menu_array [0]['parent_menu_title'] = 'UPM Settings';
$pppm_menu_array [0]['parent_menu_icon'] = PPPM_PATH.'img/mini_icon.gif';
$pppm_menu_array [0]['parent_level'] = 8;
$pppm_menu_array [0]['parent_page_title'] = 'ProfProjects - Universal Post Manager';
//- Sub Menu Overview -//
$pppm_menu_array [0]['page']['main']['page_menu_title'] = 'General';
$pppm_menu_array [0]['page']['main']['page_title'] = 'Universal Post Manager by ProfProjects';
$pppm_menu_array [0]['page']['main']['page_header'] = __( 'Universal Post Manager - General Settings');
$pppm_menu_array [0]['page']['main']['page_screen_custom_icon'] = PPPM_PATH.'img/icon.png';
$pppm_menu_array [0]['page']['main']['page_screen_icon'] = 'options-general';
$pppm_menu_array [0]['page']['main']['page_level'] = 8;
$pppm_menu_array [0]['page']['main']['page_file'] = 'main' ;
$pppm_menu_array [0]['page']['main']['page_column_number'] = 2;
$pppm_menu_array [0]['page']['main']['page_include_file_top'] = 'overview.php';
$pppm_menu_array [0]['page']['main']['page_include_file_bottom'] = 'footer.php'; 
$pppm_menu_array [0]['page']['main']['page_type'] = 'admin_simple';//or admin_simple 
//- Sub Menu Saving Manager -//
$pppm_menu_array [0]['page']['saving']['page_menu_title'] = 'Saving Manager';
$pppm_menu_array [0]['page']['saving']['page_title'] = 'Universal Post Manager - Saving Manager';
$pppm_menu_array [0]['page']['saving']['page_header'] = __( 'Save as Text, HTML & Word Document &nbsp; Manager');
$pppm_menu_array [0]['page']['saving']['page_screen_custom_icon'] = PPPM_PATH.'img/icon.png';
$pppm_menu_array [0]['page']['saving']['page_screen_icon'] = 'options-general';
$pppm_menu_array [0]['page']['saving']['page_level'] = 8;
$pppm_menu_array [0]['page']['saving']['page_file'] = 'saving' ;
$pppm_menu_array [0]['page']['saving']['page_column_number'] = 1;
$pppm_menu_array [0]['page']['saving']['page_include_file_top'] = 'saving.php';
$pppm_menu_array [0]['page']['saving']['page_include_file_bottom'] = 'footer.php';
$pppm_menu_array [0]['page']['saving']['page_type'] = 'admin_box';
$pppm_menu_array [0]['content']['saving']['contentbox']['txt_save']['contentbox_id'] = 'cb_' . mt_rand(1,1000000);
$pppm_menu_array [0]['content']['saving']['contentbox']['txt_save']['contentbox_title'] = 'Text Save Options' ;
$pppm_menu_array [0]['content']['saving']['contentbox']['txt_save']['contentbox_data'] = '' ;
$pppm_menu_array [0]['content']['saving']['contentbox']['html_save']['contentbox_id'] = 'cb_' . mt_rand(1,1000000);
$pppm_menu_array [0]['content']['saving']['contentbox']['html_save']['contentbox_title'] = 'HTML Save Options' ;
$pppm_menu_array [0]['content']['saving']['contentbox']['html_save']['contentbox_data'] = '' ;
$pppm_menu_array [0]['content']['saving']['contentbox']['doc_save']['contentbox_id'] = 'cb_' . mt_rand(1,1000000);
$pppm_menu_array [0]['content']['saving']['contentbox']['doc_save']['contentbox_title'] = 'Word Document Save Options' ;
$pppm_menu_array [0]['content']['saving']['contentbox']['doc_save']['contentbox_data'] = '' ;
$pppm_menu_array [0]['content']['saving']['contentbox']['pdf_save']['contentbox_id'] = 'cb_' . mt_rand(1,1000000);
$pppm_menu_array [0]['content']['saving']['contentbox']['pdf_save']['contentbox_title'] = 'PDF Save Options' ;
$pppm_menu_array [0]['content']['saving']['contentbox']['pdf_save']['contentbox_data'] = '' ;
$pppm_menu_array [0]['content']['saving']['contentbox']['xml_save']['contentbox_id'] = 'cb_' . mt_rand(1,1000000);
$pppm_menu_array [0]['content']['saving']['contentbox']['xml_save']['contentbox_title'] = 'XML Save Options' ;
$pppm_menu_array [0]['content']['saving']['contentbox']['xml_save']['contentbox_data'] = '' ;
//- Sub Menu Print Manager -//
$pppm_menu_array [0]['page']['print']['page_menu_title'] = 'Print Manager';
$pppm_menu_array [0]['page']['print']['page_title'] = 'Universal Post Manager - Print Manager';
$pppm_menu_array [0]['page']['print']['page_header'] = __( 'Print Manager');
$pppm_menu_array [0]['page']['print']['page_screen_custom_icon'] = PPPM_PATH.'img/icon.png';
$pppm_menu_array [0]['page']['print']['page_screen_icon'] = 'options-general';
$pppm_menu_array [0]['page']['print']['page_level'] = 8;
$pppm_menu_array [0]['page']['print']['page_file'] = 'print' ;
$pppm_menu_array [0]['page']['print']['page_column_number'] = 1;
$pppm_menu_array [0]['page']['print']['page_include_file_top'] = 'print.php';
$pppm_menu_array [0]['page']['print']['page_include_file_bottom'] = 'footer.php';
$pppm_menu_array [0]['page']['print']['page_type'] = 'admin_box';
$pppm_menu_array [0]['content']['print']['contentbox']['print_template']['contentbox_id'] = 'cb_' . mt_rand(1,1000000);
$pppm_menu_array [0]['content']['print']['contentbox']['print_template']['contentbox_title'] = 'Print Template Settings' ;
$pppm_menu_array [0]['content']['print']['contentbox']['print_template']['contentbox_data'] = '' ;
$pppm_menu_array [0]['content']['print']['contentbox']['print_img']['contentbox_id'] = 'cb_' . mt_rand(1,1000000);
$pppm_menu_array [0]['content']['print']['contentbox']['print_img']['contentbox_title'] = 'Print Buttons' ;
$pppm_menu_array [0]['content']['print']['contentbox']['print_img']['contentbox_data'] = '' ;
//- Bookmarks Manager -//

//- Email & Subscribe -//

//- Polls -//

//- Sub Menu All by Categories -//
$pppm_menu_array [0]['page']['bycat']['page_menu_title'] = 'All by Categories';
$pppm_menu_array [0]['page']['bycat']['page_title'] = 'Universal Post Manager - All Settings by Categories';
$pppm_menu_array [0]['page']['bycat']['page_header'] = __( 'All Settings by Categories ( beta )');
$pppm_menu_array [0]['page']['bycat']['page_screen_custom_icon'] = PPPM_PATH.'img/icon.png';
$pppm_menu_array [0]['page']['bycat']['page_screen_icon'] = 'options-general';
$pppm_menu_array [0]['page']['bycat']['page_level'] = 8;
$pppm_menu_array [0]['page']['bycat']['page_file'] = 'bycat' ;
$pppm_menu_array [0]['page']['bycat']['page_column_number'] = 1;
$pppm_menu_array [0]['page']['bycat']['page_include_file_top'] = 'bycat.php';
$pppm_menu_array [0]['page']['bycat']['page_include_file_bottom'] = 'footer_2.php';
$pppm_menu_array [0]['page']['bycat']['page_type'] = 'admin_box';
$pppm_menu_array [0]['content']['bycat']['contentbox']['cat_list']['contentbox_id'] = 'cb_' . mt_rand(1,1000000);
$pppm_menu_array [0]['content']['bycat']['contentbox']['cat_list']['contentbox_title'] = 'Categories' ;
$pppm_menu_array [0]['content']['bycat']['contentbox']['cat_list']['contentbox_data'] = '' ;
//- Sub Menu Setup -//

######################################################################################################################
############################################### - MENU CLASS - #######################################################
class pppm_admin_box {

	var $pn;
	var $pagehook;
	var $data_array;
	var $pppm_unsp = false;
	var $pppm_note;
	
	function pppm_admin_box ( $ex_array, $page_name ) {
		$this->data_array = $ex_array ;
		$this->pn = $page_name ;
	}
	
	function pppm_admin() {
		
		if( get_option( 'pppm_html_manager_executing' ) == NULL ) {
			add_option( 'pppm_html_manager_executing' , 1 );
		}
		if( get_option( 'pppm_phrase_filter_executing' ) == NULL ) {
			add_option( 'pppm_phrase_filter_executing' , 1 );
		}
		add_filter('screen_layout_columns', array(&$this, 'on_screen_layout_columns' ), 10, 2);
		add_action('admin_menu',  array(&$this, 'on_admin_menu' )); 
	}
	
	function on_admin_menu() {
		
		add_menu_page($this->data_array['parent_page_title'], $this->data_array['parent_menu_title'] , $this->data_array['parent_level'], $this->data_array['parent_file'] , array(&$this, 'on_show_page'), $this->data_array['parent_menu_icon']);
		
		foreach($this->data_array['page'] as $name){
			
			if($name['page_file'] == $this->pn){
				
				$this->pagehook = add_submenu_page( $this->data_array['parent_file'] , 
													$name['page_title'], 
													$name['page_menu_title'], 
													$name['page_level'], 
													$name['page_file'], 
													array(&$this, 'on_show_page' ));
			}
			else{
				
				 add_submenu_page(   $this->data_array['parent_file'] , 
									$name['page_title'], 
									$name['page_menu_title'], 
									$name['page_level'], 
									$name['page_file'], 
									array(&$this, 'on_show_page' ));
			}
		}
		if( $this->data_array['page'][$this->pn]['page_type'] == 'admin_box' ) 
		{
			add_action('load-'.$this->pagehook, array(&$this, 'on_load_page'));
		}
		
	}
	
	function on_screen_layout_columns($columns, $screen) {
	
		if ( $screen == $this->pagehook ) { 
			 $columns[ $this->pagehook ] = $this->data_array['page'][$this->pn]['page_column_number']; 
		}
		return $columns;
	}
	
	function on_load_page() {
	
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		if(count($this->data_array['content'][$this->pn]['sidebox']) > 10) { 
			wp_die( __(' Number of sideboxes more then 10 !')); break; 
		}
		$fn = 0;
		if( !empty($this->data_array['content'][$this->pn]['sidebox']) )
		{
			foreach( $this->data_array['content'][$this->pn]['sidebox'] as $sid ){
				add_meta_box( $sid['sidebox_id'], $sid['sidebox_title'], array(&$this, 'sb_'.$fn),$this->pagehook, 'side', 'core');	
				$fn=$fn+1;				
			}
		}
	}
	
	function on_show_page() {
		
		global $screen_layout_columns;
		if( $this->data_array['page'][$this->pn]['page_type'] == 'admin_box' ) 
		{	
			if( count($this->data_array['content'][$this->pn]['contentbox']) > 10 ) { 
				wp_die( __(' Number of contentbox more then 10 !')); break; 
			}
			$fn = 0;
			if(!empty($this->data_array['content'][$this->pn]['contentbox'])) {
				foreach( $this->data_array['content'][$this->pn]['contentbox'] as $sid ){
					add_meta_box( $sid['contentbox_id'], $sid['contentbox_title'], array(&$this, 'cb_'.$fn),$this->pagehook, 'normal', 'core');
					$fn=$fn+1;				
				}
			}
		}
		
		?>
		
		<div id="pppm_wrap" class="wrap">
			<?php 
			if( !$this->data_array['page'][$this->pn]['page_screen_custom_icon'] ) {
				screen_icon($this->data_array['page'][$this->pn]['page_screen_icon']);
			}
			?>
			<h2>
			<?php 
			if( $this->data_array['page'][$this->pn]['page_screen_custom_icon'] ) { 
				echo '<img src = "'.$this->data_array['page'][$this->pn]['page_screen_custom_icon'].'" align="absmiddle" style="background:#FFFFFF; border:#CCCCCC 1px solid; padding:1px;"> &nbsp;'; } 
			 _e( $this->data_array['page'][$this->pn]['page_header']) ?>
			 </h2>
			<?php 
			if($this->data_array['page'][$this->pn]['page_include_file_top'] ) { 
				include( PPPM_FOLDER . $this->data_array['page'][$this->pn]['page_include_file_top'] ); 
			}
			?>
			<div id="poststuff" class="metabox-holder<?php echo $this->data_array['page'][$this->pn]['page_column_number'] == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
				<?php 
				if( $this->data_array['page'][$this->pn]['page_type'] == 'admin_box' ) 
				{
		
					if($this->data_array['page'][$this->pn]['page_column_number'] == 2) 
					{
						?>
						<div id="side-info-column" class="inner-sidebar">
								<?php do_meta_boxes($this->pagehook , 'side', $data); ?>
						</div>
						
						<div id="post-body" class="has-sidebar">
							<div id="post-body-content" class="has-sidebar-content">
								<?php do_meta_boxes($this->pagehook , 'normal', $data); ?>
							</div>
						</div>
						<?php
					}
					else
					{
						do_meta_boxes($this->pagehook , 'normal', $data);
						do_meta_boxes($this->pagehook , 'side', $data);
					}
				?>
				<br class="clear"/>				
			</div>	
		</div>
		<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				// close postboxes that should be closed
				$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
				// postboxes setup
				postboxes.add_postbox_toggles('<?php echo $this->pagehook ; ?>');
			});
			//]]>
		</script>
			<?php
			if($this->data_array['page'][$this->pn]['page_include_file_bottom'] ) include( PPPM_FOLDER . $this->data_array['page'][$this->pn]['page_include_file_bottom'] );
			}
			else {
				 if($this->data_array['page'][$this->pn]['page_include_file_bottom']) include( PPPM_FOLDER . $this->data_array['page'][$this->pn]['page_include_file_bottom'] );
			}
	}

	function sb_0($data) {$i = 0;foreach( $this->data_array['content'][$this->pn]['sidebox'] as $sb => $sid ){if($i == 0){if($sid['sidebox_data']){echo $sid['sidebox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function sb_1($data) {$i = 0;foreach( $this->data_array['content'][$this->pn]['sidebox'] as $sb => $sid ){if($i == 1){if($sid['sidebox_data']){echo $sid['sidebox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function sb_2($data) {$i = 0;foreach( $this->data_array['content'][$this->pn]['sidebox'] as $sb => $sid ){if($i == 2){if($sid['sidebox_data']){echo $sid['sidebox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function sb_3($data) {$i = 0;foreach( $this->data_array['content'][$this->pn]['sidebox'] as $sb => $sid ){if($i == 3){if($sid['sidebox_data']){echo $sid['sidebox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function sb_4($data) {$i = 0;foreach( $this->data_array['content'][$this->pn]['sidebox'] as $sb => $sid ){if($i == 4){if($sid['sidebox_data']){echo $sid['sidebox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function sb_5($data) {$i = 0;foreach( $this->data_array['content'][$this->pn]['sidebox'] as $sb => $sid ){if($i == 5){if($sid['sidebox_data']){echo $sid['sidebox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function sb_6($data) {$i = 0;foreach( $this->data_array['content'][$this->pn]['sidebox'] as $sb => $sid ){if($i == 6){if($sid['sidebox_data']){echo $sid['sidebox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function sb_7($data) {$i = 0;foreach( $this->data_array['content'][$this->pn]['sidebox'] as $sb => $sid ){if($i == 7){if($sid['sidebox_data']){echo $sid['sidebox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function sb_8($data) {$i = 0;foreach( $this->data_array['content'][$this->pn]['sidebox'] as $sb => $sid ){if($i == 8){if($sid['sidebox_data']){echo $sid['sidebox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function sb_9($data) {$i = 0;foreach( $this->data_array['content'][$this->pn]['sidebox'] as $sb => $sid ){if($i == 9){if($sid['sidebox_data']){echo $sid['sidebox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function sb_10($data){$i = 0;foreach($this->data_array['content'][$this->pn]['sidebox'] as $sb => $sid ){if($i == 10){if($sid['sidebox_data']){echo $sid['sidebox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	
	function cb_0($data) {$i = 0;foreach($this->data_array['content'][$this->pn]['contentbox'] as $cb => $sid ){if($i == 0){ if($sid['contentbox_data']){echo $sid['contentbox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function cb_1($data) {$i = 0;foreach($this->data_array['content'][$this->pn]['contentbox'] as $cb => $sid ){if($i == 1){ if($sid['contentbox_data']){echo $sid['contentbox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function cb_2($data) {$i = 0;foreach($this->data_array['content'][$this->pn]['contentbox'] as $cb => $sid ){if($i == 2){ if($sid['contentbox_data']){echo $sid['contentbox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function cb_3($data) {$i = 0;foreach($this->data_array['content'][$this->pn]['contentbox'] as $cb => $sid ){if($i == 3){ if($sid['contentbox_data']){echo $sid['contentbox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function cb_4($data) {$i = 0;foreach($this->data_array['content'][$this->pn]['contentbox'] as $cb => $sid ){if($i == 4){ if($sid['contentbox_data']){echo $sid['contentbox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function cb_5($data) {$i = 0;foreach($this->data_array['content'][$this->pn]['contentbox'] as $cb => $sid ){if($i == 5){ if($sid['contentbox_data']){echo $sid['contentbox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function cb_6($data) {$i = 0;foreach($this->data_array['content'][$this->pn]['contentbox'] as $cb => $sid ){if($i == 6){ if($sid['contentbox_data']){echo $sid['contentbox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function cb_7($data) {$i = 0;foreach($this->data_array['content'][$this->pn]['contentbox'] as $cb => $sid ){if($i == 7){ if($sid['contentbox_data']){echo $sid['contentbox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function cb_8($data) {$i = 0;foreach($this->data_array['content'][$this->pn]['contentbox'] as $cb => $sid ){if($i == 8){ if($sid['contentbox_data']){echo $sid['contentbox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function cb_9($data) {$i = 0;foreach($this->data_array['content'][$this->pn]['contentbox'] as $cb => $sid ){if($i == 9){ if($sid['contentbox_data']){echo $sid['contentbox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}
	function cb_10($data){$i = 0;foreach($this->data_array['content'][$this->pn]['contentbox'] as $cb => $sid ){if($i == 10){ if($sid['contentbox_data']){echo $sid['contentbox_data'];}else{include ( PPPM_FOLDER . 'page_contents.php' );}}$i=$i+1;}}

}

function upm_buttons_for_posts( $object, $box ){ ?><p><input class="widefat" type="checkbox" name="upm-post-buttons" id="upm-post-buttons" value="1" <?php echo ( esc_attr( get_post_meta( $object->ID, '_upm-post-buttons', true ))) ? 'checked="checked"' : ''; ?> /> <label for="upm-post-buttons">Hide Save &amp; Print Buttons</label> </p><?php  }
function upm_buttons_post_metabox() { add_meta_box( 'upm-buttons',  esc_html__( 'UPM Save & Print Buttons', 'example' ), 'upm_buttons_for_posts', 'post', 'side', 'default'  ); }
function upm_buttons_save_post_meta( $post_id, $post ) {
  $post_type = get_post_type_object( $post->post_type );
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) return $post_id;
  $new_meta_value = ( isset( $_POST['upm-post-buttons'] ) ? sanitize_html_class( $_POST['upm-post-buttons'] ) : '' );
  $meta_key = '_upm-post-buttons';
  $meta_value = get_post_meta( $post_id, $meta_key, true );
  if ( $new_meta_value && '' == $meta_value ) add_post_meta( $post_id, $meta_key, $new_meta_value, true );
  elseif ( $new_meta_value && $new_meta_value != $meta_value ) update_post_meta( $post_id, $meta_key, $new_meta_value );
  elseif ( '' == $new_meta_value && $meta_value ) delete_post_meta( $post_id, $meta_key, $meta_value );
}
function upm_buttons_for_pages( $object, $box ){ ?><p><input class="widefat" type="checkbox" name="upm-post-buttons" id="upm-post-buttons" value="1" <?php echo ( esc_attr( get_post_meta( $object->ID, '_upm-post-buttons', true ))) ? 'checked="checked"' : ''; ?> /> <label for="upm-post-buttons">Hide Save &amp; Print Buttons</label> </p><?php  }
function upm_buttons_page_metabox() { add_meta_box( 'upm-buttons',  esc_html__( 'UPM Save & Print Buttons', 'example' ), 'upm_buttons_for_posts', 'page', 'side', 'default'  ); }
function upm_buttons_save_page_meta( $post_id, $post ) {
  $post_type = get_post_type_object( $post->post_type );
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) return $post_id;
  $new_meta_value = ( isset( $_POST['upm-post-buttons'] ) ? sanitize_html_class( $_POST['upm-post-buttons'] ) : '' );
  $meta_key = '_upm-post-buttons';
  $meta_value = get_post_meta( $post_id, $meta_key, true );
  if ( $new_meta_value && '' == $meta_value ) add_post_meta( $post_id, $meta_key, $new_meta_value, true );
  elseif ( $new_meta_value && $new_meta_value != $meta_value ) update_post_meta( $post_id, $meta_key, $new_meta_value );
  elseif ( '' == $new_meta_value && $meta_value ) delete_post_meta( $post_id, $meta_key, $meta_value );
}

if(is_admin()){
	add_action( 'add_meta_boxes', 'upm_buttons_post_metabox' );
	add_action( 'add_meta_boxes', 'upm_buttons_page_metabox' );
	add_action( 'save_post', 'upm_buttons_save_post_meta', 10, 2 );
	add_action( 'save_post', 'upm_buttons_save_page_meta', 10, 2 );
	$pppm_admin_class = new pppm_admin_box( $pppm_menu_array[0], $_GET['page'] );
	$pppm_admin_class->pppm_admin();
}

?>