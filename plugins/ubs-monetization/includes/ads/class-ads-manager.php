<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UBS_Ads_Manager {

    public function __construct() {
        add_filter('the_content', [$this, 'inject_ads'], 5);
    }

    public function inject_ads($content) {

        if (get_post_type() === 'ubs_chapter' || get_post_type() === 'ubs_book') {

            $ad_code = '<div class="ubs-ad">AdSense Placeholder</div>';

            return $ad_code . $content . $ad_code;
        }

        return $content;
    }
}
