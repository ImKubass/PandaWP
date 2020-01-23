<?php

use Components\Employee\Employee;


// --- post type ------------------------



add_action("init", "register_employee_post_type");

function register_employee_post_type()
{
    $labels = [
        "name"                  => __("Zaměstnanci", ADMIN_DOMAIN),
        "singular_name"         => __("Zaměstnanec", ADMIN_DOMAIN),
        "menu_name"             => __("Zaměstnanci", ADMIN_DOMAIN),
        "name_admin_bar"        => __("Zaměstnanci", ADMIN_DOMAIN),
        "archives"              => __("Archív zaměstnanců", ADMIN_DOMAIN),
        "attributes"            => __("Atributy", ADMIN_DOMAIN),
        "parent_item_colon"     => __("Nadřazení zaměstnanci", ADMIN_DOMAIN),
        "all_items"             => __("Všichni zaměstnanci", ADMIN_DOMAIN),
        "add_new_item"          => __("Přidat nového zaměstnance", ADMIN_DOMAIN),
        "add_new"               => __("Přidat nového", ADMIN_DOMAIN),
        "new_item"              => __("Přidat zaměstnance", ADMIN_DOMAIN),
        "edit_item"             => __("Upravit zaměstnance", ADMIN_DOMAIN),
        "update_item"           => __("Aktualizovat zaměstnance", ADMIN_DOMAIN),
        "view_item"             => __("Zobrazit zaměstnance", ADMIN_DOMAIN),
        "view_items"            => __("Zobrazit zaměstnance", ADMIN_DOMAIN),
        "search_items"          => __("Hledat zaměstnance", ADMIN_DOMAIN),
        "not_found"             => __("Nenalezeno", ADMIN_DOMAIN),
        "not_found_in_trash"    => __("Nenalezeno v koši", ADMIN_DOMAIN),
        "featured_image"        => __("Obrázek", ADMIN_DOMAIN),
        "set_featured_image"    => __("Zvolit obrázek", ADMIN_DOMAIN),
        "remove_featured_image" => __("Odstranit obrázek", ADMIN_DOMAIN),
        "use_featured_image"    => __("Zvolit obrázek", ADMIN_DOMAIN),
        "insert_into_item"      => __("Vložit k zaměstnanci", ADMIN_DOMAIN),
        "uploaded_to_this_item" => __("Nahrát k zaměstnanci", ADMIN_DOMAIN),
        "items_list"            => __("Seznam zaměstnanců", ADMIN_DOMAIN),
        "items_list_navigation" => __("Seznam zaměstnanců menu", ADMIN_DOMAIN),
        "filter_items_list"     => __("Filtrovat zaměstnance", ADMIN_DOMAIN),
    ];
    $args = [
        "label"              => __("Zaměstnanci", ADMIN_DOMAIN),
        "description"        => __("Entita zaměstnanců", ADMIN_DOMAIN),
        "labels"             => $labels,
        "public"             => false,
        "publicly_queryable" => false,
        "show_ui"            => true,
        "show_in_menu"       => true,
        'show_in_rest'       => true,
        "capability_type"    => KT_WP_POST_KEY,
        "query_var"          => true,
        "rewrite"            => ["slug" => Employee::SLUG, "with_front" => false],
        "has_archive"        => false,
        "hierarchical"       => false,
        "menu_position"      => 4,
        "menu_icon"          => "dashicons-businessman",
        "supports"           => [
            KT_WP_POST_TYPE_SUPPORT_TITLE_KEY,
            KT_WP_POST_TYPE_SUPPORT_EDITOR_KEY,
            KT_WP_POST_TYPE_SUPPORT_THUMBNAIL_KEY,
            KT_WP_POST_TYPE_SUPPORT_PAGE_ATTRIBUTES_KEY,
        ],
    ];
    register_post_type(Employee::KEY, $args);
}


// --- admin sloupce ---------------------------

if (is_admin()) { // vlastní sloupce v administraci
    // posts
    $EmployeeColumns = new \KT_Admin_Columns(Employee::KEY);
    $EmployeeColumns->addColumn("post_thumbnail", [
        \KT_Admin_Columns::LABEL_PARAM_KEY => __("Foto", ADMIN_DOMAIN),
        \KT_Admin_Columns::TYPE_PARAM_KEY => \KT_Admin_Columns::THUMBNAIL_TYPE_KEY,
        \KT_Admin_Columns::INDEX_PARAM_KEY => 0,
    ]);
}
