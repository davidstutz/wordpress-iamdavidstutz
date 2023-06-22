<?php get_header(); ?>
<div class="row">
    <div class="col-md-9">
        <div class="searching-category">
            <h1><?php echo __('Category»', 'iamdavidstutz'); ?><?php echo single_cat_title( '', false ); ?><?php echo __('«', 'iamdavidstutz'); ?></h1>
            <?php if (category_description()): ?>
		<div class="lead"><?php echo category_description(); ?></div>
            <?php endif; ?>
        </div>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()): the_post(); ?>
                <?php if (in_category('reading')): ?>
        
                <?php else: ?>
                    <div class="article-container">
                        <?php iamdavidstutz_article_tags(); ?>
                        <div class="article">
                            <div class="article-date">
                                <?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                            </div>
                            <div class="article-header">
                                <h2><?php the_title(); ?></h2>
                            </div>
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