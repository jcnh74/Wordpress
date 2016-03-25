<?php

	global $wpdb;
	
	global $wp_roles;
	$pppm_roles = $wp_roles->role_names;
	foreach( $pppm_roles as $pppm_key => $pppm_val ) {
		$pppm_role_options[] = 'pppm_html_role_'. $pppm_key;
		$pppm_role_options[] = 'pppm_filter_role_'. $pppm_key;
	}
	
	$pppm_options = array(	
							'pppm_onoff_saving_manager',
							
							'pppm_onoff_saving_txt',
							'pppm_onoff_saving_html',
							'pppm_onoff_saving_doc',
							'pppm_onoff_saving_pdf', //version 1.0.2
							'pppm_onoff_saving_xml', //version 1.0.2
							
							'pppm_saving_position', 
							'pppm_saving_align',
							'pppm_saving_location_postend',
							'pppm_saving_location_custom',
							'pppm_saving_type',
							'pppm_saving_in_post',
							'pppm_saving_in_page',
							
							'pppm_onoff_save_follow',//version 1.0.5b
							'pppm_save_text_align',//version 1.0.5b
							'pppm_onoff_print_manager', //version 1.0.3
							
							'pppm_print_location_postend', //version 1.0.3
							'pppm_print_location_custom', //version 1.0.3
							'pppm_print_type', //version 1.0.3
							'pppm_print_in_post', //version 1.0.3
							'pppm_print_in_page', //version 1.0.3
							'pppm_print_app', //version 1.0.3
							 
							 'pppm_global_jquery_load' //version 1.0.7
							 );
	
	$pppm_options = array_merge ( $pppm_options, $pppm_role_options);
	
	
	if( $_POST[ 'pppm_hidden' ] == 'x' ) {
	
		foreach( $pppm_options as $pppm ) {
		
			( $_POST[ $pppm ] == '' ) ? $pppm_op = 0 : $pppm_op = $_POST[ $pppm ];
			update_option( $pppm, $pppm_op );
		}
				
		?>
		<div class="updated"><p><strong><?php _e( 'Options saved.' ); ?></strong></p></div>
		<?php
		
		
		############################################################################POLL
		update_option('pppm_onoff_poll_manager', $_POST['pppm_onoff_poll_manager']);
		update_option('pppm_poll_bg_url', $_POST['pppm_poll_bg_url']);
		update_option('pppm_poll_bg_color', $_POST['pppm_poll_bg_color']);
		update_option('pppm_poll_bgtype', $_POST['pppm_poll_bgtype']);
		update_option('pppm_poll_height', $_POST['pppm_poll_height']);
		update_option('pppm_poll_voters', $_POST['pppm_poll_voters']);
		update_option('pppm_poll_logging', $_POST['pppm_poll_logging']);
		update_option('pppm_poll_logging_exdatenum', $_POST['pppm_poll_logging_exdatenum']);
		update_option('pppm_poll_logging_exdatetype', $_POST['pppm_poll_logging_exdatetype']);
		update_option('pppm_poll_first_poll', $_POST['pppm_poll_first_poll']);
		update_option('pppm_poll_onoff_next', $_POST['pppm_poll_onoff_next']);
		#################################################################################
	}



	foreach( $pppm_options as $pppm ) {
		
		if( get_option($pppm) ) {
			
			$pppm_checked['checkbox'][ $pppm ][ 'checked' ] = 'checked="checked"';
			$pppm_checked['radio'][ $pppm ][ 'on_check' ] = 'checked="checked"';
			$pppm_checked['radio'][ $pppm ][ 'off_check' ] = '';
		} 
		else {
		
			$pppm_checked['checkbox'][ $pppm ][ 'checked' ] = '';
			$pppm_checked['radio'][ $pppm ][ 'on_check' ] = '';
			$pppm_checked['radio'][ $pppm ][ 'off_check' ] = 'checked="checked"';
		}
	}

