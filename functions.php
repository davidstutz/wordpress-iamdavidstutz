<?php

if (!class_exists('IAMDAVIDSTUTZ_Shortcodes')) {
    require_once 'includes/iamdavidstutz-shortcodes.php';
}

if (!class_exists('IAMDAVIDSTUTZ_Footer_Walker')) {
    require_once 'includes/iamdavidstutz-footer-walker.php';
}

if (!class_exists('IAMDAVIDSTUTZ_Walker')) {
    require_once 'includes/iamdavidstutz-walker.php';
}

// http://wordpress.stackexchange.com/questions/91720/replace-html-entities-in-posts-between-pre-tags
add_filter('the_content', 'iamdavidstutz_pre_filter', 0);

// https://wordpress.org/support/topic/please-give-us-the-option-to-turn-of-smart-quotes/
remove_filter('the_content', 'wptexturize');

// http://wordpress.stackexchange.com/questions/42743/the-excerpt-and-shortcodes
add_filter('the_excerpt', 'do_shortcode');

/**
 * Replace content of pre tags with htmlentities.
 */
function iamdavidstutz_pre_filter($content) {
    return preg_replace_callback('|<pre.*>(.*)</pre|isU' , 'iamdavidstutz_pre_htmlentities', $content);
}

/**
 * Helper for replacing html entities.
 */
function iamdavidstutz_pre_htmlentities($matches) {
    return str_replace($matches[1], htmlentities($matches[1]), $matches[0]);
}

// https://wordpress.stackexchange.com/questions/44503/replace-image-urlsabsolute-instead-of-relative-by-using-filter-in-single-page
//if (is_single()) {
    add_filter('the_content', 'iamdavidstutz_png_to_jpg');
//}

/**
 * Replacing pngs with jpgs.
 */
function iamdavidstutz_png_to_jpg($content) {

    $matches = NULL;
    $regex = '#src="(http|https)://davidstutz.de/wordpress/(wp-content/uploads/[0-9]+/[0-9]+/[^.]+\.png)"#';
    preg_match_all($regex, $content, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $png_file = $match[2];
        $jpg_file = substr($png_file, 0, strlen($png_file) - 3) . 'jpg';
        
        if (file_exists(__DIR__ . '/../../../' . $jpg_file)) {
            $content = str_replace($png_file, $jpg_file, $content);
        }
    }

    return $content;
}

// https://paulund.co.uk/remove-line-breaks-in-shortcodes
remove_filter('the_content', 'wpautop');

/** 
 * Register categories and tags for pages.
 */
function iamdavidstutz_page_taxanomies() {
    register_taxonomy_for_object_type('post_tag', 'page');
    register_taxonomy_for_object_type('category', 'page');
}

add_action('init', 'iamdavidstutz_page_taxanomies');

/**
 * Add pages to tags and category archives.
 */
function iamdavidstutz_archives($wp_query) {
    $my_post_array = array('post', 'page');
    
    if ($wp_query->get('category_name') || $wp_query->get( 'cat' )) {
        $wp_query->set('post_type', $my_post_array);
    }
    
    if ($wp_query->get('tag')) {
        $wp_query->set('post_type', $my_post_array);
    }
}

if (!is_admin()) {
    add_action('pre_get_posts', 'iamdavidstutz_archives');
}

/**
 * Exclude "unread" category from being displayed in basic WP loop.
 */
//function iamdavidstutz_exclude_unread( $wp_query ) {
//    if (!is_category('reading') && !is_admin()) {
//        $unread = get_category_by_slug('unread');
//        $wp_query->set('category__not_in', array($unread->term_id));
//    }
//}

//add_action('pre_get_posts', 'iamdavidstutz_exclude_unread' );

/**
 * Exclude readings, personal on home page.
 */
function iamdavidstutz_home_categories($query) {
    if ($query->is_home) {
        $query->set('cat', '-46,-70,-82');
    }
    if (!$query->is_admin && $query->is_search && $query->is_main_query() ) {
        $query->set('cat', '-82');
        $query->set('post__not_in', array(11, 3745));
    }

    return $query;
}

add_filter('pre_get_posts', 'iamdavidstutz_home_categories');

