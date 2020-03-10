<?php

add_action('admin_enqueue_scripts', 'panda_admin_scripts_callback');

function panda_admin_scripts_callback()
{
    wp_enqueue_style("extraAdminCss", get_template_directory_uri() . "/panda/Admin/Build/extraAdmin.css");
    wp_enqueue_script("extraAdminJs", get_template_directory_uri() . "/panda/Admin/Build/extraAdminBundle.js", null, false, false);
}
