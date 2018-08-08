<?php

$defaults = array(
    'build_query' => '',
    'posts_per_line' => '1',
    'view_type' => 'type_1'
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

?>
<div class="vc_row">
    <div class="vc_col-sm-12 module_partners <?php echo $view_type; ?>">
    	<div class="sponsors_works items<?php echo $posts_per_line; ?>">
        	<ul>
            	<?php
                    list($query_args, $build_query) = vc_build_loop_query($build_query);

                    $gt3_posts = new WP_Query($query_args);

                    if ($gt3_posts->have_posts()) {
                        while ($gt3_posts->have_posts()) {
                            $gt3_posts->the_post();
							
							$gt3_theme_pagebuilder = get_post_meta(get_the_ID(), "pagebuilder", true);
							$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
							if (strlen($featured_image[0]) > 0) {
								$featured_image_url = $featured_image[0];
							} else {
								$featured_image_url = "";
							}
							$partners_url = (isset($gt3_theme_pagebuilder['page_settings']['partners']['partners_link']) ? $gt3_theme_pagebuilder['page_settings']['partners']['partners_link'] : "");
							
							$compile .= '
							<li>
								<div class="item_wrapper">
									<div class="item">
										' . (strlen($partners_url) > 0 ? "<a href='{$partners_url}' target='_blank'>" : "") . '<img src="' . $featured_image_url . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" />' . (strlen($partners_url) > 0 ? "</a>" : "") . '
									</div>
								</div>
							</li>';
                        }
						wp_reset_postdata();
                    }
                    echo $compile;
            	?>
            </ul>
        </div>
    </div>
</div>
