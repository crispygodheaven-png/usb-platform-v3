<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UBS_Notification_System {

    public function __construct() {
        add_action('publish_ubs_chapter', [$this, 'notify_on_publish'], 10, 2);
    }

    public function notify_on_publish($post_id, $post) {

        $author_id = $post->post_author;
        $message = 'New chapter published: ' . get_the_title($post_id);

        $this->notify_followers($author_id, $message);
    }

    public function notify_followers($author_id, $message) {
        global $wpdb;

        $followers_table     = $wpdb->prefix . 'ubs_followers';
        $notifications_table = $wpdb->prefix . 'ubs_notifications';

        $followers = $wpdb->get_results(
            $wpdb->prepare("SELECT user_id FROM $followers_table WHERE author_id = %d", $author_id)
        );

        foreach ($followers as $follower) {
            $wpdb->insert($notifications_table, [
                'user_id' => $follower->user_id,
                'message' => $message,
            ]);
        }
    }
}
