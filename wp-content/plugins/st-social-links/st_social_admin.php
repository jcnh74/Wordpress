<?php
add_action( 'plugins_loaded', 'st_social_link_load_textdomain' );
function st_social_link_load_textdomain() {
	load_plugin_textdomain('stsociallinks', false,  dirname( plugin_basename( __FILE__ ) ) . "/language/");
}

$networks = array('facebook' => 'Facebook',
                 'twitter'=> 'Twitter',
				 'googleplus'=>'Google Plus', 
				 'linkedin'=>'Linked In',
				 'youtube'=>'You Tube',
				 'instagram'=>'Instagram',
				 'pinterest'=>'Pinterest',
				 'tumblr'=>'Tumblr',
				 'myspace'=>'MySpace',
				 'netlog'=>'Netlog',
				 'hi5'=>'Hi5',
				 'friendster'=>'Friendster',
 				 'bebo'=>'Bebo',
				 'flickr'=>'Flickr',
				 'sinaweibo'=>'Sina Weibo',
				 'vkontakte'=>'Vkontakte',
				 'odnoklassniki'=>'Odnoklassniki',
				 'renren'=>'Renren',
				'livejournal'=>'LiveJournal',
				'deviantart'=>'DeviantArt',
				'stumbleupon'=>'StumbleUpon',
				'tagged'=>'Tagged',
				'meetup'=>'Meetup',
				'cloob'=>'Cloob',
				'werkenntwen'=>'Wer-kennt-wen',
				'hyves'=>'Hyves'
				 );
				 
$icon_images = array("facebook"  => array("facebook_30","facebook_32","facebook_48","facebook_48_grey","facebook_64"),
                     "twitter"   => array("twitter_30","twitter_32","twitter_48","twitter_48_grey","twitter_64"),
					 "googleplus" => array("googleplus_30","googleplus_32","googleplus_48","googleplus_48_grey","googleplus_64"),
					 "linkedin" => array("linkedin_30","linkedin_32","Linkedin_48","Linkedin_48_grey","linkedin_64"),
					 "youtube" => array("youtube_30","youtube_32","youtube_48","youtube_48_grey","youtube_64"),
					 "instagram" => array("insta_30","insta_32","insta_48","insta_48_grey","insta_64"),
					 "pinterest" => array("pinterest_30","pinterest_32","pinterest_48","pinterest_48_grey","pinterest_64"),
					 "tumblr" => array("Tumblr_30","Tumblr_32","Tumblr_48","Tumblr_48_grey","Tumblr_64"),
					 "myspace" => array("myspace_30","myspace_32","myspace_48","myspace_48_grey","myspace_64"),
					 "netlog" => array("netlog_30","netlog_32","netlog_48","netlog_48_grey","netlog_64"),
					 "hi5" => array("hi5_30","hi5_32","hi5_48","hi5_48_grey","hi5_64"),
					 "friendster" => array("friendster_30","friendster_32","friendster_48","friendster_48_grey","friendster_64"),
					 "bebo" => array("bebo_30","bebo_32","bebo_48","bebo_48_grey","bebo_64"),
					 "flickr" => array("flickr_30","flickr_32","flickr_48","flickr_48_grey","flickr_64"),
					 "sinaweibo" => array("weibo_30","weibo_32","weibo_48","weibo_48_grey","weibo_64"),
					 "vkontakte" => array("vkontakte_30","vkontakte_32","vkontakte_48","vkontakte_48_grey","vkontakte_64"),
					 "odnoklassniki" => array("Odnoklassniki_30","Odnoklassniki_32","Odnoklassniki_48","Odnoklassniki_48_grey","Odnoklassniki_64"),
					 "renren" => array("Renren_30","Renren_32","Renren_48","Renren_48_grey","Renren_64"),
					 "livejournal" => array("LiveJournal_30","LiveJournal_32","LiveJournal_48","LiveJournal_48_grey","LiveJournal_64"),
					 "deviantart" => array("DeviantArt_30","DeviantArt_32","DeviantArt_48","DeviantArt_48_grey","DeviantArt_64"),
					 "stumbleupon" => array("StumbleUpon_30","StumbleUpon_32","StumbleUpon_48","StumbleUpon_48_grey","StumbleUpon_64"),
					 "tagged" => array("Tagged_30","Tagged_32","Tagged_48","Tagged_48_grey","Tagged_64"),
					 "meetup" => array("Meetup_30","Meetup_32","Meetup_48","Meetup_48_grey","Meetup_64"),
					 "cloob" => array("Cloob_30","Cloob_32","Cloob_48","Cloob_48_grey","Cloob_64"),
					 "werkenntwen" => array("Wer-kennt-wen_30","Wer-kennt-wen_32","Wer-kennt-wen_48","Wer-kennt-wen_48_grey","Wer-kennt-wen_64"),
					 "hyves" => array("Hyves_30","Hyves_32","Hyves_48","Hyves_48_grey","Hyves_64"));

