<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UBS_Admin_Notifications {

    public function __construct() {
        add_action('admin_menu', [$this, 'add_menu']);
    }

    public function add_menu() {
        add_menu_page(
            'UBS Notifications',
            'UBS Notifications',
            'manage_options',
            'ubs-notifications',
            [$this, 'render_page'],
            'dashicons-bell'
        );
    }

    public function render_page() {
        global $wpdb;
        $table = $wpdb->prefix . 'ubs_notifications';

        $notifications = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC LIMIT 50");

        echo '<div class="wrap"><h1>Recent Notifications</h1><ul>';
        foreach ($notifications as $note) {
            echo '<li>' . esc_html($note->message) . ' (' . esc_html($note->created_at) . ')</li>';
        }
        echo '</ul></div>';
    }
}
