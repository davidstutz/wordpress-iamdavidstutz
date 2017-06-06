<?php get_header(); ?>
    
    <div class="row">
        <div class="col-md-9">

            <?php $tag_query = new WP_Query(array( 
                    'tag_id' => $tag->term_id,
                    'posts_per_page' => -1,
                    'category_name' => 'reading',
                )); ?>

            <?php if ($tag_query->have_posts()): ?>
                <div class="reading-list-tag">
                    <a href="<?php echo get_tag_link($tag->term_id); ?>">
                        <span class="label label-primary"><?php echo strtoupper($tag->name); ?></span>
                    </a>
                </div>
                <?php while($tag_query->have_posts()): $tag_query->the_post(); ?>
                    <ul class="reading-list">
                        <?php iamdavidstutz_list_reading(); ?>
                    </ul>
                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>
            <?php endif; ?>

        </div>
        <div class="col-md-3">
            <?php get_sidebar(); ?>
        </div>
    </div>

<?php get_footer(); ?>
