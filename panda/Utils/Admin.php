<?php

namespace Utils;

class Admin
{
    //? Issets

    public static function isPageTemplate($TemplateName)
    {
        if (array_key_exists("post", $_GET) && is_admin()) {

            $post_id = $_GET["post"] ? $_GET["post"] : $_POST["post_ID"];
            if (!isset($post_id)) return false;

            $template_file = get_post_meta($post_id, "_wp_page_template", true);

            if ($template_file == $TemplateName) {
                return true;
            }
        }

        return false;
    }

    public static function getEditLink($Id)
    {
        return $Url = get_site_url() . "/wp-admin/post.php?post=" . $Id . "&action=edit";
    }

    public static function isPostType(string $Key)
    {
        $screen = get_current_screen();
        if (!isset($screen)) {
            return false;
        }
        return $screen->post_type === $Key;
    }
}
