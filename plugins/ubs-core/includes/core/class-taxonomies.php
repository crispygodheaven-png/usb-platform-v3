<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UBS_Core_Taxonomies {

    public function register() {
        add_action( 'init', array( $this, 'register_book_category' ) );
    }

    public function register_book_category() {

        register_taxonomy( 'ubs_book_category', 'ubs_book', array(
            'label' => 'Book Categories',
            'hierarchical' => true,
            'public' => true,
        ) );

    }

}
