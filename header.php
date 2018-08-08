<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NDRJJTV');</script>
    <!-- End Google Tag Manager -->

    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <?php echo((gt3_get_theme_option("responsive") == "on") ? '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">' : ''); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <?php
    if (function_exists('has_site_icon') && has_site_icon()) {
        ?>
        <link rel="shortcut icon" href="<?php echo aq_resize(get_site_icon_url(), "32", "32", true, true, true); ?>"
              type="image/x-icon">
        <link rel="apple-touch-icon" href="<?php echo aq_resize(get_site_icon_url(), "57", "57", true, true, true); ?>">
        <link rel="apple-touch-icon" sizes="72x72"
              href="<?php echo aq_resize(get_site_icon_url(), "72", "72", true, true, true); ?>">
        <link rel="apple-touch-icon" sizes="114x114"
              href="<?php echo aq_resize(get_site_icon_url(), "114", "114", true, true, true); ?>">
        <?php
    } else {
        if (wp_get_attachment_url(gt3_get_theme_option("favicon"))) {
            ?>
            <link rel="shortcut icon" href="<?php echo wp_get_attachment_url(gt3_get_theme_option("favicon")); ?>" type="image/x-icon">
            <?php
        } else {
            ?>
            <link rel="shortcut icon" href="<?php echo gt3_get_theme_option('favicon'); ?>" type="image/x-icon">
            <?php
        }
        if (wp_get_attachment_url(gt3_get_theme_option("apple_touch_57"))) {
            ?>
            <link rel="apple-touch-icon" href="<?php echo wp_get_attachment_url(gt3_get_theme_option("apple_touch_57")); ?>">
            <?php
        } else {
            ?>
            <link rel="apple-touch-icon" href="<?php echo gt3_get_theme_option('apple_touch_57'); ?>">
            <?php
        }
        if (wp_get_attachment_url(gt3_get_theme_option("apple_touch_72"))) {
            ?>
            <link rel="apple-touch-icon" sizes="72x72" href="<?php echo wp_get_attachment_url(gt3_get_theme_option("apple_touch_72")); ?>">
            <?php
        } else {
            ?>
            <link rel="apple-touch-icon" sizes="72x72" href="<?php echo gt3_get_theme_option('apple_touch_72'); ?>">
            <?php
        }
        if (wp_get_attachment_url(gt3_get_theme_option("apple_touch_114"))) {
            ?>
            <link rel="apple-touch-icon" sizes="114x114" href="<?php echo wp_get_attachment_url(gt3_get_theme_option("apple_touch_114")); ?>">
            <?php
        } else {
            ?>
            <link rel="apple-touch-icon" sizes="114x114" href="<?php echo gt3_get_theme_option('apple_touch_114'); ?>">
            <?php
        }
    }
    ?>
    <!-- load custom css -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <script type="text/javascript">
        var gt3_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>
    <?php
    echo gt3_get_if_strlen(gt3_get_theme_option("custom_css"), "<style>", "</style>") . gt3_get_if_strlen(gt3_get_theme_option("code_before_head"));
    globalJsMessage::getInstance()->render();
    wp_head(); ?>
</head>
<?php $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(@get_the_ID()); ?>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NDRJJTV"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<body <?php body_class(); ?>>
<div id="page_container">
<?php if (get_page_template_slug() == "page-with-content-above-header.php") {
        ?>
    <div class="custom_page_slider <?php echo $gt3_theme_pagebuilder['slider']['custclass'] ?>">
        <?php if (isset($gt3_theme_pagebuilder['slider']['shortcode']) && $gt3_theme_pagebuilder['slider']['shortcode'] !== '') {
            ?>
            <?php echo do_shortcode($gt3_theme_pagebuilder['slider']['shortcode']) ?>
        <?php
        } ?>
    </div>
<?php
    } ?>
