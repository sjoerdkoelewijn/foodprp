<?php

include 'functions/custom-post-types.php';
include 'functions/enqueue.php';
include 'functions/menus.php';

if(strpos($_SERVER['HTTP_HOST'], 'foodprp.local') !== false){
	
	function favicon() {
		echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_template_directory_uri().'/images/localfavicon.ico" />';
	}
	add_action('wp_head', 'favicon');

} else {

	function favicon() {
		echo '<link rel="Shortcut Icon" type="image/x-icon" href="'. get_template_directory_uri() . '/images/favicon.ico" />';
	}
	add_action('wp_head', 'favicon');

};

add_theme_support( 'title-tag' );
add_theme_support( 'menus' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_post_type_support('page', 'excerpt');

/*************************** Remove wordpress functionality **********************************/

remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

/*************************** REMOVE ITEMS FROM ADMIN **********************************/

function remove_admin_menus() {

	remove_menu_page( 'edit.php' ); // Standard post

}

add_action( 'admin_menu', 'remove_admin_menus' );


function remove_default_post_type_menu_bar( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'new-post' ); // Default post from admin bar 
}
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );


function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );



/*************************** REMOVE COMMENTS EVERYWHERE **********************************/

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});


/*************************** Register Custom Thumbnail sizes *********************************/

	add_image_size( 'larger_image', 1920, 1280, false );  
	add_image_size( 'large_image', 1024, 768, false ); 
	add_image_size( 'medium_image', 800, 600, false ); 
    add_image_size( 'small_image', 300, 300, false );


/*************************** Get custom taxonomy function *********************************/

function sk_get_custom_taxonomy( $taxonomy_name, $template ) {

    // Get the taxonomy's terms
    $terms = get_terms(
        array(
            'taxonomy'   => $taxonomy_name,
            'hide_empty' => false,
        )
    );

    // Check if any term exists
    if ( ! empty( $terms ) && is_array( $terms ) ) {

        foreach ( $terms as $term ) { 

            if ($template = 'full') { 
               
                $featured_image = get_field('featured_image', $term); 
                $sub_header = get_field('sub_header', $term); 
                
                ?>         

                <a 
                    <?php if( $featured_image ): ?> 
                    style="background-image:url('<?php echo $featured_image['url']; ?>');" 
                    <?php endif; ?> 
                    class="category full" 
                    href="<?php echo esc_url( get_term_link( $term ) ) ?>"
                > 

                    <h1>
                        <?php echo $term->name; ?>
                    </h1>

                    <?php if( $featured_image ): ?>

                        <h2>
                            <?php echo $sub_header; ?>
                        </h2>

                    <?php endif; ?>

                </a>

            <?php } else { ?>

                <a class="category text" href="<?php echo esc_url( get_term_link( $term ) ) ?>">
                    <?php echo $term->name; ?>
                </a>
                
            <?php }

            
        }
    } 

}

add_action( 'init', function() {
    remove_post_type_support( 'recipes', 'editor');
}, 99);


/*************************** Use first image in gallery as the featured image on post save *********************************/


add_filter('acf/save_post', 'gallery_to_thumbnail');
function gallery_to_thumbnail($post_id) {
	$gallery = get_field('recipe_images', $post_id, false);
	if (!empty($gallery)) {
		$image_id = $gallery[0];
		set_post_thumbnail($post_id, $image_id);
	}
}

/*************************** Add IP whitelist section *********************************/


add_filter('admin_init', 'skdd_general_settings_register_fields'); 

function skdd_general_settings_register_fields() { 
register_setting('general', 'ip_whitelist', 'esc_attr'); 
add_settings_field('ip_whitelist', '<label for="ip_whitelist">'.__('IP Whitelist' , 'ip_whitelist' ).'</label>' , 'skdd_general_ip_whitelist', 'general'); } 

function skdd_general_ip_whitelist() { 
$ip_whitelist = get_option( 'ip_whitelist', '' ); 
echo '<input id="ip_whitelist" style="width: 80%;" type="text" name="ip_whitelist" value="' . $ip_whitelist . '" />'; }