<?php 
$file = trim( str_replace( ' ', '-' , $xml_title ) );
header('Content-Description: XML Output');
header("Content-Disposition: attachment; filename=".$file.".xml");
header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="' . get_bloginfo('charset') . '"?' . ">\n"; 
?>

<upm-export>
	<title><?php bloginfo_rss('name'); ?></title>
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php bloginfo_rss("description") ?></description>
	<pubDate><?php echo date("D M j G:i:s Y / O ") .' GMT'; ?></pubDate>
	<generator>Universal Post Manager 1.1.2 [ www.ProfProjects.com ] </generator>
	<language><?php echo get_option('rss_language'); ?></language>
	
		<?php 
		global $wpdb;
		?>
	<item>
			<title><?php echo $xml_title; ?></title>
			<link><?php echo $xml_link ?></link>
			<pubDate><?php echo date("D M j G:i:s Y / O ") .' GMT'; ?></pubDate>
			<guid isPermaLink="false"><?php echo $xml_link; ?></guid>
			<content-encoded><![CDATA[<?php echo $xml_body; ?>]]></content-encoded>
			<excerpt-encoded><![CDATA[<?php echo $xml_excerpt; ?>]]></excerpt-encoded>
			<wp-post_id><?php echo $post_id; ?></wp-post_id>
			<wp-post_date><?php echo $post->post_date; ?></wp-post_date>
			<wp-post_date_gmt><?php echo $post->post_date_gmt; ?></wp-post_date_gmt>
			<?php
			if ($post->post_type == 'attachment') { ?>
			<wp-attachment_url><?php echo wp_get_attachment_url($post->ID); ?></wp-attachment_url>
			<?php } ?>
	</item>
</upm-export>
