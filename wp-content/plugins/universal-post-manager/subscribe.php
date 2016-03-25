<?php

	global $wpdb;
	#############################################################################################
	if( $_POST[ 'pppm_hidden' ] == 'pppm_email_this' ) {
	
		update_option( 'pppm_email_this_text', $_POST['pppm_email_this_text'] );
		update_option( 'pppm_email_this_img', $_POST['pppm_email_this_img'] );
		update_option( 'pppm_email_link_type', $_POST['pppm_email_link_type'] );
		update_option( 'pppm_email_this_mark', $_POST['pppm_email_this_mark'] );
		update_option( 'upm_email_title', $_POST['upm_email_title'] );
		update_option( 'upm_your_name', $_POST['upm_your_name'] );
		update_option( 'upm_your_email', $_POST['upm_your_email'] );
		update_option( 'upm_friend_name', $_POST['upm_friend_name'] );
		update_option( 'upm_friend_email', $_POST['upm_friend_email'] );
		update_option( 'upm_send', $_POST['upm_send'] );
		update_option( 'upm_wrong_email', $_POST['upm_wrong_email'] );
		update_option( 'upm_all_required', $_POST['upm_all_required'] );
		update_option( 'upm_success_message', $_POST['upm_success_message'] );
		update_option( 'upm_alert_message', $_POST['upm_alert_message'] );
		update_option( 'pppm_email_content', $_POST['pppm_email_content'] );
		update_option( 'pppm_email_screen_type', $_POST['pppm_email_screen_type']);
	
	}
	
	if( $_POST[ 'pppm_hidden' ] == 'pppm_feed' ) {
	
		update_option( 'pppm_rss1', $_POST['pppm_rss1'] );
		update_option( 'pppm_rss_092', $_POST['pppm_rss_092'] );
		update_option( 'pppm_rss2', $_POST['pppm_rss2'] );
		update_option( 'pppm_atom', $_POST['pppm_atom'] );
		
		update_option( 'pppm_rss_icon', $_POST['pppm_rss_icon'] );
		update_option( 'pppm_atom_icon', $_POST['pppm_atom_icon'] );
		
		update_option( 'pppm_rss_icon_custom', $_POST['pppm_rss_icon_custom'] );
		update_option( 'pppm_atom_icon_custom', $_POST['pppm_atom_icon_custom'] );
	
		update_option( 'pppm_subscribe_link_type', $_POST['pppm_subscribe_link_type'] );
	}
	#############################################################################################
?>
<br />
<table width="100%" border="0" cellspacing="1" class="pppm_option_table">
  <tr>
    <td class="pppm_table_td">
	<div class="pppm_top_desc">
		<?php _e('Here you can manage sharing of your posts and pages by E-mail and Subscribing.') ?>
	</div>
	</td>
  </tr>
</table> 
<br />