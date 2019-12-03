<?php

use Utils\uString;

// --- media: link & gallery ------------------------

add_filter("media_vieHookw_settings", "panda_media_view_settings_filter");
function panda_media_view_settings_filter($settings)
{
    $settings["galleryDefaults"]["link"] = "file";
    $settings["galleryDefaults"]["columns"] = 4;
    return $settings;
}


// --- Wordpress gallery styles disable

add_filter('use_default_gallery_style', '__return_false');


// --- yoast: disable JSON+LD ------------------------

add_filter("wpseo_json_ld_output", "__return_empty_array", 99);


// --- clear empty <b> strong p a and br from shortcode ------------------------

add_filter('the_content', 'panda_shortcode_empty_paragraph_callback');
function panda_shortcode_empty_paragraph_callback($content)
{

    $array = array(
        '<p>[' => '[',
        ']</p>' => ']',
        '<strong>[' => '[',
        ']</strong>' => ']',
        '<b>[' => '[',
        ']</b>' => ']',
        ']<br />' => ']'
    );
    return strtr($content, $array);
}


// --- Move Yoast Meta Box to bottom ------------------------

add_filter('wpseo_metabox_prio', 'panda_yoasttobottom');
function panda_yoasttobottom()
{
    return 'low';
}


// --- Remove Gutenberg blocks styles ------------------------

add_action('wp_print_styles', 'panda_deregister_styles', 100);
function panda_deregister_styles()
{
    wp_dequeue_style('wp-block-library');
}


// --- Rename Page slug

add_action('init', 'panda_page_slug', 1);
function panda_page_slug()
{
    global $wp_rewrite;
    $wp_rewrite->pagination_base = __("strana", "RLG_DOMAIN"); //where new-slug is the slug you want to use 
    $wp_rewrite->flush_rules();
}


// --- Breadcrumbs pagination page translate

add_filter("wpseo_breadcrumb_single_link", "panda_rename_page_text", 10, 2);
function panda_rename_page_text($link_output, $link)
{
    if (uString::stringStartsWith($link["text"], "Page")) {
        $link_output = str_replace("Page", __("Strana", "RLG_DOMAIN"), $link_output);
    }
    return $link_output;
}


// --- Remove p tag around img tag (usefull?)

add_filter('the_content', 'panda_filter_ptags_on_images');
function panda_filter_ptags_on_images($content)
{
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}


// --- EntryContent - wrap .table-responsive around <table> tag

add_filter('the_content', 'panda_table_wrap');
function panda_table_wrap($content)
{
    return preg_replace_callback('~<table.*?</table>~is', function ($match) {
        return '<div class="table-responsive">' . $match[0] . '</div>';
    }, $content);
}


// Load CDN Fancybox on pages where is gallery
add_action("wp_enqueue_scripts", "fancybox_method_enque_script_callback");
function fancybox_method_enque_script_callback()
{
    if (get_post_gallery()) {
        wp_register_script("fancybox-js", "https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js", "", "", true);
        wp_enqueue_style("fancybox-style", "https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css");
        wp_enqueue_script("fancybox-js");
    }
}
