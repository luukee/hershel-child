<?php

$defaults = array(
    'build_query' => '',
    'view_type' => 'type_1',
    'posts_per_line' => '1',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

?>
<div class="vc_row">
    <div class="vc_col-sm-12 module_testimonial">
    	<div class="module_content testimonials_list items<?php echo $posts_per_line; ?> <?php echo $view_type; ?>">
            <ul>
				<?php
                list($query_args, $build_query) = vc_build_loop_query($build_query);

                $gt3_posts = new WP_Query($query_args);

                if ($gt3_posts->have_posts()) {
                    while ($gt3_posts->have_posts()) {
                        $gt3_posts->the_post();
						
						$gt3_theme_pagebuilder = get_post_meta(get_the_ID(), "pagebuilder", true);
						
						$testimonials_author = $gt3_theme_pagebuilder['page_settings']['testimonials']['testimonials_author'];
						$testimonials_company = $gt3_theme_pagebuilder['page_settings']['testimonials']['company'];
						$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
						
						if ($view_type == "type_2") {
							$compile .= '
							<li>
								<div class="item with_icon">
									<div class="testimonial_item_wrapper ' . (strlen($featured_image[0]) > 0 ? "" : "no_photo_thumb") . '">										
										' . (strlen($featured_image[0]) > 0 ? "<div class=\"testimonials_photo\"><img src='" . aq_resize($featured_image[0], "50", "50", true, true, true) . "' /></div>" : "") . '
										<h5 class="testimonials_title">' . $testimonials_author . '</h5>                                                        
										<div class="testimonials_text">
											<p>' . get_the_content() . '</p>                                                            
										</div>											  
									</div>
								</div>
							</li>';
						} else {
							$compile .= '
							<li>
								<div class="item with_icon">
									<div class="testimonial_item_wrapper">										
										<div class="testimonials_photo"><i class="fa fa-quote-left"></i></div>                                                        
										<div class="testimonials_text">
											<p>' . get_the_content() . '</p>                                                            
										</div> 
										<h5 class="testimonials_title">' . $testimonials_author . '<span>' . $testimonials_company . '</span></h5>
									</div>
								</div>
							</li>';
						}						
                	}
					wp_reset_postdata();
                }
                echo $compile;
                ?>        
            </ul>
        </div>
    </div>
</div>