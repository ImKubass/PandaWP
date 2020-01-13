<?php

namespace Interfaces;

interface Jsonable
{
    /** @return array */
    public function tryGetJsonLdData();
}
