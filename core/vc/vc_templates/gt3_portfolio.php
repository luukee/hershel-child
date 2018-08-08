<?php

$defaults = array(
    'build_query' => '',
    'view_type' => 'grid',
    'ajax' => 'on',
    'filter' => 'on',
    'posts_per_line' => '1',
    'items_on_load' => '1',
    'items_per_click' => '1',
    'featured_image_type' => 'square_type'
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

?>
<div class="vc_row">
    <div class="vc_col-sm-12 module_portfolio">
        <?php
        wp_enqueue_script('gt3_isotope_js', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
        list($query_args, $build_query) = vc_build_loop_query($build_query);

        global $paged;
        if (empty($paged)) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $query_args['paged'] = $paged;

        global $gt3_wp_query_in_shortcodes;
        $gt3_wp_query_in_shortcodes = new WP_Query($query_args);
		
		if ($posts_per_line == "5") {
			$columns = '2 col-sm-2_4';
		} else {
			$columns = 12 / $posts_per_line;
		}

		$post_type_terms = "";

		if (isset($query_args['tax_query'])) {
			$tax_query_array = array();
			foreach ($query_args['tax_query'] as $tax_query_element) {
				if (isset($tax_query_element['terms'])) {
					array_push($tax_query_array, $tax_query_element['terms']);
				}
			}
			$post_type_terms = implode(',', $tax_query_array);
		}
		
		#Filter
		if ($filter == "on") {
            $compile .= gt3pb_showportfolio_categorys($post_type_terms);
        }

        if ($ajax == "on") {
            if ($view_type == "grid" && $posts_per_line == "1" || $view_type == "masonry" && $posts_per_line == "1") {
                $compile .= '<div class="row pb40 ajax_columns1"><div class="sorting_block ' . $featured_image_type .' image-grid column1" id="list">';				
            } elseif ($view_type == "wall") {
                $compile .= '<div class="fw_block wall_wrap pb40 items' . $posts_per_line . '"><div class="sorting_block ' . $featured_image_type . ' image-grid featured_items" id="list">';				                
            } else {
                $compile .= '<div class="row pb40"><div class="sorting_block grid_type' . $posts_per_line . ' ' . $featured_image_type . ' image-grid featured_items" id="list">';   
            }
			$compile .= '</div><div class="clear"></div><div class="text-center"><a href="' . esc_js("javascript:void(0)") . '" class="load_more_works shortcode_button btn_normal btn_type5">' . esc_html__("Load More", "hershel") . '</a></div></div>';
			
            $posts_per_page = $items_on_load;

            $GLOBALS['showOnlyOneTimeJS']['portfolio'] = '
				<script>					
					var posts_already_showed = 0;
					jQuery(window).load(function () {
						gt3_get_posts("gt3_get_posts", "portfolio", "' . $posts_per_page . '", posts_already_showed, "' . $view_type . '", "' . $posts_per_line . '", "' . $featured_image_type . '", "' . $post_type_terms . '");
						posts_already_showed = posts_already_showed + ' . $posts_per_page . ';
					});				
		
					jQuery(".load_more_works").on("click", function(){
						gt3_get_posts("gt3_get_posts", "portfolio", "' . $items_per_click . '", posts_already_showed, "' . $view_type . '", "' . $posts_per_line . '", "' . $featured_image_type . '", "' . $post_type_terms . '");
						posts_already_showed = posts_already_showed + ' . $items_per_click . ';
						return false;
					});
					function gt3_get_posts(action, post_type, posts_count, posts_already_showed, template, posts_per_line, featured_image_type, selected_terms) {
						jQuery.post(gt3_ajaxurl, {
							action: action,
							post_type: post_type,
							posts_count: posts_count,
							posts_already_showed:
							posts_already_showed,
							template: template,
							posts_per_line: posts_per_line,
							featured_image_type: featured_image_type,
							selected_terms: selected_terms
						})
						.done(function (data) {
						if (data.length < 1) {
							jQuery(".load_more_works").hide("fast");
						}
						var isotope_block = jQuery(".sorting_block");
							isotope_block.isotope("insert", jQuery(data), function () {
								jQuery(".sorting_block").isotope("reLayout");
							});						
						});
					}
				</script>
				';
		
		/* Ajax = "Off" */		
		} else {
			if ($gt3_wp_query_in_shortcodes->have_posts()) {
				/* Grid or Masonry (Items Per Line - 1) */	
				if ($view_type == "grid" && $posts_per_line == "1" || $view_type == "masonry" && $posts_per_line == "1") {
					$compile .= '<div class="row"><div class="sorting_block ' . $featured_image_type .' image-grid column1" id="list">';
				/* Wall */								
				} elseif ($view_type == "wall") {				
					$compile .= '<div class="fw_block wall_wrap items' . $posts_per_line . '"><div class="sorting_block ' . $featured_image_type . ' image-grid featured_items" id="list">';			
				/* 1-5 Columns */	
				} else {				
					$compile .= '<div class="row"><div class="sorting_block grid_type' . $posts_per_line . ' ' . $featured_image_type . ' image-grid featured_items" id="list">';		
				}
				
				while ($gt3_wp_query_in_shortcodes->have_posts()) {
					$gt3_wp_query_in_shortcodes->the_post();
					$post_excerpt = (gt3_smarty_modifier_truncate(get_the_excerpt(), 1265));					
					$gt3_theme_pagebuilder = gt3pb_get_plugin_pagebuilder(get_the_ID());
					
					$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
					if (strlen($featured_image[0]) < 1) {
						$featured_image[0] = "";
					}
					
					if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['work_link']) && strlen($gt3_theme_pagebuilder['page_settings']['portfolio']['work_link']) > 0) {
						$linkToTheWork = esc_url($gt3_theme_pagebuilder['page_settings']['portfolio']['work_link']);
						$target = "target='_blank'";
					} else {
						$linkToTheWork = get_permalink();
						$target = "";
					}
					// Categories
					$echoallterm = '';
					$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
					if ( $terms && ! is_wp_error( $terms ) ) {
						$draught_links = array();
						foreach ( $terms as $term ) {
							$draught_links[] = '<a href="'.get_term_link($term->slug, "portfolio_category").'">'.$term->name.'</a>';
							$tempname = strtr($term->name, array(
								" " => "-",
								"'" => "-",
							));
							$echoallterm .= strtolower($tempname) . " ";
							$echoterm = $term->name;
						}
						$on_draught = join( ", ", $draught_links );
					}
					else {
						$on_draught = 'Uncategorized';
					}
					
					/* Grid or Masonry (Items Per Line - 1) */	
					if ($view_type == "grid" && $posts_per_line == "1" || $view_type == "masonry" && $posts_per_line == "1") {												
						$compile .= '						
							<div class="col-sm-12 ' . $echoallterm . ' element">                    
								<div class="portfolio_item">
									<div class="row">';
										 if (strlen($featured_image[0]) > 0) {
											$compile .= '
												<div class="col-sm-6">
													<div class="img_block">'; 
														if ($featured_image_type == "round_type") {                                                      
															$compile .= '<img src="' . aq_resize($featured_image[0], 570, 570, true, true, true) . '" alt="">';
														} else {
															$compile .= '<img src="' . aq_resize($featured_image[0], 570, 450, true, true, true) . '" alt="">';
														}														
														$compile .= '<a class="featured_ico_link view_link" ' . $target . ' href="' . $linkToTheWork . '"></a>                                                                 
													</div>
												</div>';
										}										
										$compile .= '<div class="' . (strlen($featured_image[0]) > 0 ? "col-sm-6" : "col-sm-12") . '">
											<h2 class="portf_title"><a ' . $target . ' href="' . $linkToTheWork . '">' . get_the_title() . '</a></h2>
											<div class="listing_meta">
												<span>' . get_the_time("M d, Y") . '</span>
												<span>' . esc_html__("Category:", "hershel") . ' ' . strtolower($on_draught) . '</span>';
												if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['skills']) && is_array($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'])) {
													foreach ($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'] as $skillkey => $skillvalue) {
														$compile .='
															<span>
																' . esc_attr($skillvalue['name']) . ((isset($skillvalue['value']) && strlen($skillvalue['value']) > 0) && (isset($skillvalue['name']) && strlen($skillvalue['name']) > 0) ? ":" : "") . ' ' . esc_attr($skillvalue['value']) . '
															</span>
														';
													}
												}
											$compile .= '</div>
											<div class="content_info"><p>' . $post_excerpt . '</p></div>
											<a class="shortcode_button btn_small btn_type4" ' . $target . ' href="' . $linkToTheWork . '">' . esc_html__("Continue Reading", "hershel") . '</a>
										</div>                                        
									</div>                                                                        	
								</div>                                   
							</div>
						';						
					/* Wall */								
					} elseif ($view_type == "wall") {				
						$compile .= '
							<div class="' . $echoallterm . ' element">                    
								<div class="item">
									<div class="item_wrapper">';
										if (strlen($featured_image[0]) > 0) {                                 
											$compile .= '<div class="img_block">';
												if ($featured_image_type == "round_type") {                                                      
													$compile .= '<img src="' . aq_resize($featured_image[0], 570, 570, true, true, true) . '" alt="">';
												} else {
													$compile .= '<img src="' . aq_resize($featured_image[0], 570, 450, true, true, true) . '" alt="">';
												}
												$compile .= '<a ' . $target . ' href="' . $linkToTheWork . '" class="featured_ico_link view_link"></a>                                                                
											</div>';
										}
										$compile .= '<div class="featured_items_body">
											<div class="featured_items_title">
												<h5><a ' . $target . ' href="' . $linkToTheWork . '">' . get_the_title() . '</a></h5>
											</div>
											<div class="featured_meta">' . $on_draught . '</div>                                                                
										</div>                                                            
									</div>
								</div>                                  
							</div>
						';			
					/* 1-5 Columns */	
					} else {				
						$compile .= '
							<div class="col-sm-' . $columns . ' ' . $echoallterm . ' element">                    
								<div class="item">
									<div class="item_wrapper">';                                  
										if (strlen($featured_image[0]) > 0) {                                 
											$compile .= '<div class="img_block">';
												if ($featured_image_type == "round_type") {                                                      
													$compile .= '<img src="' . aq_resize($featured_image[0], 570, 570, true, true, true) . '" alt="">';
												} elseif ($view_type == "masonry") {
													$compile .= '<img src="' . aq_resize($featured_image[0], 570, '', true, true, true) . '" alt="">';
												} else {
													$compile .= '<img src="' . aq_resize($featured_image[0], 570, 450, true, true, true) . '" alt="">';
												}
												$compile .= '<a ' . $target . ' href="' . $linkToTheWork . '" class="featured_ico_link view_link"></a>                                                                
											</div>';
										}                                                   
										$compile .= '<div class="featured_items_body">
											<div class="featured_items_title">
												<h5><a ' . $target . ' href="' . $linkToTheWork . '">' . get_the_title() . '</a></h5>
											</div>
											<div class="featured_meta">' . $on_draught . '</div>                                                                
										</div>                                                            
									</div>
								</div>                                   
							</div>
						';		
					}
										
				}
				wp_reset_postdata();
				
				$compile .= '</div><div class="clear"></div></div>';
				
				if ($view_type == "grid" && $posts_per_line == "1" || $view_type == "masonry" && $posts_per_line == "1") {					
					$align_paging = '';
				} else {
					$align_paging = 'text-center';
				}
				
				$compile .= '<div class="portfolio_pager ' . $align_paging . '">'.gt3_get_theme_pagination("10", "show_in_shortcodes").'</div>';
            }
        }
		/* End Ajax = "Off" */
		
		if ($filter == "on") {
			 $GLOBALS['showOnlyOneTimeJS']['isotope'] = '
				<script>
					function portfolio_is_masonry() {
						jQuery(".optionset li a").on("click", function(){
							jQuery(".optionset li a").removeClass("selected");
							jQuery(".optionset li").removeClass("selected");
							jQuery(this).addClass("selected");
							jQuery(this).parent().addClass("selected");
							var filterSelector = jQuery(this).attr("data-option-value");
							jQuery(".sorting_block").isotope({
								filter: filterSelector
							});
							return false;
						});
					}
					
					jQuery(window).load(function () {
						portfolio_is_masonry();
						jQuery(".optionset li").eq(0).find("a").click();
					});
	
					jQuery(window).resize(function(){
						portfolio_is_masonry();
					});
				</script>
			';
		} else {
			$GLOBALS['showOnlyOneTimeJS']['isotope_withoutfilter'] = '
				<script>
					function portfolio_is_masonry() {
						jQuery(".sorting_block").isotope();
					}
					
					jQuery(window).load(function () {
						portfolio_is_masonry();				
					});
	
					jQuery(window).resize(function(){
						portfolio_is_masonry();
					});
				</script>
			';
		}

        echo $compile;
        ?>
    </div>
</div>