?>
<br />
<style type="text/css">
.pppm_option_table {
background-color:#CCCCCC;
}
.pppm_option_th {
background-color:#F9F9F9;
text-align:left;
font-weight:100;
padding:2px;
width:60%;
}
.pppm_option_td {
background-color:#F9F9F9;
text-align:left;
font-weight:100;
padding:2px;
width:40%;
}
.pppm_option_top_th {
background-color:#F0F0F0;
text-align:left;
font-weight:bold;
padding:2px;
width:60%;
}
.pppm_option_top_td {
background-color:#F0F0F0;
text-align:left;
font-weight:bold;
padding:2px;
width:40%;
}
ul li{
padding-left:0px;
font-size:13px;
}
.upm_yes{
	list-style-image:url(<?php echo PPPM_PATH ?>img/1.gif);
}
.upm_no{
	list-style-image:url(<?php echo PPPM_PATH ?>img/0.gif);
}
</style>
    <link rel="stylesheet" href="<?php echo PPPM_PATH ?>bxslider/jquery.bxslider.css" type="text/css" />
    <script src="<?php echo PPPM_PATH ?>bxslider/jquery.min.js"></script>
    <script src="<?php echo PPPM_PATH ?>bxslider/jquery.bxslider.js"></script>
 				

	<form name="form_options" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="pppm_hidden" value="x">
        <table width="100%" border="0">
          <tr>
            <td style="padding:10px; padding-left:0px; vertical-align:top; width:500px;">
                    <div class="slider">
                        <ul class="bxslider">
                          <li><a href="https://wordpress.org/plugins/woocommerce-pdf-print/"><img src="<?php echo PPPM_PATH ?>img/gc/4.png" title="Free Download from Wordpress.org" style="padding:0px 0px 20px 20px;" /></a></li>
                          <li><a href="https://wordpress.org/plugins/wpdiscuz/screenshots/"><img src="<?php echo PPPM_PATH ?>img/gc/5.png" title="Free Download from Wordpress.org" style="padding:0px 0px 20px 20px;" /></a></li>
                          <li><a href="https://wordpress.org/plugins/woodiscuz-woocommerce-comments/screenshots/"><img src="<?php echo PPPM_PATH ?>img/gc/3.png" title="Free Download from Wordpress.org" style="padding:0px 0px 20px 20px;" /></a></li>
                          <li><a href="https://wordpress.org/plugins/advanced-content-pagination/screenshots/"><img src="<?php echo PPPM_PATH ?>img/gc/1.png" title="Free Download from Wordpress.org" style="padding:0px 0px 20px 20px;" /></a></li>
                          <li><a href="https://wordpress.org/plugins/author-and-post-statistic-widgets/"><img src="<?php echo PPPM_PATH ?>img/gc/2.png" title="Free Download from Wordpress.org" style="padding:0px 0px 20px 20px;" /></a></li>
                          
                        </ul>
                    </div>
                    <div style="clear:both"></div>
            </td>
            <td valign="top" style="padding:10px; padding-right:0px;">
            
            <table width="100%" border="0" cellspacing="1" class="widefat">
                <thead>
                <tr>
                <th>&nbsp;Information</th>
                </tr>
                </thead>
                    <tr valign="top">
                        <td style="background:#FFF; text-align:left; font-size:12px;">
                        Important: We've removed Post Sharing, Email to Friend, HTML Manager and Phrase Filter features from UPM plugin, if you'd like to use these features please use the UPM 1.1.2 version.
                        </td>
                    </tr>
                </table><br />

            	<table width="100%" border="0" cellspacing="1" class="widefat">
                    <thead>
                    <tr>
                    <th>&nbsp;Like Universal Post Manager plugin?</th>
                    </tr>
                    </thead>
                        <tr valign="top">
                            <td style="background:#FFF; text-align:left; font-size:12px;">
                            <ul>
                            <li>If you like UPM and want to encourage us to develop and maintain it,why not do any or all of the following:</li>
                            <li>- Link to it so other folks can find out about it.</li>
                            <li>- Give it a good rating on <a href="http://wordpress.org/extend/plugins/universal-post-manager/" target="_blank">WordPress.org.</a></li>
                            <li>- We spend as much of my spare time as possible working on Universal Post Manager and any donation is appreciated. Donations play a crucial role in supporting Free and Open Source Software projects. <div style="width:200px; float:right;">
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="hosted_button_id" value="JHRHCQZ8N2G2W"><input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>
                            </ul>
                            </td>
                        </tr>
                    </table>
                
            </td>
          </tr>
        </table>

		<br />
		<table width="100%" border="0" cellspacing="1" class="widefat">
        <thead>
			<tr valign="top">
				<th colspan="2">
				jQuery Settings for Universal Post Manager
				</th>
			</tr>
         </thead>
			<tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Turn on/off UPM jQuery framework loading' ) ?>
                <br />
                ( If you have aready loaded jQuery framework in you theme you should turn this option off)
				</th>
				<td class="pppm_option_td">
				<input type="radio" id="pppm_global_jquery_load_1" name="pppm_global_jquery_load" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_global_jquery_load' ][ 'on_check' ] ?>/> 
				<label for="pppm_global_jquery_load_1"><?php _e( 'On' ) ?></label> &nbsp;&nbsp; 
				<input type="radio" id="pppm_global_jquery_load_0" name="pppm_global_jquery_load" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_global_jquery_load' ][ 'off_check' ] ?> />
				<label for="pppm_global_jquery_load_0"><?php _e( 'Off' ) ?></label>
				
				</td>
			</tr>
			</table>
		
		<br />
		<table width="100%" border="0" cellspacing="1" class="widefat">
        <thead>
			<tr valign="top">
				<th>
				<strong><?php _e( 'Turn On/Off Saving Manager' ) ?></strong>
				</th>
				<th style="padding-left:0px;">
				<input type="radio" id="pppm_onoff_saving_manager_1" name="pppm_onoff_saving_manager" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_manager' ]['on_check'] ?>/> 
				<label for="pppm_onoff_saving_manager_1"><?php _e( 'On' ) ?></label>&nbsp;
				<input type="radio" id="pppm_onoff_saving_manager_0" name="pppm_onoff_saving_manager" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_manager' ]['off_check'] ?> />
				<label for="pppm_onoff_saving_manager_0"><?php _e( 'Off' ) ?></label>
				</th>
			</tr>
        </thead>
			<tr valign="top">
				<th class="pppm_option_top_th">
				<?php _e( 'Use Saving Manager in ' ) ?>
				</th>
				<td class="pppm_option_td">
				<input type="checkbox" id="pppm_saving_in_post" name="pppm_saving_in_post" value="1" 
				<?php echo $pppm_checked['checkbox'][ 'pppm_saving_in_post' ][ 'checked' ] ?>/> 
				<label for="pppm_saving_in_post"><?php _e( 'Post' ) ?></label> &nbsp;&nbsp; 
				<input type="checkbox" id="pppm_saving_in_page" name="pppm_saving_in_page" value="1" 
				<?php echo $pppm_checked['checkbox'][ 'pppm_saving_in_page' ][ 'checked' ] ?> /> 
				<label for="pppm_saving_in_page"><?php _e( 'Page' ) ?></label>
				</td>
			</tr>
			<tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Turn on/off Saving as Text' ) ?>
				</th>
				<td class="pppm_option_td">
				<input type="radio" id="pppm_onoff_saving_txt_1" name="pppm_onoff_saving_txt" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_txt' ][ 'on_check' ] ?>/> 
				<label for="pppm_onoff_saving_txt_1"><?php _e( 'On' ) ?></label> &nbsp;&nbsp; 
				<input type="radio" id="pppm_onoff_saving_txt_0" name="pppm_onoff_saving_txt" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_txt' ][ 'off_check' ] ?> />
				<label for="pppm_onoff_saving_txt_0"><?php _e( 'Off' ) ?></label>
				</td>
			</tr>
			<tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Turn on/off Saving as HTML' ) ?>
				</th>
				<td class="pppm_option_td">
				<input type="radio" id="pppm_onoff_saving_html_1" name="pppm_onoff_saving_html" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_html' ][ 'on_check' ] ?>/> 
				<label for="pppm_onoff_saving_html_1"><?php _e( 'On' ) ?></label> &nbsp;&nbsp; 
				<input type="radio" id="pppm_onoff_saving_html_0" name="pppm_onoff_saving_html" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_html' ][ 'off_check' ] ?> />
				<label for="pppm_onoff_saving_html_0"><?php _e( 'Off' ) ?></label>
				</td>
			</tr>
			<tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Turn on/off Saving as Word Document' ) ?>
				</th>
				<td class="pppm_option_td">
				<input type="radio" id="pppm_onoff_saving_doc_1" name="pppm_onoff_saving_doc" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_doc' ][ 'on_check' ] ?>/> 
				<label for="pppm_onoff_saving_doc_1"><?php _e( 'On' ) ?></label> &nbsp;&nbsp; 
				<input type="radio" id="pppm_onoff_saving_doc_0" name="pppm_onoff_saving_doc" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_doc' ][ 'off_check' ] ?> />
				<label for="pppm_onoff_saving_doc_0"><?php _e( 'Off' ) ?></label>
				</td>
			</tr>
			<tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Turn on/off Saving as PDF' ) ?>
				</th>
				<td class="pppm_option_td">
				<input type="radio" id="pppm_onoff_saving_pdf_1" name="pppm_onoff_saving_pdf" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_pdf' ][ 'on_check' ] ?>/> 
				<label for="pppm_onoff_saving_pdf_1"><?php _e( 'On' ) ?></label> &nbsp;&nbsp; 
				<input type="radio" id="pppm_onoff_saving_pdf_0" name="pppm_onoff_saving_pdf" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_pdf' ][ 'off_check' ] ?> />
				<label for="pppm_onoff_saving_pdf_0"><?php _e( 'Off' ) ?></label>
				</td>
			</tr>
			<tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Turn on/off Saving as XML' ) ?>
				</th>
				<td class="pppm_option_td">
				<input type="radio" id="pppm_onoff_saving_xml_1" name="pppm_onoff_saving_xml" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_xml' ][ 'on_check' ] ?>/> 
				<label for="pppm_onoff_saving_xml_1"><?php _e( 'On' ) ?></label> &nbsp;&nbsp; 
				<input type="radio" id="pppm_onoff_saving_xml_0" name="pppm_onoff_saving_xml" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_saving_xml' ][ 'off_check' ] ?> />
				<label for="pppm_onoff_saving_xml_0"><?php _e( 'Off' ) ?></label>
				</td>
			</tr>
            
            <tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Allow search engines to get saving documents' ) ?>
				</th>
				<td class="pppm_option_td">
				<input type="radio" id="pppm_onoff_save_follow_1" name="pppm_onoff_save_follow" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_save_follow' ]['on_check'] ?>/> 
				<label for="pppm_onoff_save_follow_1"><?php _e( 'Allow' ) ?></label> &nbsp;&nbsp; 
				<input type="radio" id="pppm_onoff_save_follow_0" name="pppm_onoff_save_follow" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_save_follow' ]['off_check'] ?> />
				<label for="pppm_onoff_save_follow_0"><?php _e( 'Disallow' ) ?></label>
				</td>
			</tr>
            
            <tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Alignment of saving and printing documents' ) ?>
				</th>
				<td class="pppm_option_td">
                <?php 
				$pppm_save_text_align = array( 'left'=>'', 'right'=>'', 'center'=>'', 'justify'=>'');
				switch( get_option( 'pppm_save_text_align' ) ){
					case 'left' : $pppm_save_text_align['left'] = 'selected="selected"' ;break;
					case 'right' : $pppm_save_text_align['right'] = 'selected="selected"' ;break;
					case 'center' : $pppm_save_text_align['center'] = 'selected="selected"' ;break;
					case 'justify' : $pppm_save_text_align['justify'] = 'selected="selected"' ;break;
				}
				?>
				<select name="pppm_save_text_align">
                    <option value="left" <?php echo $pppm_save_text_align['left'] ?>>left &nbsp;</option>
                    <option value="right" <?php echo $pppm_save_text_align['right'] ?>>right &nbsp;</option>
                    <option value="center" <?php echo $pppm_save_text_align['center'] ?>>center &nbsp;</option>
                    <option value="justify" <?php echo $pppm_save_text_align['justify'] ?>>justify &nbsp;</option>
                </select>
				</td>
			</tr>
			
			<tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Appearance type of saving buttons and strings' ) ?>
				</th>
				<td class="pppm_option_td">
				<input type="radio" id="pppm_saving_type_0" name="pppm_saving_type" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_saving_type' ][ 'off_check' ] ?>/> 
				<label for="pppm_saving_type_0"><?php _e( 'String' ) ?></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" id="pppm_saving_type_1" name="pppm_saving_type" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_saving_type' ][ 'on_check' ] ?> /> 
				<label for="pppm_saving_type_1"><?php _e( 'Button' ) ?></label> <br />
				<input type="radio" id="pppm_saving_position_0" name="pppm_saving_position" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_saving_position' ][ 'off_check' ] ?>/> 
				<label for="pppm_saving_position_0"><?php _e( 'Horizontal' ) ?></label> &nbsp; 
				<input type="radio" id="pppm_saving_position_1" name="pppm_saving_position" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_saving_position' ][ 'on_check' ] ?> /> 
				<label for="pppm_saving_position_1"><?php _e( 'Vertical' ) ?></label> <br />
				<input type="radio" id="pppm_saving_align_0" name="pppm_saving_align" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_saving_align' ][ 'off_check' ] ?>/> 
				<label for="pppm_saving_align_0"><?php _e( 'Left' ) ?></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" id="pppm_saving_align_1" name="pppm_saving_align" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_saving_align' ][ 'on_check' ] ?> /> 
				<label for="pppm_saving_align_1"><?php _e( 'Right' ) ?></label>
				</td>
			</tr>
			<tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Location of saving buttons and strings' ) ?>
				</th>
				<td class="pppm_option_td">
				<input id="pppm_saving_location_postend" type="checkbox" name="pppm_saving_location_postend" value="1" 
				<?php echo $pppm_checked['checkbox'][ 'pppm_saving_location_postend' ][ 'checked' ] ?>/> 
				<label for="pppm_saving_location_postend">
				<?php _e( 'At end of posts and pages' ) ?>
				</label> &nbsp; <br />
				<!--
                <input id="pppm_saving_location_custom" type="checkbox" name="pppm_saving_location_custom" value="1" 
				<?php echo $pppm_checked['checkbox'][ 'pppm_saving_location_custom' ][ 'checked' ] ?> /> 
				<label for="pppm_saving_location_custom">
				<?php _e( 'Custom Location. Put this code in template files wherever you want<br>' ) ?> 
				</label>
				<code style="font-size:15px; font-weight:bold">&nbsp; &lt;?php upm_save() ?&gt; </code><br />
				-->
                </td>
			</tr>
		</table>
		<br />
		<table width="100%" border="0" cellspacing="1" class="widefat">
        <thead>
			<tr valign="top">
				<th>
				<strong><?php _e( 'Turn On/Off Print Manager' ) ?></strong>
				</th>
				<th style="padding-left:0px;">
				<input type="radio" id="pppm_onoff_print_manager_1" name="pppm_onoff_print_manager" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_print_manager' ]['on_check'] ?>/> 
				<label for="pppm_onoff_print_manager_1"><?php _e( 'On' ) ?></label>&nbsp;
				<input type="radio" id="pppm_onoff_print_manager_0" name="pppm_onoff_print_manager" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_onoff_print_manager' ]['off_check'] ?> />
				<label for="pppm_onoff_print_manager_0"><?php _e( 'Off' ) ?></label>
				</th>
			</tr>
        </thead>
			<tr valign="top">
				<th class="pppm_option_top_th">
				<?php _e( 'Use Print Manager in ' ) ?>
				<br>
				<span style="color:#777777; font-style:italic; font-weight:100; font-size:12px;">
				(<?php _e( 'Only for Single mode of Appearance' ) ?>)</span>
				</th>
				<td class="pppm_option_td">
				<input type="checkbox" id="pppm_print_in_post" name="pppm_print_in_post" value="1" 
				<?php echo $pppm_checked['checkbox'][ 'pppm_print_in_post' ][ 'checked' ] ?>/> 
				<label for="pppm_print_in_post"><?php _e( 'Post' ) ?></label> &nbsp;&nbsp; 
				<input type="checkbox" id="pppm_print_in_page" name="pppm_print_in_page" value="1" 
				<?php echo $pppm_checked['checkbox'][ 'pppm_print_in_page' ][ 'checked' ] ?> /> 
				<label for="pppm_print_in_page"><?php _e( 'Page' ) ?></label>
				</td>
			</tr>
			<tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Appearance mode of print button and string' ) ?>
				</th>
				<td class="pppm_option_td">
				<input type="radio" id="pppm_print_app_0" name="pppm_print_app" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_print_app' ][ 'off_check' ] ?>/> 
				<label for="pppm_print_app_0"><?php _e( 'Single' ) ?></label>&nbsp;
				
				<input type="radio" id="pppm_print_app_1" name="pppm_print_app" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_print_app' ][ 'on_check' ] ?> /> 
				<label for="pppm_print_app_1"><?php _e( 'With saving buttons or strings' ) ?></label> <br />
				</td>
			</tr>
			<tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Appearance type of print button and string' ) ?>
				</th>
				<td class="pppm_option_td">
				<input type="radio" id="pppm_print_type_0" name="pppm_print_type" value="0" 
				<?php echo $pppm_checked['radio'][ 'pppm_print_type' ][ 'off_check' ] ?>/> 
				<label for="pppm_print_type_0"><?php _e( 'String' ) ?></label> &nbsp;
				<input type="radio" id="pppm_print_type_1" name="pppm_print_type" value="1" 
				<?php echo $pppm_checked['radio'][ 'pppm_print_type' ][ 'on_check' ] ?> /> 
				<label for="pppm_print_type_1"><?php _e( 'Button' ) ?></label> <br />
				</td>
			</tr>
			<tr valign="top">
				<th class="pppm_option_th">
				<?php _e( 'Location of print button and string' ) ?><br />
				<span style="color:#777777; font-style:italic; font-weight:100; font-size:12px;">
				(<?php _e( 'Only for Single mode of Appearance' ) ?>)</span>
				</th>
				<td class="pppm_option_td">
				<input id="pppm_print_location_postend" type="checkbox" name="pppm_print_location_postend" value="1" 
				<?php echo $pppm_checked['checkbox'][ 'pppm_print_location_postend' ][ 'checked' ] ?>/> 
				<label for="pppm_print_location_postend">
				<?php _e( 'At end of posts and pages' ) ?>
				</label> &nbsp; <br />
				<!--
                <input id="pppm_print_location_custom" type="checkbox" name="pppm_print_location_custom" value="1" 
				<?php echo $pppm_checked['checkbox'][ 'pppm_print_location_custom' ][ 'checked' ] ?> /> 
				<label for="pppm_print_location_custom">
				<?php _e( 'Custom Location. Put this code in template files wherever you want<br>' ) ?> 
				</label>
				<code style="font-size:15px; font-weight:bold">&nbsp; &lt;?php upm_print() ?&gt; </code><br />
				-->
                </td>
			</tr>
		</table>
        
		<br />
			<p class="submit" align="right">
			<input type="submit" class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			</p>
		</form>
		</div>
        <script>
$('.bxslider').bxSlider({
  mode: 'fade',
  captions: false,
  auto: true
});
</script>