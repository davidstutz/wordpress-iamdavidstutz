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

// https://paulund.co.uk/remove-line-breaks-in-shortcodes
remove_filter('the_content', 'wpautop');

/**
 * Exclude "unread category from being displayed in basic WP loop.
 */
//function iamdavidstutz_exclude_unread( $wp_query ) {
//    if (!is_category('reading') && !is_admin()) {
//        $unread = get_category_by_slug('unread');
//        $wp_query->set('category__not_in', array($unread->term_id));
//    }
//}

//add_action('pre_get_posts', 'iamdavidstutz_exclude_unread' );

/**
 * Exclude readings, snippets on home page.
 */
function iamdavidstutz_home_categories($query) {
    if ($query->is_home) {
        $query->set('cat', '-46,-70');
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
                <?php $day = date('d', $time); ?>
                <?php if ($day == 1): ?>
                    <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php elseif ($day == 2): ?>
                    <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php elseif ($day == 2): ?>
                    <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php else: ?>
                    <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php endif; ?>
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
            <li><?php previous_posts_link('<b>NEWER</b>ARTICLES'); ?></li>
            <li><?php next_posts_link('<b>OLDER</b>ARTICLES'); ?></li>
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
    $query = 'SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM ' . $wpdb->posts . ' WHERE post_type = \'post\' AND post_status = \'publish\' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY YEAR(post_date) DESC, MONTH(post_date) DESC LIMIT 12';
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
                <?php $day = get_the_date('d'); ?>
                <?php if ($day == 1): ?>
                    <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php elseif ($day == 2): ?>
                    <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php elseif ($day == 3): ?>
                    <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php else: ?>
                    <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php endif; ?>
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
                    <a href="<?php the_permalink(); ?>" class="pull-right btn btn-default article-more"><?php echo __('Interested?'); ?></a>
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
                <?php $day = get_the_date('d'); ?>
                <?php if ($day == 1): ?>
                    <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php elseif ($day == 2): ?>
                    <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php elseif ($day == 3): ?>
                    <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php else: ?>
                    <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php endif; ?>
            </div>
            <div class="reading-above-header">
                <h3><?php echo __('READING', 'iamdavidstutz'); ?></h3>
            </div>
            <div class="reading-reference">
                <a class="reading-reference-link" href="<?php the_permalink(); ?>"><?php the_field('reference'); ?></a>
            </div>
            <?php iamdavidstutz_reading_tags(); ?>
            <p>
                <a href="<?php the_permalink(); ?>" class="pull-right btn btn-default reading-more"><?php echo __('Interested?'); ?></a>
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
 * Display snippet.
 */
function iamdavidstutz_snippet() {
    ?>
    <div class="snippet-container">
        <div class="snippet">
            <div class="snippet-date">
                <?php $day = get_the_date('d'); ?>
                <?php if ($day == 1): ?>
                    <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php elseif ($day == 2): ?>
                    <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php elseif ($day == 3): ?>
                    <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php else: ?>
                    <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php endif; ?>
            </div>
            <div class="snippet-above-header">
                <h3><?php echo __('SNIPPET', 'iamdavidstutz'); ?></h3>
            </div>
            <div class="snippet-header">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </div>
            <?php iamdavidstutz_snippet_tags(); ?>
            <div class="snippet-excerpt">
                <?php the_excerpt(); ?>
            </div>
            <p>
                <a href="<?php the_permalink(); ?>" class="pull-right btn btn-default snippet-more"><?php echo __('Interested?'); ?></a>
            </p>
            <p class="clearfix"></p>
        </div>
    </div>
    <?php
}

/**
 * Display snippet in list.
 */
function iamdavidstutz_list_snippet() {
    ?>
    <li class="snippet-list-item">
        <span class="snippet-list-item-title">
            <?php the_title(); ?>
        </span>
        <?php if (get_field('github')): ?>
            &nbsp;
            <a href="<?php the_field('github'); ?>" target="_blank"><?php echo __('GitHub', 'iamdavidstutz'); ?><i style="margin-left:6px;font-size:80%" class="fa fa-external-link"></i></a>
        <?php endif; ?>
        &nbsp;
        <a href="<?php the_permalink(); ?>"><?php echo __('Details'); ?></a>
    </li>
    <?php
}

/**
 * Tags for snippets.
 */
function iamdavidstutz_snippet_tags() {
    $tags = get_the_tags(); ?>
    <div class="snippet-tags-alternative">
        <?php if ($tags): ?>
            <?php foreach ($tags as $tag): ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>"><span class="label label-primary"><?php echo strtoupper($tag->name); ?></span></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
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
                <?php $day = get_the_date('d'); ?>
                <?php if ($day == 1): ?>
                    <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php elseif ($day == 2): ?>
                    <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php elseif ($day == 3): ?>
                    <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php else: ?>
                    <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                <?php endif; ?>
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
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </div>
            <div class="page-excerpt">
                <?php the_excerpt(); ?>

                <?php if ($ind >= 0): ?>
                    <?php iamdavidstutz_related_links(get_the_ID(), FALSE); ?>
                <?php endif; ?>

                <p>
                    <a href="<?php the_permalink(); ?>" class="pull-right btn btn-default page-more"><?php echo __('Interested?'); ?></a>
                </p>
                <p class="clearfix"></p>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Display page footer.
 */
function iamdavidstutz_page_footer() {
    $tags = get_the_tags(); ?>
    <!--
    <div class="page-footer">
        <span class="page-footer-modified text-muted">
            <?php echo __('LASTMODIFIED', 'iamdavidstutz'); ?>
            <?php $day = get_the_modified_time('d'); ?>
            <?php if ($day == 1): ?>
                <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_modified_time('F')); ?><?php echo get_the_modified_time('Y'); ?>
            <?php elseif ($day == 2): ?>
                <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_modified_time('F')); ?><?php echo get_the_modified_time('Y'); ?>
            <?php elseif ($day == 3): ?>
                <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_modified_time('F')); ?><?php echo get_the_modified_time('Y'); ?>
            <?php else: ?>
                <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_modified_time('F')); ?><?php echo get_the_modified_time('Y'); ?>
            <?php endif; ?>
        </span>
    </div
    -->
    <?php if ($tags): ?>
        <span class="page-footer-tags">
            <?php foreach ($tags as $tag): ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>"><span class="label label-primary"><?php echo strtoupper($tag->name); ?></span>
            <?php endforeach; ?>
        </span>
    <?php endif;
}

