<!DOCTYPE html>

<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->

<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

        <?php wp_head(); ?>

        <?php if ( has_post_thumbnail() ) {
            $attachment_image = wp_get_attachment_url( get_post_thumbnail_id(), 'larger_image' );
            echo '<link rel="preload" as="image" href="' . esc_attr( $attachment_image ) . '">';  
        } ?>

    </head>
    
    <body <?php body_class(); ?> >

        <?php if ( is_front_page() && has_post_thumbnail() ) { ?>
            
            <img loading="lazy" class="bg_image" src="<?php echo esc_attr( $attachment_image ); ?>">
            
        <?php } ?>

        <header class="header">

            <a title="<?php bloginfo( 'name' ); ?>" aria-label="Visit the Homepage" class="logo" href="/">
                <?php echo file_get_contents(get_template_directory() . "/images/svg/logo.svg"); ?>
            </a>

            <?php // include('parts/main-menu.php'); ?>      

        </header>

        