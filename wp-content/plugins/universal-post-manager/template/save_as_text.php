<?php 

$txt = "This page was exported from ".get_option('blogname')." [ ".get_option('siteurl')." ]\r\n
Export date:". date("D M j G:i:s Y / O ") ."GMT\r\n
___________________________________________________
\r\n
Title: ". $txt_title."\r\n
---------------------------------------------------
\r\n
".$txt_body."\r\n
---------------------------------------------------
\r\n
Images: ".$txt_img."\r\n
---------------------------------------------------
\r\n
".(($txt_excerpt)?'<strong>Excerpt:</strong> '.$txt_excerpt:'')."\r\n
---------------------------------------------------
\r\n
Post date: ".$txt_post_date."\r\n
Post date GMT: ".$txt_post_date_gmt."\r\n
Post modified date: ".$txt_modified_date."\r\n
Post modified date GMT: ".$txt_modified_date_gmt."\r\n
\r\n
____________________________________________________________________________________________
\r\n
Export of Post and Page as text file has been powered by [ Universal Post Manager ] plugin from www.gconverters.com";

?>