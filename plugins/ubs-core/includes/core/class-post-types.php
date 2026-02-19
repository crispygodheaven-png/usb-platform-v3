<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UBS_Core_Post_Types {

    public function register() {

        add_action( 'init', array( $this, 'register_book_post_type' ) );
        add_action( 'init', array( $this, 'register_chapter_post_type' ) );

    }

    public function register_book_post_type() {

        register_post_type( 'ubs_book', array(
            'labels' => array(
                'name' => 'Books',
                'singular_name' => 'Book'
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'books' ),
            'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
        ) );

    }

    public function register_chapter_post_type() {

        register_post_type( 'ubs_chapter', array(
            'labels' => array(
                'name' => 'Chapters',
                'singular_name' => 'Chapter'
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array( 'slug' => 'chapter' ),
            'supports' => array( 'title', 'editor', 'author' ),
        ) );

    }

}
