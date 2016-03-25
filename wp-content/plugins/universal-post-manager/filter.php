<?php

	global $wpdb;
	
	#############################################################################################
	if( $_POST[ 'pppm_hidden' ] == 'pppm_form_phrase_filter' ) {
			
		$pppm_phrase_find = pppm_filter_htmlsch( $_POST['pppm_phrase_find'] );
		$pppm_phrase_replace = pppm_filter_htmlsch( $_POST['pppm_phrase_replace'] );
		$pppm_up_id = $_POST['pppm_up_id'];
		$pppm_phrase_find_array = explode(',', $pppm_phrase_find );
		
		if(!empty($pppm_phrase_find_array))
		{
			if( $pppm_up_id ) {
			
				$wpdb->query( "UPDATE `". $wpdb->prefix ."pppm_filter` SET 
							  `phrase` = '". $wpdb->escape( $pppm_phrase_find_array[0] ) ."',
							  `replace` = '". $wpdb->escape( $pppm_phrase_replace ) ."'
							   WHERE `id` = $pppm_up_id " );
			echo '<div class="updated"><p><strong>'. __( 'Options updated.' ) .'</strong></p></div>';
			}
			else {
			
				foreach ( $pppm_phrase_find_array as $pppm_phrase )
				{
				
					$pppm_res = $wpdb->get_row(" SELECT `id` FROM `".$wpdb->prefix."pppm_filter` WHERE `phrase` = '".$wpdb->escape($pppm_phrase)."'", ARRAY_A);
					
					if( $pppm_res['id'] ) {
						$wpdb->query( "UPDATE `". $wpdb->prefix ."pppm_filter` SET `replace` = '". $wpdb->escape( $pppm_phrase_replace ) ."' WHERE `phrase` = '". $wpdb->escape( $pppm_phrase ) ."'" );
					}
					else {
							 $wpdb->insert( $wpdb->prefix .'pppm_filter', 
							 array('phrase' => $pppm_phrase,  
								   'replace' => $pppm_phrase_replace ), 
							 array('%s', '%s' ) );
					}	
				}
				echo '<div class="updated"><p><strong>'. __( 'Options saved.' ) .'</strong></p></div>';
			}
		}
		else {
			 echo '<div class="updated"><p><strong>'. __( 'Phrase is missed' ) .'</strong></p></div>';
		}
	}
	elseif( $_POST[ 'pppm_hidden' ] == 'pppm_form_phrase_edit' ) {
	
		if( $_POST[ 'delete' ] == 'Delete' && intval( $_POST[ 'pppm_phrase_filter' ] ) ) {
			$wpdb->query( "DELETE FROM `". $wpdb->prefix ."pppm_filter` WHERE `id` = ". intval( $_POST[ 'pppm_phrase_filter' ] ));
			echo '<div class="updated"><p><strong>'. __( 'Phrase is deleted' ) .'</strong></p></div>';
		}
	
	}
	elseif( $_POST[ 'pppm_hidden' ] == 'pppm_form_long_phrase' ) {
	
		$pppm_maxlength = intval( $_POST['pppm_maxlength'] );
		$pppm_after_maxlen = pppm_filter_strip( $_POST['pppm_after_maxlen'] );
		if( $pppm_maxlength && $pppm_after_maxlen ) {
		
			update_option( 'pppm_filter_longphrase_maxlength', $pppm_maxlength );
			update_option( 'pppm_filter_longphrase_after', $pppm_after_maxlen );
			echo '<div class="updated"><p><strong>'. __( 'Options saved.' ) .'</strong></p></div>';
		}
	
	}
	elseif( $_POST[ 'pppm_hidden' ] == 'pppm_txt_mod' ) {
	
		if( $_POST['pppm_shortcut'] ) {
		
			if( ( trim( $_POST['pppm_link_text'] ) && strlen(trim( $_POST['pppm_link_url'] )) > 10 ) || 
				( trim( $_POST['pppm_img_align'] ) && 
				  strlen(trim( $_POST['pppm_img_url'] )) > 10 ) && 
				  ( $_POST['pppm_img_w'] || $_POST['pppm_img_h']) ) {
			
				  $pppm_shortcut = pppm_filter_strip( $_POST['pppm_shortcut'] );
				  $pppm_link_text = pppm_filter_strip( $_POST['pppm_link_text'] );
				  $pppm_link_url = pppm_filter_strip( $_POST['pppm_link_url'] );
				  $pppm_link_target = pppm_filter_strip( $_POST['pppm_link_target'] );
				  $pppm_img_w = intval( $_POST['pppm_img_w'] );
				  $pppm_img_h = intval( $_POST['pppm_img_h'] );
				  $pppm_img_align = pppm_filter_strip( $_POST['pppm_img_align'] );
				  $pppm_img_url = pppm_filter_strip( $_POST['pppm_img_url'] );
				  $pppm_shortcut_up_id = intval( $_POST['pppm_shortcut_up_id'] );
				  
				  if( strlen( $pppm_link_url ) < 10 ) {
				  	$pppm_link_url = '';
					$pppm_link_text = '';
					$pppm_link_target = '';
				  }
				  if( strlen( $pppm_img_url ) < 10 ) {
				  	$pppm_img_url = '';
				  	$pppm_img_w = 0;
				    $pppm_img_h = 0;
				    $pppm_img_align = '';
				  }
				  if( $pppm_img_url == '' && $pppm_link_url == '' ) {
				 	 $this->pppm_unsp = true;
					 $this->pppm_note = '<div class="pppm_updated"><p><strong>'. __( 'Link\'s or Image\'s  data are not completed' ) .'</strong></p></div>';
				  }
				  else {
	
					if( $pppm_shortcut_up_id ) {
				
						$wpdb->query( "UPDATE `". $wpdb->prefix ."pppm_shortcut` SET 
						`shortcut` = '". $wpdb->escape( $pppm_shortcut ) ."',
						`link_text` = '". $wpdb->escape( $pppm_link_text ) ."',
						`link_url` = '". $wpdb->escape( $pppm_link_url ) ."',
						`link_target` = '". $wpdb->escape( $pppm_link_target ) ."',
						`img_w` = ". $pppm_img_w .",
						`img_h` = ". $pppm_img_h .",
						`img_align` = '". $wpdb->escape( $pppm_img_align ) ."',
						`img_url` = '". $wpdb->escape( $pppm_img_url ) ."'
						 WHERE `id` = ". $pppm_shortcut_up_id );
						$this->pppm_unsp = false;
					    $this->pppm_note = '<div class="pppm_updated"><p><strong>'. __( 'Options updated' ) .'</strong></p></div>';
					}
					else {
					
						$pppm_res = $wpdb->get_row(" SELECT `id` FROM `".$wpdb->prefix."pppm_shortcut` WHERE `shortcut` = '".$wpdb->escape($pppm_shortcut)."'", ARRAY_A);
					  if( $pppm_res->id ) {
						$wpdb->query( "UPDATE `". $wpdb->prefix ."pppm_shortcut` SET 
						`link_text` = '". $wpdb->escape( $pppm_link_text ) ."',
						`link_url` = '". $wpdb->escape( $pppm_link_url ) ."',
						`link_target` = '". $wpdb->escape( $pppm_link_target ) ."',
						`img_w` = ". $pppm_img_w .",
						`img_h` = ". $pppm_img_h .",
						`img_align` = '". $wpdb->escape( $pppm_img_align ) ."',
						`img_url` = '". $wpdb->escape( $pppm_img_url ) ."'
						 WHERE `id` = ". $pppm_res->id );
					  }
					  else {
					  
							$wpdb->insert( $wpdb->prefix .'pppm_shortcut', 
								 array('shortcut' => $pppm_shortcut,
									   'link_text' => $pppm_link_text,  
									   'link_url' => $pppm_link_url,
									   'link_target' => $pppm_link_target,
									   'img_w' => $pppm_img_w,
									   'img_h' => $pppm_img_h,
									   'img_align' => $pppm_img_align,
									   'img_url' => $pppm_img_url ), 
								 array( '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s' ) );
					  }
					  $this->pppm_unsp = false;
					  $this->pppm_note = '<div class="pppm_updated"><p><strong>'. __( 'Options saved' ) .'</strong></p></div>';
					}
						
				}
				  
			}
			else {
				$this->pppm_unsp = true;
				$this->pppm_note = '<div class="pppm_updated"><p><strong>'. __( 'Link\'s or Image\'s  data are not completed' ) .'</strong></p></div>';
			}	
		} 
		else {
			$this->pppm_unsp = true;
			$this->pppm_note = '<div class="pppm_updated"><p><strong>'. __( 'Shortcut is missed' ) .'</strong></p></div>';
		}
	}
	elseif( $_POST[ 'pppm_hidden' ] == 'pppm_form_shortcut_edit' ) {
	
		if( $_POST[ 'delete' ] == 'Delete' && intval( $_POST[ 'pppm_shortcut_filter' ] ) ) {
			$wpdb->query( "DELETE FROM `". $wpdb->prefix ."pppm_shortcut` WHERE `id` = ". intval( $_POST[ 'pppm_shortcut_filter' ] ));
			echo '<div class="updated"><p><strong>'. __( 'Shortcut is deleted' ) .'</strong></p></div>';
		}
	
	}
#############################################################################################
	
		
?>
		
<br />
<table width="100%" border="0" cellspacing="1" class="pppm_option_table">
  <tr>
    <td class="pppm_table_td">
	<div class="pppm_top_desc">
	<?php _e('In section "Phrase Filter" you can manage phrases , which can be replaced in posts , pages and comments .') ?>
	<br />
	<?php _e('In section "Shortcut Filter" you can create shortcuts with colon on beginning and end of text, like this') ?>  <code style="font-size:14px; font-weight:bold; line-height:8px">:wp:</code>, 
	<?php _e(' which will modify to links , images or image links with according data you\'ve set here') ?>
				<br />
				</div>
	</td>
  </tr>
</table> 
<br />
