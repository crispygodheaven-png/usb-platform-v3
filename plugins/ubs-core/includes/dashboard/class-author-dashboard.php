<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class UBS_Author_Dashboard {

    public function __construct() {
        add_shortcode('ubs_author_dashboard', [$this, 'render_dashboard']);
    }

    public function render_dashboard() {

        if (!is_user_logged_in()) {
            return '<p>Please login to view dashboard.</p>';
        }

        global $wpdb;
        $user_id = get_current_user_id();

        $followers_table = $wpdb->prefix . 'ubs_followers';
        $followers_count = $wpdb->get_var(
            $wpdb->prepare("SELECT COUNT(*) FROM $followers_table WHERE author_id = %d", $user_id)
        );

        $chapters = count(get_posts([
            'post_type' => 'ubs_chapter',
            'author'    => $user_id,
            'numberposts' => -1
        ]));

        $stripe = get_user_meta($user_id, '_ubs_stripe_link', true);

        ob_start();
        ?>

        <div class="ubs-dashboard">
            <h2>Author Dashboard</h2>
            <p><strong>Followers:</strong> <?php echo intval($followers_count); ?></p>
            <p><strong>Chapters Published:</strong> <?php echo intval($chapters); ?></p>
            <p><strong>Stripe Linked:</strong> <?php echo $stripe ? 'Yes' : 'No'; ?></p>
        </div>

        <?php
        return ob_get_clean();
    }
}
