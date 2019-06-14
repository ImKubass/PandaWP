<?php

use Components\Page\PageConfig;
use Components\Post\PostConfig;
use Components\Product\ProductConfig;

use Components\PageFront\PageFrontConfig;
use Components\PageTheme\PageThemeConfig;

use Components\FooterHeaderSettings\FooterHeaderSettingsConfig;
use Components\ProductTermBrand\ProductTermBrandConfig;
use Components\Employee\EmployeeConfig;
use Components\PageContact\PageContactConfig;

//* --- theme ------------------------

KT_MetaBox::createMultiple(PageThemeConfig::getAllNormalFieldsets(), KT_WP_Configurator::getThemeSettingSlug(), KT_MetaBox_Data_Type_Enum::OPTIONS);

$themeSideMetaboxes = KT_MetaBox::createMultiple(PageThemeConfig::getAllSideFieldsets(), KT_WP_Configurator::getThemeSettingSlug(), KT_MetaBox_Data_Type_Enum::OPTIONS, false);
foreach ($themeSideMetaboxes as $themeSideMetabox) {
    $themeSideMetabox->setContext(KT_MetaBox::CONTEXT_SIDE);
    $themeSideMetabox->register();
}

//* --- footer header settings ------------------------

KT_MetaBox::createMultiple(FooterHeaderSettingsConfig::getAllNormalFieldsets(), FOOTER_HEADER_SETTINGS_PAGE_SLUG, KT_MetaBox_Data_Type_Enum::OPTIONS);

$footerHeaderMetaboxes = KT_MetaBox::createMultiple(FooterHeaderSettingsConfig::getAllSideFieldsets(), FOOTER_HEADER_SETTINGS_PAGE_SLUG, KT_MetaBox_Data_Type_Enum::OPTIONS, false);
foreach ($footerHeaderMetaboxes as $footerHeaderMetabox) {
    $footerHeaderMetabox->setContext(KT_MetaBox::CONTEXT_SIDE);
    $footerHeaderMetabox->register();
}

//* --- front page ------------------------

$pageFrontMetaboxes = KT_MetaBox::createMultiple(PageFrontConfig::getAllNormalFieldsets(), KT_WP_PAGE_KEY, KT_MetaBox_Data_Type_Enum::POST_META, false);
foreach ($pageFrontMetaboxes as $pageFrontMetabox) {
    $pageFrontMetabox->setIsOnlyForFrontPage(true);
    $pageFrontMetabox->register();
}

//* --- page contact ------------------------

$pageContactMetaboxes = KT_MetaBox::createMultiple(PageContactConfig::getAllNormalFieldsets(), KT_WP_PAGE_KEY, KT_MetaBox_Data_Type_Enum::POST_META, false);
foreach ($pageContactMetaboxes as $pageContactMetabox) {
    $pageContactMetabox->setPageTemplate("pages/page-contact.php");
    $pageContactMetabox->register();
}


//* --- post ------------------------

registerMetabox(PostConfig::class, POST_KEY);


//* --- page ------------------------

registerMetabox(PageConfig::class, KT_WP_PAGE_KEY);

//* --- employee ------------------------

registerMetabox(EmployeeConfig::class, EMPLOYEE_KEY);


//* --- product ------------------------

registerMetabox(ProductConfig::class, PRODUCT_KEY);

//* --- product term brand ------------------------

KT_Term_MetaBox::createMultiple(ProductTermBrandConfig::getAllGenericFieldsets(), PRODUCT_BRAND_KEY);


//-------------------------------------------
//* shortcut for registration basic metaboxes
function registerMetabox($configName, $key)
{
    KT_MetaBox::createMultiple($configName::getAllGenericFieldsets(), $key, KT_MetaBox_Data_Type_Enum::POST_META);
}
