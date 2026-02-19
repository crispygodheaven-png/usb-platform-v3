<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UBS_Token_Manager {

    public function __construct() {
        add_action('init', [$this, 'check_token']);
    }

    public function generate_token($user_id, $chapter_id) {
        $token = wp_generate_password(20, false);
        update_user_meta($user_id, '_ubs_token_' . $chapter_id, $token);
        return $token;
    }

    public function check_token() {
        if (!isset($_GET['ubs_unlock'])) {
            return;
        }

        $chapter_id = intval($_GET['chapter']);
        $token = sanitize_text_field($_GET['ubs_unlock']);
        $user_id = get_current_user_id();

        $saved = get_user_meta($user_id, '_ubs_token_' . $chapter_id, true);

        if ($saved && $saved === $token) {
            add_filter('ubs_user_has_paid_access', function() {
                return true;
            });
        }
    }
}
