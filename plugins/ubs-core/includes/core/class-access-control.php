<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UBS_Access_Control {

    public function __construct() {
        add_filter('the_content', [$this, 'restrict_premium_content']);
    }

    private function is_follower($author_id, $user_id) {
        global $wpdb;
        $table = $wpdb->prefix . 'ubs_followers';

        return (bool) $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM $table WHERE author_id = %d AND user_id = %d",
            $author_id, $user_id
        ));
    }

    public function restrict_premium_content($content) {

        if ( get_post_type() !== 'ubs_chapter' ) {
            return $content;
        }

        $access_type = get_post_meta(get_the_ID(), '_ubs_access_type', true);
        $author_id   = get_post_field('post_author', get_the_ID());

        if ($access_type === 'public') {
            return $content;
        }

        if (!is_user_logged_in()) {
            return '<p>This chapter requires login.</p>';
        }

        $user_id = get_current_user_id();

        if ($access_type === 'followers' && ! $this->is_follower($author_id, $user_id)) {
            return '<p>You must follow this author to access this chapter.</p>';
        }

        // Paid logic handled later by monetization plugin

        return $content;
    }
}
