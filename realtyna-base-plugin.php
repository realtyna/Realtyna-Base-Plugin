<?php
/*
Plugin Name: Realtyna Base Plugin
Plugin URI: https://realtyna.com/realtyna-base-plugin
Description: Sample Example
Version: 1.0.0.0
Author: Realtyna
Author URI: mailto:info@realtyna.net
License: LGPL-3.0-or-later
License URI: https://www.gnu.org/licenses/lgpl-3.0.html
Text Domain: realtyna-base-plugin
Domain Path: /assets/langs
Requires PHP: 8.1
*/

require_once(__DIR__ . '/vendor/autoload.php');

use Realtyna\Core\Config;
use Realtyna\BasePlugin\Main;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants.
define( 'REALTYNA_BASE_PLUGIN_VERSION', '1.0.0' );  // Version number for your plugin.
define( 'REALTYNA_BASE_PLUGIN_NAME', 'Realtyna Base Plugin' );  // Version number for your plugin.
define( 'REALTYNA_BASE_PLUGIN_SLUG', 'your-plugin-slug' );  // Unique slug for the plugin, used for namespacing.
define( 'REALTYNA_BASE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );  // Directory path for the plugin files.
define( 'REALTYNA_BASE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );  // URL to the plugin directory.
define( 'REALTYNA_BASE_PLUGIN_CONFIG_FILE', REALTYNA_BASE_PLUGIN_DIR . 'src/Config/config.php' );  // Path to the configuration file.

// Autoload classes (if using Composer).
if ( file_exists( REALTYNA_BASE_PLUGIN_DIR . 'vendor/autoload.php' ) ) {
    require_once REALTYNA_BASE_PLUGIN_DIR . 'vendor/autoload.php';
}

try {
    // Instantiate the configuration class.
    $config = new Config(REALTYNA_BASE_PLUGIN_CONFIG_FILE);

    // Instantiate the main plugin class with the config.
    $pluginClass = new Main($config);

    // Register activation hook to handle tasks during plugin activation.
    register_activation_hook(__FILE__, [$pluginClass, 'activation']);

    // Register deactivation hook to handle tasks during plugin deactivation.
    register_deactivation_hook(__FILE__, [$pluginClass, 'deactivation']);

    // Register uninstall hook to handle tasks during plugin uninstallation.
    register_uninstall_hook(__FILE__, [Main::class, 'uninstallation']);

} catch (Exception $e) {
    // Display an error notice in the WordPress admin if an exception occurs.
    $html = '<div class="notice notice-error">
                <p>
                ' . $e->getMessage() . '
                </p>
            </div>';
    add_action('admin_notices', function () use ($html) {
        echo $html;
    });
}
