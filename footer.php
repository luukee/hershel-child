</div><!-- .wrapper -->

<div class="footer">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Pre Pre Footer")) : ?>
    <?php endif;?>
	<?php if (gt3_get_theme_option("footer_widgets_area") == "on") {
    ?>
    <div class="pre_footer">
        <div class="container">
            <div class="row">
                <?php get_sidebar('footer'); ?>
            </div>
        </div>
    </div>
    <?php
} ?>
    <div class="footer_bottom">
        <div class="container">
            <div class="copyright"><?php echo gt3_get_theme_option("copyright"); ?></div>
            <div class="social_icons">
                <ul>
                    <li><span><?php echo esc_html__('Follow:', 'hershel'); ?></span></li>
                    <?php echo gt3_show_social_icons(array(
                        array(
                            "uniqid" => "social_facebook",
                            "class" => "facebook",
                            "title" => "Facebook",
                            "target" => "_blank",
                        ),
                        array(
                            "uniqid" => "social_twitter",
                            "class" => "twitter",
                            "title" => "Twitter",
                            "target" => "_blank",
                        ),
                        array(
                            "uniqid" => "social_gplus",
                            "class" => "google-plus",
                            "title" => "Google+",
                            "target" => "_blank",
                        ),
                        array(
                            "uniqid" => "social_dribbble",
                            "class" => "dribbble",
                            "title" => "Dribbble",
                            "target" => "_blank",
                        ),
                        array(
                            "uniqid" => "social_pinterest",
                            "class" => "pinterest",
                            "title" => "Pinterest",
                            "target" => "_blank",
                        ),
                        array(
                            "uniqid" => "social_instagram",
                            "class" => "instagram",
                            "title" => "Instagram",
                            "target" => "_blank",
                        ),
                        array(
                            "uniqid" => "social_youtube",
                            "class" => "youtube",
                            "title" => "Youtube",
                            "target" => "_blank",
                        ),
                        array(
                            "uniqid" => "social_tumblr",
                            "class" => "tumblr",
                            "title" => "Tumblr",
                            "target" => "_blank",
                        ),
                        array(
                            "uniqid" => "social_linked_in",
                            "class" => "linkedin",
                            "title" => "Linked In",
                            "target" => "_blank",
                        ),
                        array(
                            "uniqid" => "social_flickr",
                            "class" => "flickr",
                            "title" => "Flickr",
                            "target" => "_blank",
                        ),
                        array(
                            "uniqid" => "social_xing",
                            "class" => "xing-square",
                            "title" => "Xing",
                            "target" => "_blank",
                        )
                    ));
                    ?>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

<div class="fixed-menu <?php echo(gt3_get_theme_option("sticky_menu") == "on" ? "true_fixed_menu" : ""); ?>"></div>
</div>
<?php
    gt3_the_pb_custom_bg_and_color(gt3_get_theme_pagebuilder(@get_the_ID()));
    echo gt3_get_if_strlen(gt3_get_theme_option("code_before_body"));
    wp_footer();
?>
</body>
</html>