<div class="main_header <?php gt3_the_pb_custom_header($gt3_theme_pagebuilder); ?>">
    <?php if (!isset($gt3_theme_pagebuilder['settings']['show_tagline_area']) || ($gt3_theme_pagebuilder['settings']['show_tagline_area'] !== "no" && gt3_get_theme_option("show_tagline_area") !== "no")) {
        ?>
        <div class="tagline">
            <div class="container">
                <div class="fright">
                    <div class="tagline_items">
                        <div class="log_in_out"><a href="https://almamatertutors.customcollegeplan.com/" target="_blank"><i
                                    class="fa fa-sign-in"></i> <?php esc_html_e('Login', 'hershel'); ?></a></div>
                        <?php
                        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        if (is_plugin_active('woocommerce/woocommerce.php')) {
            ?>
                            <div class="cart_btn">
                                <?php global $woocommerce; ?>
                                <a class="cart-contents view_cart_btn"
                                   href="<?php echo $woocommerce->cart->get_cart_url(); ?>"
                                   title="<?php esc_html_e('View your shopping cart', 'hershel'); ?>"><i
                                        class="fa fa-shopping-cart"></i><span
                                        class="total_price"><?php echo $woocommerce->cart->get_cart_total(); ?><span
                                            class="price_count">(<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'hershel'), $woocommerce->cart->cart_contents_count); ?>
                                            )</span></span></a>

                                <div class="cart_submenu">
                                    <?php if (sizeof(WC()->cart->get_cart()) > 0) {
                ?>
                                        <div class="cart_wrap">
                                            <ul class="product_posts">
                                                <?php
                                                foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
                                                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key); ?>
                                                    <li>
                                                        <?php
                                                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                                    if (!$_product->is_visible()) {
                                                        echo $thumbnail;
                                                    } else {
                                                        printf('<a href="%s">%s</a>', $_product->get_permalink($cart_item), $thumbnail);
                                                    }

                                                    if (!$_product->is_visible()) {
                                                        echo apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key) . '&nbsp;';
                                                    } else {
                                                        echo apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s" class="title">%s </a>', $_product->get_permalink($cart_item), $_product->get_title()), $cart_item, $cart_item_key);
                                                    }

                                                    if ($_product->is_sold_individually()) {
                                                        $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                                    } else {
                                                        $product_quantity = $cart_item['quantity'];
                                                    } ?>
                                                        <div class="price">
                                                            <?php echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key); ?>
                                                            ×
                                                            <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); ?>
                                                        </div>
                                                        <?php
                                                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove_products" title="%s">×</a>', esc_url($woocommerce->cart->get_remove_url($cart_item_key)), esc_html__('Remove this item', 'hershel')), $cart_item_key); ?>
                                                    </li>
                                                    <?php
                                                } ?>
                                            </ul>
                                            <div class="subtotal">
                                                <?php esc_html_e('Subtotal', 'hershel'); ?>
                                                : <?php echo $woocommerce->cart->get_cart_subtotal(); ?>
                                            </div>
                                            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"
                                               class=" shortcode_button btn_small btn_type5 mr15"><?php esc_html_e('View cart', 'hershel'); ?></a>
                                            <a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>"
                                               class=" shortcode_button btn_small btn_type4 mr0"><?php esc_html_e('Checkout', 'hershel'); ?></a>
                                        </div>
                                    <?php
            } else {
                ?>
                                        <p class="empty"><?php esc_html_e('No products in the cart.', 'hershel'); ?></p>
                                    <?php
            } ?>
                                </div>
                            </div>
                        <?php
        } ?>
                        <div class="social_icons">
                            <ul>
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
                                )); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="fleft">
                    <?php if (strlen(gt3_get_theme_option("phone")) > 0) {
                                    ?>
                        <div class="phone"><i class="fa fa-phone"></i> <?php echo gt3_get_theme_option("phone"); ?>
                        </div>
                    <?php
                                } ?>
                    <?php if (strlen(gt3_get_theme_option("contacts_to")) > 0) {
                                    ?>
                        <div class="email"><a href="mailto:<?php echo gt3_get_theme_option("contacts_to"); ?>"><i
                                    class="fa fa-envelope-o"></i> <?php echo gt3_get_theme_option("contacts_to"); ?></a>
                        </div>
                    <?php
                                } ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    <?php
    } ?>
    <div class="header_parent_wrap">
        <header>
            <div class="container">
                <div class="logo_sect">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                        <?php
                        if (wp_get_attachment_url(gt3_get_theme_option("logo2"))) {
                            ?>
                            <img src="<?php echo wp_get_attachment_url(gt3_get_theme_option("logo2")); ?>"
                                 width="<?php echo gt3_get_theme_option("header_logo_standart_width"); ?>"
                                 height="<?php echo gt3_get_theme_option("header_logo_standart_height"); ?>"
                                 class="logo_def"
                                 alt=""/>
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo gt3_get_theme_option("logo2"); ?>"
                                 width="<?php echo gt3_get_theme_option("header_logo_standart_width"); ?>"
                                 height="<?php echo gt3_get_theme_option("header_logo_standart_height"); ?>"
                                 class="logo_def"
                                 alt=""/>
                            <?php
                        }

                        if (wp_get_attachment_url(gt3_get_theme_option("logo_retina"))) {
                            ?>
                            <img src="<?php echo wp_get_attachment_url(gt3_get_theme_option("logo_retina")); ?>"
                                 class="logo_retina"
                                 width="<?php echo gt3_get_theme_option("header_logo_standart_width"); ?>"
                                 height="<?php echo gt3_get_theme_option("header_logo_standart_height"); ?>"
                                 alt=""/>
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo gt3_get_theme_option("logo_retina"); ?>" class="logo_retina"
                                 width="<?php echo gt3_get_theme_option("header_logo_standart_width"); ?>"
                                 height="<?php echo gt3_get_theme_option("header_logo_standart_height"); ?>"
                                 alt=""/>
                            <?php
                        }
                        ?>
                    </a>
                    <a href="javascript:void(0);" class="menu_collapse"></a>
                </div>
                <div class="fright">
                    <nav>
                        <?php wp_nav_menu(array('theme_location' => 'main_menu', 'menu_class' => 'menu', 'depth' => '3', 'walker' => new gt3_menu_walker($showtitles = false))); ?>
                    </nav>
                    <div class="top_search">
                        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" name="search_form">
                            <input type="text" class="ct-search-input" value="" name="s"
                                   placeholder="<?php esc_html_e('Search...', 'hershel'); ?>">
                            <input type="submit" value="<?php esc_html_e('Search', 'hershel'); ?>" class="s_submit">
                            <span class="top-icon-search"></span>
                        </form>
                    </div>
                    <div class="clear"></div>
                    <div class="head_search">
                        <?php get_search_form(); ?>
                    </div>
                    <?php if (($gt3_theme_pagebuilder['settings']['show_tagline_area'] == "no" || gt3_get_theme_option("show_tagline_area") == "no") && ($gt3_theme_pagebuilder['settings']['header_type'] == "type2" || gt3_get_theme_option("default_header") == "type2")) {
                            ?>
                        <?php
                        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                            if (is_plugin_active('woocommerce/woocommerce.php')) {
                                ?>
                            <div class="shopping_cart_btn">
                                <?php global $woocommerce; ?>
                                <a class="cart-contents view_cart_btn"
                                   href="<?php echo $woocommerce->cart->get_cart_url(); ?>"
                                   title="<?php esc_html_e('View your shopping cart', 'hershel'); ?>"><i
                                        class="fa fa-shopping-cart"></i><span
                                        class="total_price"><?php echo $woocommerce->cart->get_cart_total(); ?><span
                                            class="price_count">(<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'hershel'), $woocommerce->cart->cart_contents_count); ?>
                                            )</span></span></a>
                            </div>
                        <?php
                            } ?>
                    <?php
                        } ?>
                </div>
                <div class="clear"></div>
                <?php if (($gt3_theme_pagebuilder['settings']['show_tagline_area'] == "no" || gt3_get_theme_option("show_tagline_area") == "no") && ($gt3_theme_pagebuilder['settings']['header_type'] == "type2" || gt3_get_theme_option("default_header") == "type2")) {
                            ?>
                    <div class="social_icons">
                        <ul>
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
                            )); ?>
                        </ul>
                    </div>
                    <div class="log_in_out"><a href="<?php echo wp_login_url(); ?>"><i
                                class="fa fa-sign-in"></i> <?php esc_html_e('Login', 'hershel'); ?></a></div>
                <?php
                        } ?>
            </div>
        </header>
    </div>
</div>
<?php
if (get_page_template_slug() == "page-with-blog-posts-slider-above-content.php") {
                        } else {
                            if (!is_404()) {
                                if (!isset($gt3_theme_pagebuilder['settings']['show_breadcrumb_area']) || ($gt3_theme_pagebuilder['settings']['show_breadcrumb_area'] !== "no" && gt3_get_theme_option("show_breadcrumb_area") !== "no")) {
                                    gt3_the_breadcrumb();
                                }
                                if (get_page_template_slug() == "page-with-slider-above-content.php") {
                                    ?>
<div class="custom_page_slider mb35 <?php echo $gt3_theme_pagebuilder['slider']['custclass'] ?>">
    <?php if (isset($gt3_theme_pagebuilder['slider']['shortcode']) && $gt3_theme_pagebuilder['slider']['shortcode'] !== '') {
                                        ?>
        <?php echo do_shortcode($gt3_theme_pagebuilder['slider']['shortcode']) ?>
    <?php
                                    } ?>
</div>
<?php
                                }
                                echo '<div class="wrapper">';
                            }
                        }
?>
