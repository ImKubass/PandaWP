<?php

use Components\Product\Product;

add_action("init", "register_product_post_type");

function register_product_post_type()
{
    // --- post type ------------------------

    $labels = [
        "name"               => __("Produkty", ADMIN_DOMAIN),
        "singular_name"      => __("Produkt", ADMIN_DOMAIN),
        "add_new"            => __("Přidat produkt", ADMIN_DOMAIN),
        "add_new_item"       => __("Přidat nový produkt", ADMIN_DOMAIN),
        "edit_item"          => __("Změnit produkt", ADMIN_DOMAIN),
        "new_item"           => __("Nový produkt", ADMIN_DOMAIN),
        "view_item"          => __("Zobrazit produkt", ADMIN_DOMAIN),
        "all_items"          => __("Všechny produkty", ADMIN_DOMAIN),
        "search_items"       => __("Hledat produkty", ADMIN_DOMAIN),
        "not_found"          => __("Žádné produkty nenalezeny", ADMIN_DOMAIN),
        "not_found_in_trash" => __("Žádné produkty v koši", ADMIN_DOMAIN),
        "menu_name"          => __("Produkty", ADMIN_DOMAIN),
    ];

    $args = [
        "labels"             => $labels,
        "public"             => true,
        "publicly_queryable" => true,
        "show_ui"            => true,
        "show_in_menu"       => true,
        'show_in_rest'       => true,
        "capability_type"    => KT_WP_POST_KEY,
        "query_var"          => true,
        "rewrite"            => ["slug" => Product::SLUG, "with_front" => false],
        "has_archive"        => false,
        "hierarchical"       => false,
        "menu_position"      => 4,
        "menu_icon"          => "dashicons-cart",
        "supports"           => [
            KT_WP_POST_TYPE_SUPPORT_TITLE_KEY,
            KT_WP_POST_TYPE_SUPPORT_EDITOR_KEY,
            KT_WP_POST_TYPE_SUPPORT_THUMBNAIL_KEY,
            KT_WP_POST_TYPE_SUPPORT_PAGE_ATTRIBUTES_KEY,
            KT_WP_POST_TYPE_SUPPORT_EXCERPT_KEY,
        ],
    ];

    register_post_type(Product::KEY, $args);
}

// --- admin sloupce ---------------------------

if (is_admin()) { // vlastní sloupce v administraci
    $ProductColumns = new KT_Admin_Columns(Product::KEY);
    $ProductColumns->addColumn("post_thumbnail", [
        KT_Admin_Columns::LABEL_PARAM_KEY => __("Foto", ADMIN_DOMAIN),
        KT_Admin_Columns::TYPE_PARAM_KEY => KT_Admin_Columns::THUMBNAIL_TYPE_KEY,
        KT_Admin_Columns::INDEX_PARAM_KEY => 0,
    ]);
    $ProductColumns->addColumn("menu_order", [
        KT_Admin_Columns::LABEL_PARAM_KEY => __("Pořadí", ADMIN_DOMAIN),
        KT_Admin_Columns::TYPE_PARAM_KEY => KT_Admin_Columns::POST_PROPERTY_TYPE_KEY,
        KT_Admin_Columns::PROPERTY_PARAM_KEY => "menu_order",
        KT_Admin_Columns::SORTABLE_PARAM_KEY => true,
        KT_Admin_Columns::INDEX_PARAM_KEY => 3,
    ]);
}
