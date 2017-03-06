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
        <link href="http://fonts.googleapis.com/css?family=Gudea:400,400italic,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/style.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/bxslider.css" />
        
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

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        
        <div class="container">
            <div class="header">
                <h1 style="display:inline;">
                    <?php echo __('IAM', 'iamdavidstutz'); ?>
                </h1>
                <h4 style="display:inline;">
                    <span class="hidden-xs-inline hidden-sm-inline">
                        <?php echo __('OPENSOURCEFAN', 'iamdavidstutz'); ?>
                    </span>
                    <span class="hidden-md-inline hidden-lg-inline">
                        <?php echo __('STUDYING', 'iamdavidstutz'); ?>
                    </span>
                    <br>
                    <span class="hidden-xs-inline hidden-sm-inline">
                        <?php echo __('STUDYINGCOMPUTERSCIENCEANDMATH', 'iamdavidstutz'); ?>
                        <a href="https://www.linkedin.com/in/davidstutz92" target="_blank" class="header-social"><span class="fa fa-linkedin-square"></span></a>
                        <a href="https://www.xing.com/profile/David_Stutz5" target="_blank" class="header-social"><span class="fa fa-xing"></span></a>
                        <a href="https://github.com/davidstutz" target="_blank" class="header-social"><span class="fa fa-github"></span></a>
                        <a href="https://twitter.com/david_stutz" target="_blank" class="header-social"><span class="fa fa-twitter"></span></a>
                    </span>
                    <span class="hidden-md-inline hidden-lg-inline">
                        <?php echo __('COMPUTERSCIENCE', 'iamdavidstutz'); ?><span class="hidden-sm hidden-xs"><?php echo __('ANDMATH', 'iamdavidstutz'); ?></span>
                    </span>
                </h4>
                <div class="row">
                    <div class="col-md-4">
                        <h1><?php echo __('DAVIDSTUTZ', 'iamdavidstutz'); ?></h1>
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
                <h4 class="hidden-md hidden-lg">
                    <?php echo __('RWTHSTUDENT', 'iamdavidstutz'); ?><span class="hidden-sm hidden-xs"><?php echo __('AND', 'iamdavidstutz'); ?></span>
                    <br class="hidden-sm hidden-lg"><?php echo __('GEORGIATECHALUMNI', 'iamdavidstutz'); ?><br>
                    <span class="hidden-sm hidden-xs"><?php echo __('SOFTWAREENGINEERANDWEBDEVELOPER', 'iamdavidstutz'); ?><br></span>
                    <?php echo __('COMPUTERVISION', 'iamdavidstutz'); ?><br class="hidden-md hidden-lg"><?php echo __('RESEARCHSCIENTIST', 'iamdavidstutz'); ?>
                </h4>
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
                <h4 class="hidden-sm hidden-xs">
                    <?php echo __('RWTHSTUDENTSOFTWAREENGINEER', 'iamdavidstutz'); ?><br>
                    <?php echo __('RESEARCHSCIENTIST', 'iamdavidstutz'); ?>
                </h4>
            </div>
        </div>
        <div class="container">
        