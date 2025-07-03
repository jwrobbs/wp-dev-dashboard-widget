<?php
/**
 * Module Loader for WP Dev Dashboard Widget
 *
 * Scans the /modules directory and loads each module's init.php if present.
 *
 * @package WPDevDashboardWidget
 */

declare(strict_types=1);

namespace WPDevDashboardWidget;

/**
 * Loads all modules by including their init.php files.
 */
class ModulesLoader
{
    /**
     * Dynamically loads all module init.php files from the /modules directory.
     */
    public static function loadModules(): void
    {
        $modules_dir = __DIR__ . '/../modules';
        if (!is_dir($modules_dir)) {
            return;
        }
        $modules = scandir($modules_dir);
        if ($modules === false) {
            return;
        }
        foreach ($modules as $module) {
            if ($module === '.' || $module === '..') {
                continue;
            }
            $init_file = $modules_dir . '/' . $module . '/init.php';
            if (is_file($init_file)) {
                require_once $init_file;
            }
        }
    }
}
