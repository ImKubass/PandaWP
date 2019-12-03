<?php

$config = new KT_WP_Configurator();

$config->setDisplayLogo()
    ->setPostArchiveMenu()
    ->setAllowCookieStatement()
    ->setAllowSession();

$config->addThemeSupport(KT_WP_THEME_SUPPORT_POST_THUMBNAILS_KEY);

$config->addPostTypeSupport(KT_WP_POST_TYPE_SUPPORT_EXCERPT_KEY, [KT_WP_PAGE_KEY]);

$config->setExcerptText("...");

$config->pageRemover()
    ->removeComments()
    ->removeSubPage("edit.php", "edit-tags.php")
    ->removeSubPage("edit.php", "edit-tags.php?taxonomy=post_tag")
    ->removeSubPage("themes.php", "theme-editor.php");

$config->metaboxRemover()
    ->removeMetabox("tagsdiv-news-type", KT_WP_POST_KEY, "normal")
    ->removeRevisionsMetabox();


// --- images ------------------------------

//? -- FancyboxPreview size
add_image_size(IMAGE_SIZE_1920xauto, 1920);

$config->addImageSize(IMAGE_SIZE_300x300, 300, 300, true);


$config->setImagesLazyLoading(true)
    ->setImagesLinkClasses(true);

// --- styly ---------------------------

$config->assetsConfigurator()
    ->addStyle("theme-style", get_template_directory_uri() . "/style.css")
    ->setVersion(20190110)
    ->setEnqueue();


$config->assetsConfigurator()
    ->addStyle("google-font", "https://fonts.googleapis.com/css?family=Cabin:400,700|Hind:400,700&display=swap&subset=latin-ext")
    ->setEnqueue();

// --- scripty ------------------------------

$config->assetsConfigurator()
    ->addScript("theme-functions-script", get_template_directory_uri() . "/functions.min.js")
    ->addLocalizationData("myAjax", ["ajaxurl" => admin_url("admin-ajax.php")])
    ->setInFooter(true)
    ->setVersion(20190507)
    ->setEnqueue();


// --- menu ---------------------------

$config->addWpMenu(NAVIGATION_MAIN_MENU, __("Menu v hlavičce", "RLG_DOMAIN"));
$config->addWpMenu(NAVIGATION_FOOTER_MENU, __("Menu v patičce", "RLG_DOMAIN"));


// --- sidebars ------------------------------


// --- dashboard ------------------------------

$config->metaboxRemover()->clearWordpressDashboard(true)
    ->removeDashboardMetabox("icl_dashboard_widget")
    ->removeDashboardMetabox("wpseo-dashboard-overview");

// --- widgety ------------------------------

$config->widgetRemover()
    ->removeAllSystemWidgets(true, true, true)
    ->removeWidget("bcn_widget");

// --- head ------------------------------

$config->headRemover()->removeRecommendSystemHeads();

// --- Stránka s theme options ------------------------------

$config->setThemeSettingsPage();

// --- aktivace dynamickych fieldsetu ------------------------------

$config->setEnableDynamicFieldsets();


// --- incializace ------------------------------

$config->initialize();

KT_Termmeta::activate();

// --- Podstránka Nastavení hlavičky a patičky

$headerFooterSubpage = new \KT_Custom_Metaboxes_Subpage("themes.php", __("Hlavička a patička", "KT_CORE_DOMAIN"), __("Hlavička a patička", "KT_CORE_DOMAIN"), "update_core", FOOTER_HEADER_SETTINGS_PAGE);
$headerFooterSubpage->setRenderSaveButton()->register();
