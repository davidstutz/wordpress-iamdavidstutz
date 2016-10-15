<?php get_header(); ?>
    
    <div class="row">
        <div class="col-md-9">
            <div class="searching-category">
                <h1><?php echo __('CATEGORY', 'iamdavidstutz'); ?>&raquo;<?php echo strtoupper(single_cat_title( '', false )); ?>&laquo;</h1>
                <?php if (category_description()): ?>
            <div class="lead"><?php echo category_description(); ?></div>
                <?php endif; ?>
            </div>

            <?php global $wp_query; ?>
            <?php $unread = get_category_by_slug('unread'); ?>
            <?php $wp_query->set('category__not_in', array($unread->term_id)); ?>

            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post(); ?>
                    <?php if (in_category('reading')): ?>
                        <?php iamdavidstutz_reading(); ?>
                    <?php elseif (in_category('snippet')): ?>
                        <?php iamdavidstutz_snippet(); ?>
                    <?php else: ?>
                        <?php iamdavidstutz_article(); ?>
                    <?php endif; ?>
                <?php endwhile; ?>
                <?php iamdavidstutz__simple(); ?>
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
