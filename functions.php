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

    wp_dequeue_script('jquery', get_bloginfo( 'template_directory' ) . '/js/jquery.min.js');
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
        case 'pingback' :
        case 'trackback' :
    ?>
        <p class="pingback">
            <?php __('Pingback:', 'iamdavidstutz'); ?> <?php comment_author_link(); ?> <?php edit_comment_link('<span class="glyphicon glyphicon-pencil"></span>'); ?>
        </p>
        <?php break; ?>
    <?php default : ?>
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
 * Custom pagination.
 * 
 * @param   integer pages
 * @param   integer range
 * @return  string  html
 */
function iamdavidstutz_pagination($pages = NULL, $range = 2) {  
    global $paged;

    $showitems = ($range * 2) + 1;

    if(empty($paged)) {
        $paged = 1;
    }

    if($pages === NULL) {
        global $wp_query;

        $pages = $wp_query->max_num_pages;
        if(!$pages) {
            $pages = 1;
        }
    }

    if($pages != 1) {
        $output = '<div style="text-align:center;"><ul class=pagination pagination-sm">';
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) {
            $output .= '<li><a href="' . get_pagenum_link(1) . '">&laquo;</a></li>';
        }

        if($paged > 1 && $showitems < $pages) {
            $output .= '<li><a href="' . get_pagenum_link($paged - 1) . '">&lsaquo;</a></li>';
        }

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages &&(!($i >= $paged + $range + 1 || $i <= $paged-$range-1 ) || $pages <= $showitems)) {
                $output .= $paged == $i ? 
                    '<li class="active"><a href="' . get_pagenum_link($i) . '" class="inactive">' . $i . '</a></li>'
                    : '<li><a href="' . get_pagenum_link($i) . '" class="inactive">' . $i . '</a></li>';
            }
        }

        if ($paged < $pages && $showitems < $pages) {
            $output .= '<li><a href="' . get_pagenum_link($paged + 1)  . '">&rsaquo;</a></li>';
        }
        if ($paged < $pages - 1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
            $output .= '<li><a href="' . get_pagenum_link($pages) . '">&raquo;</a></li>';
        }

        $output .= '</ul></div>';

        return $output;
    }
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
 * Display tags for the first article.
 */
function iamdavidstutz_article_first_tags() {
    $tags = get_the_tags(); ?>
    <div class="article-first-tags">
        <?php if ($tags): ?>
            <?php foreach ($tags as $tag): ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>"><span class="label label-primary"><?php echo strtoupper($tag->name); ?></span></a> 
            <?php endforeach; ?>
        <?php endif; ?>      
    </div>
    <?php
}

/**
 * Display tags for article.
 */
function iamdavidstutz_article_tags() {
    $tags = get_the_tags(); ?>
    <ul class="article-tags list-unstyled hidden-xs hidden-sm">
        <?php if ($tags): ?>
            <?php foreach ($tags as $tag): ?>
                <li><a href="<?php echo get_tag_link($tag->term_id); ?>"><span class="label label-primary"><?php echo strtoupper($tag->name); ?></span></a></li>
            <?php endforeach; ?>
        <?php endif; ?>      
    </ul>
    <?php
}

/**
 * Display tags for the first reading.
 */
function iamdavidstutz_reading_first_tags() {
    $tags = get_the_tags(); ?>
    <div class="reading-first-tags">
        <?php if ($tags): ?>
            <?php foreach ($tags as $tag): ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>"><span class="label label-primary"><?php echo strtoupper($tag->name); ?></span></a> 
            <?php endforeach; ?>
        <?php endif; ?>      
    </div>
    <?php
}

/**
 * Display tags for reading.
 */
function iamdavidstutz_reading_tags() {
    $tags = get_the_tags(); ?>
    <ul class="reading-tags list-unstyled hidden-xs hidden-sm">
        <?php if ($tags): ?>
            <?php foreach ($tags as $tag): ?>
                <li><a href="<?php echo get_tag_link($tag->term_id); ?>"><span class="label label-primary"><?php echo strtoupper($tag->name); ?></span></a></li>
            <?php endforeach; ?>
        <?php endif; ?>      
    </ul>
    <?php
}

/**
 * Display tags below title if sm or xs.
 */
function iamdavidstutz_article_below_title() {
    $tags = get_the_tags(); ?>
    <div class="article-tags-alternative hidden-md hidden-lg">
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
    $tags = get_the_tags(); ?>
    <div class="page-footer">
        <span class="page-footer-modified">
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
    </div>
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
    <div class="article-footer">
        <span class="page-footer-modified">
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
    </div>
    <div class="article-author">
        <?php $query = new WP_query('post_type=ub_part&post_author=' . $user->ID . '&orderby=date&post_limits=1'); ?>
        <?php while ($query->have_posts()): $query->the_post(); ?>
            <blockquote class="author-description">
                <p><?php the_content(); ?></p>
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
                    <?php endif; ?>, <?php echo $user->display_name; ?>
                </small>
            </blockquote>
        <?php endwhile; ?>
    </div>
    <?php
}

/**
 * Display related links of page.
 * 
 * @param   int id
 */
function iamdavidstutz_related_links($id) {
    global $post;
    
    if ($string = get_field('related-links', $id)) {
        
        $links = explode(';', $string);
        foreach ($links as $link) {
            $parts = str_getcsv($link, ':', '"');
            
            if (sizeof($parts) == 2) {
                $title = $parts[0];
                $href = $parts[1];
                ?><a href="<?php echo $href; ?>"><?php echo $title; ?></a> <?php
            }
        }
    }
}
