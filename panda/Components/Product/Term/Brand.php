<?php


namespace Components\Product\Term;

use Components\Product\Product;

/**
 * Class Brand
 * @package Components\Product\Term
 */
class Brand
{
    const KEY    = Product::KEY . "-brand";
    const SLUG   = "vyrobce";
    const PREFIX = self::KEY . "-term";
}
