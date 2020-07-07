<?php

use Components\RowShortCode\RowShortCode;


foreach ([KT_WP_POST_KEY, KT_WP_PAGE_KEY] as $postType) {
    $pageShortcodesMetabox = KT_MetaBox::createCustom("$postType-shortcodes-metabox", __("Obsahové zktratky", ADMIN_DOMAIN), $postType, "panda_content_shortcodes_metabox_callback", false);
    $pageShortcodesMetabox->setContext(KT_MetaBox::CONTEXT_SIDE);
    $pageShortcodesMetabox->setPriority(KT_MetaBox::PRIORITY_LOW);
    $pageShortcodesMetabox->register();
}

function panda_content_shortcodes_metabox_callback()
{
    echo "<ol>";
    printf("<li><b>[%s columns=\"\"]</b> - <i>%s</i></li>", RowShortCode::TAG, __("Začátek řádku s počtem sloupců", ADMIN_DOMAIN));
    echo "<li><b>[column_start]</b> - <i>začátek sloupce</i></li>";
    echo "<li><b>[column_end]</b> - <i>konec sloupce</i></li>";
    echo "<li><b>[row_end]</b> - <i>konec řádku</i></li>";
    echo "</ol>";
}
