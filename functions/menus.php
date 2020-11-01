<?php 
/*************************** Register menus **********************************/

register_nav_menus( array(
	'main-navigation' => __( 'Main Navigation', 'hashmuseum' ),	
	'footer-links' => __( 'Footer Links', 'hashmuseum' ),
	'social-menu' => __( 'Social Menu', 'hashmuseum' ),
) );


/*************************** Custom Menu Walker **********************************/

class Social_Menu_Walker extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {

		$title = $item->title;
		$permalink = $item->url;
		$socialIcon = file_get_contents(get_template_directory() . "/images/svg/$title.svg");

		$output .= "<div class='" . $title . implode(" ", $item->classes) . "'>";
		$output .= '<a title="' . $title . '" href="' . $permalink . '">';
		$output .= '<span class="icon">' . $socialIcon . '</span>';  
		$output .= '</a>';
		$output .= '</div>';

	}

}

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	
	// loop
	foreach( $items as &$item ) {
		
		// vars
		$custom_style = get_field('custom_style', $item);
		$button_text = get_field('button_text', $item);
		$image_ad = get_field('image_ad', $item);
		
		
		// append icon
		if( $custom_style != 'none' ) {

			if( $custom_style === 'text' ) {
				$item->title .= '<span class="button">'.$button_text.'</span>';				
			}

			if( $custom_style === 'image' ) {
				$item->title .= '<img src="'.$image_ad['url'].'" /><span class="link">'.$button_text.'</span>';
			}

		}		
		
	}
	
	
	// return
	return $items;
	
}