<?php

use Utils\Cache;

define("WP_TRACY_CHECK_USER_LOGGED_IN", true);
define("WP_TRACY_ENABLE_MODE", true);
define("WP_USE_THEMES", false);
require("wp-load.php");
setlocale(LC_ALL, get_locale() . ".UTF8");


Cache::deletePandaCache();
\KT_Logger::info("Panda cache deleted");
