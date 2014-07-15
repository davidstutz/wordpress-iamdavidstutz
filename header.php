<!DOCTYPE html>

<html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>
            <?php
            if (defined('WPSEO_VERSION')) {
                wp_title('');
            }
            else {
                /*
                 * Print the <title> tag based on what is being viewed.
                 */
                global $page, $paged;

                wp_title( '&bull;', true, 'right' );

                bloginfo( 'name' );

                $site_description = get_bloginfo( 'description', 'display' );
                if ( $site_description && ( is_home() || is_front_page() ) ) {
                    echo " | $site_description";
                }

                if ( $paged >= 2 || $page >= 2 ) {
                    echo ' | ' . __( 'Page ', 'iamdavidstutz' ) . max( $paged, $page );
                }
            }
            ?>
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="http://fonts.googleapis.com/css?family=Gudea:400,400italic,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/style.css" />

        <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery.js"></script>
        <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery-validate.js"></script>
        <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/respond.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="../js/html5shiv.js"></script>
            <script src="../js/respond.js"></script>
        <![endif]-->

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        
        <div class="container">
            <div class="header">
                <h1 style="display:inline;">
                    <?php echo __('IAM', 'iamdavidstutz'); ?>
                </h1>
                <h4 style="display:inline;">
                    <span class="hidden-xs-inline">
                        <?php echo __('OPENSOURCEFAN', 'iamdavidstutz'); ?>
                    </span>
                    <span class="header-navigation">
                        <?php wp_nav_menu(array(
                            'menu' => 'header',
                            'menu_class' => '',
                            'theme_location' => 'header',
                            'container' => FALSE,
                            'depth' => 1,
                            'items_wrap' => '%3$s',
                            'walker' => new IAMDAVIDSTUTZ_Header_Walker(),
                        )); ?>
                    </span>
                    <br>
                    <span class="hidden-xs-inline">
                        <?php echo __('STUDYINGMATHANDCOMPUTERSCIENCE', 'iamdavidstutz'); ?>
                        <a href="https://twitter.com/david_stutz" target="_blank" class="header-social"><span class="elusive icon-twitter"></span></a>
                        <a href="https://github.com/davidstutz" target="_blank" class="header-social"><span class="elusive icon-github"></span></a>
                    </span>
                </h4>
                <div class="row">
                    <div class="col-md-4">
                        <h1><?php echo __('DAVIDSTUTZ', 'iamdavidstutz'); ?></h1>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav nav-pills">
                            <?php wp_nav_menu(array(
                                'menu' => 'top',
                                'menu_class' => '',
                                'theme_location' => 'top',
                                'container' => FALSE,
                                'depth' => 1,
                                'items_wrap' => '%3$s',
                                'walker' => new IAMDAVIDSTUTZ_Walker(),
                            )); ?>
                        </ul>
                    </div>
                </div>
                <h4 class="hidden-xs">
                    <?php echo __('RWTHSTUDENTWEBDEVELOPER', 'iamdavidstutz'); ?><br>
                    <?php echo __('VIDEOGAMEENTHUSIAST', 'iamdavidstutz'); ?>
                </h4>
            </div>
				
		
