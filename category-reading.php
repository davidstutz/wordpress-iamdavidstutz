<?php get_header(); ?>
    
    <div class="row">
        <div class="col-md-9">
            <div class="searching-category">
                <h2><?php echo __('READINGLIST', 'iamdavidstutz'); ?>&raquo;<?php echo __('UNREAD', 'iamdavidstutz'); ?>&laquo;</h2>
            </div>

            <?php $tags = get_tags(); ?>
            <?php foreach ($tags as $tag): ?>
                <?php $tag_query = new WP_Query(array( 
                    'tag_id' => $tag->term_id,
                    'posts_per_page' => -1,
                    'category_name' => 'reading+unread',
                )); ?>

                <?php if ($tag_query->have_posts()): ?>
                    <?php $found = true; ?>
                    <div class="reading-list-tag">
                        <a href="<?php echo get_tag_link($tag->term_id); ?>">
                            <span class="label label-primary"><?php echo strtoupper($tag->name); ?></span>
                        </a>
                    </div>
                    <?php while($tag_query->have_posts()): ?>
                        <ul class="reading-list">
                            <?php $tag_query->the_post(); ?>
                            <?php iamdavidstutz_list_reading(); ?>
                        </ul>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            <?php endforeach; ?>

            <div class="searching-category">
                <h2><?php echo __('ALREADYREAD', 'iamdavidstutz'); ?>&raquo;<?php echo __('READ', 'iamdavidstutz'); ?>&laquo;</h2>
            </div>

            <?php $tags = get_tags(); ?>
            <?php foreach ($tags as $tag): ?>
                <?php $reading = get_category_by_slug('reading'); ?>
                <?php $unread = get_category_by_slug('unread'); ?>
                <?php $tag_query = new WP_Query(array( 
                    'tag_id' => $tag->term_id,
                    'posts_per_page' => -1,
                    'category_name' => 'reading',
                    'category__not_in' => $unread->term_id,
                )); ?>

                <?php if ($tag_query->have_posts()): ?>
                    <?php $found = true; ?>
                    <div class="reading-list-tag">
                        <a href="<?php echo get_tag_link($tag->term_id); ?>">
                            <span class="label label-primary"><?php echo strtoupper($tag->name); ?></span>
                        </a>
                    </div>
                    <?php while($tag_query->have_posts()): ?>
                        <ul class="reading-list">
                            <?php $tag_query->the_post(); ?>
                            <?php iamdavidstutz_list_reading(); ?>
                        </ul>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if (!$found): ?>
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
