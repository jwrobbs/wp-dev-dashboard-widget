<?php
/*
Plugin Name: WP Dev Dashboard Widget
Description: Framework for building a multisection dashboard widget with extensible modules, AJAX, and updater.
Version: 0.1.0
Author: Josh Robbs
Author URI: https://joshrobbs.com
License: Unlicense
Text Domain: wp-dev-dashboard-widget
*/

/**
 * WP Dev Dashboard Widget
 * Main bootstrap file. Loads constants and triggers module loading.
 *
 * @package WPDevDashboardWidget
 */

declare(strict_types=1);

// Load plugin constants	require_once __DIR__ . '/constants.php';
// Load the module loader
require_once __DIR__ . '/src/modules-loader.php';
// Load the dashboard widget framework
require_once __DIR__ . '/src/dashboard-widget.php';

// Load all modules
\WPDevDashboardWidget\load_modules();
