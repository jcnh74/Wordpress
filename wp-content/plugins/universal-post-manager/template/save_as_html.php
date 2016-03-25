<?php 
$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset='.get_option('blog_charset').'" />
<title>'. $html_title.' : '. get_option('blogname') .' : '.get_option('siteurl').'</title>
<style type="text/css">
'.get_option('pppm_save_html_css').'
</style>
</head>
<body>
<div align="center">
<table width="700" border="0"  bgcolor="#CCCCCC" cellspacing="1" cellpadding="5" style="text-align:'.get_option('pppm_save_text_align').'">
  <tr>
    <td bgcolor="#F9F9F9" style="font-size:12px; color:#666666; text-align:'.get_option('pppm_save_text_align').';">
	This page was exported from '.get_option('blogname').' 
	[ <a href="'.get_option('siteurl').'" target="_blank">'.get_option('siteurl').'</a> ]<br> 
	Export date: '. date("D M j G:i:s Y / O ") .' GMT
	</td>
  </tr>
  <tr>
    <td bgcolor="#FDFDFD" style="font-size:14px; color:#666666; text-align:'.get_option('pppm_save_text_align').';">
	'. $html_t_title.'
	'.$html_body.'
	</td>
  </tr>
  <tr>
    <td  bgcolor="#F9F9F9" style="font-size:13px; color:#666666; text-align:'.get_option('pppm_save_text_align').';">
	'.$html_t_excerpt.'
	</td>
  </tr>
  <tr>
    <td  bgcolor="#F9F9F9" style="font-size:13px; color:#666666; text-align:'.get_option('pppm_save_text_align').';">
	'.$html_t_date.'
	'.$html_t_md_date.'
	</td>
  </tr>
  <tr>
    <td  bgcolor="#F9F9F9" style="font-size:12px; color:#666666; text-align:'.get_option('pppm_save_text_align').';">
	Powered by [ Universal Post Manager ] plugin. HTML saving format developed by gVectors Team
	<a href="http://www.gvectors.com" target="_blank">www.gVectors.com</a>
	</td>
  </tr>
</table>
</div><br>
</body>
</html>';

?>