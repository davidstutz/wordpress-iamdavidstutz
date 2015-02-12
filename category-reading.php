<?php get_header(); ?>
<div class="row">
    <div class="col-md-9">
        <!--
            <div class="searching-category">
                <h1><?php echo __('READING', 'iamdavidstutz'); ?></h1>
                <?php if (category_description()): ?>
                    <div class="lead"><?php echo __('Books and papers I am currently reading ...', 'iamdavidstutz'); ?></div>
                <?php endif; ?>
            </div>
        -->
        <?php if (have_posts()) : ?>
        
            <?php // query_posts($query_string.'&posts_per_page=20'); ?>
            <?php while (have_posts()): the_post(); ?>
                <?php if (get_the_ID() == iamdavidstutz_latest_reading_id()): ?>
                    <div class="reading-container">
                        <div class="reading-first">
                            <div class="reading-date">
                                <?php $day = get_the_date('d'); ?>
                                <?php if ($day == 1): ?>
                                    <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                <?php elseif ($day == 2): ?>
                                    <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                <?php elseif ($day == 3): ?>
                                    <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?> 
                                <?php else: ?>
                                    <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                <?php endif; ?>
                            </div>
                            <?php iamdavidstutz_reading_first_tags(); ?>
                            <div class="reading-reference">
                                <?php the_field('reference'); ?>&nbsp;<?php if (get_field('pdf')): ?><a href="<?php the_field('pdf'); ?>" target="_blank">PDF</a><?php endif; ?>
                            </div>
                            <?php if (!empty($post->post_content) && $post->post_content != '' && $post->post_content != '<p></p>'): ?>
                                <div class="reading-comment">
                                    <?php echo do_shortcode($post->post_content); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="reading-container">
                        <?php iamdavidstutz_reading_tags(); ?>
                        <div class="reading">
                            <div class="reading-date">
                                <?php $day = get_the_date('d'); ?>
                                <?php if ($day == 1): ?>
                                    <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                <?php elseif ($day == 2): ?>
                                    <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                <?php elseif ($day == 3): ?>
                                    <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?> 
                                <?php else: ?>
                                    <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="reading-reference">
                                <?php the_field('reference'); ?>&nbsp;<?php if (get_field('pdf')): ?><a href="<?php the_field('pdf'); ?>" target="_blank">PDF</a><?php endif; ?>
                            </div>
                            <?php if (!empty($post->post_content) && $post->post_content != '' && $post->post_content != '<p></p>'): ?>
                                <div class="reading-comment">
                                    <?php echo do_shortcode($post->post_content); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
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
        <?php get_sidebar('no-readings'); ?>
    </div>
</div>
<?php get_footer(); ?>	