<?php get_header(); ?>
<div class="row">
    <div class="col-md-9">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()): the_post(); ?>
                <?php if (in_category('reading')): ?>
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
                            <div class="reading-comments">
                                <?php comments_template(); ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="article-container">
                        <?php iamdavidstutz_article_tags(); ?>
                        <div class="article">
                            <div class="article-date">
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
                            <div class="article-header">
                                <h2><?php the_title(); ?></h2>
                            </div>
                            <?php iamdavidstutz_article_below_title(); ?>
                            <?php if (has_excerpt(get_the_ID())): ?>
                                <div class="article-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endif; ?>
                            <div class="article-content">
                                <?php the_content(); ?>
                            </div>
                            <?php iamdavidstutz_article_footer(); ?>
                            <div class="article-comments">
                                <?php comments_template(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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