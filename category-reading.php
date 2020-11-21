<?php get_header(); ?>
    
    <div class="row">
        <div class="col-md-9">

            <?php $tag_query = new WP_Query(array( 
                    'tag_id' => $tag->term_id,
                    'posts_per_page' => 20,
                    'category_name' => 'reading',
                )); ?>

            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post(); ?>
                    <?php if (in_category('reading')): ?>
                        <?php iamdavidstutz_reading(); ?>
                    <?php endif; ?>
                <?php endwhile; ?>

                <?php iamdavidstutz_pagination_simple(); ?>
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
