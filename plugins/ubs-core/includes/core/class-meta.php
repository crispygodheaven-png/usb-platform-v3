<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UBS_Core_Meta {

    public static function register_meta() {

        register_post_meta('ubs_chapter', '_ubs_is_premium', [
            'type' => 'boolean',
            'single' => true,
            'default' => false,
            'show_in_rest' => true,
        ]);

        register_post_meta('ubs_chapter', '_ubs_access_type', [
            'type' => 'string',
            'single' => true,
            'default' => 'public', // public | followers | paid | both
            'show_in_rest' => true,
        ]);

    }
}
