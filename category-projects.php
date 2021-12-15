<?php get_header(); ?>
    
    <?php $cat = get_category(get_query_var('cat')); ?>
    <?php $categories = get_categories(array('child_of' => $cat->term_id, 'orderby' => 'slug')); ?>

    <div class="projects-container">
        <?php foreach ($categories as $category): ?>
            <?php
                if ($category->parent != $cat->term_id) continue;

                //if (!function_exists('iamdavidstutz_group_pages')) {
                //    function iamdavidstutz_group_pages($groupby){
                //        global $wpdb;
                //        return $wpdb->posts . '.menu_order';
                //    }
                //}

                //add_filter('posts_groupby', 'iamdavidstutz_group_pages');

                $page_args = array(
                    'post_type' => 'page',
                    'order' => 'ASC',
                    'orderby' => 'menu_order',
                    'fields' => 'ID,menu_order,post_title',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'term_id',
                            'terms'    => $category->term_id,
                        ),
                    ),

                );

                // !
                //remove_filter('posts_groupby', 'iamdavidstutz_group_pages');

                $page_query = new WP_Query($page_args);
                $pages = $page_query->get_posts();

                $last_order = FALSE;
                $grouped_pages = array();
                foreach ($pages as $page) {
                    if ($page->menu_order == $last_order + 1) {
                        $grouped_pages[$page->menu_order - 1][] = $page;
                    }
                    else {
                        $grouped_pages[$page->menu_order] = array($page);
                    }

                    $last_order = $page->menu_order;
                }
            ?>

            <div class="projects-category">
                <?php
                    $parts = explode(';', $category->name);

                    $type = '';
                    if (sizeof($parts) > 1) {
                        $type = $parts[0];
                        $name = $parts[1];
                    }
                    else {
                        $name = $parts[0];
                    }
                ?>

                <?php if (!empty($type)): ?>
                    <h3 style="margin-top:0;margin-bottom:0;"><?php echo strtoupper($type); ?></h3>                    
                <?php endif; ?>
                <h2 style="margin-top:0;"><?php echo $name; ?></h2>

                <?php if (!empty($category->description)): ?>
                    <div class="projects-category-description">
                        <?php echo $category->description; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php $i = 0; ?>
            <?php foreach ($grouped_pages as $array): ?>
                <?php if ($i%3 == 0) : ?><div class="row"><?php endif; ?>
                <div class="col-md-4">
                    <div class="projects-tile">
                        <div class="projects-tile-image text-center">
                            <span class="projcets-tile-image-helper"></span>
                            <?php $image = get_field('image', $array[0]->ID); ?>
                            <?php if (!empty($image)): ?>
                                <?php if (!get_field('inactive', $array[0]->ID)): ?><a href="<?php echo get_page_link($array[0]->ID); ?>"><?php endif; ?>
                                    <img src="<?php echo $image['url']; ?>" />
                                <?php if (!get_field('inactive', $array[0]->ID)): ?></a><?php endif; ?>
                            <?php else: ?>
                                <h3 class="text-center">
                                    <?php if (!get_field('inactive', $array[0]->ID)): ?><a href="<?php echo get_page_link($array[0]->ID); ?>"><?php endif; ?>
                                        <?php $parts = explode(' ', $array[0]->post_title); ?>
                                        <?php foreach ($parts as $part): ?><?php echo $part; ?><br><?php endforeach; ?>
                                    <?php if (!get_field('inactive', $array[0]->ID)): ?></a><?php endif; ?>
                                </h3>
                            <?php endif; ?>
                        </div>

                        <div class="projects-tile-box well">
                            <h6 class="projects-tile-header"><?php echo $array[0]->post_title; ?></h6>
                            
                            <?php $tags = get_the_tags($array[0]->ID); ?>
                            <div class="projects-tile-box-tags">
                                <?php if ($tags): ?>
                                    <?php foreach ($tags as $tag): ?>
                                        <a href="<?php echo get_tag_link($tag->term_id); ?>"><span class="label label-primary"><?php echo strtoupper($tag->name); ?></span></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <p class="projects-tile-text"><?php echo $array[0]->post_excerpt; ?></p>
                            <?php foreach ($array as $page): ?>
                                <?php if (get_field('inactive', $page->ID)): ?>
                                    <a class="btn btn-block btn-default"
                                        disabled="disabled"
                                        href="#"><?php echo __('Coming Soon', 'iamdavidstutz'); ?></a>
                                <?php else: ?>
                                    <a class="btn btn-block btn-primary"
                                        href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php if ($i%3 == 2): ?></div><?php endif; ?>
                <?php $i++; ?>
            <?php endforeach; ?>
            <?php if ($i%3 != 0): ?></div><?php endif; ?>
        <?php endforeach; ?>
    </div>

<?php get_footer(); ?>
