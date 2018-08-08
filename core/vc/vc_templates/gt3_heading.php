<?php
$defaults = array(
    'title' => '',
	'heading_tag' => 'h1',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

?>

<<?php echo $heading_tag; ?> class="gt3_content_heading"><?php echo $title; ?></<?php echo $heading_tag; ?>>