/**
 * Register scripts already included hard coded.
 * Cleanup the head among others of the following items:
 * - feed links
 * - rsd link
 * - generator
 */
function iamdavidstutz_head_cleanup() {
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_deregister_script('jquery.validate');
        wp_register_script('jquery.validate', '', '', '', true);
        wp_register_script('jquery', '', '', '', true);
    }
}

add_action('init', 'iamdavidstutz_head_cleanup');

/**
 * Register custom menus for theme.
 */
function iamdavidstutz_register_custom_menus() {
    register_nav_menus(array(
        'top' => __('Top Menu', 'iamdavidstutz'),
        'footer' => __('Footer Menu', 'iamdavidstutz'),
    ));

    wp_dequeue_script('jquery', get_bloginfo('template_directory') . '/js/jquery.min.js');
}

add_action('init', 'iamdavidstutz_register_custom_menus');

/**
 * This function will add the 'active' class to the currently active li.
 * The function is added to as filter to the 'wp_nav_menu_top_items' hook.
 */
function iamdavidstutz_wp_nav_menu_top_items($items, $args = array()) {
    return str_replace('current_page_item', 'active', $items);
}

add_filter('wp_nav_menu_top_items', 'iamdavidstutz_wp_nav_menu_top_items');

/**
 * Add excerpts to pages.
 */
function iamdavidstutz_page_excerpts() {
    add_post_type_support('page', 'excerpt');
}

add_action('init', 'iamdavidstutz_page_excerpts');

/**
 * Display custom comments.
 *
 * @param   object  comment
 * @param   object  args
 * @param   integer depth
 */
function iamdavidstutz_custom_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    switch ($comment->comment_type):
        case 'pingback':
        case 'trackback':
    ?>
        <p class="pingback">
            <?php __('Pingback:', 'iamdavidstutz'); ?> <?php comment_author_link(); ?> <?php edit_comment_link('<span class="glyphicon glyphicon-pencil"></span>'); ?>
        </p>
        <?php break; ?>
    <?php default: ?>
        <?php if ($comment->comment_approved == '0') : ?>
            <div class="alert alert-info"><?php __('Your comment is awaiting moderation.', 'iamdavidstutz'); ?></div>
        <?php endif; ?>
        <blockquote class="article-comment">
            <?php $time = strtotime($comment->comment_date); ?>
            <h4>
                <?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                 &mdash;
                <a href="<?php echo $comment->comment_author_url; ?>"><?php echo $comment->comment_author; ?></a>
                <?php if (current_user_can('edit_comment',$comment->comment_ID)): ?>
                    <small class="article-comment-edit">
                        <a href="<?php echo get_edit_comment_link($comment->comment_ID); ?>"><?php echo __('Edit', 'iamdavidstutz'); ?></a>
                    </small>
                <?php endif; ?>
            </h4>
            <?php comment_text(); ?>
        </blockquote>
        <?php break; ?>
    <?php endswitch;
}

/**
 * Simple "Older" - "Newer" pagination.
 *
 * @param   integer pages
 * @param   integer range
 * @return  string  html
 */
function iamdavidstutz_pagination_simple() {
    ?>
    <div style="text-align:center;">
        <ul class="pagination pagination-sm">
            <li><?php previous_posts_link('NEWER'); ?></li>
            <li><?php next_posts_link('OLDER'); ?></li>
        </ul>
    </div>
    <?php
}

/**
 * Get custom ul for listing the archive.
 *
 * @return  stirng  html
 */
function iamdavidstutz_get_archives() {
    global $wpdb;

    // Check when the posts where changed last for using the cache.
    $last_changed = wp_cache_get('last_changed', 'posts');
    if (!$last_changed) {
        $last_changed = microtime();
        wp_cache_set('last_changed', $last_changed, 'posts');
    }

    // Take cached archives if possible.
    $query = 'SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM ' . $wpdb->posts . ' WHERE post_type = \'post\' AND post_status = \'publish\' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY YEAR(post_date) DESC, MONTH(post_date) DESC';
    $md5 = md5($query);
    $key = "wp_get_archives:$md5:$last_changed";

    if (!$results = wp_cache_get($key, 'posts')) {
        $results = $wpdb->get_results($query);
        wp_cache_set($key, $results, 'posts');
    }

    $html = '<ul class="list-unstyled">';
    if ($results) {
        $year = NULL;
        foreach ((array) $results as $result) {
            if ($year === NULL || $year !== $result->year) {
                $html .= '<li class="sidebar-archives-year"><b>' . $result->year . ' &mdash;</b></li>';
                $year = $result->year;
            }

            $html .= '<li><a href="' . get_month_link($result->year, $result->month) . '">' . strtoupper(date("F", mktime(0, 0, 0, $result->month, 1, date('Y', time())))) . '</a></li>';

        }
    }
    $html .= '</ul>';

    return $html;
}

