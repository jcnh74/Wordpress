<?php

	global $wpdb;
	
	#############################################################################################
	if( $_POST[ 'pppm_hidden' ] == 'pppm_bycat' ) {
	
		foreach( $_POST['pppm_bycat_saving'] as $c_id => $c_value ){
			
			update_option( 'pppm_bycat_saving_'.$c_id, intval( $c_value ));
			
		}
		echo '<div class="updated"><p><strong>'. __( 'Options saved.' ) .'</strong></p></div>';
	}
	#############################################################################################
		
?>
<br />
<table width="100%" border="0" cellspacing="1" class="pppm_option_table">
  <tr>
    <td class="pppm_table_td">
	<div class="pppm_top_desc">
		<?php _e('Here you can turn On/Off plugin\'s managers individually for each category . It works hierarchicaly , what means , that the settings of child categories are inherited from parent category.') ?>
	</div>
	</td>
  </tr>
</table> 
<br />