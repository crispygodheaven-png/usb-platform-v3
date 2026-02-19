<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class UBS_Core_Loader {

    public function __construct() {
        $this->load_dependencies();
    }

    private function load_dependencies() {

        require_once UBS_CORE_PATH . 'includes/core/class-post-types.php';
        require_once UBS_CORE_PATH . 'includes/core/class-taxonomies.php';
        require_once UBS_CORE_PATH . 'includes/core/class-meta.php';
        require_once UBS_CORE_PATH . 'includes/core/class-access-control.php';
        require_once UBS_CORE_PATH . 'includes/social/class-follow-system.php';
        require_once UBS_CORE_PATH . 'includes/social/class-follow-button.php';
        require_once UBS_CORE_PATH . 'includes/social/class-notification-system.php';
        require_once UBS_CORE_PATH . 'includes/admin/class-admin-notifications.php';
        require_once UBS_CORE_PATH . 'includes/dashboard/class-author-dashboard.php';

    }

    public function run() {

        $post_types = new UBS_Core_Post_Types();
        $post_types->register();

        $taxonomies = new UBS_Core_Taxonomies();
        $taxonomies->register();

        UBS_Core_Meta::register_meta();

        new UBS_Access_Control();
        new UBS_Follow_System();
        new UBS_Follow_Button();
        new UBS_Notification_System();
        new UBS_Admin_Notifications();
        new UBS_Author_Dashboard();
    }
}
