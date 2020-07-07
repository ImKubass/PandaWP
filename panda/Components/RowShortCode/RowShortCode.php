<?php

namespace Components\RowShortCode;

class RowShortCode extends \KT_Shortcode_Base
{

    const TAG = "row_start";
    const ID = "kt-row";

    public function __construct()
    {
        parent::__construct(self::TAG);
    }

    public function handler($attributes, $content = null)
    {
        $columns = $attributes["columns"];
        $html = "<div class=\"columns-$columns row\">";

        return $html;
    }
}
