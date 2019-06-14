<?php

$ktInitfile = TEMPLATEPATH . "/kt/kt_init.inc.php";
if (file_exists($ktInitfile)) {
    require($ktInitfile);
} else {
    wp_die(sprintf(__("POZOR: WP Framework není k dispozici, zkontrolujte prosím adresář a inicializační soubor: %s"), $ktInitfile));
}

$autoload = TEMPLATEPATH . "/panda/vendor/autoload.php";
if (file_exists($autoload)) {
    require($autoload);
} else {
    wp_die(sprintf(__("POZOR: Composer není nainstalovaný: %s"), $autoload));
}
