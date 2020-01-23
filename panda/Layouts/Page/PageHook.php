<?php

add_action("admin_enqueue_scripts", "page_hide_metaboxes_on_special_pages");

function page_hide_metaboxes_on_special_pages()
{
    global $pagenow;
    $screen = get_current_screen();

    if ($pagenow == "post.php" && $screen->post_type === "page") {
        $post_id = $_GET["post"];
        $pageBlogId = get_option("page_for_posts");
        $pageFrontId = get_option("page_on_front");

        $pageContactSlug = "pages/page-contact.php";

        $pageSlug = get_page_template_slug(get_queried_object_id());

        if (($post_id == $pageBlogId || $post_id == $pageFrontId || $pageSlug == $pageContactSlug) && ($screen->post_type === "page")) {
            wp_enqueue_script("hide-page-settings", get_template_directory_uri() . "/panda/Js/AdminHidePageMetaboxes.js", null, false, true);
        }
    }
}