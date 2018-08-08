<?php

$defaults = array(
    'build_query' => '',
    'posts_per_line' => '1',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

?>
<div class="vc_row">
    <div class="vc_col-sm-12 featured_posts">
        <div class="featured_items">
            <div class="items<?php echo $posts_per_line; ?>">
                <ul class="item_list">
                    <?php
                    list($query_args, $build_query) = vc_build_loop_query($build_query);

                    $gt3_posts = new WP_Query($query_args);

                    if ($gt3_posts->have_posts()) {
                        while ($gt3_posts->have_posts()) {
                            $gt3_posts->the_post();

                            $post_excerpt = (gt3_smarty_modifier_truncate(get_the_excerpt(), 70));
                            $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                            if (strlen($wp_get_attachment_url)) {
								if ($posts_per_line == "4") {
									$gt3_featured_image_url = aq_resize($wp_get_attachment_url, "270", "185", true, true, true);
								}
								if ($posts_per_line == "3") {
									$gt3_featured_image_url = aq_resize($wp_get_attachment_url, "370", "253", true, true, true);
								}								
								if ($posts_per_line == "2") {
									$gt3_featured_image_url = aq_resize($wp_get_attachment_url, "570", "390", true, true, true);
								}
								if ($posts_per_line == "1") {
									$gt3_featured_image_url = $wp_get_attachment_url;
								}                                
								$featured_image = '<img alt="" src="' . $gt3_featured_image_url . '">';
                            } else {
                                $featured_image = '';
                            }
                            $compile .= '
                            <li>
                                <div class="item">
                                    <div class="item_wrapper">
                                        <div class="img_block">
                                            ' . $featured_image . '
                                            <a class="featured_ico_link view_link" href="' . get_permalink(get_the_ID()) . '"></a>
                                        </div>
                                        <div class="featured_items_body">
                                            <div class="featured_items_title">
                                                <h5><a href="' . get_permalink(get_the_ID()) . '">' . get_the_title() . '</a></h5>
                                            </div>
                                            <div class="featured_item_content">' . $post_excerpt . '</div>
                                            <div class="featured_meta">' . get_the_time("M") . ' ' . get_the_time("d") . ', ' . get_the_time("Y") . '&nbsp;&nbsp;/&nbsp;&nbsp;<a href="' . get_permalink(get_the_ID()) . '">' . get_comments_number(get_the_ID()) . ' ' . esc_html__('comments', 'hershel') . '</a></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            ';
                        }
                        wp_reset_postdata();
                    }

                    echo $compile;
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>