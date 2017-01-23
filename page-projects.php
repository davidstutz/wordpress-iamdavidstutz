<?php
/*
 * Template Name: Projects
 * Description: Used to display an overview over my projects. The structure is as follows: one "parent" page (e.g. called "Projects") which has several subpages. The "Projects" page shows an overview over all subpages, where both the excerpt of these pages as well as related links are shown. Going down to one of the subpages, this overview will be transformed into a navigation onf the left hand side and the subpage will be displayed without excerpt and title. The related links of this subpage will then be displayed below the navigation.
 */
?><?php get_header(); ?>

    <div class="row">
        <div class="col-md-9">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post(); ?>
                    <?php if ($post->post_parent > 0): ?>
                        <div class="subpage-projects-container">
                            <div class="row">
                                <?php $parent = get_page($post->post_parent); ?>
                                <?php $query = new WP_Query(); ?>
                                <?php //$pages = $query->query(array('post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1)); ?>
                                <?php $pages = get_pages(array('sort_order' => 'asc', 'sort_column' => 'menu_order')); ?>
                                <?php $siblings = get_page_children($parent->ID, $pages); ?>
                                <?php if (sizeof($siblings) > 0): ?>
                                    <div class="col-md-3">
                                        <div class="subpage-projects-navigation">
                                            <ul class="nav nav-pills nav-pills-border nav-stacked">
                                                <?php foreach ($siblings as $sibling): ?>
                                                    <li<?php if ($sibling->ID == $post->ID): ?> class="active"<?php endif; ?>><a href="<?php echo get_post_permalink($sibling->ID); ?>"><?php echo $sibling->post_title; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="subpage-projects-links hidden-sm hidden-xs">
                                            <?php iamdavidstutz_related_links($post->ID); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="<?php if (sizeof($siblings) > 0): ?>col-md-9<?php else: ?>col-md-12<?php endif; ?>">
                                    <div class="subpage-projects">
                                        <div class="subpage-projects-content">
                                            <?php echo do_shortcode($post->post_content); ?>
                                        </div>
                                        
                                        <div class="subpage-projects-links hidden-lg hidden-md">
                                            <?php iamdavidstutz_related_links_dashed($post->ID); ?>
                                        </div>
                                        
                                        <div class="subpage-projects-comments">
                                            <?php comments_template(); ?>
                                        </div>
                                        
                                        <?php iamdavidstutz_page_footer(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($post->post_parent == 0): ?>
                        <div class="page-projects-container">
                            <?php $query = new WP_Query(); ?>
                            <?php //$pages = $query->query(array('post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC')); ?>
                            <?php $pages = get_pages(array('sort_order' => 'asc', 'sort_column' => 'menu_order')); ?>
                            <?php $children = get_page_children($post->ID, $pages); ?>
                            <?php foreach ($children as $child): ?>
                                <div class="page-projects-subpage">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="page-projects-subpage-navigation">
                                                <ul class="nav nav-pills nav-pills-border nav-stacked">
                                                    <li><a href="<?php echo get_post_permalink($child->ID); ?>"><?php echo $child->post_title; ?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="page-projects-subpage-excerpt">
                                                <?php echo $child->post_excerpt; ?>
                                            </div>
                                            <div class="page-projects-subpage-links">
                                                <?php iamdavidstutz_related_links_dashed($child->ID); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="row">
                                <div class="col-md-3">
                                    
                                </div>
                                <div class="col-md-9">
                                    <?php iamdavidstutz_page_footer(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="nothing">
                    <h1><?php echo __('NOTHING', 'iamdavidstutz'); ?></h1>
                    <h4><?php echo __('NOTHINGFOUNDHERE', 'iamdavidstutz'); ?></h4>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-3">
            <?php get_sidebar(); ?>
        </div>
    </div>
    
<?php get_footer(); ?>	