<?php

// --- Product Term Brand ---------------------------

use Components\Product\Product;
use Components\Product\Term\Brand;

register_product_term_brand();

function register_product_term_brand()
{
    $labels = [
        "name"                       => __("Výrobci", ADMIN_DOMAIN),
        "singular_name"              => __("Výrobce", ADMIN_DOMAIN),
        "menu_name"                  => __("Výrobci", ADMIN_DOMAIN),
        "all_items"                  => __("Všichni výrobci", ADMIN_DOMAIN),
        "parent_item"                => __("Nadřazení výrobci", ADMIN_DOMAIN),
        "parent_item_colon"          => __("Nadřazení výrobci:", ADMIN_DOMAIN),
        "new_item_name"              => __("Nový výrobce", ADMIN_DOMAIN),
        "add_new_item"               => __("Přidat nového výrobce", ADMIN_DOMAIN),
        "edit_item"                  => __("Upravit výrobce", ADMIN_DOMAIN),
        "update_item"                => __("Aktualizovat výrobce", ADMIN_DOMAIN),
        "view_item"                  => __("Zobrazit výrobce", ADMIN_DOMAIN),
        "separate_items_with_commas" => __("Oddělte výrobce čárkami", ADMIN_DOMAIN),
        "add_or_remove_items"        => __("Přidat nebo odebrat výrobce", ADMIN_DOMAIN),
        "choose_from_most_used"      => __("Vybrat z nejpouživanějších", ADMIN_DOMAIN),
        "popular_items"              => __("Populární výrobce", ADMIN_DOMAIN),
        "search_items"               => __("Hledat výrobce", ADMIN_DOMAIN),
        "not_found"                  => __("Nenalezeno", ADMIN_DOMAIN),
        "no_terms"                   => __("Žádní výrobci", ADMIN_DOMAIN),
        "items_list"                 => __("Seznam výrobců", ADMIN_DOMAIN),
        "items_list_navigation"      => __("Seznam výrobců menu", ADMIN_DOMAIN),
    ];
    $args = [
        "labels"            => $labels,
        "hierarchical"      => true,
        "public"            => true,
        "show_ui"           => true,
        "show_admin_column" => true,
        "show_in_nav_menus" => true,
        "show_tagcloud"     => false,
        "rewrite"           => [
            "slug"         => Brand::SLUG,
            "with_front"   => true,
            "hierarchical" => false,
        ],
    ];
    register_taxonomy(Brand::KEY, [Product::KEY], $args);
}
