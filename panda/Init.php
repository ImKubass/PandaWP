<?php
define("PANDA_BASE_PATH", path_join(TEMPLATEPATH, "panda"));

//? Requires Constants
define("REQUIRES_FOLDER", "Requires");
define("REQUIRES_PATH", PANDA_BASE_PATH . DIRECTORY_SEPARATOR . REQUIRES_FOLDER . DIRECTORY_SEPARATOR);


//? Components Constants
define("COMPONENTS_FOLDER", "Components");
define("COMPONENTS_PATH_ABSOLUTE", PANDA_BASE_PATH . DIRECTORY_SEPARATOR . COMPONENTS_FOLDER . DIRECTORY_SEPARATOR);
define("COMPONENTS_PATH", "panda/" . COMPONENTS_FOLDER . "/");

//? JavascriptPath
// Deprecated
define("PANDA_MAIN_JS_URL", get_template_directory_uri() . "/panda/Js");


//* List of files that needs to bee required
$requiredFilesArray = array_merge(
    [PANDA_BASE_PATH . DIRECTORY_SEPARATOR . "ProjectConstants.php"],
    [PANDA_BASE_PATH . DIRECTORY_SEPARATOR . "ThemeSetup.php"],
    // get All files from panda/Components ending with Definition.php
    glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Definition.php"),
    // get All files from panda/Components ending with Constants.php
    glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Constants.php"),
    // get All files from panda/Requires ending with .php
    glob_recursive(REQUIRES_PATH . "*.php"),
    // get All files from panda/Components ending with Hook.php
    glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Hook.php"),
    // get All files from panda/Components ending with Metabox.php
    glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Metabox.php"),
    glob_recursive(COMPONENTS_PATH_ABSOLUTE . "*Metaboxes.php")
);


define("PANDA_REQUIRED_FILES", $requiredFilesArray);
requireFilesFromArray(PANDA_REQUIRED_FILES);


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
