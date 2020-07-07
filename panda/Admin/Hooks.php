<?php

add_action('admin_enqueue_scripts', 'panda_admin_scripts_callback');

function panda_admin_scripts_callback()
{

    // Trumbowyg
    wp_enqueue_script("TrumbowygJsCdn", "https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/trumbowyg.min.js");

    wp_enqueue_style("extraAdminCss", get_template_directory_uri() . "/panda/Admin/Build/extraAdmin.css");
    wp_enqueue_script("extraAdminJs", get_template_directory_uri() . "/panda/Admin/Build/extraAdminBundle.js", null, false, false);
}
