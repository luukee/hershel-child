<?php
/**
 * Your code here.
 *
 */
// adding widget area
 if (function_exists('register_sidebar')) {
     register_sidebar(
       array(
     'name' => 'Pre Pre Footer',
     'before_widget' => '<div class = "pre-pre-footer">',
     'after_widget' => '</div>',
     'before_title' => '<h3>',
     'after_title' => '</h3>',
   )
 );
 }

// deregister & reregister parent theme styles
function lch_deregister_styles()
{
    $parent_style = 'gt3-theme';
    wp_deregister_style($parent_style);
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/css/theme.css');
}
 add_action('wp_print_styles', 'lch_deregister_styles', 10);


// enqueue custom styles: https://codex.wordpress.org/Child_Themes
 function my_theme_enqueue_styles()
 {
     $parent_style = 'gt3-theme';
     wp_enqueue_style(
         'child-style',
         get_stylesheet_directory_uri() . '/library/css/style.css',
         array( $parent_style ),
         wp_get_theme()->get('Version')
     );
 }
 add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles', 30);
