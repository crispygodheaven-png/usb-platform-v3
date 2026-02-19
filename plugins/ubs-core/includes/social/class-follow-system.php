<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UBS_Follow_System {

    public function __construct() {
        add_action('wp_ajax_ubs_follow_author', [$this, 'follow_author']);
    }

    public function follow_author() {

        check_ajax_referer('ubs_follow_nonce', 'nonce');

        if ( ! is_user_logged_in() ) {
            wp_send_json_error('Not logged in');
        }

        global $wpdb;
        $table = $wpdb->prefix . 'ubs_followers';

        $user_id   = get_current_user_id();
        $author_id = intval($_POST['author_id']);

        // Prevent duplicate follow
        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM $table WHERE user_id = %d AND author_id = %d",
            $user_id, $author_id
        ));

        if ($exists) {
            wp_send_json_error('Already following');
        }

        $wpdb->insert($table, [
            'user_id'   => $user_id,
            'author_id' => $author_id
        ]);

        wp_send_json_success('Followed successfully');
    }
}
