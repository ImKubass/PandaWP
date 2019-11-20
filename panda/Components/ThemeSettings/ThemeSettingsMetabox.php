<?php

namespace Components\ThemeSettings;

//* --- theme ------------------------

\KT_MetaBox::createMultiple(ThemeSettingsConfig::getAllNormalFieldsets(), \KT_WP_Configurator::getThemeSettingSlug(), \KT_MetaBox_Data_Type_Enum::OPTIONS);

$themeSideMetaboxes = \KT_MetaBox::createMultiple(ThemeSettingsConfig::getAllSideFieldsets(), \KT_WP_Configurator::getThemeSettingSlug(), \KT_MetaBox_Data_Type_Enum::OPTIONS, false);
foreach ($themeSideMetaboxes as $themeSideMetabox) {
    $themeSideMetabox->setContext(\KT_MetaBox::CONTEXT_SIDE);
    $themeSideMetabox->register();
}
