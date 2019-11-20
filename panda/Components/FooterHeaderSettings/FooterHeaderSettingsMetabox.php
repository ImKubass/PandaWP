<?php

namespace Components\FooterHeaderSettings;


//* --- footer header settings ------------------------

\KT_MetaBox::createMultiple(FooterHeaderSettingsConfig::getAllNormalFieldsets(), FOOTER_HEADER_SETTINGS_PAGE_SLUG, \KT_MetaBox_Data_Type_Enum::OPTIONS);

$footerHeaderMetaboxes = \KT_MetaBox::createMultiple(FooterHeaderSettingsConfig::getAllSideFieldsets(), FOOTER_HEADER_SETTINGS_PAGE_SLUG, \KT_MetaBox_Data_Type_Enum::OPTIONS, false);
foreach ($footerHeaderMetaboxes as $footerHeaderMetabox) {
    $footerHeaderMetabox->setContext(\KT_MetaBox::CONTEXT_SIDE);
    $footerHeaderMetabox->register();
}
