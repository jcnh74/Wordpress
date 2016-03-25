<?php 

function ebor_tooltip( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'location' => 'top',
		'title' => 'Tooltip on top',
		'link' => '#'
	), $atts));	
	
	return '<a href="#" title="'. $title .'" data-rel="tooltip" data-placement="' . $location . '">' . $content . '</a>';
}
add_shortcode('tooltip', 'ebor_tooltip');

//Button [button link='google.com' size='large' color='blue' target='blank']Link Text[/button]
function ebor_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '',
		'size' => '',
		'color' => 'blue',
		'target' => ''
	), $atts));
	if($size == 'large') $size = 'btn-large';
	if($target == 'blank') $target = 'target="_blank"';
    return '<a href="' . esc_url($link) . '" '.$target.' class="btn '.$size.' btn-'.$color.'">' . $content . '</a>';
}
add_shortcode('button', 'ebor_button');

//DROPCAP [dropcap]Content[/dropcap]
function ebor_dropcap( $atts, $content = null ) {
   return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'ebor_dropcap');

//BLOCKQUOTE [blockquote author='John Doe']Content[/blockquote]
function ebor_blockquote( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'author' => ''
	), $atts));
   return '<blockquote>' . do_shortcode($content) . '<small>'.$author.'</small></blockquote>';
}
add_shortcode('blockquote', 'ebor_blockquote');

//BREAK [break]
function ebor_break( $atts, $content = null ) {
   return '<div style="width: 100%; clear: both; height: 40px;"></div><hr /><div style="width: 100%; clear: both; height: 60px;"></div>';
}
add_shortcode('break', 'ebor_break');

//CLEAR [clear]
function ebor_clear( $atts, $content = null ) {
   return '<div class="divide20"></div>';
}
add_shortcode('clear', 'ebor_clear');

//HIGHLIGHT [highlight]Content[/highlight]
function ebor_highlight( $atts, $content = null ) {
   return '<span class="lite">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight', 'ebor_highlight');