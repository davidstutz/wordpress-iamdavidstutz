<?php get_header(); ?>
    
    <div class="row">
        <div class="col-md-9">

            <?php if (have_posts()) : ?>
                <?php $found = true; ?>
                <?php $i = 0; ?>
                <?php while (have_posts()): the_post(); ?>
                    <?php if ($i >= 3) break; ?>
                    <?php if (in_category('snippet')): ?>
                        <?php iamdavidstutz_snippet(); ?>
                        <?php $i++; ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>

            <div class="searching-category">
                <h3><?php echo __('MORE', 'iamdavidstutz'); ?></h3>
                <h2><?php echo __('SNIPPETS', 'iamdavidstutz'); ?></h2>
            </div>

            <?php $tags = get_tags(); ?>
            <?php foreach ($tags as $tag): ?>
                <?php $tag_query = new WP_Query(array( 
                    'tag_id' => $tag->term_id,
                    'posts_per_page' => -1,
                    'category_name' => 'snippet',
                )); ?>

                <?php if ($tag_query->have_posts()): ?>
                    <?php $found = true; ?>
                    <div class="snippet-list-tag">
                        <a href="<?php echo get_tag_link($tag->term_id); ?>">
                            <span class="label label-primary"><?php echo strtoupper($tag->name); ?></span>
                        </a>
                    </div>
                    <?php while($tag_query->have_posts()): ?>
                        <ul class="snippet-list">
                            <?php $tag_query->the_post(); ?>
                            <?php iamdavidstutz_list_snippet(); ?>
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
