<?php get_header(); ?>

    <div class="row">
        <div class="col-md-9">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post(); ?>
                    <div class="page">
                        <div class="page-header">
                            <h2><?php the_title(); ?></h2>
                        </div>
                        <div class="page-content">
                            <?php the_content(); ?>
                        </div>
                        <?php iamdavidstutz_page_footer(); ?>
                    </div>
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
