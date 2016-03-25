<?php

function upm_manipulations( $str ){
	if(!function_exists('upm_link_target') && get_option('pppm_link_to_blank')){ $str = preg_replace( '|(<a[^><]+)(>)|i', '$1 target="_blank" $2', $str );}
	return $str;
}
add_filter( "the_content", "upm_manipulations");

if( !function_exists('upm_get_seconds') ){
	function upm_get_seconds(){
		
		$num = get_option('pppm_poll_logging_exdatenum');
		
		switch(get_option('pppm_poll_logging_exdatetype')){
			case 'sec' : $sec = $num; break;
			case 'min' : $sec = $num * 60 ; break;
			 case 'hr' : $sec = $num * 60 * 60 ; break;
			case 'day' : $sec = $num * 60 * 60 * 24 ; break;
			case 'mon' : $sec = $num * 60 * 60 * 24 * 30 ; break;
			 case 'yr' : $sec = $num * 60 * 60 * 24 * 30 * 12 ; break;
		}
		
		return $sec;
	}
}

if( !function_exists('upm_allow_1') ){
	function upm_allow_1(){
	}
}
/////////////////////////////////////////////////////////////
//add_action('wp_ajax_nopriv_upm_ayax_polls_result', 'upm_ayax_polls_result');
//add_action('wp_ajax_upm_ayax_polls_result', 'upm_ayax_polls_result');

function upm_ayax_polls_result(){
	
}
/////////////////////////////////////////////////////////////

function upm_polls( $mode = 'default', $_type = 'general' ){

}


function upm_polls_result($poll_id, $type = 'general', $next_button = true, $full_access = false ){
		

}

function pppm_get_polls( $type = 'general', $mode = 'default', $poll_id = 0, $extra = false, $full_access = false ){
		
}

class PPPM_Poll_Widget extends WP_Widget {
    
} 


if(get_option('pppm_onoff_poll_manager')){
	add_action('widgets_init', create_function('', 'return register_widget("PPPM_Poll_Widget");'));
}
######################################################################################################################
function upm_all(){
	require( PPPM_FOLDER . 'template/all.php' );
}
###################################################################################################################### 
function upm_subscribe( $feed = 'rss2', $unit = '' ){

}

###########################################################################################################
function pppm_img_url($content){
	
	preg_match_all('|<img\s+[^>]*src=[\"\']+([^>\"\']+)[\"\']+\s+[^>]*>|i', $content, $body_array, PREG_SET_ORDER);
	preg_match('|^(.+)wp-content\/.+$|i', PPPM_PATH, $img_url_array);
	if( !empty($body_array) ) {
			
		for ($i=0; $i < count($body_array); $i++){
				
			if( strpos($body_array [$i][1],'http') === FALSE ){
				if( preg_match('|^(.*)wp-content\/(.+)$|i', $body_array[$i][1],$img_curr_url_array) ){
					$img[$body_array[$i][1]] = $img_url_array[1].'wp-content/'.$img_curr_url_array[2];
				}
				else{
					$img[$body_array[$i][1]] = $img_url_array[1].$body_array[$i][1];
				}
			}
			else{
				$img[$body_array[$i][1]] = $body_array [$i][1];	
			}
		}
	}
	return $img;
}
###########################################################################################################
function pppm_get_category_parents( $id , $visited = array() ) {
	$chain = '';
	$parent = get_category( $id );
	if ( is_wp_error( $parent ) ) return $parent;
							
	$name = $parent->cat_name;
					
	if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) )
	{
		$visited[] = $parent->parent;
		$chain .= pppm_get_category_parents( $parent->parent, $visited );
	}
		$chain .= $parent->term_id.',' ;
		return $chain;
}
###########################################################################################################
if( !function_exists('file_extension') ){
	function file_extension($filename)
	{
		return substr(strrchr($filename, '.'), 1);
	}
}
###########################################################################################################
function upm_ayax_email_result(){

}

function pppm_textmaker($text)
{
	$search = array ("|\n|i");
	$replace = array ("<br> ");
	$text = preg_replace($search,$replace,$text);
	
	$search_2 = array ("|(h\d>)[\s\t\r\n]*<br[^>]*>|i",
					   "|(p>)[\s\t\r\n]*<br[^>]*>|i",
					   "|(ul>)[\s\t\r\n]*<br[^>]*>|i",
					   "|(ol>)[\s\t\r\n]*<br[^>]*>|i",
					   "|(li>)[\s\t\r\n]*<br[^>]*>|i");
					   
	$replace_2 = array ("$1","$1","$1","$1","$1");
	$text=preg_replace($search_2,$replace_2,$text);
	
	return $text;
}
	
function upm_email( $num = 1, $unit = '' ) {
	if(get_option('pppm_onoff_share_manager') && get_option('pppm_onoff_email')){
		$pppm_email_screen_type = get_option('pppm_email_screen_type');
		
		if( $pppm_email_screen_type == '1' )
		{
			include("template/email_screen_1.php");
		}
		else{
			include("template/email_screen_2.php");
		}
	}
	else{
		return false;
	}
}
###########################################################################################################
function upm_bookmarks( $query = '' ) {
	
} 
###########################################################################################################
function upm_print( $print = true ) {

			global $post;
			if( $post->post_status != 'publish' ) return false;
			if( get_post_meta( $post->ID, '_upm-post-buttons', true ) ) return false;
			
			if( is_single() || is_page() ){
				if(post_password_required($post->ID)){
					return false;
				}
			}
			
			$pppm_follow = ( get_option( 'pppm_onoff_save_follow' ) ) ? '' : 'rel="nofollow"';
			
			###################################################
			$print_string = stripslashes( get_option( 'pppm_save_print_button_text' ) );
			
			$button['string']['print'] = '<a href="'.get_option('siteurl').'/?p='.str_replace( '%7E', '~',  url_to_postid( $_SERVER['REQUEST_URI'] )).'&upm_export=print" target="_blank" '.$pppm_follow.'>'.$print_string.'</a>';
				/////////////////////////////////////////////////
			$button['icon']['print'] = '<a href="'.get_option('siteurl').'/?p='.str_replace( '%7E', '~',  url_to_postid( $_SERVER['REQUEST_URI'] )).'&upm_export=print" target="_blank" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_print_icon_url').'" align="absmiddle" border="0" align="Print this Post" title="Print this Post" /></a>';
				//////////////////////////////////////////////////
			$button['button']['print'] = '<a href="'.get_option('siteurl').'/?p='.str_replace( '%7E', '~',  url_to_postid( $_SERVER['REQUEST_URI'] )).'&upm_export=print" target="_blank" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_print_button_url').'" style="padding:2px" align="absmiddle" border="0" align="Print this Post" title="Print this Post" /></a>';
			
			####################################################
			if( get_option( 'pppm_onoff_print_manager' ) ) {
		
					if( get_option( 'pppm_print_type' ) ) {
						//Button
						if( get_option( 'pppm_save_print_button_type' ) ) {
							//button
							$sm_print = $button['button']['print'];
						}
						else {
							//icon
							$sm_print = $button['icon']['print'];
						}
					}
					else {
						//String
						$sm_print = $button['string']['print'];
					}
			}
			
			$sm = '<div class="upm_print">'.$sm_print.'</div>';
			
			#################################################################
			if( is_single() && get_option( 'pppm_print_in_post' ) ) {
			
			if( get_option( 'pppm_onoff_print_manager' ) && get_option( 'pppm_print_location_postend' ) ) {

					//////////////////////////////
					if( $print && get_option( 'pppm_print_location_custom' ) ) { 
						print( $sm ); 
					}
					elseif( $print && !get_option( 'pppm_print_location_custom' ) ) { 
						return false;
					}
					else {
						$sm = '<br><br>'.$sm.'<br>';
						return $sm;
					}
					//////////////////////////////
				}
			}
			elseif ( is_page() && !is_front_page() && get_option( 'pppm_print_in_page' ) ) {
				if( get_option( 'pppm_onoff_print_manager' ) && get_option( 'pppm_print_location_postend' ) ) {
				
					//////////////////////////////
					if( $print && get_option( 'pppm_print_location_custom' ) ) { 
						print( $sm ); 
					}
					elseif( $print && !get_option( 'pppm_print_location_custom' ) ) { 
						return false;
					}
					else {
						$sm = '<br><br>'.$sm.'<br>';
						return $sm;
					}
					//////////////////////////////
			}
			##################################################################
	}
}



