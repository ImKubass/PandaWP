<?php

// --- post type ------------------------

add_action("init", "kt_bt_register_employee_post_type");

function kt_bt_register_employee_post_type()
{
    $labels = [
        "name" => __("Zaměstnanci", "RLG_DOMAIN"),
        "singular_name" => __("Zaměstnanec", "RLG_DOMAIN"),
        "menu_name" => __("Zaměstnanci", "RLG_DOMAIN"),
        "name_admin_bar" => __("Zaměstnanci", "RLG_DOMAIN"),
        "archives" => __("Archív zaměstnanců", "RLG_DOMAIN"),
        "attributes" => __("Atributy", "RLG_DOMAIN"),
        "parent_item_colon" => __("Nadřazení zaměstnanci", "RLG_DOMAIN"),
        "all_items" => __("Všichni zaměstnanci", "RLG_DOMAIN"),
        "add_new_item" => __("Přidat nového zaměstnance", "RLG_DOMAIN"),
        "add_new" => __("Přidat nového", "RLG_DOMAIN"),
        "new_item" => __("Přidat zaměstnance", "RLG_DOMAIN"),
        "edit_item" => __("Upravit zaměstnance", "RLG_DOMAIN"),
        "update_item" => __("Aktualizovat zaměstnance", "RLG_DOMAIN"),
        "view_item" => __("Zobrazit zaměstnance", "RLG_DOMAIN"),
        "view_items" => __("Zobrazit zaměstnance", "RLG_DOMAIN"),
        "search_items" => __("Hledat zaměstnance", "RLG_DOMAIN"),
        "not_found" => __("Nenalezeno", "RLG_DOMAIN"),
        "not_found_in_trash" => __("Nenalezeno v koši", "RLG_DOMAIN"),
        "featured_image" => __("Obrázek", "RLG_DOMAIN"),
        "set_featured_image" => __("Zvolit obrázek", "RLG_DOMAIN"),
        "remove_featured_image" => __("Odstranit obrázek", "RLG_DOMAIN"),
        "use_featured_image" => __("Zvolit obrázek", "RLG_DOMAIN"),
        "insert_into_item" => __("Vložit k zaměstnanci", "RLG_DOMAIN"),
        "uploaded_to_this_item" => __("Nahrát k zaměstnanci", "RLG_DOMAIN"),
        "items_list" => __("Seznam zaměstnanců", "RLG_DOMAIN"),
        "items_list_navigation" => __("Seznam zaměstnanců menu", "RLG_DOMAIN"),
        "filter_items_list" => __("Filtrovat zaměstnance", "RLG_DOMAIN"),
    ];
    $args = [
        "label" => __("Zaměstnanci", "RLG_DOMAIN"),
        "description" => __("Entita zaměstnanců", "RLG_DOMAIN"),
        "labels" => $labels,
        "public" => false,
        "publicly_queryable" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "capability_type" => KT_WP_POST_KEY,
        "query_var" => true,
        "rewrite" => ["slug" => EMPLOYEE_SLUG, "with_front" => false],
        "has_archive" => false,
        "hierarchical" => false,
        "menu_position" => 4,
        "menu_icon" => "dashicons-businessman",
        "supports" => [
            KT_WP_POST_TYPE_SUPPORT_TITLE_KEY,
            KT_WP_POST_TYPE_SUPPORT_EDITOR_KEY,
            KT_WP_POST_TYPE_SUPPORT_THUMBNAIL_KEY,
            KT_WP_POST_TYPE_SUPPORT_PAGE_ATTRIBUTES_KEY,
        ],
    ];
    register_post_type(EMPLOYEE_KEY, $args);
}


// --- admin sloupce ---------------------------

if (is_admin()) { // vlastní sloupce v administraci
    // posts
    $EmployeeColumns = new \KT_Admin_Columns(EMPLOYEE_KEY);
    $EmployeeColumns->addColumn("post_thumbnail", [
        KT_Admin_Columns::LABEL_PARAM_KEY => __("Foto", "RLG_DOMAIN"),
        KT_Admin_Columns::TYPE_PARAM_KEY => \KT_Admin_Columns::THUMBNAIL_TYPE_KEY,
        KT_Admin_Columns::INDEX_PARAM_KEY => 0,
    ]);
}
