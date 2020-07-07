<?php

use Components\RowShortCode\RowShortCode;

$rowShortcode = new RowShortCode();
$rowShortcode->register();

/*
 * Jednoduché řešení postaru, pro složitější scénáře viz @see KT_Shortcode
 */

add_shortcode("row_end", "panda_row_end_shortcode_callback");

function panda_row_end_shortcode_callback($atts)
{
    return "</div>";
}

add_shortcode("column_start", "panda_column_start_shortcode_callback");

function panda_column_start_shortcode_callback($atts)
{
    return "<div class=\"column\">";
}

add_shortcode("column_end", "panda_column_end_shortcode_callback");

function panda_column_end_shortcode_callback($atts)
{
    return "</div>";
}