function upm_save( $print = true, $unit = '' ) {
			
			global $post;
			if( $post->post_status != 'publish' ) return false;
			if( get_post_meta( $post->ID, '_upm-post-buttons', true ) ) return false;
			
			if( is_single() || is_page() ){
				if(post_password_required($post->ID)){
					return false;
				}
			}
			
			###################################################
			$pppm_follow = ( get_option( 'pppm_onoff_save_follow' ) ) ? '' : 'rel="nofollow"';
			$txt_string = stripslashes( get_option( 'pppm_save_txt_button_text' ) );
			$html_string = stripslashes( get_option( 'pppm_save_html_button_text' ) );
			$doc_string = stripslashes( get_option( 'pppm_save_doc_button_text' ) );
			$pdf_string = stripslashes( get_option( 'pppm_save_pdf_button_text' ) );
			$xml_string = stripslashes( get_option( 'pppm_save_xml_button_text' ) );
			$print_string = stripslashes( get_option( 'pppm_save_print_button_text' ) );
			
			if( strpos(get_permalink(), '?') === FALSE ){ $upx = get_permalink() . '?'; } else{ $upx = get_permalink() . '&'; }
			
			if ( class_exists('SitePress') ) {
				$upml = '&lang=' . ICL_LANGUAGE_CODE;
			}
			else{
				$upml = '';
			}
			
			$button['string']['txt'] = '<a href="'.$upx.'upm_export=text'.$upml.'" '.$pppm_follow.'>'.$txt_string.'</a>';
			$button['string']['html'] = '<a href="'.$upx.'upm_export=html'.$upml.'" '.$pppm_follow.'>'.$html_string.'</a>';
			$button['string']['doc'] = '<a href="'.$upx.'upm_export=doc'.$upml.'" '.$pppm_follow.'>'.$doc_string.'</a>';
			$button['string']['pdf'] = '<a href="'.$upx.'upm_export=pdf'.$upml.'" '.$pppm_follow.'>'.$pdf_string.'</a>';
			$button['string']['xml'] = '<a href="'.$upx.'upm_export=xml'.$upml.'" '.$pppm_follow.'>'.$xml_string.'</a>';
			$button['string']['print'] = '<a href="'.$upx.'upm_export=print'.$upml.'" target="_blank" '.$pppm_follow.'>'.$print_string.'</a>';
				/////////////////////////////////////////////////
			$button['icon']['txt'] = '<a href="'.$upx.'upm_export=text'.$upml.'" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_txt_icon_url' ).'" align="absmiddle" border="0" align="'.$txt_string.'" title="'.$txt_string.'" /></a>';
			$button['icon']['html'] = '<a href="'.$upx.'upm_export=html'.$upml.'" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_html_icon_url' ).'" align="absmiddle" border="0" align="'.$html_string.'" title="'.$html_string.'" /></a>';
			$button['icon']['doc'] = '<a href="'.$upx.'upm_export=doc'.$upml.'" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_doc_icon_url').'" align="absmiddle" border="0" align="'.$doc_string.'" title="'.$doc_string.'" /></a>';
			$button['icon']['pdf'] = '<a href="'.$upx.'upm_export=pdf'.$upml.'" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_pdf_icon_url').'" align="absmiddle" border="0" align="'.$pdf_string.'" title="'.$pdf_string.'" /></a>';
			$button['icon']['xml'] = '<a href="'.$upx.'upm_export=xml'.$upml.'" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_xml_icon_url').'" align="absmiddle" border="0" align="'.$xml_string.'" title="'.$xml_string.'" /></a>';
			$button['icon']['print'] = '<a href="'.$upx.'upm_export=print'.$upml.'" target="_blank" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_print_icon_url').'" align="absmiddle" border="0" align="'.$print_string.'" title="'.$print_string.'" /></a>';
				//////////////////////////////////////////////////
			$button['button']['txt'] = '<a href="'.$upx.'upm_export=text'.$upml.'" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_txt_button_url' ).'" style="padding:2px" align="absmiddle" border="0" align="'.$txt_string.'" title="'.$txt_string.'" /></a>';
			$button['button']['html'] = '<a href="'.$upx.'upm_export=html'.$upml.'" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_html_button_url' ).'" style="padding:2px" align="absmiddle" border="0" align="'.$html_string.'" title="'.$html_string.'" /></a>';
			$button['button']['doc'] = '<a href="'.$upx.'upm_export=doc'.$upml.'" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_doc_button_url').'" style="padding:2px" align="absmiddle" border="0" align="'.$doc_string.'" title="'.$doc_string.'" /></a>';
			$button['button']['pdf'] = '<a href="'.$upx.'upm_export=pdf'.$upml.'" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_pdf_button_url').'" style="padding:2px" align="absmiddle" border="0" align="'.$pdf_string.'" title="'.$pdf_string.'" /></a>';
			$button['button']['xml'] = '<a href="'.$upx.'upm_export=xml'.$upml.'" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_xml_button_url').'" style="padding:2px" align="absmiddle" border="0" align="'.$xml_string.'" title="'.$xml_string.'" /></a>';
			$button['button']['print'] = '<a href="'.$upx.'upm_export=print'.$upml.'" target="_blank" '.$pppm_follow.'><img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_print_button_url').'" style="padding:2px" align="absmiddle" border="0" align="'.$print_string.'" title="'.$print_string.'" /></a>';
			
			##################################################
			
			if( get_option( 'pppm_onoff_saving_txt' ) ) {
			
				if( get_option( 'pppm_saving_type' ) ) {
					//Button
					if( get_option( 'pppm_save_txt_button_type' ) ) {
						//button
						$sm_txt = $button['button']['txt'];
					}
					else {
						//icon
						$sm_txt = $button['icon']['txt'];
					}
				}
				else {
					//String
					$sm_txt = $button['string']['txt'];
				}
			}
			
			################################################################
			if( get_option( 'pppm_onoff_saving_html' ) ) {
			
				if( get_option( 'pppm_saving_type' ) ) {
					//Button
					if( get_option( 'pppm_save_html_button_type' ) ) {
						//button
						$sm_html = $button['button']['html'];
					}
					else {
						//icon
						$sm_html = $button['icon']['html'];
					}
				}
				else {
					//String
					$sm_html = $button['string']['html'];
				}
			}
			#################################################################
			if( get_option( 'pppm_onoff_saving_doc' ) ) {
		
				if( get_option( 'pppm_saving_type' ) ) {

					//Button
					if( get_option( 'pppm_save_doc_button_type' ) ) {
						//button
						$sm_doc = $button['button']['doc'];
					}
					else {
						//icon
						$sm_doc = $button['icon']['doc'];
					}
				}
				else {
					//String
					$sm_doc = $button['string']['doc'];
				}
			}
			#################################################################
			if( get_option( 'pppm_onoff_saving_pdf' ) ) {
		
				if( get_option( 'pppm_saving_type' ) ) {
					//Button
					if( get_option( 'pppm_save_pdf_button_type' ) ) {
						//button
						$sm_pdf = $button['button']['pdf'];
					}
					else {
						//icon
						$sm_pdf = $button['icon']['pdf'];
					}
				}
				else {
					//String
					$sm_pdf = $button['string']['pdf'];
				}
			}
			#################################################################
			if( get_option( 'pppm_onoff_saving_xml' ) ) {
		
				if( get_option( 'pppm_saving_type' ) ) {
					//Button
					if( get_option( 'pppm_save_xml_button_type' ) ) {
						//button
						$sm_xml = $button['button']['xml'];
					}
					else {
						//icon
						$sm_xml = $button['icon']['xml'];
					}
				}
				else {
					//String
					$sm_xml = $button['string']['xml'];
				}
			}
			#################################################################
			if( get_option( 'pppm_onoff_print_manager' ) ) {
		
				if( get_option( 'pppm_print_app' ) ) {
				
					if( get_option( 'pppm_print_type' ) ) {
						//Button
						if( get_option( 'pppm_save_print_button_type' ) ) {
							//button
							$sm_print = $button['button']['print'];
						}
						else {
							//icon
							$sm_print = $button['icon']['print'];
						}
					}
					else {
						//String
						$sm_print = $button['string']['print'];
					}
				}
			}
			
			
			#################################################################
			if( get_option( 'pppm_saving_position' ) ) {
					//Vertical
					$sm_position = str_replace(array('<br><br><br><br><br>', '<br><br><br><br>', '<br><br><br>', '<br><br>',), '<br>', $sm_pdf.'<br>'.$sm_doc.'<br>'.$sm_html.'<br>'.$sm_txt.'<br>'.$sm_xml.'<br>'.$sm_print);
			}
			else {
					//Horizontal
					$sm_position = str_replace(array(' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;', ' &nbsp; &nbsp; &nbsp; &nbsp;', ' &nbsp; &nbsp; &nbsp;', ' &nbsp; &nbsp;'), ' &nbsp;', $sm_pdf.' &nbsp;'.$sm_doc.' &nbsp;'.$sm_html.' &nbsp;'.$sm_txt.' &nbsp;'.$sm_xml.' &nbsp;'.$sm_print);
			}
			#################################################################
			if( get_option( 'pppm_saving_align' ) ) {
					//Right
					$sm = '<div id="upm-buttons" align="right">'.$sm_position.'</div>';
			}
			else {
					//Left
					$sm = '<div id="upm-buttons" align="left">'.$sm_position.'</div>';
			}
			
			if( $unit ){
				$sm = $button['icon']['txt'].' '.
				$button['icon']['html'].' '.
				$button['icon']['doc'].' '.
				$button['icon']['pdf'].' '.
				$button['icon']['xml'].' '.
				$button['icon']['print'];
			}
			#################################################################
			if( is_single() && get_option( 'pppm_saving_in_post' ) ) {
			
				if( get_option( 'pppm_onoff_saving_manager' )) {
					
					if( get_option('pppm_save_print_button_type') || get_option('pppm_save_pdf_button_type') ) {
						echo "<style> #upm-buttons img { border-radius: 3px; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2); } </style>";
					}
					
					#### Category Control ####
					foreach((get_the_category()) as $cat) {
						$CID = $cat->cat_ID;
					}
					
					$all_by_cat = true;
                    $s_cats = pppm_get_category_parents($CID);
                    
					if( is_string($s_cats) ){
                        $pc_array = explode( ',', $s_cats);
                        array_pop($pc_array);
                        $pc_array[] = $CID;
                        foreach($pc_array as $pcat){
                            if( get_option( 'pppm_bycat_saving_'.$pcat) ){
                                $all_by_cat = false; break;
                            }
                        }
                    }
					#### Category Control End ####
					if($all_by_cat){
						//////////////////////////////
						if( $print && get_option( 'pppm_saving_location_custom' ) ) { 
							print( $sm ); 
						}
						elseif( $print && !get_option( 'pppm_saving_location_custom' ) ) { 
							return false;
						}
						else {
							$sm = '<br><br>'.$sm.'<br>';
							return $sm;
						}
						//////////////////////////////
					}
					else{
						return false;
					}
				}
			}
			elseif ( is_page() && !is_front_page() && get_option( 'pppm_saving_in_page' ) ) {
				if( get_option( 'pppm_onoff_saving_manager' ) ) {
				
					//////////////////////////////
					if( $print && get_option( 'pppm_saving_location_custom' ) ) { 
						print( $sm ); 
					}
					elseif( $print && !get_option( 'pppm_saving_location_custom' ) ) { 
						return false;
					}
					else {
						$sm = '<br><br>'.$sm.'<br>';
						return $sm;
					}
					//////////////////////////////
			}
			##################################################################
	}
}
################################################################################################################



