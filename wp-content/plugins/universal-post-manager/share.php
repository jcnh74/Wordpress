<?php

	global $wpdb;
				$pppm_bookmark_array = array(1 => 'aim',
											 2 => 'blinklist',
											 3 => 'blogger',
											 4 => 'blogmarks',
											 5 => 'buzz',
											 6 => 'connotea',
											 7 => 'delicious',
											 8 => 'digg',
											 9 => 'diigo',
											 10 => 'facebook',
											 11 => 'fark',
											 12 => 'friendfeed',
											 13 => 'furl',
											 14 => 'google',
											 15 => 'linkedin',
											 16 => 'live',
											 17 => 'livejournal',
											 18 => 'magnolia',
											 19 => 'mixx',
											 20 => 'myspace',
											 21 => 'netvibes',
											 22 => 'netvouz',
											 23 => 'newsvine',
											 24 => 'propeller',
											 25 => 'reddit',
											 26 => 'slashdot',
											 27 => 'stumbleupon',
											 28 => 'technorati',
											 29 => 'twitter',
											 30 => 'yahoo'
											 );
											 
	#############################################################################################
	if( $_POST[ 'pppm_hidden' ] == 'pppm_bookmarks' ) {
	
		update_option( 'pppm_bookmark_link_type', $_POST['pppm_bookmark_link_type'] );
	
		for( $t = 1; $t <= count($pppm_bookmark_array); $t++ ){
			update_option( 'pppm_bookmark_text_'.$t, $_POST['pppm_bookmark_text_'.$t] );
		}
		foreach( $_POST['pppm_on'] as $bm ){
			$pppm_bookmarks .= $bm.',';
		}
		update_option( 'pppm_bookmarks', $pppm_bookmarks );
		update_option( 'pppm_bookmark_icon', $_POST['pppm_bookmark_icon'] );
		
		echo '<div class="updated"><p><strong>'. __( 'Options saved.' ) . '</strong></p></div>';
	}
	#############################################################################################
	if( $_POST[ 'pppm_hidden' ] == 'pppm_bookmarks_slider' ) {
	
		update_option( 'pppm_sb_size', $_POST['pppm_sb_size']);
		update_option( 'pppm_sb_ShowBookmarksNumber', (int)$_POST['pppm_sb_ShowBookmarksNumber']);
		update_option( 'pppm_sb_StartBookmarks', $_POST['pppm_sb_StartBookmarks']);
		update_option( 'pppm_sb_ExcludeBookmarks', $_POST['pppm_sb_ExcludeBookmarks']);
		update_option( 'pppm_sb_BackgroundColor', $_POST['pppm_sb_BackgroundColor']);
		
		echo '<div class="updated"><p><strong>'. __( 'Options saved.' ) . '</strong></p></div>';
	}
	#############################################################################################
?>
<br />
<table width="100%" border="0" cellspacing="1" class="pppm_option_table">
  <tr>
    <td class="pppm_table_td">
	<div class="pppm_top_desc">
		<?php _e('Here you can manage sharing of your posts and pages by Social Bookmarks') ?>
	</div>
	</td>
  </tr>
</table> 
<br />