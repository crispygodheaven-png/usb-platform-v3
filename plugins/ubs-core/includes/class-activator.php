<?php

class UBS_Core_Activator {

    public static function activate() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $followers_table = $wpdb->prefix . 'ubs_followers';
        $notifications_table = $wpdb->prefix . 'ubs_notifications';

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $sql1 = "CREATE TABLE $followers_table (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id BIGINT UNSIGNED NOT NULL,
            author_id BIGINT UNSIGNED NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            KEY author_id (author_id)
        ) $charset_collate;";

        $sql2 = "CREATE TABLE $notifications_table (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id BIGINT UNSIGNED NOT NULL,
            message TEXT NOT NULL,
            is_read TINYINT(1) DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_id (user_id)
        ) $charset_collate;";

        dbDelta($sql1);
        dbDelta($sql2);

        flush_rewrite_rules();
    }

}
