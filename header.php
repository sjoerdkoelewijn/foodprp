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

    </head>
    
    <body <?php body_class(); ?> >

        <header class="header">

            <a title="<?php bloginfo( 'name' ); ?>" aria-label="Visit the Homepage" class="logo" href="/">
                <img src="<?php echo get_template_directory_uri() . "/images/svg/logo.svg" ?>" alt="logo">
            </a>

            <?php // include('parts/main-menu.php'); ?>      

        </header>

        