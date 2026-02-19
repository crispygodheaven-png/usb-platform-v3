<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class UBS_Follow_Button {

    public function __construct() {
        add_shortcode('ubs_follow_button', [$this, 'render_button']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_script']);
    }

    public function enqueue_script() {
        wp_enqueue_script(
            'ubs-follow-js',
            UBS_CORE_URL . 'assets/js/follow.js',
            ['jquery'],
            UBS_CORE_VERSION,
            true
        );

        wp_localize_script('ubs-follow-js', 'ubs_follow', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('ubs_follow_nonce')
        ]);
    }

    public function render_button($atts) {

        if (!is_user_logged_in()) {
            return '<p>Login to follow.</p>';
        }

        $author_id = isset($atts['author']) ? intval($atts['author']) : get_the_author_meta('ID');

        return '<button class="ubs-follow-btn" data-author="' . esc_attr($author_id) . '">Follow</button>';
    }
}
