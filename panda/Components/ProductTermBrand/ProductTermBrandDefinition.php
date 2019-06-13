<?php

// --- Product Term Brand ---------------------------

register_product_term_brand();

function register_product_term_brand()
{
    $labels = [
        "name" => __("Výrobci", "RLG_DOMAIN"),
        "singular_name" => __("Výrobce", "RLG_DOMAIN"),
        "menu_name" => __("Výrobci", "RLG_DOMAIN"),
        "all_items" => __("Všichni výrobci", "RLG_DOMAIN"),
        "parent_item" => __("Nadřazení výrobci", "RLG_DOMAIN"),
        "parent_item_colon" => __("Nadřazení výrobci:", "RLG_DOMAIN"),
        "new_item_name" => __("Nový výrobce", "RLG_DOMAIN"),
        "add_new_item" => __("Přidat nového výrobce", "RLG_DOMAIN"),
        "edit_item" => __("Upravit výrobce", "RLG_DOMAIN"),
        "update_item" => __("Aktualizovat výrobce", "RLG_DOMAIN"),
        "view_item" => __("Zobrazit výrobce", "RLG_DOMAIN"),
        "separate_items_with_commas" => __("Oddělte výrobce čárkami", "RLG_DOMAIN"),
        "add_or_remove_items" => __("Přidat nebo odebrat výrobce", "RLG_DOMAIN"),
        "choose_from_most_used" => __("Vybrat z nejpouživanějších", "RLG_DOMAIN"),
        "popular_items" => __("Populární výrobce", "RLG_DOMAIN"),
        "search_items" => __("Hledat výrobce", "RLG_DOMAIN"),
        "not_found" => __("Nenalezeno", "RLG_DOMAIN"),
        "no_terms" => __("Žádní výrobci", "RLG_DOMAIN"),
        "items_list" => __("Seznam výrobců", "RLG_DOMAIN"),
        "items_list_navigation" => __("Seznam výrobců menu", "RLG_DOMAIN"),
    ];
    $args = [
        "labels" => $labels,
        "hierarchical" => true,
        "public" => true,
        "show_ui" => true,
        "show_admin_column" => true,
        "show_in_nav_menus" => true,
        "show_tagcloud" => false,
        "rewrite" => [
            "slug" => "/",
            "with_front" => true,
            "hierarchical" => false,
        ],
    ];
    register_taxonomy(PRODUCT_BRAND_KEY, [PRODUCT_KEY], $args);
}