add_action('admin_menu', 'social_link_admin_menu');
function social_link_admin_menu() 
{
	$page = add_menu_page( 'Social Link Page', 'Social Link', 'manage_options','social-link','social_link_option_page', plugins_url( 'st-social-links/images/icon.png' ));
	wp_register_style('stylesocial.css',WP_SOCIAL_LINK_URL.'/css/stylesocial.css');
	wp_enqueue_style('stylesocial.css');
}
function set_option($option_name,$new_value)
{
	//option exists?
	if ( !get_option( $option_name )) {
		//add if not exists
		add_option( $option_name, $new_value);
	} else {
		//update if exists
		update_option( $option_name, $new_value );
	}
}

?>
<?php
function social_link_option_page() {
	global $networks;
	
	?>
	<script>
		function showimages(){
			var social_network = document.getElementById("social_network").value;
			//first hide all
			<?php
				foreach($networks as $k => $v)
				{	echo "document.getElementById('".$k."').style.display='none';";	}
			?>
			//show the required div
  		    document.getElementById(social_network).style.display="block";
		}
	</script>
	<?php
		$social_network = $_REQUEST["social_network"];
		$social_link_url = $_REQUEST["social_link_url"];
		$img_link = plugins_url('images/'. $_REQUEST["img_link"] .'.png',__FILE__);
		
		global $wpdb;
		global $table_suffix;
		$table_suffix = "sociallink";
		$table_name = $wpdb->prefix . $table_suffix;
		$edit_id = "";
		//Edit
		if (isset($_REQUEST['Submit']) && $_REQUEST['edit_id']!="") {
			
			$qry = "UPDATE $table_name SET social_network = '" . $social_network . "',social_link_url='" . $social_link_url . "', img_link='" . $img_link . "' WHERE id = " . $_REQUEST['edit_id'];
			$wpdb->query($qry);
			echo "<div id=\"message\" class=\"updated fade\"><p><strong>Social Link Updated Successfully!</strong></p></div>";
		}
		// Insert
		if (isset($_REQUEST['Submit']) && $_REQUEST['edit_id']==""  ) {
			$rows_affected = $wpdb->insert( $table_name, array( 'social_network' => $social_network, 'social_link_url' => $social_link_url, 'img_link' => $img_link) );
			echo "<div id=\"message\" class=\"updated fade\"><p><strong>Social Link Inserted Successfully!</strong></p></div>";
		}
		//delete
		if ($_GET["action"]=="delete")
		{
			$wpdb->query("DELETE FROM $table_name WHERE id = " .$_GET["social_link"]);
			echo "<div id=\"message\" class=\"updated fade\"><p><strong>Social Link Deleted Successfully!</strong></p></div>";
		}
		//edit
		if ($_GET["action"]=="edit")
		{
			$edit_id = $_GET["social_link"];
			$edit_data = $wpdb->get_row("SELECT * FROM $table_name where id = $edit_id");
			$edit_social_network = $edit_data->social_network;
			$edit_social_link_url = $edit_data->social_link_url;
			$edit_img_link = $edit_data->img_link;
			
		}
		//is display option set
		if (isset($_REQUEST['DisplayOption']))
		{
			$settings = $_REQUEST['display_option'];
			set_option('st_social_link_header',$settings);
		}
		
	?>
	
	<div class="wrap">
		<h2><?php _e('Social Plugin','stsociallinks')?></h2>
			<div class="postbox-container" style="width:70%;padding-right:20px;">
				<div class="metabox-holder">
					<div class="meta-box-sortables">
						<div class="postbox"><div class="handlediv" title="Click to toggle"><br/></div>
							<div class="meta-box-sortables ui-sortable">
								<h3 class="hndle"><span><?php _e('Add / Edit','stsociallinks')?></span></h3>
								<div class="inside">
									<form id="add_social_link" action="<?php echo $_SERVER['PHP_SELF']."?page=social-link"; ?>" method="post">
										<input type="hidden" name="edit_id" value="<?=$edit_id?>" />	
										<select id="social_network" name="social_network" onchange="showimages();">
											<option value="" ></option>
											<?php 
												global $networks;
												foreach($networks as $k => $v)
												{
													$selected = '';
													if ($_GET["action"]=="edit" && $edit_social_network == $k) 
													{$selected = 'selected="selected"';} 
													echo "<option value='" .$k. "' $selected >".$v."</option>";
												}
											?>
										</select>
										<label><?php _e('Link','stsociallinks')?></label>
										<input type="text" name="social_link_url" class="regular-text" value="<?=$edit_social_link_url?>"/>
										<?php
											global $networks;
											global $icon_images;
											foreach($networks as $k => $v)
											{
												$style = 'style="display:none;"';
												if ($_GET["action"]=="edit" && $edit_social_network == $k) 
												{$style = 'style="display:block;"';}
												echo "<div id='$k' class='icon_all_img' $style>";
													foreach($icon_images[$k] as $icon)
													{
														$checked = '';
														if ($_GET["action"]=="edit" && strpos($edit_img_link,$icon) > 0) 
														{$checked = 'checked="checked"';} 
														echo "<div class='icon_image'>";
														echo "<input type='radio' name='img_link' value='$icon' $checked>";
														echo "<img src=" . plugins_url('images/' . $icon .'.png',__FILE__). " \>";
														echo "</div>";
													}
												echo "</div>";
											}
										?>
										
										<input class="button-primary" type="submit" name="Submit" value="Submit" />
									</form>
								</div>
							</div>
						</div>
						<div class="postbox"><div class="handlediv" title="Click to toggle"><br/></div>
							<div class="meta-box-sortables ui-sortable">
								<h3 class="hndle"><span><?php _e('Links','stsociallinks')?></span></h3>
									<div class="inside">
										<form id="link_table" method="get">
											<input type="hidden" name="page" value="<?=$_REQUEST['page'];?>" />
											<table>
												<thead>
													<tr>
														<td style="width:100px;">Network</td>
														<td style="width:100px;">Image</td>
														<td style="width:300px;">URL</td>
														<td style="width:100px;">Actions</td>
													</tr>
												</thead>
												<tbody>
													<?php $links = $wpdb->get_results("SELECT * FROM $table_name");?>
													<?php foreach ($links as $link) {?>
														<tr>
															<td><?=$networks[$link->social_network];?></td>
															<td><img src="<?=$link->img_link;?>"/></td>
															<td><a href="<?=$link->social_link_url;?>" ><?=$link->social_link_url;?></a></td>
															<td><a href="?page=<?=$_REQUEST['page'];?>&action=edit&social_link=<?=$link->id;?>">Edit</a> | 
																<a href="?page=<?=$_REQUEST['page'];?>&action=delete&social_link=<?=$link->id;?>">Delete</a></td>
														</tr>
													<?php }?>
												</tbody>
												<tfoot></tfoot>
											</table>
										</form>
									</div>
								</div>
						</div>
					</div>		
				</div>	
			</div>
			
			<div class="postbox-container side" style="width:20%;">
				<div class="metabox-holder">
					<div class="meta-box-sortables">	
						<div id="toc" class="postbox">
							<div class="handlediv" title="Click to toggle"><br /></div>
							<h3 class="hndle"><span><?php _e('How to Use','stsociallinks')?></span></h3>
							<div class="inside">
								<ol>
									<li><strong><?php _e('Add Social Links','stsociallinks')?></strong></li>
									<li><strong><?php _e('Add Social Link Widget','stsociallinks')?></strong></li>
									<?php _e('or','stsociallinks')?>
									<li><strong><?php _e('Use Short Code','stsociallinks')?> <code>[stsociallink]</code></strong></li>
									<?php _e('or','stsociallinks')?>
									<li><strong><?php _e('Use PHP Code','stsociallinks')?></strong><br/>
										<code>
											&lt;?php
											if (function_exists('add_social_link')) {
												print add_social_link('[stsociallink]');
											}
											?&gt;
										</code>
									</li>
								</ol>
							</div>
						</div>
						<div id="toc" class="postbox">
							<div class="handlediv" title="Click to toggle"><br /></div>
							<h3 class="hndle"><span><?php _e('Show your Support','stsociallinks')?></span></h3>
							<div class="inside">
								<p><strong><?php _e('Want to help make this plugin even better? All donations are used to improve this plugin, so donate now!','stsociallinks')?></strong></p>
								<a href="http://sanskrutitech.in/wordpress-plugins/st-social-links/"><?php _e('Donate','stsociallinks')?></a>
								<p><?php _e('Or you could:','stsociallinks')?></p>
								<ul>
									<li><a href="http://wordpress.org/extend/plugins/st-social-links/"><?php _e('Rate the plugin 5 star on WordPress.org','stsociallinks')?></a></li>
									<li><a href="http://wordpress.org/support/plugin/st-social-links"><?php _e('Help out other users in the forums','stsociallinks')?></a></li>
									<li><?php _e('Blog about it &amp; link to the','stsociallinks')?> <a href="http://sanskrutitech.in/wordpress-plugins/st-social-links/"><?php _e('plugin page','stsociallinks')?></a></li>
								</ul>
							</div>
						</div>
						<div id="toc" class="postbox">
							<div class="handlediv" title="Click to toggle"><br/></div>
							<h3 class="hndle"><span><?php _e('Connect With Us','stsociallinks')?> </span></h3>
							<div class="inside">
								<a class="facebook" href="https://www.facebook.com/sanskrutitech"></a>
								<a class="twitter" href="https://twitter.com/#!/sanskrutitech"></a>
								<a class="googleplus" href="https://plus.google.com/107541175744077337034/posts"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
	<?php
}
?>