<!DOCTYPE html>

<html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/images/logo.ico">
        <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/images/logo.ico">
        
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

                wp_title('&bull;', true, 'right');

                bloginfo('name');

                $site_description = get_bloginfo('description', 'display');
                if ($site_description && (is_home() || is_front_page())) {
                    echo " | $site_description";
                }

                if ($paged >= 2 || $page >= 2) {
                    echo ' | ' . __('Page ', 'iamdavidstutz') . max($paged, $page);
                }
            }
            ?>
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/fonts.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/style.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/bxslider.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/academicons.min.css" />

        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-validate.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/respond.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bxslider.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="../js/html5shiv.js"></script>
            <script src="../js/respond.js"></script>
        <![endif]-->

        <?php if (is_admin_bar_showing()): ?>
            <style type="text/css">
                .sidebar.affix {
                    top: 52px !important;
                }
            </style>
        <?php else: ?>
            <style type="text/css">
                .sidebar.affix {
                    top: 20px !important;
                }
            </style>
        <?php endif; ?>

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        
        <div class="container">
            <div class="header">
                <h1 style="display:inline;">
                <a href="https://davidstutz.de/" class="nostyle"><?php echo __('I', 'iamdavidstutz'); ?><span style="margin-right:6px;"></span><?php echo __('AM', 'iamdavidstutz'); ?></a>
                </h1>
                <h5 style="display:inline;">
                    <br class="hidden-md hidden-lg">
                    <span>
                        <a href="https://twitter.com/davidstutz92" target="_blank" class="header-social"><span class="fa fa-twitter"></span></a>
                        <a href="https://www.linkedin.com/in/davidstutz92" target="_blank" class="header-social"><span class="fa fa-linkedin-square"></span></a>
                        <a href="https://www.xing.com/profile/David_Stutz5" target="_blank" class="header-social"><span class="fa fa-xing"></span></a>
                        <a href="https://github.com/davidstutz" target="_blank" class="header-social"><span class="fa fa-github"></span></a>
                        <a href="https://scholar.google.com/citations?user=TxEy3cwAAAAJ&hl=en" target="_blank" class="header-social"><span class="ai ai-google-scholar"></span></a>
                        <a href="https://www.youtube.com/channel/UCfhh-OAwqkGbX_RN87Ht3ow" target="_blank" class="header-social"><span class="fa fa-youtube"></span></a>
                    </span>
                </h5>
                <div class="row">
                    <div class="col-md-4">
                        <h1><a href="https://davidstutz.de/" class="nostyle"><?php echo __('DAVID', 'iamdavidstutz'); ?><span style="margin-right:6px;"></span><?php echo __('STUTZ', 'iamdavidstutz'); ?></a></h1>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav nav-pills hidden-xs hidden-sm">
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
                <div>
                    <hr class="hidden-lg hidden-md">
                    <ul class="nav nav-pills nav-stacked hidden-md hidden-lg">
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
                    <hr class="hidden-lg hidden-md">
                </div>
            </div>
        </div>

        <div class="container">
        
