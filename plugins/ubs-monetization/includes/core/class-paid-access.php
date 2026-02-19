<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class UBS_Paid_Access {

    public function __construct() {
        add_filter('the_content', [$this, 'handle_paid_content'], 20);
    }

    public function handle_paid_content($content) {

        if ( get_post_type() !== 'ubs_chapter' ) {
            return $content;
        }

        $access_type = get_post_meta(get_the_ID(), '_ubs_access_type', true);

        if ($access_type !== 'paid' && $access_type !== 'both') {
            return $content;
        }

        if (!is_user_logged_in()) {
            return UBS_Paywall_Template::render('');
        }

        $user_id = get_current_user_id();
        $has_access = apply_filters('ubs_user_has_paid_access', false, $user_id, get_the_ID());

        if (!$has_access) {
            $purchase_link = get_user_meta(get_post_field('post_author', get_the_ID()), '_ubs_stripe_link', true);
            return UBS_Paywall_Template::render($purchase_link);
        }

        return $content;
    }
}
