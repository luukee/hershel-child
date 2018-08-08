<?php
    $gt3_theme_featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
    $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());

    $post_categories = wp_get_post_categories(get_the_ID());
    $cats = array();
    $cats_str = '';

    foreach ($post_categories as $c) {
        $cat = get_category($c);
        $link = get_category_link($c);
        $cats[] = '<a href="' . $link . '"> ' . $cat->name . '</a>';
    }
    if (count($cats)) {
        $cats_str = '<span class="category"> ' . esc_html__('Category', 'hershel') . ': ' . implode(', ', $cats) . '</span>';
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

    $comments_num = '' . get_comments_number(get_the_ID()) . '';

    if ($comments_num == 1) {
        $comments_text = '' . esc_html__('comment', 'hershel') . '';
    } else {
        $comments_text = '' . esc_html__('comments', 'hershel') . '';
    }

global $more;
$more = 0;

    $excerpt = '<p>' . ((strlen(get_the_excerpt()) > 0) ? get_the_excerpt() : get_the_content())   . '</p>';

    $compile_bloglisting = '
		<div class="blog_post_preview">
			<a href="' . get_permalink() . '">
				<div class="blog_post_image">
					' . get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder)) . '
				</div>
			</a>
			<div class="blog_content">
				<h2 class="blogpost_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
				<div class="listing_meta">
					<span>' . get_the_time("M d, Y") . '</span>
					<span class="author">' . esc_html__('by', 'hershel') . ' <a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author_meta('display_name') . '</a></span>
					' . $cats_str . '
					<span><a href="' . get_comments_link() . '">' . get_comments_number(get_the_ID()) . ' ' . $comments_text . '</a></span>
					' . $post_tags_compile . '
				</div>
				' . do_shortcode($excerpt). '
			</div>
		</div>
	';

    echo $compile_bloglisting;
