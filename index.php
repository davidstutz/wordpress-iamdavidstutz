<?php get_header(); ?>

    <div class="row">
        <div class="col-md-9">

            <?php query_posts($query_string); ?>
            <?php $featured = array(); ?>

            <?php if (have_posts()): ?>
                <?php while (have_posts()): the_post(); ?>
                    <?php if ($i >= 3) continue; ?>

                    <?php if (in_category('reading')): ?>
                        <?php // Nothing. ?>
                    <?php elseif (in_category('snippet')): ?>
                        <?php // Nothing. ?>
                    <?php else: ?>
                        <?php iamdavidstutz_article(); ?>
                        <?php $featured[get_the_ID()] = get_the_ID(); ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>

            <?php wp_reset_query(); ?>
            <?php query_posts($query_string); ?>

            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post(); ?>
                    <?php if (in_category('reading')): ?>
                        <?php iamdavidstutz_reading(); ?>
                    <?php elseif (in_category('snippet')): ?>
                        <?php //iamdavidstutz_snippet(); ?>
                    <?php else: ?>
                        <?php if (!isset($featured[get_the_ID()])): ?>
                            <?php iamdavidstutz_article(); ?>
                        <?php endif; ?>
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