/**
 * Article template, assumes that it is called in the loop, i.e. the_content() etc.
 * refer to the current content.
 */
function iamdavidstutz_article() {
    ?>
    <div class="article-container">
        <div class="article">
            <div class="article-date">
                <?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
            </div>
            <?php if(in_category('series')): ?>
                <div class="article-above-header">
                    <h3><?php echo __('SERIES', 'iamdavidstutz'); ?>&raquo;<?php the_field('series'); ?>&laquo;</h3>
                </div>
            <?php else: ?>
                <div class="article-above-header">
                    <h3><?php echo __('ARTICLE', 'iamdavidstutz'); ?></h3>
                </div>
            <?php endif; ?>
            <div class="article-header">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </div>
            <?php iamdavidstutz_article_tags(); ?>
            <div class="article-excerpt">
                <?php the_excerpt(); ?>
                <p>
                    <a href="<?php the_permalink(); ?>" class="pull-right btn btn-primary article-more"><?php echo __('More ...'); ?></a>
                </p>
                <p class="clearfix"></p>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Tags for articles.
 */
function iamdavidstutz_article_tags() {
    $tags = get_the_tags(); ?>
    <div class="article-tags-alternative">
        <?php if ($tags): ?>
            <?php foreach ($tags as $tag): ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>"><span class="label label-primary"><?php echo strtoupper($tag->name); ?></span></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Reading template, assumes that it is called in the loop, i.e. the_content() works.
 */
 function iamdavidstutz_reading() {
     ?>
     <div class="reading-container">
        <div class="reading">
            <div class="reading-date">
                <?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
            </div>
            <div class="reading-above-header">
                <h3><?php echo __('READING NOTES', 'iamdavidstutz'); ?></h3>
            </div>
            <div class="reading-reference">
                <a class="reading-reference-link" href="<?php the_permalink(); ?>"><?php the_field('reference'); ?></a>
            </div>
            <?php iamdavidstutz_reading_tags(); ?>
            <p>
                <div class="pull-right">
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary reading-more"><?php echo __('More ...'); ?></a>
                </div>
            </p>
            <p class="clearfix"></p>
        </div>
    </div>
    <?php
}

/**
 * Tags for readings.
 */
function iamdavidstutz_reading_tags() {
    $tags = get_the_tags(); ?>
    <div class="reading-tags-alternative">
        <?php if ($tags): ?>
            <?php foreach ($tags as $tag): ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>"><span class="label label-primary"><?php echo strtoupper($tag->name); ?></span></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Display reading in reading list.
 */
function iamdavidstutz_list_reading() {
    ?>
    <li class="reading-list-item">
        <span class="reading-list-item-reference">
            <?php the_field('reference'); ?>
        </span>
        &nbsp;
        <a href="<?php the_permalink(); ?>"><?php echo __('Reading Notes'); ?></a>
    </li>
    <?php
}

/**
 * Page template.
 */
function iamdavidstutz_page() {
    ?>
    <div class="page-container">
        <div class="page">
            <div class="page-date">
                <?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
            </div>
            <?php $ind = strpos(get_page_template(), 'projects'); ?>
            <?php if ($ind >= 0): ?>
                <div class="page-above-header">
                    <h3><?php echo __('PROJECT', 'iamdavidstutz'); ?></h3>
                </div>
            <?php else: ?>
            <div class="page-above-header">
                    <h3><?php echo __('PAGE', 'iamdavidstutz'); ?></h3>
                </div>
            <?php endif; ?>
            <div class="page-header">
                <h2>
                    <?php if (!get_field('inactive')): ?>
                        <a href="<?php the_permalink(); ?>">
                    <?php endif; ?>
                        <?php the_title(); ?>
                    <?php if (!get_field('inactive')): ?>
                    </a>
                    <?php endif; ?>
                </h2>
            </div>
            <?php iamdavidstutz_page_tags(); ?>
            <div class="page-excerpt">
                <?php the_excerpt(); ?>
                <?php if (!get_field('inactive')): ?>
                    <p>
                        <a href="<?php the_permalink(); ?>" class="pull-right btn btn-primary page-more"><?php echo __('More ...'); ?></a>
                    </p>
                <?php else: ?>
                    <p>
                        <button class="pull-right btn btn-default page-more"><?php echo __('Coming Soon!'); ?></button>
                    </p>
                <?php endif; ?>
                <p class="clearfix"></p>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Tags for pages.
 */
function iamdavidstutz_page_tags() {
    $tags = get_the_tags(); ?>
    <div class="page-tags-alternative">
        <?php if ($tags): ?>
            <?php foreach ($tags as $tag): ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>"><span class="label label-primary"><?php echo strtoupper($tag->name); ?></span></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Display page footer.
 */
function iamdavidstutz_page_footer() {
    // Nothing ...
}

/**
 * Display post footer.
 */
function iamdavidstutz_article_footer() {
    // Nothing ...
}

/**
 * Display related links of page.
 *
 * @param   int id
 */
function iamdavidstutz_related_links($id, $break = TRUE) {

    if ($string = get_field('related-links', $id)) {
        if (!empty($string)) {
            ?> <b><?php echo __('LINKS:', 'iamdavidstutz'); ?></b><br> <?php

            $links = explode(';', $string);
            foreach ($links as $link) {
                $parts = str_getcsv($link, ':', '"');

                if (sizeof($parts) == 2) {
                    $title = $parts[0];
                    $href = $parts[1];
                    ?><a href="<?php echo $href; ?>" target="_blank"><?php echo $title; ?></a><?php if ($break): ?><br><?php else: ?>;&nbsp;<?php endif; ?><?php
                }
            }
        }
    }
}

/**
 * Display related links of page.
 *
 * @param   int id
 */
function iamdavidstutz_related_links_dashed($id) {

    if ($string = get_field('related-links', $id)) {
        if (!empty($string)) {
            ?> <b><?php echo __('LINKS:', 'iamdavidstutz'); ?></b>&nbsp;<?php

            $links = explode(';', $string);
            $first = TRUE;
            foreach ($links as $link) {
                $parts = str_getcsv($link, ':', '"');

                if (sizeof($parts) == 2) {
                    $title = $parts[0];
                    $href = $parts[1];
                    ?><?php if ($first === TRUE): $first = FALSE; else: ?> &mdash; <?php endif; ?><a href="<?php echo $href; ?>" target="_blank"><?php echo $title; ?></a> <?php
                }
            }
        }
    }
}

/**
 * Display related publications.
 *
 * @param   int id
 */
function iamdavidstutz_related_publications($id) {
    if ($string = get_field('related-publications', $id)) {
        if (!empty($string)) {
            ?> <b><?php echo __('PUBLICATIONS:', 'iamdavidstutz'); ?></b>&nbsp;<?php echo $string;
        }
    }
}

/**
 * Workaround for current bug: post comment_status always set to closed ...
 *
 * @param   int     id
 * @return  boolean comments open
 */
function iamdavidstutz_comments_open($id = NULL) {
    global $post, $wpdb;

    if ($id === NULL OR empty($id)) {
        $id = $post->ID;
    }

    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'posts WHERE ID = ' . $id);
    return ($results[0]->comment_status == 'open');
}

/**
 * Get ID of latest post to highlight.
 *
 * @return  int ID
 */
function iamdavidstutz_latest_post_id() {
    $posts = wp_get_recent_posts(array(
        'numberposts' => 1,
        'post_type' => 'post',
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => 'reading',
                'operator' => 'NOT IN'
            ),
        ),
    ));

    if (sizeof($posts) <= 0) {
        return FALSE;
    }

    $recent = array_shift($posts);
    return $recent['ID'];
}
