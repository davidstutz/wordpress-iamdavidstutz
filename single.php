<?php get_header(); ?>
<div class="row">
    <div class="col-md-9">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()): the_post(); ?>
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
                            <?php if (comments_open()) : ?>
                                <?php comments_template(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
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