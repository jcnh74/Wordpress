<?php

	global $wpdb;
	
	#############################################################################################
	if( $_POST[ 'pppm_hidden' ] == 'pppm_print' ) {
	
		update_option( 'pppm_save_print_img_max_width', intval( $_POST[ 'pppm_save_print_img_max_width' ] ));
		update_option( 'pppm_save_print_button_type', intval( $_POST[ 'pppm_save_print_button_type' ] ));
		update_option( 'pppm_save_print_button_url', pppm_filter_strip( $_POST[ 'pppm_save_print_button_url' ] ));
		update_option( 'pppm_save_print_button_text', pppm_filter_strip( $_POST[ 'pppm_save_print_button_text' ] ));
		update_option( 'pppm_save_print_icon_url', pppm_filter_strip( $_POST[ 'pppm_save_print_icon_url' ] ));
		update_option( 'pppm_print_css', pppm_filter_strip( $_POST[ 'pppm_print_css' ] ));
		
		echo '<div class="updated"><p><strong>'. __( 'Options saved.' ) .'</strong></p></div>';
	}
	elseif( $_POST[ 'pppm_hidden' ] == 'pppm_pt' ) {
	
		update_option( 'pppm_pt_head_date', pppm_filter_strip( $_POST[ 'pppm_pt_head_date' ] ));
		update_option( 'pppm_pt_head_site', pppm_filter_strip( $_POST[ 'pppm_pt_head_site' ] ));
		update_option( 'pppm_pt_head_url', pppm_filter_strip( $_POST[ 'pppm_pt_head_url' ] ));
		update_option( 'pppm_pt_title', pppm_filter_strip( $_POST[ 'pppm_pt_title' ] ));
		update_option( 'pppm_pt_image', pppm_filter_strip( $_POST[ 'pppm_pt_image' ] ));
		update_option( 'pppm_pt_excerpt', pppm_filter_strip( $_POST[ 'pppm_pt_excerpt' ] ));
		update_option( 'pppm_pt_date', pppm_filter_strip( $_POST[ 'pppm_pt_date' ] ));
		update_option( 'pppm_pt_md', pppm_filter_strip( $_POST[ 'pppm_pt_md' ] ));
		update_option( 'pppm_pt_links', pppm_filter_strip( $_POST[ 'pppm_pt_links' ] ));
		update_option( 'pppm_pt_header', pppm_filter_strip( $_POST[ 'pppm_pt_header' ] ));
		
		echo '<div class="updated"><p><strong>'. __( 'Options saved.' ) .'</strong></p></div>';
	}
	#############################################################################################
		
?>
		
<br />
<table width="100%" border="0" cellspacing="1" class="pppm_option_table">
  <tr>
    <td class="pppm_table_td">
	<div class="pppm_top_desc">
		<?php _e('Here you can manage printing options of your posts and pages .') ?>
	</div>
	</td>
  </tr>
</table> 
<br />
