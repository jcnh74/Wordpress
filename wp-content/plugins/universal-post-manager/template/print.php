<?php 
$print = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>'. $print_title.' : '. get_option('blogname') .' : '.get_option('siteurl').'</title>
<meta http-equiv="Content-Type" content="text/html; charset='.get_option('blog_charset').'" />
<style media="print" type="text/css">
#hidden_{
	display:none;
}
'.get_option('pppm_print_css').'
</style>
<style media="all" type="text/css">
'.get_option('pppm_print_css').'
img{
	border:hidden;
	padding:10px;
}
.alignleft {
    float: left;
}
.alignright {
    float: right;
}
.aligncenter {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>
</head>
<body>
<div align="center">
<table width="595" style="width:595px;text-align:'.get_option('pppm_save_text_align').'" border="0"  bgcolor="#FFFFFF" cellspacing="1" cellpadding="5" >
  <tr>
    <td  bgcolor="#FFFFFF" style="font-size:12px; color:#000000;">
	'.$pt_header.'
	</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="font-size:14px; color:#000000;">
	'.$pt_title.'
	'.$print_body.'
	</td>
  </tr>
  <tr>
    <td  bgcolor="#FFFFFF" style="font-size:13px; color:#000000;">
	'.$pt_excerpt.'
	</td>
  </tr>
  <tr>
    <td  bgcolor="#FFFFFF" style="font-size:13px; color:#000000;">
	'.$pt_links.'
	</td>
  </tr>
  <tr>
    <td  bgcolor="#FFFFFF" style="font-size:13px; color:#000000;">
	'.$pt_date.'
	'.$pt_md_date.'
	</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="font-size:12px; color:#000000">
	 <div id="hidden_" align="right">
	 <a href="javascript:window.print()">
	 <img src="'.PPPM_PATH.'img/'.get_option( 'pppm_save_print_icon_url').'" style="border:#999999 solid 1px;" align="Print this Post" title="Print this Post"/></a>
	 </div>
	</td>
  </tr>
  <tr>
    <td  bgcolor="#FFFFFF" style="font-size:12px; color:#000000;">
	'.$pt_footer.'
	</td>
  </tr>
</table>
</div><br>
</body>
</html>';

?>