function pppm_export( $export ) {
	
	error_reporting(0);
	
	$export = $_GET[ 'upm_export' ];
	
	@set_time_limit (864000);
	if(ini_get('max_execution_time')!=864000)@ini_set('max_execution_time',864000);
	
	$post_id = url_to_postid( $_SERVER['REQUEST_URI'] );
	$post = get_post( $post_id ); 
	if( $post->post_status != 'publish' ) return false;
	if( post_password_required($post->ID)){
		return false;
	}
	
	$featured = true;
	if ( function_exists('has_post_thumbnail') && has_post_thumbnail($post->ID) ) {
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
		$upm_featured_image = ($thumbnail[0]) ? $thumbnail[0] : $thumbnail[0];
	}
	else{
		$upm_featured_image = '';
	}

	if( $thumbnail[1] ){
		$upm_featured_image = '<img width="'.$thumbnail[1].'" height="'.$thumbnail[2].'" src="'.$thumbnail[0].'"/>';
	}


	$upm_body = linkifyYouTubeURLs( $post->post_content );
	$upm_body = str_replace( "’" , "'", $upm_body );
	$upm_body =  do_shortcode( $upm_body );
	$xsearch = array ( "'<script[^>]*?>.*?</script>'si", "'<style[^>]*?>.*?</style>'si",  "'<head[^>]*?>.*?</head>'si", "'<link[^>]*?>.*?</link>'si", "'<link[^>]*?>'si", "'<object[^>]*?>.*?</object>'si"); 
	$xreplace = array ( "", "", "", "", "", "");                 
	$upm_body = preg_replace ($xsearch, $xreplace, $upm_body);
	if( preg_match('|src=[\"\']+([^>\"\']+)[\"\']+|', $upm_body, $body_img) && preg_match('|src=[\"\']+([^>\"\']+)[\"\']+|', $upm_featured_image, $feat_img) ){
		if( preg_replace('|-\d+x\d+\.|is', '.', basename($body_img[1])) == preg_replace('|-\d+x\d+\.|is', '.', basename($feat_img[1])) ){
			$featured = false;
		}
	}
	$upm_body = ( ($upm_featured_image && $featured) ? $upm_featured_image . "\r\n <br>" : '') . $upm_body;
	
	
	if( $export == 'text' ) {
	
		$txt_title = stripslashes( strip_tags( $post->post_title ) );
		$txt_body = stripslashes( strip_tags( $upm_body ) );
		$txt_excerpt = stripslashes( strip_tags( $post->post_excerpt ) );
		$txt_post_date = $post->post_date;
    	$txt_post_date_gmt = $post->post_date_gmt;
		$txt_modified_date = $post->post_modified;
		$txt_modified_date_gmt = $post->post_modified_gmt;
		
		preg_match_all('|<img\s+[^>]*src=[\"\']+([^>\"\']+)[\"\']+\s+[^>]*>|i', $upm_body, $body_array, PREG_SET_ORDER);
		preg_match('|^(.+)wp-content\/.+$|i',PPPM_PATH,$img_url_array);
		if( !empty($body_array) ) {
			
			for ($i=0; $i < count($body_array); $i++){
				
				if( strpos($body_array [$i][1],'http') === FALSE ){
					if( preg_match('|^(.*)wp-content\/(.+)$|i',$body_array [$i][1],$img_curr_url_array) ){
						$txt_img .= $img_url_array[1].'wp-content/'.$img_curr_url_array[2]."
\r\n";
					}
					else{
						$txt_img .= $img_url_array[1].$body_array[$i][1]."
\r\n";
					}
				}
				else{
					$txt_img .= $body_array [$i][1]."
\r\n";			}
			}
		}
		
		require( PPPM_FOLDER . 'template/save_as_text.php' );
		
		$txt_length = strlen( $txt );
		$file = trim( str_replace( ' ', '-' , $txt_title ) );
	
		header ( "Content-Type: text/plain" ); 
		header ( "Content-Length: ". $txt_length ); 
		header ( "Content-Disposition: attachment; filename = ".$file.".txt" );
		echo $txt; 
	
	}
	elseif( $export == 'html' ) {
	
		$html_title = stripslashes( $post->post_title );
		$html_body = stripslashes( $upm_body );
		$html_body = str_replace(array('<noscript>', '</noscript>'), '', $html_body);
		if( get_option('pppm_save_html_img_max_width') ){ $upm_max_image_width = get_option('pppm_save_html_img_max_width'); } else{ $upm_max_image_width = 500; }
		if( preg_match_all('|width=[\'\"]*(\d+)[\'\"]*[^\>\<]+height=[\'\"]*(\d+)[\'\"]*|i', $html_body, $html_img_sizes, PREG_SET_ORDER ) ){
			foreach( $html_img_sizes as $html_img ){
				$html_img_w = $html_img[1]; $html_img_h = $html_img[2];
				if( (int)$upm_max_image_width < (int)$html_img_w ){ $html_img_h = $html_img_h * ( $upm_max_image_width / $html_img_w ); $html_img_w = $upm_max_image_width; }
				$html_body = preg_replace('|width=[\'\"]*'.$html_img[1].'[\'\"]*[^\>\<]+height=[\'\"]*'.$html_img[2].'[\'\"]*|i', 'width="'.$html_img_w.'" height="'.$html_img_h.'"', $html_body );
			}
		}
		$html_body = preg_replace( array('|<embed[^>]+>[^>]*<\/embed>|i',
										 '|<object[^>]+>|i','|<\/object>|i',
										 '|<param[^>]+>|i',
										 '|<script[^>]+>[^>]*<\/script>|i'),'', $html_body );
		preg_match_all('|<img[^>]+(class[\s\n\t\r]*=[\s\n\t\r]*[\'\"]+[^\'\">]+[\'\"]+)[^>]*>|i', $html_body, $body_array, PREG_SET_ORDER);
		if( !empty($body_array) ) {
			for ($i=0; $i < count($body_array); $i++){
				$replace = preg_replace( '|(.+)class[\s\n\t\r]*=[\s\n\t\r]*[\'\"]+align([^\s\t\r\n\'\">]+)[^\'\">]*[\'\"]+(.+)|i','$1 align = "$2" style="padding:5px" $3', $body_array [$i][0] );
				$html_body = str_replace( $body_array [$i][0], $replace , $html_body);
			}
		}
		
		$pppm_html_urls = pppm_img_url( $html_body );
		if(!empty($pppm_html_urls)){
			foreach( $pppm_html_urls as $k=>$v ){
				$html_body = str_replace( $k, $v, $html_body );
			}
		}
		
		$pppm_url = get_option("siteurl");
		
		$html_body = str_replace( array("\r", "\r\n", "<br><br>","<br\><br\>"), "<br>", $html_body);
		$html_excerpt = stripslashes( $post->post_excerpt );
		$html_post_date = $post->post_date;
    	$html_post_date_gmt = $post->post_date_gmt;
		$html_modified_date = $post->post_modified;
		$html_modified_date_gmt = $post->post_modified_gmt;
		
		if(!get_option('pppm_html_t_image')){
			 $html_body = preg_replace( '|<img[^><]+>|i','', $html_body );
		}
		$html_t_title = 
		(($html_title && get_option('pppm_html_t_title'))? '<h2 style="text-align:'.get_option('pppm_save_text_align').'">'.$html_title.'</h2><br>' :'');
		$html_t_excerpt = 
		(($html_excerpt && get_option('pppm_html_t_excerpt'))?'<strong>Excerpt:</strong> '.$html_excerpt:'');
		$html_t_date = 
		((get_option('pppm_html_t_date'))?'Post date: '.$html_post_date.'<br>Post date GMT: '.$html_post_date_gmt.'<br>':'');
		$html_t_md_date = 
		((get_option('pppm_html_t_md'))?'Post modified date: '.$html_modified_date.'<br>
		Post modified date GMT: '.$html_modified_date_gmt:'');
		
		
		require( PPPM_FOLDER . 'template/save_as_html.php' );

		$html_length = strlen( $html );
		$file = trim( str_replace( ' ', '-' , $html_title ) );
		header ( "Content-Type: text/html" ); 
		header ( "Content-Length: ". $html_length ); 
		header ( "Content-Disposition: attachment; filename = ".$file.".html" );
		echo $html; 
	}
	elseif( $export == 'doc' ) {
		
		$doc_title = stripslashes( $post->post_title );
		$doc_body = stripslashes( $upm_body );
		if( get_option('pppm_save_doc_img_max_width') ){ $upm_max_image_width = get_option('pppm_save_doc_img_max_width'); } else{ $upm_max_image_width = 500; }
		if( preg_match_all('|width=[\'\"]*(\d+)[\'\"]*[^\>\<]+height=[\'\"]*(\d+)[\'\"]*|i', $doc_body, $doc_img_sizes, PREG_SET_ORDER ) ){
			foreach( $doc_img_sizes as $doc_img ){
				$doc_img_w = $doc_img[1]; $doc_img_h = $doc_img[2];
				if( (int)$upm_max_image_width < (int)$doc_img_w ){ $doc_img_h = $doc_img_h * ( $upm_max_image_width / $doc_img_w ); $doc_img_w = $upm_max_image_width; }
				$doc_body = preg_replace('|width=[\'\"]*'.$doc_img[1].'[\'\"]*[^\>\<]+height=[\'\"]*'.$doc_img[2].'[\'\"]*|i', 'width="'.$doc_img_w.'" height="'.$doc_img_h.'"', $doc_body );
			}
		}
		$doc_body = preg_replace('|\[caption[^\]]+\]([^\]]*)\[\/caption\]|is', '$1', $doc_body);
		$doc_body = preg_replace( array('|<embed[^>]+>[^>]*<\/embed>|i',
										 '|<object[^>]+>|i','|<\/object>|i',
										 '|<param[^>]+>|i',
										 '|<script[^>]+>[^>]*<\/script>|i'),'', $doc_body );
		preg_match_all('|<img[^>]+(class[\s\n\t\r]*=[\s\n\t\r]*[\'\"]+[^\'\">]+[\'\"]+)[^>]*>|i', $doc_body, $body_array, PREG_SET_ORDER);
		if( !empty($body_array) ) {
			for ($i=0; $i < count($body_array); $i++){
			
				$replace = preg_replace( 
				'|(.+)class[\s\n\t\r]*=[\s\n\t\r]*[\'\"]+align([^\s\t\r\n\'\">]+)[^\'\">]*[\'\"]+(.+)|i',
				'</span><![if !vml]> $1 align = \'$2\' $3 <![endif]><span style=\'font-size:10.5pt;color:#666666;\'>', 
				$body_array [$i][0] );
				$doc_body = str_replace( $body_array [$i][0], $replace , $doc_body);
			}
		}
		
		$pppm_doc_urls = pppm_img_url( $doc_body );
		if(!empty($pppm_doc_urls)){
			foreach( $pppm_doc_urls as $k=>$v ){
				$doc_body = str_replace( $k, $v, $doc_body );
			}
		}
		
		$doc_body = preg_replace( "|\r|", "</p> <p>" , $doc_body);
		$doc_excerpt = stripslashes( $post->post_excerpt );
		$doc_post_date = $post->post_date;
    	$doc_post_date_gmt = $post->post_date_gmt;
		$doc_modified_date = $post->post_modified;
		$doc_modified_date_gmt = $post->post_modified_gmt;
		
		if(!get_option('pppm_doc_t_image')){
			 $doc_body = preg_replace( '|<img[^><]+>|i','', $doc_body );
		}
		$doc_t_title = 
		(($doc_title && get_option('pppm_doc_t_title'))? '<h2 style="color:#000000;text-align:'.get_option('pppm_save_text_align').'">'.$doc_title.'</h2><br>' :'');
		$doc_t_excerpt = 
		(($doc_excerpt && get_option('pppm_doc_t_excerpt'))?'<strong>Excerpt:</strong> '.$doc_excerpt:'');
		$doc_t_date = 
		((get_option('pppm_doc_t_date'))?'Post date: '.$doc_post_date.'<br>Post date GMT: '.$doc_post_date_gmt.'<br>':'');
		$doc_t_md_date = 
		((get_option('pppm_doc_t_md'))?'Post modified date: '.$doc_modified_date.'<br>
		Post modified date GMT: '.$doc_modified_date_gmt:'');
		
		
		if( get_option('pppm_save_doc_template') ){
			require( PPPM_FOLDER . 'template/save_as_word_document.php' );
		}
		else{
			require( PPPM_FOLDER . 'template/save_as_word_document_oo.php' );
		}

		$doc_length = strlen( $doc );
		$file = trim( str_replace( ' ', '-' , $doc_title ) );
		header ( "Content-Type: application/msword; charset=".$encoding );
		header ( "Content-Length: ". $doc_length ); 
		header ( "Content-Disposition: attachment; filename=".$file.".doc" );
		echo $doc; 
	}
	elseif( $export == 'pdf' ) {
		
		
		global $pppm_html_link;
		$html_title = stripslashes( $post->post_title );
		$html_body = stripslashes( $upm_body );
		$html_body = preg_replace('|<noscript>.+?</noscript>|is', '', $html_body);
		$pppm_html_link = stripslashes( $post->guid );
		
		preg_match_all('|<img[^>]+(class[\s\n\t\r]*=[\s\n\t\r]*[\'\"]+[^\'\">]+[\'\"]+)[^>]*>|i', $html_body, $body_array, PREG_SET_ORDER);
		if( !empty($body_array) ) {
			for ($i=0; $i < count($body_array); $i++){
				$replace = preg_replace( '|(.+)class[\s\n\t\r]*=[\s\n\t\r]*[\'\"]+align([^\s\t\r\n\'\">]+)[^\'\">]*[\'\"]+(.+)|i','$1 align = "$2" style="padding:5px" $3', $body_array [$i][0] );
				$html_body = str_replace( $body_array [$i][0], $replace , $html_body);
			}
		}
		$html_body = preg_replace( "|\r|", "<br>" , $html_body);
		$pppm_pdf_urls = pppm_img_url( $html_body );
		
		if(!empty($pppm_pdf_urls)){
			foreach( $pppm_pdf_urls as $k=>$v ){
				if( strpos( $k, '../' ) === FALSE ){
					$html_body = str_replace( $k, $v, $html_body );
				}
				else{
					continue;
				}
			}
		}
		
		require( PPPM_FOLDER . 'template/save_as_pdf.php' );
		require( PPPM_FOLDER . 'pdf.php' );
	
	}
	elseif( $export == 'xml' ) {
	
		$xml_title = stripslashes( strip_tags( $post->post_title ) );
		$xml_link = stripslashes( $post->guid );
		$xml_body = stripslashes( $upm_body );
		$xml_excerpt = stripslashes( strip_tags( $post->post_excerpt ) );
		
		require( PPPM_FOLDER . 'template/save_as_xml.php' );
	}
	elseif( $export == 'print' ) {
	
		$print_title = stripslashes( $post->post_title );
		$print_body = stripslashes( $upm_body );
		$print_body = str_replace(array('<noscript>', '</noscript>'), '', $print_body);
		if( get_option('pppm_save_print_img_max_width') ){ $upm_max_image_width = get_option('pppm_save_print_img_max_width'); } else{ $upm_max_image_width = 500; }
		if( preg_match_all('|width=[\'\"]*(\d+)[\'\"]*[^\>\<]+height=[\'\"]*(\d+)[\'\"]*|i', $print_body, $print_img_sizes, PREG_SET_ORDER ) ){
			foreach( $print_img_sizes as $print_img ){
				$print_img_w = $print_img[1]; $print_img_h = $print_img[2];
				if( (int)$upm_max_image_width < (int)$print_img_w ){ $print_img_h = $print_img_h * ( $upm_max_image_width / $print_img_w ); $print_img_w = $upm_max_image_width; }
				$print_body = preg_replace('|width=[\'\"]*'.$print_img[1].'[\'\"]*[^\>\<]+height=[\'\"]*'.$print_img[2].'[\'\"]*|i', 'width="'.$print_img_w.'" height="'.$print_img_h.'"', $print_body );
			}
		}
		$print_body = preg_replace('|\[caption[^\]]+\]([^\]]*)\[\/caption\]|is', '$1', $print_body);
		$print_body = preg_replace( array('|<embed[^>]+>[^>]*<\/embed>|i',
										 '|<object[^>]+>|i','|<\/object>|i',
										 '|<param[^>]+>|i',
										 '|<script[^>]+>[^>]*<\/script>|i'),'', $print_body );
										 
		if(get_option('pppm_pt_links')){
			preg_match_all("|<a href[\s\n\t\r]*=[\s\n\t\r]*[\'\"]+([^>\'\"]+)[\'\"]+[^><]*>([^><]+)</a>|i",$print_body,$links_array,PREG_SET_ORDER);
			if( !empty($links_array) ) {
				for ($i=0; $i < count($links_array); $i++){
					$print_links .= '<li>'.pppm_phrase_spliter( $links_array[$i][1], 50, ' ', false ).'</li>';
					$print_body = str_replace( $links_array[$i][0],'<u>'.$links_array[$i][0].'</u> <sup>'.($i+1).'</sup>',$print_body);
				}
			}
		}
		preg_match_all('|<img[^>]+(class[\s\n\t\r]*=[\s\n\t\r]*[\'\"]+[^\'\">]+[\'\"]+)[^>]*>|i', $print_body, $body_array, PREG_SET_ORDER);
		if( !empty($body_array) ) {
			for ($i=0; $i < count($body_array); $i++){
				$replace = preg_replace( '|(.+)class[\s\n\t\r]*=[\s\n\t\r]*[\'\"]+align([^\s\t\r\n\'\">]+)[^\'\">]*[\'\"]+(.+)|i','$1 align = "$2" style="padding:5px" $3', $body_array[$i][0] );
				$print_body = str_replace( $body_array[$i][0], $replace , $print_body);
			}
		}
		$print_body = preg_replace( "|\r|", "<br>" , $print_body);
		$print_excerpt = stripslashes( $post->post_excerpt );
		$print_post_date = $post->post_date;
    	$print_post_date_gmt = $post->post_date_gmt;
		$print_modified_date = $post->post_modified;
		$print_modified_date_gmt = $post->post_modified_gmt;
		
		if(!get_option('pppm_pt_image')){
			 $print_body = preg_replace( '|<img[^><]+>|i','', $print_body );
		}
		
		$pt_header = (get_option('pppm_pt_head_site'))? '<a href="'.get_option('siteurl').'" target="_blank" class="upm_header_2">'.get_option('blogname').'</a> <br/>': '';
		$pt_header .= (get_option('pppm_pt_head_url'))? '<a href="'.get_permalink($post_id).'" target="_blank" class="upm_header_3">'.get_permalink($post_id).'</a> <br />': '';
		$pt_header .= (get_option('pppm_pt_head_date'))? 'Export date: '. date("D M j G:i:s Y / O ") .' GMT<br />': '';
		$pt_header .= '<hr />';
		
		$pt_title = 
		(($print_title && get_option('pppm_pt_title'))? '<h2 style="text-align:'.get_option('pppm_save_text_align').'">'.$print_title.'</h2><br>' :'');
		
		$pt_excerpt = 
		(($print_excerpt && get_option('pppm_pt_excerpt'))?'<strong>Excerpt:</strong> '.$print_excerpt:'');
		
		$pt_links = 
		(($print_links && get_option('pppm_pt_links'))?'<strong>Links:</strong> <ol type="1">'.$print_links.'</ol>':'');
		
		$pt_date = 
		((get_option('pppm_pt_date'))?'Post date: '.$print_post_date.'<br>Post date GMT: '.$print_post_date_gmt.'<br><br>':'');
		
		$pt_md_date = 
		((get_option('pppm_pt_md'))?'Post modified date: '.$print_modified_date.'<br>
		Post modified date GMT: '.$print_modified_date_gmt:'');
		
		$pt_footer = ((get_option('pppm_pt_header'))?'<br>Export date: '. date("D M j G:i:s Y / O ") .' GMT
		<br> This page was exported from '.get_option('blogname').' 
		[ <a href="'.(str_replace( array('&upm_export=print','?upm_export=print'), '', $_SERVER['REQUEST_URI'] )).'" target="_blank">'.get_option('siteurl').'</a> ]<hr/>
		Export of Post and Page has been powered by [ Universal Post Manager ] plugin from 
		<a href="http://www.ProfProjects.com" target="_blank">www.ProfProjects.com</a>':'');
		
		require( PPPM_FOLDER . 'template/print.php' );
		echo $print; 
	}
	exit;
}
################################################################################################################
function pppm_shortcut ( $string ) {
	
	global $wpdb;
	$pppm_res = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."pppm_shortcut` ");
	if( !empty($pppm_res) ){
		foreach ( $pppm_res as $res ) {
					
			#******************************************************************************#
			if( $res->img_w && $res->img_h == 0 ) {
				$pppm_img = 'width="'.$res->img_w.'"';
			}
			elseif( $res->img_w == 0 && $res->img_h ) {
				$pppm_img = 'height="'.$res->img_h.'"';
			}
			elseif ( $res->img_w && $res->img_h ) {
				$pppm_img = 'width="'.$res->img_w.'" height="'.$res->img_h.'"';
			}
			#******************************************************************************#
			if( $res->link_url && $res->img_url ) {
				
				$pppm_shcode = '<a href = "'.$res->link_url.'" target = "'.$res->link_target.'" '.$pppm_follow.'><img src="'.$res->img_url.'" alt="'.pppm_filter_ss( $res->link_text ).'" title="'.pppm_filter_ss( $res->link_text ).'" border="0" align="'.$res->img_align.'" '.$pppm_img.' /></a>';
			}
			elseif( $res->link_url && $res->img_url == '' ) {
			
				$pppm_shcode = '<a href = "'.$res->link_url.'" target = "'.$res->link_target.'" '.$pppm_follow.'> '.pppm_filter_ss( $res->link_text ).' </a>';
			}
			else {
				
				$pppm_shcode = '<img src="'.$res->img_url.'" alt="'.pppm_filter_ss( $res->link_text ).'" title="'.pppm_filter_ss( $res->link_text ).'" border="0" align="'.$res->img_align.'" '.$pppm_img.'/>';
			}
			#******************************************************************************#
			$sh_find = addslashes(stripslashes($res->shortcut));
			
			if( !preg_match( '/\:[^:]+\:/', $sh_find ) ) {
				$string = preg_replace( "|\b$sh_find\b|i", $pppm_shcode, $string );
			}
			else {
				$string = str_replace( $sh_find, $pppm_shcode, $string );
			}
			#******************************************************************************#
		}
	}
	return $string;
}
################################################################################################################
function pppm_html_manager ( $string ) {
	
	global $wpdb;
	global $allowedposttags;
	global $additional_tags;
	global $post;
	global $userdata;
	
	if( is_admin() ) {
		$pppm_userdata = $userdata;
	}
	else {
		if(!IS_WPMU){
			$pppm_user = wp_get_current_user();
			$pppm_array = $pppm_user->roles;
		}
		else{
			$pppm_userdata = get_userdata( $post->post_author );
			$pppm_array = $pppm_userdata->wp_capabilities;
		}
	}
	if( $pppm_array[0] == '' )$pppm_array[0] = 'administrator';
	$pppm_user_role = array_keys( $pppm_array );
	$allowedposttags = array_merge( $allowedposttags, $additional_tags );
	$string = stripslashes(trim( $string ));
	( is_page() ) ? $mode = 'page': $mode = 'post';
	
	///////////////////////////////////////////////////////////
	///////////////// HTML Manager ////////////////////////////
	///////////////////////////////////////////////////////////
	$mode_html_post = false;
	$mode_html_page = false;
	if( get_option( 'pppm_onoff_html_manager' ) ) {
		if( get_option( 'pppm_html_role_'.$pppm_user_role[0] )) { 
			if( get_option( 'pppm_onoff_html_manager_post' ) && $mode == 'post' ) { $mode_html_post = true; }
			if( get_option( 'pppm_onoff_html_manager_page' ) && $mode == 'page' ) { $mode_html_page = true; }
		}
		if( ( $mode == 'post' && $mode_html_post ) || ( $mode == 'page' && $mode_html_page ) ) {
			///////////////////////////////////////////////////////////////
			$pppm_res = $wpdb->get_results("SELECT `tag` FROM `".$wpdb->prefix."pppm_html` WHERE `status_".$mode."` = 1 ");
			foreach ( $pppm_res as $res ) {
				$allowed_html[$res->tag] = $allowedposttags[$res->tag];
			}
			$pppm_res = $wpdb->get_results("SELECT `protocol` FROM `".$wpdb->prefix."pppm_protocol` WHERE `status_".$mode."` = 1 ");
			foreach ( $pppm_res as $res ) {
				$allowed_protocols[] = $res->protocol;
			}
			
			foreach ( $allowed_html as $key => $check_empty ) {
			
				if( !is_array( $check_empty )) continue;
				$allowed_html_array[ $key ] = $check_empty;
			}
			
			$string = wp_kses($string, $allowed_html_array, $allowed_protocols);
			/////////////////////////////////////////////////////////////////
		}
	}
	///////////////////////////////////////////////////////////
	///////////////// Saving Manager //////////////////////////
	///////////////////////////////////////////////////////////
	//if( !is_admin() && get_option( 'pppm_saving_location_postend' )  ) {
		//$sm = upm_save( false );
	//}
	///////////////////////////////////////////////////////////
	///////////////////// Email This //////////////////////////
	///////////////////////////////////////////////////////////
	//if( !is_admin() ) $et = upm_email( false );
	///////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////
	
	return $string.$sm.$et;
}

function pppm_saving_buttons( $string ){
	if( !is_admin() && get_option( 'pppm_saving_location_postend' )  ) {
		$sm = upm_save( false );
	}
	return $string ."\r\n". $sm;
}
	
################################################################################################################
function pppm_filter_manager ( $string ) { 

	global $wpdb;
	global $allowedposttags;
	global $additional_tags;
	global $post;
	global $userdata;
	
	if( is_admin() ) {
		$pppm_userdata = $userdata;
	}
	else {
		if(!IS_WPMU){
			$pppm_user = wp_get_current_user();
			$pppm_array = $pppm_user->roles;
		}
		else{
			$pppm_userdata = get_userdata( $post->post_author );
			$pppm_array = $pppm_userdata->wp_capabilities;
		}
	}
	if( $pppm_array[0] == '' )$pppm_array[0] = 'administrator';
	$pppm_user_role = array_keys( $pppm_array );
	$allowedposttags = array_merge( $allowedposttags, $additional_tags );
	$string = stripslashes(trim( $string ));
	( is_page() ) ? $mode = 'page': $mode = 'post';
	
	///////////////////////////////////////////////////////////
	///////////////// Filter Manager //////////////////////////
	///////////////////////////////////////////////////////////
	$mode_filter_post = false;
	$mode_filter_page = false;
	if( get_option( 'pppm_onoff_filter_manager' ) ) {
		if( get_option( 'pppm_filter_role_'.$pppm_user_role[0] )) { 
			if( get_option( 'pppm_phrase_filter_post' ) && $mode == 'post' ) { $mode_filter_post = true; }
			if( get_option( 'pppm_phrase_filter_page' ) && $mode == 'page' ) { $mode_filter_page = true; }
		}
		if( ( $mode == 'post' && $mode_filter_post ) || ( $mode == 'page' && $mode_filter_page ) ) {
			///////////////////////////////////////////////////////////////
			if( get_option( 'pppm_onoff_phrase_filter' ) ) {
				$pppm_res = $wpdb->get_results("SELECT `phrase`, `replace` FROM `".$wpdb->prefix."pppm_filter` ");
				if( !empty($pppm_res) ){
					foreach ( $pppm_res as $res ) {
						$find = addslashes(stripslashes($res->phrase));
						$replace = stripslashes($res->replace);
						$string = preg_replace( "|\b$find\b|i", $replace, $string );
					}
				}
			}
			/////////////////////////////////////////////////////////////////
			if( get_option( 'pppm_onoff_text_modifier' ) ) {
				$string = pppm_shortcut ( $string );
			}
			/////////////////////////////////////////////////////////////////
			if( get_option( 'pppm_onoff_long_phrase' ) ) {
				$max_length = get_option( 'pppm_filter_longphrase_maxlength' );
				$after = get_option( 'pppm_filter_longphrase_after' );
				( $after == 'divide' ) ? $return_first_part = false : $return_first_part = true ;
				$tmp_string = strip_tags( $string );
				$tmp_array = explode( ' ', $tmp_string );
				foreach ( $tmp_array as $tmp_phrase ) {
					if( mb_strlen( $tmp_phrase , 'utf-8') > $max_length ) {
						$tmp_short_replace = pppm_phrase_spliter( $tmp_phrase, $max_length, ' ', $return_first_part );
						$string = str_replace( $tmp_phrase, $tmp_short_replace, $string );
					}
				}
			}
			/////////////////////////////////////////////////////////////////
		}
	}
	return $string;
}
##################################################################################################
function  pppm_html_manager_after_comments ( $string ) {
	
	global $wpdb;
	global $allowedposttags;
	global $additional_tags;
	global $comment;
	
	$allowedposttags = array_merge( $allowedposttags, $additional_tags );
	$string = stripslashes(trim( $string ));
	///////////////////////////////////////////////////////////
	///////////////// HTML Manager ////////////////////////////
	///////////////////////////////////////////////////////////
	if( get_option( 'pppm_onoff_html_manager' ) ) {
		if( $comment->user_id ) {
			$pppm_userdata = get_userdata( $comment->user_id );
			$pppm_user_role = array_keys( $pppm_userdata->wp_capabilities );
			if( get_option( 'pppm_html_role_'.$pppm_user_role[0] ) &&  get_option( 'pppm_onoff_html_manager_comment' ) ) {
				///////////////////////////////////////////////////////////////
				$pppm_res = $wpdb->get_results("SELECT `tag` FROM `".$wpdb->prefix."pppm_html` WHERE `status_comment` = 1 ");
				foreach ( $pppm_res as $res ) {
				
					$allowed_html[$res->tag] = $allowedposttags[$res->tag];
				}
				unset($pppm_res);
				$pppm_res = $wpdb->get_results("SELECT `protocol` FROM `".$wpdb->prefix."pppm_protocol` WHERE `status_comment` = 1 ");
				foreach ( $pppm_res as $res ) {
				
					$allowed_protocols[$res->protocol] = $res->protocol;
				}
				
				foreach ( $allowed_html as $key => $check_empty ) {
			
					if( !is_array( $check_empty )) continue;
					$allowed_html_array[ $key ] = $check_empty;
				}
				
				$string = wp_kses($string, $allowed_html_array, $allowed_protocols);
				/////////////////////////////////////////////////////////////////
			}
		}
	}
	return $string;
}
###############################################################################################################
function  pppm_html_manager_before_comments( $string ) {
	
	global $wpdb;
	global $allowedposttags;
	global $additional_tags;
	global $comment;
	global $userdata;
	
	$allowedposttags = array_merge( $allowedposttags, $additional_tags );
	$string = stripslashes(trim( $string ));
	
	$pppm_userdata = $userdata;
	///////////////////////////////////////////////////////////
	///////////////// HTML Manager ////////////////////////////
	///////////////////////////////////////////////////////////
	if( get_option( 'pppm_onoff_html_manager' ) ) {
		if( $pppm_userdata->ID ) {
			
			$pppm_user_role = array_keys( $pppm_userdata->wp_capabilities );
			
			if( get_option( 'pppm_html_role_'.$pppm_user_role[0] ) &&  get_option( 'pppm_onoff_html_manager_comment' ) ) {
				///////////////////////////////////////////////////////////////
				$pppm_res = $wpdb->get_results("SELECT `tag` FROM `".$wpdb->prefix."pppm_html` WHERE `status_comment` = 1 ");
				foreach ( $pppm_res as $res ) {
				
					$allowed_html[$res->tag] = $allowedposttags[$res->tag];
				}
				unset($pppm_res);
				$pppm_res = $wpdb->get_results("SELECT `protocol` FROM `".$wpdb->prefix."pppm_protocol` WHERE `status_comment` = 1 ");
				foreach ( $pppm_res as $res ) {
				
					$allowed_protocols[$res->protocol] = $res->protocol;
				}
				
				foreach ( $allowed_html as $key => $check_empty ) {
			
					if( !is_array( $check_empty )) continue;
					$allowed_html_array[ $key ] = $check_empty;
				}
				
				$string = wp_kses($string, $allowed_html_array, $allowed_protocols);
				/////////////////////////////////////////////////////////////////
			}
		}
	}
	return $string;
}
##################################################################################################
function  pppm_filter_manager_after_comments ( $string ) { 

	global $wpdb;
	global $comment;
	$string = stripslashes(trim( $string ));
	
	///////////////////////////////////////////////////////////
	///////////////// Filter Manager //////////////////////////
	///////////////////////////////////////////////////////////
	if( get_option( 'pppm_onoff_filter_manager' ) ) {
		
		if( $comment->user_id ) {
			$pppm_userdata = get_userdata( $comment->user_id );
			$pppm_user_role = array_keys( $pppm_userdata->wp_capabilities );
			if( get_option( 'pppm_filter_role_'.$pppm_user_role[0] ) &&  get_option( 'pppm_phrase_filter_comment' ) ) {
				///////////////////////////////////////////////////////////////
				if( get_option( 'pppm_onoff_phrase_filter' ) ) {
					$pppm_res = $wpdb->get_results("SELECT `phrase`, `replace` FROM `".$wpdb->prefix."pppm_filter` ");
					foreach ( $pppm_res as $res ) {
						$find = addslashes(stripslashes($res->phrase));
						$replace = stripslashes($res->replace);
						$string = preg_replace( "|\b$find\b|i", $replace, $string );
					}
				}
				/////////////////////////////////////////////////////////////////
				if( get_option( 'pppm_onoff_text_modifier' ) ) {
					$string = pppm_shortcut ( $string );
				}
				/////////////////////////////////////////////////////////////////
				if( get_option( 'pppm_onoff_long_phrase' ) ) {
					$max_length = get_option( 'pppm_filter_longphrase_maxlength' );
					$after = get_option( 'pppm_filter_longphrase_after' );
					( $after == 'divide' ) ? $return_first_part = false : $return_first_part = true ;
					$tmp_string = strip_tags( $string );
					$tmp_array = explode( ' ', $tmp_string );
					foreach ( $tmp_array as $tmp_phrase ) {
						if( mb_strlen( $tmp_phrase , 'utf-8') > $max_length ) {
							$tmp_short_replace = pppm_phrase_spliter( $tmp_phrase, $max_length, ' ', $return_first_part );
							$string = str_replace( $tmp_phrase, $tmp_short_replace, $string );
						}
					}
				}
				/////////////////////////////////////////////////////////////////
			}
		}
	}
	return $string;
}
##################################################################################################
function  pppm_filter_manager_before_comments ( $string ) { 

	global $wpdb;
	global $comment;
	global $userdata;
	
	$string = stripslashes(trim( $string ));
	$pppm_userdata = $userdata;
	///////////////////////////////////////////////////////////
	///////////////// HTML Manager ////////////////////////////
	///////////////////////////////////////////////////////////
	if( get_option( 'pppm_onoff_html_manager' ) ) {
		if( $pppm_userdata->ID ) {
		
			$pppm_user_role = array_keys( $pppm_userdata->wp_capabilities );
			if( get_option( 'pppm_filter_role_'.$pppm_user_role[0] ) &&  get_option( 'pppm_phrase_filter_comment' ) ) {
				///////////////////////////////////////////////////////////////
				if( get_option( 'pppm_onoff_phrase_filter' ) ) {
					$pppm_res = $wpdb->get_results("SELECT `phrase`, `replace` FROM `".$wpdb->prefix."pppm_filter` ");
					foreach ( $pppm_res as $res ) {
						$find = addslashes(stripslashes($res->phrase));
						$replace = stripslashes($res->replace);
						$string = preg_replace( "|\b$find\b|i", $replace, $string );
					}
				}
				/////////////////////////////////////////////////////////////////
				if( get_option( 'pppm_onoff_text_modifier' ) ) {
					$string = pppm_shortcut ( $string );
				}
				/////////////////////////////////////////////////////////////////
				if( get_option( 'pppm_onoff_long_phrase' ) ) {
					$max_length = get_option( 'pppm_filter_longphrase_maxlength' );
					$after = get_option( 'pppm_filter_longphrase_after' );
					( $after == 'divide' ) ? $return_first_part = false : $return_first_part = true ;
					$tmp_string = strip_tags( $string );
					$tmp_array = explode( ' ', $tmp_string );
					foreach ( $tmp_array as $tmp_phrase ) {
						if( mb_strlen( $tmp_phrase , 'utf-8') > $max_length ) {
							$tmp_short_replace = pppm_phrase_spliter( $tmp_phrase, $max_length, ' ', $return_first_part );
							$string = str_replace( $tmp_phrase, $tmp_short_replace, $string );
						}
					}
				}
				/////////////////////////////////////////////////////////////////
			}
		}
	}
	return $string;
}
##################################################################################################
function pppm_filter_htmlsch( $str ) {
	return  $str = htmlspecialchars(trim( $str ));
}
##################################################################################################
function pppm_filter_strip( $str ) {
	return  $str = strip_tags(trim( $str ));
}
##################################################################################################
function pppm_filter_ss( $str ) {
	return  $str = htmlspecialchars(stripslashes(trim( $str )));
}
##################################################################################################
function pppm_phrase_spliter( $str, $length, $merging_string = ' ', $return_first_part = true ) {
	if( !$return_first_part ) {
		
		$str = str_replace(',', ', ', $str );
		$array_1 = explode( ' ', $str);
		foreach ($array_1 as $part_1) {
			if( mb_strlen( $part_1,'utf-8') > $length ) {
				$string_array = str_split( $part_1, $length );
				$part_1 = implode( $merging_string, $string_array);
				unset($string_array);
			}
			$new_string .= $part_1 .' ';
		}
	}
	else {
			if( mb_strlen( $str, 'utf-8') > $length ) {
				$new_string = substr( $str, 0, $length ) .'...';
			}
			else {
				$new_string = $str;
			}
	}
	return trim( $new_string );
}
##################################################################################################
function arraychecker($var,$arr)
{
	$rv=false;
	for($r=0;$r<count($arr);$r++)
	{
		if($arr[$r]==$var){$rv=true;break;}
	}
	return $rv;
}
#######################################################################################################
function linkifyYouTubeURLs($text) {
    $text = preg_replace('~
        # Match non-linked youtube URL in the wild. (Rev:20130823)
        https?://         # Required scheme. Either http or https.
        (?:[0-9A-Z-]+\.)? # Optional subdomain.
        (?:               # Group host alternatives.
          youtu\.be/      # Either youtu.be,
        | youtube         # or youtube.com or
          (?:-nocookie)?  # youtube-nocookie.com
          \.com           # followed by
          \S*             # Allow anything up to VIDEO_ID,
          [^\w\s-]       # but char before ID is non-ID char.
        )                 # End host alternatives.
        ([\w-]{11})      # $1: VIDEO_ID is exactly 11 chars.
        (?=[^\w-]|$)     # Assert next char is non-ID or EOS.
        (?!               # Assert URL is not pre-linked.
          [?=&+%\w.-]*    # Allow URL (query) remainder.
          (?:             # Group pre-linked alternatives.
            [\'"][^<>]*>  # Either inside a start tag,
          | </a>          # or inside <a> element text contents.
          )               # End recognized pre-linked alts.
        )                 # End negative lookahead assertion.
        [?=&+%\w.-]*        # Consume any URL (query) remainder.
        ~ix', 
        '<p style="clear:both"> YouTube Video: <a href="http://www.youtube.com/watch?v=$1">YouTube.com/watch?v=$1</a> </p>',
        $text);
    return $text;
}
?>