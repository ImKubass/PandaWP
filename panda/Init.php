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

//? Layouts Constants
define("LAYOUTS_FOLDER", "Layouts");
define("LAYOUTS_PATH", "panda" . DIRECTORY_SEPARATOR . LAYOUTS_FOLDER . DIRECTORY_SEPARATOR);
define("LAYOUTS_PATH_ABSOLUTE", PANDA_BASE_PATH . DIRECTORY_SEPARATOR .  LAYOUTS_FOLDER . DIRECTORY_SEPARATOR);

//? Admin Constants
define("ADMIN_FOLDER", "Admin");
define("ADMIN_PATH_ABSOLUTE", PANDA_BASE_PATH . DIRECTORY_SEPARATOR .  ADMIN_FOLDER . DIRECTORY_SEPARATOR . COMPONENTS_FOLDER . DIRECTORY_SEPARATOR);

//? Cache files
define("PANDA_CACHE_PATH", "wp-content/cache/");
define("PANDA_REQUIRED_FILES_PATH", PANDA_CACHE_PATH . "RequiredFilesCache.php");
define("PANDA_CLASSES_CONFIGABLE_PATH", PANDA_CACHE_PATH . "ClassesConfigableCache.php");

if (!file_exists(PANDA_CACHE_PATH)) {
    mkdir(PANDA_CACHE_PATH, 0777, true);
}

if (!file_exists(PANDA_REQUIRED_FILES_PATH)) {
    pandaGenerateRequireList();
}
require_once(PANDA_REQUIRED_FILES_PATH);

$pandaRequiredFiles = unserialize($pandaRequiredFiles);
define("PANDA_REQUIRED_FILES", $pandaRequiredFiles);
requireFilesFromArray(PANDA_REQUIRED_FILES);



if (!file_exists(PANDA_CLASSES_CONFIGABLE_PATH)) {
    pandaGenerateConfigableClassesList();
}
require_once(PANDA_CLASSES_CONFIGABLE_PATH);

$pandaClassesConfigable = unserialize($pandaClassesConfigable);
define("PANDA_CLASSES_CONFIGABLE", $pandaClassesConfigable);
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
    if (is_array($files) && count($files) > 0) {
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
    if (is_admin()) {
        \KT_MetaBox::createMultiple($configName::getAllGenericFieldsets(), $key, \KT_MetaBox_Data_Type_Enum::POST_META);
    }
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

function pandaGenerateRequireList()
{
    //* List of files that needs to bee required
    $requiredFilesArray = array_merge(
        [PANDA_BASE_PATH . DIRECTORY_SEPARATOR . "Admin/Hooks.php"],
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
        glob_recursive(ADMIN_PATH_ABSOLUTE . "*Hook.php"),

        glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Config.php"),
        glob_recursive(LAYOUTS_PATH_ABSOLUTE . "*Config.php"),

        // get All files from panda/Components ending with Metabox.php
        glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Metabox.php"),
        glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Metaboxes.php")
    );

    $pandaRequiredFiles = serialize($requiredFilesArray);

    $File = "";
    $File .= "<?php \n";
    $File .= '$pandaRequiredFiles = \'' . $pandaRequiredFiles . '\';';
    $File .= "\n";

    file_put_contents(PANDA_REQUIRED_FILES_PATH, $File);
}

function pandaGenerateConfigableClassesList()
{
    $pandaClassesConfigable = getImplementingClasses(Configable::class);
    $pandaClassesConfigable = serialize($pandaClassesConfigable);

    $File = "";
    $File .= "<?php \n";
    $File .= '$pandaClassesConfigable = \'' . $pandaClassesConfigable . '\';';
    $File .= "\n";

    file_put_contents(PANDA_CLASSES_CONFIGABLE_PATH, $File);
}
