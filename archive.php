<?php get_header(); ?>
<div class="row">
    <div class="col-md-9">
        <div class="searching-archive">
            <h1>
                <?php if (is_day()): ?>
                    <?php $day = get_the_date('d'); ?>
                    <?php if ($day == 1): ?>
                        <?php echo __('ARCHIVEDAILY', 'iamdavidstutz'); ?>&raquo;<?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('FY')); ?>&laquo;
                    <?php elseif ($day == 2): ?>
                        <?php echo __('ARCHIVEDAILY', 'iamdavidstutz'); ?>&raquo;<?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('FY')); ?>&laquo;
                    <?php elseif ($day == 3): ?>
                        <?php echo __('ARCHIVEDAILY', 'iamdavidstutz'); ?>&raquo;<?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('FY')); ?>&laquo;
                    <?php else: ?>
                        <?php echo __('ARCHIVEDAILY', 'iamdavidstutz'); ?>&raquo;<?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('FY')); ?>&laquo;
                    <?php endif; ?>
				<?php elseif (is_month()): ?>
                    <?php echo __('ARCHIVEMONTHLY', 'iamdavidstutz'); ?>&raquo;<?php echo strtoupper(get_the_date('FY')); ?>&laquo;
                <?php elseif (is_year()): ?>
                    <?php echo __('ARCHIVEYEARLY', 'iamdavidstutz'); ?>&raquo;<?php echo get_the_date('Y'); ?>&laquo;
                <?php else: ?>
                    <?php echo __('ARCHIVE', 'iamdavidstutz'); ?>
				<?php endif; ?>
            </h1>
        </div>
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
                            <div class="reading-top-header">
                                <h3>READING</h3>
                            </div>
                            <div class="reading-reference">
                                <?php the_field('reference'); ?>&nbsp;<?php if (get_field('pdf')): ?><a href="<?php the_field('pdf'); ?>" target="_blank">PDF</a><?php endif; ?>
                            </div>
                            <p>
                                <a href="<?php the_permalink(); ?>" class="pull-right btn btn-default reading-more"><?php echo __('Interested?'); ?></a>
                            </p>
                            <p class="clearfix"></p>
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
                            <div class="article-top-header">
                                <h3>ARTICLE</h3>
                            </div>
                            <div class="article-header">
                                <h2><?php the_title(); ?></h2>
                            </div>
                            <?php iamdavidstutz_article_below_title(); ?>
                            <div class="article-excerpt">
                                <?php the_excerpt(); ?>
                                <p>
                                    <a href="<?php the_permalink(); ?>" class="pull-right btn btn-default article-more"><?php echo __('Interested?'); ?></a>
                                </p>
                                <p class="clearfix"></p>
                            </div>
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
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>	