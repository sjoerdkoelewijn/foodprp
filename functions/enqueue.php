<?php

/*************************** Dequeue Default Block Styles **********************************/

function sk_dequeue_block_styles(){
	//wp_dequeue_style( 'wp-block-library' );
	//wp_dequeue_style( 'wp-block-library-theme' );
   }

   if (!is_admin()) {
   	//add_action( 'wp_enqueue_scripts', 'sk_dequeue_block_styles', 99 );
   }

/*************************** Dequeue WP Embed **********************************/

function sk_deregister_embed(){
		wp_dequeue_script( 'wp-embed' );
	}

add_action( 'wp_footer', 'sk_deregister_embed' );   

/*************************** Enqueue Styles **********************************/

function foodprp_styles() {

	$filename = get_stylesheet_directory() . '/src/css/style.css';
	$timestamp = filemtime($filename);

	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900', NULL, NULL, 'all' );

	wp_enqueue_style('foodprp-styles', get_template_directory_uri() . '/src/css/style.css', NULL, $timestamp, 'all' );

}
add_action( 'wp_enqueue_scripts', 'foodprp_styles', 99 );


function admin_styles() {

	$filename = get_stylesheet_directory() . '/src/css/admin.css';
	$timestamp = filemtime($filename);
	wp_enqueue_style('admin-styles', get_template_directory_uri() . '/src/css/admin.css', NULL, $timestamp, 'all' );

}
add_action('admin_enqueue_scripts', 'admin_styles');


/*************************** Enqueue Scripts **********************************/

function foodprp_scripts() {

	$filename = get_stylesheet_directory() . '/src/js/app.js';
	$timestamp = filemtime($filename);

	if (!is_admin()) {
		//wp_deregister_script('jquery');
	}

	wp_enqueue_script('foodprp-app', get_template_directory_uri() . '/src/js/app.js', NULL, $timestamp, TRUE);

}
add_action( 'wp_enqueue_scripts', 'foodprp_scripts', 99 );