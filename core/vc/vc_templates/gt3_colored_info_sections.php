<?php

$defaults = array(
    'container_layout' => 'wall',
    'alignment' => 'center',
    'posts_per_line' => '1',
	'el_class' => ''
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

?>

<?php
	// Layout
	if($container_layout == 'wall') {
		$block_layout = 'fw_block wall_wrap';
	} else {
		$block_layout = 'grid';
	}
		
	$compile .= '<div class="' . $block_layout . ' colored_sections items' . $posts_per_line . ' ' . $el_class . '">';
	$compile .= '<div class="vc_row" style="text-align:' . $alignment . '">';
	$compile .= do_shortcode($content);        
	$compile .= '</div>';
	$compile .= '</div>';
	echo $compile;		
?>
    