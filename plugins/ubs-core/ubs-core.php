<?php
/**
 * Plugin Name: UBS Core
 * Plugin URI: https://github.com/crispygodheaven-png/usb-platform-v3
 * Description: Core engine for the Universal Book System platform.
 * Version: 1.0.0
 * Author: crispy god
 * Author URI: https://github.com/crispygodheaven-png
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ubs-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'UBS_CORE_VERSION', '1.0.0' );
define( 'UBS_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'UBS_CORE_URL', plugin_dir_url( __FILE__ ) );

require_once UBS_CORE_PATH . 'includes/class-loader.php';
require_once UBS_CORE_PATH . 'includes/class-activator.php';
require_once UBS_CORE_PATH . 'includes/class-deactivator.php';

register_activation_hook( __FILE__, array( 'UBS_Core_Activator', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'UBS_Core_Deactivator', 'deactivate' ) );

function run_ubs_core() {
    $loader = new UBS_Core_Loader();
    $loader->run();
}

run_ubs_core();
