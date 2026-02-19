<?php
/**
 * Plugin Name: UBS Monetization
 * Plugin URI: https://github.com/crispygodheaven-png/usb-platform-v3
 * Description: Monetization engine for UBS Platform.
 * Version: 1.0.0
 * Author: UBS Platform
 * Author URI: https://github.com/crispygodheaven-png
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.0
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'UBS_Core_Loader' ) ) {
    add_action('admin_notices', function() {
        echo '<div class="notice notice-error"><p>UBS Monetization requires UBS Core plugin active.</p></div>';
    });
    return;
}

define( 'UBS_MONET_VERSION', '1.0.0' );
define( 'UBS_MONET_PATH', plugin_dir_path( __FILE__ ) );

require_once UBS_MONET_PATH . 'includes/class-loader.php';

function run_ubs_monetization() {
    $loader = new UBS_Monet_Loader();
    $loader->run();
}

run_ubs_monetization();
