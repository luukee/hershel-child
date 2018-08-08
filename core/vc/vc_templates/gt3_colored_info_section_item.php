<?php

$defaults = array(
    'list_title' => '',
	'section_bg_color' => '',
	'text_color' => '',	
	'info_list_link_apply' => 'no-button',
	'button_title' => '',
	'info_list_link' => '',
	'icon_position' => 'left',
	'icon' => '',
	'item_el_class' => ''
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';	
?>

<?php
	// Button Settings
	if ($info_list_link_apply == 'show-button') {
		$info_list_link_temp = vc_build_link($info_list_link);
		$url = $info_list_link_temp['url'];
		$link_title = $info_list_link_temp['title'];
		$target = $info_list_link_temp['target'];
		if($url !== '') {
			$url = $url;
		} else {
			$url = '#';
		}		
		if($link_title !== '') {
			$link_for_button = 'title="' . $link_title . '"';
		} else {
			$link_for_button = '';
		}
		if($target !== '') {
			$button_target = 'target="' . $target . '"';
		} else {
			$button_target = '';
		}
		
		// Button Icon
		if($icon !== '' && $icon !== 'none') {
			$button_icon = '<i class="' . $icon . '"></i>';
		} else {
			$button_icon = '';
		}
		
		// Only Icon
		if($button_title == '') {
			$only_icon = 'only_icon';
		} else {
			$only_icon = '';
		}
		
		if ($button_icon !== '' || $button_title !== '') {
			// Icon Position
			if($icon_position == 'left') {
				$info_list_link_html = '<a class="shortcode_button btn_normal btn_type4 icon_pos_'.$icon_position.' '.$only_icon.'" href="'.$url.'" '.$link_for_button.' '.$button_target.'>' . $button_icon . '' . $button_title . '</a>';
			} else {
				$info_list_link_html = '<a class="shortcode_button btn_normal btn_type4 icon_pos_'.$icon_position.' '.$only_icon.'" href="'.$url.'" '.$link_for_button.' '.$button_target.'>' . $button_title . '' . $button_icon . '</a>';
			}
		} else {
			$info_list_link_html = '';
		}
				
	} else {
		$info_list_link_html = '';
	}
	// Button Settings (End)
	
	// Background-color
	if($section_bg_color !== '') {
		$section_bg_color = $section_bg_color;
	} else {
		$section_bg_color = '#000000';
	}
	
	// Text-color
	if($text_color !== '') {
		$text_color = $text_color;
	} else {
		$text_color = '#ffffff';
	}

	$compile .= '<div class="colored_section ' . $item_el_class . '" style="background-color:' . $section_bg_color . '">';
	if($list_title !== '') {
		$compile .= '<h2 style="color:' . $text_color . '">' . $list_title . '</h2>';
	}
	if($content !== '') {	
		$compile .= '<span class="cont_info" style="color:' . $text_color . '">' . wpb_js_remove_wpautop($content, true) . '</span>';
	}
	$compile .= '' . $info_list_link_html . '';
	$compile .= '</div>';
	
	echo $compile;		
?>
    
