<?php

$defaults = array(
    'build_query' => ''
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

?>
<div class="vc_row">
    <div class="vc_col-sm-12 module_blog">
        <?php
        list($query_args, $build_query) = vc_build_loop_query($build_query);

        global $paged;
        if (empty($paged)) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $query_args['paged'] = $paged;

        global $gt3_wp_query_in_shortcodes;
        $gt3_wp_query_in_shortcodes = new WP_Query($query_args);

        if ($gt3_wp_query_in_shortcodes->have_posts()) {
            while ($gt3_wp_query_in_shortcodes->have_posts()) {
                $gt3_wp_query_in_shortcodes->the_post();

                $gt3_theme_pagebuilder = get_post_meta(get_the_ID(), "pagebuilder", true);

                if (get_the_category()) $categories = get_the_category();
                if ($categories) {
                    $post_categ = '';
                    $post_category_compile = '<span class="category">' . esc_html__('Category', 'hershel') . ':';
                    foreach ($categories as $category) {
                        $post_categ = $post_categ . '<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . ', ';
                    }
                    $post_category_compile .= ' ' . trim($post_categ, ', ') . '</span>';
                }

                if (get_the_tags() !== '') {
                    $posttags = get_the_tags();
                }
                if ($posttags) {
                    $post_tags = '';
                    $post_tags_compile = '<span>' . esc_html__('Tags', 'hershel') . ':';
                    foreach ($posttags as $tag) {
                        $post_tags = $post_tags . '<a href="' . get_term_link($tag) . '">' . $tag->name . '</a>' . ', ';
                    }
                    $post_tags_compile .= ' ' . trim($post_tags, ', ') . '</span>';
                } else {
                    $post_tags_compile = '';
                }

                $post = get_post();

                $comments_num = '' . get_comments_number(get_the_ID()) . '';

                if ($comments_num == 1) {
                    $comments_text = '' . esc_html__('comment', 'hershel') . '';
                } else {
                    $comments_text = '' . esc_html__('comments', 'hershel') . '';
                }

                $compile .= '
						<div class="blog_post_preview">
							<div class="blog_post_image">
								' . get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder)) . '
							</div>
							<div class="blog_content">
								<h2 class="blogpost_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
								<div class="listing_meta">
									<span>' . get_the_time("M d, Y") . '</span>
									<span class="author">' . esc_html__('by', 'hershel') . ' <a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author_meta('display_name') . '</a></span>
									' . $post_category_compile . '
									<span><a href="' . get_comments_link() . '">' . get_comments_number(get_the_ID()) . ' ' . $comments_text . '</a></span>                                                									
									' . $post_tags_compile . '
								</div>                                                                                        
								<p>' . ((strlen(get_the_excerpt()) > 0) ? get_the_excerpt() : get_the_content()) . '</p>
							</div>
						</div>
						';
            }
            wp_reset_postdata();

            $compile .= gt3_get_theme_pagination("10", "show_in_shortcodes");

        }

        echo $compile;
        ?>
    </div>
</div>