/**
 * Display post footer.
 */
function iamdavidstutz_article_footer() {
    // Get corresponding suer.
    $id = get_the_author_meta('ID');
    $user = get_user_by('id', $id);

    ?>
    <div class="article-author">
        <?php $query = new WP_query('post_type=ub_part&post_author=' . $user->ID . '&posts_per_page=1'); ?>
        <?php while ($query->have_posts()): $query->the_post(); ?>
            <blockquote class="author-description">
                <h3><?php echo __('ABOUTTHE', 'iamdavidstutz'); ?><b><?php echo __('AUTHOR', 'iamdavidstutz'); ?></b></h3>
                <?php str_replace('<p></p>', '', the_content()); ?>
                <small>
                    <?php $day = get_the_date('d'); ?>
                    <?php if ($day == 1): ?>
                        <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                    <?php elseif ($day == 2): ?>
                        <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                    <?php elseif ($day == 3): ?>
                        <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                    <?php else: ?>
                        <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                    <?php endif; ?>, <a href="<?php echo get_author_posts_url($user->ID); ?>"><?php echo $user->display_name; ?></a>
                </small>
            </blockquote>
        <?php endwhile; ?>
        <?php // IMPORTANT! ?>
        <?php wp_reset_postdata(); ?>
    </div>
    <?php
}

/**
 * Display related links of page.
 *
 * @param   int id
 */
function iamdavidstutz_related_links($id, $break = TRUE) {

    if ($string = get_field('related-links', $id)) {
        if (!empty($string)) {
            ?> <b><?php echo __('RELATEDLINKS:', 'iamdavidstutz'); ?></b><br> <?php

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
            ?> <b><?php echo __('RELATEDLINKS:', 'iamdavidstutz'); ?></b>&nbsp;<?php

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
