<?php

use Interfaces\Configable;

define("PANDA_BASE_PATH", path_join(TEMPLATEPATH, "panda"));

//? Requires Constants
define("REQUIRES_FOLDER", "Requires");
define("REQUIRES_PATH", PANDA_BASE_PATH . DIRECTORY_SEPARATOR . REQUIRES_FOLDER . DIRECTORY_SEPARATOR);


//? Components Constants
define("COMPONENTS_FOLDER", "Components");
define("COMPONENTS_PATH_ABSOLUTE", PANDA_BASE_PATH . DIRECTORY_SEPARATOR . COMPONENTS_FOLDER . DIRECTORY_SEPARATOR);
define("COMPONENTS_PATH", "panda/" . COMPONENTS_FOLDER . "/");

define("LAYOUTS_FOLDER", "Layouts");
define("LAYOUTS_PATH", "panda" . DIRECTORY_SEPARATOR . LAYOUTS_FOLDER . DIRECTORY_SEPARATOR);
define("LAYOUTS_PATH_ABSOLUTE", PANDA_BASE_PATH . DIRECTORY_SEPARATOR .  LAYOUTS_FOLDER . DIRECTORY_SEPARATOR);

//? JavascriptPath
// Deprecated
define("PANDA_MAIN_JS_URL", get_template_directory_uri() . "/panda/Js");


//* List of files that needs to bee required
$requiredFilesArray = array_merge(
    [PANDA_BASE_PATH . DIRECTORY_SEPARATOR . "ProjectConstants.php"],
    [PANDA_BASE_PATH . DIRECTORY_SEPARATOR . "ThemeSetup.php"],
    // get All files from panda/Components ending with Constants.php
    glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Constants.php"),
    glob_recursive(LAYOUTS_PATH_ABSOLUTE . "*Constants.php"),
    // get All files from panda/Components ending with Definition.php
    glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Definition.php"),
    glob_recursive(LAYOUTS_PATH_ABSOLUTE . "*Definition.php"),
    // get All files from panda/Requires ending with .php
    glob_recursive(REQUIRES_PATH . "*.php"),
    // get All files from panda/Components ending with Hook.php
    glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Hook.php"),
    glob_recursive(LAYOUTS_PATH_ABSOLUTE . "*Hook.php"),

    glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Config.php"),
    glob_recursive(LAYOUTS_PATH_ABSOLUTE . "*Config.php"),

    // get All files from panda/Components ending with Metabox.php
    glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Metabox.php"),
    glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Metaboxes.php")
);


define("PANDA_REQUIRED_FILES", $requiredFilesArray);
requireFilesFromArray(PANDA_REQUIRED_FILES);

$ClassesConfigable = getImplementingClasses(Configable::class);
define("PANDA_CLASSES_CONFIGABLE", $ClassesConfigable);
callRegisterMetaboxes(PANDA_CLASSES_CONFIGABLE);



//* --- Core functions --------

/**
 * Recursive glob
 * @param string $pattern
 * @param int $flags
 */
function glob_recursive(string $pattern, int $flags = 0)
{
    $files = glob($pattern, $flags);
    foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
        $files = array_merge($files, glob_recursive($dir . '/' . basename($pattern), $flags));
    }
    return $files;
}


/**
 * Go trought list of files path, and if exist, then require it
 * @param array $files
 */
function requireFilesFromArray(array $files)
{
    if (!empty($files)) {
        foreach ($files as $file) {
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }
}


/** 
 * Shortcut for registration basic metaboxes
 */
function registerMetabox($configName, $key)
{
    \KT_MetaBox::createMultiple($configName::getAllGenericFieldsets(), $key, \KT_MetaBox_Data_Type_Enum::POST_META);
}

/**
 * 
 * @param string $interfaceName 
 * @return array 
 */
function getImplementingClasses($interfaceName)
{
    return array_filter(
        get_declared_classes(),
        function ($className) use ($interfaceName) {
            return in_array($interfaceName, class_implements($className));
        }
    );
}

function callRegisterMetaboxes(array $Classes)
{
    foreach ($Classes as $Class) {
        /** @var Configable $Class */
        $Class::registerMetaboxes();
    }
}
