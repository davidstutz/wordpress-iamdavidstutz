<?php get_header(); ?>

    <div class="row">
        <div class="col-md-9">
            <div class="searching-publications">
                <h1>
                    <?php echo __('PUBLICATIONS', 'iamdavidstutz'); ?><span class="publications-header-small"><?php echo __('BYYEAR', 'iamdavidstutz'); ?></span>
                </h1>
                <?php if (category_description()): ?>
                    <div class="searching-publications-description">
                        <?php echo category_description(); ?>
                    </div>
                <?php endif; ?>
                
                <h1>
                    <span class="publications-header-small"><?php echo __('RELATED', 'iamdavidstutz'); ?></span><?php echo __('ARTICLES', 'iamdavidstutz'); ?>
                </h1>
                <div class="searching-publications-description">
                    <?php echo __('Articles and project pages related to the publications listed above.', 'iamdavidstutz'); ?>
                    <?php echo __('Also see', 'iamdavidstutz'); ?> <a href="https://davidstutz.de/category/projects/"><?php echo __('Projects', 'iamdavidstutz'); ?></a>  <?php echo __(' for an overview as well as', 'iamdavidstutz'); ?> <?php echo do_shortcode('[tag slug="thesis" title="Theses"]'); ?> <?php echo __('and', 'iamdavidstutz'); ?> <?php echo do_shortcode('[tag slug="seminar" title="Seminar Papers"]'); ?>.
                </div>
            </div>

            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post(); ?>
                    <?php if (in_category('reading')): ?>
                        <?php iamdavidstutz_reading(); ?>
                    <?php elseif (get_post()->post_type == 'page'): ?>
                        <?php iamdavidstutz_page(); ?>
                    <?php else: ?>
                        <?php iamdavidstutz_article(); ?>
                    <?php endif; ?>
                <?php endwhile; ?>
                <?php echo iamdavidstutz_pagination_simple(); ?>
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
