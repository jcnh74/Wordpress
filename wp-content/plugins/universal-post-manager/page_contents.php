<?php 
global $wpdb ;

switch( $_GET['page'] ) {
	####################################################################################################
	#######  PAGE  #####################################################################################
	####################################################################################################
	case 'html' : 
	{
	
		switch ( $sb ) {
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// SBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'html_teg_ref' : 
			{
				?>
				
				<script type="text/javascript">
				//<![CDATA[
					function sendAjaxRequest(tag)
					{
						$.post("<?php echo get_option('siteurl') ?>/wp-admin/admin-ajax.php", 
						{
						action:"pppm_overview", 
						"cookie": encodeURIComponent(document.cookie),
						"pppm_tag": tag 
						}, 
							function(str){
								var get_string = str;
								get_string=new String(get_string);
								var get_arr=get_string.split("-&pp&-");
								
								if( get_arr[0] ) {
									document.getElementById('tag_desc').innerHTML = get_arr[0];
								} else {
									document.getElementById('tag_desc').innerHTML = '<?php _e( 'There is no description' ) ?>';
								}
								if( get_arr[1] ) {
									document.getElementById('tag_example').innerHTML = get_arr[1];
								} else {
									document.getElementById('tag_example').innerHTML = '<?php _e( 'There is no example' ) ?>';
								}
							}
						);
					}
					//]]>
				</script>
				
				<table width="100%" border="0" cellpadding="2" class="pppm_tag_table" cellspacing="1">
					<tr valign="top" align="left">
						<td scope="row" class="pppm_table_td">
						<form name="pppm_form_tag_ref" >
						<select name="pppm_tag_ref">
						<?php 
						$pppm_res = $wpdb->get_results("SELECT `tag`,`status_post`,`status_page`,`status_comment` FROM `".$wpdb->prefix."pppm_html` ORDER BY `tag` ASC ");
						foreach ( $pppm_res as $res ) 
						{
							if( !$res->status_post || !$res->status_comment || !$res->status_page )
								{echo '<option class="pppm_option_disallow" value="'.$res->tag.'">&lt;'.$res->tag.'&gt;</option>';}
							else
								{echo '<option class="pppm_option_allow" value="'.$res->tag.'">&lt;'.$res->tag.'&gt;</option>';}
						 }
						?>
						</select>&nbsp;&nbsp;
						<input type="button" value="<?php _e( 'Read') ?>" 
						onclick="sendAjaxRequest(pppm_form_tag_ref.pppm_tag_ref.options[pppm_form_tag_ref.pppm_tag_ref.selectedIndex].value)" style="cursor:pointer" name="read" >
						</form>
						</td>
					</tr>
					<tr>
					<td class="pppm_box_desc">
					<div id="tag_desc">
						<?php _e( 'Tag Description' ) ?>
					</div>
					</td>
					</tr>
					<tr>
					<td class="pppm_box_tag_example">
					  <br />
					  <div id="tag_example">
					  	<?php _e( 'Tag Example' ) ?>
					  </div>
					  <br /><br />
					  <a href="http://htmlhelp.com/reference/wilbur/list.html" target="_blank">
					  <?php _e( 'Read more' ) ?> ...
					  </a>
					</td>
					</tr>
				</table>
				
				<?php
				
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// SBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'allowed_protocol' : 
			{
				?>
				<a name="protocol"></a>
				<form id="pppm_form_protocol" name="pppm_form_protocol" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>#protocol">
					<input type="hidden" name="pppm_hidden" 
					value="<?php if( $_GET['pppm_ps'] == 'c' ) { print('pppm_form_comment_protocol'); }
								  elseif( $_GET['pppm_ps'] == 'd' ) { print('pppm_form_page_protocol'); }
								  else { print('pppm_form_post_protocol'); } ?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="1">
				  <tr>
					<td width="33%" class="pppm_box_desc_button">
						<?php
						if($_GET['pppm_ps'] == 'p' || !isset($_GET['pppm_ps']) ) {
							echo '<div class="pppm_link_button_activ">'.__( 'Post').'</div>';
						}
						else {
							echo '<div class="pppm_link_button_inactiv">
							<a href="'.str_replace( '&pppm_ps=p','',str_replace( '&pppm_ps=d','',str_replace('&pppm_ps=c','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])))).'&pppm_ps=p#protocol" class="pppm_tagbox_link">'.__( 'Post').'</div>';
						}
						?>
					</td>
					<td width="33%" class="pppm_box_desc_button">
						<?php
						if($_GET['pppm_ps'] == 'd' ) {
							echo '<div class="pppm_link_button_activ">'.__( 'Page').'</div>';
						}
						else {
							echo '<div class="pppm_link_button_inactiv">
							<a href="'.str_replace( '&pppm_ps=p','',str_replace( '&pppm_ps=d','',str_replace('&pppm_ps=c','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])))).'&pppm_ps=d#protocol" class="pppm_tagbox_link">'.__( 'Page').'</div>';
						}
						?>
					</td>
					<td width="34%" class="pppm_box_desc_button">
					<?php
						if($_GET['pppm_ps'] == 'c') {
							echo '<div class="pppm_link_button_activ">'.__( 'Comment').'</div>';
						}
						else {
							echo '<div class="pppm_link_button_inactiv">
							<a href="'.str_replace( '&pppm_ps=p','',str_replace( '&pppm_ps=d','',str_replace('&pppm_ps=c','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])))).'&pppm_ps=c#protocol" class="pppm_tagbox_link">'.__( 'Comment').'
							</div>';
						}
					?>
					</td>
				  </tr>
				  <tr>
					<td colspan="3" align="left" class="pppm_box_desc">
					<span class="pppm_small_font"><?php _e( 'Check/Uncheck All') ?></span>
					<input type="checkbox" value="<?php _e( 'Check All') ?>" style="cursor:pointer" name="checkall" onclick="checkedAll('pppm_form_protocol');">
					</td>
				  </tr>
				  <tr>
				  <td colspan="3">
				   <table width="100%" class="pppm_tag_table" border="0" cellspacing="1" cellpadding="2">
				    <tr bgcolor="#FFFFFF">
				<?php
				if($_GET['pppm_ps'] == 'c') {
				
					$pppm_res = $wpdb->get_results("SELECT `id`,`protocol`,`status_comment` FROM `".$wpdb->prefix."pppm_protocol` ORDER BY `protocol` ASC ");
					$pppm_i= 0;
					foreach ( $pppm_res as $res ) 
					{
						if($res->status_comment)
						{
							$pppm_protocol_str=$res->protocol;
							$pppm_protocol_checked = '';
						}
						else
						{
							$pppm_protocol_str = '<font color="#FF3E3E">'.$res->protocol.'</font>';
							$pppm_protocol_checked = 'checked="checked"';
						}
						( $res->protocol == 'http' ) ? $pppm_protocol_dis = 'disabled="disabled"' : $pppm_protocol_dis = '';
						if($pppm_i%4 == 0 && $pppm_i > 0) echo '</tr> <tr bgcolor="#FFFFFF">';
						echo '<td class="pppm_protocol_table_td">
						<input type="checkbox" '.$pppm_protocol_dis.' name="pppm_protocol[]" id="'.$res->protocol.'" value="'.$res->protocol.'" '.$pppm_protocol_checked.' />
						<br><label for="'.$res->protocol.'">'.$pppm_protocol_str.'</label>
						</td>'; 
						$pppm_i = $pppm_i+1;
					 }
				
				}
				elseif($_GET['pppm_ps'] == 'd') {
				
					$pppm_res = $wpdb->get_results("SELECT `id`,`protocol`,`status_page` FROM `".$wpdb->prefix."pppm_protocol` ORDER BY `protocol` ASC ");
					$pppm_i= 0;
					foreach ( $pppm_res as $res ) 
					{
						if($res->status_page)
						{
							$pppm_protocol_str = $res->protocol;
							$pppm_protocol_checked = '';
						}
						else
						{
							$pppm_protocol_str = '<font color="#FF3E3E">'.$res->protocol.'</font>';
							$pppm_protocol_checked = 'checked="checked"';
						}
						
						( $res->protocol == 'http' ) ? $pppm_protocol_dis = 'disabled="disabled"' : $pppm_protocol_dis = '';
						if( $pppm_i%4 == 0 && $pppm_i > 0 ) echo '</tr> <tr bgcolor="#FFFFFF">';
						echo '<td class="pppm_protocol_table_td">
						<input type="checkbox" '.$pppm_protocol_dis.' name="pppm_protocol[]" id="'.$res->protocol.'" value="'.$res->protocol.'" '.$pppm_protocol_checked.' />
						<br><label for="'.$res->protocol.'">'.$pppm_protocol_str.'</label>
						</td>'; 
						$pppm_i = $pppm_i+1;
					 }
				
				
				}
				else {
				
					$pppm_res = $wpdb->get_results("SELECT `id`,`protocol`,`status_post` FROM `".$wpdb->prefix."pppm_protocol` ORDER BY `protocol` ASC ");
					$pppm_i= 0;
					foreach ( $pppm_res as $res ) 
					{
						if($res->status_post)
						{
							$pppm_protocol_str=$res->protocol;
							$pppm_protocol_checked = '';
						}
						else
						{
							$pppm_protocol_str = '<font color="#FF3E3E">'.$res->protocol.'</font>';
							$pppm_protocol_checked = 'checked="checked"';
						}
						
						( $res->protocol == 'http' ) ? $pppm_protocol_dis = 'disabled="disabled"' : $pppm_protocol_dis = '';
						if($pppm_i%4 == 0 && $pppm_i > 0) echo '</tr> <tr bgcolor="#FFFFFF">';
						echo '<td class="pppm_protocol_table_td">
						<input type="checkbox" '.$pppm_protocol_dis.' name="pppm_protocol[]" id="'.$res->protocol.'" value="'.$res->protocol.'" '.$pppm_protocol_checked.' />
						<br><label for="'.$res->protocol.'">'.$pppm_protocol_str.'</label>
						</td>'; 
						$pppm_i = $pppm_i+1;
					 }
				
				}
				
				 ?> 
					</tr>
				  </table>
				  
				  </td>
				  </tr>
				  <tr>
					<td  colspan="3"><br style="font-size:5px" />
						<p class="submit" style="padding:1px">
						<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Disable Protocols' ) ?>" />
						</p>
					</td>
				  </tr>
				</table>
				</form>
				<?php
			}break;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// SBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'html_manipulations' : 
			{
				?>
				<a name="html_manipulations"></a>
				<form id="pppm_form_manipulations" name="pppm_form_manipulations" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>#html_manipulations">
					<input type="hidden" name="pppm_hidden" value="pppm_html_manipulations">
				<table width="100%" border="0" cellspacing="0" cellpadding="1">
				  <tr>
					<td width="33%" class="pppm_box_desc_button">
						<table width="100%" border="0" cellspacing="2" cellpadding="2">
                          <tr>
                            <td><label for="pppm_link_to_blank">Change all link targets to new window</label></td>
                            <td style="text-align:center;"><input type="checkbox" id="pppm_link_to_blank" <?php (get_option('pppm_link_to_blank')) ? print('checked="checked"') : print('') ; ?> name="pppm_link_to_blank" value="1"</td>
                          </tr>
                        </table>
					</td>
				  </tr>
				  <tr>
					<td  colspan="3"><br style="font-size:5px" />
						<p class="submit" style="padding:1px">
						<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Save Options' ) ?>" />
						</p>
					</td>
				  </tr>
				</table>
				</form>
				<?php
			}break;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// SBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
		} 
		
		################################################################################################
		////////////////////////////////////////////////////////////////////////////////////////////////
		################################################################################################
		switch( $cb ) {
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'tag_form' : 
			{
				?>
				<script language="javascript">
				checked = false ;
				function checkedAll (form_id) {
					var aa= document.getElementById(form_id);
					if (checked == false) {checked = true;} else{checked = false;}
					for (var i =0; i < aa.elements.length; i++) {aa.elements[i].checked = checked;}
				}
				</script>
				<!-- Script by hscripts.com -->
				<form id="pppm_form_tags" name="pppm_form_tags" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="pppm_hidden" 
					value="<?php if( $_GET['pppm_ts'] == 'c' ) { print('pppm_form_comment_tags'); }
								  elseif( $_GET['pppm_ts'] == 'd' ) { print('pppm_form_page_tags'); }
								  else { print('pppm_form_post_tags'); } ?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="1">
				  <tr>
					<td width="33%" class="pppm_box_desc_button">
						<?php
						if($_GET['pppm_ts'] == 'p' || !isset($_GET['pppm_ts']) ) {
							echo '<div class="pppm_link_button_activ">'.__( 'Post setting').'</div>';
						}
						else {
							echo '<div class="pppm_link_button_inactiv">
							<a href="'.str_replace( '&pppm_ts=p','',str_replace( '&pppm_ts=d','',str_replace('&pppm_ts=c','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])))).'&pppm_ts=p#tag" class="pppm_tagbox_link">'.__( 'Post setting').'</div>';
						}
						?>
					</td>
					<td width="33%" class="pppm_box_desc_button">
					<?php
						if( $_GET['pppm_ts'] == 'd' ) {
							echo '<div class="pppm_link_button_activ">'.__( 'Page setting').'</div>';
						}
						else{
							echo '<div class="pppm_link_button_inactiv">
							<a href="'.str_replace( '&pppm_ts=p','',str_replace( '&pppm_ts=d','',str_replace('&pppm_ts=c','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])))).'&pppm_ts=d#tag" class="pppm_tagbox_link">'.__( 'Page setting').'
							</div>';
						}
					?>
					</td>
					<td width="34%" class="pppm_box_desc_button">
					<?php
						if($_GET['pppm_ts'] == 'c') {
							echo '<div class="pppm_link_button_activ">'.__( 'Comment setting').'</div>';
						}
						else {
							echo '<div class="pppm_link_button_inactiv">
							<a href="'.str_replace( '&pppm_ts=d','',str_replace( '&pppm_ts=p','',str_replace('&pppm_ts=c','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])))).'&pppm_ts=c#tag" class="pppm_tagbox_link">'.__( 'Comment setting').'
							</div>';
						}
					?>
					</td>
				  </tr>
				  <tr>
					<td colspan="3" align="left" class="pppm_box_desc">
					<?php _e( 'Check the tags and make these as disabled ') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					<span class="pppm_small_font"><?php _e( 'Check/Uncheck All') ?></span>
					<input type="checkbox" value="<?php _e( 'Check All') ?>" style="cursor:pointer" name="checkall" onclick="checkedAll('pppm_form_tags');">
					</td>
				  </tr>
				  <tr>
				  <td colspan="3">
				   <table width="100%" class="pppm_tag_table" border="0" cellspacing="1" cellpadding="2">
				    <tr bgcolor="#FFFFFF">
				<?php
				if( $_GET['pppm_ts'] == 'c' ) {
				
					$pppm_res = $wpdb->get_results("SELECT `id`,`tag`,`status_comment` FROM `".$wpdb->prefix."pppm_html` ORDER BY `tag` ASC ");
					$pppm_i= 0;
					foreach ( $pppm_res as $res ) 
					{
						if($res->status_comment)
						{
							$pppm_tag_str='&lt;'.$res->tag.'&gt;';
							$pppm_tag_checked = '';
						}
						else
						{
							$pppm_tag_str = '<font color="#FF3E3E">&lt;'.$res->tag.'&gt;</font>';
							$pppm_tag_checked = 'checked="checked"';
						}
						
						if($pppm_i%6 == 0 && $pppm_i > 0) echo '</tr> <tr bgcolor="#FFFFFF">';
						echo '<td class="pppm_tag_table_td">
						<input type="checkbox" name="pppm_tags[]" id="'.$res->tag.'" value="'.$res->tag.'" '.$pppm_tag_checked.' />
						<br><label for="'.$res->tag.'">'.$pppm_tag_str.'</label>
						</td>'; 
						$pppm_i = $pppm_i+1;
					 }
				
				
				}
				elseif( $_GET['pppm_ts'] == 'd' ) {
				
					$pppm_res = $wpdb->get_results("SELECT `id`,`tag`,`status_page` FROM `".$wpdb->prefix."pppm_html` ORDER BY `tag` ASC ");
					$pppm_i= 0;
					foreach ( $pppm_res as $res ) 
					{
						if($res->status_page)
						{
							$pppm_tag_str='&lt;'.$res->tag.'&gt;';
							$pppm_tag_checked = '';
						}
						else
						{
							$pppm_tag_str = '<font color="#FF3E3E">&lt;'.$res->tag.'&gt;</font>';
							$pppm_tag_checked = 'checked="checked"';
						}
						
						if($pppm_i%6 == 0 && $pppm_i > 0) echo '</tr> <tr bgcolor="#FFFFFF">';
						echo '<td class="pppm_tag_table_td">
						<input type="checkbox" name="pppm_tags[]" id="'.$res->tag.'" value="'.$res->tag.'" '.$pppm_tag_checked.' />
						<br><label for="'.$res->tag.'">'.$pppm_tag_str.'</label>
						</td>'; 
						$pppm_i = $pppm_i+1;
					 }
				}
				else {
				
					$pppm_res = $wpdb->get_results("SELECT `id`,`tag`,`status_post` FROM `".$wpdb->prefix."pppm_html` ORDER BY `tag` ASC ");
					$pppm_i= 0;
					foreach ( $pppm_res as $res ) 
					{
						if($res->status_post)
						{
							$pppm_tag_str='&lt;'.$res->tag.'&gt;';
							$pppm_tag_checked = '';
						}
						else
						{
							$pppm_tag_str = '<font color="#FF3E3E">&lt;'.$res->tag.'&gt;</font>';
							$pppm_tag_checked = 'checked="checked"';
						}
						
						if($pppm_i%6 == 0 && $pppm_i > 0) echo '</tr> <tr bgcolor="#FFFFFF">';
						echo '<td class="pppm_tag_table_td">
						<input type="checkbox" name="pppm_tags[]" id="'.$res->tag.'" value="'.$res->tag.'" '.$pppm_tag_checked.' />
						<br><label for="'.$res->tag.'">'.$pppm_tag_str.'</label>
						</td>'; 
						$pppm_i = $pppm_i+1;
					 }
				
				
				}
				
				 ?> 
					</tr>
				  </table>
				  
				  </td>
				  </tr>
				  <tr>
					<td  colspan="3"><br style="font-size:9px" />
						<p class="submit">
						<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Disable HTML Tags' ) ?>" />
						</p>
					</td>
				  </tr>
				</table>
				</form>
				<?php
				
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
		}
		
	} break ;
	####################################################################################################
	#######  PAGE  #####################################################################################
	####################################################################################################
	case 'filter' : 
	{
	
		switch ( $sb ) {
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// SBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'phf_overview' : 
			{
				?>
				<script type="text/javascript">
				//<![CDATA[
					function PhraseReview(id)
					{
						$.post("<?php echo get_option('siteurl') ?>/wp-admin/admin-ajax.php", 
						{
						action:"pppm_review_phrase", 
						"cookie": encodeURIComponent(document.cookie),
						"pppm_id": id
						}, 
							function(str){
								var get_string = str;
								get_string=new String(get_string);
								var get_arr=get_string.split("-&pp&-");
								
								if( get_arr[0] ) {
									document.getElementById('review_phrase').innerHTML = '<b><?php _e( 'Phrase' ) ?>:</b> '+ get_arr[0];
								} else {
									document.getElementById('review_phrase').innerHTML = '<b><?php _e( 'Phrase' ) ?>:</b> <?php _e( 'There is no phrase' ) ?>';
								}
								if( get_arr[1] ) {
									document.getElementById('review_replace').innerHTML = '<b><?php _e( 'Replace to' ) ?>:</b> '+ get_arr[1];
								} else {
									document.getElementById('review_replace').innerHTML = '<b><?php _e( 'Replace to' ) ?>:</b> <?php _e( 'his phrase for removing' ) ?>T';
								}
							}
						);
					}
					//]]>
				</script>
				<table width="100%" border="0" class="pppm_box_table" cellspacing="1" cellpadding="2">
				  <tr>
					<td class="pppm_box_td">
					<form name="pppm_form_phrase_review" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="pppm_hidden" value="pppm_form_phrase_edit">
					<select id="pppm_phrase_filter" name="pppm_phrase_filter">
					<?php 
					$pppm_res = $wpdb->get_results("SELECT `id`,`phrase` FROM `".$wpdb->prefix."pppm_filter` ORDER BY `phrase` ASC ");
					$pppm_i= 0;
					foreach ( $pppm_res as $res ) 
					{
						if( mb_strlen( $res->phrase, 'utf-8' ) > 25 ) {
							$pppm_phrase_short = mb_substr( pppm_filter_ss( $res->phrase ), 0, 25, 'utf-8');
							$pppm_phrase_short .= '...';
						}
						else {
							$pppm_phrase_short = pppm_filter_ss( $res->phrase );
						}
						echo '<option value="'.$res->id.'" title ="'.pppm_filter_ss($res->phrase).'"> '.$pppm_phrase_short.'</option> ';
					}
					?>
					</select>
					<br />
					<div style="padding:5px; padding-left:0px">
					<input type="button" value="<?php _e( 'Review') ?>" onclick = "PhraseReview(pppm_form_phrase_review.pppm_phrase_filter.options[pppm_form_phrase_review.pppm_phrase_filter.selectedIndex].value)" style="cursor:pointer" name="review" > <input type="submit"  class="button button-primary" value="<?php _e( 'Edit') ?>" name="edit" style="cursor:pointer" > 
					<input type="submit"  class="button button-primary" value="Delete" name="delete" style="cursor:pointer; background-color:#FFFFCC" onClick="a=confirm('Are you sure delete the phrase ?'); if(!a) return(false);" >
					</div>
					</form>
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td"><div id="review_phrase"><b><?php _e( 'Phrase' ) ?>:</b></div></td>
				  </tr>
				  <tr>
					<td class="pppm_box_td"><div id="review_replace"><b><?php _e( 'Replace to' ) ?>:</b></div></td>
				  </tr>
				</table>
				<?php
				
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// SBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'long_phrase_filter' : 
			{
				$pppm_maxlength = get_option( 'pppm_filter_longphrase_maxlength' );
				$pppm_after = get_option( 'pppm_filter_longphrase_after' );
				if( $pppm_after == 'divide' ) {
					$pppm_check_divide = 'checked="checked"';
					$pppm_check_delete = '';
				}
				else {
					$pppm_check_divide = '';
					$pppm_check_delete = 'checked="checked"';
				}
				
				?>
				<form name="pppm_form_long_phrase" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<input type="hidden" name="pppm_hidden" value="pppm_form_long_phrase">
				<table width="100%" border="0" class="pppm_box_table" cellspacing="1" cellpadding="2">
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Phrase Maximum Length ' ) ?> 
					<input type="text" name="pppm_maxlength" size="10" value="<?php echo intval( $pppm_maxlength ) ?>" /></td>
				    </tr>
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'After Max Length' ) ?> <br />
					<div class="pppm_small_font" style="line-height:25px">
					<?php _e( 'Divide by gaps' ) ?>
					<input type="radio" name="pppm_after_maxlen" <?php echo $pppm_check_divide ?> value="divide" />
					&nbsp;&nbsp;
					<?php _e( 'Remove' ) ?>
					<input type="radio" name="pppm_after_maxlen" <?php echo $pppm_check_delete ?> value="delete" />
					</div>
					</td>
				  </tr>
				  <tr>
					<td >
					<p class="submit" style="padding:1px; text-align:right">
					<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options') ?>" />
					</p>
					</td>
				  </tr>
				</table>
				</form>
				<?php
				
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// SBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'shf_overview' : 
			{
				?>
				<script type="text/javascript">
				//<![CDATA[
					function ShortcutReview(id)
					{
						$.post("<?php echo get_option('siteurl') ?>/wp-admin/admin-ajax.php", 
						{
						action:"pppm_review_shortcut", 
						"cookie": encodeURIComponent(document.cookie),
						"pppm_id": id
						}, 
							function(str){
								var get_string = str;
								get_string=new String(get_string);
								var get_arr=get_string.split("-&pp&-");
								
								if( get_arr[0] ) {
									document.getElementById('review_shortcut').innerHTML = '<b><?php _e( 'Shortcut View' ) ?>:</b><br><br> '+ get_arr[0];
								} else {
									document.getElementById('review_shortcut').innerHTML = '<b><?php _e( 'Shortcut View' ) ?>:</b><br><br> <?php _e( 'There is no data' ) ?>';
								}
								if( get_arr[1] ) {
									document.getElementById('code_shortcut').innerHTML = '<b><?php _e( 'Shortcut Code' ) ?>:</b><br><br> '+ get_arr[1];
								} else {
									document.getElementById('code_shortcut').innerHTML = '<b><?php _e( 'Shortcut Code' ) ?>:</b><br><br> <?php _e( 'There is no data' ) ?>';
								}
								
							}
						);
					}
					//]]>
				</script>
				<table width="100%" border="0" class="pppm_box_table" cellspacing="1" cellpadding="2">
				  <tr>
					<td class="pppm_box_td">
					<form name="pppm_form_shortcut_review" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>#shortcut">
					<input type="hidden" name="pppm_hidden" value="pppm_form_shortcut_edit">
					<select id="pppm_shortcut_filter" name="pppm_shortcut_filter">
					<?php 
					$pppm_res = $wpdb->get_results("SELECT `id`,`shortcut` FROM `".$wpdb->prefix."pppm_shortcut` ORDER BY `shortcut` ASC ");
					$pppm_i= 0;
					foreach ( $pppm_res as $res ) 
					{
						if( mb_strlen( $res->shortcut, 'utf-8' ) > 25 ) {
							$pppm_phrase_short = mb_substr( pppm_filter_ss( $res->shortcut ), 0, 30, 'utf-8');
							$pppm_phrase_short .= '...';
						}
						else {
							$pppm_phrase_short = pppm_filter_ss( $res->shortcut );
						}
						echo '<option value="'.$res->id.'" title ="'.pppm_filter_ss($res->shortcut).'"> '.$pppm_phrase_short.'</option> ';
					}
					?>
					</select>
					<br />
					<div style="padding:5px; padding-left:0px">
					<input type="button" value="<?php _e( 'Review') ?>" onclick = "ShortcutReview(pppm_form_shortcut_review.pppm_shortcut_filter.options[pppm_form_shortcut_review.pppm_shortcut_filter.selectedIndex].value)" style="cursor:pointer" name="review" > <input type="submit"  class="button button-primary" value="<?php _e( 'Edit') ?>" name="edit" style="cursor:pointer" > 
					<input type="submit"  class="button button-primary" value="Delete" name="delete" style="cursor:pointer; background-color:#FFFFCC" onClick="a=confirm('Are you sure delete the shortcut ?'); if(!a) return(false);" >
					</div>
					</form>
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td">
					<div id="review_shortcut" style="padding:5px;">
					<b><?php _e( 'Shortcut View' ) ?>:</b><br><br>
					</div>
					<br />
					<div id="code_shortcut" style="padding:5px;">
					<b><?php _e( 'Shortcut Code' ) ?>:</b><br><br>
					</div>
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th">
					<div class="pppm_admin_desc_small" style="line-height:16px">
					<?php _e( 'If sizes of image are more than 200px , here  will be shown with 200px sizes . Image with original sizes you can see in posts , pages and comments.' ) ?>
				   </div>
					</td>
				  </tr>
				</table>
				<?php
				
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// SBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
		}
		################################################################################################
		////////////////////////////////////////////////////////////////////////////////////////////////
		################################################################################################
		switch( $cb ) {
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'phrase_filter' : 
			{
				if( $_POST['pppm_phrase_filter'] ) {
					$pppm_phid = (int) $_POST['pppm_phrase_filter'];
					$pppm_res = $wpdb->get_row( "SELECT `phrase`,`replace` FROM `".$wpdb->prefix."pppm_filter` WHERE `id` = $pppm_phid ", ARRAY_A );
					$pppm_up_phrase = stripslashes( $pppm_res['phrase'] );
					$pppm_up_replace = stripslashes( $pppm_res['replace'] );
				}
				?>
				<form id="pppm_form_phrase_filter" name="pppm_form_phrase_filter" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="pppm_hidden" value="pppm_form_phrase_filter">
					<input type="hidden" name="pppm_up_id" value="<?php if( $pppm_phid ) echo $pppm_phid; ?>" />
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
				  <tr>
					<th class="pppm_box_th" style="width:50%"><?php _e( 'Find' ) ?></th>
					<td class="pppm_box_th" style="width:50%"><?php _e( 'Replace' ) ?></td>
				  </tr>
				  <tr>
					<td class="pppm_box_td">
					<textarea style="width:98%" rows="3" name="pppm_phrase_find" ><?php if( $pppm_phid ) echo $pppm_up_phrase; ?></textarea>
					</td>
					<td class="pppm_box_td">
					<textarea style="width:98%" cols="27" rows="3" name="pppm_phrase_replace" ><?php if( $pppm_phid ) echo $pppm_up_replace; ?></textarea>
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th" colspan="2">
						<p class="submit">
						
						<input type="submit"  class="button button-primary" name="Submit" value="<?php if( $pppm_phid ){_e( 'Update' );}else{ _e( 'Save' );}?>" />
						</p>
						<br />
						<div class="pppm_admin_desc">
						<?php _e( 'Leave the \'Replace\' field empty if you just want to remove the phrase .' ) ?>
						<br />
						<?php _e( 'If replacement is same you can set more than one phrase , separated by commas.' ) ?>
				
				</div>
					</td>
				  </tr>
				</table>
				</form>
				<br />
				<?php
				
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'txt_mod' : 
			{
			
				if( $_POST['pppm_shortcut_filter'] ) {
					$pppm_phid = (int) $_POST['pppm_shortcut_filter'];
					$pppm_res = $wpdb->get_row( "SELECT * FROM `".$wpdb->prefix."pppm_shortcut` WHERE `id` = $pppm_phid ", ARRAY_A );
					$pppm_shortcut = stripslashes( $pppm_res['shortcut'] );
				    $pppm_link_text = stripslashes( $pppm_res['link_text'] );
				    $pppm_link_url = str_replace('http://','',stripslashes( $pppm_res['link_url'] ));
				    $pppm_link_target = stripslashes( $pppm_res['link_target'] );
				    $pppm_img_w = intval( $pppm_res['img_w'] );
				    $pppm_img_h = intval( $pppm_res['img_h'] );
				    $pppm_img_align = stripslashes( $pppm_res['img_align'] );
				    $pppm_img_url = str_replace('http://','',stripslashes( $pppm_res['img_url'] ));
				}
				?><a name="shortcut"></a>
				<form id="pppm_form_txt_mod" name="pppm_form_txt_mod" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>#shortcut">
					<input type="hidden" name="pppm_hidden" value="pppm_txt_mod">
					<input type="hidden" name="pppm_shortcut_up_id" value="<?php if( $pppm_phid ) echo $pppm_phid; ?>" />
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
				  <?php if($this->pppm_note)echo '<tr><td class="pppm_box_td" colspan="2">' .$this->pppm_note. '</td></tr>'; ?>
				  <tr>
					<th class="pppm_box_th" style="width:50%"><?php _e( 'Shortcut' ) ?> ( <font color="#0000FF"><b>:</b>text<b>:</b></font> )</th>
					<td class="pppm_box_th" style="width:50%"><?php _e( 'Replace to link' ) ?></td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" rowspan="3" valign="top">
					<div align="center"><textarea cols="27" style="width:98%" rows="4" name="pppm_shortcut" ><?php 
					if( $this->pppm_unsp ) print($_POST['pppm_shortcut'] );
					?><?php if( $pppm_phid ) echo $pppm_shortcut; ?></textarea></div>
					</td>
					<td class="pppm_box_td">
					<span class="pppm_small_font"> <?php _e( 'Link Text' ) ?>:</span>
					<br />
					<input type="text" size="30" name="pppm_link_text" value="<?php 
					if( $this->pppm_unsp ) print( $_POST['pppm_link_text'] ); ?><?php if( $pppm_phid ) echo $pppm_link_text; ?>" maxlength="255" />
					<br />
					<span class="pppm_small_font"> <?php _e( 'Link URL' ) ?>:</span>
					<br />
					<input type="text" size="30" name="pppm_link_url" value="<?php 
					( $this->pppm_unsp ) ? print( $_POST['pppm_link_url'] ) : print('http://') ;?><?php if( $pppm_phid ) echo $pppm_link_url; ?>" maxlength="255" />
					<br /><?php $pppm_target_select[ $_POST['pppm_link_target'] ] = 'selected="selected"'?>
					<?php $pppm_target_select[ $pppm_link_target ] = 'selected="selected"'?>
					<div class="pppm_small_font" style="padding:10px; padding-left:0px"> <?php _e( 'Open Link in' ) ?>:&nbsp;&nbsp;
					
					<select name="pppm_link_target">
					<option value="_blank" <?php echo $pppm_target_select['_blank']?>>_blank</option>
					<option value="_parent" <?php echo $pppm_target_select['_parent']?>>_parent</option>
					<option value="_self" <?php echo $pppm_target_select['_self']?>>_self</option>
					<option value="_top" <?php echo $pppm_target_select['_top']?>>_top</option>
					</select>
					</div>
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th" style="width:50%"><?php _e( 'Replace to image' ) ?></td>
				  </tr>
				  <tr>
					<td class="pppm_box_td">
					 <div align="right" class="pppm_small_font">
					 <?php _e( 'Width' ) ?> (px) <input type="text" maxlength="4" size="10" value="<?php 
					if( $this->pppm_unsp ) print( intval($_POST['pppm_img_w']) ); ?><?php if( $pppm_phid ) echo $pppm_img_w; ?>" name="pppm_img_w" />
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 <br />
					 <?php _e( 'Height' ) ?> (px) <input type="text" maxlength="4" size="10" value="<?php 
					if( $this->pppm_unsp ) print( intval($_POST['pppm_img_h']) ); ?><?php if( $pppm_phid ) echo $pppm_img_h; ?>" name="pppm_img_h" />
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 <br />
					 <?php $pppm_select[ $_POST['pppm_img_align'] ] = 'selected="selected"'?>
					 <?php $pppm_select[ $pppm_img_align ] = 'selected="selected"'?>
					 Align <select name="pppm_img_align">
					 		<option value="absmiddle" <?php echo $pppm_select['absmiddle']?>>absmiddle</option>
					 		<option value="absbottom" <?php echo $pppm_select['absbottom']?>>absbottom</option>
							<option value="baseline" <?php echo $pppm_select['baseline']?>>baseline</option>
							<option value="bottom" <?php echo $pppm_select['bottom']?>>baseline</option>
							<option value="left" <?php echo $pppm_select['left']?>>left</option>
							<option value="right" <?php echo $pppm_select['right']?>>right</option>
							<option value="texttop" <?php echo $pppm_select['texttop']?>>texttop</option>
							<option value="top" <?php echo $pppm_select['top']?>>top</option>
						   </select>
						   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 </div>
					 <br />
					 <span class="pppm_small_font"> Image URL:</span><br />
					<input type="text" size="30" value="<?php 
					( $this->pppm_unsp ) ? print( $_POST['pppm_img_url'] ) : print('http://') ;?><?php if( $pppm_phid ) echo $pppm_img_url; ?>" name="pppm_img_url" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th" colspan="2">
						<p class="submit">
						<?php ( $pppm_phid ) ? $pppm_button = 'Update Shortcut' : $pppm_button = 'Create Shortcut'; ?>
						<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( $pppm_button ) ?>" />
						</p>
						<br />
						<div class="pppm_admin_desc">
				<ul>
				<li><?php _e( 'For create link shortcut : leave "Replace to image" fields' ) ?> </li>
				<li><?php _e( 'For create image shortcut : leave "Replace to link" fields' ) ?> </li>
				<li><?php _e( 'For create image link shortcut : you should fill both section\'s fields ( in this case "Link Text" becomes title of image )' ) ?></li>
				</ul>
				</div>
					</td>
				  </tr>
				</table>
				</form>
				
				<br />
				<?php
				
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
		}
		
	} break ;
	####################################################################################################
	#######  PAGE  #####################################################################################
	####################################################################################################

	case 'saving' : 
	{
	
		switch( $cb ) {
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'txt_save' : 
			{
				?>
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
				  <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Type of button' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_save_txt_button_type') ) ? 
					$pppm_btype_checked['button'][ 'pppm_save_txt_button_type' ] = 'checked="checked"' : 
					$pppm_btype_checked['icon'][ 'pppm_save_txt_button_type' ] = 'checked="checked"';
					?>
					<label for="pppm_save_txt_button"><?php _e( 'Button' ) ?> </label>
					<input type="radio" id="pppm_save_txt_button" 
					<?php echo $pppm_btype_checked['button'][ 'pppm_save_txt_button_type' ] ?> 
					name="pppm_save_txt_button_type" value="1" /> &nbsp;&nbsp;
					<label for="pppm_save_txt_icon"><?php _e( 'Icon' ) ?> </label>
					<input type="radio" id="pppm_save_txt_icon" 
					<?php echo $pppm_btype_checked['icon'][ 'pppm_save_txt_button_type' ] ?> 
					name="pppm_save_txt_button_type" value="0" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'Button image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_txt_button_url" value="<?php echo get_option('pppm_save_txt_button_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo PPPM_PATH .'img/'.get_option('pppm_save_txt_button_url') ?>" align="absmiddle" /><br /><br />
					
					<table width="100%" border="0" style="padding-top:10px;empty-cells: hide; border-collapse:collapse;" cellspacing="0">
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_txt.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_txt.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; 
						width:33%;padding:3px;font-size:11px">
						&nbsp;save_as_txt_101.gif<br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_txt_101.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4;width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_txt_102.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_txt_102.gif' ?>" align="absmiddle" />
						</td>
					  </tr>
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_txt_103.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_txt_103.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;save_as_txt_103_red.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_txt_103_red.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_txt_103_green.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_txt_103_green.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;save_as_txt_103_blue.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_txt_103_blue.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px; background:#FFFFFF">
						&nbsp;upm-save-as-txt-1.2.0-small.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-save-as-txt-1.2.0-small.png' ?>" align="absmiddle" style="padding-top:5px;" />
						<hr size="1" noshade="noshade" />
						&nbsp;upm-save-as-txt-1.2.0.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-save-as-txt-1.2.0.png' ?>" align="absmiddle" style="padding-top:5px; padding-bottom:5px;" />
						</td>
					  </tr>
					</table>

					
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'Icon image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_txt_icon_url" value="<?php echo get_option('pppm_save_txt_icon_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo PPPM_PATH .'img/'.get_option('pppm_save_txt_icon_url') ?>" align="absmiddle" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'String text' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_txt_button_text" value="<?php echo get_option('pppm_save_txt_button_text') ?>" size="40" maxlength="255" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th" colspan="2">
					<p class="submit">
					<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
					</p>
					</td>
				  </tr>
				</table>
				<?php
				
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'html_save' : 
			{
				?>
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
				  
				  <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Post Title' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_html_t_title') ) ? 
					$pppm_html_t_title_checked['button'][ 'pppm_html_t_title' ] = 'checked="checked"' : 
					$pppm_html_t_title_checked['icon'][ 'pppm_html_t_title' ] = 'checked="checked"';
					?>
					<label for="pppm_html_t_title_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_html_t_title_1" 
					<?php echo $pppm_html_t_title_checked['button'][ 'pppm_html_t_title' ] ?> 
					name="pppm_html_t_title" value="1" /> &nbsp;&nbsp;
					<label for="pppm_html_t_title_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_html_t_title_0" 
					<?php echo $pppm_html_t_title_checked['icon'][ 'pppm_html_t_title' ] ?> 
					name="pppm_html_t_title" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post images' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_html_t_image') ) ? 
					$pppm_html_t_image_checked['button'][ 'pppm_html_t_image' ] = 'checked="checked"' : 
					$pppm_html_t_image_checked['icon'][ 'pppm_html_t_image' ] = 'checked="checked"';
					?>
					<label for="pppm_html_t_image_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_html_t_image_1" 
					<?php echo $pppm_html_t_image_checked['button'][ 'pppm_html_t_image' ] ?> 
					name="pppm_html_t_image" value="1" /> &nbsp;&nbsp;
					<label for="pppm_html_t_image_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_html_t_image_0" 
					<?php echo $pppm_html_t_image_checked['icon'][ 'pppm_html_t_image' ] ?> 
					name="pppm_html_t_image" value="0" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Maximum image width in HTML document (px)' ) ?>
					</td>
					<td class="pppm_box_th">
                    <?php if( get_option('pppm_save_html_img_max_width') ){ $upmiw = get_option('pppm_save_html_img_max_width'); } else{ $upmiw = 500; } ?>
                    <input type="text" name="pppm_save_html_img_max_width" value="<?php echo $upmiw; ?>" style="width:60px" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post excerpt' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_html_t_excerpt') ) ? 
					$pppm_html_t_excerpt_checked['button'][ 'pppm_html_t_excerpt' ] = 'checked="checked"' : 
					$pppm_html_t_excerpt_checked['icon'][ 'pppm_html_t_excerpt' ] = 'checked="checked"';
					?>
					<label for="pppm_html_t_excerpt_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_html_t_excerpt_1" 
					<?php echo $pppm_html_t_excerpt_checked['button'][ 'pppm_html_t_excerpt' ] ?> 
					name="pppm_html_t_excerpt" value="1" /> &nbsp;&nbsp;
					<label for="pppm_html_t_excerpt_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_html_t_excerpt_0" 
					<?php echo $pppm_html_t_excerpt_checked['icon'][ 'pppm_html_t_excerpt' ] ?> 
					name="pppm_html_t_excerpt" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post date' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_html_t_date') ) ? 
					$pppm_html_t_date_checked['button'][ 'pppm_html_t_date' ] = 'checked="checked"' : 
					$pppm_html_t_date_checked['icon'][ 'pppm_html_t_date' ] = 'checked="checked"';
					?>
					<label for="pppm_html_t_date_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_html_t_date_1" 
					<?php echo $pppm_html_t_date_checked['button'][ 'pppm_html_t_date' ] ?> 
					name="pppm_html_t_date" value="1" /> &nbsp;&nbsp;
					<label for="pppm_html_t_date_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_html_t_date_0" 
					<?php echo $pppm_html_t_date_checked['icon'][ 'pppm_html_t_date' ] ?> 
					name="pppm_html_t_date" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post modified date' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_html_t_md') ) ? 
					$pppm_html_t_md_checked['button'][ 'pppm_html_t_md' ] = 'checked="checked"' : 
					$pppm_html_t_md_checked['icon'][ 'pppm_html_t_md' ] = 'checked="checked"';
					?>
					<label for="pppm_html_t_md_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_html_t_md_1" 
					<?php echo $pppm_html_t_md_checked['button'][ 'pppm_html_t_md' ] ?> 
					name="pppm_html_t_md" value="1" /> &nbsp;&nbsp;
					<label for="pppm_html_t_md_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_html_t_md_0" 
					<?php echo $pppm_html_t_md_checked['icon'][ 'pppm_html_t_md' ] ?> 
					name="pppm_html_t_md" value="0" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th" colspan="2">&nbsp;
					
					</td>
				  </tr>

				  <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Type of button' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_save_html_button_type') ) ? 
					$pppm_btype_checked['button'][ 'pppm_save_html_button_type' ] = 'checked="checked"' : 
					$pppm_btype_checked['icon'][ 'pppm_save_html_button_type' ] = 'checked="checked"';
					?>
					<label for="pppm_save_html_button"><?php _e( 'Button' ) ?> </label>
					<input type="radio" id="pppm_save_html_button" 
					<?php echo $pppm_btype_checked['button'][ 'pppm_save_html_button_type' ] ?> 
					name="pppm_save_html_button_type" value="1" /> &nbsp;&nbsp;
					<label for="pppm_save_html_icon"><?php _e( 'Icon' ) ?> </label>
					<input type="radio" id="pppm_save_html_icon" 
					<?php echo $pppm_btype_checked['icon'][ 'pppm_save_html_button_type' ] ?> 
					name="pppm_save_html_button_type" value="0" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'Button image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_html_button_url" value="<?php echo get_option('pppm_save_html_button_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo PPPM_PATH .'img/'.get_option('pppm_save_html_button_url') ?>" align="absmiddle" /><br /><br />
					
					<table width="100%" border="0" style="padding-top:10px;empty-cells: hide; border-collapse:collapse;" cellspacing="0">
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_html.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_html.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; 
						width:33%;padding:3px;font-size:11px">
						&nbsp;save_as_html_101.gif<br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_html_101.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4;width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_html_102.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_html_102.gif' ?>" align="absmiddle" />
						</td>
					  </tr>
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_html_103.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_html_103.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;save_as_html_103_red.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_html_103_red.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_html_103_green.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_html_103_green.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;save_as_html_103_blue.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_html_103_blue.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px; background:#FFFFFF">
						&nbsp;upm-save-as-html-1.2.0-small.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-save-as-html-1.2.0-small.png' ?>" align="absmiddle" style="padding-top:5px;" />
						<hr size="1" noshade="noshade" />
						&nbsp;upm-save-as-html-1.2.0.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-save-as-html-1.2.0.png' ?>" align="absmiddle" style="padding-top:5px; padding-bottom:5px;" />
						</td>
					  </tr>
					</table>
					
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'Icon image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_html_icon_url" value="<?php echo get_option('pppm_save_html_icon_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo PPPM_PATH .'img/'.get_option('pppm_save_html_icon_url') ?>" align="absmiddle" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'String text' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_html_button_text" value="<?php echo get_option('pppm_save_html_button_text') ?>" size="40" maxlength="255" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'CSS Code' ) ?><br />
					<span style="color:#777777; font-style:italic">(<?php _e( 'This style code is used in saving document\'s template.' ) ?>)</span>
					</td>
					<td class="pppm_box_th">
					<textarea cols="60" rows="4" name="pppm_save_html_css"><?php echo get_option('pppm_save_html_css') ?></textarea>
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th" colspan="2">
					<p class="submit">
					<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
					</p>
					</td>
				  </tr>
				</table>
				<?php
				
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'doc_save' : 
			{
				?>
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
				<tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Post Title' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_doc_t_title') ) ? 
					$pppm_doc_t_title_checked['button'][ 'pppm_doc_t_title' ] = 'checked="checked"' : 
					$pppm_doc_t_title_checked['icon'][ 'pppm_doc_t_title' ] = 'checked="checked"';
					?>
					<label for="pppm_doc_t_title_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_doc_t_title_1" 
					<?php echo $pppm_doc_t_title_checked['button'][ 'pppm_doc_t_title' ] ?> 
					name="pppm_doc_t_title" value="1" /> &nbsp;&nbsp;
					<label for="pppm_doc_t_title_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_doc_t_title_0" 
					<?php echo $pppm_doc_t_title_checked['icon'][ 'pppm_doc_t_title' ] ?> 
					name="pppm_doc_t_title" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post images' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_doc_t_image') ) ? 
					$pppm_doc_t_image_checked['button'][ 'pppm_doc_t_image' ] = 'checked="checked"' : 
					$pppm_doc_t_image_checked['icon'][ 'pppm_doc_t_image' ] = 'checked="checked"';
					?>
					<label for="pppm_doc_t_image_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_doc_t_image_1" 
					<?php echo $pppm_doc_t_image_checked['button'][ 'pppm_doc_t_image' ] ?> 
					name="pppm_doc_t_image" value="1" /> &nbsp;&nbsp;
					<label for="pppm_doc_t_image_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_doc_t_image_0" 
					<?php echo $pppm_doc_t_image_checked['icon'][ 'pppm_doc_t_image' ] ?> 
					name="pppm_doc_t_image" value="0" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Maximum image width in DOC document (px)' ) ?>
					</td>
					<td class="pppm_box_th">
                    <?php if( get_option('pppm_save_doc_img_max_width') ){ $upmiw = get_option('pppm_save_doc_img_max_width'); } else{ $upmiw = 500; } ?>
                    <input type="text" name="pppm_save_doc_img_max_width" value="<?php echo $upmiw; ?>" style="width:60px" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post excerpt' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_doc_t_excerpt') ) ? 
					$pppm_doc_t_excerpt_checked['button'][ 'pppm_doc_t_excerpt' ] = 'checked="checked"' : 
					$pppm_doc_t_excerpt_checked['icon'][ 'pppm_doc_t_excerpt' ] = 'checked="checked"';
					?>
					<label for="pppm_doc_t_excerpt_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_doc_t_excerpt_1" 
					<?php echo $pppm_doc_t_excerpt_checked['button'][ 'pppm_doc_t_excerpt' ] ?> 
					name="pppm_doc_t_excerpt" value="1" /> &nbsp;&nbsp;
					<label for="pppm_doc_t_excerpt_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_doc_t_excerpt_0" 
					<?php echo $pppm_doc_t_excerpt_checked['icon'][ 'pppm_doc_t_excerpt' ] ?> 
					name="pppm_doc_t_excerpt" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post date' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_doc_t_date') ) ? 
					$pppm_doc_t_date_checked['button'][ 'pppm_doc_t_date' ] = 'checked="checked"' : 
					$pppm_doc_t_date_checked['icon'][ 'pppm_doc_t_date' ] = 'checked="checked"';
					?>
					<label for="pppm_doc_t_date_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_doc_t_date_1" 
					<?php echo $pppm_doc_t_date_checked['button'][ 'pppm_doc_t_date' ] ?> 
					name="pppm_doc_t_date" value="1" /> &nbsp;&nbsp;
					<label for="pppm_doc_t_date_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_doc_t_date_0" 
					<?php echo $pppm_doc_t_date_checked['icon'][ 'pppm_doc_t_date' ] ?> 
					name="pppm_doc_t_date" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post modified date' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_doc_t_md') ) ? 
					$pppm_doc_t_md_checked['button'][ 'pppm_doc_t_md' ] = 'checked="checked"' : 
					$pppm_doc_t_md_checked['icon'][ 'pppm_doc_t_md' ] = 'checked="checked"';
					?>
					<label for="pppm_doc_t_md_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_doc_t_md_1" 
					<?php echo $pppm_doc_t_md_checked['button'][ 'pppm_doc_t_md' ] ?> 
					name="pppm_doc_t_md" value="1" /> &nbsp;&nbsp;
					<label for="pppm_doc_t_md_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_doc_t_md_0" 
					<?php echo $pppm_doc_t_md_checked['icon'][ 'pppm_doc_t_md' ] ?> 
					name="pppm_doc_t_md" value="0" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th" colspan="2">&nbsp;
					
					</td>
				  </tr>
				 <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Template type' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_save_doc_template') ) ? 
					$pppm_btype_checked['ms'][ 'pppm_save_doc_template' ] = 'checked="checked"' : 
					$pppm_btype_checked['oo'][ 'pppm_save_doc_template' ] = 'checked="checked"';
					?>
					<label for="pppm_save_doc_ms"><?php _e( 'MicrosoftOffice' ) ?> </label>
					<input type="radio" id="pppm_save_doc_ms" 
					<?php echo $pppm_btype_checked['ms'][ 'pppm_save_doc_template' ] ?> 
					name="pppm_save_doc_template" value="1" /> &nbsp;&nbsp;
					<label for="pppm_save_doc_oo"><?php _e( 'OpenOffice' ) ?> </label>
					<input type="radio" id="pppm_save_doc_oo" 
					<?php echo $pppm_btype_checked['oo'][ 'pppm_save_doc_template' ] ?> 
					name="pppm_save_doc_template" value="0" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Type of button' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_save_doc_button_type') ) ? 
					$pppm_btype_checked['button'][ 'pppm_save_doc_button_type' ] = 'checked="checked"' : 
					$pppm_btype_checked['icon'][ 'pppm_save_doc_button_type' ] = 'checked="checked"';
					?>
					<label for="pppm_save_doc_button"><?php _e( 'Button' ) ?> </label>
					<input type="radio" id="pppm_save_doc_button" 
					<?php echo $pppm_btype_checked['button'][ 'pppm_save_doc_button_type' ] ?> 
					name="pppm_save_doc_button_type" value="1" /> &nbsp;&nbsp;
					<label for="pppm_save_doc_icon"><?php _e( 'Icon' ) ?> </label>
					<input type="radio" id="pppm_save_doc_icon" 
					<?php echo $pppm_btype_checked['icon'][ 'pppm_save_doc_button_type' ] ?> 
					name="pppm_save_doc_button_type" value="0" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Button image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_doc_button_url" value="<?php echo get_option('pppm_save_doc_button_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo PPPM_PATH .'img/'.get_option('pppm_save_doc_button_url') ?>" align="absmiddle" /><br /><br />
					<table width="100%" border="0" style="padding-top:10px;empty-cells: hide; border-collapse:collapse;" cellspacing="0">
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_doc.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_doc.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; 
						width:33%;padding:3px;font-size:11px">
						&nbsp;save_as_doc_101.gif<br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_doc_101.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4;width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_doc_102.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_doc_102.gif' ?>" align="absmiddle" />
						</td>
					  </tr>
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_doc_103.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_doc_103.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;save_as_doc_103_red.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_doc_103_red.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_doc_103_green.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_doc_103_green.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;save_as_doc_103_blue.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_doc_103_blue.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px; background:#FFFFFF">
						&nbsp;upm-save-as-doc-1.2.0-small.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-save-as-doc-1.2.0-small.png' ?>" align="absmiddle" style="padding-top:5px;" />
						<hr size="1" noshade="noshade" />
						&nbsp;upm-save-as-doc-1.2.0.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-save-as-doc-1.2.0.png' ?>" align="absmiddle" style="padding-top:5px; padding-bottom:5px;" />
						</td>
					  </tr>
					</table>
					
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'Icon image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_doc_icon_url" value="<?php echo get_option('pppm_save_doc_icon_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo  PPPM_PATH .'img/'.get_option('pppm_save_doc_icon_url') ?>" align="absmiddle" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'String text' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_doc_button_text" size="40" maxlength="255" value="<?php echo get_option('pppm_save_doc_button_text') ?>" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'CSS Code' ) ?><br />
					<span style="color:#777777; font-style:italic">(<?php _e( 'This style code is used in saving document\'s template.' ) ?>)</span>
					</td>
					<td class="pppm_box_th">
					<textarea cols="60" rows="4" name="pppm_save_doc_css"><?php echo get_option('pppm_save_doc_css') ?></textarea>
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th" colspan="2">
					<p class="submit">
					<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
					</p>
					</td>
				  </tr>
				</table>
				</form>
				<?php
				
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'pdf_save' : 
			{
				?>
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
                 <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Images in PDF document' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_save_pdf_img_show') ) ? 
					$pppm_btype_checked['show'][ 'pppm_save_pdf_img_show' ] = 'checked="checked"' : 
					$pppm_btype_checked['hide'][ 'pppm_save_pdf_img_show' ] = 'checked="checked"';
					?>
					<label for="pppm_save_pdf_img_ss"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_save_pdf_img_ss" 
					<?php echo $pppm_btype_checked['show'][ 'pppm_save_pdf_img_show' ] ?> 
					name="pppm_save_pdf_img_show" value="1" /> &nbsp;&nbsp;
					<label for="pppm_save_pdf_img_hh"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_save_pdf_img_hh" 
					<?php echo $pppm_btype_checked['hide'][ 'pppm_save_pdf_img_show' ] ?> 
					name="pppm_save_pdf_img_show" value="0" />
					</td>
				  </tr>
                  <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Maximum image width in PDF document (px)' ) ?>
					</td>
					<td class="pppm_box_th">
                    <?php if( get_option('pppm_save_pdf_img_max_width') ){ $upmiw = get_option('pppm_save_pdf_img_max_width'); } else{ $upmiw = 500; } ?>
                    <input type="text" name="pppm_save_pdf_img_max_width" value="<?php echo $upmiw; ?>" style="width:60px" />
					</td>
				  </tr>
                  <tr>
					<td class="pppm_box_td" style="width:40%;">
					<?php _e( 'Extension for Documents in Russian Language' ) ?><br />
                    <span style="color: rgb(119, 119, 119); font-style: italic;">
                    (If your blog is Russian you should turn on this extension.<br />Если ваш блог на Русском языке, вы должны включить это расширение.)</span>
					</td>
					<td class="pppm_box_th" style="vertical-align:top;">
					<?php 
					( get_option('pppm_save_pdf_rus') ) ? 
					$pppm_btype_checked['show'][ 'pppm_save_pdf_rus' ] = 'checked="checked"' : 
					$pppm_btype_checked['hide'][ 'pppm_save_pdf_rus' ] = 'checked="checked"';
					?>
					<label for="pppm_save_pdf_rus_on"><?php _e( 'Turn On' ) ?> </label>
					<input type="radio" id="pppm_save_pdf_rus_on" 
					<?php echo $pppm_btype_checked['show'][ 'pppm_save_pdf_rus' ] ?> 
					name="pppm_save_pdf_rus" value="1" /> &nbsp;&nbsp;
					<label for="pppm_save_pdf_rus_off"><?php _e( 'Turn Off' ) ?> </label>
					<input type="radio" id="pppm_save_pdf_rus_off" 
					<?php echo $pppm_btype_checked['hide'][ 'pppm_save_pdf_rus' ] ?> 
					name="pppm_save_pdf_rus" value="0" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Type of button' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_save_pdf_button_type') ) ? 
					$pppm_btype_checked['button'][ 'pppm_save_pdf_button_type' ] = 'checked="checked"' : 
					$pppm_btype_checked['icon'][ 'pppm_save_pdf_button_type' ] = 'checked="checked"';
					?>
					<label for="pppm_save_pdf_button"><?php _e( 'Button' ) ?> </label>
					<input type="radio" id="pppm_save_pdf_button" 
					<?php echo $pppm_btype_checked['button'][ 'pppm_save_pdf_button_type' ] ?> 
					name="pppm_save_pdf_button_type" value="1" /> &nbsp;&nbsp;
					<label for="pppm_save_pdf_icon"><?php _e( 'Icon' ) ?> </label>
					<input type="radio" id="pppm_save_pdf_icon" 
					<?php echo $pppm_btype_checked['icon'][ 'pppm_save_pdf_button_type' ] ?> 
					name="pppm_save_pdf_button_type" value="0" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Button image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_pdf_button_url" value="<?php echo get_option('pppm_save_pdf_button_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo PPPM_PATH .'img/'.get_option('pppm_save_pdf_button_url') ?>" align="absmiddle" /><br /><br />
					<table width="100%" border="0" style="padding-top:10px;empty-cells: hide; border-collapse:collapse;" cellspacing="0">
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_pdf.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_pdf.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; 
						width:33%;padding:3px;font-size:11px">
						&nbsp;save_as_pdf_101.gif<br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_pdf_101.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4;width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_pdf_102.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_pdf_102.gif' ?>" align="absmiddle" />
						</td>
					  </tr>
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_pdf_103.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_pdf_103.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;save_as_pdf_103_red.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_pdf_103_red.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_pdf_103_green.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_pdf_103_green.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;save_as_pdf_103_blue.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_pdf_103_blue.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px; background:#FFFFFF">
						&nbsp;upm-save-as-pdf-1.2.0-small.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-save-as-pdf-1.2.0-small.png' ?>" align="absmiddle" style="padding-top:5px;" />
						<hr size="1" noshade="noshade" />
						&nbsp;upm-save-as-pdf-1.2.0.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-save-as-pdf-1.2.0.png' ?>" align="absmiddle" style="padding-top:5px; padding-bottom:5px;" />
						</td>
					  </tr>
					</table>
					
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'Icon image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_pdf_icon_url" value="<?php echo get_option('pppm_save_pdf_icon_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo  PPPM_PATH .'img/'.get_option('pppm_save_pdf_icon_url') ?>" align="absmiddle" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'String text' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_pdf_button_text" size="40" maxlength="255" value="<?php echo get_option('pppm_save_pdf_button_text') ?>" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th" colspan="2">
					<p class="submit">
					<input type="submit"  class="button button-primary"  name="Submit" value="<?php _e( 'Update Options' ) ?>" />
					</p>
					</td>
				  </tr>
				</table>
				</form>
				<?php
				
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'xml_save' : 
			{
				?>
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
				  <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Type of button' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_save_xml_button_type') ) ? 
					$pppm_btype_checked['button'][ 'pppm_save_xml_button_type' ] = 'checked="checked"' : 
					$pppm_btype_checked['icon'][ 'pppm_save_xml_button_type' ] = 'checked="checked"';
					?>
					<label for="pppm_save_xml_button"><?php _e( 'Button' ) ?> </label>
					<input type="radio" id="pppm_save_xml_button" 
					<?php echo $pppm_btype_checked['button'][ 'pppm_save_xml_button_type' ] ?> 
					name="pppm_save_xml_button_type" value="1" /> &nbsp;&nbsp;
					<label for="pppm_save_xml_icon"><?php _e( 'Icon' ) ?> </label>
					<input type="radio" id="pppm_save_xml_icon" 
					<?php echo $pppm_btype_checked['icon'][ 'pppm_save_xml_button_type' ] ?> 
					name="pppm_save_xml_button_type" value="0" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Button image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_xml_button_url" value="<?php echo get_option('pppm_save_xml_button_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo PPPM_PATH .'img/'.get_option('pppm_save_xml_button_url') ?>" align="absmiddle" /><br /><br />
					<table width="100%" border="0" style="padding-top:10px;empty-cells: hide; border-collapse:collapse;" cellspacing="0">
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_xml.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_xml.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; 
						width:33%;padding:3px;font-size:11px">
						&nbsp;save_as_xml_101.gif<br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_xml_101.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4;width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_xml_102.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_xml_102.gif' ?>" align="absmiddle" />
						</td>
					  </tr>
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_xml_103.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_xml_103.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;save_as_xml_103_red.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_xml_103_red.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;save_as_xml_103_green.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_xml_103_green.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;save_as_xml_103_blue.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/save_as_xml_103_blue.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px; background:#FFFFFF">
						&nbsp;upm-save-as-xml-1.2.0-small.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-save-as-xml-1.2.0-small.png' ?>" align="absmiddle" style="padding-top:5px;" />
						<hr size="1" noshade="noshade" />
						&nbsp;upm-save-as-xml-1.2.0.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-save-as-xml-1.2.0.png' ?>" align="absmiddle" style="padding-top:5px; padding-bottom:5px;" />
						</td>
					  </tr>
					</table>
					
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'Icon image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_xml_icon_url" value="<?php echo get_option('pppm_save_xml_icon_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo  PPPM_PATH .'img/'.get_option('pppm_save_xml_icon_url') ?>" align="absmiddle" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'String text' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_xml_button_text" size="40" maxlength="255" value="<?php echo get_option('pppm_save_xml_button_text') ?>" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th" colspan="2">
					<p class="submit">
					<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
					</p>
					</td>
				  </tr>
				</table>
				</form>
				<?php
				
			} break ;
		
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
		}
		
	} break ;
	####################################################################################################
	#######  PAGE  #####################################################################################
	####################################################################################################
	case 'print' : 
	{
	
		switch ( $cb ) {
		
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'print_img' : 
			{
				?>
				<form id="pppm_form_saving" name="pppm_form_print" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="pppm_hidden" value="pppm_print">
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
				  <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Type of button' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_save_print_button_type') ) ? 
					$pppm_btype_checked['button'][ 'pppm_save_print_button_type' ] = 'checked="checked"' : 
					$pppm_btype_checked['icon'][ 'pppm_save_print_button_type' ] = 'checked="checked"';
					?>
					<label for="pppm_save_print_button"><?php _e( 'Button' ) ?> </label>
					<input type="radio" id="pppm_save_print_button" 
					<?php echo $pppm_btype_checked['button'][ 'pppm_save_print_button_type' ] ?> 
					name="pppm_save_print_button_type" value="1" /> &nbsp;&nbsp;
					<label for="pppm_save_print_icon"><?php _e( 'Icon' ) ?> </label>
					<input type="radio" id="pppm_save_print_icon" 
					<?php echo $pppm_btype_checked['icon'][ 'pppm_save_print_button_type' ] ?> 
					name="pppm_save_print_button_type" value="0" />
					</td>
				  </tr>
                  <tr>
					<td class="pppm_box_td" style="width:40%">
					<?php _e( 'Maximum image width in Print document (px)' ) ?>
					</td>
					<td class="pppm_box_th">
                    <?php if( get_option('pppm_save_print_img_max_width') ){ $upmiw = get_option('pppm_save_print_img_max_width'); } else{ $upmiw = 500; } ?>
                    <input type="text" name="pppm_save_print_img_max_width" value="<?php echo $upmiw; ?>" style="width:60px" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Button image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_print_button_url" value="<?php echo get_option('pppm_save_print_button_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo PPPM_PATH .'img/'.get_option('pppm_save_print_button_url') ?>" align="absmiddle" /><br /><br />
					<table width="100%" border="0" style="padding-top:10px;empty-cells: hide; border-collapse:collapse;">
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;print.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/print.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; 
						width:33%;padding:3px;font-size:11px">
						&nbsp;print_101.gif<br /><br />
						<img src="<?php echo PPPM_PATH .'img/print_101.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4;width:33%; padding:3px;font-size:11px">
						&nbsp;print_102.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/print_102.gif' ?>" align="absmiddle" />
						</td>
					  </tr>
					  <tr valign="top">
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;print_103.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/print_103.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;print_103_red.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/print_103_red.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px">
						&nbsp;print_103_green.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/print_103_green.gif' ?>" align="absmiddle" />
						<hr size="1" noshade="noshade" />
						&nbsp;print_103_blue.gif <br /><br />
						<img src="<?php echo PPPM_PATH .'img/print_103_blue.gif' ?>" align="absmiddle" />
						</td>
						<td align="center" style="border:dotted 2px #d4d4d4; width:33%; padding:3px;font-size:11px; background:#FFFFFF">
						&nbsp;upm-print-1.2.0-small.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-print-1.2.0-small.png' ?>" align="absmiddle" style="padding-top:5px;" />
						<hr size="1" noshade="noshade" />
						&nbsp;upm-print-1.2.0.png <br />
						<img src="<?php echo PPPM_PATH .'img/upm-print-1.2.0.png' ?>" align="absmiddle" style="padding-top:5px; padding-bottom:5px;" />
						</td>
					  </tr>
					</table>
					
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'Icon image URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_print_icon_url" value="<?php echo get_option('pppm_save_print_icon_url') ?>" size="40" maxlength="255" /> &nbsp; <img src="<?php echo  PPPM_PATH .'img/'.get_option('pppm_save_print_icon_url') ?>" align="absmiddle" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'String text' ) ?>
					</td>
					<td class="pppm_box_th">
					<input type="text" name="pppm_save_print_button_text" size="40" maxlength="255" value="<?php echo get_option('pppm_save_print_button_text') ?>" />
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_td" >
					<?php _e( 'CSS Code' ) ?><br />
					<span style="color:#777777; font-style:italic">(<?php _e( 'This style code is used in printing template.' ) ?>)</span>
					</td>
					<td class="pppm_box_th">
					<textarea cols="60" rows="4" name="pppm_print_css"><?php echo get_option('pppm_print_css') ?></textarea>
					</td>
				  </tr>
				  <tr>
					<td class="pppm_box_th" colspan="2">
					<p class="submit">
					<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
					</p>
					</td>
				  </tr>
				</table>
				</form>
				<?php
			}break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'print_template' : 
			{
				?>
				<form id="pppm_form_saving_" name="pppm_form_print_" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<input type="hidden" name="pppm_hidden" value="pppm_pt">
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
				  
                  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post Header Print Date' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_pt_head_date') ) ? 
					$pppm_pt_head_date_checked['button'][ 'pppm_pt_head_date' ] = 'checked="checked"' : 
					$pppm_pt_head_date_checked['icon'][ 'pppm_pt_head_date' ] = 'checked="checked"';
					?>
					<label for="pppm_pt_head_date_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_pt_head_date_1" 
					<?php echo $pppm_pt_head_date_checked['button'][ 'pppm_pt_head_date' ] ?> 
					name="pppm_pt_head_date" value="1" /> &nbsp;&nbsp;
					<label for="pppm_pt_head_date_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_pt_head_date_0" 
					<?php echo $pppm_pt_head_date_checked['icon'][ 'pppm_pt_head_date' ] ?> 
					name="pppm_pt_head_date" value="0" />
					</td>
				  </tr>
                  
                  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post Header Site Name' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_pt_head_site') ) ? 
					$pppm_pt_head_site_checked['button'][ 'pppm_pt_head_site' ] = 'checked="checked"' : 
					$pppm_pt_head_site_checked['icon'][ 'pppm_pt_head_site' ] = 'checked="checked"';
					?>
					<label for="pppm_pt_head_site_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_pt_head_site_1" 
					<?php echo $pppm_pt_head_site_checked['button'][ 'pppm_pt_head_site' ] ?> 
					name="pppm_pt_head_site" value="1" /> &nbsp;&nbsp;
					<label for="pppm_pt_head_site_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_pt_head_site_0" 
					<?php echo $pppm_pt_head_site_checked['icon'][ 'pppm_pt_head_site' ] ?> 
					name="pppm_pt_head_site" value="0" />
					</td>
				  </tr>
                  
                  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post Header Page URL' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_pt_head_url') ) ? 
					$pppm_pt_head_url_checked['button'][ 'pppm_pt_head_url' ] = 'checked="checked"' : 
					$pppm_pt_head_url_checked['icon'][ 'pppm_pt_head_url' ] = 'checked="checked"';
					?>
					<label for="pppm_pt_head_url_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_pt_head_url_1" 
					<?php echo $pppm_pt_head_url_checked['button'][ 'pppm_pt_head_url' ] ?> 
					name="pppm_pt_head_url" value="1" /> &nbsp;&nbsp;
					<label for="pppm_pt_head_url_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_pt_head_url_0" 
					<?php echo $pppm_pt_head_url_checked['icon'][ 'pppm_pt_head_url' ] ?> 
					name="pppm_pt_head_url" value="0" />
					</td>
				  </tr>
                  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post Title' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_pt_title') ) ? 
					$pppm_pt_title_checked['button'][ 'pppm_pt_title' ] = 'checked="checked"' : 
					$pppm_pt_title_checked['icon'][ 'pppm_pt_title' ] = 'checked="checked"';
					?>
					<label for="pppm_pt_title_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_pt_title_1" 
					<?php echo $pppm_pt_title_checked['button'][ 'pppm_pt_title' ] ?> 
					name="pppm_pt_title" value="1" /> &nbsp;&nbsp;
					<label for="pppm_pt_title_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_pt_title_0" 
					<?php echo $pppm_pt_title_checked['icon'][ 'pppm_pt_title' ] ?> 
					name="pppm_pt_title" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post images' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_pt_image') ) ? 
					$pppm_pt_image_checked['button'][ 'pppm_pt_image' ] = 'checked="checked"' : 
					$pppm_pt_image_checked['icon'][ 'pppm_pt_image' ] = 'checked="checked"';
					?>
					<label for="pppm_pt_image_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_pt_image_1" 
					<?php echo $pppm_pt_image_checked['button'][ 'pppm_pt_image' ] ?> 
					name="pppm_pt_image" value="1" /> &nbsp;&nbsp;
					<label for="pppm_pt_image_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_pt_image_0" 
					<?php echo $pppm_pt_image_checked['icon'][ 'pppm_pt_image' ] ?> 
					name="pppm_pt_image" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post excerpt' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_pt_excerpt') ) ? 
					$pppm_pt_excerpt_checked['button'][ 'pppm_pt_excerpt' ] = 'checked="checked"' : 
					$pppm_pt_excerpt_checked['icon'][ 'pppm_pt_excerpt' ] = 'checked="checked"';
					?>
					<label for="pppm_pt_excerpt_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_pt_excerpt_1" 
					<?php echo $pppm_pt_excerpt_checked['button'][ 'pppm_pt_excerpt' ] ?> 
					name="pppm_pt_excerpt" value="1" /> &nbsp;&nbsp;
					<label for="pppm_pt_excerpt_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_pt_excerpt_0" 
					<?php echo $pppm_pt_excerpt_checked['icon'][ 'pppm_pt_excerpt' ] ?> 
					name="pppm_pt_excerpt" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post date' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_pt_date') ) ? 
					$pppm_pt_date_checked['button'][ 'pppm_pt_date' ] = 'checked="checked"' : 
					$pppm_pt_date_checked['icon'][ 'pppm_pt_date' ] = 'checked="checked"';
					?>
					<label for="pppm_pt_date_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_pt_date_1" 
					<?php echo $pppm_pt_date_checked['button'][ 'pppm_pt_date' ] ?> 
					name="pppm_pt_date" value="1" /> &nbsp;&nbsp;
					<label for="pppm_pt_date_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_pt_date_0" 
					<?php echo $pppm_pt_date_checked['icon'][ 'pppm_pt_date' ] ?> 
					name="pppm_pt_date" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post modified date' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_pt_md') ) ? 
					$pppm_pt_md_checked['button'][ 'pppm_pt_md' ] = 'checked="checked"' : 
					$pppm_pt_md_checked['icon'][ 'pppm_pt_md' ] = 'checked="checked"';
					?>
					<label for="pppm_pt_md_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_pt_md_1" 
					<?php echo $pppm_pt_md_checked['button'][ 'pppm_pt_md' ] ?> 
					name="pppm_pt_md" value="1" /> &nbsp;&nbsp;
					<label for="pppm_pt_md_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_pt_md_0" 
					<?php echo $pppm_pt_md_checked['icon'][ 'pppm_pt_md' ] ?> 
					name="pppm_pt_md" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Post links' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_pt_links') ) ? 
					$pppm_pt_links_checked['button'][ 'pppm_pt_links' ] = 'checked="checked"' : 
					$pppm_pt_links_checked['icon'][ 'pppm_pt_links' ] = 'checked="checked"';
					?>
					<label for="pppm_pt_links_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_pt_links_1" 
					<?php echo $pppm_pt_links_checked['button'][ 'pppm_pt_links' ] ?> 
					name="pppm_pt_links" value="1" /> &nbsp;&nbsp;
					<label for="pppm_pt_links_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_pt_links_0" 
					<?php echo $pppm_pt_links_checked['icon'][ 'pppm_pt_links' ] ?> 
					name="pppm_pt_links" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_td">
					<?php _e( 'Footer information' ) ?>
					</td>
					<td class="pppm_box_th">
					<?php 
					( get_option('pppm_pt_header') ) ? 
					$pppm_pt_header_checked['button'][ 'pppm_pt_header' ] = 'checked="checked"' : 
					$pppm_pt_header_checked['icon'][ 'pppm_pt_header' ] = 'checked="checked"';
					?>
					<label for="pppm_pt_header_1"><?php _e( 'Show' ) ?> </label>
					<input type="radio" id="pppm_pt_header_1" 
					<?php echo $pppm_pt_header_checked['button'][ 'pppm_pt_header' ] ?> 
					name="pppm_pt_header" value="1" /> &nbsp;&nbsp;
					<label for="pppm_pt_header_0"><?php _e( 'Hidden' ) ?> </label>
					<input type="radio" id="pppm_pt_header_0" 
					<?php echo $pppm_pt_header_checked['icon'][ 'pppm_pt_header' ] ?> 
					name="pppm_pt_header" value="0" />
					</td>
				  </tr>
				  
				  <tr>
					<td class="pppm_box_th" colspan="2">
					<p class="submit">
					<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
					</p>
					</td>
				  </tr>
				</table>
				</form>
				<?php
			}break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// SBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
		}
		
	}
	####################################################################################################
	#######  PAGE  #####################################################################################
	####################################################################################################
	####################################################################################################
	#######  PAGE  #####################################################################################
	####################################################################################################
	case 'upm_polls' : 
	{
	
		switch ( $cb ) {
		
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'poll_overview' : 
			{
				?>
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
                  
                  <!-- General Polls -->
                   <tr>
                      <td colspan="2" class="pppm_box_td" style="font-weight:bold;">
                        <?php _e( 'General Polls' ) ?>
                      </td>
				   </tr>
                   <tr>
					<td colspan="2" style="background:#F7F7F7; padding:0px;">
                    <table width="100%"class="pppm_box_table" border="0" cellspacing="1">
				   		<tr>
                            <td class="pppm_box_td_cell">Question</td>
                            <td class="pppm_box_td_cell" style="width:10%">Total Votes</td>
                            <td class="pppm_box_td_cell" style="width:10%">Start Date</td>
                            <td class="pppm_box_td_cell" style="width:10%">End Date</td>
                            <td class="pppm_box_td_cell" style="width:10%">Status</td>
                            <td class="pppm_box_td_cell" style="width:24%">Management</td>
                            <td class="pppm_box_td_cell" style="width:1%">&nbsp;</td>
                        </tr>
                    </table>
                    <script language="javascript">
                    function UPM_Logs(mode){
						if( mode == 'open' ){ document.getElementById('upm_poll_logs').style.display = "block"; } else {  document.getElementById('upm_logs').src = '<?php echo PPPM_PATH ?>js/blank.html'; document.getElementById('upm_poll_logs').style.display = "none"; }
					}
					function UPM_sLogs(mode){
						if( mode == 'open' ){ document.getElementById('upm_poll_slogs').style.display = "block"; } else {  document.getElementById('upm_slogs').src = '<?php echo PPPM_PATH ?>js/blank.html'; document.getElementById('upm_poll_slogs').style.display = "none"; }
					}
                    </script>
                    <div style="overflow-y:scroll; height:132px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <?php 
						global $wpdb;
						$poll_res = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."pppm_polls` WHERE `post`=0 ORDER BY `id` ASC ");
						foreach ( $poll_res as $_res ) :
						$meta = unserialize(stripslashes($_res->meta));
						$pnum = mysql_num_rows(mysql_query("SELECT `id` FROM `".$wpdb->prefix."pppm_polls_votes` WHERE `qid` = ".intval($_res->id) ));
						if( (intval(time()) < intval($_res->end)) || $_res->end == 0 ) { $_end = ''; } else { $_end = '<span style="color:#FF0000; font-size:11px;cursor:pointer;" title="Poll Is Expired"><strong>(i)</strong></span>'; }
						?>
                          <tr>
                            <td class="pppm_box_td_subcell" style="text-align:left;">&nbsp;<?php echo stripslashes($_res->question) ?></td>
                            <td class="pppm_box_td_subcell" style="width:10%"><?php echo $pnum ?></td>
                            <td class="pppm_box_td_subcell" style="width:10%"><?php echo date('d/n/Y',$_res->start) ?></td>
                            <td class="pppm_box_td_subcell" style="width:10%"><?php ($_res->end)?print(date('d/n/Y',$_res->end)):print('unexpired'); ?> <?php echo $_end; ?></td>
                            <td class="pppm_box_td_subcell" style="width:10%"><?php ($meta['status'])?print('Open'):print('Closed') ?></td>
                            <td class="pppm_box_td_subcell" style="width:25%">
                            <?php if($pnum): ?>
                            <a href="<?php echo PPPM_PATH .'includes/poll_logs.php?_page=1&qid='.$_res->id ?>&mode=general" class="_polls" target="upm_logs" onclick="UPM_Logs('open')">Logs</a> | 
                            <?php endif; ?>
                            <a href="<?php echo preg_replace('|\&do=\w+\&id=\d+|i','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])); ?>&do=edit&id=<?php echo $_res->id ?>#add_edit" class="_polls">Edit</a> | 
                            <a href="<?php echo preg_replace('|\&do=\w+\&id=\d+|i','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])); ?>&do=<?php ($meta['status'])?print('close'):print('open') ?>&id=<?php echo $_res->id ?>" class="_polls"><?php ($meta['status'])?print('Close'):print('Open') ?></a> | 
                            <a href="<?php echo preg_replace('|\&do=\w+\&id=\d+|i','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])); ?>&do=delete&id=<?php echo $_res->id ?>" onClick="a=confirm('Are you sure you want to DELETE this poll ?'); if(!a) return(false);" class="_polls">Delete</a></td>
                          </tr>
						  <?php endforeach; ?>
                        </table>
                     </div>
					</td>
				  </tr>
                  <!-- General Polls -->
                  <tr>
                      <td style="background:#FFFFFF;">
                      <div id="upm_poll_logs" style="display:none; position:relative;">
                      <div style="position:absolute;color:#DD0000; width:100%; top:7px; font-weight:bold; text-align:right;"><span style="cursor:pointer;" onclick="UPM_Logs('close')" title="close">x</span> &nbsp;</div>
                  	  <iframe src="<?php echo PPPM_PATH ?>js/blank.html" name="upm_logs" id="upm_logs" frameborder="0" style="width:100%; height:300px;margin:0px; border:0px; overflow:hidden; outline:0px;" scrolling="no"></iframe>
                      </div>
                      </td>
                  </tr>
                  <!-- Post Specific Polls -->
                   <tr>
                      <td colspan="2" class="pppm_box_td" style="font-weight:bold;">
                        <?php _e( 'Post Specific Polls' ) ?>
                      </td>
				   </tr>
                   <tr>
					<td colspan="2" style="background:#F7F7F7; padding:0px;">
                   <table width="100%"class="pppm_box_table" border="0" cellspacing="1">
				   		<tr>
                            <td class="pppm_box_td_cell">Question</td>
                            <td class="pppm_box_td_cell" style="width:10%">Total Votes</td>
                            <td class="pppm_box_td_cell" style="width:10%">Start Date</td>
                            <td class="pppm_box_td_cell" style="width:10%">End Date</td>
                            <td class="pppm_box_td_cell" style="width:10%">Status</td>
                            <td class="pppm_box_td_cell" style="width:24%">Management</td>
                            <td class="pppm_box_td_cell" style="width:1%">&nbsp;</td>
                        </tr>
                    </table>
                    <div style="overflow-y:scroll; height:132px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <?php 
						  global $wpdb;
						  $poll_res = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."pppm_polls` WHERE `post`!=0 ORDER BY `id` ASC ");
						  foreach ( $poll_res as $_res ) :
						  $meta = unserialize(stripslashes($_res->meta));
						  $pnum = mysql_num_rows(mysql_query("SELECT `id` FROM `".$wpdb->prefix."pppm_polls_votes` WHERE `qid` = ".intval($_res->id) ));
						  if( (intval(time()) < intval($_res->end)) || $_res->end == 0 ) { $_end = ''; } else { $_end = '<span style="color:#FF0000; font-size:11px;cursor:pointer;" title="Poll Is Expired"><strong>(i)</strong></span>'; }
						  ?>
                          <tr>
                            <td class="pppm_box_td_subcell" style="text-align:left;">&nbsp;<?php echo stripslashes($_res->question) ?></td>
                            <td class="pppm_box_td_subcell" style="width:10%"><?php echo $pnum ?></td>
                            <td class="pppm_box_td_subcell" style="width:10%"><?php echo date('d/n/Y',$_res->start) ?></td>
                            <td class="pppm_box_td_subcell" style="width:10%"><?php ($_res->end)?print(date('d/n/Y',$_res->end)):print('unexpired'); ?> <?php echo $_end; ?></td>
                            <td class="pppm_box_td_subcell" style="width:10%"><?php ($meta['status'])?print('Open'):print('Closed') ?></td>
                            <td class="pppm_box_td_subcell" style="width:25%">
                            <?php if($pnum): ?>
                            <a href="<?php echo PPPM_PATH .'includes/poll_logs.php?_page=1&qid='.$_res->id ?>&mode=specific" class="_polls" target="upm_slogs" onclick="UPM_sLogs('open')">Logs</a> | 
                            <?php endif; ?>
                            <a href="<?php echo preg_replace('|\&do=\w+\&id=\d+|i','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])); ?>&do=edit&id=<?php echo $_res->id ?>#add_edit" class="_polls">Edit</a> | 
                            <a href="<?php echo preg_replace('|\&do=\w+\&id=\d+|i','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])); ?>&do=<?php ($meta['status'])?print('close'):print('open') ?>&id=<?php echo $_res->id ?>" class="_polls"><?php ($meta['status'])?print('Close'):print('Open') ?></a> | 
                            <a href="<?php echo preg_replace('|\&do=\w+\&id=\d+|i','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])); ?>&do=delete&id=<?php echo $_res->id ?>" onClick="a=confirm('Are you sure you want to DELETE this poll ?'); if(!a) return(false);" class="_polls">Delete</a>
                            </td>
                          </tr>
						  <?php endforeach; ?>
                        </table>
                     </div>
					</td>
				  </tr>
                  <!-- General Polls -->
                  <tr>
                      <td style="background:#FFFFFF;">
                      <div id="upm_poll_slogs" style="display:none; position:relative;">
                      <div style="position:absolute;color:#DD0000; width:100%; top:7px; font-weight:bold; text-align:right;"><span style="cursor:pointer;" onclick="UPM_sLogs('close')" title="close">x</span> &nbsp;</div>
                  	  <iframe src="<?php echo PPPM_PATH ?>js/blank.html" name="upm_slogs" id="upm_slogs" frameborder="0" style="width:100%; height:300px;margin:0px; border:0px; overflow:hidden; outline:0px;" scrolling="no"></iframe>
                      </div>
                      </td>
                  </tr>
				</table>
				
				<?php
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'poll_add' : 
			{
				if( $_GET['do'] == 'edit' ):
				global $wpdb;
				$_poll = $wpdb->get_row("SELECT * FROM `".$wpdb->prefix."pppm_polls` WHERE `id`=".$_GET['id'], ARRAY_A );
				endif;
				?>
                <a name="add_edit"></a>
                <form method="post" action="<?php echo preg_replace('|\&do=\w+\&id=\d+|i','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])); ?>">
				<input type="hidden" name="pppm_hidden" value="pppm_poll_<?php ($_GET['do']=='edit')?print('edit'):print('add'); ?>">
                <input type="hidden" name="poll_id" value="<?php echo $_GET['id'] ?>" />
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
                   <tr>
                      <td class="pppm_box_td" style="font-weight:bold;">
                      Question
                      </td>
                      <td class="pppm_box_td">
                      <input name="pppm_poll_question" value="<?php echo $_poll['question'] ?>" type="text" size="80" />
                      </td>
				   </tr>
                   <tr>
                      <td class="pppm_box_td" style="font-weight:bold;">
                      Poll Answers
                      </td>
                      <td class="pppm_box_td">
                      <!-- Poll Answers -->
                      <fieldset>
                         <?php 
						 if( $_GET['do'] == 'edit' ):
					     $poll_res = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."pppm_polls_items` WHERE `qid`=".$_GET['id']." ORDER BY `id` ASC");
					  	 foreach( $poll_res as $item ):
					     ?>
                      	 <fieldset id="duplicate" style="margin:0px;width:100%; background:#F7F7F7;">
                                    <p>
                                    <label for="pb3g">Answer : </label>
                                    <br />
                                    <input id="pb3g" type="text" name="pppm_poll_answers[<?php echo $item->id ?>]" value="<?php echo $item->answer ?>" size="78"> | <label for="pppm_poll_answers_remove_<?php echo $item->id ?>">Remove:</label> <input type="checkbox" id="pppm_poll_answers_remove_<?php echo $item->id ?>" name="pppm_poll_answers_remove[<?php echo $item->id ?>]" value="1" />
                                    </p>
                         </fieldset>
                      	 <?php endforeach; endif; ?>
                         <fieldset id="duplicate3g" style="margin:0px;width:100%; background:#F7F7F7;">
                                    <p>
                                    <label for="pb3g">New Answer : </label>
                                    <br />
                                    <input id="pb3g" type="text" name="pppm_poll_answers[]" value="" size="78">
                                    </p>
                          </fieldset>
                          <p><span><a id="minus3g" href="" title="Add new field" style="text-decoration:none; font-size:14px;">[-]</a> 
                          <a id="plus3g" href="" title="Add new field" style="text-decoration:none; font-size:14px;">[+]</a></span><br /><br /></p>
                      </fieldset>
                      <!-- Poll Answers END -->
                      </td>
				   </tr>
                   <tr>
                      <td class="pppm_box_td" style="font-weight:bold;">
                      Poll Start &amp; End Date
                      </td>
                      <td class="pppm_box_td">
                      <!-- Poll Date -->
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>&nbsp;Start: </td>
                            <td><input type="text" name="pppm_poll_date_start" id="date1" class="date-pick" value="<?php if($_GET['do'] == 'edit' && $_poll['start']) echo date('d/n/Y',$_poll['start']) ?>" /> </td>
                            <td>&nbsp;&nbsp;&nbsp;End: </td>
                            <td><input type="text" name="pppm_poll_date_end" id="date2" class="date-pick" value="<?php if($_GET['do'] == 'edit' && $_poll['end']) echo date('d/n/Y',$_poll['end']) ?>" /></td>
                          </tr>
                        </table>
                        <!-- Poll Date END -->
                      </td>
				   </tr>
                    <tr>
                      <td class="pppm_box_td" style="font-weight:bold; width:30%">
                      Poll Type<br />
                      <span style="color:#777777; font-style:italic; font-weight:100; font-size:12px;">
					  <?php _e( 'You can choose "Post Specific" option to show this poll only on certain post widget.' ) ?>
                      </span>
                      </td>
                      <td class="pppm_box_td">
                        <!-- Poll Date -->
                        <label for="pppm_poll_type_0">General:</label> 
                        <input id="pppm_poll_type_0" type="radio" name="pppm_poll_type" value="0" <?php ( $_poll['post'] && $_GET['do'] == 'edit' )?print(''):print('checked="checked"'); ?> />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="pppm_poll_type_1">Post Specific:</label> 
                        <input id="pppm_poll_type_1" type="radio" name="pppm_poll_type" value="1" <?php ( $_poll['post'] && $_GET['do'] == 'edit' )?print('checked="checked"'):print(''); ?> /> 
                        <select name="pppm_poll_post" id="pppm_poll_post" >
                        <option value="">--Choose the post--</option>
                        <?php
                        $args=array('orderby' => 'name', 'order' => 'ASC' ,'hide_empty' => false);
						  
						$categories = get_categories($args);
						foreach( $categories as $category ) { 
						
							( $category->cat_ID == get_option('ach_r_article_cat') ) ? $_selected = 'selected="selected"' :  $_selected = '' ;
						
							$CID = $category->cat_ID;
							if( $category->parent == 0 ) { 
								$ws = '' ;
								echo '<optgroup label="'.$category->name.'" style="font-size:14px;">'; 
								///////////////////////////////////////////////////////////////////////////
								$recentPosts = new WP_Query();
								$recentPosts->query('showposts=-1&cat='.$CID.'orderby=post_title&order=ASC' );
								while ($recentPosts->have_posts()) : $recentPosts->the_post(); 
								( $_poll['post'] == get_the_ID() ) ? $_selected = 'selected="selected"' : $_selected = '';
								?>
                                <option value="<?php the_ID(); ?>" <?php echo $_selected; ?>><?php the_title(); ?></option>; 
								<?php 
								endwhile; 
                                ///////////////////////////////////////////////////////////////
								echo '</optgroup>';
							}
							
						}
						?>
                        </select>
                        <!-- Poll Date END -->
                      </td>
				   </tr>
                   <tr>
					<td class="pppm_box_th" colspan="2"> 
                        <p class="submit">
                        <input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
                        </p>
					</td>
				  </tr>
                </table>
                </form>
                <?php
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'poll_template' : 
			{
				?>
                <a name="poll_template"></a>
                <form method="post" action="<?php echo preg_replace('|\&do=\w+\&id=\d+|i','',str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])); ?>#poll_template">
				<input type="hidden" name="pppm_hidden" value="pppm_poll_template">
				<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
                  <!-- Poll's Template -->
                   <tr>
                      <td colspan="2" class="pppm_box_td" style="font-weight:bold; background:#F4F4F4;">
                        <?php _e( 'Voting Form' ) ?>
                      </td>
				   </tr>
                   <tr>
                      <td class="pppm_box_td" style="width:40%">
                        <strong><?php _e( 'Movable Variables:' ) ?></strong>
                        <br />[QUESTION] - Poll question<br /><br />
                        <strong><?php _e( 'Immovable Variables:' ) ?></strong>
                        <br />[ANSWERS-START] - Start creating answers list,
                        <br />[ANSWERS-END] - End of answers list,
                        <br />[ANSWER-ID] - Answer's ID,
                        <br />[ANSWER] - Answer's text.
                        
                      </td>
                      <td class="pppm_box_td" style="text-align:center;">
                        <textarea name="pppm_poll_form_template" style="width:98%; background:#F8F8F8; color:#009900; font-size:12px;" rows="10"><?php echo stripslashes(get_option('pppm_poll_form_template')) ?></textarea>
                      </td>
				   </tr>
                   <tr>
					<td class="pppm_box_th" colspan="2">&nbsp; 
                        
					</td>
				  </tr>
                  <!-- Poll's Template END -->
                  
                  <!-- Poll's Result Template -->
                   <tr>
                      <td colspan="2" class="pppm_box_td" style="font-weight:bold; background:#F4F4F4;">
                        <?php _e( 'Voting Results' ) ?>
                      </td>
				   </tr>
                   <tr>
                      <td class="pppm_box_td" style="width:40%">
                        <strong><?php _e( 'Movable Variables:' ) ?></strong>
                        <br />[QUESTION] - Poll question
                        <br />[POLL-ID] - Poll ID
                        <br />[NEXT-POLL] - Next poll button
                        <br />[TOTAL-VOTERS] - Number of total voters
                        <br /><br />
                        <strong><?php _e( 'Immovable Variables:' ) ?></strong>
                        <br />[ANSWERS-START] - Start creating answers list,
                        <br />[ANSWERS-END] - End of answers list,
                        <br />[ANSWER-ID] - Answer ID,
                        <br />[ANSWER] - Answer's text.
                        <br />[POLLBAR-BG] - Pollbar background style
                        <br />[POLLBAR-WIDTH] - Pollbar width
                        <br />[POLLBAR-HEIGHT] - Pollbar height
                        <br />[V%] - Percent of votes
                        <br />[V#] - Number of votes
                      </td>
                      <td class="pppm_box_td" style="text-align:center;">
                        <textarea name="pppm_poll_results_template" style="width:98%; background:#F8F8F8; color:#009900; font-size:12px;" rows="15"><?php echo stripslashes(get_option('pppm_poll_results_template')) ?></textarea>
                      </td>
				   </tr>
                   <tr>
					<td class="pppm_box_th" colspan="2"> 
                        <p class="submit">
                        <input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />&nbsp;&nbsp;&nbsp;<input type="submit"  class="button button-primary" name="Default"  onClick="a=confirm('Are you sure you want to RESTORE DEFAULT both ( Poll and Voting ) templates ?'); if(!a) return(false);" value="<?php _e( 'Restore Default' ) ?>" />
                        </p>
					</td>
				  </tr>
                  <!-- Poll's Result  Template END -->
				</table>
				</form>
				<?php
			} break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			
		}
		
		
		
	}
	####################################################################################################
	#######  PAGE  #####################################################################################
	####################################################################################################
	case 'bycat' : 
	{
	
		switch ( $cb ) {
		
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'cat_list' : 
			{
				?>
				<form id="pppm_form_bycat" name="pppm_form_bycat" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="pppm_hidden" value="pppm_bycat">
					<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
					<tr>
						<td rowspan="2" class="pppm_box_td" style="background:#F9F9F9; font-weight:bold;" >
						<?php _e( 'Category Name' ) ?>
						</td>
						<td class="pppm_box_th" style="background:#F9F9F9; font-weight:bold; text-align:center">
						<?php _e( 'Managers' ) ?>
						</td>
				  	</tr>
					<tr>
						<td class="pppm_box_th" style="background:#F9F9F9; font-weight:100; text-align:left; padding:0px;">
						
						<table width="100%" border="0" cellspacing="1" class="pppm_box_table">
						  <tr bgcolor="#F9F9F9">
							<td class="pppm_box_th" style="text-align:center; font-weight:bold" width="25%">
							<?php _e( 'Saving' ) ?></td>
							<td class="pppm_box_th">&nbsp;</td>
							<td class="pppm_box_th">&nbsp;</td>
							<td class="pppm_box_th">&nbsp;</td>
						  </tr>
						</table>

						</td>
				  	</tr>
					<?php
					$args=array(
					  'orderby' => 'name', 'order' => 'ASC' ,'hide_empty' => false);
					  
					$categories = get_categories($args);
					foreach( $categories as $category ) { 
						$CID = $category->cat_ID;
						?>
						<tr>
						<td class="pppm_box_td" style="width:40%">
						<?php 
						if( $category->parent == 0 ) { 
							$ws = '' ;
							$bold = 'font-weight:bold';
						}
						else {
							$bold = '';
							$cats_str = get_category_parents($category->cat_ID, false, '%#%');
							$cats_array = explode('%#%', $cats_str);
							$cat_depth = sizeof($cats_array)-2;
							$cat_depth; $nbsp = '';
							for( $i = 0; $i < $cat_depth; $i++ ){
								$nbsp .= '-';
							}
							$ws = ' '.$nbsp.' ';
						}
						echo $ws.$category->name; 
						?>
						</td>
						<td class="pppm_box_th" style="padding:0px;">
						
							<table width="100%" border="0" cellspacing="1">
							  <tr bgcolor="#F9F9F9">
								<td class="pppm_box_th" style="text-align:center;<?php echo $bold ?>" width="25%">
								
								<?php 
								( get_option( 'pppm_bycat_saving_'.$CID ) ) ? 
								$pppm_bycat_saving_checked[$CID]['off'][ 'pppm_bycat_saving' ] = 'checked="checked"' : 
								$pppm_bycat_saving_checked[$CID]['on'][ 'pppm_bycat_saving' ] = 'checked="checked"';
								?>
								<label for="pppm_bycat_saving_0_<?php echo $CID ?>"><?php _e( 'On' ) ?> </label>
								<input type="radio" id="pppm_bycat_saving_0_<?php echo $CID ?>" 
								<?php echo $pppm_bycat_saving_checked[$CID]['on'][ 'pppm_bycat_saving' ] ?> 
								name="pppm_bycat_saving[<?php echo $CID ?>]" value="0" /> &nbsp;&nbsp;
								
								<label for="pppm_bycat_saving_1_<?php echo $CID ?>"><?php _e( 'Off' ) ?> </label>
								<input type="radio" id="pppm_bycat_saving_1_<?php echo $CID ?>" 
								<?php echo $pppm_bycat_saving_checked[$CID]['off'][ 'pppm_bycat_saving' ] ?> 
								name="pppm_bycat_saving[<?php echo $CID ?>]" value="1" />
								
								</td>
								<td class="pppm_box_th">&nbsp;</td>
								<td class="pppm_box_th">&nbsp;</td>
								<td class="pppm_box_th">&nbsp;</td>
							  </tr>
							</table>
						
						</td>
						</tr>
						<?php
						
					} 
					?>
				  <tr>
					<td class="pppm_box_th" colspan="2">
					<p class="submit">
					<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
					</p>
					</td>
				  </tr>
				</table>
				</form>
				<?php
			}break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
		}
		
	}
	####################################################################################################
	#######  PAGE  #####################################################################################
	####################################################################################################
	case 'upm_share' : 
	{
	
		switch ( $cb ) {
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'bookmarks_slider' : 
			{
				$pppm_icon_size = array(16,24,32,48,60);
				
				if( get_option('pppm_sb_size') ){
					foreach( $pppm_icon_size as $is ){
						( get_option('pppm_sb_size') == $is ) ? $sbi_check[$is] = 'checked="checked"' : $sbi_check[$is] ='';
					}
				}
				else{
					$sbi_check[32] = 'checked="checked"';
				}
				?>
				<form id="pppm_form_bookmarks" name="pppm_form_bookmarks" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="pppm_hidden" value="pppm_bookmarks_slider">
					<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
					<tr>
						<td class="pppm_box_td" style="width:50%;">
							<?php _e( 'Bookmark\'s slugs' ) ?>
						</td>
						<td class="pppm_box_th" style="padding:5px;">
						<table width="100%" style="color:#990000" border="0" cellspacing="2" cellpadding="0">
						  <tr>
							<td>aim</td>
							<td>blinklist</td>
							<td>blogger</td>
							<td>blogmarks</td>
							<td>buzz</td>
						  </tr>
						  <tr>
							<td>connotea</td>
							<td>delicious</td>
							<td>digg</td>
							<td>diigo</td>
							<td>facebook</td>
						  </tr>
						  <tr>
							<td>fark</td>
							<td>friendfeed</td>
							<td>furl</td>
							<td>google</td>
							<td>linkedin</td>
						  </tr>
						  <tr>
							<td>live</td>
							<td>livejournal</td>
							<td>magnolia</td>
							<td>mixx</td>
							<td>myspace</td>
						  </tr>
						  <tr>
							<td>netvibes</td>
							<td>netvouz</td>
							<td>newsvine</td>
							<td>propeller</td>
							<td>reddit</td>
						  </tr>
						  <tr>
							<td>slashdot</td>
							<td>stumbleupon</td>
							<td>technorati</td>
							<td>twitter</td>
							<td>yahoo</td>
						  </tr>
						</table>

						</td>
					</tr>
					<tr>
						<td class="pppm_box_td" style="width:50%;">
							<?php _e( 'Slider Item\'s Size [ <span style="color:#990000">size</span> ]' ) ?>
							<br /><span style="color:#777777;font-style:italic;font-weight:100;font-size:12px;">
							Available sizes: 16, 24, 32, 48, 60 <br />( Don't use other sizes for slider ! )
							</span>
						</td>
						<td class="pppm_box_th" style="padding:0px;">
						
						<table width="100%" border="0" cellspacing="1">
							  <tr>
								<td class="pppm_box_th" style="text-align:center;" width="20%">
								<label for="sb_16">
								<?php _e( '16x16' ) ?>
								</label>
								<input type="radio" id="sb_16" name="pppm_sb_size" value="16" <?php echo $sbi_check[16] ?> />
								</td>
								<td class="pppm_box_th" style="text-align:center;" width="20%">
								<label for="sb_24">
								<?php _e( '24x24' ) ?>
								</label>
								<input type="radio" id="sb_24" name="pppm_sb_size" value="24" <?php echo $sbi_check[24] ?> />
								</td>
								<td class="pppm_box_th" style="text-align:center;" width="20%">
								<label for="sb_32">
								<?php _e( '32x32' ) ?>
								</label>
								<input type="radio" id="sb_32" name="pppm_sb_size" value="32" <?php echo $sbi_check[32] ?> />
								</td>
								<td class="pppm_box_th" style="text-align:center;" width="20%">
								<label for="sb_48">
								<?php _e( '48x48' ) ?>
								</label>
								<input type="radio" id="sb_48" name="pppm_sb_size" value="48" <?php echo $sbi_check[48] ?> />
								</td>
								<td class="pppm_box_th" style="text-align:center;" width="20%">
								<label for="sb_60">
								<?php _e( '60x60' ) ?>
								</label>
								<input type="radio" id="sb_60" name="pppm_sb_size" value="60" <?php echo $sbi_check[60] ?> />
								</td>
							  </tr>
							</table>
						
						</td>
					</tr>
					<tr>
						<td class="pppm_box_td" style="width:50%;">
							<?php _e( 'Number of items to scroll by [ <span style="color:#990000">ShowBookmarksNumber</span> ]' ) ?>
							<br />
							<span style="color:#777777;font-style:italic;font-weight:100;font-size:12px;">
							( Maximum 30 )
							</span>
						</td>
						<td class="pppm_box_th" style="padding:0px;">
						&nbsp;<input name="pppm_sb_ShowBookmarksNumber" size="10" value="<?php 
						((get_option('pppm_sb_ShowBookmarksNumber'))
						? print(get_option('pppm_sb_ShowBookmarksNumber'))
						: print(5)) ?>" />
						</td>
					</tr>
					<tr>
						<td class="pppm_box_td" style="width:50%;">
							<?php _e( 'Showing Bookmarks by start [ <span style="color:#990000">StartBookmarks</span> ]' ) ?>
							<br /><span style="color:#777777;font-style:italic;font-weight:100;font-size:12px;">
							Use Bookmark's slugs and separate with commas.<br />( Example: aim, blinklist, blogger )
							</span>
						</td>
						<td class="pppm_box_th" style="padding:0px;">
						&nbsp;<input name="pppm_sb_StartBookmarks" size="50" value="<?php 
						((get_option('pppm_sb_StartBookmarks'))
						? print(get_option('pppm_sb_StartBookmarks'))
						: print('twitter,facebook,digg,myspace,stumbleupon')) ?>" />
						</td>
					</tr>
					<tr>
						<td class="pppm_box_td" style="width:50%;">
							<?php _e( 'Excluded Bookmarks [ <span style="color:#990000">ExcludeBookmarks</span> ]' ) ?>
							<br /><span style="color:#777777;font-style:italic;font-weight:100;font-size:12px;">
							Use Bookmark's slugs and separate with commas.<br />( Example: aim, blinklist, blogger )
							</span>
						</td>
						<td class="pppm_box_th" style="padding:0px;">
						&nbsp;<input name="pppm_sb_ExcludeBookmarks" size="50" value="<?php print(get_option('pppm_sb_ExcludeBookmarks')); ?>" />
						</td>
					</tr>
					<tr>
						<td class="pppm_box_td" style="width:50%;">
							<?php _e( 'Background Color [ <span style="color:#990000">BackgroundColor</span> ]' ) ?>
						</td>
						<td class="pppm_box_th" style="padding:0px;">
						&nbsp;<input name="pppm_sb_BackgroundColor" size="50" value="<?php 
						((get_option('pppm_sb_BackgroundColor'))
						? print(get_option('pppm_sb_BackgroundColor'))
						: print('#FFFFFF')) ?>" />
						</td>
					</tr>
					<tr>
						<td class="pppm_box_th" colspan="2">
						<p class="submit">
						<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
						</p>
						</td>
				  	</tr>
					<tr>
						<td class="pppm_box_th" colspan="2">
							<table width="100%" style="background:#FFFFFF">
								  <tr>
									<td style="padding:10px;border:#CCCCCC 1px dotted;">Screen Type #1</td>
								  </tr>
								  <tr>
									<td align="center" style="padding:10px;border:#CCCCCC 1px dotted;">
									<img src="<?php echo PPPM_PATH.'img/b-screen-8.jpg' ?>" align="middle" />
									<img src="<?php echo PPPM_PATH.'img/b-screen-6.jpg' ?>" align="middle" /><br />
									<img src="<?php echo PPPM_PATH.'img/b-screen-9.jpg' ?>" align="middle" style="margin-bottom:10px;" /><br />
									<img src="<?php echo PPPM_PATH.'img/b-screen-5.jpg' ?>" style="margin-bottom:15px;" /><br />
									<img src="<?php echo PPPM_PATH.'img/b-screen-1.jpg' ?>" />
									</td>
								  </tr>
								  <tr>
									<td style="padding:10px;border:#CCCCCC 1px dotted;">Template file location:<br /> /universal-post-manager/template/bookmarks_slider_h.php </td>
								  </tr>
								   <tr>
									<td colspan="2" style="padding:10px;border:#CCCCCC 1px dotted;">
									 Put this code in template files wherever you want <code style="font-size: 15px; font-weight: bold; line-height:25px;"> &lt;?php upm_bookmarks('type=slider') ?&gt; </code>
									 <br /><br />
									 If you want to include this link more then one time in same page , you should use this code like this:
									 <br />
									 <span style="font-size:11px; color:#000000;">
									 &lt;?php upm_bookmarks(<span style="color:#990000">'<strong>type</strong>=slider<span style="color:#0000FF">&amp;</span><strong>SequenceNumber</strong>=1'</span>) ?&gt;<br />
									 &lt;?php upm_bookmarks(<span style="color:#990000">'<strong>type</strong>=slider<span style="color:#0000FF">&amp;</span><strong>SequenceNumber</strong>=2'</span>) ?&gt;<br />
									 &lt;?php upm_bookmarks(<span style="color:#990000">'<strong>type</strong>=slider<span style="color:#0000FF">&amp;</span><strong>SequenceNumber</strong>=3'</span>) ?&gt;
									 ... etc.</span> 
									<br /><br />
									You can customize Bookmark's slider by all vareables. Examlpe:<br />
									<span style="font-size:11px">
									<strong>&lt;?php upm_bookmarks(</strong><span style="color:#990000">'<strong>type</strong>=slider<span style="color:#0000FF">&amp;</span><strong>size</strong>=60<span style="color:#0000FF">&amp;</span><strong>BackgroundColor</strong>=#000000<span style="color:#0000FF">&amp;</span><strong>ShowBookmarksNumber</strong>=6<span style="color:#0000FF">&amp;</span><strong>SequenceNumber</strong>=1<span style="color:#0000FF">&amp;</span><strong>StartBookmarks</strong>=facebook,myspace,twitter<span style="color:#0000FF">&amp;</span><strong>ExcludeBookmarks</strong>=aim,blinklist,blogger'</span><strong>) ?&gt;</strong>
									</span>
									<br />
									</td>
								   </tr>
								</table>
						</td>
					</tr>
					</table>
				</form>
				<?php
			}break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'bookmarks' : 
			{
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
					
					$pppm_icon_size = array(16,24,32,48,60);
					foreach( $pppm_icon_size as $is ){
						( get_option('pppm_bookmark_icon') == $is ) ? $bi_check[$is] = 'checked="checked"' : $bi_check[$is] ='';
					}
					
					$pppm_bookmarks = explode(',',get_option('pppm_bookmarks'));
					foreach( $pppm_bookmark_array as $b_k => $b_s ){
						
						if( arraychecker( $b_k, $pppm_bookmarks ) ) {
							$bs_check[$b_k] = 'checked="checked"';
							$pppm_selected[$b_k] = 'background-color:#FFFFCC;';
						}
						else {
							$bs_check[$b_k] ='';
							$pppm_selected[$b_k] ='';
						}
					}
				?>
				<script language="javascript">
				function pppm_check(s){
				  for(var i=1;i<31;i++)
				  {
				  	document.getElementById('b'+i).checked=s;
				  }
				}
				</script>
				<form id="pppm_form_bookmarks" name="pppm_form_bookmarks" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="pppm_hidden" value="pppm_bookmarks">
					<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
					<tr>
						<td class="pppm_box_td" style="width:45%;">
							<?php _e( 'Link Type' ) ?>
						</td>
						<td class="pppm_box_th">
						<?php 
						if( get_option('pppm_bookmark_link_type') == '' ){
							$pppm_bookmark_type_check[0] = 'checked="checked"';
						}
						else{
							$pppm_bookmark_type_check[get_option('pppm_bookmark_link_type')] = 'checked="checked"';
						}
						?>
						&nbsp;<input type="radio" id="pppm_bookmark_link_type_0" name="pppm_bookmark_link_type" <?php echo $pppm_bookmark_type_check[0] ?> value="0" />&nbsp;<label for="pppm_bookmark_link_type_0"><?php _e( 'Text and Image' ) ?></label>
						&nbsp;&nbsp; <input type="radio" id="pppm_bookmark_link_type_1" name="pppm_bookmark_link_type" <?php echo $pppm_bookmark_type_check[1] ?> value="1" />&nbsp;<label for="pppm_bookmark_link_type_1"><?php _e( 'Text' ) ?></label>
						&nbsp;&nbsp; <input type="radio" id="pppm_bookmark_link_type_2" name="pppm_bookmark_link_type" <?php echo $pppm_bookmark_type_check[2] ?> value="2" />&nbsp;<label for="pppm_bookmark_link_type_2"><?php _e( 'Image' ) ?></label>
						</td>
					</tr>
					</table>
					<br />

					<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
					<tr>
						<td rowspan="2" class="pppm_box_td" style="background:#F9F9F9; font-weight:bold; width:20px" >
						<?php _e( 'On' ) ?><br />
						</td>
						<td rowspan="2" class="pppm_box_td" style="background:#F9F9F9; font-weight:bold;" >
						<?php _e( 'Bookmark Name' ) ?>
						</td>
						<td rowspan="2" class="pppm_box_th" valign="top" style="background:#F9F9F9;font-weight:bold;width:150px">
						<?php _e( 'Text' ) ?>
						</td>
						<td class="pppm_box_th" style="background:#F9F9F9; font-weight:bold; text-align:center">
						<?php _e( 'Images' ) ?>
						</td>
				  	</tr>
					<tr>
						<td class="pppm_box_th" style="background:#F9F9F9; font-weight:100; text-align:left; padding:0px;width:55%">
						
							<table width="100%" border="0" cellspacing="1" class="pppm_box_table">
							  <tr bgcolor="#F9F9F9">
								<td class="pppm_box_th" style="text-align:center; font-weight:bold" width="20%">
								<label for="b_16">
								<?php _e( '16x16' ) ?>
								</label>
								<input type="radio" id="b_16" name="pppm_bookmark_icon" value="16" <?php echo $bi_check[16] ?> />
								</td>
								<td class="pppm_box_th" style="text-align:center; font-weight:bold" width="20%">
								<label for="b_24">
								<?php _e( '24x24' ) ?>
								</label>
								<input type="radio" id="b_24" name="pppm_bookmark_icon" value="24" <?php echo $bi_check[24] ?> />
								</td>
								<td class="pppm_box_th" style="text-align:center; font-weight:bold" width="20%">
								<label for="b_32">
								<?php _e( '32x32' ) ?>
								</label>
								<input type="radio" id="b_32" name="pppm_bookmark_icon" value="32" <?php echo $bi_check[32] ?> />
								</td>
								<td class="pppm_box_th" style="text-align:center; font-weight:bold" width="20%">
								<label for="b_48">
								<?php _e( '48x48' ) ?>
								</label>
								<input type="radio" id="b_48" name="pppm_bookmark_icon" value="48" <?php echo $bi_check[48] ?> />
								</td>
								<td class="pppm_box_th" style="text-align:center; font-weight:bold" width="20%">
								<label for="b_60">
								<?php _e( '60x60' ) ?>
								</label>
								<input type="radio" id="b_60" name="pppm_bookmark_icon" value="60" <?php echo $bi_check[60] ?> />
								</td>
							  </tr>
							</table>

						</td>
				  	</tr>
					<?php 
					foreach( $pppm_bookmark_array as $bk => $bv ){
					
					if( $bk == 0 ) continue;
					if( $bv == 'aim' ) $bv = 'AIM';
					if( $bv == 'friendfeed' ) $bv = 'FriendFeed';
					if( $bv == 'youtube' ) $bv = 'YouTube';
					
					
					?>
					<!-- Item -->
					<tr>
						<td class="pppm_box_td" style="text-align:center;<?php echo $pppm_selected[$bk] ?>">
						<input name="pppm_on[]" id="b<?php echo $bk ?>" type="checkbox" <?php echo $bs_check[$bk] ?> value="<?php echo $bk ?>" />
						</td>
						<td class="pppm_box_td">
						<label for="b<?php echo $bk ?>">
						&nbsp;<?php echo ucfirst($bv); ?>
						</label>
						</td>
						<td class="pppm_box_td">
						<input name="pppm_bookmark_text_<?php echo $bk ?>" value="<?php 
						((get_option('pppm_bookmark_text_'.$bk))
						? print(get_option('pppm_bookmark_text_'.$bk))
						: print(ucfirst($bv)))?>" />
						</td>
						<td class="pppm_box_th" style="padding:0px;">
						
							<table width="100%" border="0" cellspacing="1" cellpadding="0">
							  <tr bgcolor="#F9F9F9">
								<td class="pppm_box_th" style="text-align:center; width:20%;padding:0px;">
								<img src="<?php echo PPPM_PATH .'bookmarks/'.$bv.'/'.$bv.'_16.png' ?>" width="16" height="16" />
								</td>
								<td class="pppm_box_th" style="text-align:center; width:20%;padding:0px;">
								<img src="<?php echo PPPM_PATH .'bookmarks/'.$bv.'/'.$bv.'_24.png' ?>" width="24" height="24" />
								</td>
								<td class="pppm_box_th" style="text-align:center; width:20%;padding:0px;">
								<img src="<?php echo PPPM_PATH .'bookmarks/'.$bv.'/'.$bv.'_32.png' ?>" width="32" height="32" />
								</td>
								<td class="pppm_box_th" style="text-align:center; width:20%;padding:0px;">
								<img src="<?php echo PPPM_PATH .'bookmarks/'.$bv.'/'.$bv.'_48.png' ?>" width="48" height="48" />
								</td>
								<td class="pppm_box_th" style="text-align:center; width:20%;padding:0px;">
								<img src="<?php echo PPPM_PATH .'bookmarks/'.$bv.'/'.$bv.'_60.png' ?>" width="60" height="60" />
								</td>
							  </tr>
							</table>
						
						</td>
					</tr>
					<!-- Item End -->
					<?php 
					}
					?>
				  <tr>
					<td class="pppm_box_td" colspan="3" style="vertical-align:middle; height:50px;">
					<span onclick="pppm_check(true)" style="cursor: pointer;color:#DD0000;" class="medium">[ Check&nbsp;all ]</span>
					<span onclick="pppm_check(false)" style="cursor: pointer;color:#DD0000;" class="medium">[ Uncheck&nbsp;all ]</span>
					</td>
					<td class="pppm_box_th">
					<p class="submit">
					<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
					</p>
					</td>
				  </tr>
				  <tr>
						<td class="pppm_box_th" colspan="4">
							<table width="100%" style="background:#FFFFFF;">
								  <tr>
									<td style="padding:10px;border:#CCCCCC 1px dotted;">Screen Type #2</td>
								  </tr>
								  <tr>
									<td align="center" style="padding:10px;border:#CCCCCC 1px dotted;">
									<img src="<?php echo PPPM_PATH.'img/b-screen-10.png' ?>" />
									</td>
								  </tr>
								  <tr>
									<td style="padding:10px;border:#CCCCCC 1px dotted;">Template file location:<br /> /universal-post-manager/template/bookmarks_normal.php </td>
								  </tr>
								   <tr>
									<td colspan="2" style="padding:10px;border:#CCCCCC 1px dotted;">
									 Put this code in template files wherever you want <code style="font-size: 15px; font-weight: bold; line-height:25px;"> &lt;?php upm_bookmarks() ?&gt; </code>
									 
									</td>
								   </tr>
							</table>
						</td>
					</tr>
				</table>
				</form>
				<?php
			}break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
		}
		
	}
	####################################################################################################
	#######  PAGE  #####################################################################################
	####################################################################################################
	case 'upm_subscribe' : 
	{
	
		switch ( $cb ) {
		
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'email_this' : 
			{
				?>
				<form id="pppm_form_bookmarks" name="pppm_form_bookmarks" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="pppm_hidden" value="pppm_email_this">
					<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
						<tr>
						<td class="pppm_box_td" style="width:40%;">
							<?php _e( 'Link Text' ) ?>
						</td>
						<td class="pppm_box_th">
						&nbsp;<input name="pppm_email_this_text" size="50" value="<?php (get_option('pppm_email_this_text'))? print(get_option('pppm_email_this_text')): print('Forward to a friend')?>" />
						</td>
						</tr>
						<tr>
						<td class="pppm_box_td">
							<?php _e( 'Link Image' ) ?>
						</td>
						<td class="pppm_box_th">
						&nbsp;<input name="pppm_email_this_img" size="50" value="<?php (get_option('pppm_email_this_img'))? print(get_option('pppm_email_this_img')): print(PPPM_PATH.'img/email_link.png')?>" /> &nbsp; <img src="<?php (get_option('pppm_email_this_img'))? print(get_option('pppm_email_this_img')): print(PPPM_PATH.'img/email_link.png')?>" align="absmiddle" />
						</td>
						</tr>
						<tr>
						<td class="pppm_box_td">
							<?php _e( 'Link Type' ) ?>
						</td>
						<td class="pppm_box_th">
						<?php 
						if( get_option('pppm_email_link_type') == '' ){
							$pppm_email_type_check[0] = 'checked="checked"';
						}
						else{
							$pppm_email_type_check[get_option('pppm_email_link_type')] = 'checked="checked"';
						}
						?>
						&nbsp;<input type="radio" id="pppm_email_link_type_0" name="pppm_email_link_type" <?php echo $pppm_email_type_check[0] ?> value="0" />&nbsp;<label for="pppm_email_link_type_0"><?php _e( 'Text and Image' ) ?></label>
						&nbsp;&nbsp; <input type="radio" id="pppm_email_link_type_1" name="pppm_email_link_type" <?php echo $pppm_email_type_check[1] ?> value="1" />&nbsp;<label for="pppm_email_link_type_1"><?php _e( 'Text' ) ?></label>
						&nbsp;&nbsp; <input type="radio" id="pppm_email_link_type_2" name="pppm_email_link_type" <?php echo $pppm_email_type_check[2] ?> value="2" />&nbsp;<label for="pppm_email_link_type_2"><?php _e( 'Image' ) ?></label>
						</td>
						</tr>
						
						<tr>
						<td class="pppm_box_td">
							<?php _e( 'E-Mail Window' ) ?>
						</td>
						<td class="pppm_box_th" style="font-size:11px">
						&nbsp;Mail's mark or Site logo ( 60x40 ): <br /><input name="pppm_email_this_mark" size="50" value="<?php (get_option('pppm_email_this_mark'))? print(get_option('pppm_email_this_mark')): print(PPPM_PATH.'img/mark.png')?>" /> &nbsp; <img src="<?php (get_option('pppm_email_this_mark'))? print(get_option('pppm_email_this_mark')): print(PPPM_PATH.'img/mark.png')?>" align="absmiddle" /><br />
						&nbsp;Title:<br /><input name="upm_email_title" size="50" value="<?php (get_option('upm_email_title'))? print(stripslashes(get_option('upm_email_title'))): print("E-Mail this post to your friends")?>" /><br /><br />
						&nbsp;Other phrases:<br />
						&nbsp;<input name="upm_your_name" size="50" value="<?php (get_option('upm_your_name'))? print(stripslashes(get_option('upm_your_name'))): print("Your Name")?>" /><br />
						&nbsp;<input name="upm_your_email" size="50" value="<?php (get_option('upm_your_email'))? print(stripslashes(get_option('upm_your_email'))): print("Your E-Mail")?>" /><br />
						&nbsp;<input name="upm_friend_name" size="50" value="<?php (get_option('upm_friend_name'))? print(stripslashes(get_option('upm_friend_name'))): print("Friend's Name")?>" /><br />
						&nbsp;<input name="upm_friend_email" size="50" value="<?php (get_option('upm_friend_email'))? print(stripslashes(get_option('upm_friend_email'))): print("Friend's E-Mail")?>" /><br />
						&nbsp;<input name="upm_send" size="50" value="<?php (get_option('upm_send'))? print(stripslashes(get_option('upm_send'))): print("Send")?>" /><br />
						&nbsp;<input name="upm_wrong_email" size="50" value="<?php (get_option('upm_wrong_email'))? print(stripslashes(get_option('upm_wrong_email'))): print("Wrong E-Mail!")?>" /><br />
						&nbsp;<input name="upm_all_required" size="50" value="<?php (get_option('upm_all_required'))? print(stripslashes(get_option('upm_all_required'))): print("All fields are required !")?>" /><br />
						&nbsp;<input name="upm_success_message" size="50" value="<?php (get_option('upm_success_message'))? print(stripslashes(get_option('upm_success_message'))): print("Your Message has been sent successfully.<br/>Thank You !")?>" /><br />
						&nbsp;<input name="upm_alert_message" size="50" value="<?php (get_option('upm_alert_message'))? print(stripslashes(get_option('upm_alert_message'))): print("We are sorry but mail can not be sent !")?>" />
						</td>
						</tr>
						
						<tr>
						<td class="pppm_box_td">
							<?php _e( 'Email Content' ) ?><br /><br />
							<span style="color:#777777; font-weight:100; font-size:12px;">
							<?php _e( 'Do not change these [FRIEND-NAME] [LINK] [YOUR-NAME] [YOUR-EMAIL] variables in email content !' ) ?>
							</span>
						</td>
						<td class="pppm_box_th"> 
						<?php 
$pppm_email_content_text = 'Hi [FRIEND-NAME] !

I want to recommend this page to you 
[LINK]

[YOUR-NAME]
[YOUR-EMAIL]';
if(get_option('pppm_email_content')) {
	$pppm_email_content_text = stripslashes(get_option('pppm_email_content'));
}
						?>
						&nbsp;<textarea name="pppm_email_content" cols="55" rows="5"><?php echo $pppm_email_content_text ?></textarea>
						</td>
						</tr>
						<tr>
							<td class="pppm_box_td" colspan="2">
								<?php 
								if( get_option('pppm_email_screen_type') == '' ){
									$pppm_email_screen_check[1] = 'checked="checked"';
								}
								else{
									$pppm_email_screen_check[get_option('pppm_email_screen_type')] = 'checked="checked"';
								}
								?>
								<table width="100%">
								  <!-- 
                                  <tr>
									<td style="padding:10px;border:#CCCCCC 1px dotted;">&nbsp;<label for="pppm_email_screen_type_1">Screen Type #1</label> <input type="radio" id="pppm_email_screen_type_1" <?php echo $pppm_email_screen_check[1] ?> name="pppm_email_screen_type" value="1" /> </td>
									<td colspan="2" style="padding:10px;border:#CCCCCC 1px dotted;">&nbsp;<label for="pppm_email_screen_type_2">Screen Type #2</label> <input type="radio" id="pppm_email_screen_type_2" <?php echo $pppm_email_screen_check[2] ?> name="pppm_email_screen_type" value="2" /></td>
								  </tr>
								   -->
                                  <tr>
                                  	<!-- 
									<td align="center" style="padding:10px;border:#CCCCCC 1px dotted;">
									<img src="<?php echo PPPM_PATH.'img/email-screen-1.jpg' ?>"/>
									</td>
                                    -->
									<td colspan="2" align="center" style="padding:10px;border:#CCCCCC 1px dotted;">
									<img src="<?php echo PPPM_PATH.'img/email-screen-2.jpg' ?>" />
									</td>
								  </tr>
								  <tr>
									<!-- <td style="padding:10px;border:#CCCCCC 1px dotted;">Template file location:<br /> /universal-post-manager/template/email_screen_1.php</td> -->
									<td style="padding:10px;border:#CCCCCC 1px dotted;" colspan="2">Template file location:<br /> /universal-post-manager/template/email_screen_2.php </td>
								  </tr>
								   <tr>
									<td colspan="2" style="padding:10px;border:#CCCCCC 1px dotted;">
									 Put this code in template files wherever you want<br>
									 <code style="font-size: 15px; font-weight: bold; line-height:25px;"> &lt;?php upm_email() ?&gt; </code>
									 <br /><br />
									 If you want to include this link more then one time in same page , you should use this code:
									 <br />
									 <code style="font-size: 15px; font-weight: bold; line-height:25px;"> &lt;?php upm_email(1) ?&gt; </code>&nbsp;
									 <code style="font-size: 15px; font-weight: bold; line-height:25px;"> &lt;?php upm_email(2) ?&gt; </code>&nbsp;
									 <code style="font-size: 15px; font-weight: bold; line-height:25px;"> &lt;?php upm_email(3) ?&gt; </code> ... etc.
									</td>
								   </tr>
								</table>

							</td>
						</tr>
						<tr>
							<td colspan="2" class="pppm_box_th">
							<p class="submit">
							<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
							</p>
							</td>
						  </tr>
					</table>
				</form>
				<?php
				
			}break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
			case 'rss' : 
			{
				?>
				<form id="pppm_form_bookmarks" name="pppm_form_subscribe" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="pppm_hidden" value="pppm_feed">
					<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
						<tr>
						<td class="pppm_box_td" style="width:30%;">
							<?php _e( 'Link Type' ) ?>
						</td>
						<td class="pppm_box_th">
						<?php 
						if( get_option('pppm_subscribe_link_type') == '' ){
							$pppm_subscribe_link_type[0] = 'checked="checked"';
						}
						else{
							$pppm_subscribe_link_type[get_option('pppm_subscribe_link_type')] = 'checked="checked"';
						}
						?>
						&nbsp;<input type="radio" id="pppm_subscribe_link_type_0" name="pppm_subscribe_link_type" <?php echo $pppm_subscribe_link_type[0] ?> value="0" />&nbsp;<label for="pppm_subscribe_link_type_0"><?php _e( 'Text and Image' ) ?></label>
						&nbsp;&nbsp; <input type="radio" id="pppm_subscribe_link_type_1" name="pppm_subscribe_link_type" <?php echo $pppm_subscribe_link_type[1] ?> value="1" />&nbsp;<label for="pppm_subscribe_link_type_1"><?php _e( 'Text' ) ?></label>
						&nbsp;&nbsp; <input type="radio" id="pppm_subscribe_link_type_2" name="pppm_subscribe_link_type" <?php echo $pppm_subscribe_link_type[2] ?> value="2" />&nbsp;<label for="pppm_subscribe_link_type_2"><?php _e( 'Image' ) ?></label>
						</td>
						</tr>
					</table>
					<br />
					<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
						<tr>
						<td class="pppm_box_td" style="width:30%;">
							<strong><?php _e( 'Feed Type' ) ?></strong>
						</td>
						<td class="pppm_box_th">
							<strong><?php _e( 'Link Text' ) ?></strong>
						</td>
						<td class="pppm_box_th">
							<strong><?php _e( 'Link code' ) ?></strong>
						</td>
						</tr>
						<tr>
						<td class="pppm_box_td" style="width:30%;">
							<?php _e( 'RSS 0.92 feed' ) ?>
						</td>
						<td class="pppm_box_th">
						<input name="pppm_rss_092" size="30" value="<?php 
						(get_option('pppm_rss_092'))? print(get_option('pppm_rss_092')):print('Subscribe via RSS'); ?>" />
						</td>
						<td class="pppm_box_th">
							<code style="font-size: 15px; font-weight: bold; line-height:25px;">
							&lt;?php upm_subscribe('rss') ?&gt;
							</code>
						</td>
						</tr>
						<tr>
						<td class="pppm_box_td" style="width:30%;">
							<?php _e( 'RDF/RSS 1.0 feed' ) ?>
						</td>
						<td class="pppm_box_th">
						<input name="pppm_rss1" size="30" value="<?php 
						(get_option('pppm_rss1'))? print(get_option('pppm_rss1')):print('Subscribe via RSS'); ?>" />
						</td>
						<td class="pppm_box_th">
							<code style="font-size: 15px; font-weight: bold; line-height:25px;">
							&lt;?php upm_subscribe('rss1') ?&gt;
							</code>
						</td>
						</tr>
						<tr>
						<td class="pppm_box_td" style="width:30%;">
							<?php _e( 'RSS 2.0 feed' ) ?>
						</td>
						<td class="pppm_box_th">
						<input name="pppm_rss2" size="30" value="<?php 
						(get_option('pppm_rss2'))? print(get_option('pppm_rss2')):print('Subscribe via RSS'); ?>" />
						</td>
						<td class="pppm_box_th">
							<code style="font-size: 15px; font-weight: bold; line-height:25px;">
							&lt;?php upm_subscribe('rss2') ?&gt;
							</code>
						</td>
						</tr>
						<tr>
						<td class="pppm_box_td" style="width:30%;">
							<?php _e( 'Atom feed' ) ?>
						</td>
						<td class="pppm_box_th">
						<input name="pppm_atom" size="30" value="<?php 
						(get_option('pppm_atom'))? print(get_option('pppm_atom')):print('Subscribe via Atom'); ?>" />
						</td>
						<td class="pppm_box_th">
							<code style="font-size: 15px; font-weight: bold; line-height:25px;">
							&lt;?php upm_subscribe('atom') ?&gt;
							</code>
						</td>
						</tr>
					</table>
					
					<table width="100%" class="pppm_box_table" border="0" cellspacing="1">
						<tr>
						<td class="pppm_box_td" style="width:30%;">
							<strong><?php _e( 'RSS Feed Icons' ) ?></strong>
						</td>
						<td class="pppm_box_th">
							<?php 
							$pppm_rss_icon[get_option('pppm_rss_icon')] = 'checked="checked"';
							?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_rss_1"><img src="<?php echo PPPM_PATH ?>img/rss/rss_1.png" /></label>
								<br />
								<input id="pppm_rss_1" <?php echo $pppm_rss_icon[1] ?> type="radio" name="pppm_rss_icon" value="1" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_rss_2"><img src="<?php echo PPPM_PATH ?>img/rss/rss_2.png" /></label>
								<br />
								<input id="pppm_rss_2" <?php echo $pppm_rss_icon[2] ?> type="radio" name="pppm_rss_icon" value="2" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_rss_3"><img src="<?php echo PPPM_PATH ?>img/rss/rss_3.png" /></label>
								<br />
								<input id="pppm_rss_3" <?php echo $pppm_rss_icon[3] ?> type="radio" name="pppm_rss_icon" value="3" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_rss_4"><img src="<?php echo PPPM_PATH ?>img/rss/rss_4.png" /></label>
								<br />
								<input id="pppm_rss_4" <?php echo $pppm_rss_icon[4] ?> type="radio" name="pppm_rss_icon" value="4" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_rss_5"><img src="<?php echo PPPM_PATH ?>img/rss/rss_5.png" /></label>
								<br />
								<input id="pppm_rss_5" <?php echo $pppm_rss_icon[5] ?> type="radio" name="pppm_rss_icon" value="5" />
								</td>
							  </tr>
							  <tr>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_rss_6"><img src="<?php echo PPPM_PATH ?>img/rss/rss_6.png" /></label>
								<br />
								<input id="pppm_rss_6" <?php echo $pppm_rss_icon[6] ?> type="radio" name="pppm_rss_icon" value="6" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_rss_7"><img src="<?php echo PPPM_PATH ?>img/rss/rss_7.png" /></label>
								<br />
								<input id="pppm_rss_7" <?php echo $pppm_rss_icon[7] ?> type="radio" name="pppm_rss_icon" value="7" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_rss_8"><img src="<?php echo PPPM_PATH ?>img/rss/rss_8.png" /></label>
								<br />
								<input id="pppm_rss_8" <?php echo $pppm_rss_icon[8] ?> type="radio" name="pppm_rss_icon" value="8" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_rss_9"><img src="<?php echo PPPM_PATH ?>img/rss/rss_9.png" /></label>
								<br />
								<input id="pppm_rss_9" <?php echo $pppm_rss_icon[9] ?> type="radio" name="pppm_rss_icon" value="9" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_rss_10"><img src="<?php echo PPPM_PATH ?>img/rss/rss_10.png" /></label>
								<br />
								<input id="pppm_rss_10" <?php echo $pppm_rss_icon[10] ?> type="radio" name="pppm_rss_icon" value="10" />
								</td>
							  </tr>
							  <tr>
								<td align="left" colspan="5">
									<br />
									Custom Icon's URL &nbsp;<input type="text" name="pppm_rss_icon_custom" size="50" value="<?php print(get_option('pppm_rss_icon_custom')); ?>"/>
								</td>
							  </tr>
							</table>
						</td>
						</tr>
						<tr>
						<td class="pppm_box_td" style="width:30%;">
							<strong><?php _e( 'Atom Feed Icons' ) ?></strong>
						</td>
						<td class="pppm_box_th">
							<?php 
							$pppm_atom_icon[get_option('pppm_atom_icon')] = 'checked="checked"';
							?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_atom_1"><img src="<?php echo PPPM_PATH ?>img/rss/atom_1.png" /></label>
								<br />
								<input id="pppm_atom_1" <?php echo $pppm_atom_icon[1] ?> type="radio" name="pppm_atom_icon" value="1" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_atom_2"><img src="<?php echo PPPM_PATH ?>img/rss/atom_2.png" /></label>
								<br />
								<input id="pppm_atom_2" <?php echo $pppm_atom_icon[2] ?> type="radio" name="pppm_atom_icon" value="2" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_atom_3"><img src="<?php echo PPPM_PATH ?>img/rss/atom_3.png" /></label>
								<br />
								<input id="pppm_atom_3" <?php echo $pppm_atom_icon[3] ?> type="radio" name="pppm_atom_icon" value="3" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_atom_4"><img src="<?php echo PPPM_PATH ?>img/rss/atom_4.png" /></label>
								<br />
								<input id="pppm_atom_4" <?php echo $pppm_atom_icon[4] ?> type="radio" name="pppm_atom_icon" value="4" />
								</td>
								<td align="center" style="width:20%; vertical-align:bottom;">
								<label for="pppm_atom_5"><img src="<?php echo PPPM_PATH ?>img/rss/atom_5.png" /></label>
								<br />
								<input id="pppm_atom_5" <?php echo $pppm_atom_icon[5] ?> type="radio" name="pppm_atom_icon" value="5" />
								</td>
							  </tr>
							  <tr>
								<td align="left" colspan="5">
									<br />
									Custom Icon's URL &nbsp;<input type="text" name="pppm_atom_icon_custom" size="50" value="<?php print(get_option('pppm_atom_icon_custom')); ?>"/>
								</td>
							  </tr>
							</table>
						
						</td>
						</tr>
						<tr>
						<td colspan="3" class="pppm_box_th">
						<br />
						<p class="submit">
						<input type="submit"  class="button button-primary" name="Submit" value="<?php _e( 'Update Options' ) ?>" />
						</p>
						</td>
						</tr>
					</table>
				</form>
				<?php
				
			}break ;
			////////////////////////////////////////////////////////////////////////////////////////////
			//////// CBOX //////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
		}
		
	}
	####################################################################################################
	#######  PAGE  #####################################################################################
	####################################################################################################
}

?>
			